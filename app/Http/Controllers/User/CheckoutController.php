<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    // data send to checkout page
    public function index(){

        if(count(Cart::content()) <1 ){
            return redirect()->route('home');
        }else{

    //calculate cart total

    $delivery = 0;

   if(Cart::subtotal() <= 1000){
    $delivery =50;
   }
   elseif(Cart::subtotal() > 1000 and Cart::subtotal() <= 2000){
    $delivery =40;
   }
   elseif(Cart::subtotal() > 2000 and Cart::subtotal() <= 3000){
    $delivery =30;
   }
   elseif(Cart::subtotal() > 3000 and Cart::subtotal() <= 4000){
    $delivery =20;
   }
   elseif(Cart::subtotal() > 4000 and Cart::subtotal() <= 5000){
    $delivery =10;
   }
   elseif(Cart::subtotal() > 5000){

    $delivery =0;
   }

        $cartProducts = Cart ::content();
        $shippingInfo = Shipping::where('user_id',auth()->id())->first();

        return view('layouts.front-end.cart.checkout',compact('cartProducts','shippingInfo','delivery'));
       }
    }

    //check coupon validation
    public function checkCoupon(Request $request){


        $data = Coupon::where('coupon_code',$request->coupon)->first();
        if($data){
            if(date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($data->valid_date))){

                session()->put('coupon',[
                    'coupon_code'=>$request->coupon,
                    'coupon_discount'=>$data->coupon_amount,
                    'after_discount'=>Cart::subtotal()-$data->coupon_amount,
                ]);
                return response()->json(1);
            }
        }else{
            session()->forget('coupon');
            return redirect()->back();
        }

    }

    //order submit

    public function submitOrder(Request $request){

        Validator::make($request->all(),[
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
        ]);

        if(session()->has('coupon')){
            $coupon_code = session()->get('coupon')['coupon_code'];
            $discount_amount = session()->get('coupon')['coupon_discount'];
        }else{
            $coupon_code = 0;
            $discount_amount = 0;
        }


        OrderAddress::insert([
            'user_id'=>auth()->id(),
            'order_id'=>$request->order_id,
            'total'=>Cart::total()+$request->delivery_charge,
            'subtotal'=>Cart::subtotal(),
            'discount_amount'=>$discount_amount,
            'coupon_code'=>$coupon_code,
            'delivery_charge'=>$request->delivery_charge,
            'tax'=>Cart::tax(),
            'payment_by'=>$request->payment,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'extra_phone'=>$request->phone,
            'town'=>$request->town,
            'city'=>$request->city,
            'zip'=>$request->zip,
            'address'=>$request->address,
            'country'=>$request->country,
            'order_date'=>date('Y-m-d'),

        ]);

        foreach(Cart::content() as $product){
        OrderDetail::insert([
            'user_id'=>auth()->id(),
            'order_id'=>$request->order_id,
            'product_id'=> $product->id,
            'product_name'=> $product->name,
            'product_price'=> $product->price,
            'product_quantity'=> $product->qty,
            'product_color'=> $product->options->color,
            'product_size'=> $product->options->size,
            'product_image'=> $product->options->image,
            'order_date'=> date('Y-m-d'),
        ]);

        Product::where('id',$product->id)->decrement('stack_quantity',$product->qty);
        Product::where('id',$product->id)->increment('selling_quantity',$product->qty);
    }

    session()->forget('coupon');
    Cart::destroy();
     return response()->json('Order Successfully Submited!');
    }

   // show recent order
   public function orderStatus(){

    //no implementation
    $address =  OrderAddress::where('user_is',auth()->id())->where('order_date', date('Y-m-d'))->first();
    $orderItems = OrderDetail::where('user_is',auth()->id())->where('order_date', date('Y-m-d'))->get();
    return view('layouts.front-end.cart.order_check', compact('address','orderItems'));
   }

}
