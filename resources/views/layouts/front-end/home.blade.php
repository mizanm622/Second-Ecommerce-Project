@extends('layouts.app')
<link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/product_styles.css')}}">

<link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/product_responsive.css')}}">
<style>
#owl-demo {
    display: block;
    width: 100%;
    height: 400px;
}
</style>
@section('home-content')



<!-- Banner -->
<div id="owl-demo" class="owl-carousel owl-theme" >
@foreach ($bannerProduct as $row)
<div class="item main_slider_item">
  <div class="banner">
    <div class="banner_background" style="background-image:url(front-end/assets/images/banner_background.jpg)"></div>
    <div class="container fill_height">
        <div class="row fill_height">

              <div class="banner_product_image"><img src="{{asset($row->thumbnail)}}" alt="" width="150" height="250"></div>
                <div class="col-lg-5 offset-lg-4 fill_height">
                    <div class="banner_content">
                        <input type="hidden" name="name" value="{{$row->name}}">
                        <input type="hidden" name="image" value="{{$row->thumbnail}}">
                        <h1 class="banner_text">{{$row->name}}</h1>
                        @if ($row->discount_price == '0')
                        <input type="hidden" name="price" value="{{$row->selling_price}}">
                        <div class="banner_price">{{$settings->currency}} {{$row->selling_price}}</div>
                        @else
                        <input type="hidden" name="price" value="{{$row->discount_price}}">
                        <div class="banner_price"><span> {{$settings->currency}} {{$row->selling_price}}</span>{{$settings->currency}} {{$row->discount_price}} </div>
                        @endif
                        <input type="hidden" name="quantity" value="1">
                        <div class="banner_product_name">{{$row->brand->brand_name}}</div>
                        @guest
                            <div class="button banner_button"><a href="" id="">Shop Now</a></div>
                            <div class="button banner_button"><a href="{{route('product.details',$row->id)}}">Show Details</a></div>
                        @else

                            <div class="button banner_button"><a href="javascript:void(0)" data-id="{{$row->id}}" id="cart_item">Shop Now</a></div>
                            <div class="button banner_button"><a href="{{route('product.details',$row->id)}}">Show Details</a></div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
     </div>
  </div>
@endforeach
</div>



<!--Product Campaing-->
<div class="reviews">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="reviews_slider_container">
                    <!-- Reviews Slider -->
                    <div class="owl-carousel owl-theme reviews_slider">
                        <!-- Reviews Slider Item -->
                         @foreach ($campaing as $item)
                         @php
                         $remainingTime = 0;

                         if(date('Y-m-d', strtotime(date('Y-m-d'))) <= date('Y-m-d', strtotime($item->end_date))){
                            $remainingTime=Illuminate\Support\Carbon::now()->diffInDays(Illuminate\Support\Carbon::parse(date('Y-m-d', strtotime($item->end_date))));
                         }

                         @endphp
                        @if ( $remainingTime != 0)
                        <div class="owl-item">
                            <div class="review d-flex flex-row align-items-start justify-content-start">
                                <div class="review_image"><img src="{{asset($item->images)}}" alt="" width="200" height="120"></div>
                                <div class="review_content">
                                    <div class="review_name">{{substr($item->campaing_description, 0, 20)}}....</div>
                                    <div class="review_rating_container">
                                        @if ($remainingTime == 1)
                                        <div class="review_time">Only {{$remainingTime}} day left</div>
                                        @elseif ($remainingTime > 1)
                                        <div class="review_time">Only {{$remainingTime}} days left</div>
                                        @endif
                                    </div>
                                    <div class="review_text"><p>{!!$item->discount == 1 ? '<h4 class="text-info">Enjoy This Offer </h4>': '<h4 class="text-danger">'.$settings->currency.''.$item->discount.' % Discount</h4> ' !!}</p></div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    <div class="reviews_dots"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Product Campaing-->

<!-- Deals of the week -->

