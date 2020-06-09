<?php

namespace App\Http\Controllers;

use Auth;
use App\Card;
use App\Search;
use App\CardViews;
use Illuminate\Http\Request;

class CardsController extends Controller {

    public function __construct() {
        $this->middleware('auth:web')->except(['view','viewnew','searchsugg']);
    }

    public function index() {
        $offers = ShopOffer::latest('shop_offers.created_at')
                ->where('shop_id', '=', $this->_shop_id())
                ->where(function ($query) {
                    $query->where('status', '=', 1) //Active
                    ->orWhere('status', '=', 3) //Pending
                    ->orWhere('status', '=', 2) //Inactive
                    ->orWhere('status', '=', 0); //Rejected
                })
                ->paginate(20);
        //prd($services);
        return view('offers.index', compact('offers'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    public function create() {
        $categoryList = $this->getCategoryList();

        //        $cardData = Card::findOrFail($request->id);
        $cardData = Card::where('user_id', Auth::user()->id)->first();
//pr($cardData);

        return view('cards.create', compact('categoryList', 'cardData'));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'business_category' => 'required',
                    'business_name' => 'required|max:50',
                    'business_person' => 'required|max:50',
        ]);

        $cardData = Card::where('user_id', Auth::user()->id)->first();
        if (empty($cardData)) {
            $cardData = new Card();
            $cardData->status = 0; // Idle
        }

        //prd($request->get('review-submit'));
        if($request->get('review-submit') == "yes"){
            $cardData->status = 3; // Verification pending
            $cardData->slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($request->get('business_name'))));
        }

        $cardData->business_category = $request->get('business_category');
        $cardData->business_name = $request->get('business_name');
        $cardData->business_person = $request->get('business_person');

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

        $cardData->area_id = $request->get('area_id');

        $cardData->user_id = Auth::user()->id;
        $cardData->save();
        /*
          // Send Offer create Web Notification to Admin User
          $shop_id = $this->_shop_id();
          $admin_user_id = $this->_admin_id();

          // SAVE BOOKING AS WEB NOTIFICATION FOR SERVICE PROVIDER AND THEIR SUPERVISORS
          // Get Shop user details
          $shop = \App\User::find($shop_id);

          // Save notification for Admin USer
          \App\WebNotification::create([
          'notification_for' => $admin_user_id,
          'user_id' => $shop_id,
          'event_type' => 4, // Offer created by shop
          'event' => 'Offer created by ' . $shop->name,
          ]);

          if ($request->hasFile('offer_image')) {
          $file = $request->offer_image;
          $_filename = "offer_" . $shopOffer->id . ".png";
          $destinationPath = public_path() . '/images/offer/';
          $file->move($destinationPath, $_filename);

          $shopOffer->offer_image = $_filename;
          $shopOffer->save();
          }
         */
        return redirect('/cards/create')->with('success', 'Card information update successfully!');
        //return response()->json(['success' => __('messages.offer_success_create')]);
    }

    public function view($cardslug)
    {
        $card = Card::where('slug', $cardslug)->with(['category','contact' => function ($contact){
                    $contact->where('user_id', Auth::id());
        }])->first();
        $otherCards = Card::inRandomOrder()->with(['category','contact' => function ($contact){
                    $contact->where('user_id', Auth::id());
        }])
            ->where('status', 1)->take(3)->get()->toArray();


        CardViews::createViewLog($card);


        if(empty($card)){
            return redirect()->action('HomeController@index');
        }else{
            return view('cards.view', compact('card', 'otherCards'));
        }
    }

     public function viewnew($cardslug)
    {
        $card = Card::where('slug', $cardslug)->with(['category','contact' => function ($contact){
                    $contact->where('user_id', Auth::id());
        }])->first();
        $otherCards = Card::inRandomOrder()->with(['category','contact' => function ($contact){
                    $contact->where('user_id', Auth::id());
        }])
            ->where('status', 1)->take(3)->get()->toArray();



        if(empty($card)){
            return redirect()->action('HomeController@index');
        }else{
            return view('cards.viewnew', compact('card', 'otherCards'));
        }
    }

    public function update(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'title' => 'required|max:50',
                    'description' => 'required',
                    'services' => 'required',
                    'price' => 'required|numeric',
                    'days' => 'required|numeric|between:1,365',
                        ], [
                    'offer_image.mimes' => __('messages.image_format_validate'),
                    'offer_image.max' => __('messages.image_size_validate'),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $shopOffer = ShopOffer::findOrFail($request->id);

        if ($shopOffer->status != 3) {
            return response()->json(['errors' => [__('messages.offer_edit_validate')]]);
        }

        $shopOffer->title = $request->get('title');
        $shopOffer->description = $request->get('description');
        $shopOffer->services = implode(",", $request->get('services'));

        if ($request->hasFile('offer_image')) {
            $file = $request->offer_image;
            $_filename = "offer_" . $request->id . ".png";
            $destinationPath = public_path() . '/images/offer/';
            $file->move($destinationPath, $_filename);

            $shopOffer->offer_image = $_filename;
        }

        $shopOffer->price = $request->get('price');
        $shopOffer->days = $request->get('days');

        $cardData->area_id = $request->get('area_id');
        $shopOffer->save();

        return response()->json(['success' => __('messages.offer_success_update')]);
    }

    public function getOffer(Request $request) {
        $offerId = $request->id;
        $offerData = ShopOffer::findOrFail($offerId);

        $services = \App\Service::whereIn('id', explode(',', $offerData->services))
                        ->select('name')
                        ->get()->toArray();

        $offerData->services = explode(',', $offerData->services);



        return response()->json(['data' => $offerData, 'services' => $services]);
    }

    public function getOfferPrice(Request $request) {
        $service_Ids = $request->ids;

        $servicesData = \App\ShopService::WhereIn('service_id', $service_Ids)
                        ->where('shop_id', '=', $this->_shop_id())->sum('price');

        return $servicesData;
    }

    public function offer_delete(Request $request) {
        $shopOffer = ShopOffer::findOrFail($request->offer_id);

        if ($shopOffer->status != 3) {
            return redirect('offers')->with('error', __('messages.offer_delete_validate'));
        }

        ShopOffer::find($request->offer_id)->delete();
        return redirect('offers')->with('success', __('messages.offer_success_delete'));
    }


    public function searchsugg(Request $request){

      $search = $request->search;

      if($search == ''){
         $searches = Search::orderby('search_text','asc')->select('id','search_text')->limit(5)->get();
      }else{
         $searches = Search::orderby('search_text','asc')->select('id','search_text')->where('search_text', 'like', '%' .$search . '%')->limit(5)->get();
      }

      $response = array();
      foreach($searches as $s){
         $response[] = array("value"=>$s->id,"label"=>$s->search_text);
      }

      echo json_encode($response);
      exit;
   }

}
