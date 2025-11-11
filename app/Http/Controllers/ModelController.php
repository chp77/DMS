<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\Brand;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class ModelController
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

            $data = DB::table('models as m')
                        ->leftJoin('brands', 'brands.id', '=', 'm.brand_id')
                        ->select(
                            DB::raw('ROW_NUMBER() OVER (ORDER BY m.id DESC) AS row_number'),
                            'm.*', 'brands.name AS brand_name'
                        )
                        ->where('m.is_active', true)
                        ->whereAnd('brands.is_active', true)
                        ->orderBy('m.created_at', 'DESC')
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
            'name' => 'required | string | max:250',
            'brand_id' => 'required | array'
        ]);
        
        try {
            $currentUser = Auth::user();

            // check customer email
            $modelExisted = Models::where('name', '=', $request->name)->where('is_active', true)->get();

            if ($modelExisted->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'The model has been registered!']);
            }

            $model = Models::create([
                'name' => $request->name,
                'brand_id' => $request->brand_id['id'],
                'user_id' => $currentUser->id,
                'created_at' => new \DateTime(),
                'is_active' => true
            ]);
            
            Log::channel('actionlog')->info('User ' . $currentUser->name . ' with ID - ' . $currentUser->id . ' just added a new model with ID - ' . $model->id);

            return response(['statusCode' => Response::HTTP_OK, 'data' => $model]);
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
                $model = Models::findOrFail($id);

                if ($model->count() > 0 && !empty($model->brand_id)) {
                    $brand = Brand::findOrFail($model->brand_id);

                    if ($brand->count() > 0) {
                        $model->brand_id = $brand;
                    }
                }

                return response(['statusCode' => Response::HTTP_OK, 'data' => $model]);
            }

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Invalid model ID!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    public function getModelByBrandId($id) {
        try {
            $currentUser = Auth::user();

            if (!empty($id)) {
                $brands = Brand::findOrFail($id);

                if ($brands->count() > 0 && !empty($brands->id)) {
                    $brands = Models::where('brand_id', '=', $brands->id)->where('is_active', true)->get();
                }

                return response(['statusCode' => Response::HTTP_OK, 'data' => $brands]);
            }

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Invalid brand ID!']);
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
        // Validate the requests
        $this->validate($request, [
            'name' => 'required | string | max:150',
            'brand_id' => 'required | array'
        ]);

        try {
            $user = Auth::user();

            // get user and update by id
            $model = Models::findOrFail($id);

            if ($model->count() === 0 || $model->is_active == false) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'Model not found!']);
            }

            $modelExisted = Models::where('name', '=', $request->name)->where('id', '!=', $id)->where('is_active', true)->get();
                
            if ($modelExisted->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'Duplicate Model!']);
            }
                
            $data = [
                'name' => $request->name,
                'brand_id' => $request->brand_id['id'],
                'updated_at' => new \DateTime(),
            ];

            $model->update($data);

            Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just updated the model name - ID ' . $id . '...');

            return response(['statusCode' => Response::HTTP_OK, 'response' => $model]);
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
                $model = Models::findOrFail($id);
                $model->is_active = false;
                $model->updated_at = new \DateTime();
                $model->save();
        
                Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just deleted the model ID - ' . $id);
            
                return response(['statusCode' => Response::HTTP_OK, 'response' => 'Model deleted']);
            }
        
            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'The required parameter for "model ID" are missing!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }
}
