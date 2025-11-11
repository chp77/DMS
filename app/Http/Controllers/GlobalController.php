<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;

class GlobalController
{
    public function getTimezone()
    {
        try {
            $regions = array(
                'Africa' => \DateTimeZone::AFRICA,
                'America' => \DateTimeZone::AMERICA,
                'Antarctica' => \DateTimeZone::ANTARCTICA,
                'Aisa' => \DateTimeZone::ASIA,
                'Atlantic' => \DateTimeZone::ATLANTIC,
                'Europe' => \DateTimeZone::EUROPE,
                'Indian' => \DateTimeZone::INDIAN,
                'Pacific' => \DateTimeZone::PACIFIC
            );

            $timezones = collect($regions)
                        ->flatMap(function ($mask, $name) {
                        // print_r($name);exit;
                            return \DateTimeZone::listIdentifiers($mask);
                        })->toArray();

            $newTimezonesArray = [];

            if (isset($timezones)) {
                foreach ($timezones as $timezone) {
                    $dateTime = new \DateTime('now', new \DateTimeZone($timezone));
                    $offset = $dateTime->format('P');
                    $timezoneName = $dateTime->format('e');
                    $formatted = $offset . ' UTC ' . $timezoneName;
                    
                    $newTimezonesArray[] = $formatted;
                }
            }
    
            return response(['statusCode' => Response::HTTP_OK, 'response' => $newTimezonesArray]);
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
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('checkAsset');
    }

    public function retrieveDetails($id)
    {
        try{
            $encrytedId = Crypt::encryptString($id);
            return redirect()->route('viewAssetDetails', ['id' => $encrytedId]);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    public function viewAssetDetails($id)
    {
        try {
            // Decrypt the ID for use
            $decryptedId = Crypt::decryptString($id);
            
            $asset = DB::table('assets as a')
                        ->leftJoin('customers', 'customers.id', '=', 'a.customer_id')
                        ->leftJoin('brands', 'brands.id', '=', 'a.brand')
                        ->leftJoin('models', 'models.id', '=', 'a.model')
                        ->leftJoin('components as c', DB::raw('FIND_IN_SET(c.id, SUBSTRING(a.component_ids, 2, LENGTH(a.component_ids) - 2))'), '>', DB::raw('0'))
                        ->select(
                            'a.id', 'customers.name', 'a.order_number', 'a.customer_order_number', 'a.serial_number', 'a.mac_address',
                            'a.model', 'a.brand', 'brands.name AS brand_name', 'models.name AS model_name', 'a.qa_video_url', 'a.warranty_period', 'a.remarks', 'a.customer_id',
                            DB::raw("DATE_FORMAT(a.manufacture_date, '%Y-%m-%d') AS manufacture_date"),
                            DB::raw("DATE_FORMAT(a.warranty_started_date, '%Y-%m-%d') AS warranty_started_date"),
                            DB::raw("DATE_FORMAT(a.warranty_expiry_date, '%Y-%m-%d') AS warranty_expiry_date"),
                            'a.user_id', 'a.component_ids', 'a.is_csv_import', 'a.created_at', 'a.updated_at', 'a.is_active', 'a.sku',
                            'customers.name',
                        )
                        ->where('a.is_active', true)
                        ->where('a.serial_number', '=', $decryptedId)
                        ->groupBy('a.id', 'customers.name', 'a.order_number', 'a.customer_order_number', 'a.serial_number', 'a.mac_address',
                        'a.model', 'a.brand', 'brands.name', 'models.name', 'a.qa_video_url','a.remarks', 'a.customer_id', 'a.warranty_period', 
                        'a.user_id', 'a.component_ids', 'a.is_csv_import', 'a.created_at', 'a.updated_at', 'a.is_active', 'a.sku',
                        'a.manufacture_date', 'a.warranty_started_date', 'a.warranty_expiry_date')
                        ->first();

            if ($asset) {
                // get component details
                if (isset($asset->component_ids) && !empty($asset->component_ids)) {
                    $decodedIds = json_decode($asset->component_ids, true);
                    $component_details = DB::table('components')
                                            ->leftJoin('component_details', 'components.id', '=', 'component_details.component_id')
                                            ->leftJoin('brands', 'brands.id', '=', 'components.brand')
                                            ->leftJoin('models', 'models.id', '=', 'components.model')
                                            ->select('components.brand', 'components.model',
                                                    'components.remarks', 'components.category',
                                                    'component_details.product_image', 'component_details.specification',
                                                    'component_details.price', 'component_details.currency', 'brands.name AS brand_name', 'models.name AS model_name'
                                                    )
                                            ->whereIN('components.id', $decodedIds)
                                            ->get();

                    $asset->component_details = json_decode($component_details, true);
                }
                
                return view('viewAsset', ['asset' => $asset]);
            } else {
                // Handle the case where the asset is not found
                return view('error.404');
            }
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    public function contact()
    {
        return view('contactSupport');
    }

    public function share($id)
    {
        try {
            if (!empty($id)) {
                $encrytedId = Crypt::encryptString($id);
            }

            return redirect()->route('deviceDetails', ['id' => $encrytedId]);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    public function info(Request $request)
    {
        // Validate the input data
        $request->validate([
            'serial_number' => 'required|string',
        ]);

        // Retrieve the input data
        $serialNumber = $request->input('serial_number');

        $encrytedId = Crypt::encryptString($serialNumber);

        return redirect()->route('deviceDetails', ['id' => $encrytedId]);
    }

    public function details($id)
    {
        $ram = '';
        $storage = '';
        $wifi = '';

        try {
            if ($id) {
                try {
                    $serialNumber = Crypt::decryptString($id);
                } catch (\Exception $e) {
                    Log::channel('systemlog')->error($e->getMessage());
        
                    return view('warrantyStatus', ['asset' => []]);
                }

                $asset = DB::table('assets as a')
                        ->select(
                            'a.serial_number',
                            'a.mac_address', 'a.brand', 'a.model', 'a.qa_video_url',
                            DB::raw("DATE_FORMAT(a.manufacture_date, '%Y-%m-%d') as manufacture_date"),
                            'a.warranty_period',
                            DB::raw("DATE_FORMAT(a.warranty_started_date, '%Y-%m-%d') as warranty_started_date"),
                            DB::raw("DATE_FORMAT(a.warranty_expiry_date, '%Y-%m-%d') as warranty_expiry_date"),
                            'a.id', 'a.remarks', 'a.customer_id', 'a.user_id', 'a.component_ids', 'a.is_csv_import', 'a.sku',
                            'a.is_active'
                        )
                        ->where('a.is_active', true)
                        ->where('a.serial_number', '=', $serialNumber)
                        ->orderBy('a.created_at', 'DESC')
                        ->first();
                if ($asset) {
                    $components = DB::table('components')
                                    ->leftJoin('component_details', 'component_details.component_id', '=', 'components.id')
                                    ->select('components.*', 'component_details.specification')
                                    ->whereIn('components.id', json_decode($asset->component_ids, true))
                                    ->get();

                    if ($components) {
                        $componentArrays = json_decode($components, true);
                        foreach($componentArrays as $com) {
                            if ($com['category'] == 'Android Motherboard') {
                                $specification = json_decode($com['specification'], true);
                                $ram = $specification[0]['ram'];
                                $storage = $specification[0]['storage'];
                                $wifi = $specification[0]['wifi'];
                                break;
                            }
                        }
                    }
                }

                $asset->ram = $ram;
                $asset->storage = $storage;
                $asset->wifi = $wifi;
                
                return view('warrantyStatus', ['asset' => $asset]);
            }
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
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