<div class="deals_featured">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                <!-- Deals -->

                <div class="deals">
                    <div class="deals_title">Deals of the Week</div>
                    <div class="deals_slider_container">

                        <!-- Deals Slider -->
                        <div class="owl-carousel owl-theme deals_slider">

                            <!-- Deals Item -->
                            @foreach ($todaysDeal as $deals)
                                <div class="owl-item deals_item">
                                    <div class="deals_image text-center"><img src="{{asset($deals->thumbnail)}}" alt=""></div>
                                    <div class="deals_content">
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_category"><a href="#">{{$deals->name}}</a></div>
                                            <div class="deals_item_price_a ml-auto">{{$settings->currency}}{{$deals->selling_price}}</div>
                                        </div>
                                        <div class="deals_info_line d-flex flex-row justify-content-start">
                                            <div class="deals_item_name">{{$deals->name}}</div>
                                            <div class="deals_item_price ml-auto">{{$settings->currency}}{{$deals->discount_price}}</div>
                                        </div>
                                        <div class="available">
                                            <div class="available_line d-flex flex-row justify-content-start">
                                                <div class="available_title">Available: <span>{{$deals->stack_quantity}}</span></div>
                                                <div class="sold_title ml-auto">Already Sold: <span>{{$deals->selling_quantity}}</span></div>
                                            </div>
                                            <div class="available_bar"><span style="width:17%"></span></div>
                                        </div>
                                        <div class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                            <div class="deals_timer_title_container">
                                                <div class="deals_timer_title">Hurry Up</div>
                                                <div class="deals_timer_subtitle">Offer ends in:</div>
                                            </div>
                                            <div class="deals_timer_content ml-auto">
                                                <div class="deals_timer_box clearfix" data-target-time="">
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                        <span>hours</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                        <span>mins</span>
                                                    </div>
                                                    <div class="deals_timer_unit">
                                                        <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                        <span>secs</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="deals_slider_nav_container">
                        <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i></div>
                        <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i></div>
                    </div>
                </div>

                <!-- Featured -->
                <div class="featured">
                    <div class="tabbed_container">
                        <div class="tabs">
                            <ul class="clearfix">
                                <li class="active">Featured</li>
                                <li>On Sale</li>
                                <li>Best Rated</li>
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>

                        <!-- Product Panel -->


                        <div class="product_panel panel active">
                            <div class="featured_slider slider">
                                <!-- Slider Item -->
                                @foreach ($featuredProduct as $product)
                                    @php
                                    $colors=explode(',',$product->color);
                                    $sizes=explode(',',$product->size);
                                    @endphp
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <a href="{{route('product.details',$product->id)}}">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset( $product->thumbnail)}}" alt="" width="60" height="80"></div>
                                                <input type="hidden" name="name" value="{{$product->name}}">
                                                <input type="hidden" name="image" value="{{$product->thumbnail}}">
                                                <div class="view">
                                                    <a class="btn btn-link btn-sm m-0 p-0" id="show" data-id="{{$product->id}}" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">View</a>
                                                </div>
                                                <div class="product_content">
                                                    @if ($product->discount_price == '0')
                                                        <input type="hidden" name="price" value="{{$product->selling_price}}">
                                                        <div class="product_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                                    @else
                                                        <input type="hidden" name="price" value="{{$product->discount_price}}">
                                                        <div class="product_price discount">{{$settings->currency}} {{$product->discount_price}} <span> {{$settings->currency}} {{$product->selling_price}}</span></div>
                                                    @endif
                                                    {{-- <div class="product_price discount">$225<span>$300</span></div> --}}
                                                    <div class="product_name"><div><a href="">{{substr($product->name, 0, 30) }}</a></div></div>
                                                    <div class="product_extras">
                                                        <div class="extra-option row">
                                                            @isset($product->color)
                                                                <div class="color text-left">
                                                                    <select type="text" name="color" class="form-control form-control-sm" id="">
                                                                        <option>Colors</option>
                                                                        @foreach ($colors as $color)
                                                                            <option value="{{$color}}">{{$color}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endisset
                                                            @isset($product->size)
                                                                <div class="size text-center">
                                                                    <select type="text" name="size" class="form-control form-control-sm" id="">
                                                                        <option >Sizes</option>
                                                                        @foreach ($sizes as $size)
                                                                            <option value="{{$size}}">{{$size}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endisset
                                                            @if(empty($product->size) or empty($product->color))
                                                            <div class="optional-quantity text-right">
                                                                <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" maxlength="2" value="1">
                                                            </div>
                                                            @else
                                                            <div class="quantity text-right">
                                                                <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" maxlength="2" value="1">
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="add-to-cart-btn">
                                                            <a class="product_cart_button btn" id="cart" data-id="{{$product->id}}" href="javascript:void(0)">Add to Cart</a>
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
                                                @if($product->is_new != 0)
                                                <li class="product_mark product_new">new</li>
                                                @endif
                                                @if($product->discount_price != 0)
                                                <li class="product_mark product_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                   @endforeach
                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>


                        <!-- End Product Panel -->

                        <div class="product_panel panel">
                            <div class="featured_slider slider">
                                <!-- Slider Item -->
                                @foreach ($populerProduct as $product)
                                @php
                                    $colors=explode(',',$product->color);
                                    $sizes=explode(',',$product->size);
                                @endphp
                                    <div class="featured_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <a class="details-view m-0 p-0" href="{{route('product.details',$product->id)}}">
                                                <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset( $product->thumbnail)}}" alt="" width="60" height="80"></div>
                                                <input type="hidden" name="name" value="{{$product->name}}">
                                                <input type="hidden" name="image" value="{{$product->thumbnail}}">
                                                <div class="view">
                                                    <a class="btn btn-link btn-sm m-0 p-0" id="show" data-id="{{$product->id}}" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">View</a>
                                                </div>
                                                <div class="product_content">
                                                    @if ($product->discount_price == '0')
                                                        <input type="hidden" name="price" value="{{$product->selling_price}}">
                                                        <div class="product_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                                    @else
                                                        <input type="hidden" name="price" value="{{$product->discount_price}}">
                                                        <div class="product_price discount">{{$settings->currency}} {{$product->discount_price}} <span> {{$settings->currency}} {{$product->selling_price}}</span></div>
                                                    @endif
                                                    <div class="product_name"><div><a href="">{{substr($product->name, 0, 30) }}</a></div></div>

                                                    <div class="product_extras">
                                                        <div class="extra-option row">
                                                            @isset($product->color)
                                                                <div class="color text-left">
                                                                    <select type="text" name="color" class="form-control form-control-sm" id="">
                                                                        <option>Colors</option>
                                                                        @foreach ($colors as $color)
                                                                            <option value="{{$color}}">{{$color}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endisset
                                                            @isset($product->size)
                                                                <div class="size text-center">
                                                                    <select type="text" name="size" class="form-control form-control-sm" id="">
                                                                        <option>Sizes</option>
                                                                        @foreach ($sizes as $size)
                                                                            <option value="{{$size}}">{{$size}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endisset
                                                            @if(empty($product->size) or empty($product->color))
                                                            <div class="optional-quantity text-right">
                                                                <input type="number" name="quantity" class="form-control form-control-sm" min="1" max="9" maxlength="2" value="1">
                                                            </div>
                                                            @else
                                                            <div class="quantity text-right">
                                                                <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" maxlength="2" value="1">
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="add-to-cart-btn">
                                                            <a class="product_cart_button btn" id="cart" data-id="{{$product->id}}" href="javascript:void(0)">Add to Cart</a>
                                                        </div>

                                                    </div>
                                                </div>
                                            </a>
                                            @guest
                                            <div class="product_fav"><a class="btn" href="javascript:void(0)" data-toggle="popover" title="Please login to continue" ><i  class="fas fa-heart"></i></a></div>
                                            @else
                                            <div class="product_fav"><span  data-id="{{$product->id}}" id="product-wishlist" class="fas fa-heart text-info"></span></div>
                                            @endguest
                                            <ul class="product_marks">
                                                @if($product->is_new != 0)
                                                <li class="product_mark product_new">new</li>
                                                @endif
                                                @if($product->discount_price != 0)
                                                <li class="product_mark product_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>

                        <!-- Product Panel -->

                        <div class="product_panel panel">
                            <div class="featured_slider slider">
                              @foreach ($bestRatedProduct as $product)
                                <!-- Slider Item -->
                                @php
                                    $colors=explode(',',$product->color);
                                    $sizes=explode(',',$product->size);
                                @endphp
                                <div class="featured_slider_item">
                                    <div class="border_active"></div>
                                    <div class="product_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <a class="details-view m-0 p-0" href="{{route('product.details',$product->id)}}">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset( $product->thumbnail)}}" alt="" width="60" height="80"></div>
                                            <input type="hidden" name="name" value="{{$product->name}}">
                                            <input type="hidden" name="image" value="{{$product->thumbnail}}">
                                            <div class="view">
                                                <a class="btn btn-link btn-sm m-0 p-0" id="show" data-id="{{$product->id}}" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">View</a>
                                            </div>
                                            <div class="product_content">
                                                @if ($product->discount_price == '0')
                                                    <input type="hidden" name="price" value="{{$product->selling_price}}">
                                                    <div class="product_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                                @else
                                                    <input type="hidden" name="price" value="{{$product->discount_price}}">
                                                    <div class="product_price discount">{{$settings->currency}} {{$product->discount_price}} <span> {{$settings->currency}} {{$product->selling_price}}</span></div>
                                                @endif
                                                <div class="product_name"><div><a href="">{{substr($product->name, 0, 30) }}</a></div></div>

                                                <div class="product_extras">
                                                    <div class="extra-option row">
                                                        @isset($product->color)
                                                            <div class="color text-left">
                                                                <select type="text" name="color" class="form-control form-control-sm" id="">
                                                                    <option>Colors</option>
                                                                    @foreach ($colors as $color)
                                                                        <option value="{{$color}}">{{$color}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endisset
                                                        @isset($product->size)
                                                            <div class="size text-center">
                                                                <select type="text" name="size" class="form-control form-control-sm" id="">
                                                                    <option>Sizes</option>
                                                                    @foreach ($sizes as $size)
                                                                        <option value="{{$size}}">{{$size}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endisset
                                                        @if(empty($product->size) or empty($product->color))
                                                        <div class="optional-quantity text-right">
                                                            <input type="number" name="quantity" class="form-control form-control-sm" min="1" max="9" maxlength="2" value="1">
                                                        </div>
                                                        @else
                                                        <div class="quantity text-right">
                                                            <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" maxlength="2" value="1">
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="add-to-cart-btn">
                                                        <a class="product_cart_button btn" id="cart" data-id="{{$product->id}}" href="javascript:void(0)">Add to Cart</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </a>
                                        @guest
                                        <div class="product_fav"><a class="btn" href="javascript:void(0)" data-toggle="popover" title="Please login to continue" ><i  class="fas fa-heart"></i></a></div>
                                        @else
                                        <div class="product_fav"><span  data-id="{{$product->id}}" id="product-wishlist" class="fas fa-heart text-info"></span></div>
                                        @endguest
                                        <ul class="product_marks">
                                            @if($product->is_new != 0 )
                                            <li class="product_mark product_new">new</li>
                                            @endif
                                            @if ($product->discount_price != 0 )
                                            <li class="product_mark product_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="featured_slider_dots_cover"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular Categories -->

<div class="popular_categories">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="popular_categories_content">
                    <div class="popular_categories_title">Popular Categories</div>
                    <div class="popular_categories_slider_nav">
                        <div class="popular_categories_prev popular_categories_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="popular_categories_next popular_categories_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                    <div class="popular_categories_link"><a href="#">full catalog</a></div>
                </div>
            </div>

            <!-- Popular Categories Slider -->

            <div class="col-lg-9">
                <div class="popular_categories_slider_container">
                    <div class="owl-carousel owl-theme popular_categories_slider">
                        <!-- Popular Categories Item -->
                        @foreach ($populerCategory as $item)
                        <div class="owl-item">
                            <div class="popular_category d-flex flex-column align-items-center justify-content-center">
                                <div class="popular_category_image"><img src="{{asset($item->subcategory_logo)}}" alt=""></div>
                                <div class="popular_category_text">{{$item->subcategory_name}}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <!-- Banner -->

<div class="banner_2">
    <div class="banner_2_background" style="background-image:url({{asset('front-end/assets/images/popular_5.png')}}"></div>
    <div class="banner_2_container">
        <div class="banner_2_dots"></div>
        <!-- Banner 2 Slider -->

        <div class="owl-carousel owl-theme banner_2_slider">

            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">Laptops</div>
                                    <div class="banner_2_title">MacBook Air 13</div>
                                    <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Explore</a></div>
                                </div>

                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{asset('front-end/assets/images/banner_2_product.png')}}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">Laptops</div>
                                    <div class="banner_2_title">MacBook Air 13</div>
                                    <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Explore</a></div>
                                </div>

                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{asset('front-end/assets/images/banner_2_product.png')}}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner 2 Slider Item -->
            <div class="owl-item">
                <div class="banner_2_item">
                    <div class="container fill_height">
                        <div class="row fill_height">
                            <div class="col-lg-4 col-md-6 fill_height">
                                <div class="banner_2_content">
                                    <div class="banner_2_category">Laptops</div>
                                    <div class="banner_2_title">MacBook Air 13</div>
                                    <div class="banner_2_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum laoreet.</div>
                                    <div class="rating_r rating_r_4 banner_2_rating"><i></i><i></i><i></i><i></i><i></i></div>
                                    <div class="button banner_2_button"><a href="#">Explore</a></div>
                                </div>

                            </div>
                            <div class="col-lg-8 col-md-6 fill_height">
                                <div class="banner_2_image_container">
                                    <div class="banner_2_image"><img src="{{asset('front-end/assets/images/banner_2_product.png')}}" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> --}}

