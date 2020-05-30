<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
/* Route::get('/', function () {
  return view('admintemplate');
  });
 */
Route::get('/', 'HomeController@front')->name('front');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about-us', 'HomeController@aboutus')->name('about-us');
Route::get('/features', 'HomeController@features')->name('features');
Route::get('/privacy-terms', 'HomeController@terms')->name('privacy-terms');
Route::get('/card/{cardslug}', 'CardsController@view')->where('cardslug', '[a-z-]+');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/list', 'HomeController@search')->name('list');
Route::get('/marketplace', 'HomeController@marketplace')->name('marketplace');
Route::get('/product/{product}', 'HomeController@productshow')->name('product.show');
Route::get('/cardnew/{cardslug}', 'CardsController@viewnew')->where('cardslug', '[a-z-]+');


Route::get('/tcbot', 'HomeController@tcbot')->name('tcbot');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('config:cache');

    return "Cache is cleared";
});

Auth::routes();


Route::get('verifyuser', 'Auth\RegisterController@verifyuser')->name('verifyuser');
Route::post('verifyuser', 'Auth\RegisterController@verifyuser')->name('verifyuser');
Route::get('phonevalidation', 'Auth\ForgotPasswordController@phonevalidation')->name('password.phone');
Route::post('phonevalidation', 'Auth\ForgotPasswordController@phonevalidation')->name('password.phone');

Route::get('reset-password/{token}', 'Auth\ResetPasswordController@showPasswordResetForm')->name('resetpassword');
Route::post('reset-password/{token}', 'Auth\ResetPasswordController@resetPassword')->name('resetpassword');

Route::get('cards', 'CardsController@index')->name('cards');
Route::get('cards/store', 'CardsController@create');
Route::post('cards/store', 'CardsController@store')->name('card.store');
Route::get('cards/create', 'CardsController@create')->name('card.create');

Route::post('add-to-contact', 'ContactsController@addToContact')->name('add-to-contact');
Route::get('contacts', 'ContactsController@index')->name('contacts');
//Route::match(['put', 'patch'], '/company/update/{id}','CompanyMasterController@update');

//Route::post('offers/update', 'OffersController@update')->name('offer.update');
//Route::post('getOffer', 'OffersController@getOffer')->name('getOffer');
//Route::post('getOfferPrice', 'OffersController@getOfferPrice');
//Route::delete('offer_delete', 'OffersController@offer_delete')->name('offer.destroy');








Route::get('/test_pay', 'CronsController@test_pay')->name('test_pay');
Route::get('/test_res', 'CronsController@test_res')->name('test_res');
Route::get('/test', 'HomeController@test')->name('test');

Route::get('update', 'HomeController@getSetting')->name('settings');
Route::post('update', 'HomeController@updateSetting')->name('settings.store');
Route::post('getProfile', 'HomeController@getProfile');
Route::post('updateProfile', 'HomeController@updateProfile')->name('profile.update');
Route::post('removeShopImage', 'HomeController@removeShopImage');

    
Route::get('app/aboutus', 'HomeController@appAboutus');
Route::get('app/cancellation', 'HomeController@appCalcellation');

Route::post('viewCustomer', 'UsersController@viewCustomer')->name('viewCustomer');
Route::post('viewStatistics', 'HomeController@viewStatistics')->name('viewStatistics');


Route::get('staff', 'StaffController@index')->name('staff');
Route::post('staff', 'StaffController@store')->name('staff.store');
Route::post('getStaff', 'StaffController@getStaff');
Route::post('staff_update', 'StaffController@update')->name('staff.update');
Route::delete('staff_delete', 'StaffController@delete')->name('staff.destroy');
Route::post('send_credentials', 'StaffController@send_credentials')->name('staff.send_credentials');

Route::get('search_staff', 'StaffController@search')->name('staff.search');
Route::get('index', 'StaffController@index')->name('staff.index');

Route::get('offers', 'OffersController@index')->name('offers');
Route::post('offers/store', 'OffersController@store')->name('offer.store');
Route::post('offers/update', 'OffersController@update')->name('offer.update');
Route::post('getOffer', 'OffersController@getOffer')->name('getOffer');
Route::post('getOfferPrice', 'OffersController@getOfferPrice');
Route::delete('offer_delete', 'OffersController@offer_delete')->name('offer.destroy');

Route::get('services', 'ServicesController@index')->name('services');
Route::post('services/store', 'ServicesController@store')->name('service.store');
Route::post('services/update', 'ServicesController@update')->name('service.update');
Route::post('getService', 'ServicesController@getService')->name('getService');
Route::post('getShopService', 'ServicesController@getShopService')->name('getShopService');
Route::delete('service_delete', 'ServicesController@service_delete')->name('services.delete');

