<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Campaing;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
     //front-end view from here
    public function index(){

        $category =  Category::all();
        $populerCategory =  Subcategory::all();
        $brand =  Brand::all();
        $campaing = Campaing::where('status',1)->latest()->get();
        $latestReview = Review::where('review_rating',5)->latest()->get();
        $bannerProduct = Product::where('product_slider',1)->latest()->get();
        $wishlist = Wishlist::where('user_id',auth()->id())->count();
        $featuredProduct = Product::where('featured',1)->latest()->limit(16)->get();
        $populerProduct = Product::where('featured',1)->where('view_count','>',1)->latest()->limit(16)->get();
        $trendingProduct = Product::where('featured',1)->where('trending',1)->latest()->limit(20)->get();
        $todaysDeal = Product::where('todays_deal',1)->latest()->get();


        return view('layouts.front-end.home', compact('category','bannerProduct','wishlist','featuredProduct','todaysDeal','populerProduct','trendingProduct','latestReview','campaing','brand','populerCategory'));
    }

    // view product from modal
    public function modalView(Request $request){
        Product :: where('id',$request->id)->increment('view_count');// when a user click on the prduct to view then increment view_count
        $featuredProduct = Product::where('id',$request->id)->first();

        return view('layouts.front-end.product.single_view',compact('featuredProduct'))->render();
    }

    //  single product view from here

    public function singleView($id){

        $products = Product::where('id',$id)->first();
        Product::where('id',$id)->increment('view_count'); // when a user click on the prduct to view then increment view_count
        $relatedProduct = Product::where('subcategory_id',$products->subcategory_id)->orderBy('id','DESC')->limit(10)->get();
        $brandItem = Product::where('subcategory_id',$products->subcategory_id)->orderBy('id','DESC')->limit(10)->get();
        $review = Review::where('product_id',$id)->orderBy('id','ASC')->limit(10)->get();

        // $brandItem=Brand::limit(10)->get();

        return view('layouts.front-end.product.product_details', compact('products','relatedProduct','brandItem','review'));

    }
    // category wise product show
    public function categoryProduct($id){
        $recentView = Product::where('status',1)->latest()->get();
        $subcategories = Subcategory::all();
               $brands = Brand::latest()->get();
             $products = Product::where('category_id',$id)
             ->orWhere('subcategory_id',$id)
             ->orWhere('childcategory_id',$id)
             ->orWhere('brand_id',$id)
             ->paginate(4);

             return view('layouts.front-end.product.category_product',compact('subcategories','brands','products','recentView'));

    }
    // product filter by price
    public function productPriceFilter(Request $request){

        $products = Product::where('subcategory_id',$request->id)->where('selling_price', '>=', $request->min)->where('selling_price', '<=', $request->max)
        ->paginate(10);
        $subcategories = Subcategory::all();
        $brands = Brand::latest()->get();

        
        return view('layouts.front-end.product.category_product',compact('subcategories','brands','products'))->render();

    }




    // user profile show
    public function userProfile()
    {
        return view('home');
    }


    // user logput from here
    public function logout(){

        auth()->logout();

        return redirect()->to('/');
    }

}
