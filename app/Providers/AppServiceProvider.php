<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }



    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // //calculate cart total

//     $delivery = 0;

//    if(Cart::total() <= 1000){
//     $delivery =50;
//    }
//    elseif(Cart::total() > 1000 and Cart::total() <= 2000){
//     $delivery =40;
//    }
//    elseif(Cart::total() > 2000 and Cart::total() <= 3000){
//     $delivery =30;
//    }
//    elseif(Cart::total() > 3000 and Cart::total() <= 4000){
//     $delivery =20;
//    }
//    elseif(Cart::total() > 4000 and Cart::total() <= 5000){
//     $delivery =10;
//    }
//    elseif(Cart::total() > 5000){

//     $delivery =0;
//    }






        Paginator::useBootstrap();
        $settings=Setting::first();
        view()->share('settings',$settings);
        // view()->share('delivery',$delivery);
    }
}