<!-- Hot New Arrivals -->

<div class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">Hot New Arrivals</div>
                        <ul class="clearfix">
                            <li class="active">Electronics</li>
                            <li>Vehicles</li>
                            <li>Fashion</li>
                            <li>Laptops & Computers</li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-9" style="z-index:1;">


                                <!-- Product Panel Featured-->
                                <div class="product_panel panel active">
                                    <div class="arrivals_slider slider">
                                    @foreach ($newArrivalElectronics as $product)
                                        <!-- Slider Item -->
                                        @if($product->category->category_name == 'Electronics')
                                        @php
                                            $colors=explode(',',$product->color);
                                            $sizes=explode(',',$product->size);
                                        @endphp
                                            <div class="featured_slider_item row-item">
                                                <div class="border_active"></div>
                                                <div class="product_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                                    <a class="details-view m-0 p-0" href="{{route('product.details',$product->id)}}">
                                                        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset( $product->thumbnail)}}" alt="" width="60" height="80"></div>
                                                        <input type="hidden" name="name" value="{{$product->name}}">
                                                        <input type="hidden" name="image" value="{{$product->thumbnail}}">
                                                        <div class="view">
                                                            <a class="btn btn-link btn-sm m-0 p-0" id="show" data-id="{{$product->id}}" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">View</a>
                                                        </div>
                                                        <div class="product_content">
                                                            @if ($product->discount_price == '0')
                                                                <input type="hidden" name="price" value="{{$product->selling_price}}">
                                                                <div class="product_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                                            @else
                                                                <input type="hidden" name="price" value="{{$product->discount_price}}">
                                                                <div class="product_price discount">{{$settings->currency}} {{$product->discount_price}} <span> {{$settings->currency}} {{$product->selling_price}}</span></div>
                                                            @endif
                                                            <div class="product_name"><div><a href="">{{substr($product->name, 0, 30) }}</a></div></div>

                                                            <div class="product_extras">
                                                                <div class="extra-option row">
                                                                    @isset($product->color)
                                                                        <div class="color text-left">
                                                                            <select type="text" name="color" class="form-control form-control-sm" id="">
                                                                                <option>Colors</option>
                                                                                @foreach ($colors as $color)
                                                                                    <option value="{{$color}}">{{$color}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endisset
                                                                    @isset($product->size)
                                                                        <div class="size text-center">
                                                                            <select type="text" name="size" class="form-control form-control-sm" id="">
                                                                                <option>Sizes</option>
                                                                                @foreach ($sizes as $size)
                                                                                    <option value="{{$size}}">{{$size}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endisset
                                                                    @if(empty($product->size) or empty($product->color))
                                                                    <div class="optional-quantity text-right">
                                                                        <input type="number" name="quantity" class="form-control form-control-sm" min="1" max="9" maxlength="2" value="1">
                                                                    </div>
                                                                    @else
                                                                    <div class="quantity text-right">
                                                                        <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" maxlength="2" value="1">
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="add-to-cart-btn">
                                                                    <a class="product_cart_button btn" id="cart" data-id="{{$product->id}}" href="javascript:void(0)">Add to Cart</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </a>
                                                    @guest
                                                    <div class="product_fav"><a class="btn" href="javascript:void(0)" data-toggle="popover" title="Please login to continue" ><i  class="fas fa-heart"></i></a></div>
                                                    @else
                                                    <div class="product_fav"><span  data-id="{{$product->id}}" id="product-wishlist" class="fas fa-heart text-info"></span></div>
                                                    @endguest
                                                    <ul class="product_marks">
                                                        @if($product->is_new != 0 )
                                                        <li class="product_mark product_new">new</li>
                                                        @endif
                                                        @if ($product->discount_price != 0 )
                                                        <li class="product_mark product_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                                        @endif

                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>


                            <!-- Product Panel Audio Video-->
                            <div class="product_panel panel">
                                <div class="arrivals_slider slider">
                                    @foreach ($newArrivalElectronics as $product)
                                    <!-- Slider Item -->
                                        @if($product->category->category_name == 'Vehicles')
                                            <!-- Slider Item -->
                                            @php
                                            $colors=explode(',',$product->color);
                                            $sizes=explode(',',$product->size);
                                            @endphp
                                            <div class="featured_slider_item">
                                                <div class="border_active"></div>
                                                <div class="product_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                                    <a class="details-view m-0 p-0" href="{{route('product.details',$product->id)}}">
                                                        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset( $product->thumbnail)}}" alt="" width="60" height="80"></div>
                                                        <input type="hidden" name="name" value="{{$product->name}}">
                                                        <input type="hidden" name="image" value="{{$product->thumbnail}}">
                                                        <div class="view">
                                                            <a class="btn btn-link btn-sm m-0 p-0" id="show" data-id="{{$product->id}}" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">View</a>
                                                        </div>
                                                        <div class="product_content">
                                                            @if ($product->discount_price == '0')
                                                                <input type="hidden" name="price" value="{{$product->selling_price}}">
                                                                <div class="product_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                                            @else
                                                                <input type="hidden" name="price" value="{{$product->discount_price}}">
                                                                <div class="product_price discount">{{$settings->currency}} {{$product->discount_price}} <span> {{$settings->currency}} {{$product->selling_price}}</span></div>
                                                            @endif
                                                            <div class="product_name"><div><a href="">{{substr($product->name, 0, 30) }}</a></div></div>

                                                            <div class="product_extras">
                                                                <div class="extra-option row">
                                                                    @isset($product->color)
                                                                        <div class="color text-left">
                                                                            <select type="text" name="color" class="form-control form-control-sm" id="">
                                                                                <option>Colors</option>
                                                                                @foreach ($colors as $color)
                                                                                    <option value="{{$color}}">{{$color}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endisset
                                                                    @isset($product->size)
                                                                        <div class="size text-center">
                                                                            <select type="text" name="size" class="form-control form-control-sm" id="">
                                                                                <option>Sizes</option>
                                                                                @foreach ($sizes as $size)
                                                                                    <option value="{{$size}}">{{$size}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endisset
                                                                    @if(empty($product->size) or empty($product->color))
                                                                    <div class="optional-quantity text-right">
                                                                        <input type="number" name="quantity" class="form-control form-control-sm" min="1" max="9" maxlength="2" value="1">
                                                                    </div>
                                                                    @else
                                                                    <div class="quantity text-right">
                                                                        <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" maxlength="2" value="1">
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="add-to-cart-btn">
                                                                    <a class="product_cart_button btn" id="cart" data-id="{{$product->id}}" href="javascript:void(0)">Add to Cart</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </a>
                                                    @guest
                                                    <div class="product_fav"><a class="btn" href="javascript:void(0)" data-toggle="popover" title="Please login to continue" ><i  class="fas fa-heart"></i></a></div>
                                                    @else
                                                    <div class="product_fav"><span  data-id="{{$product->id}}" id="product-wishlist" class="fas fa-heart text-info"></span></div>
                                                    @endguest
                                                    <ul class="product_marks">
                                                        @if($product->is_new != 0 )
                                                        <li class="product_mark product_new">new</li>
                                                        @endif
                                                        @if ($product->discount_price != 0 )
                                                        <li class="product_mark product_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                                        @endif

                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="arrivals_slider_dots_cover"></div>
                            </div>

                             <!-- Product Panel Fashion-->
                             <div class="product_panel panel">
                                <div class="arrivals_slider slider">
                                    @foreach ($newArrivalElectronics as $product)
                                    <!-- Slider Item -->
                                        @if($product->category->category_name == 'Fashions')
                                            @php
                                            $colors=explode(',',$product->color);
                                            $sizes=explode(',',$product->size);
                                            @endphp
                                            <div class="featured_slider_item">
                                                <div class="border_active"></div>
                                                <div class="product_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                                    <a class="details-view m-0 p-0" href="{{route('product.details',$product->id)}}">
                                                        <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset( $product->thumbnail)}}" alt="" width="60" height="80"></div>
                                                        <input type="hidden" name="name" value="{{$product->name}}">
                                                        <input type="hidden" name="image" value="{{$product->thumbnail}}">
                                                        <div class="view">
                                                            <a class="btn btn-link btn-sm m-0 p-0" id="show" data-id="{{$product->id}}" href="javascript:void(0)" data-toggle="modal" data-target="#myModal">View</a>
                                                        </div>
                                                        <div class="product_content">
                                                            @if ($product->discount_price == '0')
                                                                <input type="hidden" name="price" value="{{$product->selling_price}}">
                                                                <div class="product_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                                            @else
                                                                <input type="hidden" name="price" value="{{$product->discount_price}}">
                                                                <div class="product_price discount">{{$settings->currency}} {{$product->discount_price}} <span> {{$settings->currency}} {{$product->selling_price}}</span></div>
                                                            @endif
                                                            <div class="product_name"><div><a href="">{{substr($product->name, 0, 30) }}</a></div></div>

                                                            <div class="product_extras">
                                                                <div class="extra-option row">
                                                                    @isset($product->color)
                                                                        <div class="color text-left">
                                                                            <select type="text" name="color" class="form-control form-control-sm" id="">
                                                                                <option>Colors</option>
                                                                                @foreach ($colors as $color)
                                                                                    <option value="{{$color}}">{{$color}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endisset
                                                                    @isset($product->size)
                                                                        <div class="size text-center">
                                                                            <select type="text" name="size" class="form-control form-control-sm" id="">
                                                                                <option>Sizes</option>
                                                                                @foreach ($sizes as $size)
                                                                                    <option value="{{$size}}">{{$size}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    @endisset
                                                                    @if(empty($product->size) or empty($product->color))
                                                                    <div class="optional-quantity text-right">
                                                                        <input type="number" name="quantity" class="form-control form-control-sm" min="1" max="9" maxlength="2" value="1">
                                                                    </div>
                                                                    @else
                                                                    <div class="quantity text-right">
                                                                        <input type="number" name="quantity" class="form-control form-control-sm " min="1" max="9" maxlength="2" value="1">
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="add-to-cart-btn">
                                                                    <a class="product_cart_button btn" id="cart" data-id="{{$product->id}}" href="javascript:void(0)">Add to Cart</a>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </a>
                                                    @guest
                                                    <div class="product_fav"><a class="btn" href="javascript:void(0)" data-toggle="popover" title="Please login to continue" ><i  class="fas fa-heart"></i></a></div>
                                                    @else
                                                    <div class="product_fav"><span  data-id="{{$product->id}}" id="product-wishlist" class="fas fa-heart text-info"></span></div>
                                                    @endguest
                                                    <ul class="product_marks">
                                                        @if($product->is_new != 0 )
                                                        <li class="product_mark product_new">new</li>
                                                        @endif
                                                        @if ($product->discount_price != 0 )
                                                        <li class="product_mark product_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                                        @endif

                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="arrivals_slider_dots_cover"></div>
                            </div>

                            <!-- Product Panel laptop Computer-->
                            <div class="product_panel panel">
                                <div class="arrivals_slider slider">
                                    <!-- Slider Item -->
                                    <div class="arrivals_slider_item">
                                        <div class="border_active"></div>
                                        <div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                            <div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset('front-end/assets/')}}images/new_1.jpg" alt=""></div>
                                            <div class="product_content">
                                                <div class="product_price">$225</div>
                                                <div class="product_name"><div><a href="product.html">Huawei MediaPad...</a></div></div>
                                                <div class="product_extras">
                                                    <div class="product_color">
                                                        <input type="radio" checked name="product_color" style="background:#b19c83">
                                                        <input type="radio" name="product_color" style="background:#000000">
                                                        <input type="radio" name="product_color" style="background:#999999">
                                                    </div>
                                                    <button class="product_cart_button">Add to Cart</button>
                                                </div>
                                            </div>
                                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                                            <ul class="product_marks">
                                                <li class="product_mark product_discount">-25%</li>
                                                <li class="product_mark product_new">new</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="arrivals_slider_dots_cover"></div>
                            </div>



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Best Sellers -->

