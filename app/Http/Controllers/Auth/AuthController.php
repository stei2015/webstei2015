<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Lang;

class AuthController extends Controller
{
    use ThrottlesLogins;

    protected $redirectLogin = '/dashboard';
    protected $redirectLogout = '/login';
    protected $redirectRegister = '/studentdata';
    protected $usernameField = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get login username field for the ThrottlesLogins trait.
     *
     * @return string
     */
    protected function getLoginUsername()
    {
        return property_exists($this, 'usernameField') ? $this->usernameField : 'username';
    }


    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     * Requires $usernameField, password, remember request fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            $usernameField => 'required', 'password' => 'required',
        ]);

        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only($usernameField, 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {

            // Authentication successful

            if ($throttles) {
                $this->clearLoginAttempts($request);
            }

            return redirect()->intended($redirectLogin);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        $failedLoginMessage = Lang::has('auth.failed') ? Lang::get('auth.failed') : 'These credentials do not match our records.';

        return redirect()->back()
            ->withInput($request->only($usernameField, 'remember'))
            ->withErrors([
                $usernameField => $failedLoginMessage,
            ]);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|numeric|min:16515001|max:16515500|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'regcode' => 'required|same:stei2015'
        ]);;

        $newUser = User::create([
            'nim' => $request['nim'];
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
        ]);

        Auth::login($newUser);

        return redirect($redirectRegister);
    }

    /**
     * Logs out the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect($redirectLogout);
    }

}
