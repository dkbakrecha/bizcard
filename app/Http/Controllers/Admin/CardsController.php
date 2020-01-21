<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use App\BookingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardsController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {
        $cards = Card::latest('created_at')
                ->get();

        return view('admin.cards.index', compact('cards'));
    }

    public function create($id = '', Request $request) {
        $categoryList = $this->getCategoryList();
        
        $cardData = array();
        if(!empty($id)){
            $cardData = Card::where('id', $id)->first();    
        }
        
        //echo $id; exit;
        if ($request->isMethod('post')) {
            $cardData = new Card();
            $cardData->status = 0; // Idle
            
            $cardData->business_category = $request->get('business_category');
            $cardData->business_name = $request->get('business_name');
            $cardData->business_person = $request->get('business_person');
            $cardData->slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($request->get('business_name'))));

            $cardData->address = $request->get('address');
            $cardData->email_address = $request->get('email_address');
            $cardData->contact_primary = $request->get('contact_primary');
            $cardData->contact_secondary = $request->get('contact_secondary');

            $cardData->description = $request->get('description');
            $cardData->keywords = $request->get('keywords');

            $cardData->facebook = $request->get('facebook');
            $cardData->instagram = $request->get('instagram');
            $cardData->linkedin = $request->get('linkedin');
            $cardData->twitter = $request->get('twitter');

            $cardData->user_id = 1; //Created by Admin
            $cardData->save();

            //
            return redirect('/admin/cards/create')->with('success', 'Card information update successfully!');
        }
        //echo "Asd"; exit;
        return view('admin/cards/create', compact('categoryList', 'cardData'));
    }
}