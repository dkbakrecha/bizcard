<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function phonevalidation(Request $request){
        $token = str_pad(mt_rand(1000, 9999), 4 , "0",STR_PAD_LEFT) ;
        $reqData = $request->all();

        $validator = Validator::make($reqData, [
            'phone' => 'required|digits:10',
                ]);  

        $phoneCheck = 0;
        if(!empty($reqData['phone'])){
            $phoneCheck = User::Where('phone',$reqData['phone'])->count();    
        }

        if($phoneCheck == 0 && $request->isMethod('post'))
        {
            $validator->after(function($validator) {
                $validator->errors()->add('phone', 'There is no phone number register with account. Please check your phone number.');
            });

        }

        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator->errors());
        }

        $userData = User::where('phone', $reqData['phone'])->first();
        $userData->token = $token;
        $userData->save();
        $_st = base64_encode($token  . "_" . $reqData['phone']);

        $MSG91 = new MSG91();
        $bizCode = array();
        $bizCode['number'] = $userData->phone;
        $bizCode['optcode'] = $userData->token;

        $msg91Response = $MSG91->send_sms($bizCode);

        return redirect()->route('resetpassword', ['token' => $_st]);
    }
}