@extends('layouts.app')

@section('home-content')

<!-- Cart -->
@php
    $wishlistCount = $wishlists->count();
@endphp
<div class="cart_section">
    <div class="container">

        <div class="row">
            <div class="col">
                @if ($wishlistCount == 0)
                <div class="empty-cart text-center mb-5">

                    <img src="front-end/assets/images/wishlist-logo.png" alt="" class="img-responsive m-auto" width="150" height="150">
                </div>
               @else
            </div>
            <div class="col-lg-12 offset-lg-1">
                <div class="cart_container">

                    <div class="cart_title">Your Wishlists</div>
                     @foreach ($wishlists as $product)
                        @php
                        $colors=explode(',',$product->product->color);
                        $sizes=explode(',',$product->product->size);
                        @endphp

                        <div class="cart_items" id="wishlist-item">

                            <ul class="cart_list">
                                <li class="cart_item clearfix">
                                    <div class="cart_item_image" style="width:70px; height:100px"><img src="{{asset($product->product->thumbnail)}}" alt="{{$product->product->thumbnail}}" class="img-responsive img-thumbnail" width="60" height="90"></div>
                                    <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">

                                        <div class="cart_item_name cart_info_col">
                                            <div class="cart_item_title">Name</div>
                                            <div class="cart_item_text">{{$product->product->name}}</div>
                                            <input type="hidden" id="name" value="{{$product->product->name}}" name="name">
                                            <input type="hidden" id="image" value="{{$product->product->thumbnail}}" name="image">

                                        </div>

                                        @isset($product->product->color)
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Color</div>
                                            <div class="cart_item_text">
                                                <select type="text"  id="color" class="form-control form-control-sm ml-0" name="color" style="width:80px" >
                                                    @foreach ($colors as $color)
                                                    <option value="{{$color}}">{{$color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endisset
                                        @isset($product->product->size)
                                        <div class="cart_item_color cart_info_col">
                                            <div class="cart_item_title">Size</div>

                                            <div class="cart_item_text">
                                                <select type="text" id="size" class="form-control form-control-sm ml-0" name="size" style="width:80px" >
                                                    @foreach ($sizes as $size)
                                                    <option value="{{$size}}">{{$size}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        @endisset

                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Quantity</div>
                                            <div class="cart_item_text">

                                                <input name="quantity" id="quantity"  class="form-control form-control-sm " type="number" min="1" pattern="[1-9]*" value="1" style="width:80px">
                                            </div>
                                        </div>

                                        @if ($product->product->discount_price == 0)

                                        <div class="cart_item_price cart_info_col">
                                            <input type="hidden" value="{{$product->product->selling_price}}" id="price" name="price">
                                            <div class="cart_item_title">Price</div>
                                            <div class="cart_item_text">{{$settings->currency}}{{$product->product->selling_price}}</div>
                                        </div>
                                        @endif

                                        @if ($product->product->discount_price != 0)
                                        <div class="cart_item_price cart_info_col">
                                            <input type="hidden" value="{{$product->product->discount_price}}" id="price" name="price">
                                            <div class="cart_item_title"> Price</div>
                                            <div class="cart_item_text">{{$settings->currency}}{{$product->product->discount_price}}</div>
                                        </div>
                                        @endif
                                        @isset($product->created_at)
                                        <div class="cart_item_quantity cart_info_col">
                                            <div class="cart_item_title">Date</div>
                                            <div class="cart_item_text">{{$product->created_at->format('d-m-Y')}} </div>
                                        </div>
                                        @endisset

                                        <div class="cart_item_total cart_info_col">
                                            <div class="cart_item_title text-center">Action</div>
                                            <div class="cart_item_text text-center">

                                                <a href="javascript:void(0)" id="delete" data-id="{{$product->product_id}}"><span class="fas fa-trash text-danger"></span> </a>
                                                <a  href="javascript:void(0)" id="cart" data-id="{{$product->product_id}}" ><span class="fas fa-shopping-cart text-primary"></span></a>
                                            </div>

                                        </div>


                                    </div>
                                </li>
                            </ul>

                        </div>

                    @endforeach
                    <div class="cart_buttons">
                         <a id="destroy-item" class="button cart_button_clear text-danger" href="javascript:void(0)">Clear Wishlist?</a>
                         <a id="check-out" class="button cart_button_checkout" href="{{route('home')}}">Back Home</a>

                    </div>
                </div>

            </div>
            @endif
        </div>

    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
           // delete wishlist
        $(document).on('click','#delete',function(e){
            e.preventDefault();
        let id=$(this).data('id');
        $.get('/remove/wishlist/'+id, function(data){
            toastr.success(data);
            $('.cart_section').load(location.href+' .cart_section');
        });
        });


        // destroy all item
        $(document).on('click','#destroy-item',function(e){
            e.preventDefault();
         var url = '{{route("destroy.wishlist")}}';
            $.ajax({
                url: url,
                type: 'get',
                async: false,
                success:function(data) {
                    toastr.success(data);
                    $('.cart_section').load(location.href+' .cart_section');
                }
        });
    });


$(document).on('click','#cart',function(e) {
    e.preventDefault();
// $('.loading').removeClass('d-none');
let id = $(this).data('id');
let cart_item = $(this).closest('.cart_items');
let name = cart_item.find('input[name="name"]').val();
let image = cart_item.find('input[name="image"]').val();
let color = cart_item.find('select[name="color"]').val();
let size = cart_item.find('select[name="size"]').val();
let quantity = cart_item.find('input[name="quantity"]').val();
let price = cart_item.find('input[name="price"]').val();
let url = "{{route('add.to.cart')}}";
$.ajax({
     url : url,
    type : 'get',
   async : false,
    data : {
        id   : id,
        name : name,
       image : image,
       color : color,
        size : size,
    quantity : quantity,
       price : price,
    },
    success:function(data) {
        toastr.success(data);
        //  $('#wishlist-to-cart')[0].reset();
          $('.cart').load(location.href+' .cart');

    }
});
});



</script>
@endsection
