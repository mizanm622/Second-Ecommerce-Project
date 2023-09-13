@extends('layouts.app')

@section('home-content')

<div class="container">
    <div class="row mx-5">
        <div class="col-4">
            <div class="header-area">
                <div class="card text-center">
                    <div class="user_logo">
                        <img src="{{asset('assets/img/avatars/1.png')}}" alt="" class="img-thumbnail rounded-circle" width="120" height="120">
                    </div>
                    <div class="name p-2">
                        <h4 ><span class="text-danger">Welcome,</span> {{auth()->user()->name}}</h4>
                    </div>
                </div>
            </div>
            <div class="user_option">
                <div class="card">
                    <ul>
                        <li><button class="btn btn-link fas fa-home" data-toggle="collapse" data-target="#Home" aria-expanded="true" aria-controls="Home">
                           Home
                          </button></li>
                        <li><button class="btn btn-link fas fa-shopping-cart collapsed" data-toggle="collapse" data-target="#Orders" aria-expanded="false" aria-controls="Orders">
                           My Orders
                          </button></li>
                        <li><button class="btn btn-link collapsed fas fa-heart" data-toggle="collapse" data-target="#Wishlist" aria-expanded="false" aria-controls="Wishlist">
                            Wishlist
                        </button></li>
                        <li><button class="btn btn-link collapsed fas fa-cogs" data-toggle="collapse" data-target="#Setting" aria-expanded="false" aria-controls="Setting">
                            Setting
                         </button></li>
                          <li><button class="btn btn-link collapsed fas fa-lock" data-toggle="collapse" data-target="#Update-Profile" aria-expanded="false" aria-controls="Update-Profile">
                            Change Password
                         </button></li>

                    </ul>
                </div>

            </div>

        </div>
        <div class="col-8">
            <div id="accordion">
                <div class="card">
                  <div id="Home" class="collapse show" aria-labelledby="Home" data-parent="#accordion">
                    <div class="card-body">
                        <div class="boxs">
                            <div class="row">
                                <div class="col-4">
                                    <div class="single-box bg-info">
                                        <h4 class="title text-center pt-2">Total Orders</h4>
                                        <h5 class="value text-dark h5">{{count($address)}}</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="single-box bg-warning">
                                        <h4 class="title text-center pt-2">Total Cost</h4>
                                        @php
                                            $cost = 0;
                                        @endphp
                                         @foreach ($address as $item)
                                        @php
                                              $cost+=$item->total;
                                        @endphp
                                         @endforeach
                                        <h5 class="value text-dark h5"> {{$settings->currency}} {{$cost}}/-</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="single-box bg-success" >
                                        <h4 class="title text-center pt-2">Save Money</h4>
                                        @php
                                        $discount = 0;
                                        @endphp
                                        @foreach ($address as $item)
                                        @php
                                            $discount+=$item->discount_amount;
                                        @endphp
                                        @endforeach
                                        <h5 class="value text-dark h5"> {{$settings->currency}} {{$discount}}/-</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <!--order area-->
                  <div id="Orders" class="collapse" aria-labelledby="Orders" data-parent="#accordion">

                    @foreach ($address as $items)
                    <div class="single-area">
                        <div class="card-header">
                            <button class="btn btn-block btn-primary" type="button" data-toggle="collapse" data-target="#{{$items->id}}" aria-expanded="false" aria-controls="collapseExample">
                                <div class=""> <span class="text-left col-4">#{{$loop->iteration}} Your Ordered Items</span>  <span class="text-center col-4">{!!$items->status == null ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</span> <span class="text-right col-4">{{$items->order_date}}</span></div>
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="collapse" id="{{$items->id}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table">
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
                                                    @if ($items->order_id == $item->order_id)



                                                    <tr>
                                                        <td>1</td>
                                                        <td><img src="{{asset($item->product_image)}}" alt="{{$item->product_image}}" width="40" height="40"></td>
                                                        <td>{{$item->product_name}}</td>
                                                        <td>{{$item->product_quantity}}</td>
                                                        <td>{{$item->product_color}}</td>
                                                        <td>{{$item->product_size}}</td>
                                                        <td>{{$item->product_price}}</td>

                                                    </tr>
                                                    @endif
                                                    @endforeach

                                                        <tr class="text-right"><th class="text-right" colspan="3">Subtotal:<td colspan="4">{{$settings->currency}} {{$items->subtotal}} /-</td></th></tr>
                                                        @if($items->coupon_code == 0)

                                                        @else
                                                        <tr class="text-right"><th class="text-right" colspan="3">Coupon Code:<td colspan="4">{{$items->coupon_code}}</td></th></tr>
                                                        <tr class="text-right"><th class="text-right" colspan="3">Discount:<td colspan="4">(-) {{$settings->currency}} {{$items->discount_amount}} /-</td></th></tr>
                                                        @endif
                                                        <tr class="text-right"><th class="text-right" colspan="3">Tax:<td colspan="4">(+) {{$settings->currency}} {{$items->tax}} /-</td></th></tr>
                                                        <tr class="text-right"><th class="text-right" colspan="3">Delivery Charge:<td colspan="4">(+) {{$settings->currency}} {{$items->delivery_charge}} /-</td></th></tr>
                                                        <tr class="text-right"><th class="text-right" colspan="3">Total Paid:<td colspan="4">{{$settings->currency}} {{$items->total}} /-</td></th></tr>

                                                    <div class="address">
                                                        <span class="bg-dark text-light h6 my-2">Shipping Address</span>
                                                        <h5>   Phone:<span>{{$items->phone}}</span></h5>
                                                        <h5>   Email:<span>{{$items->email}}</span></h5>
                                                        <h5> Address:<span>{{$items->address}}</span></h5>
                                                        <h5>    Town:<span>{{$items->town}}</span></h5>
                                                        <h5>    City:<span>{{$items->city}}</span></h5>
                                                        <h5>Zip Code:<span>{{$items->zip}}</span></h5>
                                                        <h5> Country:<span>{{$items->country}}</span></h5>
                                                    </div>
                                                </tbody>
                                            </table>
                                        </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  </div>

                  <div id="Wishlist" class="collapse" aria-labelledby="Wishlist" data-parent="#accordion">
                    <div class="card-body">
                    @if (count($wishlist)<=0)
                    <h4 class="text-danger">Empty Wishlist....</h4>
                    @else
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Regular Price</th>
                            <th>Discount Price</th>
                            <th>Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlist as $product)
                        <tr>
                            <td>
                                <img src="{{asset($product->product->thumbnail)}}" alt="{{$product->product->thumbnail}}" width="20" height="40"></td>
                            <td>{{substr($product->product->name, 0, 15)}}...</td>
                            <td><span class="text-danger">{{$settings->currency}}</span> {{$product->product->selling_price}}</td>
                            @if ($product->product->discount_price == 0)
                                <td><span class="text-danger">{{$settings->currency}}</span> 0</td>
                            @else
                            <td> <span class="text-danger">{{$settings->currency}}</span> {{$product->product->discount_price}}</td>
                            @endif
                            <td>{{$product->created_at->format('d-m-Y')}}</td>
                            <td><a class="p-1" href="javascript:void(0)" id="delete" data-id="{{$product->product_id}}"><span class="fas fa-trash text-danger"></span></a>
                                <a class="p-1" href="{{route('wishlist')}}"><span class="fas fa-shopping-cart"></span></a></td>
                        </tr>
                        @endforeach

                    </tbody>
                  </table>
                  @endif
                    </div>
                  </div>
                  <!--Shipping info-->
                  <div id="Setting" class="collapse" aria-labelledby="Setting" data-parent="#accordion">
                    <div class="card-body">
                        <div class="card-header bg-primary text-light mb-2">
                            <h4 class="text-center">Add Your Shipping Info</h4>
                        </div>
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
                  <!--Update Profile area-->
                  <div id="Update-Profile" class="collapse" aria-labelledby="Update-Profile" data-parent="#accordion">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.change.password') }}" id="change-password">
                            @csrf
                            <div class="row mb-3 text-right">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Old Password :') }}</label>

                                <div class="col-md-6">
                                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old-password">

                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 text-right">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password :') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 text-right">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm New Password :') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
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
              </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
           // delete wishlist
        $(document).on('click','#delete',function(e){
            e.preventDefault();
            let id = $(this).data('id');
            let url = '/remove/wishlist/'+id;
            $.ajax({
                 url : url,
                type : 'get',
               async : false,
               success:function(data){
                toastr.success(data);
                $('.table').load(location.href+' .table');
                $('.wishlist_content').load(location.href+' .wishlist_content');
               }
            });
        });
        //change password
        $('#change-password').submit(function(e) {
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
                $('#change-password')[0].reset();
            }
        });
        });

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
</script>


<style type="text/css">
.single-box {
    border-top-right-radius: 55px;
    border-bottom-left-radius: 55px;
    width: 100%;
    height: 180px;
}
.title {
    background: #6eb1c1;
    border-top-right-radius: 33px;
    padding: 10px;
}
    .value {
    width: 130px;
    height: 70px;
    border-radius: 12px;
    background: #ffffff;
    margin: 15px auto;
    text-align: center;
    padding: 22px 5px;
    font-size: 14px;
    font-weight: 400;
}
</style>
@endsection
