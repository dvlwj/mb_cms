<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
     * @var array
     */
    protected $responseData = [
        "message"  => null,
        "redirect" => null
    ];

    /**
     * @var int
     */
    protected $httpCode;

    /**
     * @var array
     */
    protected $input = [];

    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'isLoggedIn']);
    }

    public static function isLoggedIn()
    {
        return response()->json([session('is_logged_in')], 200);
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }

    protected function validateLogin()
    {
        if (isset($_POST['request'])) {
            $this->input = json_decode($_POST['request'], true);
            if (isset($this->input['username'], $this->input['password'])) {
                return true;
            }
        }
        abort(403, "Forbidden action");
    }

    protected function attemptLogin(Request $request)
    {
        $a = $this->input;

        // debug only
        // $a = [
        //     "username" => "admin",
        //     "password" => "123"
        // ];

        if (isset($a['username'], $a['password'])) {
            if ($this->guard()->attempt(
                ['username' => $a['username'], 'password' => $a['password']],
                $request->filled('remember')
            )) {
                $request->session()->regenerate();
                $this->httpCode = 200;
                $this->responseData['message'] = "Login success!";
                $this->responseData['redirect'] = route('index');
                session(['is_logged_in' => true]);
                return $this->guard()->attempt(
                    [
                        "username" => $a['username'],
                        "password" => $a['password']
                    ]
                );
            } else {
                $this->httpCode = 401;
                $this->responseData['message'] = "Wrong username or password";
                return false;
            }
        }
        $this->httpCode = 403;
        $this->responseData['message'] = "Forbidden";
        return false;
    }
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        return response()->json($this->responseData, $this->httpCode);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json($this->responseData, $this->httpCode);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->middleware('guest')->except('logout');

        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($this->input['username'].'|'.$request->ip());
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'username';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];
    }
}
