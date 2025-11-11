<?php

namespace App\Http\Controllers;

//use Auth;
use App\Models\User;
use App\Models\Organization;
use App\Models\LicenseKey;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Mail\SendResetEmail;
use App\Mail\PasswordChangedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LoginController
{
    /**
     * @return Factory|View
     */
    public function login()
    {
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
        
        if(Auth::attempt($credentials, $remember)){
            $user = Auth::user();
            session(['user' => $user]);
            
            return redirect('/assets');
        } else {
            // Authentication failed, display an error message
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

    }

    public function forgotPassword(Request $request)
    {
        return view('auth.passwords.email')->with(
            ['email' => $request->email]
        );
    }

    public function showResetForm(Request $request, $token)
    {
        $user = User::where('email', $request->email)->first();
        $isTokenValid = Password::broker()->tokenExists($user, $token);

        if ($isTokenValid) {
            return view('auth.passwords.confirm')->with(
                ['token' => $token, 'email' => $request->email]
            );
        } else {
            return view('auth.passwords.invalidLink');
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);
        
        $response = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Here, you can update the user's password
                $user->password = bcrypt($password);
                $user->save();
            }
        );

        // Check if the password reset was successful
        if ($response == Password::PASSWORD_RESET) {
            // Send an email notification
            $user = User::where('email', $request->email)->first();
            $username = $user->name;
            Mail::to($request->email)->send(new PasswordChangedEmail($username));
            Log::channel('emaillog')->info("Email password changed has been sent to '" . $user->email . "'.");

            return view('auth.passwords.passwordChanged');
        } else {
            return back()->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
        }
    }

    public function sendResetEmail(Request $request)
    {
        try {
            // Validate the email input
            $request->validate(['email' => 'required|email']);

            // Generate a password reset token
            $user = User::where('email', $request->email)->first();

            if ($user) {
                // Generate a password reset token for the user
                $token = Password::createToken($user);

                // Generate the reset link using the 'password.reset' named route
                $resetLink = route('password.reset', ['token' => $token, 'email' => $user->email]);
                Mail::to($request->email)->send(new sendResetEmail($resetLink));
                Log::channel('emaillog')->info("Email reset password has been sent to '" . $request->email . "'.");

                return view('auth.passwords.resetEmailSent');
            } else {
                Log::channel('emaillog')->info("Unable to send the email reset password to '" . $request->email . "'.");

                return view('auth.passwords.email')->with([
                    'email' => $request->email,
                    'status' => 'Email does not exist!'
                ]);                
            }
        } catch (\Exception $e) {
            Log::channel('emaillog')->error($e->getMessage());

            return view('auth.passwords.email')->with([
                'email' => $request->email,
                'status' => $e->getMessage()
            ]); 
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect ('/');
    }

    public function register()
    {
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
