<?php

namespace App\Http\Controllers;

use Auth;
use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller {

    public function __construct() {
        $this->middleware('auth:web')->except([]);
    }

    public function index() {
        $userId = Auth::user()->id;

        $contacts = Contact::Where('user_id', '=', $userId)
                ->where('status', '=', 1)
                ->with(['card'])
                ->get()->toArray();
        
        return view('contacts.index', compact('contacts'));
    }

    public function addToContact(Request $request) {
        $cardId = $request->id;
        $userId = Auth::user()->id;
        
        $contactData = Contact::Where('user_id', '=', $userId)->where('card_id', '=', $cardId)->first();



        if(empty($contactData)){
            $contactData = new Contact();
            $contactData->card_id = $cardId;
            $contactData->user_id = $userId;
            $contactData->status = 1; // Pending
            
        }else{
            if($contactData->status == 1){
                $contactData->status = 0;
            }else{
                $contactData->status = 1;
            }
        }

        $contactData->save();

        echo $contactData->status; exit;
    }

}