<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    // product cart
   public function index(){

    $cartProducts = Cart::content();

       return view('layouts.front-end.cart.cart',compact('cartProducts'));
    }

    // add product to cart from here
   public function addToCart(Request $request){


   Cart::add([
        'id' =>$request->id,
        'name' =>$request->name,
        'qty' =>$request->quantity,
        'price' =>$request->price,
        'options' => ['size' =>$request->size, 'color'=>$request->color,'image'=>$request->image]
    ]);

        return response()->json('Product Successfully Added to Cart!');
   }



   //update quantity
   public function updateQuantity(Request $request){
    Cart::update($request->rowId, ['qty' => $request->qty]);
    return response()->json('Quantity Successfullt Updated!');
   }

   //update size
   public function updateSize(Request $request){
    $product = Cart::get($request->rowId);
      $image = $product->options->image;
      $color = $product->options->color;

    $val = Cart::update($request->rowId,['options' => ['size' => $request->size,'color'=>$color,'image'=>$image]] );
    return response()->json('Size Successfullt Updated!');
   }

    //update Color
    public function updateColor(Request $request){
        $product = Cart::get($request->rowId);
          $image = $product->options->image;
          $size = $product->options->size;

       $val= Cart::update($request->rowId, ['options' => ['color'=>$request->color,'size' => $size,'image'=>$image]] );

         return response()->json('Color Successfullt Updated!');
       }

   // remove item
   public function cartItemRemove($rowId){
    Cart::remove($rowId);
    return response()->json('Item Successfullt Removed!');
   }
// remove item
public function cartDestroy(){
    Cart::destroy();
    return response()->json('Items Successfullt Deleted!');
   }

  

}
