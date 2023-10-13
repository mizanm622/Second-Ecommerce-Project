<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use App\Models\PaymentGateway;
use App\Models\Product;
use App\Models\Shipping;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    // data send to checkout page
    public function index(){

        if(!auth()->check())
        {
            $notification=array('msg' => 'Please login to continue! ', 'alert-type' => 'info');
            return redirect()->back()->with($notification);
        }else
        {
        if(count(Cart::content()) <1 ){
            return redirect()->route('home');
        }else
        {
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

    public function submitOrder(Request $request)
    {

        Validator::make($request->all(),[
            'phone'=>'required',
            'email'=>'required',
            'address'=>'required',
            'payment'=>'required',

        ]);

        $order_id=rand(); // order id randomly generated
        // check payment method
        if($request->payment == 'cash-on')
        {
            if(session()->has('coupon'))
            {
                $coupon_code = session()->get('coupon')['coupon_code'];
                $discount_amount = session()->get('coupon')['coupon_discount'];
            }else
            {
                $coupon_code = 0;
                $discount_amount = 0;
            }


            OrderAddress::insert([
                'user_id'=>auth()->id(),
                'order_id'=>$order_id,
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
                'order_id'=>$order_id,
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

        $notification=array('msg' => 'Order Successfully Submited!', 'alert-type' => 'info');
        return redirect()->route('recent.order')->with($notification);

        }elseif($request->payment == 'online')
        {
            $aamer_pay = PaymentGateway::first();

            if($aamer_pay->store_id == null)
            {
                return response()->json('Store Id Not Found');
            }else
            {
                if($aamer_pay->status == 1)
                {
                    $url = "https://secure.aamarpay.com/jsonpost.php"; // for Live Transection use

                }else
                {
                    $url = "https://sandbox.aamarpay.com/jsonpost.php"; // for Sandbox Transection use
                }

                $tran_id =rand(1111111,9999999);//unique transection id for every transection
                //$tran_id = "test".rand(1111111,9999999);//unique transection id for every transection

                $currency= "BDT"; //aamarPay support Two type of currency USD & BDT

                $amount = Cart::total()+$request->delivery_charge;   //10 taka is the minimum amount for show card option in aamarPay payment gateway
               // $amount = "10";   //10 taka is the minimum amount for show card option in aamarPay payment gateway

                //For live Store Id & Signature Key please mail to support@aamarpay.com


                //$signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";



                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "store_id": "'.$aamer_pay->store_id.'",
                    "tran_id": "'.$tran_id.'",
                    "success_url": "'.route('success').'",
                    "fail_url": "'.route('fail').'",
                    "cancel_url": "'.route('cancel').'",
                    "amount": "'.$amount.'",
                    "delivery_charge": "'.$request->delivery_charge.'",
                    "currency": "'.$currency.'",
                    "signature_key": "'.$aamer_pay->signature_key.'",
                    "desc": "Merchant Registration Payment",
                    "cus_name": "'.auth()->user()->name.'",
                    "cus_email": "'.$request->email.'",
                    "cus_add1": "'.$request->address.'",
                    "cus_add2":  "'.$request->town.'",
                    "cus_city":  "'.$request->city.'",
                    "cus_state":  "'.$request->city.'",
                    "cus_postcode": "'.$request->zip.'",
                    "cus_country":  "'.$request->country.'",
                    "cus_phone":  "'.$request->phone.'",
                    "type": "json"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                // dd($response);

                $responseObj = json_decode($response);

                if(isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

                    $paymentUrl = $responseObj->payment_url;
                    // dd($paymentUrl);
                    return redirect()->away($paymentUrl);

                }else{
                    echo $response;
                }

                    }
                }
    }

    public function success(Request $request)
    {

        $order_id=rand(); // order id randomly generated
        $request_id= $request->mer_txnid;

        //verify the transection using Search Transection API

        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php?request_id=$request_id&store_id=aamarpaytest&signature_key=dbb74894e82415a2f7ff0ec3a97e4183&type=json";

        //For Live Transection Use "http://secure.aamarpay.com/api/v1/trxcheck/request.php"

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       // echo $response;

        if(session()->has('coupon'))
        {
            $coupon_code = session()->get('coupon')['coupon_code'];
            $discount_amount = session()->get('coupon')['coupon_discount'];
        }else
        {
            $coupon_code = 0;
            $discount_amount = 0;
        }

        $order_address = OrderAddress::insert([
            'user_id'=>auth()->id(),
            'order_id'=>$order_id,
            'total'=>$request->amount,
            'subtotal'=>Cart::subtotal(),
            'discount_amount'=>$discount_amount,
            'coupon_code'=>$coupon_code,
            'delivery_charge'=>$request->delivery_charge,
            'tax'=>Cart::tax(),
            'payment_by'=>$request->payment_processor,
            'email'=>$request->cus_email,
            'phone'=>$request->cus_phone,
            'extra_phone'=>$request->cus_phone,
            'town'=>$request->cus_add2,
            'city'=>$request->cus_city,
            'zip'=>$request->cus_postcode,
            'address'=>$request->cus_add1,
            'country'=>$request->cus_country,
            'order_date'=>date('Y-m-d'),

        ]);

        foreach(Cart::content() as $product){
        $order_details = OrderDetail::insert([
            'user_id'=>auth()->id(),
            'order_id'=>$order_id,
            'product_id'=> $product->id,
            'product_name'=> $product->name,
            'product_price'=> $product->price,
            'product_quantity'=> $product->qty,
            'product_color'=> $product->options->color,
            'product_size'=> $product->options->size,
            'product_image'=> $product->options->image,
            'order_date'=> date('Y-m-d'),
        ]);

        //Mail::to(auth()->user()->email)->send(new InvoiceMail($order_address));

        Product::where('id',$product->id)->decrement('stack_quantity',$product->qty);
        Product::where('id',$product->id)->increment('selling_quantity',$product->qty);
    }



    session()->forget('coupon');
    Cart::destroy();
     return response()->json('Order Successfully Submited!');

    }


    public function fail(Request $request)
    {
        return $request;
    }

    public function cancel(){
        return 'Canceled';
    }

   // show recent order
   public function orderStatus(){

    //no implementation
    $address =  OrderAddress::where('user_id',auth()->id())->where('order_date', date('Y-m-d'))->orderBy('id', 'DESC')->first();
    $orderItems = OrderDetail::where('user_id',auth()->id())->where('order_date', date('Y-m-d'))->get();
    return view('layouts.front-end.cart.order_check', compact('address','orderItems'));
   }

}
