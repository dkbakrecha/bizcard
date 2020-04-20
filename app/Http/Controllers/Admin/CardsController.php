<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use App\BookingService;
use Illuminate\Http\Request;
use Image;
use App\Http\Controllers\Controller;

class CardsController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {
        $cards = Card::latest('created_at')->get();

        return view('admin/cards/index', compact('cards'));
    }

    public function create(Request $request) {
        $categoryList = $this->getCategoryList();
        return view('admin/cards/create', compact('categoryList'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'business_category' => 'required',
            'business_name' => 'required|max:50',
            'business_person' => 'required|max:50',
        ]);

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

        return redirect()->route('admin.cards.index')->with('success','User created successfully.');
    }


    public function edit($id)
    {
        $cardData = Card::find($id);
        $categoryList = $this->getCategoryList();
        return view('admin/cards/edit', compact('cardData', 'id', 'categoryList'));
    }

    public function view($id)
    {
        $cardData = Card::find($id);

            // get previous user id
            $previous = Card::where('id', '<', $id)->max('id');
            // get next user id
            $next = Card::where('id', '>', $id)->min('id');

        return view('admin/cards/view', compact('cardData', 'id', 'previous', 'next'));
    }

    public function savecard(Request $request)
    {
        $image = Image::make($request->get('imgBase64'));
        $imagename = $request->get('image_name');
        
        $image->save('public/images/cards/'. $imagename . '.jpg');
        echo "done"; exit;
    }

    public function update($id, Request $request)
    {
        $cardData = Card::find($id);
        
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

        $cardData->user_id = $request->get('user_id');  
        $cardData->status = $request->get('status');
        $cardData->save();

        /*$userData->save();
                $request->validate([
                'name' => 'required',
                'email' => 'required',
         ]);*/
        //$userData->update($request->all());
  
        return redirect()->route('admin.cards.index')->with('success','Card update successfully.');
    }

    public function destroy($id)
    {
        Card::find($id)->delete();
  
        return redirect()->route('admin.cards.index')->with('success','Card delete successfully');
    }
}