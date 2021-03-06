<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;

class LoginController extends Controller {
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        // Get URLs
        $urlPrevious = url()->previous();
        $urlBase = url()->to('/');

        // Set the previous url that we came from to redirect to after successful login but only if is internal
        if(($urlPrevious != $urlBase . '/login') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
            session()->put('url.intended', $urlPrevious);
        }

        return view('auth.login');
    }

    public function login(Request $request) {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);


        /* $is_remember = 0;
          if(isset($request->remember)){
          $is_remember = 1;
          } */
        $req = array();
        $req['password'] = $request->get('password');
        if(is_numeric($request->get('email'))){
          $req['phone'] = $request->get('email');
        }else{
          $req['email'] = $request->get('email');
        }

        //return $request;
        // Attempt to log the user in
        if (Auth::guard('web')->attempt($req, $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(session()->get('url.intended'));
               // return redirect()->intended('defaultpage');

            
        }
        // if unsuccessful, then redirect back to the login with the form data
        //return redirect()->back()->withInput($request->only('email', 'remember'));
        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request) {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = User::where($this->username(), $request->{$this->username()})->first();
        //print_r($errors); exit;
        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.
        if ($user && \Hash::check($request->password, $user->password)) {
            if ($user->status == 0) {
                $errors = [$this->username() => trans('Your shop account is blocked by admin, please contact support team for more details.')];
            }
        }

        //print_r($user); exit;
        if (!empty($user)) {
            $errors = ['password' => trans('Your login credentials are invalid.')];
        }else{
          $errors = [$this->username() => trans('Your login credentials are invalid.')];
        }

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
        return redirect()->back()
                        ->withInput($request->only($this->username(), 'remember'))
                        ->withErrors($errors);
    }
    
    public function logout() {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}