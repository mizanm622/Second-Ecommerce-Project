@extends('layouts.app')

@section('home-content')
<link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/product_styles.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('front-end/assets/styles/product_responsive.css')}}">
<!-- Single Product -->


@php

    $colors=explode(',',$products->color);
    $sizes=explode(',',$products->size);
@endphp
<div class="single_product">
    <div class="container">
        <div class="row">

            <!-- Images -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="{{asset($products->images)}}"><img src="{{asset($products->images)}}" alt="" height="150px" width="80px"></li>
                    <li data-image="{{asset($products->images)}}"><img src="{{asset($products->images)}}" alt="" height="150px" width="80px"></li>
                    <li data-image="{{asset($products->images)}}"><img src="{{asset($products->images)}}" alt="" height="150px" width="80px"></li>


                </ul>
            </div>

            <!-- Selected Image -->
            <div class="col-lg-3 order-lg-2 order-1">
                <div class="image_selected"><img src="{{asset($products->thumbnail)}}" alt="" width="200px"></div>
            </div>

            <!-- Description -->
            <div class="col-lg-4 order-lg-2 order-3">
                <div class="product_description">
                    <div class="product_category">{{$products->childcategory->childcategory_name}}</div>
                    <div class="product_name">{{$products->name}}</div>
                    <div class="rating_r rating_r_4 product_rating">
                        <span class="text-danger fas fa-star checked"></span>
                        <span class="text-danger fas fa-star checked"></span>
                        <span class="text-danger fas fa-star checked"></span>
                        <span class="text-danger fas fa-star checked"></span>
                        <span class="fas fa-star"></span>
                    </div>
                    <div class="product_text"><p>{{$products->description}} Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit natus earum neque ullam officia voluptas.</p></div>
                    <div class="product_text"><span class="text-info">Stack: </span>({{$products->stack_quantity}} ) | <span class="text-info">Unit: </span>{{$products->unit}} Pcs</div>

                    <div class="order_info d-flex flex-row">
                        <form action="#">
                            <div class="clearfix" style="z-index: 1000;">
                               <div class="row">
                                @isset($products->color)
                                    <div class="mb-3 col-6">
                                        <label class="form-label" for="basic-default-company">Color</label>
                                        <select type="text" class="form-control" name="color" >
                                            @foreach ($colors as $color)
                                            <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endisset
                                    @isset($products->size)
                                    <div class="mb-3 col-6">
                                        <label class="form-label" for="basic-default-company">Size</label>
                                        <select type="text" class="form-control" name="size" >
                                            @foreach ($sizes as $size)
                                            <option value="{{$size}}">{{$size}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endisset
                                </div>

                                <!-- Product Quantity -->
                                <div class="product_quantity clearfix">
                                    <span>Quantity: </span>
                                    <input id="quantity_input" type="text" pattern="[1-9]*" value="1">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fas fa-chevron-up"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fas fa-chevron-down"></i></div>
                                    </div>
                                </div>


                            </div>

                            {{-- <div class="product_price">{{$products->selling_price}}$2000</div> --}}
                            @if ($products->discount_price == '0')
                            <div class="banner_price">{{$settings->currency}} {{$products->selling_price}}</div>
                            @else
                            <div class="banner_price"><span> {{$settings->currency}} {{$products->selling_price}}</span>{{$settings->currency}} {{$products->discount_price}} </div>
                            @endif
                            <div class="button_container">
                                <button type="button" class="button cart_button">Add to Cart</button>
                                <div class="product_fav"><i class="fas fa-heart"></i></div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 order-lg-2 order-1">
                <div class="product_category"><p><span class="fas fa-map-marker-alt"> Pickup Point of This Product:</span> {{$products->pickup->address}}</p></div>


                <div class="product_category">
                    <h6 class="text-left mt-1">Delivery Criteria</h6>
                    <p><span class="far fa-arrow-alt-circle-right"> (12-24) Hours Delivery after Order Placed!</span></p>
                    <p><span class="far fa-arrow-alt-circle-right"> Delivery Charge : (Ok)</span></p>
                    <p><span class="far fa-arrow-alt-circle-right"> Cash on Delivery : </span> {{$products->cash_on_delivery == null ? 'Not Available' : 'Available'}}</p>
                </div>
                <div class="product_category">
                    <h6 class="text-left mt-1">Terms & Condition</h6>
                    <p><span class="far fa-arrow-alt-circle-right"> 7 Days Replacement Gurantee : Not Available</span></p>
                    <p><span class="far fa-arrow-alt-circle-right"> Warrenty : Not Available</span></p>

                </div>

                <div class="product-video">
                    <p>Video Review: </p>
                  @if ($products->video == 0)
                    <span class="text-warning tw-400">Opps! Nothing else.....</span>
                  @else
                    <iframe src="{{$products->video}}" frameborder="0"></iframe>

                  @endif








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
                        @foreach ($relatedProduct as $item )
                        <!-- Recently Viewed Item -->
                        <div class="owl-item">
                            <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                <div class="viewed_image"><img src="{{asset($item->images)}}" alt=""></div>
                                <div class="viewed_content text-center">
                                    @if ($item->discount_price == '0')
                                    <div class="viewed_price">{{$settings->currency}} {{$item->selling_price}}</div>
                                    @else
                                    <div class="viewed_price"><span> {{$settings->currency}} {{$item->selling_price}}</span>{{$settings->currency}} {{$item->discount_price}} </div>
                                    @endif

                                    <div class="viewed_name"><a href="{{route('product.details',$item->id)}}">{{$item->name}}</a></div>
                                </div>
                                <ul class="item_marks">
                                    @isset($item->discount_price)
                                    <li class="item_mark item_discount">{{$settings->currency}} {{$item->selling_price-$item->discount_price}}</li>
                                    @endisset

                                    <li class="item_mark item_new">new</li>
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

                        @foreach ($brandItem as $item)

                        <div class="owl-item"><div class="brands_item d-flex flex-column justify-content-center"><img src="{{asset($item->brand->brand_logo)}}" alt="" width="95" height="50"></div></div>
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
                        <div class="newsletter_icon"><img src="images/send.png" alt=""></div>
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


<script src="{{asset('front-end/assets/js/product_custom.js')}}"></script>
@endsection



