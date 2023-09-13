@extends('layouts.app')

@section('home-content')

<!-- Cart -->
@php
    $cart = Cart::count();
@endphp
<div class="cart_section">
    <div class="container">
        <div class="row">
            <div class="col">
                @if ($cart == 0)
                <div class="empty-cart text-center mb-5">

                    <img src="front-end/assets/images/shopping-cart.png" alt="" class="img-responsive m-auto" width="150" height="150">
                </div>
               @else
            </div>

            <div class="col-lg-10 offset-lg-1">
                <div class="cart_container">
                    <div class="cart_title">Shopping Cart</div>
                     @foreach ($cartProducts as $product)
                        @php
                        $products= App\Models\Product::where('id',$product->id)->first();
                        $colors=explode(',',$products->color);
                        $sizes=explode(',',$products->size);
                        @endphp
                        <div class="cart_items">
                            <ul class="cart_list">
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image" style="width:70px; height:100px"><img src="{{asset($product->options->image)}}" alt="{{$product->options->image}}" class="img-responsive img-thumbnail" width="60" height="90"></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">{{$product->name}}</div>
                                        </div>
                                        @if($product->options->color == null)
                                        @else
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Color</div>
                                            <div class="cart_item_text">
                                                <select type="text" data-id="{{$product->rowId}}" id="color" class="form-control form-control-sm ml-0" name="color" style="width:80px" >
                                                    @foreach ($colors as $color)
                                                    <option value="{{$color}}" @if($color == $product->options->color) selected="" @endif>{{$color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        @if($product->options->size == null)

                                        @else
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Size</div>
                                            <div class="cart_item_text">
                                                <select type="text" data-id="{{$product->rowId}}" id="size" class="form-control form-control-sm ml-0" name="size" style="width:80px" >
                                                    @foreach ($sizes as $size)
                                                    <option value="{{$size}}" @if($size == $product->options->size) selected="" @endif>{{$size}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div>
                                            <div class="cart_item_text">

                                                <input name="quantity" id="quantity" data-id="{{$product->rowId}}" class="form-control form-control-sm " type="number" min="1" pattern="[1-9]*" value="{{$product->qty}}" style="width:80px">
                                            </div>
                                        </div>
                                        <div class="cart_item_price cart_info_col">
                                            <div class="cart_item_title">Unit Price</div>
                                            <div class="cart_item_text">{{$settings->currency}}{{$product->price}}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Subtotal</div>
                                            <div class="cart_item_text">{{$settings->currency}}{{$product->price*$product->qty}}</div>
                                        </div>
                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title">Action</div>
                                            <div class="cart_item_text">
                                                <a href="javascript:void(0)" id="delete" data-id="{{$product->rowId}}"><span class="fas fa-trash text-danger"></span> </a>

                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    @endforeach
                    <!-- Order Total -->
                    <div class="order_total">
                        <div class="order_total_content text-md-right">
                            <div class="order_total_title">Order Total:</div>
                    <div class="order_total_amount">{{$settings->currency}}{{Cart::total()}}</div>
                        </div>
                    </div>

                    <div class="cart_buttons">
                         <a id="destroy-item" class="button cart_button_clear text-danger" href="{{route('cart.item.destroy')}}">Empty Cart</a>
                         <a id="check-out" class="button cart_button_checkout" href="{{route('checkout')}}">Check Out</a>

                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
           // delete data
        $(document).on('click','#delete',function(e){
            e.preventDefault();
        let id=$(this).data('id');
        $.get('/cart-item-remove/'+id, function(data){
            toastr.success(data);
            $('.cart').load(location.href+' .cart');
            $('.cart_section').load(location.href+' .cart_section');
        });
        });

        // destroy all item
        $(document).on('click','#destroy-item',function(e){
            e.preventDefault();
         var url = '{{route("cart.item.destroy")}}';
            $.ajax({
                url: url,
                type: 'get',
                async: false,
                success:function(data) {
                    toastr.success(data);
                    $('.cart').load(location.href+' .cart');
                    $('.cart_section').load(location.href+' .cart_section');
                }
        });
    });

        // update quantity
        $(document).on('blur','#quantity',function(e){
            e.preventDefault();
            var rowId = $(this).data('id');
            var qty = $(this).val();
            var url = '{{route("cart.qty.update")}}';
            $.ajax({
                url: url,
                type: 'get',
                async: false,
                data: {
                    qty   : qty,
                    rowId : rowId,
                },
                success:function(data) {
                    toastr.success(data);
                    $('.cart').load(location.href+' .cart');
                    $('.cart_section').load(location.href+' .cart_section');
                }
            });
    });

     // update size
     $(document).on('change','#size',function(e){
            e.preventDefault();
            var rowId = $(this).data('id');
            var size = $(this).val();
            var url = '{{route("cart.size.update")}}';
            $.ajax({
                url: url,
                type: 'get',
                async: false,
                data: {
                    size   : size,
                    rowId : rowId,
                },
                success:function(data) {
                    toastr.success(data);

                }
            });
    });

     // update color
     $(document).on('change', '#color', function(e){
             e.preventDefault();
            var rowId = $(this).data('id');
            var color = $(this).val();
            var url = '{{route("cart.color.update")}}';
            $.ajax({
                url: url,
                type: 'get',
                async: false,
                data: {
                    color : color,
                    rowId : rowId,
                },
                success:function(data) {
                     toastr.success(data);
                     $('.cart_section').load(location.href+' .cart_section');
                }
            });
    });

</script>
@endsection
