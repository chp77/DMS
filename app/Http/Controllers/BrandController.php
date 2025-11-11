<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class BrandController
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

            $data = DB::table('brands as b')
                        ->select(
                            DB::raw('ROW_NUMBER() OVER (ORDER BY b.id DESC) AS row_number'),
                            'b.*'
                        )
                        ->where('b.is_active', true)
                        ->orderBy('b.created_at', 'DESC')
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
            'name' => 'required | string | max:250'
        ]);

        try {
            $currentUser = Auth::user();

            // check customer email
            $brandExisted = Brand::where('name', '=', $request->name)->where('is_active', true)->get();

            if ($brandExisted->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'The brand has been registered!']);
            }

            $brand = Brand::create([
                'name' => $request->name,
                'user_id' => $currentUser->id,
                'created_at' => new \DateTime(),
                'is_active' => true
            ]);
            
            Log::channel('actionlog')->info('User ' . $currentUser->name . ' with ID - ' . $currentUser->id . ' just added a new brand with ID - ' . $brand->id);

            return response(['statusCode' => Response::HTTP_OK, 'data' => $brand]);
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
                $brand = Brand::findOrFail($id);

                return response(['statusCode' => Response::HTTP_OK, 'data' => $brand]);
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
        ]);

        try {
            $user = Auth::user();

            // get user and update by id
            $brand = Brand::findOrFail($id);

            if ($brand->count() === 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'Brand not found!']);
            }

            $brandExisted = Brand::where('name', '=', $request->name)->where('id', '!=', $id)->where('is_active', true)->get();
                
            if ($brandExisted->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'Duplicate Brand!']);
            }
                
            $data = [
                'name' => $request->name,
                'updated_at' => new \DateTime(),
            ];

            $brand->update($data);

            Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just updated the brand name - ID ' . $id . '...');

            return response(['statusCode' => Response::HTTP_OK, 'response' => $brand]);
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
                $brand = Brand::findOrFail($id);
                $brand->is_active = false;
                $brand->updated_at = new \DateTime();
                $brand->save();
        
                Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just deleted the brand ID - ' . $id);
            
                return response(['statusCode' => Response::HTTP_OK, 'response' => 'Brand deleted']);
            }
        
            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'The required parameter for "brand ID" are missing!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }
}
