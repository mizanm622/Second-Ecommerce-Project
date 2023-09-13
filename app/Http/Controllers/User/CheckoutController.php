<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // data send to checkout page
    public function index(){

        $cartProducts = Cart ::content();
        $shippingInfo = Shipping::where('user_id',auth()->id())->first();

        return view('layouts.front-end.cart.checkout',compact('cartProducts','shippingInfo'));
       }

    //check coupon validation
    public function checkCoupon(Request $request){


        $data = Coupon::where('coupon_code',$request->coupon)->first();
        if($data){
            if(date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($data->valid_date))){

                session()->put('coupon',[
                    'coupon_code'=>$request->coupon,
                    'coupon_discount'=>$data->coupon_amount,
                    'after_discount'=>Cart::total()-$data->coupon_amount,
                ]);
                return response()->json(1);
            }
        }else{
            session()->forget('coupon');
            return redirect()->back();
        }
    }
}
