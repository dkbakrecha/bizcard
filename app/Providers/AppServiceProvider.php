<?php

namespace App\Providers;

use App\Category;
use App\Service;
use App\ShopService;
use App\Area;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

use View;
use Auth;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //URL::forceScheme('https'); // add this

        Schema::defaultStringLength(191);

        view()->composer('*', function ($view) {
            $view->with('bizCategory', Category::get()->keyBy('name'));
            $view->with('bizArea', Area::get()->keyBy('area_name'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
