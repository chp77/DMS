<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationToManageCMS;

class UserController
{
    use ValidatesRequests;

    /**
     * @return mixed
     */
    public function index()
    {
        try {
            $currentUser = Auth::user();

            $data = DB::table('users as u')
                        ->select(
                            DB::raw('ROW_NUMBER() OVER (ORDER BY u.id) AS row_number'),
                            'u.id',
                            'u.name',
                            'u.email',
                            'u.created_at',
                            'u.updated_at',
                            'u.is_suspended',
                        )
                        ->where('u.is_active', true)
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
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validate the requests
        $this->validate($request, [
            'name' => 'required | string | max:150',
            'email' => 'required | string | max:150',
            'password' => 'required | string | max:100',
            'confirm_password' => 'required | string | max:100',
        ]);

        try {
            // check user email
            $userExisted = User::where('email', '=', $request->email)->where('is_active', true)->get();

            if ($userExisted->count() > 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'The email has been registered!']);
            }

            if (empty($request->password) || empty($request->confirm_password) || ($request->password != $request->confirm_password)) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'The password/confirm password does not match!']);
            }

            // Add new user
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_active' => true,
                'is_email_notification' => true
            ]);

            Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just added a new user: ' . $newUser . '.');
    
            Mail::to($request->email)->send(new InvitationToManageCMS($recipient = $request->email, $sender = $user->email, $password = $request->password));
            
            Log::channel('emaillog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just sent the email invitation to user: '
                . $request->email . ' to manage the AMS.');

            return response(['statusCode' => Response::HTTP_OK, 'response' => $newUser]);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

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
            if (!empty($id)) {
                $user = User::findOrFail($id);
                return response(['statusCode' => Response::HTTP_OK, 'data' => $user]);
            } else {
                return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'Required parameter "id" is missing!']);
            }
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR]);
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
     * @param Request $request
     * @param int $id
     * @throws ValidationException
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
            $targetUser = User::findOrFail($id);

            if ($targetUser->count() === 0) {
                return response(['statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY, 'error' => 'User not found!']);
            }
            
            $targetUserId = $targetUser->id;
            $targetUserPass = $targetUser->password;

            // user details
            if ((empty($request->password) && empty($request->confirm_password)) || Hash::check($request->password, $targetUserPass)) {
                $data = [
                    'name' => $request->name,
                    'updated_at' => new \DateTime(),
                ];
            } else {
                $data = [
                    'name' => $request->name,
                    'password' => bcrypt($request->password),
                    'updated_at' => new \DateTime(),
                ];
            }

            $targetUser->update($data);

            Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just updated the user details: user - ID ' . $targetUserId . '...');

            return response(['statusCode' => Response::HTTP_OK, 'response' => $targetUser]);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $user = Auth::user();

            if ($user->count() > 0) {
                $user = User::findOrFail($id);
                $user->is_active = false;
                $user->updated_at = new \DateTime();
                $user->save();
        
                Log::channel('actionlog')->info('User ' . $user->name . ' with ID - ' . $user->id . ' just deleted the user ID - ' . $id);
            
                return response(['statusCode' => Response::HTTP_OK, 'response' => 'User deleted']);
            }
        
            return response(['statusCode' => Response::HTTP_NOT_FOUND, 'error' => 'The required parameter for "user ID" are missing!']);
        } catch (\Exception $e) {
            Log::channel('systemlog')->error($e->getMessage());

            return response(['statusCode' => Response::HTTP_INTERNAL_SERVER_ERROR, 'error' => $e->getMessage()]);
        }
    }
}
