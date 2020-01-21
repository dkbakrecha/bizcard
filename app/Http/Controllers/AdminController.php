<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\Card;
use App\ShopOffer;
use App\Service;
use App\Area;
use App\SiteSetting;
use App\Booking;
use Illuminate\Support\Carbon;

class AdminController extends Controller {

    public function __construct() {
        //$this->middleware('auth:admin');
        $this->middleware('auth:admin')->except(['create', 'store']);
    }

    /**
     * Dashboard Functionalities of Admin
     */
    public function index() {
    
        // Active User and pending
        $userActive = User::where('status', '=', 1)->where('user_type', '=', 0)->count();
        $userPending = User::where('status', '=', 3)->where('user_type', '=', 0)->count();

        $cardActive = Card::where('status', '=', 1)->count();
        $cardPending = Card::where('status', '=', 3)->count();
        
        

        //return $getUser24Hrs;
        return view('admin.dashboard', [
            'user_active' => $userActive,
            'user_pending' => $userPending,
            'card_active' => $cardActive,
            'card_pending' => $cardPending,
        ]);
    }

    /**
     * CRON functionality for Offer Expire
     */
    public function cronOfferExpire() {
        $expireOffers = ShopOffer::where('expire_date', '<', Carbon::now('Asia/Kolkata'))
                ->where('status', '!=', 4)
                ->get();
//prd(Carbon::now());
        foreach ($expireOffers as $_offer) {
            $offerData = ShopOffer::findOrFail($_offer->id);
            $offerData->status = 4;
            $offerData->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // validate the data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

// store in the database
        $admins = new User();
        $admins->name = $request->name;
        $admins->email = $request->email;
        $admins->password = bcrypt($request->password);
        $admins->user_type = 3; //Admin
        $admins->save();

        return redirect()->route('admin.auth.login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function getSetting() {

        $settings = DB::table('site_settings')->orderBy('group_id')->get();
        $currentUser = Auth::guard('admin')->user();

        return view('admin.settings.index', ['settings' => $settings]);
    }

    public function updateSetting(Request $request) {
        $data = $request->all();

        //return $data;
        foreach ($data as $key => $setting) {

            if (!in_array($key, array("_token"))) {
                $settingData = SiteSetting::where([
                            ['unique_key', '=', $key],
                        ])
                        ->first();
                $settingData->value = $setting;
                $settingData->save();
            }

            
        }
        return redirect()->route('admin.settings')->with('success', __('messages.setting_update_success'));
    }

    public function search(Request $request) {
        $_searchTerm = $request->q;

        $userData = array();
        $bookingData = array();
        if (!empty($request->q)) {
            $userData = User::Where(function ($query) use ($request) {
                                $query->where('name', 'like', "%" . $request->q . "%")
                                ->orWhere('unique_id', 'like', "%" . $request->q . "%")
                                ->orWhere('phone', 'like', "%" . $request->q . "%");
                            })
                            ->where('status', '!=', 4)
                            ->get()->toArray();

            $bookingData = Booking::With(['customer'])
                            ->where(function ($query) use ($request) {
                                if (!empty($request->q)) {
                                    $query->where('unique_id', 'like', "%" . $request->q . "%")
                                    ->orWhereHas('customer', function($query) use ($request) {
                                        $query->where('name', 'like', "%" . $request->q . "%")
                                        ->orWhere('unique_id', 'like', "%" . $request->q . "%")
                                        ->orWhere('phone', 'like', "%" . $request->q . "%");
                                    });
                                }
                            })
                            ->orderBy('id', 'DESC')
                            ->get()->toArray();
        }
        //prd($bookingData);
        return view('admin.search', [
            'searchTerm' => $_searchTerm,
            'userData' => $userData,
            'bookingData' => $bookingData
        ]);
    }

    protected function createPeriod($duration) {

        return $period;
    }

    // AJAX FUNCTION TO FETCH USER REGISTRATION DATA FOR MORRIS CHART
    public function getUserRegistrationChartData(Request $request) {
        if ($request->ajax()) {
            $duration = $request->duration;

            // Convert the period to an array of dates
            // $dates = $period->toArray();
            $userData = [];

            if ($duration == 'lastMonth') {    // fetch data for the last month 
                $startDate = new Carbon('first day of last month');
                $endDate = new Carbon('last day of last month');

                // Period over which we want user registration data
                $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

                foreach ($period as $key => $date) {
                    // echo $date->format('Y-m-d');

                    $userData[$key]['y'] = $date->format('Y-m-d');

                    DB::enableQueryLog();

                    $usersCount = User::whereDate('created_at', $date)
                            ->get()
                            ->count();
                    // prd(DB::getQueryLog());


                    $userData[$key]['usersCount'] = $usersCount;
                }
            } else if ($duration == 'last6Months') {    // fetch data for the last 6 months month 
                $now = Carbon::now();
                $nowString = $now->format('Y-m-d');
                $sixMonthAgo = $now->subMonths(6);
                $sixMonthAgoString = $sixMonthAgo->format('Y-m-d');

                $period = \Carbon\CarbonPeriod::create($sixMonthAgoString, '1 month', $nowString);

                foreach ($period as $key => $date) {

                    $userData[$key]['y'] = $date->format('Y-m');

                    DB::enableQueryLog();

                    $usersCount = User::whereMonth('created_at', $date->format('m'))
                            ->whereYear('created_at', $date->format('Y'))
                            ->get()
                            ->count();

                    $userData[$key]['usersCount'] = $usersCount;
                }
            } else if ($duration == 'last1Year') {    // fetch data for the last year 
                $now = Carbon::now();
                $nowString = $now->format('Y-m-d');
                $oneYearAgo = $now->subYear();
                $oneYearAgoString = $oneYearAgo->format('Y-m-d');

                $period = \Carbon\CarbonPeriod::create($oneYearAgoString, '1 month', $nowString);

                foreach ($period as $key => $date) {

                    $userData[$key]['y'] = $date->format('Y-m');

                    DB::enableQueryLog();

                    $usersCount = User::whereMonth('created_at', $date->format('m'))
                            ->whereYear('created_at', $date->format('Y'))
                            ->get()
                            ->count();

                    $userData[$key]['usersCount'] = $usersCount;
                }
            } else if ($duration == 'currentMonth') {    // fetch data for the current month 
                $startDate = new Carbon('first day of this month');
                $endDate = new Carbon('last day of this month');

                // Period over which we want user registration data
                $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

                foreach ($period as $key => $date) {

                    $userData[$key]['y'] = $date->format('Y-m-d');

                    DB::enableQueryLog();

                    $usersCount = User::whereDate('created_at', $date)
                            ->get()
                            ->count();

                    $userData[$key]['usersCount'] = $usersCount;
                }
            }

            return json_encode($userData);
        }
    }

    // AJAX FUNCTION TO FETCH BOOKINGS DATA FOR MORRIS CHART
    public function getBookingsChartData(Request $request) {
        if ($request->ajax()) {
            $duration = $request->duration;

            // Convert the period to an array of dates
            // $dates = $period->toArray();
            $bookingData = [];

            if ($duration == 'lastMonth') {    // fetch data for the last month 
                $startDate = new Carbon('first day of last month');
                $endDate = new Carbon('last day of last month');

                // Period over which we want user registration data
                $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

                foreach ($period as $key => $date) {
                    // echo $date->format('Y-m-d');

                    $bookingData[$key]['y'] = $date->format('Y-m-d');

                    DB::enableQueryLog();

                    $bookingsCount = Booking::whereDate('created_at', $date)
                            ->get()
                            ->count();
                    // prd(DB::getQueryLog());


                    $bookingData[$key]['bookingsCount'] = $bookingsCount;
                }
            } else if ($duration == 'last6Months') {    // fetch data for the last 6 months month 
                $now = Carbon::now();
                $nowString = $now->format('Y-m-d');
                $sixMonthAgo = $now->subMonths(6);
                $sixMonthAgoString = $sixMonthAgo->format('Y-m-d');

                $period = \Carbon\CarbonPeriod::create($sixMonthAgoString, '1 month', $nowString);

                foreach ($period as $key => $date) {

                    $bookingData[$key]['y'] = $date->format('Y-m');

                    DB::enableQueryLog();

                    $bookingsCount = Booking::whereMonth('created_at', $date->format('m'))
                            ->whereYear('created_at', $date->format('Y'))
                            ->get()
                            ->count();

                    $bookingData[$key]['bookingsCount'] = $bookingsCount;
                }
            } else if ($duration == 'last1Year') {    // fetch data for the last year 
                $now = Carbon::now();
                $nowString = $now->format('Y-m-d');
                $oneYearAgo = $now->subYear();
                $oneYearAgoString = $oneYearAgo->format('Y-m-d');

                $period = \Carbon\CarbonPeriod::create($oneYearAgoString, '1 month', $nowString);

                foreach ($period as $key => $date) {

                    $bookingData[$key]['y'] = $date->format('Y-m');

                    DB::enableQueryLog();

                    $bookingsCount = Booking::whereMonth('created_at', $date->format('m'))
                            ->whereYear('created_at', $date->format('Y'))
                            ->get()
                            ->count();

                    $bookingData[$key]['bookingsCount'] = $bookingsCount;
                }
            } else if ($duration == 'currentMonth') {    // fetch data for the current month 
                $startDate = new Carbon('first day of this month');
                $endDate = new Carbon('last day of this month');

                // Period over which we want user registration data
                $period = \Carbon\CarbonPeriod::create($startDate, $endDate);

                foreach ($period as $key => $date) {

                    $bookingData[$key]['y'] = $date->format('Y-m-d');

                    DB::enableQueryLog();

                    $bookingsCount = Booking::whereDate('created_at', $date)
                            ->get()
                            ->count();

                    $bookingData[$key]['bookingsCount'] = $bookingsCount;
                }
            }

            return json_encode($bookingData);
        }
    }

}