Route::get('feedbacks', 'FeedbacksController@index')->name('feedbacks');
Route::get('feedbacks/create', 'FeedbacksController@create')->name('feedback.create');
Route::post('feedbacks/create', 'FeedbacksController@create')->name('feedback.create');
Route::post('getMessages', 'FeedbacksController@getMessages');
Route::post('feedbackReply', 'FeedbacksController@feedbackReply')->name('feedbackReply');

Route::get('working_hours', 'ProvidersController@getWorkingHours')->name('working_hours');
Route::post('working_hours', 'ProvidersController@updateWorkingHours')->name('working_hours.store');

Route::get('change_password', 'UsersController@getChangePassword')->name('change_password');
Route::post('change_password', 'UsersController@updatePassword')->name('change_password.store');

Route::get('bookings', 'BookingsController@index')->name('bookings');
Route::get('reservation', 'BookingsController@reservation')->name('reservation');
Route::get('getReservation', 'BookingsController@getReservation')->name('getReservation');
Route::post('getBooking', 'BookingsController@getBooking')->name('getBooking');

Route::get('schedule', 'BookingsController@schedule')->name('schedule');
Route::get('getSchedules', 'BookingsController@getSchedules')->name('getSchedules');
Route::post('walking_store', 'BookingsController@walking_store')->name('walking.store');

Route::post('booking_approve', 'BookingsController@booking_approve')->name('booking.approve');
Route::post('booking_reject', 'BookingsController@booking_reject')->name('booking.reject');
Route::post('booking_complete', 'BookingsController@booking_complete')->name('booking.complete');
Route::post('booking.no_show', 'BookingsController@booking_noshow')->name('booking.no_show');
Route::post('booking.cancel', 'BookingsController@booking_cancel')->name('booking.cancel');

Route::get('reviews', 'ReviewsController@index')->name('reviews');
Route::post('review_flagged', 'ReviewsController@flagged')->name('review.flagged');

Route::get('web-notifications', 'NotificationsController@index')->name('notifications');
Route::post('read-notifications', 'NotificationsController@readNotification')->name('readNotification');


