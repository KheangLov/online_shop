<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth as AuthUser;
use Carbon\Carbon;

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
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated()
    {
        date_default_timezone_set('UTC');
 
        $user = AuthUser::user();
        $currentDate = Carbon::now();
        if ($user->password_type === 0 && $user->password_expires_at <= $currentDate) {
            AuthUser::logout();
            return redirect()->route('password_expired', ['id' => $user->id]);
        }
        $user->status = 'active';
        $user->last_login_at = $currentDate->toDateTimeString();
        $user->save();
        $user->update();
    }

    protected function logout()
    {
        $user = AuthUser::user();
        $user->status = 'inactive';
        $user->save();
        $user->update();
        AuthUser::logout();
		return redirect()->route('login');
    }
}
