<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Customer;
use App\Models\Component;
use App\Models\ComponentDetails;
use App\Models\Brand;
use App\Models\Models;
use App\Models\Sku;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AssetController
{
    use ValidatesRequests;

    public function bulk(request $request, $ids)
    {
        try {
            $currentUser = Auth::user();
            $params = explode("&", $ids);
            $assetIds = $params;
            $assets = [];

            if (isset($assetIds) && !empty($assetIds)) {
                $assets = Asset::whereIn('id', $assetIds)->get();
            }

            return view('bulkPrintingQrCode', ['assets' => $assets]);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $currentUser = Auth::user();

            $data = DB::table('assets as a')
                        ->leftJoin('brands', 'brands.id', '=', 'a.brand')
                        ->leftJoin('models', 'models.id', '=', 'a.model')
                        ->leftJoin('sku', 'sku.id', '=', 'a.sku')
                        ->select(
                            DB::raw('ROW_NUMBER() OVER (ORDER BY a.id) AS row_number'),
                            'a.id', 'a.order_number', 'a.customer_order_number', 'a.serial_number',
                            'a.mac_address', 'a.brand', 'a.model', 'a.qa_video_url', 'a.type',
                            DB::raw("DATE_FORMAT(a.manufacture_date, '%Y-%m-%d') as manufacture_date"),
                            'a.warranty_period',
                            DB::raw("DATE_FORMAT(a.warranty_started_date, '%Y-%m-%d') as warranty_started_date"),
                            DB::raw("DATE_FORMAT(a.warranty_expiry_date, '%Y-%m-%d') as warranty_expiry_date"),
                            'a.type',
                            'a.id', 'a.remarks', 'a.customer_id', 'a.user_id', 'a.component_ids', 'a.is_csv_import',
                            'a.is_active', 'brands.name AS brand', 'models.name AS model', 'sku.name AS sku'
                        )
                        ->where('a.is_active', true)
                        ->orderBy('a.created_at', 'DESC')
                        ->get();

            return response(['statusCode' => Response::HTTP_OK, 'data' => $data]);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the requests
        $this->validate($request, [
            'order_number' => 'required | string | max:50',
            'type' => 'required | string | max:50',
            'brand' => 'required | array',
            'model' => 'required | array',
            'sku' => 'required | array',
            'manufacture_date' => 'required | string | max:150',
            'warranty_period' => 'required | string | max:150',
            'warranty_start_date' => 'required | string | max:150',
            'warranty_expiry_date' => 'required | string | max:150',
        ]);

        if ($request->type === 'Panel') {
            $this->validate($request, [
                'serial_number' => 'required | string | max:150',
            ]);
        }
        
        try {
            $currentUser = Auth::user();
            $componentIds = "[]";

            // check Asset serial no.
            $existed = Asset::where('serial_number', '=', $request->serial_number)->where('is_active', true)->get();

            if ($existed->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'Duplicate serial_number!']);
            }

            if (($request->selected_components)) {
                $componentIds = array_map(function ($item) {
                    return strval($item['id']);
                }, $request->selected_components);

                $componentIds = "" . json_encode($componentIds) . "";
            }

            $manufactureDate = new \DateTime($request->manufacture_date);
            $formattedManufactureDate = $manufactureDate->format('Y-m-d');
            $warrantyStartDate = new \DateTime($request->warranty_start_date);
            $formattedWarrantyStartDate = $warrantyStartDate->format('Y-m-d');
            $warrantyExpiryDate = new \DateTime($request->warranty_expiry_date);
            $formattedWarrantyExpiryDate = $warrantyExpiryDate->format('Y-m-d');

            $asset = Asset::create([
                'order_number' => $request->order_number,
                'type' => $request->type,
                'customer_order_number' => $request->customer_order_number,
                'serial_number' => $request->serial_number,
                'mac_address' => $request->mac_address,
                'brand' => ($request->brand)['id'],
                'model' => ($request->model)['id'],
                'sku' => ($request->sku)['id'],
                'qa_video_url' => $request->qa_video_link,
                'manufacture_date' => $formattedManufactureDate,
                'warranty_period' => $request->warranty_period,
                'warranty_started_date' => $formattedWarrantyStartDate,
                'warranty_expiry_date' => $formattedWarrantyExpiryDate,
                'customer_id' => (($request->selected_customer)) ? (($request->selected_customer)['id']) : NULL,
                'user_id' => $currentUser->id,
                'remarks' => $request->remarks,
                'component_ids' => $componentIds,
                'created_at' => new \DateTime(),
                'is_active' => true
            ]);

            Log::channel('actionlog')->info('User ' . $currentUser->name . ' with ID - ' . $currentUser->id . ' just added the new asset with ID - ' . $asset->id);

            return response(['statusCode' => Response::HTTP_OK, 'data' => $asset]);
        } catch (\Exception $e) {
            Log::channel('actionlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // try {
            $currentUser = Auth::user();
            $components = [];

            if (!empty($id)) {
                $asset = Asset::findOrFail($id);

                if ($asset->count() > 0) {
                    // get customers
                    if ($asset->customer_id) {
                        $customer = Customer::findOrFail($asset->customer_id);
                        if ($customer->count() >0) {
                            $asset->customer_id = $customer;
                        }
                    }

                    // get brand
                    $brand = Brand::where('id', '=', $asset->brand)->get()[0];

                    if ($brand) {
                        $asset->brand = $brand;
                    }

                    // get model
                    $model = Models::where('id', '=', $asset->model)->get()[0];
                    
                    if ($model) {
                        $asset->model = $model;
                    }

                    // get sku
                    $sku = Sku::where('id', '=', $asset->sku)->get()[0];

                    if ($sku) {
                        $asset->sku = $sku;
                    }

                    // get components
                    if ($asset->component_ids) {
                        $decodedComponentIds = json_decode($asset->component_ids, true);
                        foreach ($decodedComponentIds as $val) {
                            $component = Component::findOrFail($val);
                            if ($component->count() > 0) {
                                $selectedBrand = Brand::findOrFail($component->brand);
                                $selectedModel = Models::findOrFail($component->model);
                                $component['label_name'] = $component['category'] . ": " . $selectedBrand['name'] . " - " .$selectedModel['name'];
                                array_push($components, $component);
                            }
                        }
                        
                        // get specification
                        foreach ($components as $val) {
                            $componentDetails = ComponentDetails::where('component_id', '=', $val['id'])->first();
                            $val['specification'] = $componentDetails['specification'];
                        }
                        $asset->component_ids = $components;
                    }

                    if (!empty($asset->manufacture_date)) {
                        $formattedManufactureDate = new \DateTime($asset->manufacture_date);
                        $asset->manufacture_date = $formattedManufactureDate->format('Y-m-d');
                    }

                    if (!empty($asset->warranty_started_date)) {
                        $formattedWarrantyStartedDate = new \DateTime($asset->warranty_started_date);
                        $asset->warranty_started_date = $formattedWarrantyStartedDate->format('Y-m-d');
                    }

                    if(!empty($asset->warranty_expiry_date)) {
                        $formattedWarrantyExpiryDate = new \DateTime($asset->warranty_expiry_date);
                        $asset->warranty_expiry_date = $formattedWarrantyExpiryDate->format('Y-m-d');
                    }
                }

                return response(['statusCode' => Response::HTTP_OK, 'data' => $asset]);
            }

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Invalid asset ID!']);
        // } catch (\Exception $e) {
        //     Log::channel('systemlog')->error($e->getMessage());

        //     return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the requests
        $this->validate($request, [
            'order_number' => 'required | string | max:50',
            'brand' => 'required | array',
            'model' => 'required | array',
            'sku' => 'required | array',
            'manufacture_date' => 'required | string | max:150',
            'warranty_period' => 'required | string | max:150',
            'warranty_start_date' => 'required | string | max:150',
            'warranty_expiry_date' => 'required | string | max:150',
        ]);

        if ($request->type === 'Panel') {
            $this->validate($request, [
                'serial_number' => 'required | string | max:150',
            ]);
        }
        
        try {
            $currentUser = Auth::user();
            $componentIds = "[]";

            // check Asset serial no.
            if ($request->type === 'Panel') {
                $existed = Asset::where('serial_number', '=', $request->serial_number)->where('id', '!=', $id)->where('is_active', true)->get();
    
                if ($existed->count() > 0) {
                    return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'Duplicate serial_number!']);
                }
            }

            // get the component ids
            if (($request->selected_components)) {
                $componentIds = array_map(function ($item) {
                    return intval($item['id']);
                }, $request->selected_components);

                $componentIds = "" . json_encode($componentIds) . "";
            }

            if (empty($id)) {
                return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Asset ID missing!']);
            }

            $asset = Asset::findOrFail($id);
            
            if ($asset->count() > 0 && isset($asset)) {
                $manufactureDate = new \DateTime($request->manufacture_date);
                $formattedManufactureDate = $manufactureDate->format('Y-m-d');
                $warrantyStartDate = new \DateTime($request->warranty_start_date);
                $formattedWarrantyStartDate = $warrantyStartDate->format('Y-m-d');
                $warrantyExpiryDate = new \DateTime($request->warranty_expiry_date);
                $formattedWarrantyExpiryDate = $warrantyExpiryDate->format('Y-m-d');

                $asset->order_number = $request->order_number;
                $asset->type = $request->type;
                $asset->customer_order_number = $request->customer_order_number;
                $asset->model = $request->model['id'];
                $asset->brand = $request->brand['id'];
                $asset->sku = $request->sku['id'];
                $asset->serial_number = $request->serial_number;
                $asset->mac_address = $request->mac_address;
                $asset->qa_video_url = $request->qa_video_link;
                $asset->manufacture_date = $formattedManufactureDate;
                $asset->warranty_period = $request->warranty_period;
                $asset->warranty_started_date = $formattedWarrantyStartDate;
                $asset->warranty_expiry_date = $warrantyExpiryDate;
                $asset->remarks = $request->remarks;
                $asset->component_ids = $componentIds;
                $asset->customer_id = $request->selected_customer ? (($request->selected_customer)['id']) : NULL;
                $asset->updated_at = new \DateTime();
                $asset->save();
            }

            Log::channel('actionlog')->info('User ' . $currentUser->name . ' with ID - ' . $currentUser->id . ' just added the new asset with ID - ' . $asset->id);

            return response(['statusCode' => Response::HTTP_OK, 'data' => $asset]);
        } catch (\Exception $e) {
            Log::channel('actionlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = Auth::user();

            if ($user->count() > 0) {
                $asset = Asset::findOrFail($id);
                $asset->is_active = false;
                $asset->updated_at = new \DateTime();
                $asset->save();
        
                Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just deleted the asset ID - ' . $id);
            
                return response(['statusCode' => Response::HTTP_OK, 'response' => 'Asset deleted']);
            }
        
            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'The required parameter for "asset ID" are missing!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }
}
