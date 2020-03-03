<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected $decayMinutes = 10;

    /**
     * Where to redirect users after login.
     */
    protected function redirectTo(){
        if(auth()->user()->tipe_akun=='10'){
            return route('admin.dashboard');
        }else if(auth()->user()->tipe_akun=='1'){
            return route('dashboard');
        }else{
            return route('dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function showLoginForm()
    {
        return view('user.login');
    }
    public function username()
    {
        return "username";
    }

    protected function credentials(Request $request)
    {
        if (filter_var($request->post($this->username()),FILTER_VALIDATE_EMAIL))
            return [
                'email' => $request->post($this->username()),
                'password' => $request->post('password')
            ];
        return $request->only($this->username(), 'password');
    }
}
