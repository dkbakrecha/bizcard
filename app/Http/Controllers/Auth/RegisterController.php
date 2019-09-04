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
                    'name' => 'required|max:50',
                    'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
                    'phone' => 'required|digits:10|unique:users',
                    'password' => ['required', 'string', 'min:6', 'confirmed'],
                        ], [
                    'name.regex' => 'The service provider name format is invalid.',
                    'images.*.mimes' => 'Only jpeg, jpg, png, bmp formats are allowed.',
                    'images.*.max' => 'Photos not be grater then 1MB.',
                    'phone.unique' => 'The service provider phone number has already been taken.',
                    'phone.digits' => 'The service provider phone number must be 10 digits.',
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
                    'name' => $data['name'],
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

        //Update Services selection of shop
        if (!empty($data['services'])) {
            foreach ($data['services'] as $service_id) {
                $serviceData = Service::findOrFail($service_id);

                $_shopService = new ShopService();
                $_shopService->shop_id = $userCreated->id;
                $_shopService->service_id = $serviceData->id;
                $_shopService->unique_id = $serviceData->unique_id;
                $_shopService->category_id = $serviceData->category_id;
                $_shopService->name = $serviceData->name;
                $_shopService->category_id = $serviceData->category_id;
                $_shopService->duration = $serviceData->duration;
                $_shopService->price = $serviceData->price;
                $_shopService->save();
            }
        }

        // Save new service provider registration as a web notification
        // Fetch Admin user's user id
        $admin_user_id = $this->_admin_id();

        WebNotification::create([
            'notification_for' => $admin_user_id, // Admin
            'user_id' => $userCreated->id, // User who triggered the notification
            'event_type' => 0,
            'event' => 'New user ' . $userCreated->name . ' Registered',
        ]);

        //Mail To admin service provider information
        Mail::to('adminflair@harakirimail.com')->send(new ServiceProviderRegister($userCreated->id));

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
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        //$this->guard()->login($user);

        return redirect('/login')->with('success', __('messages.register_shop_success'));
    }

}
