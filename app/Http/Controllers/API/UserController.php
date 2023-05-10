<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        try {
            $data = DB::table('users')
                    ->join('devices', 'users.id', '=', 'devices.user_id')
                    ->select('users.id', 'users.name', 'users.email', 'users.role', 'users.updated_at', 'devices.id AS device_number')
                    ->where('users.is_active', true)
                    ->get();

            return response(['statusCode' => Response::HTTP_OK, 'data' => $data]);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR]);
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
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        // Validate the requests
        $this->validate($request, [
            'name' => 'required | string | max:30',
            'email' => 'required | string | max:50',
            'role' => 'required | string | max:10'
        ]);

        // Add new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('password'),
            'is_active' => true,
            'is_online' => false
        ]);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
     * @param Request $request
     * @param $id
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        // Validate the requests
        $this->validate($request, [
            'name' => 'required | string | max:30',
            'email' => 'required | string | max:50',
            'role' => 'required | string | max:10'
        ]);

        // get user and update by id
        $updateUser = User::findOrFail($id);

        // new user details
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $updateUser->password,
            'is_active' => true,
            'is_online' => false
        ];

        $updateUser->update($data);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = false;
        $user->save();
    }
}
