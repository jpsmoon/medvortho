<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Redirect;
use URL;
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
    protected $redirectTo = RouteServiceProvider::HOME;
    use AuthenticatesUsers;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    protected function authenticated(Request $request, $user)
    {
        $user->update([
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'last_login_ip' => $request->getClientIp()
        ]);
    }
    public function redirectTo()
      {
          if (Auth::check() && Auth::user()->roles->isEmpty()) {
              //return redirect()->route('login')->with('user_has_not_any_role', true);
              //return Redirect::to('login')->with('user_has_not_any_role');
             // return Redirect::to(URL::previous())->with('user_has_not_any_role');
          } 
          else {
            $role = Auth::user()->roles[0]['name']; 
            switch ($role) {
              case 'GlobalAdmin':
                return '/global/home';
                break;
              case 'SubAdmin' && 'Admin': 
                return '/subglobal/home';
                break;  
              default:
                return '/home'; 
              break;
            }
          }
      }
}
