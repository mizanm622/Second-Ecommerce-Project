<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    //show pending orders from here
    public function orderPendng(){

        $address =  OrderAddress ::where('status',0)->get();
        $orderItems = OrderDetail::all();

      return view('admin.orders.orders',compact('address','orderItems'));
    }
    //show pending orders from here
    public function orderTracking(){
        $address =  OrderAddress ::where('status',1)->where('tracking',0)->get();
        $orderItems = OrderDetail::all();

      return view('admin.orders.tracking_orders',compact('address','orderItems'));
    }
    //show pending orders from here
    public function orderComplete(){

        $address =  OrderAddress ::where('status',1)->where('tracking',1)->get();
        $orderItems = OrderDetail::all();
      return view('admin.orders.complete_orders',compact('address','orderItems'));
    }

    // status change
    public function orderStatus(Request $request){

        OrderAddress::where('id',$request->id)->update(['status' => $request->status == 1 ? 0 : 1]);

        return response()->json('Status Successfully Changed!');

    }
     // status change
     public function trackingStatus(Request $request){

        OrderAddress::where('id',$request->id)->update(['tracking' => $request->tracking == 1 ? 0 : 1]);

        return response()->json('Tracking Successfully Changed!');

    }
}
