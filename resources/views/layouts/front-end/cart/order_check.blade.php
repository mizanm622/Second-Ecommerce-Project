@extends('layouts.app')

@section('home-content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Your Ordered Items</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap table-border">
                        <table class="table table-striped"><!--Product table-->
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $item)
                                    @if ($item->order_id == $address->order_id)
                                        <tr><!--Order Items-->
                                            <td>{{$loop->iteration}}</td>
                                            <td><img src="{{asset($item->product_image)}}" alt="{{$item->product_image}}" width="40" height="40"></td>
                                            <td>{{$item->product_name}}</td>
                                            <td>{{$item->product_quantity}}</td>
                                            <td>{{$item->product_color}}</td>
                                            <td>{{$item->product_size}}</td>
                                            <td>{{$settings->currency}}{{$item->product_price}} /-</td>
                                        </tr><!--End Order Items-->
                                    @endif
                                @endforeach
                                    <!--Items Calculatio-->
                                    <tr class="text-right"><th class="text-right" colspan="6">Subtotal:<td colspan="1">{{$settings->currency}} {{$address->subtotal}} /-</td></th></tr>
                                    @if($address->coupon_code == 0)

                                    @else
                                        <tr class="text-right"><th class="text-right" colspan="6">Coupon Code:<td colspan="1">{{$address->coupon_code}}</td></th></tr>
                                        <tr class="text-right"><th class="text-right" colspan="6">Discount:<td colspan="1">(-) {{$settings->currency}} {{$address->discount_amount}} /-</td></th></tr>
                                    @endif
                                    <tr class="text-right"><th class="text-right" colspan="6">Tax:<td colspan="1">(+) {{$settings->currency}} {{$address->tax}} /-</td></th></tr>
                                    <tr class="text-right"><th class="text-right" colspan="6">Delivery Charge:<td colspan="1">(+) {{$settings->currency}} {{$address->delivery_charge}} /-</td></th></tr>
                                    <tr class="text-right"><th class="text-right" colspan="6">Total Paid:<td colspan="1">{{$settings->currency}} {{$address->total}} /-</td></th></tr>
                                        <!--End Items Calculatio-->

                                    <div class="address"><!--Shipping address-->
                                        <span class="bg-dark text-light h6 my-2">Shipping Address</span>
                                        <p class="m-0 p-0 text-dark">   Phone:<span>{{$address->phone}}</span></p>
                                        <p class="m-0 p-0 text-dark">   Email:<span>{{$address->email}}</span></p>
                                        <p class="m-0 p-0 text-dark"> Address:<span>{{$address->address}}</span></p>
                                        <p class="m-0 p-0 text-dark">    Town:<span>{{$address->town}}</span></p>
                                        <p class="m-0 p-0 text-dark">    City:<span>{{$address->city}}</span></p>
                                        <p class="m-0 p-0 text-dark">Zip Code:<span>{{$address->zip}}</span></p>
                                        <p class="m-0 p-0 text-dark"> Country:<span>{{$address->country}}</span></p>
                                        <p class="text-dark"> Order Status:<span class="text-center col-4"><a href="javascript:void(0)" id="status" data-status="{{$address->status}}" data-id="{{$address->id}}"> {!!$address->status == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</a></span></p>
                                    </div><!--End Shipping address-->
                            </tbody>
                        </table><!--End Product table-->
                        <div class="back-home">
                            <a href="{{url('/')}}" class="btn btn-primary btn-md">Back Home</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>



</div>


@endsection
