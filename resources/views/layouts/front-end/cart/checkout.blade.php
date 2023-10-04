@extends('layouts.app')

@section('home-content')

@php
    $order_id=rand();
@endphp
<div class="container">
    <!--Order submit form-->
    <form action="{{route('submit.order')}}" method="post" id="order-submit">
        @csrf
        <div class="row">
            <div class="col-4">
                <div class="shipping-info"><!--Shipping address area-->
                    <div class="card-header mb-2">
                        <h4 class="text-center">Your Shipping Address</h4>
                    </div>
                    <div class="card-body">
                            <div class="row mb-3 text-right">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone:') }}</label>

                                <div class="col-">
                                    <input id="phone" type="text" value="{{$shippingInfo->phone}}" class="form-control @error('phone') is-invalid @enderror" name="phone" required placeholder="Phone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 text-right">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email:') }}</label>

                                <div class="col-">
                                    <input id="email" type="text" value="{{$shippingInfo->email}}" class="form-control"  name="email" required placeholder="Email">
                                </div>
                            </div>
                            <div class="row mb-3 text-right">
                                <label for="town" class="col-md-4 col-form-label text-md-end">{{ __('Town:') }}</label>

                                <div class="col-">
                                    <input id="town" type="text" value="{{$shippingInfo->town}}" class="form-control"  name="town" required placeholder="Town">
                                </div>
                            </div>
                            <div class="row mb-3 text-right">
                                <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('City:') }}</label>

                                <div class="col-">
                                    <input id="city" type="text" value="{{$shippingInfo->city}}" class="form-control"  name="city" required placeholder="City">
                                </div>
                            </div>
                            <div class="row mb-3 text-right">
                                <label for="zip" class="col-md-4 col-form-label text-md-end">{{ __('Zip Code:') }}</label>

                                <div class="col-">
                                    <input id="zip" type="number" value="{{$shippingInfo->zip}}" class="form-control"  name="zip" required placeholder="Zip Code">
                                </div>
                            </div>
                            <div class="row mb-3 text-right">
                                <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address:') }}</label>

                                <div class="col-">
                                    <textarea id="address" type="text" value="" cols="20" rows="3" class="form-control"  name="address" required placeholder="Address">{{$shippingInfo->address}}</textarea>

                                </div>
                            </div>
                            <div class="row mb-3 text-right">
                                <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country:') }}</label>

                                <div class="col-">
                                    <input id="country" type="text" value="{{$shippingInfo->country}}" class="form-control"  name="country" required placeholder="Country">
                                </div>
                            </div>
                            <input type="hidden" name="delivery_charge" value="{{$delivery}}">
                            <input type="hidden" name="order_id" value="{{$order_id}}">
                            <div class="row mb-0">
                                <div class="col-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Submit Order') }}
                                    </button>
                                </div>
                            </div>
                    </div>
                </div><!--End Shipping address area-->
            </div>
            <div class="col-4">
                <div class="item-area">
                    <div class="card"><!--Items area-->
                        <div class="card-header">
                            <h4 class="text-center">Your Items List</h4>
                        </div>
                        <div class="card-body">
                            <table class="table"><!--Product table-->
                                <tbody>
                                @foreach ($cartProducts as $product)
                                    <tr>
                                        <td><img src="{{asset($product->options->image)}}" alt="{{$product->thumbnail}}" width="20" height="20"></td>
                                        <td>{{substr($product->name,0,10)}}</td>
                                        <td>{{$settings->currency}} {{$product->price}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>{{$settings->currency}} {{$product->price*$product->qty}}</td>

                                    </tr>
                                    @endforeach
                                    <tr class="text-right">
                                        <th class="text-right" colspan="2">Subtotal:<td colspan="3"><span class=""> {{$settings->currency}} {{Cart::subtotal()}} /-</span></td></th>
                                    </tr>
                                </tbody>
                            </table><!--End Product table-->
                        </div>
                    </div><!--End Items area-->
                </div>
            </div>
            <div class="col-4">
                <div class="payment-area">
                    <div class="card"><!--Order calculation area-->
                        <div class="card-header">
                            <h4 class="text-center">Orders Calculation</h4>
                        </div>
                        <div class="card-body">
                            <table class="table" id="calculation-area">
                                <tbody>
                                    @if (session()->has('coupon'))
                                    <tr class="text-right">

                                        <th class="text-right" colspan="3">Subtotal:<td colspan="2"><span class=""> {{$settings->currency}} {{Cart::subtotal()}} /-</span></td></th>
                                    </tr>

                                    <tr>
                                        <th class="text-right" colspan="3">Coupon Code: <td class="text-right" colspan="2">{{session()->get('coupon')['coupon_code']}}</td></th>
                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="3">Coupon Discount: <td class="text-right" colspan="2">(-) {{$settings->currency}} {{session()->get('coupon')['coupon_discount']}} /-</td></th>
                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="3">After Discount: <td class="text-right" colspan="2">{{$settings->currency}} {{session()->get('coupon')['after_discount']}} /-</td></th>
                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="3">Delivery Charge:<td class="text-right" colspan="2"><span class="">(+) {{$settings->currency}} {{$delivery}} /-</span></td></th>
                                    </tr>
                                    <tr class="text-right">
                                        <th class="text-right" colspan="3">Tax (10%):<td colspan="2"><span class="">(+) {{$settings->currency}} {{Cart::tax();}} /-</span></td></th>
                                    </tr>
                                    <tr>
                                        <th class="text-right" colspan="3">Total Payable: <td class="text-right" colspan="2">{{$settings->currency}} {{session()->get('coupon')['after_discount'] + Cart::tax() + $delivery}} /-</td></th>
                                    </tr>

                                    @else
                                    <tr class="text-right">
                                        <th class="text-right" colspan="3">Subtotal:<td colspan="2"><span class=""> {{$settings->currency}} {{Cart::subtotal()}} /-</span></td></th>
                                    </tr>
                                    <tr class="text-right">
                                        <th class="text-right" colspan="3">Delivery Charge:<td colspan="2"><span class="">(+) {{$settings->currency}} {{$delivery}} /-</span></td></th>
                                    </tr>
                                    <tr class="text-right">
                                        <th class="text-right" colspan="3">Tax (10%):<td colspan="2"><span class="">(+) {{$settings->currency}} {{Cart::tax();}} /-</span></td></th>
                                    </tr>

                                    <tr class="text-right">
                                        <th class="text-right" colspan="3">Total:<td colspan="2"><span class=""> {{$settings->currency}} {{Cart::total()+$delivery}} /-</span></td></th>
                                    </tr>

                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div><!--Order calculation area-->
                    <!--Coupon & Payment section-->
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed fas fa-rocket" data-toggle="collapse" data-target="#coupon-area" aria-expanded="true" aria-controls="collapseOne">
                                    Have a Copoun Code?
                                </button>
                            </h5>
                            </div>
                            <div id="coupon-area" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">

                                <div class="row mb-3 text-right">
                                    <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Apply Coupon:') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="coupon" id="coupon">
                                        <span class="status"></span>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                            <button class="btn btn-link collapsed fas fa-rocket" data-toggle="collapse" data-target="#cash-on" aria-expanded="true" aria-controls="collapseOne">
                            Cash on Delivery
                            </button>
                            </h5>
                        </div>
                        <div id="cash-on" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <label for="cash_on">Cash on Delivery:</label>
                                <input type="hidden" name="payment" value="cash-on">
                            <input type="checkbox" class="btn btn-lg btn-primary" name="payment" value="cash-on">
                            </div>
                        </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                <button class="btn btn-link collapsed fas fa-rocket" data-toggle="collapse" data-target="#online" aria-expanded="false" aria-controls="collapseTwo">
                                Online Payment?
                                </button>
                                </h5>
                            </div>
                            <div id="online" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <label for="cash_on">Bkash/Rocket/Nagad</label>
                                    <input type="checkbox" name="payment" value="online" required>
                                </div>
                            </div>
                        </div>
                    </div><!--End Coupon & Payment section-->
                </div>
            </div>
        </div>
    </form><!--End Order submit form-->
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
        // order submit
        $('#order-submit').submit(function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $.ajax({
            url: url,
            type: 'post',
            anyne: false,
            async: false,
            data: request,
            success:function(data) {
                toastr.success(data);
                $('#order-submit')[0].reset();
                $('.table').load(location.href+' .table');
                $('.cart').load(location.href+' .cart');

            }
        });
        });

          // check coupon
        $(document).on('blur','#coupon',function(e){
            e.preventDefault();
            let coupon = $(this).val();
            var url = '{{route("check.coupon")}}';
            $.ajax({
                url: url,
                type: 'get',
                async: false,
                data: {
                    coupon : coupon,
                },
                success:function(data){
                    $('#calculation-area').load(location.href+' #calculation-area');
                    if(data == 1){
                        $('.status').text('Valid');
                    }else{
                        $('.status').text('In Valid');
                    }

                    // toastr.success(data);
                    // $('.table').load(location.href+' .table');
                    // $('.cart_section').load(location.href+' .cart_section');
                }
            });
        });

</script>
@endsection
