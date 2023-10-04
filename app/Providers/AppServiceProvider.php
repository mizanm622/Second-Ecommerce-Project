<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\OrderAddress;
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

        $total_sell = OrderAddress::sum('total');
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
         view()->share('category',$category);
         view()->share('total_sell',$total_sell);
        //  view()->share('wishlist',$wishlist);
    }
}
