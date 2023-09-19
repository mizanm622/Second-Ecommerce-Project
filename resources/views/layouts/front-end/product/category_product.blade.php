@extends('layouts.app')

@section('home-content')
<link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/shop_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/shop_responsive.css')}}">

<!-- Home -->

<!-- Brands -->
@php
$subcat_id = 0;
@endphp
<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">
                    <!-- Brands Slider -->
                    <div class="owl-carousel owl-theme brands_slider">
                        @if (count($products) == 0)
                        @foreach ($brands as $item)
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><a href="{{route('category.product',$item->id)}}"><img src="{{asset($item->brand_logo)}}" alt="" width="95" height="50"></a> </div></div>
                        @endforeach
                        @else
                        @foreach ($products as $item)
                        @php
                            $subcat_id=$item->subcategory_id;
                        @endphp
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><a href="{{route('category.product',$item->brand_id)}}"><img src="{{asset($item->brand->brand_logo)}}" alt="" width="95" height="50"></a></div></div>
                        @endforeach
                        @endif
                    </div>
                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shop -->

<div class="shop">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!-- Shop Sidebar -->
                <div class="shop_sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">Categories</div>
                        <ul class="sidebar_categories">
                            @foreach ($populerCategory as $subcategory)
                            <li><img class="img-thumbnail rounded-circle" src="{{asset($subcategory->subcategory_logo)}}" alt="{{$subcategory->subcategory_name}}" width="30" height="30"> <a href="{{route('category.product',$subcategory->id)}}">{{$subcategory->subcategory_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="sidebar_section filter_by_section">
                        <div class="sidebar_title">Filter By</div>
                        <div class="sidebar_subtitle">Price</div>
                        <div class="filter_price">
                            <form class="form-inline my-2 my-lg-0" action="{{route('price.filter')}}" method="post" id="filter-form">
                                @csrf
                                <div class="row mb-2">
                                    <input class="form-control mr-sm-2 col-6" type="text" name="max" placeholder="Max">
                                </div>
                                <div class="row mb-2">
                                    <input class="form-control mr-sm-2 col-6" type="text" name="min" placeholder="Min">
                                </div>
                                <input type="hidden" name="id" value="{{$subcat_id}}">
                                <input class="btn btn-outline-success form-control ml-0" type="submit" value="Search">
                            </form>
                        </div>
                    </div>
                    <div class="sidebar_section">
                        <div class="sidebar_subtitle brands_subtitle">Brands</div>
                        <ul class="brands_list">
                            @foreach ($brands as $brand)
                            <li class="brand"><img class="img-thumbnail rounded" src="{{asset($brand->brand_logo)}}" alt="" width="30" height="30"> <a href="{{route('category.product',$brand->id)}}">{{$brand->brand_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <!-- Shop Content -->
                <div class="shop_content">
                    <div class="shop_bar clearfix">
                        <div class="shop_product_count"><span class="badge badge-primary text-light">{{count($products)}}</span> products found</div>
                        <div class="shop_sorting">
                            <span>Sort by:</span>
                            <ul>
                                <li>
                                    <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                    <ul>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                        <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
                                        <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="product_grid row" id="product-view">
                        <div class="product_grid_border"></div>

                        <!-- Product Item -->

                        @foreach ($products as $product)
                        @php
                            $colors=explode(',',$product->color);
                            $sizes=explode(',',$product->size);
                        @endphp

                            <div class="product_item is_new discount">
                                <div class="product_border"></div>
                                <a href="{{route('product.details',$product->id)}}" tabindex="0">
                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset( $product->thumbnail)}}" alt="" width="60" height="80"></div>
                                <input type="hidden" name="name" value="{{$product->name}}">
                                <input type="hidden" name="image" value="{{$product->thumbnail}}">
                                <div class="view">
                                    <a class="btn btn-link btn-sm m-0 p-0" id="show" data-id="{{$product->id}}" href="javascript:void(0)" data-toggle="modal" data-target="#cartModal">View</a>
                                </div>
                                <div class="product_content">
                                    @if ($product->discount_price == '0')
                                        <input type="hidden" name="price" value="{{$product->selling_price}}">
                                        <div class="product_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                    @else
                                        <input type="hidden" name="price" value="{{$product->discount_price}}">
                                        <div class="product_price discount">{{$settings->currency}} {{$product->discount_price}} <span> {{$settings->currency}} {{$product->selling_price}}</span></div>
                                    @endif
                                    <div class="product_name cat-product"><div><a href="">{{substr($product->name,0,15)}}</a> </div></div>
                                        <div class="product-extra-area">
                                            <div class="extra-option row">
                                                @isset($product->color)
                                                    <div class="color text-left">
                                                        <select type="text" name="color" class="form-control form-control-sm" id="">
                                                            <option value="">Colors</option>
                                                            @foreach ($colors as $color)
                                                                <option value="{{$color}}">{{$color}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endisset
                                                @isset($product->size)
                                                    <div class="size text-center">
                                                        <select type="text" name="size" class="form-control form-control-sm" id="">
                                                            <option value="">Sizes</option>
                                                            @foreach ($sizes as $size)
                                                                <option value="{{$size}}">{{$size}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endisset
                                                @if(empty($product->size) or empty($product->color))
                                                <div class="optional-quantity text-right">
                                                    <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" value="1">
                                                </div>
                                                @else
                                                <div class="quantity text-right">
                                                    <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" value="1">
                                                </div>
                                                @endif
                                            </div>
                                            <div class="product-cart mt-1">
                                                <a class="btn btn-primary btn-block" id="cart" data-id="{{$product->id}}" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                </div>
                                </a>
                                @guest
                                    <div class="product_fav"><a class="btn" href="" data-toggle="popover" title="Please login to continue" ><i  class="fas fa-heart"></i></a></div>
                                @else
                                    <div class="product_fav"><span  data-id="{{$product->id}}" id="product-wishlist" class="fas fa-heart text-info"></span></div>
                                @endguest
                                <ul class="product_marks">
                                    @if($product->discount_price != 0)
                                        <li class="product_mark product_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                    @else
                                        <li class="product_mark product_new">new</li>
                                    @endif
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <!-- Shop Page Pagination -->
                    <div class="shop_page_nav d-flex flex-row">
                        {{$products->links()}}

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- Recently Viewed -->

<div class="viewed">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="viewed_title_container">
                    <h3 class="viewed_title">Recently Viewed</h3>
                    <div class="viewed_nav_container">
                        <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                    </div>
                </div>

                <div class="viewed_slider_container">

                    <!-- Recently Viewed Slider -->

                    <div class="owl-carousel owl-theme viewed_slider">
                        @foreach ($recentView as $product)


                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                 <a href="{{route('product.details',$product->id)}}">
                                <div class="viewed_image"><img src="{{asset($product->thumbnail)}}" alt="" width="40" height="120"></div>
                                <div class="viewed_content text-center">
                                    @if ($product->discount_price == '0')
                                    <div class="viewed_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                    @else
                                    <div class="viewed_price discount">{{$settings->currency}} {{$product->discount_price}} <span> {{$settings->currency}} {{$product->selling_price}}</span></div>
                                    @endif

                                     <div class="viewed_name">{{substr($product->name, 0,15)}}</div>

                                </div>
                                 </a>
                                <ul class="item_marks">
                                    @if($product->discount_price != 0)
                                    <li class="item_mark item_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                    @else
                                    <li class="item_mark item_new">new</li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Brands -->

<div class="brands">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="brands_slider_container">
                    <!-- Brands Slider -->
                    <div class="owl-carousel owl-theme brands_slider">
                        @foreach ($brands as $brand)
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img class="img-responsive" src="{{asset($brand->brand_logo)}}" alt="" width="90" height="50"></div></div>
                        @endforeach
                    </div>
                    <!-- Brands Slider Navigation -->
                    <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                    <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!--Single product view modal-->
 <div class="modal" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" >&times;</button>
        </div>
        <div class="modal_body">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>
 <!--End Single product view modal-->


<script src="{{asset('front-end/assets/plugins/Isotope/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.js')}}"></script>
<script src="{{asset('front-end/assets/plugins/parallax-js-master/parallax.min.js')}}"></script>
<script src="{{asset('front-end/assets/js/shop_custom.js')}}"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

 // edit modal script
 $(document).on('click', '#show', function() {
      let id = $(this).data('id');
      $.ajax({
        url : "{{ route('modal.view') }}",
        type: 'get',
        anyne: false,
        async: false,
        data : {
            id : id,
        },
        success:function(data){
        $('.modal_body').html(data);
        $(document).find('#cartModal .close').trigger('click');
        $('.cart').load(location.href+' .cart');
      }
      });
    });

// destroy all item

$('#filter-form').submit(function(e) {
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
        //toastr.success(data);
         $('#filter-form')[0].reset();
         //$('#product-view').html(data);
         $('#product-view').load(location.href+' #product-view');
    }
});
});

 // insert wishlist data
 $(document).on('click','#product-wishlist',function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $.ajax({
        url: "{{ route('add.wishlist') }}",
        type: 'get',
        data: { id : id},
        success:function(data) {
            toastr.success(data);
             $('.wishlist').load(location.href+' .wishlist');
        }
    });
    });

    // add to cart product
    $(document).on('click','#cart',function(e) {
         e.preventDefault();
        // $('.loading').removeClass('d-none');
        let id = $(this).data('id');
        let cart_item = $(this).closest('.product_item');
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
<style>
    .optional-quantity {
    margin-left: 65px;
}
.optional-quantity{
    text-align: right;
}
.extra-option {
    padding-left: 11px;
}
.color {
    margin-left: 0px;
}

.quantity {
    margin-left: 7px;
}
.color select{
    width:60px;
}
.size select{
    width:60px;
}
.quantity select{
    width:30px;
}
</style>
@endsection