<div class="best_sellers">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="tabbed_container">
                    <div class="tabs clearfix tabs-right">
                        <div class="new_arrivals_title">Hot Best Sellers</div>
                        <ul class="clearfix">
                            <li class="active">Top 20</li>
                            <li>Audio & Video</li>
                            <li>Laptops & Computers</li>
                        </ul>
                        <div class="tabs_line"><span></span></div>
                    </div>
                    <div class="bestsellers_panel panel active">
                        <!-- Best Sellers Slider -->
                        <div class="bestsellers_slider slider">
                            <!-- Best Sellers Item -->
                            @foreach ($bestRatedProduct as $product)
                            @php
                                $rating = App\Models\Review::where('product_id',$product->id)->avg('review_rating');
                            @endphp
                            <div class="bestsellers_item discount">
                                <div class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                    <div class="bestsellers_image"><img src="{{asset($product->thumbnail)}}" alt=""></div>
                                    <div class="bestsellers_content">
                                        <div class="bestsellers_category"><a href="#">{{$product->subcategory->subcategory_name}}</a></div>
                                        <div class="bestsellers_name">{{$product->name}}</div>
                                        @if(round($rating) ==0)
                                        <div class="rating_r rating_r_4 bestsellers_rating"></div>
                                        @elseif (round($rating) == 5)
                                            <div class="rating_r rating_r_4 bestsellers_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                            </div>


                                        @elseif (round($rating) == 4)
                                            <div class="rating_r rating_r_4 bestsellers_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-muted fas fa-star"></span>
                                            </div>
                                        @elseif (round($rating) == 3)
                                            <div class="rating_r rating_r_4 bestsellers_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                            </div>
                                        @elseif (round($rating) == 2)
                                            <div class="rating_r rating_r_4 bestsellers_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                            </div>
                                        @elseif (round($rating) == 1)
                                            <div class="rating_r rating_r_4 bestsellers_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                            </div>
                                        @endif

                                        @if ($product->discount_price == 0)
                                            <div class="bestsellers_price discount">{{$settings->currency}} {{$product->selling_price}}</div>
                                        @else
                                            <div class="bestsellers_price discount">{{$settings->currency}} {{$product->discount_price}}<span>{{$settings->currency}} {{$product->selling_price}}</span></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="bestsellers_fav active"><span  data-id="{{$product->id}}" id="product-wishlist" class="fas fa-heart text-info"></span></div>
                                <ul class="bestsellers_marks">
                                    @if(empty($product->discount_price))
                                        <li class="bestsellers_mark bestsellers_new">new</li>
                                    @else
                                        <li class="bestsellers_mark bestsellers_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                    @endif
                                </ul>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Trends -->

