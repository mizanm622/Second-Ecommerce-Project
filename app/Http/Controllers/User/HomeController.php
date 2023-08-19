<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){

        $category=Category::all();
        $bannerProduct=Product::where('product_slider',1)->latest()->get();


        return view('layouts.front-end.home', compact('category','bannerProduct'));
    }

    //  single product view from here

    public function singleView($id){
        $products=Product::where('id',$id)->first();

        $relatedProduct=Product::where('subcategory_id',$products->subcategory_id)->orderBy('id','DESC')->limit(10)->get();
        $brandItem=Product::where('subcategory_id',$products->subcategory_id)->orderBy('id','DESC')->limit(10)->get();
        // $brandItem=Brand::limit(10)->get();

        return view('layouts.front-end.product.product_details', compact('products','relatedProduct','brandItem'));

    }
}
