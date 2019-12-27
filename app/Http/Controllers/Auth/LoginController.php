<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
     * Login action.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $request->request->add($this->defaultClient());

        $proxy = Request::create('oauth/token', 'POST', $request->all());

        return Route::dispatch($proxy);
    }

    public function logout(Request $request)
    {
        return $request->user()->token()->revoke();
    }

    /**
     * Get the default passport client for current app.
     *
     * @param Boolean $isRefreshType
     * @return Array $client
     */
    protected function defaultClient(bool $isRefreshType = false)
    {
        $client = config('password.default_client');
        if ($isRefreshType) {
            $client = array_merge($client, ['grant_type' => 'refresh_token']);
        }
        return $client;
    }
}