<div class="trends">
    <div class="trends_background" style="background-image:url({{asset('front-end/assets/images/trends_background.jpg')}}"></div>
    <div class="trends_overlay"></div>
    <div class="container">
        <div class="row">

            <!-- Trends Content -->
            <div class="col-lg-3">
                <div class="trends_container">
                    <h2 class="trends_title">Trends 2023 </h2>
                    <div class="trends_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing Donec et.</p></div>
                    <div class="trends_slider_nav">
                        <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                        <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                    </div>
                </div>
            </div>

            <!-- Trends Slider -->
            <div class="col-lg-9">
                <div class="trends_slider_container">
                    <!-- Trends Slider -->
                    <div class="owl-carousel owl-theme trends_slider">
                        @foreach ($trendingProduct as $product)
                        <!-- Trends Slider Item -->
                            <div class="owl-item">
                                <div class="trends_item is_new discount">
                                    <a href="{{route('product.details',$product->id)}}">
                                        <div class="trends_image d-flex flex-column align-items-center justify-content-center"><img src="{{asset($product->thumbnail)}}" alt="{{$product->thumbnail}}" width="80" height="160"></div>
                                        <div class="trends_content">
                                            <div class="trends_category d-block">{{$product->subcategory->subcategory_name}}</div>
                                                @if($product->discount_price != 0)
                                                    <div class="trends_price text-danger d-block">{{$settings->currency}}{{$product->discount_price}}<del class="text-muted pl-2">{{$settings->currency}}{{$product->selling_price}}</del></div>
                                                @else
                                                    <div class="trends_price text-danger d-block">{{$settings->currency}}{{$product->selling_price}}</div>
                                                @endif
                                            <div class="trends_info clearfix">
                                                <div class="trends_name d-block">{{substr($product->name,0,18)}}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="trends_marks">
                                        @if($product->discount_price != 0)
                                            <li class="trends_mark trends_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%</li>
                                        @else
                                            <li class="trends_mark trends_new">new</li>
                                        @endif
                                    </ul>
                                    <div class="trends_fav"><i  data-id="{{$product->id}}" id="product-wishlist" class="fas fa-heart text-info"></i></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reviews -->

