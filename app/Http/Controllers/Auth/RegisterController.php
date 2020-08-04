<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use File;
use App\ShopImage;
use App\Service;
use App\ShopService;
use Illuminate\Http\Request;
use App\WebNotification;
use App\MSG91;

/* For mail */
use App\Mail\Admin\ServiceProviderRegister;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        return Validator::make($data, [
                    //'name' => 'required|max:50',
                    'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
                    'phone' => 'required|digits:10|unique:users',
                    //'password' => ['required', 'string', 'min:6', 'confirmed'],
                        ], [
                    'name.regex' => 'The service provider name format is invalid.',
                    'images.*.mimes' => 'Only jpeg, jpg, png, bmp formats are allowed.',
                    'images.*.max' => 'Photos not be grater then 1MB.',
                    'phone.unique' => 'The phone number has already been taken.',
                    'phone.digits' => 'The phone number must be 10 digits.',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {

       
        $userCreated = User::create([
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
            'status' => '3' // Pending
        ]);
        
        //prd($userCreated);

        /* Insert Shop Images */
        if (!empty($data['images'][0])) {
            $destinationPath = public_path() . '/images/shop';
            //echo $destinationPath;

            foreach ($data['images'] as $key => $image) {
                $extension = $image->getClientOriginalExtension();
                $image_name = "Shop" . $userCreated->id . "_" . time() . mt_rand(1000, 9999) . "." . $extension;
                //$image_name = $image->getClientOriginalName();
                $image->move($destinationPath, $image_name);

                $_shopImage = new ShopImage();
                $_shopImage->shop_id = $userCreated->id;
                $_shopImage->filename = $image_name;
                $_shopImage->save();
            }
        }

        // Save new service provider registration as a web notification
        // Fetch Admin user's user id
        $admin_user_id = $this->_admin_id();

        WebNotification::create([
            'notification_for' => $admin_user_id, // Admin
            'user_id' => $userCreated->id, // User who triggered the notification
            'event_type' => 0,
            'event' => 'New user ' . $userCreated->name . ' Registered into system',
        ]);

        //Mail To admin user information
        Mail::to('dkb4biz@gmail.com')->send(new ServiceProviderRegister($userCreated->id));

        return $userCreated;
    }

    protected function registerUser(array $data) {
        //echo "<pre>";
        //print_r($data);
        //exit();
        $userData = User::where('phone', $data['phone'])->first();
        $token = str_pad(mt_rand(1000, 9999), 4 , "0",STR_PAD_LEFT) ;
        
        if(empty($userData)){
          $this->validator($data)->validate();
        
          $userCreated = User::create([
              'email' => $data['email'],
              'phone' => $data['phone'],
              'token' => $token,
              'is_phone_verified' => 0,
              //'password' => Hash::make($data['password']),
              'status' => '3' // Pending
          ]);  
        }else{
          $userCreated = $userData;
        }

        
        
        //prd($userCreated);     
        return $userCreated;
    }

    /*
      public function showRegistrationForm() {
      $id = 143;
      Mail::to('adminflair@harakirimail.com')->send(new ServiceProviderRegister($id));
      return "=====";
      //return view('auth.register');
      }
     * */

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        

        $user = $this->registerUser($request->all());

        if($user->is_phone_verified == 0){
          //return redirect('auth/verifyuser', compact('user'));
          session(['registerUser' => $user]);

          return redirect()->route('verifyuser');
        }
        //echo "<pre>";
        //print_r($user->toArray());
        //exit;

        //$user = $this->create($request->all());
        //return view('auth/verifyuser', compact('user'));
        //$this->guard()->login($user)->with('success', __('Your account has been successfully registered. Please verify your account email.'));
    }


    public function verifyuser(Request $request) {
        
        
        $rUser = session('registerUser');
        $userData = User::where('phone', $rUser->phone)->first();
        $token = str_pad(mt_rand(1000, 9999), 4 , "0",STR_PAD_LEFT) ;
        $reqData = $request->all();

        if(!empty($reqData)){
          $validator = Validator::make($reqData, [
            'password' => [
                  'required',
                  'string',
                  'min:6',             // must be at least 10 characters in length
                  'regex:/[a-z]/',      // must contain at least one lowercase letter
                  'regex:/[0-9]/',      // must contain at least one digit
              ],
            'phone' => 'required|digits:10',
            'otp' => 'required|digits:4|in:'.$rUser->token,
                ], [
            'otp' => 'Please enter valid OTP.',
            'password.regex' => 'Password must have at least, 6 characters with 1 number'
          ]);

          if ($validator->fails())
          {
              return redirect()->back()->withErrors($validator->errors());
          }

          //OPT Success
          $userData->token = 1;
          $userData->is_phone_verified = 1;
          $userData->status = 1;
          $userData->password = Hash::make($reqData['password']);
          $userData->save();

          session(['registerUser' => ""]);
          $this->guard()->login($userData);
          // Save new service provider registration as a web notification
        // Fetch Admin user's user id
        $admin_user_id = $this->_admin_id();

        WebNotification::create([
            'notification_for' => $admin_user_id, // Admin
            'user_id' => $userData->id, // User who triggered the notification
            'event_type' => 0,
            'event' => 'New user ' . $userData->name . ' Registered into system',
        ]);

          Mail::to('dkb4biz@gmail.com')->send(new ServiceProviderRegister($userData->id));
          
          return redirect()->to('home')->with('success', __('Your account has been successfully registered.'));
        }else{
          if(!empty($rUser) || $rUser->status == 3){
            //If user is not verify then enter
            if($rUser->is_phone_verified == 0 && empty($rUser->token)){
              //If token is not generated then generate token
              $userData->token = $token;
              $rUser->token = $token;
              $userData = $userData->save();
            }

            $MSG91 = new MSG91();
            $bizCode = array();
            $bizCode['number'] = $userData->phone;
            $bizCode['optcode'] = $userData->token;

            $msg91Response = $MSG91->send_sms($bizCode);

            return view('auth/verifyuser', ['user' => $rUser]);    
          }  
        }
        
        
      return view('auth/verifyuser', ['user' => $rUser]);    
    }
      

}
