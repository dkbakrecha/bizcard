<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use App\Card;
use App\Item;
use App\Search;
use App\Http\Controllers\Admin\ProviderController;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:web')->except(['appCalcellation', 'terms', 'front', 'search' , 'marketplace', 'productshow','aboutus', 'features', 'tcbot']);
    }

    public function tcbot(){
        $token = "1077497893:AAFXRJ8w-0wmWlB-EgH_kYyLnt0H-MMCsZ4";
        $website = "https://api.telegram.org/bot" . $token;

        //If webhook not set
        //$_update = $this->file_get_contents($website . "/getUpdates");
        $_update = file_get_contents("php://input");
        $updateArray = json_decode($_update, TRUE);

        $chat_id = $updateArray['result'][0]['message']['chat']['id'];

        $msg = "Welcome To CardBiz";

        $request_param = [
            'chat_id' => $chat_id,
            'text' => $msg
        ];

        $requestUrl =  $website . "/sendMessage?" . http_build_query($request_param);

        $this->file_get_contents_curl($requestUrl);

        echo "---"; exit;
    }

    function file_get_contents_curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_URL, $url);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function front() {
        $resentCards = Card::latest('created_at')->with(['category','contact' => function ($contact){
                    $contact->where('user_id', Auth::id());
        }])->where('status', 1)->take(4)->get()->toArray();

        $resentItems = Item::latest('created_at')->where('status', 1)->take(4)->get();
        //echo "<pre>";
        //print_r($resentCards);
        //exit;
        return view('front', compact('resentCards', 'resentItems'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        
        return view('home');
    }

    public function updateinfo(Request $request) {
        $currentUser = Auth::guard('web')->user();
        $userInfo = User::where('id', '=', $currentUser->id)->first();

        
        $_fieldtype = $request->get('fieldtype');
        if($_fieldtype == "name"){
            $userInfo->name = $request->get('name');       
        }elseif($_fieldtype == "area"){
            $userInfo->area_id = $request->get('area_id');       
            $userInfo->city_id = 1;       
        }

        
        $userInfo->save();

        return redirect()->route('home')->with('success', __('messages.setting_update_success'));
    }

    public function aboutus() {
        
        return view('site/aboutus');
    }

    public function terms() {
        
        return view('site/terms');
    }

    public function features() {
        
        return view('site/features');
    }

    

    

    /** Setting Page for service provider */
    public function getSetting() {
        $currentUser = Auth::guard('web')->user();
        return view('settings.index', ['user' => $currentUser]);
    }

    public function updateSetting(Request $request) {
        $currentUser = Auth::guard('web')->user();

        if ($request->hasFile('profile_image')) {
            $file = $request->profile_image;
            $_filename = "profile_" . $currentUser->id . ".png";
            $destinationPath = public_path() . '/images/profile/';
            $file->move($destinationPath, $_filename);

            $currentUser->profile_image = $_filename;
        }

        $currentUser->name = $request->get('name');   
        

        $currentUser->save();

        return redirect()->route('settings')->with('success', __('messages.setting_update_success'));
    }

    public function getProfile(Request $request) {
        $providerId = $this->_shop_id();
        $service = ShopService::where('shop_id', '=', $providerId)
                ->select('service_id')
                ->get();

        $_service = array();
        foreach ($service as $_s) {
            $_service[] = $_s->service_id;
        }

        $images = ShopImage::where('shop_id', '=', $providerId)
                ->select('filename', 'id')
                ->get();

        $providerData = User::findOrFail($providerId);
        return response()->json(['data' => $providerData, 'service' => $_service, 'shop_images' => $images]);
    }
    
    public function removeShopImage(Request $request) {
        $shopImgId = $request->id;


        $image = ShopImage::where('id', '=', $shopImgId)
                ->select('filename', 'id')
                ->first();

        $file = $image->filename;

        $filename = public_path() . '/images/shop/' . $file;
        
        \File::delete($filename);

        ShopImage::where('id', '=', $shopImgId)->delete();

        //prd($image);
        return response()->json(['success' => 'Shop image remove successfully']);        
    }

    public function updateProfile(Request $request) {
        $validator = \Validator::make($request->all(), [
                    'name' => 'required|max:50',
                    'area_id' => 'required',
                    'address' => 'required',
                    'map' => 'required',
                    'images.*' => 'mimes:jpg,jpeg,png,gif,bmp',
                        ], [
                    'images.*.mimes' => __('messages.image_format_validate'),
                    'images.*.max' => __('messages.image_size_validate'),
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $provider = new ProviderController();
        $user = User::findOrFail($this->_shop_id());
        $user->name = $request->get('name');
        $user->area_id = $request->get('area_id');
        $user->address = $request->get('address');
        $user->incharge_name = $request->get('incharge_name');

        /* First  preg_match check url contain latlong or not
         * Second preg_match Get the latlong to variable
         */
        if (preg_match("/@(-?\d+\.\d+),(-?\d+\.\d+),(\d+\.?\d?)+z/", $request->get('map'))) {
            preg_match('/@(\-?[0-9]+\.[0-9]+),(\-?[0-9]+\.[0-9]+)/', $request->get('map'), $latLong);
            $user->map = $request->get('map');
            $user->lat = (!empty($latLong[1]) ? $latLong[1] : "");
            $user->long = (!empty($latLong[2]) ? $latLong[2] : "");
        } else {
            $user->map = "";
            $user->lat = "";
            $user->long = "";
        }
        $user->comment = (!empty($request->get('comment')) ? $request->get('comment') : "");
        $user->owner_name = $request->get('owner_name');
        $user->owner_phone = $request->get('owner_phone');
        $user->crn = (!empty($request->get('crn')) ? $request->get('crn') : "");
        $user->lincense = (!empty($request->get('lincense')) ? $request->get('lincense') : "");
        $user->man = $user->women = $user->kid = 0;

        if ($request->get('service_mw') == 'man') {
            $user->man = 1;
        }

        if ($request->get('service_mw') == 'women') {
            $user->women = 1;
        }

        if ($request->get('kid') == 'on') {
            $user->kid = 1;
        }

        $user->accept_payment = $request->get('accept_payment');
        $user->save();

        $this->createUpdateImages($request, $user->id);
        $this->createUpdateServices($request, $user->id);

        return response()->json(['success' => __('messages.sp_update_success')]);
    }

    protected function createUpdateImages($request, $shop_id) {
        /* Insert Shop Images */
        if ($request->hasFile('images')) {
            $destinationPath = public_path() . '/images/shop';
//echo $destinationPath;

            foreach ($request->file('images') as $key => $image) {
                $extension = $image->getClientOriginalExtension();
                $image_name = "Shop" . $shop_id . "_" . time() . mt_rand(1000, 9999) . "." . $extension;
//$image_name = $image->getClientOriginalName();
                $image->move($destinationPath, $image_name);

                $_shopImage = new ShopImage();
                $_shopImage->shop_id = $shop_id;
                $_shopImage->filename = $image_name;
                $_shopImage->save();
            }
        }
    }

    /**
     * //Update Services selection of shop
     */
    protected function createUpdateServices($request, $shop_id) {
        if (!empty($request->services)) {
            foreach ($request->services as $service_id) {
                $shopService = ShopService::where([
                            ['shop_id', '=', $shop_id],
                            ['service_id', '=', $service_id],
                        ])->first();

                if (!empty($shopService)) {
                    ShopService::find($shopService->id)->delete();
                }

                $serviceData = Service::findOrFail($service_id);

                $_shopService = new ShopService();
                $_shopService->shop_id = $shop_id;
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
    }


    
    

    public function appCalcellation() {
        return view('app/cancellation');
    }

    /* public function admin()
      {
      return view('admin');
      } */

    public function search(Request $request) {
        $_searchTerm = $request->q;
        $_searchCategory = $request->category;
        

        $categoryList = $this->getCategoryList();

        if (!empty($_searchTerm)) {
            $searchRow = Search::where('search_text', '=', $_searchTerm)->first();
            if(!empty($searchRow)){
                //TO DO -- update search count
            }else{
                $sRow = new Search();
                $sRow->search_text = $_searchTerm;
                $sRow->save();   
                      //echo $_searchTerm;
            }
      
        }


        $cardData = array();
        //if (!empty($request->q)) {
        $cardData = Card::Where(function ($query) use ($request) {
                            $query->where('business_name', 'like', "%" . $request->q . "%")
                            ->orWhere('keywords', 'like', "%" . $request->q . "%");
                        })->where('status', 1)
                    ->whereHas('category', function($query) use ($request){
                        if(!empty($request->c)){
                            $query->where('slug', '=', $request->c);    
                        }
                    })
                    ->latest('created_at')
                    ->with(['category','contact' => function ($contact){
                    $contact->where('user_id', Auth::id());
        }])
                    ->paginate(9);

        $pagination = $cardData->appends ( array (
            'q' => $request->q, 
            'c' => $request->c 
        ) );
        
        return view('search', [
            'searchTerm' => $_searchTerm,
            'filterCategory' => $request->c,
            'cardData' => $cardData,
        ])->withQuery ( $_searchTerm );
    }

    public function marketplace(Request $request){
        $itemData = Item::latest('created_at')->where('status', 1)->get();



        return view('marketplace', [
            'itemData' => $itemData,
        ]);
    }

    public function productshow($slug)
    {
        //$item = Item::findById($slug);
        $item = Item::whereId($slug)->first();
        //$reviews = $this->productReviewRepository->getAllReviewsByProductId($product->id);
        
        return view('product')
            ->with(compact('item'));
    }

    public function viewStatistics(Request $request) {

        $duration = $request->duration;

        if ($duration == 'lastMonth') {
            $startDate = \Carbon\Carbon::now()->subMonth()->startOfMonth();
            $endDate = new Carbon('last day of last month');
            $period = \Carbon\CarbonPeriod::create($startDate, $endDate);
        } else if ($duration == 'last6Months') {
            $startDate = \Carbon\Carbon::now()->subMonths(6)->startOfMonth();
            $endDate = new Carbon('last day of this month');
            $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);
        } else if ($duration == 'last1Year') {
            $startDate = \Carbon\Carbon::now()->subYear()->startOfMonth();
            $endDate = new Carbon('last day of this month');
            $period = \Carbon\CarbonPeriod::create($startDate, '1 month', $endDate);
        } else {
            $startDate = new Carbon('first day of this month');
            $endDate = new Carbon('last day of this month');
            $period = \Carbon\CarbonPeriod::create($startDate, $endDate);
        }

        // Period over which we want user registration data
        $staticis = array();

        foreach ($period as $key => $val) {
            //pr($val);
            //prd($val->addMonths(1));
            if ($duration == "last6Months" || $duration == "last1Year") {
                $staticis[$key]['y'] = $val->format('Y-m-d');
            } else {
                $staticis[$key]['y'] = $val->format('Y-m-d');
            }
            $staticis[$key]['bookings'] = Booking::where("shop_id", '=', $this->_shop_id())
                    ->where('booking_mode', '=', 0)
                    ->where('status', '!=', 0)
                    ->where(function ($query) use($duration, $val) {
                        if ($duration == "last6Months" || $duration == "last1Year") {
                            $query->where('booking_date', '>=', $val)
                            ->where('booking_date', '<=', $val->addMonths(1));
                        } else {
                            $query->whereDate('booking_date', $val);
                        }
                    })
                    ->count();

            $staticis[$key]['walkins'] = Booking::where("shop_id", '=', $this->_shop_id())
                    ->where('booking_mode', '=', 1)
                    ->where('status', '!=', 0)
                    ->where(function ($query) use($duration, $val) {
                        if ($duration == "last6Months" || $duration == "last1Year") {
                            $query->where('booking_date', '>=', $val)
                            ->where('booking_date', '<=', $val->addMonths(1));
                            //$query->whereBetween('booking_date', array($startDate, $endDate));
                        } else {
                            $query->whereDate('booking_date', $val);
                        }
                    })
                    ->count();
        }

        return response()->json($staticis, 200);
    }

    public function test_pay(Request $request) {
        $params = array(
            'ivp_store' => '21386', //Client Telr Store ID
            'ivp_authkey' => '2CLk~QVhDT^LN8wK', //Client Telr Authentication Key
            'ivp_trantype' => 'capture', // Capture, Refund -- Followup Type
            'ivp_tranclass' => 'ecom',
            'ivp_desc' => 'App Booking TEST',
            'ivp_cart' => 'BOOKINGID01',
            'ivp_currency' => 'SAR',
            'ivp_amount' => '3.00',
            'tran_ref' => '030021408735', //
            'ivp_test' => '1'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://secure.telr.com/gateway/remote.html");
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        $results = curl_exec($ch);
        curl_close($ch);

        $resArray = array();
        foreach (explode('&', $results) as $chunk) {
            $param = explode("=", $chunk);
            if ($param) {
                $resArray[urldecode($param[0])] = urldecode($param[1]);
            }
        }

        /**
         * RES ARRAY
         * Array
          (
          [auth_status] => A
          [auth_code] => 923630
          [auth_message] => Authorised
          [auth_tranref] => 040021058352
          [auth_cvv] => Y
          [auth_avs] => X
          [auth_trace] => 4001/23629/5c9b75fc
          [payment_code] => VC
          [payment_desc] => Visa Credit ending 1111
          [payment_cardl4] => 1111
          [payment_cardl6] => 411111

          )
         */
        prd($resArray);
    }

    public function test(Request $request) {
        $bookings = Booking::get();

        foreach ($bookings as $booking) {
            //pr($booking);

            $shop = User::where('id', '=', $booking->shop_id)->first();
            /* $commission = $shop->commission;

              if (!empty($commission)) {
              $_comm_amo = (($commission / 100) * $booking->final_amount);
              $booking->commission_amount = $_comm_amo;

              } */

            if (!empty($shop->area_id)) {
                $booking->area_id = $shop->area_id;
            }

            if ($booking->status = 1) {
                \App\BookingService::where('booking_id', '=', $booking->id)
                        ->update(['status' => 1]);
            }

            $booking->save();
        }
        prd("Success");
    }

    public function reports(Request $request) {
        $currentUser = Auth::guard('web')->user();
        if($currentUser->user_type == 1){
            return redirect()->route('home');
        }
        $totalRevenue = Booking::where("shop_id", '=', $this->_shop_id())
                ->select(DB::raw('SUM(final_amount) as sumRevenue'), DB::raw('SUM(commission_amount) as adminCommission'))
                ->where('status', '=', 1)
                ->groupBy('shop_id')
                ->first();



        //prd($totalRevenue);
        $startDate = new Carbon('first day of this month');
        $endDate = new Carbon('last day of this month');

        $quickDetails = array();
        $quickDetails['customers'] = Booking::where("shop_id", '=', $this->_shop_id())
            ->where("booking_date", '>=', $startDate)
            ->where("booking_date", '<=', $endDate)
            ->distinct('customer_id')
            ->count('customer_id');

        $quickDetails['bookings'] = Booking::where("shop_id", '=', $this->_shop_id())
            ->where('booking_mode', '=', 0)
            ->where("booking_date", '>=', $startDate)
            ->where("booking_date", '<=', $endDate)
            ->where('status', '!=', 0)
            ->count();

        $quickDetails['walkings'] = Booking::where("shop_id", '=', $this->_shop_id())
            ->where('booking_mode', '=', 1)
            ->where("booking_date", '>=', $startDate)
            ->where("booking_date", '<=', $endDate)
            ->where('status', '=', 1)
            ->count();

        //prd($quickDetails);
        return view('users/reports', compact('totalRevenue', 'quickDetails'));
    }

    public function getTopServices(Request $request) {
        $duration = $request->val;

        if ($duration == 'lastMonth') {
            $startDate = \Carbon\Carbon::now()->subMonth()->startOfMonth();
            $endDate = new Carbon('last day of last month');
        } else if ($duration == 'last6Months') {
            $startDate = \Carbon\Carbon::now()->subMonths(6)->startOfMonth();
            $endDate = new Carbon('last day of this month');
        } else if ($duration == 'last1Year') {
            $startDate = \Carbon\Carbon::now()->subYear()->startOfMonth();
            $endDate = new Carbon('last day of this month');
        } else {
            $startDate = new Carbon('first day of this month');
            $endDate = new Carbon('last day of this month');
        }

        $topServices = \App\BookingService::where('shop_id', '=', $this->_shop_id())
                ->where("starttime", '>=', $startDate)
                ->where("starttime", '<=', $endDate)
                ->where('status', '=', 1)
                ->with(['service'])
                ->orderBy('count', 'DESC')
                ->groupBy('service_id')
                ->select('service_id', DB::raw('SUM( price ) as price'), DB::raw('COUNT( * ) as "count"'))
                ->get();

        $returnData = array();
        foreach ($topServices as $service) {
            $ser = array();
            $ser[] = $service['service']['name'];
            $ser[] = $service['count'];
            $ser[] = $service['price'];
            $returnData[] = $ser;
        }

        return response()->json(['data' => $returnData], 200);
    }

    public function getQuickDetails(Request $request){

        $duration = $request->val;

        if ($duration == 'lastMonth') {
            $startDate = \Carbon\Carbon::now()->subMonth()->startOfMonth();
            $endDate = new Carbon('last day of last month');
        } else if ($duration == 'last6Months') {
            $startDate = \Carbon\Carbon::now()->subMonths(6)->startOfMonth();
            $endDate = new Carbon('last day of this month');
        } else if ($duration == 'last1Year') {
            $startDate = \Carbon\Carbon::now()->subYear()->startOfMonth();
            $endDate = new Carbon('last day of this month');
        } else {
            $startDate = new Carbon('first day of this month');
            $endDate = new Carbon('last day of this month');
        }

        $quickDetails = array();
        $quickDetails['customers'] = Booking::where("shop_id", '=', $this->_shop_id())
            ->where("booking_date", '>=', $startDate)
            ->where("booking_date", '<=', $endDate)
            ->distinct('customer_id')
            ->count('customer_id');

        $quickDetails['bookings'] = Booking::where("shop_id", '=', $this->_shop_id())
            ->where('booking_mode', '=', 0)
            ->where("booking_date", '>=', $startDate)
            ->where("booking_date", '<=', $endDate)
            ->where('status', '!=', 0)
            ->count();

        $quickDetails['walkings'] = Booking::where("shop_id", '=', $this->_shop_id())
            ->where('booking_mode', '=', 1)
            ->where("booking_date", '>=', $startDate)
            ->where("booking_date", '<=', $endDate)
            ->where('status', '=', 1)
            ->count();

        return response()->json(['data' => $quickDetails], 200);
    }

}
