<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Contact; 

/* For mail */
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
	public function __construct() {
        $this->middleware('auth:web')->except(['getContact', 'saveContact']);
    }

    public function getContact() { 
       return view('contact_us'); 
    } 

    public function saveContact(Request $request) { 
        $this->validate($request, [
            'name' => 'required',
            'email_address' => 'required|email',
            'subject' => 'required',
            'phone_number' => 'required',
            'message' => 'required'
        ]);

        //$contact = new Contact;

        //$contact->name = $request->name;
        //$contact->email = $request->email;
        //$contact->subject = $request->subject;
        //$contact->phone_number = $request->phone_number;
        //$contact->message = $request->message;

        //$contact->save();

        //Mail To admin user information
        Mail::to('dkb4biz@gmail.com')->send(new ContactUs($request));
        
        return back()->with('success', 'Thank you for contact us!');
    }
}