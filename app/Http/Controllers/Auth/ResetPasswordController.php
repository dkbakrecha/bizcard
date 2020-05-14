<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset requests
      | and uses a simple trait to include this behavior. You're free to
      | explore this trait and override any methods you wish to tweak.
      |
     */

use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    protected function resetPassword_old($user, $password) {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));

        //$this->guard()->login($user);
    }

    public function showPasswordResetForm($token)
    {
      $tData = explode ("_", base64_decode($token));
      $userData = User::where('phone', $tData[1])->first();
      
      if ( !$userData ) return redirect()->to('home'); //redirect them anywhere you want if the token does not exist.
      return view('auth.passwords_show')->with(['user'=> $userData, 'token' => $token]);
    }


    public function resetPassword(Request $request, $token)
    {
      $reqData = $request->all();
      $tData = explode ("_", base64_decode($token));
      $userData = User::where('phone', $tData[1])->first();

      $validator = Validator::make($reqData, [
            'password' => [
                  'required',
                  'string',
                  'min:6',             // must be at least 10 characters in length
                  'regex:/[a-z]/',      // must contain at least one lowercase letter
                  'regex:/[A-Z]/',      // must contain at least one uppercase letter
                  'regex:/[0-9]/',      // must contain at least one digit
                  'regex:/[@$!%*#?&]/', // must contain a special character
              ],
            'otp' => 'required|digits:4|in:'.$tData[0],
                ], [
            'otp' => 'Please enter valid OTP.',
            'password.regex' => 'Password must have at least, 6 characters with 1 upper case, 1 number, and 1 special character'
          ]);  

      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator->errors());
      }

      if ( !$userData ) return redirect()->to('home'); //or wherever you want

       $userData->password = Hash::make($request->password);
       $userData->token = 1;
       $userData->update(); //or $user->save();

       //do we log the user directly or let them login and try their password for the first time ? if yes 
       //redirect where we want according to whether they are logged in or not.
       //Auth::login($userData);
       $this->guard()->login($userData);
        //return redirect()->to('home'); //or wherever you want       
        return redirect()->to('home')->with('success', __('Your password has been reset successfully .'));
      // If the user shouldn't reuse the token later, delete the token 
     // DB::table('password_resets')->where('email', $user->email)->delete();

      
    }

}