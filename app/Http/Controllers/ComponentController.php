<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\Brand;
use App\Models\Models;
use App\Models\ComponentDetails;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class ComponentController
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $currentUser = Auth::user();

            $data = DB::table('components as c')
                        ->leftJoin('brands', 'brands.id', '=', 'c.brand')
                        ->leftJoin('models', 'models.id', '=', 'c.model')
                        ->leftJoin('component_details', 'component_details.component_id', '=', 'c.id')
                        ->select(
                            'c.id', 'c.remarks', 'c.is_active','brands.name as brand', 'models.name as model', 'c.category',
                            'component_details.specification',
                            DB::raw('CONCAT(c.category, ": ", brands.name, " - ", models.name) as label_name')
                        )
                        ->where('c.is_active', true)
                        ->where('component_details.is_active', true)
                        ->orderBy('c.created_at', 'DESC')
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
        $specification = '';

        // Validate the requests
        $this->validate($request, [
            'brand' => 'required | array',
            'model' => 'required | array',
            'category' => 'required | string | max:150',
            'price' => 'required | string | max:20',
            'currency' => 'required | string | max:10',
        ]);

        // add validation if category is 'Android Motherboard'
        if ($request->category == 'Android Motherboard') {
            $this->validate($request, [
                'androidMotherboardSystemVersion' => 'required | string | max:150',
                'androidMotherboardCpu' => 'required | string | max:150',
                'androidMotherboardGpu' => 'required | string | max:150',
                'androidMotherboardRam' => 'required | string | max:150',
                'androidMotherboardStorage' => 'required | string | max:150',
                'androidMotherboardWifi' => 'required | string | max:150',
                'androidMotherboardHotspot' => 'required | string | max:150',
                'androidMotherboardBluetooth' => 'required | string | max:150',
                'androidMotherboardWan' => 'required | string | max:150',
            ]);

            $specification = '[{"system version":"' . $request->androidMotherboardSystemVersion . '","cpu":"' . $request->androidMotherboardCpu . '","gpu":"' . $request->androidMotherboardGpu .'","ram":"' . $request->androidMotherboardRam .'","storage":"' . $request->androidMotherboardStorage .'","wifi":"' . $request->androidMotherboardWifi.'","hotspot":"' . $request->androidMotherboardHotspot.'","bluetooth":"' . $request->androidMotherboardBluetooth.'","wan":"' . $request->androidMotherboardWan.'"}]';
        } else if ($request->category == 'Front Board') {
            $this->validate($request, [
                'preVersionUsb' => 'required | string | max:150',
                'preVersionTypeC' => 'required | string | max:150',
                'preVersionHdmi' => 'required | string | max:150',
                'preVersionTouch' => 'required | string | max:150',
                'preVersionLightSensitivity' => 'required | string | max:150',
                'preVersionIr' => 'required | string | max:150',
                'preVersionLed' => 'required | string | max:150',
            ]);

            $specification = '[{"usb":"' . $request->preVersionUsb . '","type-c":"' . $request->preVersionTypeC . '","hdmi":"' . $request->preVersionHdmi .'","touch":"' . $request->preVersionTouch .'","light sensitivity":"' . $request->preVersionLightSensitivity .'","ir":"' . $request->preVersionIr.'","led":"' . $request->preVersionLed.'"}]';
        } else if ($request->category == 'Tempered Glass') {
            $this->validate($request, [
                'temperedGlassSize' => 'required | string | max:150',
                'temperedGlassThickness' => 'required | string | max:150',
                'temperedGlassAg' => 'required | string | max:150',
                'temperedGlassSilkGreenColor' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->temperedGlassSize . '","thickness":"' . $request->temperedGlassThickness . '","ag":"' . $request->temperedGlassAg .'","color":"' . $request->temperedGlassSilkGreenColor.'"}]';
        } else if ($request->category == 'Touch') {
            $this->validate($request, [
                'touchSize' => 'required | string | max:150',
                'touchTouchMode' => 'required | string | max:150',
                'touchTouchPoint' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->touchSize . '","mode":"' . $request->touchTouchMode .'","point":"' . $request->touchTouchPoint.'"}]';
        } else if ($request->category == 'Power Board') {
            $this->validate($request, [
                'powerBoardSize' => 'required | string | max:150',
                'powerBoardTotalPower' => 'required | string | max:150',
                'powerBoardLedPower' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->powerBoardSize .'","total power":"' . $request->powerBoardTotalPower . '","led power":"' . $request->powerBoardLedPower.'"}]';
        } else if ($request->category == 'OC') {
            $this->validate($request, [
                'ocSize' => 'required | string | max:150',
                'ocLevel' => 'required | string | max:150',
                'ocResolution' => 'required | string | max:150',
                'ocContrast' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->ocSize . '","level":"' . $request->ocLevel . '","resolution":"' . $request->ocResolution .'","contrast":"' . $request->ocContrast.'"}]';
        } else if ($request->category == 'Materials') {
            $this->validate($request, [
                'profileSize' => 'required | string | max:150',
                'profileFittingMethod' => 'required | string | max:150',
                'profileColor' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->profileSize . '","fitting method":"' . $request->profileFittingMethod .'","color":"' . $request->profileColor.'"}]';
        } else if ($request->category == 'Logic Board') {
            $this->validate($request, [
                'logicBoardResolution' => 'required | string | max:150',
            ]);

            $specification = '[{"resolution":"' . $request->logicBoardResolution.'"}]';
        } else if ($request->category == 'LED Light Strip') {
            $this->validate($request, [
                'ledLightStripSize' => 'required | string | max:150',
                'ledLightStripLampPower' => 'required | string | max:150',
                'ledLightStripNumberOfLampBeads' => 'required | string | max:150',
                'ledLightStripNumberOfLightBars' => 'required | string | max:150',
                'ledLightStripAdaptableBackplane' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->ledLightStripSize . '","lamp power":"' . $request->ledLightStripLampPower . '","number of lamp beads":"' . $request->ledLightStripNumberOfLampBeads .'","number of light bars":"' . $request->ledLightStripNumberOfLightBars .'","adaptable backplane":"' . $request->ledLightStripAdaptableBackplane.'"}]';
        } else if ($request->category == 'OPS') {
            $this->validate($request, [
                'opsCpu' => 'required | string | max:150',
                'opsRam' => 'required | string | max:150',
                'opsHarddisk' => 'required | string | max:150'
            ]);

            $specification = '[{"cpu":"' . $request->opsCpu . '","ram":"' . $request->opsRam . '","hard disk":"' . $request->opsHarddisk .'"}]';
        }
        
        try {
            $currentUser = Auth::user();
            $content = null;

            // store product image
            if (!empty($request->product_image)) {
                $rootPath = base_path();
                $baseUrl = view()->shared('baseUrl');
                $milliseconds = round(microtime(true) * 1000);
                $uploadOk = 1;
                $dateTime = new \DateTime();

                $check = $_FILES["product_image"]["tmp_name"];
                $sourcePath = $_FILES["product_image"]["tmp_name"];
                $fileSize = $_FILES["product_image"]["size"];
                $fileActualName = str_replace(array(' ', '/'), '_', $_FILES["product_image"]["name"]);

                $publicUrl = $baseUrl . '/storage/upload/asset' . '/image';
                $folderUploadImageQuality = $rootPath . '/storage/app/public/upload/asset/image';
                $validExtension = array('jpeg', 'jpg', 'png','webp','gif', 'svg', 'bmp');

                $targetDir = $folderUploadImageQuality . '/';
                $filename = $dateTime->format('Y-m-d').'/'.$dateTime->format('H:i:s').'/'. $fileActualName;
                $fileStoreInDb = $currentUser->id . '_' . $milliseconds . '_' . basename($filename);
                $target_file = $targetDir . $fileStoreInDb;

                // create the dir is not exist
                if (!file_exists($folderUploadImageQuality)) {
                    mkdir($folderUploadImageQuality, 0777, true);
                }

                $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
                if (file_exists($target_file)) {
                    $errorMessage = "File already exists";
                    $uploadOk = 0;
    
                    return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => $errorMessage]);
                }
    
                if ($uploadOk == 0) {
                    $errorMessage = "Your file was not uploaded.";
                        
                    return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => $errorMessage]);
                } else {
                    if (in_array($imageFileType, $validExtension)) {
                        $imgInfo = getimagesize($sourcePath);
                        $mime = $imgInfo['mime'];
    
                        switch($mime){
                            case 'image/jpeg':
                                $image = imagecreatefromjpeg($sourcePath);
                                imagejpeg($image, $target_file);
                                break;
                            case 'image/png':
                                $image = imagecreatefrompng($sourcePath);
                                imagepng($image, $target_file);
                                break;
                            case 'image/webp':
                                $image = imagecreatefromwebp($sourcePath);
                                imagewebp($image, $target_file);
                                break;
                            case 'image/gif':
                                $image = imagecreatefromgif($sourcePath);
                                imagegif($image, $target_file);
                                break;
                            case 'image/svg+xml':
                                $svgContents = file_get_contents($sourcePath);
                                $image = imagecreatefromstring($svgContents);
                                break;
                            case 'image/bmp':
                                $image = imagecreatefrombmp($sourcePath);
                                imagewbmp($image, $target_file);
                                break;
                            default:
                                $image = imagecreatefromjpeg($sourcePath);
                                imagejpeg($image, $target_file);
                                break;
                        }
                        
                        try {
                            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                                // release the memory allocated for the image resource
                                imagedestroy($image);
                                $content = $publicUrl . '/' . $fileStoreInDb;
                            }
                        } catch (Exception $exception) {
                            Log::channel('systemlog')->error($e->getMessage());
    
                            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
                        }
                    }
                }
            }

            $component = Component::create([
                'brand' => $request->brand['id'],
                'model' => $request->model['id'],
                'category' => $request->category,
                'remarks' => $request->remarks,
                'user_id' => $currentUser->id,
                'created_at' => new \DateTime(),
                'is_active' => true
            ]);

            if (!empty($component) && isset($component)) {
                $componentDetails = ComponentDetails::create([
                    'component_id' => $component->id,
                    'product_image' => "[" . $content . "]",
                    'price' => $request->price,
                    'currency' => $request->currency,
                    'specification' => $specification,
                ]);
            }

            Log::channel('actionlog')->info('User ' . $currentUser->name . ' with ID - ' . $currentUser->id . ' just added the new component info with ID - ' . $component->id);

            return response(['statusCode' => Response::HTTP_OK, 'data' => $componentDetails]);
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
        try {
            $currentUser = Auth::user();

            if (!empty($id)) {
                $component = Component::findOrFail($id);
                $componentDetails = ComponentDetails::where('component_id', '=', $id)->where('is_active', true)->first();
                // print_r($componentDetails);exit;
               
                $brand = Brand::where('id', '=', $component->brand)->where('is_active', true)->get()[0];
                $model = Models::where('id', '=', $component->model)->where('is_active', true)->get()[0];

                // redeclare the product image as empty string if it returned empty array
                if ($componentDetails->product_image == '[]') {
                    $componentDetails->product_image = '';
                }

                if (($componentDetails->specification)) {
                    $componentDetails->specification = json_decode($componentDetails->specification, true);
                }

                if (!empty($componentDetails->factory_warranty)) {
                    $formattedFactoryWarranty = new \DateTime($componentDetails->factory_warranty);
                    $componentDetails->factory_warranty = $formattedFactoryWarranty->format('Y-m-d');
                }

                if ($brand) {
                    $component->brand = $brand;
                }

                if ($model) {
                    $component->model = $model;
                }
                // merge to one array
                $mergedData = array_merge(json_decode($component, true), json_decode($componentDetails, true));

                return response(['statusCode' => Response::HTTP_OK, 'data' => $mergedData]);
            }

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Invalid component ID!']);
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
        $specification = '';

        // Validate the requests
        $this->validate($request, [
            'brand' => 'required | array',
            'model' => 'required | array',
            'category' => 'required | string | max:150',
            'price' => 'required | string | max:250',
            'currency' => 'required | string | max:250'
        ]);

        if ($request->category == 'Android Motherboard') {
            $this->validate($request, [
                'androidMotherboardSystemVersion' => 'required | string | max:150',
                'androidMotherboardCpu' => 'required | string | max:150',
                'androidMotherboardGpu' => 'required | string | max:150',
                'androidMotherboardRam' => 'required | string | max:150',
                'androidMotherboardStorage' => 'required | string | max:150',
                'androidMotherboardWifi' => 'required | string | max:150',
                'androidMotherboardHotspot' => 'required | string | max:150',
                'androidMotherboardBluetooth' => 'required | string | max:150',
                'androidMotherboardWan' => 'required | string | max:150',
            ]);

            $specification = '[{"system version":"' . $request->androidMotherboardSystemVersion . '","cpu":"' . $request->androidMotherboardCpu . '","gpu":"' . $request->androidMotherboardGpu .'","ram":"' . $request->androidMotherboardRam .'","storage":"' . $request->androidMotherboardStorage .'","wifi":"' . $request->androidMotherboardWifi.'","hotspot":"' . $request->androidMotherboardHotspot.'","bluetooth":"' . $request->androidMotherboardBluetooth.'","wan":"' . $request->androidMotherboardWan.'"}]';
        } else if ($request->category == 'Front Board') {
            $this->validate($request, [
                'preVersionUsb' => 'required | string | max:150',
                'preVersionTypeC' => 'required | string | max:150',
                'preVersionHdmi' => 'required | string | max:150',
                'preVersionTouch' => 'required | string | max:150',
                'preVersionLightSensitivity' => 'required | string | max:150',
                'preVersionIr' => 'required | string | max:150',
                'preVersionLed' => 'required | string | max:150',
            ]);

            $specification = '[{"usb":"' . $request->preVersionUsb . '","type-c":"' . $request->preVersionTypeC . '","hdmi":"' . $request->preVersionHdmi .'","touch":"' . $request->preVersionTouch .'","light sensitivity":"' . $request->preVersionLightSensitivity .'","ir":"' . $request->preVersionIr.'","led":"' . $request->preVersionLed.'"}]';
        } else if ($request->category == 'Tempered Glass') {
            $this->validate($request, [
                'temperedGlassSize' => 'required | string | max:150',
                'temperedGlassThickness' => 'required | string | max:150',
                'temperedGlassAg' => 'required | string | max:150',
                'temperedGlassSilkGreenColor' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->temperedGlassSize . '","thickness":"' . $request->temperedGlassThickness . '","ag":"' . $request->temperedGlassAg .'","color":"' . $request->temperedGlassSilkGreenColor.'"}]';
        } else if ($request->category == 'Touch') {
            $this->validate($request, [
                'touchSize' => 'required | string | max:150',
                'touchTouchMode' => 'required | string | max:150',
                'touchTouchPoint' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->touchSize . '","mode":"' . $request->touchTouchMode .'","point":"' . $request->touchTouchPoint.'"}]';
        } else if ($request->category == 'Power Board') {
            $this->validate($request, [
                'powerBoardSize' => 'required | string | max:150',
                'powerBoardTotalPower' => 'required | string | max:150',
                'powerBoardLedPower' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->powerBoardSize .'","total power":"' . $request->powerBoardTotalPower . '","led power":"' . $request->powerBoardLedPower.'"}]';
        } else if ($request->category == 'OC') {
            $this->validate($request, [
                'ocSize' => 'required | string | max:150',
                'ocLevel' => 'required | string | max:150',
                'ocResolution' => 'required | string | max:150',
                'ocContrast' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->ocSize . '","level":"' . $request->ocLevel . '","resolution":"' . $request->ocResolution .'","contrast":"' . $request->ocContrast.'"}]';
        } else if ($request->category == 'Materials') {
            $this->validate($request, [
                'profileSize' => 'required | string | max:150',
                'profileFittingMethod' => 'required | string | max:150',
                'profileColor' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->profileSize . '","fitting method":"' . $request->profileFittingMethod .'","color":"' . $request->profileColor.'"}]';
        } else if ($request->category == 'Logic Board') {
            $this->validate($request, [
                'logicBoardSize' => 'required | string | max:150',
            ]);

            $specification = '[{"resolution":"' . $request->logicBoardSize.'"}]';
        } else if ($request->category == 'LED Light Strip') {
            $this->validate($request, [
                'ledLightStripSize' => 'required | string | max:150',
                'ledLightStripLampPower' => 'required | string | max:150',
                'ledLightStripNumberOfLampBeads' => 'required | string | max:150',
                'ledLightStripNumberOfLightBars' => 'required | string | max:150',
                'ledLightStripAdaptableBackplane' => 'required | string | max:150',
            ]);

            $specification = '[{"size":"' . $request->ledLightStripSize . '","lamp power":"' . $request->ledLightStripLampPower . '","number of lamp beads":"' . $request->ledLightStripNumberOfLampBeads .'","number of light bars":"' . $request->ledLightStripNumberOfLightBars .'","adaptable backplane":"' . $request->ledLightStripAdaptableBackplane.'"}]';
        } else if ($request->category == 'OPS') {
            $this->validate($request, [
                'opsCpu' => 'required | string | max:150',
                'opsRam' => 'required | string | max:150',
                'opsHarddisk' => 'required | string | max:150'
            ]);

            $specification = '[{"cpu":"' . $request->opsCpu . '","ram":"' . $request->opsRam . '","hard disk":"' . $request->opsHarddisk .'"}]';
        }
        
        try {
            $user = Auth::user();
            $content = null;

            // store product image
            if (!empty($request->new_product_image)) {
                $rootPath = base_path();
                $baseUrl = view()->shared('baseUrl');
                $milliseconds = round(microtime(true) * 1000);
                $uploadOk = 1;
                $dateTime = new \DateTime();

                $check = $_FILES["new_product_image"]["tmp_name"];
                $sourcePath = $_FILES["new_product_image"]["tmp_name"];
                $fileSize = $_FILES["new_product_image"]["size"];
                $fileActualName = str_replace(array(' ', '/'), '_', $_FILES["new_product_image"]["name"]);

                $publicUrl = $baseUrl . '/storage/upload/asset' . '/image';
                $folderUploadImageQuality = $rootPath . '/storage/app/public/upload/asset/image';
                $validExtension = array('jpeg', 'jpg', 'png','webp','gif', 'svg', 'bmp');

                $targetDir = $folderUploadImageQuality . '/';
                $filename = $dateTime->format('Y-m-d').'/'.$dateTime->format('H:i:s').'/'. $fileActualName;
                $fileStoreInDb = $user->id . '_' . $milliseconds . '_' . basename($filename);
                $target_file = $targetDir . $fileStoreInDb;

                // create the dir is not exist
                if (!file_exists($folderUploadImageQuality)) {
                    mkdir($folderUploadImageQuality, 0777, true);
                }

                $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
                if (file_exists($target_file)) {
                    $errorMessage = "File already exists";
                    $uploadOk = 0;
    
                    return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => $errorMessage]);
                }
    
                if ($uploadOk == 0) {
                    $errorMessage = "Your file was not uploaded.";
                        
                    return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => $errorMessage]);
                } else {
                    if (in_array($imageFileType, $validExtension)) {
                        $imgInfo = getimagesize($sourcePath);
                        $mime = $imgInfo['mime'];
    
                        switch($mime){
                            case 'image/jpeg':
                                $image = imagecreatefromjpeg($sourcePath);
                                imagejpeg($image, $target_file);
                                break;
                            case 'image/png':
                                $image = imagecreatefrompng($sourcePath);
                                imagepng($image, $target_file);
                                break;
                            case 'image/webp':
                                $image = imagecreatefromwebp($sourcePath);
                                imagewebp($image, $target_file);
                                break;
                            case 'image/gif':
                                $image = imagecreatefromgif($sourcePath);
                                imagegif($image, $target_file);
                                break;
                            case 'image/svg+xml':
                                $svgContents = file_get_contents($sourcePath);
                                $image = imagecreatefromstring($svgContents);
                                break;
                            case 'image/bmp':
                                $image = imagecreatefrombmp($sourcePath);
                                imagewbmp($image, $target_file);
                                break;
                            default:
                                $image = imagecreatefromjpeg($sourcePath);
                                imagejpeg($image, $target_file);
                                break;
                        }
                        
                        try {
                            if (move_uploaded_file($_FILES["new_product_image"]["tmp_name"], $target_file)) {
                                // release the memory allocated for the image resource
                                imagedestroy($image);
                                $content = $publicUrl . '/' . $fileStoreInDb;
                            }
                        } catch (Exception $exception) {
                            Log::channel('systemlog')->error($e->getMessage());
    
                            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
                        }
                    }
                }
            }

            // update the URL
            if ($request->component_details_id) {
                $componentInfo = ComponentDetails::findOrFail($request->component_details_id);

                if ($componentInfo) {
                    $componentInfo->product_image = "[" . $content . "]";
                    $componentInfo->price = $request->price;
                    $componentInfo->currency = $request->currency;
                    $componentInfo->specification = $specification;
                    $componentInfo->updated_at = new \DateTime();
                    $componentInfo->save();
                }
            }

            if (!empty($id)) {
                $component = Component::findOrFail($id);
                $component->brand = $request->brand['id'];
                $component->model = $request->model['id'];
                $component->category = $request->category;
                $component->remarks = $request->remarks;
                $component->updated_at = new \DateTime();
                $component->save();

                Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just updated the component info ID - ' . $id);
                return response(['statusCode' => Response::HTTP_OK, 'data' => $component]);
            }

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Invalid component ID!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

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
                $component = Component::findOrFail($id);
                $component->is_active = false;
                $component->updated_at = new \DateTime();
                $component->save();
        
                Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just deleted the component ID - ' . $id);
            
                return response(['statusCode' => Response::HTTP_OK, 'response' => 'Component deleted']);
            }
        
            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'The required parameter for "component ID" are missing!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }
}