<div class="reviews">
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="reviews_title_container">
                    <h3 class="reviews_title">Latest Reviews</h3>
                    <div class="reviews_all ml-auto"><a href="#">view all <span>reviews</span></a></div>
                </div>

                <div class="reviews_slider_container">

                    <!-- Reviews Slider -->
                    <div class="owl-carousel owl-theme reviews_slider">

                        <!-- Reviews Slider Item -->

                        @foreach ($latestReview as $item)

                        @php
                            $rating = App\Models\Review::where('product_id',$item->product->id)->avg('review_rating');
                        @endphp

                        <div class="owl-item">
                            <div class="review d-flex flex-row align-items-start justify-content-start">
                                <div><div class="review_image"><img src="{{asset($item->product->thumbnail)}}" alt=""></div></div>
                                <div class="review_content">
                                    <div class="review_name">{{$item->user->name}}</div>
                                    <div class="review_rating_container">
                                        @if(round($rating) ==0)
                                        <div class="rating_r rating_r_4 review_rating"></div><br>
                                        @elseif (round($rating) == 5)
                                            <div class="rating_r rating_r_4 review_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                            </div><br>


                                        @elseif (round($rating) == 4)
                                            <div class="rating_r rating_r_4 review_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-muted fas fa-star"></span>
                                            </div><br>
                                        @elseif (round($rating) == 3)
                                            <div class="rating_r rating_r_4 review_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                            </div><br>
                                        @elseif (round($rating) == 2)
                                            <div class="rating_r rating_r_4 review_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                            </div><br>
                                        @elseif (round($rating) == 1)
                                            <div class="rating_r rating_r_4 review_rating">
                                                <span class="text-warning fas fa-star checked"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                                <span class="text-muted fas fa-star"></span>
                                            </div><br>
                                        @endif
                                        <div class="review_time">{{ Illuminate\Support\Carbon::parse($item->created_at)->diffForHumans() }} </div>
                                    </div>
                                    <div class="review_text"><p>{{$item->review_name}}</p></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="reviews_dots"></div>
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

                        <!-- Recently Viewed Item -->
                        @foreach ($populerProduct as $product)
                        <div class="owl-item">
                            <div class="viewed_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                <a href="{{route('product.details',$product->id)}}">
                                    <div class="viewed_image"><img src="{{asset($product->thumbnail)}}" alt=""></div>
                                    <div class="viewed_content text-center">
                                        @if($product->discount_price != 0)
                                            <div class="viewed_price text-danger">{{$settings->currency}}{{$product->discount_price}}</div>
                                        @else
                                            <div class="viewed_price text-danger">{{$settings->currency}}{{$product->selling_price}}</div>
                                        @endif
                                        <div class="viewed_name">{{substr($product->name, 0 ,15)}}</div>
                                    </div>
                                </a>
                                <ul class="item_marks">
                                    @if($product->discount_price != 0)
                                    <li class="item_mark item_discount">{{number_format(($product->selling_price-$product->discount_price)*100/$product->discount_price, 1)}}%<</li>
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
                        @foreach ($brand as $item )
                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset($item->brand_logo)}}" alt="" width="80" height="60"></div></div>
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

