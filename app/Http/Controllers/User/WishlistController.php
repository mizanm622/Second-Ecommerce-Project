<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // show wishlist from here
    public function index(){

        if(auth()->check()){

            $wishlists = Wishlist::where('user_id', auth()->id())->get();

            return view('layouts.front-end.cart.wishlist', compact('wishlists'));
        }
        else{
            return redirect()->route('Please Login to continue');
        }

    }



     // add product wishlist from here
     public function addWishlist(Request $request){


        $check = Wishlist :: where('product_id',$request->id)->where('user_id',auth()->id())->first();
        if($check){
            return response()->json('Product Successfully Added to Wishlist!');
        }else{

        Wishlist :: create([
            'product_id'=>$request->id,
            'user_id'=>auth()->id(),
        ]);

            return response()->json('Product Successfully Added to Wishlist!');

        }
   }

   // remove wishlist
   public function removeWishlist(Request $request){
   Wishlist::where('user_id', auth()->id())->where('product_id',$request->id)->delete();
    return response()->json('Product Successfully Deleted from Wishlist!');

   }

    // remove wishlist
    public function destroyWishlist(){
        Wishlist::where('user_id', auth()->id())->delete();
         return response()->json('All Product Successfully Deleted from Wishlist!');

        }




}
