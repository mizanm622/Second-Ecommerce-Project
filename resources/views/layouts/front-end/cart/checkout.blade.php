@extends('layouts.app')

@section('home-content')

@php
$delivery = 0;
@endphp
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="shipping-info">
                <div class="card-header mb-2">
                    <h4 class="text-center">Your Shipping Address</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update.shipping.address') }}" id="update-shipping">
                        @csrf
                        <div class="row mb-3 text-right">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone:') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" value="{{$shippingInfo->phone}}" class="form-control @error('phone') is-invalid @enderror" name="phone" required placeholder="Phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 text-right">
                            <label for="town" class="col-md-4 col-form-label text-md-end">{{ __('Town:') }}</label>

                            <div class="col-md-6">
                                <input id="town" type="text" value="{{$shippingInfo->town}}" class="form-control"  name="town" required placeholder="Town">
                            </div>
                        </div>
                        <div class="row mb-3 text-right">
                            <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('City:') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" value="{{$shippingInfo->city}}" class="form-control"  name="city" required placeholder="City">
                            </div>
                        </div>
                        <div class="row mb-3 text-right">
                            <label for="zip" class="col-md-4 col-form-label text-md-end">{{ __('Zip Code:') }}</label>

                            <div class="col-md-6">
                                <input id="zip" type="number" value="{{$shippingInfo->zip}}" class="form-control"  name="zip" required placeholder="Zip Code">
                            </div>
                        </div>
                        <div class="row mb-3 text-right">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address:') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" type="text" value="" cols="10" rows="3" class="form-control"  name="address" required placeholder="Address">{{$shippingInfo->address}}</textarea>

                            </div>
                        </div>
                        <div class="row mb-3 text-right">
                            <label for="country" class="col-md-4 col-form-label text-md-end">{{ __('Country:') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text" value="{{$shippingInfo->country}}" class="form-control"  name="country" required placeholder="Country">
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="item-area">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Your Items List</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
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
                                @if (session()->has('coupon'))
                                <tr class="text-right">

                                    <th class="text-right" colspan="3">Subtotal:<td colspan="2"><span class=""> {{$settings->currency}} {{Cart::total()}} /-</span></td></th>
                                </tr>

                                <tr>
                                    <th class="text-right" colspan="3">Coupon Code: <td class="text-right" colspan="2">{{session()->get('coupon')['coupon_code']}}</td></th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="3">Coupon Discount: <td class="text-right" colspan="2">(-){{$settings->currency}} {{session()->get('coupon')['coupon_discount']}} /-</td></th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="3">After Discount: <td class="text-right" colspan="2">{{$settings->currency}} {{session()->get('coupon')['after_discount']}} /-</td></th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="3">Delivery Charge:
                                        <td class="text-right" colspan="2">
                                            @if(Cart::total() <= 1000)
                                            @php
                                                $delivery =50;
                                            @endphp
                                            <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>
                                        @elseif(Cart::total() > 1000 and Cart::total() <= 2000)
                                            @php
                                            $delivery =40;
                                            @endphp
                                            <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>

                                        @elseif(Cart::total() > 2000 and Cart::total() <= 3000)
                                            @php
                                            $delivery =30;
                                            @endphp
                                            <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>

                                        @elseif(Cart::total() > 3000 and Cart::total() <= 4000)
                                            @php
                                            $delivery =20;
                                            @endphp
                                            <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>
                                        @elseif(Cart::total() > 4000 and Cart::total() <= 5000)
                                            @php
                                            $delivery =10;
                                            @endphp
                                            <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>
                                        @elseif(Cart::total() > 5000)
                                            @php
                                            $delivery =0;
                                            @endphp
                                            <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>
                                        @endif
                                        </td>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-right" colspan="3">Total Payable: <td class="text-right" colspan="2">{{$settings->currency}} {{session()->get('coupon')['after_discount'] + $delivery}} /-</td></th>
                                </tr>

                                @else
                                <tr class="text-right">
                                    <th class="text-right" colspan="3">Subtotal:<td colspan="2"><span class=""> {{$settings->currency}} {{Cart::total()}} /-</span></td></th>
                                </tr>
                                <tr class="text-right">
                                    <tr class="text-right">
                                        <th class="text-right" colspan="3">Delivery Charge:
                                            <td colspan="2">

                                                @if(Cart::total() <= 1000)
                                                    @php
                                                        $delivery =50;
                                                    @endphp
                                                    <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>
                                                @elseif(Cart::total() > 1000 and Cart::total() <= 2000)
                                                    @php
                                                    $delivery =40;
                                                    @endphp
                                                    <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>

                                                @elseif(Cart::total() > 2000 and Cart::total() <= 3000)
                                                    @php
                                                    $delivery =30;
                                                    @endphp
                                                    <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>

                                                @elseif(Cart::total() > 3000 and Cart::total() <= 4000)
                                                    @php
                                                    $delivery =20;
                                                    @endphp
                                                    <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>
                                                @elseif(Cart::total() > 4000 and Cart::total() <= 5000)
                                                    @php
                                                    $delivery =10;
                                                    @endphp
                                                    <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>
                                                @elseif(Cart::total() > 5000)
                                                    @php
                                                    $delivery =0;
                                                    @endphp
                                                    <span class="">(+){{$settings->currency}} {{$delivery}} /-</span>
                                                @endif

                                            </td>
                                        </th>
                                    </tr>

                                    <tr class="text-right">
                                        <th class="text-right" colspan="3">Total:<td colspan="2"><span class=""> {{$settings->currency}} {{Cart::total()+$delivery}} /-</span></td></th>
                                    </tr>

                                </tr>

                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="payment-area">
                <div id="accordion">
                    <div class="card">
                        <div class="card-header" id="headingThree">
                          <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#coupon-area" aria-expanded="true" aria-controls="collapseOne">
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
                          <button class="btn btn-link" data-toggle="collapse" data-target="#cash-on" aria-expanded="true" aria-controls="collapseOne">
                           Cash on Delivery
                          </button>
                        </h5>
                      </div>

                      <div id="cash-on" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <label for="cash_on">Cash on Delivery:</label>
                            <input type="hidden" name="cash_on" value="0">
                           <input type="checkbox" class="btn btn-lg btn-primary" name="cash_on" value="1">

                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                          <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#online" aria-expanded="false" aria-controls="collapseTwo">
                           Online Payment?
                          </button>
                        </h5>
                      </div>
                      <div id="online" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <ol>
                                <li>Bkash</li>
                                <li>Rocket</li>
                                <li>Nagad</li>
                                <li>Card</li>
                            </ol>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">


        $('#update-shipping').submit(function(e) {
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
                $('#update-shipping').load(location.href+' #update-shipping');

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
                    $('.table').load(location.href+' .table');
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
