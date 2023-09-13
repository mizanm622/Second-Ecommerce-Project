@extends('layouts.app')

@section('home-content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>Your Ordered Items</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Color</th>
                                <th>Size</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                            <tr>
                                <td>1</td>
                                <td><img src="{{asset($item->product_image)}}" alt="{{$item->product_image}}" width="40" height="40"></td>
                                <td>{{$item->product_name}}</td>
                                <td>{{$item->product_price}}</td>
                                <td>{{$item->product_quantity}}</td>
                                <td>{{$item->product_color}}</td>
                                <td>{{$item->product_size}}</td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>Your Shipping Address</h5>
                </div>
                <div class="card-body">
                    <div class="col-6">
                        <table class="table">
                            <tbody>
                                <tr>Subtotal:<td>{{$address->subtotal}} /-</td></tr>
                                <tr>Coupon Code:<td>{{$address->coupon_code}}</td></tr>
                                <tr>Discount:<td>(-) {{$address->discount_amount}} /-</td></tr>
                                <tr>Tax:<td>(+) {{$address->tax}} /-</td></tr>
                                <tr>Delivery Charge:<td>(+) {{$address->delivery_charge}} /-</td></tr>
                                <tr>Total Paid:<td>{{$address->total}} /-</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table">
                                <tr><th>Phone:<td>{{$address->phone}}</td></th></tr>
                                <tr><th>Email:<td>{{$address->email}}</td></th></tr>
                                <tr><th>Area:<td>{{$address->address}}</td></th></tr>
                                <tr><th>Town:<td>{{$address->town}}</td></th></tr>
                                <tr><th>City:<td>{{$address->city}}</td></th></tr>
                                <tr><th>Zip:<td>{{$address->zip}}</td></th></tr>
                                <tr> <th>Country:<td>{{$address->country}}</td></th></tr>
                                <tr><th>Order Id:<td>{{$address->order_id}}</td></th></tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
