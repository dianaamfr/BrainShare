<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login with some processing.
     *
     * @return string
     */
    protected function redirectTo(): string {
        session()->forget("message");
        session(["message" => "Logged with success!"]);

        if (auth()->user()->user_role == "Administrator" || auth()->user()->user_role == "Moderator") {
            return '/admin/tags';
        }

        return '/search';
    }

    public function getUser()
    {
        return $request->user();
    }

    public function home()
    {
        return redirect('home');
    }

}
