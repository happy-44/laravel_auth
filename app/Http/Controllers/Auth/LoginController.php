<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $superadminRedirectTo = '/dashboard';
    protected $adminRedirectTo = '/admindashboard';
    protected $userRedirectTo = '/userdashboard';


    /**
     * Redirect the user after determining they are superadmin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->isSuperadmin()) {
            return redirect($this->superadminRedirectTo);
        } else if ($user->isAdmin()) {
            return redirect($this->adminRedirectTo);
        } else if ($user->isUser()) {
            return redirect($this->userRedirectTo);
        }
    
        return redirect()->intended($this->redirectPath());
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function logout(Request $request){
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
