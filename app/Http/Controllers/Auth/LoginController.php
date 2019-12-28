<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessTokenResource;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function GuzzleHttp\json_decode;

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
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $respone = $this->getAccessTokenProxy($request);
        return 500 === $respone->getStatusCode() ? $respone :
            new AccessTokenResource(
                collect(
                    transform($respone->getContent(), 'json_decode')
                )->put('user', $user)
            );
    }

    /**
     * Get the access token
     */
    protected function getAccessTokenProxy(Request $request)
    {
        $request->request->add($this->defaultClient());

        $proxy = Request::create('oauth/token', 'POST', $request->all());

        return Route::dispatch($proxy);
    }

    /**
     * Get the default passport client for current app.
     *
     * @param Boolean $isRefreshType
     * @return Array $client
     */
    protected function defaultClient(bool $isRefreshType = false)
    {
        $client = config('passport.default_client');
        if ($isRefreshType) {
            $client = array_merge($client, ['grant_type' => 'refresh_token']);
        }
        return $client;
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return collect(['staff_code', 'email', 'phone'])->contains(function ($field) use ($request) {
            $account = $request->get($this->username());
            $password = $request->get('password');
            return $this->guard()->attempt([$field => $account, 'password' => $password], $request->filled('remember'));
        });
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }
}
