<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class CustomerController
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

            $data = DB::table('customers as c')
                        ->select(
                            DB::raw('ROW_NUMBER() OVER (ORDER BY c.id) AS row_number'),
                            'c.id',
                            'c.name',
                            'c.email',
                            'c.company_name',
                            'c.company_address',
                            'c.contact_number',
                            'c.country',
                            'c.reseller_name',
                            'c.created_at',
                            'c.updated_at',
                            'c.is_suspended',
                        )
                        ->where('c.is_active', true)
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
            'email' => 'required | string | max:250'
        ]);

        try {
            $currentUser = Auth::user();

            // check customer email
            $customerExisted = Customer::where('email', '=', $request->email)->where('is_active', true)->get();

            if ($customerExisted->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'The email has been registered!']);
            }

            $newCustomer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'contact_number' => $request->phone_number,
                'country' => $request->country,
                'reseller_name' => $request->reseller_name,
                'user_id' => $currentUser->id,
                'created_at' => new \DateTime(),
                'is_active' => true
            ]);
            
            Log::channel('actionlog')->info('User ' . $currentUser->name . ' with ID - ' . $currentUser->id . ' just added a new customer with ID - ' . $newCustomer->id);

            return response(['statusCode' => Response::HTTP_OK, 'data' => $newCustomer]);
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
                $customer = Customer::findOrFail($id);
                return response(['statusCode' => Response::HTTP_OK, 'data' => $customer]);
            }

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Invalid customer ID!']);
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
    public function edit(Request $request, $id)
    {
        // Validate the requests
        $this->validate($request, [
            'name' => 'required | string | max:250',
            'email' => 'required | string | max:250'
        ]);
        
        try {
            $currentUser = Auth::user();

            if (!empty($id)) {
                $customer = Customer::findOrFail($id);
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->company_name = $request->company_name;
                $customer->company_address = $request->company_address;
                $customer->contact_number = $request->phone_number;
                $customer->country = $request->country;
                $customer->reseller_name = $request->reseller_name;
                $customer->updated_at = new \DateTime();
                $customer->save();

                Log::channel('actionlog')->info('User ' . $currentUser->name . ' with ID - ' . $currentUser->id . ' just updated the customer info with ID - ' . $id);
                return response(['statusCode' => Response::HTTP_OK, 'data' => $customer]);
            }

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Invalid customer ID!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
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
        try {
            $user = Auth::user();

            $customer = Customer::findOrFail($id);

            if ($customer->count() > 0) {
                $customer->is_active = false;
                $customer->updated_at = new \DateTime();
                $customer->save();
        
                Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just deleted the customer ID - ' . $id);
            
                return response(['statusCode' => Response::HTTP_OK, 'response' => 'Customer deleted']);
            }
        
            Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just deleted the customer with ID - ' . $customer->id);

            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Not found!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }
}
