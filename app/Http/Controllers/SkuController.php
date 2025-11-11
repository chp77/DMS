<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Sku;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class SkuController
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

            $data = DB::table('sku as s')
                        ->select(
                            DB::raw('ROW_NUMBER() OVER (ORDER BY s.id DESC) AS row_number'),
                            's.*'
                        )
                        ->where('s.is_active', true)
                        ->orderBy('s.created_at', 'DESC')
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
            $skuExisted = Sku::where('name', '=', $request->name)->where('is_active', true)->get();

            if ($skuExisted->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'The SKU has been registered!']);
            }

            $sku = Sku::create([
                'name' => $request->name,
                'user_id' => $currentUser->id,
                'created_at' => new \DateTime(),
                'is_active' => true
            ]);
            
            Log::channel('actionlog')->info('User ' . $currentUser->name . ' with ID - ' . $currentUser->id . ' just added a new SKU with ID - ' . $sku->id);

            return response(['statusCode' => Response::HTTP_OK, 'data' => $sku]);
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
                $sku = Sku::findOrFail($id);

                return response(['statusCode' => Response::HTTP_OK, 'data' => $sku]);
            }

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Invalid SKU ID!']);
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
            $sku = Sku::findOrFail($id);

            if ($sku->count() === 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'SKU not found!']);
            }

            $skuExisted = Sku::where('name', '=', $request->name)->where('id', '!=', $id)->where('is_active', true)->get();
                
            if ($skuExisted->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'Duplicate SKU code!']);
            }

            $data = [
                'name' => $request->name,
                'updated_at' => new \DateTime(),
            ];

            $sku->update($data);

            Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just updated the SKU code - ID ' . $id . '...');

            return response(['statusCode' => Response::HTTP_OK, 'response' => $sku]);
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
                $sku = Sku::findOrFail($id);
                $sku->is_active = false;
                $sku->updated_at = new \DateTime();
                $sku->save();
        
                Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just deleted the SKU ID - ' . $id);
            
                return response(['statusCode' => Response::HTTP_OK, 'response' => 'SKU deleted']);
            }
        
            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'The required parameter for "SKU ID" are missing!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }
}
