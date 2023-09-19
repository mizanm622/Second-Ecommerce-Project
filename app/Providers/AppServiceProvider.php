<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Models\Subcategory;
use App\Models\Wishlist;
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

        $category = Category::all();
       // $wishlist = Wishlist::where('user_id',auth()->id())->count();
        $populerCategory = Subcategory::all();
        $pages =Page ::all();
        $settings=Setting::first();
        Paginator::useBootstrap();
         view()->share('settings',$settings);
         view()->share('footerPages',$pages);
         view()->share('populerCategory',$populerCategory);
         view()->share('category',$category);
        //  view()->share('wishlist',$wishlist);
    }
}
