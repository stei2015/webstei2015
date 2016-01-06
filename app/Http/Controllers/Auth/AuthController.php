<?php

namespace App\Http\Controllers\Auth;


use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    use ThrottlesLogins;

    protected $redirectLogin = '/';
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
    protected function loginUsername()
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
     * Requires $this->usernameField, password, remember request fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            $this->usernameField => 'required', 'password' => 'required',
        ]);

        // Check whether this controller is using ThrottlesLogins trait
        $throttles = in_array(ThrottlesLogins::class, class_uses_recursive(get_class($this)));

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $request->only($this->usernameField, 'password');

        // Try to authenticate using username or NIM

        if (Auth::attempt(['username' => $request[$this->usernameField], 'password' => $request['password']], $request->has('remember')) 
            || Auth::attempt(['nim' => $request[$this->usernameField], 'password' => $request['password']], $request->has('remember'))) {

            // Authentication successful

            if ($throttles) {
                $this->clearLoginAttempts($request);
            }

            return redirect()->intended($this->redirectLogin);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        $failedLoginMessage = Lang::has('auth.failed') ? Lang::get('auth.failed') : 'These credentials do not match our records.';

        return redirect()->back()
            ->withInput($request->only($this->usernameField, 'remember'))
            ->withErrors([
                $this->usernameField => $failedLoginMessage,
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
            'regcode' => config('app.regcode') ? 'required|same:'.config('app.regcode') : '',
        ]);;

        $newUser = User::create([
            'nim' => $request['nim'],
            'username' => $request['username'],
            'password' => bcrypt($request['password']),
        ]);

        Auth::login($newUser);

        return redirect($this->redirectRegister);
    }

    /**
     * Logs out the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect($this->redirectLogout);
    }

}
