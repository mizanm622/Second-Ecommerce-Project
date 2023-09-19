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
            <!-- Multy Image -->
            <div class="col-lg-2 order-lg-1 order-2">
                <ul class="image_list">
                    <li data-image="{{asset($products->images)}}"><img src="{{asset($products->images)}}" alt="" height="150px" width="80px"></li>
                    <li data-image="{{asset($products->images)}}"><img src="{{asset($products->images)}}" alt="" height="150px" width="80px"></li>
                    <li data-image="{{asset($products->images)}}"><img src="{{asset($products->images)}}" alt="" height="150px" width="80px"></li>
                </ul>
            </div>

            <!-- Single Image -->
            <div class="col-lg-3 order-lg-2 order-1">
                <div class="image_selected"><img src="{{asset($products->thumbnail)}}" alt="" width="200px"></div>
            </div>

            <!-- Description -->
            <div class="col-lg-4 order-lg-2 order-3">
                <div class="product_description">
                    <div class="product_category">{{$products->childcategory->childcategory_name}}</div>
                    <div class="product_name">{{$products->name}}</div>
                    <div class="rating_r rating_r_4 product_rating">
                        @if(empty($review))

                            @elseif (ceil($review->avg('review_rating')) == 5)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="">({{ceil($review->avg('review_rating'))}})</span>

                            @elseif (ceil($review->avg('review_rating')) == 4)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="">({{ceil($review->avg('review_rating'))}})</span>
                            @elseif (ceil($review->avg('review_rating')) == 3)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="">({{ceil($review->avg('review_rating'))}})</span>
                            @elseif (ceil($review->avg('review_rating')) == 2)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="">({{ceil($review->avg('review_rating'))}})</span>
                            @elseif (ceil($review->avg('review_rating')) == 1)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="">({{ceil($review->avg('review_rating'))}})</span>
                            @endif
                    </div>
                    <div class="product_text"><p>{{$products->description}} Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit natus earum neque ullam officia voluptas.</p></div>
                    <div class="product_text"><span class="text-info">Stack: </span>({{$products->stack_quantity}} ) | <span class="text-info">Unit: </span>{{$products->unit}} Pcs</div>

                    <div class="order_info d-flex flex-row">
                        <input type="hidden" value="{{$products->name}}" name="name">
                        <input type="hidden" value="{{$products->thumbnail}}" name="image">

                        <div class="clearfix" style="z-index: 1000;">
                            <div class="row">
                                @isset($products->color)
                                    <div class="mb-3 col-6 pl-0 pr-4"><!-- Product color -->
                                        <label class="form-label pl-2" for="basic-default-company">Color:</label>
                                        <select type="text" class="form-control" name="color" >
                                            @foreach ($colors as $color)
                                            <option value="{{$color}}">{{$color}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endisset
                                @isset($products->size)
                                <div class="mb-3 col-6 pl-4"><!-- Product size -->
                                    <label class="form-label pl-2" for="basic-default-company">Size:</label>
                                    <select type="text" class="form-control" name="size">
                                        @foreach ($sizes as $size)
                                        <option value="{{$size}}">{{$size}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endisset
                            </div>
                            <div class="row">
                                <div class="col-6"><!-- Product Quantity -->
                                    <div class="product-quantities">
                                        <label class="form-label" for="basic-default-company">Quantity:</label>
                                        <input id="" name="quantity" type="number" class="form-control" min="1" pattern="[1-9]*" value="1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @if ($products->discount_price == 0)
                                    <input type="hidden" value="{{$products->selling_price}}" name="price">
                                    <div class="banner_price">{{$settings->currency}} {{$products->selling_price}}</div>
                                @else
                                    <input type="hidden" value="{{$products->discount_price}}" name="price">
                                    <div class="banner_price"><span> {{$settings->currency}} {{$products->selling_price}}</span>{{$settings->currency}} {{$products->discount_price}} </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="button_container">
                                    @guest
                                        <a class="btn btn-primary btn-md" data-toggle="popover" title="Please login to continue" data-content=""href=""><span class="fas fa-shopping-cart"></span> Add to Cart</a>
                                        <a class="btn btn-info btn-md" href="" data-toggle="popover" title="Please login to continue" data-content=""><span class="fas fa-heart"></span> Add to Wishlist</a>
                                    @else
                                        <button type="submit" class="btn btn-primary btn-md" href="javascript:void(0)" data-id="{{$products->id}}" id="cart"><span class="fas fa-shopping-cart"></span>Add to Cart</button>
                                        <a class="btn btn-info btn-md" id="product-wishlist" data-id="{{$products->id}}" href="javascript:void(0)"><span class="fas fa-heart"></span> Add to Wishlist</a>
                                        <div class="product_fav"><span class="fas fa-heart"></span></div>
                                    @endguest
                                </div>
                            </div>
                        </div>
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
<div class="product-review">
    <div class="row">
        <div class="col-4">
            <div class="product-details mx-2">
                <p>Product Configuration</p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Name: <td>Mizanur Rahman</td></th>
                            <th colspan="2">Email: <td>Mizanur Rahman</td></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-4">
            <div class="review-description mx-2">
                <div class="row">
                    <div class="col-6">
                        <div class="average-rating">
                            <p>Average Review</p>
                            @if(empty($review))
                             @elseif (intval($review->avg('review_rating')) == 5)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="">({{intval($review->avg('review_rating'))}})</span>
                            @elseif (intval($review->avg('review_rating')) == 4)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="">({{intval($review->avg('review_rating'))}})</span>
                            @elseif (intval($review->avg('review_rating')) == 3)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="">({{intval($review->avg('review_rating'))}})</span>
                            @elseif (intval($review->avg('review_rating')) == 2)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="">({{intval($review->avg('review_rating'))}})</span>
                            @elseif (intval($review->avg('review_rating')) == 1)
                                <span class="text-warning fas fa-star checked"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="text-muted fas fa-star"></span>
                                <span class="">({{intval($review->avg('review_rating'))}})</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="rating-count">
                            <p>Total Review</p>
                            @if(empty($review))
                            <p>No Review Found !</p>
                            @else
                                <div class="five-star">
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="">Total ({{$review->where('review_rating',5)->count();}})</span>
                                </div>

                                <div class="four-star">
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="">Total ({{$review->where('review_rating',4)->count();}})</span>
                                </div>

                                <div class="three-star">
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="">Total ({{$review->where('review_rating',3)->count();}})</span>
                                </div>

                                <div class="two-star">
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="">Total ({{$review->where('review_rating',2)->count();}})</span>
                                </div>

                                <div class="one-star">
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="">Total ({{$review->where('review_rating',1)->count();}})</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="show-review mt-4"><!--Review show-->
                     <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">
                        Show Product Review
                    </button>
                    <div class="modal" id="myModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Customer Reviews</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" id="review">
                                    <div class="card">
                                        @if(empty($review))
                                        <p>No Review Found !</p>
                                        @else
                                            @foreach ($review as $row)
                                                <div class="card-header">
                                                    <h5><span>{{$loop->iteration}} .</span> {{$row->user->name}} | {{$row->review_date}}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p>{{$row->review_name}}</p>
                                                    @if ($row->review_rating == 5)
                                                    <div class="rating">
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>

                                                    </div>
                                                    @elseif ($row->review_rating == 4)
                                                    <div class="rating">
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-muted fas fa-star"></span>

                                                    </div>
                                                    @elseif ($row->review_rating == 3)
                                                    <div class="rating">
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-muted fas fa-star"></span>
                                                        <span class="text-muted fas fa-star"></span>

                                                    </div>
                                                    @elseif ($row->review_rating == 2)
                                                    <div class="rating">
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-muted fas fa-star"></span>
                                                        <span class="text-muted fas fa-star"></span>
                                                        <span class="text-muted fas fa-star"></span>

                                                    </div>
                                                    @elseif ($row->review_rating == 1)
                                                    <div class="rating">
                                                        <span class="text-warning fas fa-star checked"></span>
                                                        <span class="text-muted fas fa-star"></span>
                                                        <span class="text-muted fas fa-star"></span>
                                                        <span class="text-muted fas fa-star"></span>
                                                        <span class="text-muted fas fa-star"></span>
                                                    </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="review-form mx-2">
                <p>User Review Form</p>
                <form action="{{route('product.review')}}" method="post"  id="add-form">
                    @csrf
                    <div class="form-grout p-3">
                        <label class="form-label" for="basic-default-message">Description :</label>
                        <textarea type="text" name="review_name" class="form-control" placeholder="Write your comment  Here...." required></textarea>
                    </div>
                    <div class="form-grout p-3">
                        <label class="form-label" for="basic-default-message">Review Rating :</label>
                        <select type="text" name="review_rating" class="form-control" id="review_rating"  required >
                                <option value="1">1 Star</option>
                                <option value="2">2 Star</option>
                                <option value="3">3 Star</option>
                                <option value="4">4 Star</option>
                                <option value="5">5 Star</option>
                        </select>
                    </div>
                    @guest
                    <div class="form-grout p-3">
                        <small>Plese login/registration to submit your review</small>
                        <input type="submit" class="form-control btn btn-primary" disabled value="Review Submit">
                    </div>
                    @else
                    <div class="form-grout p-3">
                        <input type="hidden" name="product_id" value="{{$products->id}}">
                        <input type="submit" class="form-control btn btn-primary" value="Review Submit">
                    </div>
                    @endguest
                </form>
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
                                <div class="viewed_item is_new discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <a href="{{route('product.details',$item->id)}}">
                                        <div class="viewed_image"><img src="{{asset($item->images)}}" alt="" width="40" height="120"></div>
                                        <div class="viewed_content text-center">
                                            @if ($item->discount_price == '0')
                                            <div class="viewed_price">{{$settings->currency}} {{$item->selling_price}}</div>
                                            @else
                                            <div class="viewed_price"><span> {{$settings->currency}} {{$item->selling_price}}</span>{{$settings->currency}} {{$item->discount_price}} </div>
                                            @endif

                                            <div class="viewed_name">{{substr($item->name, 0, 15)}}</div>
                                        </div>
                                    </a>
                                    <ul class="item_marks">
                                        @if($item->discount_price != 0)
                                        <li class="item_mark item_discount">{{number_format(($item->selling_price-$item->discount_price)*100/$item->discount_price, 1)}}</li>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{asset('front-end/assets/js/product_custom.js')}}"></script>
<script>
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
    });

    // insert review data
    $('#add-form').submit(function(e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var request = $(this).serialize();
    $.ajax({
        url: url,
        type: 'post',
        anyne: false,
        data: request,
        success:function(data) {
            toastr.success(data);
             $('#add-form')[0].reset();
             $('.review-description').load(location.href+' .review-description');
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


    $(document).on('click','#cart',function(e) {
    e.preventDefault();
// $('.loading').removeClass('d-none');
let id = $(this).data('id');
let cart_item = $(this).closest('.order_info');
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
    // $('#add-to-cart').submit(function(e) {
    // e.preventDefault();
    // var url = $(this).attr('action');
    // var request = $(this).serialize();
    // $.ajax({
    //     url: url,
    //     type: 'post',
    //     anyne: false,
    //     data: request,
    //     success:function(data) {
    //         toastr.success(data);
    //          $('#add-to-cart')[0].reset();
    //          $('.cart_price').load(location.href+' .cart_price');

    //     }
    // });
    // });
    </script>
@endsection