<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">

            <div class="col">
                <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                    <div class="newsletter_title_container">
                        <div class="newsletter_icon"><img src="{{asset('front-end/assets/images/send.png')}}" alt=""></div>
                        <div class="newsletter_title">Sign up for Newsletter</div>
                        <div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
                    </div>
                    <div class="newsletter_content clearfix">
                        <form action="#" class="newsletter_form">
                            <input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
                            <button class="newsletter_button">Subscribe</button>
                        </form>
                        <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



   <!--Single product view modal-->
   <div class="modal" id="myModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" id="close" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
        </div>
        <div class="modal_body">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>
  <!--End single product review modal-->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // $('#click').click(()=>{
    //     alert('alert shown');
    // })

    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
    });

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
      }
      });
    });
//    $(document).on('click', '#show', function() {
//       let id = $(this).data('id');
//       $.get('modal/view/'+id, function(data){
//         $('.modal_body').html(data);
//       });
//     });

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

    $(document).on('click','#cart',function(e) {
    e.preventDefault();
// $('.loading').removeClass('d-none');
let id = $(this).data('id');
let cart_item = $(this).closest('.featured_slider_item');
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

// add to cart from main slider
$(document).on('click','#cart_item',function(e) {
    e.preventDefault();
// $('.loading').removeClass('d-none');
let id = $(this).data('id');
let cart_item = $(this).closest('.main_slider_item');
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
