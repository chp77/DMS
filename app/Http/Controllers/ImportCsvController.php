<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Models\Organization;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Asset;
use App\Models\Customer;
use App\Models\Component;
use App\Models\Models;
use App\Models\Brand;
use App\Models\Sku;
use GuzzleHttp\Client;
use App\Models\ComponentDetails;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class ImportCsvController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($any)
    {
        $user = Auth::user();
        
        $validRoutes = [
            'assets',
            'asset-add',
            'import-csv',
            'users',
            'user-add',
            'customers',
            'customer-add',
            'components',
            'component-add',
            'brands',
            'models',
            'skus',
            'brand-add',
            'model-add',
            'sku-add',
        ];

        $isValid = in_array($any, $validRoutes) || str_starts_with($any, 'customer/show/')
                   || str_starts_with($any, 'user/show/') || str_starts_with($any, 'component/show/')
                   || str_starts_with($any, 'asset/show/')
                   || str_starts_with($any, 'bulk/qr-code/')
                   || str_starts_with($any, 'brand/show/')
                   || str_starts_with($any, 'model/show/')
                   || str_starts_with($any, 'models/')
                   || str_starts_with($any, 'sku/show/');

        if ($isValid) {
            return view('dashboard')->with([
                'user' => $user
            ]);
        } else {
            Log::channel('actionlog')->error("Invalid route attempt: $any by user ID: " . ($user ? $user->id : 'guest'));
            return view('error.404');
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
     * check the string to convert to array
     */
    public function isJsonStringArray($string) {
        $decoded = json_decode($string, true);

        return (json_last_error() === JSON_ERROR_NONE) && is_array($decoded);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Set the script execution time to unlimited
        set_time_limit(0);

        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        
        $currentUser = Auth::user();

        // try {
            // Handle the uploaded file
            $file = $request->file('file');
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $errorMessage = [];
            $counter = 2;
            $insertOn = true;
            $type = '';
            $serialNo = NULL;

            // Parse the CSV data
            $header = array_shift($data);
            $csvData = array();
            foreach ($data as $row) {
                $brandId = '';
                $error = '';
                $data = array_combine($header, $row);
                
                $newSku = $data['SKU code'];

                if (empty($data['Order number'])) {
                    $error = "Order number missing!";
                    $errorMessage[$counter][] = $error;
                    $insertOn = false;
                }

                if (empty($data['Model'])) {
                    $error = "Model missing!";
                    $errorMessage[$counter][] = $error;
                    $insertOn = false;
                }

                if (empty($data['Type']) || $data['Type'] === 'Panel') {
                    $type = 'Panel';

                    if (empty($data['Serial number'])) {
                        $error = "Serial number missing!";
                        $errorMessage[$counter][] = $error;
                        $insertOn = false;
                    } else {
                        $serialNo = $data['Serial number'];
                    }
                } else {
                    $type = 'Spare parts';
                    $serialNo = NULL;
                }
                
                if (empty($data['SKU code'])) {
                    $error = "SKU code missing!";
                    $errorMessage[$counter][] = $error;
                    $insertOn = false;
                }

                if (empty($data['Brand'])) {
                    $error = "Brand missing!";
                    $errorMessage[$counter][] = $error;
                    $insertOn = false;
                }

                // if (empty($data['Mac address'])) {
                //     $error = "Mac address missing!";
                //     $errorMessage[$counter][] = $error;
                //     $insertOn = false;
                // }

                if (empty($data['Manufacture date'])) {
                    $error = "Manufacture date missing!";
                    $errorMessage[$counter][] = $error;
                    $insertOn = false;
                }

                if (empty($data['Warranty period'])) {
                    $error = "Warranty period missing!";
                    $errorMessage[$counter][] = $error;
                    $insertOn = false;
                }

                if (empty($data['Warranty start date'])) {
                    $error = "Warranty start date missing!";
                    $errorMessage[$counter][] = $error;
                    $insertOn = false;
                }

                if (empty($data['Warranty expiry date'])) {
                    $error = "Warranty expiry date missing!";
                    $errorMessage[$counter][] = $error;
                    $insertOn = false;
                }

                // insert to database
                if ($insertOn) {
                    // get customer ID or insert
                    $customer = Customer::where('email', '=', $data['Customer email'])->where('name', '=', $data['Customer name'])->where('is_active', true)->first();

                    if (!$customer) {
                        // create the new customer with an valid name and email
                        if ($data['Customer name'] !=='' && $data['Customer email'] !== '') {
                            $customer = Customer::create([
                                'name' => $data['Customer name'],
                                'email' => $data['Customer email'],
                                'company_name' => $data['Customer company name'],
                                'company_address' => $data['Customer address'],
                                'contact_number' => $data['Customer contact number'],
                                'country' => $data['Customer country'],
                                'reseller_name' => $data['Reseller name'],
                                'user_id' => $currentUser->id,
                                'created_at' => now(),
                                'is_active' => true,
                                'is_suspended' => false
                            ]);

                            $customerId = $customer->id;
                        } else {
                            $customerId = NULL;
                        }
                    } else {
                        $customer->name = $data['Customer name'];
                        $customer->email = $data['Customer email'];
                        $customer->company_name = $data['Customer company name'];
                        $customer->company_address = $data['Customer address'];
                        $customer->contact_number = $data['Customer contact number'];
                        $customer->country = $data['Customer country'];
                        $customer->reseller_name = $data['Reseller name'];
                        $customer->updated_at = now();
                        $customer->save();
                        $customerId = $customer->id;
                    }

                    $asset = Asset::where('serial_number', '=', $data['Serial number'])->where('is_active', true)->first();
                    $brand = $data['Brand'];
                    $model = $data['Model'];

                    $existedBrand = Brand::where('name', '=', $brand)->where('is_active', true)->first();

                    // add new brand
                    if (empty($existedBrand)) {
                        $newBrand = Brand::Create([
                            'name' => $brand,
                            'user_id' => $currentUser->id,
                            'created_at' => now(),
                            'is_active' => true
                        ]);

                        $brandId = $newBrand->id;
                    } else {
                        $brandId = $existedBrand->id;
                    }

                    $existedModel = Models::where('name', '=', $model)->where('is_active', true)->first();

                    // add new model
                    if (empty($existedModel)) {
                        $newModel = Models::Create([
                            'name' => $model,
                            'brand_id' => $brandId,
                            'user_id' => $currentUser->id,
                            'created_at' => now(),
                            'is_active' => true
                        ]);

                        $modelId = $newModel->id;
                    } else {
                        $modelId = $existedModel->id;
                    }

                    // get SKU code
                    $existedSku = Sku::where('name', '=', $data['SKU code'])->where('is_active', true)->first();

                    // add new sku
                    if (empty($existedSku) && $data['SKU code'] !== '') {
                        $newSku = Sku::Create([
                            'name' => $data['SKU code'],
                            'user_id' => $currentUser->id,
                            'created_at' => now(),
                            'is_active' => true
                        ]);

                        $skuId = $newSku->id;
                    } else {
                        $skuId = $existedSku->id;
                    }

                    $isValidComponents = $this->isJsonStringArray($data['Components']);

                    if (!$isValidComponents && !empty($data['Components'])) {
                        $error = "Invalid component format!";
                        $errorMessage[$counter][] = $error;
                        $data['Components'] = '';
                    }

                    // insert new asset
                    if ($asset) {
                        if ($asset->count() > 0) {
                            // update asset
                            $asset->order_number = $data['Order number'];
                            $asset->type = $type;
                            $asset->customer_order_number = $data['Customer order number'];
                            $asset->serial_number = $serialNo;
                            $asset->mac_address = $data['Mac address'];
                            $asset->brand = $brandId;
                            $asset->model = $modelId;
                            $asset->sku = $skuId;
                            $asset->qa_video_url = $data['QA video link'];
                            $asset->manufacture_date = $data['Manufacture date'];
                            $asset->warranty_period = $data['Warranty period'];
                            $asset->warranty_started_date = $data['Warranty start date'];
                            $asset->warranty_expiry_date = $data['Warranty expiry date'];
                            $asset->remarks = $data['Remarks'];
                            $asset->user_id = $currentUser->id;
                            $asset->customer_id = $customerId;
                            $asset->component_ids = $data['Components'];
                            $asset->updated_at = now();
                            $asset->save();
                        }
                    } else {
                        $insertData = [
                            'order_number' => $data['Order number'],
                            'type' => $type,
                            'customer_order_number' => $data['Customer order number'],
                            'serial_number' => $serialNo,
                            'mac_address' => $data['Mac address'],
                            'brand' => $brandId,
                            'model' => $modelId,
                            'sku' => $skuId,
                            'qa_video_url' => $data['QA video link'],
                            'manufacture_date' => $data['Manufacture date'],
                            'warranty_period' => $data['Warranty period'],
                            'warranty_started_date' => $data['Warranty start date'],
                            'warranty_expiry_date' => $data['Warranty expiry date'],
                            'remarks' => $data['Remarks'],
                            'is_csv_import' => true,
                            'user_id' => $currentUser->id,
                            'is_active' => true,
                            'customer_id' => $customerId,
                            'component_ids' => $data['Components'],
                            'created_at' => now(),
                        ];

                        DB::beginTransaction();

                        // try {
                            Asset::create($insertData);
                            DB::commit();
                        // } catch (\Exception $e) {
                        //     DB::rollBack();

                        //     return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => 'Failed to save data!']);
                        // }
                    }
                }

                $csvData[] = array_combine($header, $row);
                $insertOn = true;
                $counter++;
            }
            
            if (isset($errorMessage) && count($errorMessage) > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => $errorMessage]);
            }

            return response(['statusCode' => Response::HTTP_OK, 'data' => 'Bulk import successfully.']);
        // } catch (\Exception $e) {
        //     Log::channel('systemlog')->error($e->getMessage());

        //     return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