Route::get('reports', 'HomeController@reports')->name('reports');
Route::get('getTopServices', 'HomeController@getTopServices')->name('getTopServices');
Route::post('getTopServices', 'HomeController@getTopServices')->name('getTopServices');
Route::post('get_quick_details', 'HomeController@getQuickDetails')->name('get_quick_details');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/cards','Admin\CardsController');
    Route::resource('/items','Admin\ItemsController');
    Route::get('/cards/view/{id}', 'Admin\CardsController@view')->name('cards.view');
    Route::post('/cards/savecard', 'Admin\CardsController@savecard')->name('cards.savecard');
    Route::post('/cardStatus', 'Admin\CardsController@update_status')->name('cardUpdate');
});

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('register', 'AdminController@create')->name('admin.register');
    Route::post('register', 'AdminController@store')->name('admin.register.store');
    Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
    Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');

    //Route::get('cards', 'Admin\CardsController@index')->name('admin.cards');
    //Route::get('cards/create/{id?}', 'Admin\CardsController@create')->name('card.add');
    //Route::post('cards/create', 'Admin\CardsController@create')->name();
    //Route::match(['put', 'patch', 'post'], 'cards/create/{id?}','Admin\CardsController@create')->name('card.store');

    //Search
    Route::get('search', 'AdminController@search')->name('admin.search');

    //admin password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::get('settings', 'AdminController@getSetting')->name('admin.settings');
    Route::post('settings', 'AdminController@updateSetting')->name('admin.settings.store');

    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('areas', 'Admin\AreasController');
    
    Route::resource('services', 'Admin\ServicesController');
    Route::resource('users', 'Admin\UsersController');
    Route::resource('area', 'Admin\AreasController');
    Route::resource('provider', 'Admin\ProviderController');
    Route::resource('customer', 'Admin\CustomerController');

    //Route::post('provider','Admin\ProviderController@update')->name('provider.update');    
    //Route::post('provider','Admin\ProviderController@store')->name('provider.store');    


    Route::get('providers', 'Admin\UsersController@providers')->name('users.providers');
    Route::get('supervisors', 'Admin\UsersController@supervisors')->name('users.supervisor');
    Route::get('supervisor_add', 'Admin\UsersController@supervisor_add')->name('users.supervisor_add');
    Route::post('supervisor_store', 'Admin\UsersController@supervisor_store')->name('users.supervisor_add');
    Route::post('supervisor_update', 'Admin\UsersController@supervisor_update')->name('supervisor.update');
    Route::post('staff_list', 'Admin\UsersController@staff_list');


    Route::get('block_providers', 'Admin\ProviderController@block')->name('block_providers');
    Route::get('block_customers', 'Admin\CustomerController@block')->name('block_customers');
    Route::post('providerBlock', 'Admin\ProviderController@providerBlock');
    Route::post('providerUnblock', 'Admin\ProviderController@providerUnblock');
    Route::post('customerBlock', 'Admin\CustomerController@customerBlock');
    Route::post('customerUnblock', 'Admin\CustomerController@customerUnblock');

    Route::post('getService', 'Admin\ServicesController@getService');
    Route::post('getArea', 'Admin\AreasController@getArea');
    Route::post('viewArea', 'Admin\AreasController@viewArea');
    Route::post('getProvider', 'Admin\ProviderController@getProvider');
    Route::post('getSupervisor', 'Admin\UsersController@getSupervisor');
    Route::post('viewProvider', 'Admin\ProviderController@viewProvider');
    Route::post('removeShopImage', 'Admin\ProviderController@removeShopImage');
    Route::post('getCustomer', 'Admin\CustomerController@getCustomer');
    Route::post('viewCustomer', 'Admin\CustomerController@viewCustomer');
    Route::post('sp_activate', 'Admin\ProviderController@sp_activate')->name('provider.activate');
    Route::post('sp_login', 'Admin\ProviderController@sp_login')->name('provider.sp_login');

    Route::get('feedbacks', 'Admin\FeedbacksController@index')->name('admin.feedbacks');
    Route::get('feedbacks/create', 'Admin\FeedbacksController@create')->name('admin.feedback.create');
    Route::post('feedbacks/create', 'Admin\FeedbacksController@create')->name('admin.feedback.create');
    Route::post('getMessages', 'Admin\FeedbacksController@getMessages');
    Route::post('feedbackReply', 'Admin\FeedbacksController@feedbackReply')->name('admin.feedbackReply');

    Route::get('offers', 'Admin\OffersController@index')->name('admin.offers');
    Route::post('getOffer', 'Admin\OffersController@getOffer')->name('admin.getOffer');
    Route::post('offer_approve', 'Admin\OffersController@offer_approve')->name('admin.offer.approve');
    Route::post('offer_reject', 'Admin\OffersController@offer_reject')->name('admin.offer.reject');
    Route::post('offer_inactive', 'Admin\OffersController@offer_inactive')->name('admin.offer.inactive');
    Route::post('offer_active', 'Admin\OffersController@offer_active')->name('admin.offer.active');

    

    Route::get('coupon_code', 'Admin\CouponCodesController@index')->name('admin.coupon_codes');
    Route::post('getCouponInfo', 'Admin\OffersController@getCouponInfo')->name('admin.getCouponInfo');
    Route::post('coupon_code_store', 'Admin\CouponCodesController@store')->name('admin.coupon_code.store');
    Route::post('code_inactive', 'Admin\CouponCodesController@code_inactive')->name('admin.coupon_codes.inactivate');
    Route::post('code_active', 'Admin\CouponCodesController@code_active')->name('admin.coupon_codes.activate');
    Route::post('getCouponInfo', 'Admin\CouponCodesController@getCouponInfo')->name('admin.getCouponInfo');


    Route::get('bookings', 'Admin\BookingsController@index')->name('admin.bookings');
    Route::post('getBooking', 'Admin\BookingsController@getBooking')->name('admin.getBooking');

    Route::get('reviews', 'Admin\ReviewsController@index')->name('admin.reviews');
    Route::post('review_approve', 'Admin\ReviewsController@review_approve')->name('admin.review.approve');
    Route::post('review_reject', 'Admin\ReviewsController@review_reject')->name('admin.review.reject');

    Route::get('web-notifications', 'Admin\NotificationsController@index')->name('admin.notifications');
    Route::post('read-notifications', 'Admin\NotificationsController@readNotification')->name('admin.readNotification');

    Route::get('financial', 'Admin\FinancialController@index')->name('admin.financial');
    Route::post('getReceipt', 'Admin\FinancialController@getReceipt')->name('admin.getReceipt');
    Route::post('getRefund', 'Admin\FinancialController@getRefund')->name('admin.getRefund');
    Route::post('getrrChartData', 'Admin\FinancialController@getrrChartData')->name('admin.getRrChartStats');


    // Dashboard Chart Routes
    Route::post('get-user-registration-chart-data', 'AdminController@getUserRegistrationChartData')->name('admin.getUserRegistrationChartData');

    Route::post('get-bookings-chart-data', 'AdminController@getBookingsChartData')->name('admin.getBookingsChartData');
    

});

Route::prefix('cron')->group(function () {
    Route::get('check-last-login', 'CronsController@checkLastLogin')->name('cron.checkLastLogin');
    Route::get('android', 'CronsController@android')->name('cron.android');
    Route::get('ios', 'CronsController@ios')->name('cron.ios');
    
    Route::get('reject_bookings', 'CronsController@reject_bookings')->name('cron.reject_bookings');
    Route::get('reject_bookings_test', 'CronsController@reject_bookings_test');
    Route::get('complete_bookings', 'CronsController@complete_bookings')->name('cron.complete_bookings');
    Route::get('complete_bookings_test', 'CronsController@complete_bookings_test');
    
    
    Route::get('offerexpire', 'CronsController@cronOfferExpire')->name('cron.offerexpire');
});
