<?php

namespace App\Http\Controllers;

//use Auth;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * @return Factory|View
     */
    public function login(){
        return view('auth.login');
    }

    public function postlogin(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            $user = Auth::user();
            session(['user' => $user]);
            
            return redirect('/dashboard');
        }

        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect ('/');
    }

    public function register(){
       return view('auth.register');
    }

    public function registeruser(Request $request)
    {
        // Validate the requests
        $this->validate($request, [
            'name' => 'required | string | max:30',
            'email' => 'required | string | max:50',
            'password' => 'required | string | max:10',
            'password_confirmation' => 'required | string | max:10'
        ]);
        
        $password = $request->password;
        $confirmPassword = $request->password_confirmation;

        // Validate pass
        if ($request->isMethod('POST') && $password == $confirmPassword && !empty($confirmPassword) && !empty($password)) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($password),
                'remember_token' => Str::random(60),
                'is_active' => true,
                'is_online' => false,
                'role' => 'Agent'
            ]);

            return redirect('/login');
        } else {
            return redirect('/register');
        }
    }
}
