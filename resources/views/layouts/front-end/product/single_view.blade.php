<div class="modal-body" id="modal-body">
    @php
        $colors=explode(',',$featuredProduct->color);
        $sizes=explode(',',$featuredProduct->size);
    @endphp
    <div class="card" id="card-refresh">
        <div class="card-header">
            <div class="product-name">
                <div class="row">
                    <div class="col-6"><!--Product brand logo-->
                    <img src="{{asset($featuredProduct->brand->brand_logo)}}" alt="" class="img-thumbnail text-center" width="60" height="80" >
                    </div>
                    <div class="col-6"><!--Product brand name-->
                        <h3 class="text-left">{{$featuredProduct->name}} </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="logo text-center"><!--Product logo-->
                        <img src="{{asset($featuredProduct->thumbnail)}}" alt="" class="img-thumbnail" width="250" height="300" >
                    </div>
                </div>
                <div class="col-6">
                    <div class="description">
                        <div class="product-header">
                            <div class="product-name">
                                <h4 class="m-0 pb-2"><span>Name: </span>{{$featuredProduct->name}}</h4><!--Product name-->
                                @if(empty($review))

                                @elseif (ceil($review->avg('review_rating')) == 5)
                                    <span>Review Rating: </span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>


                                @elseif (ceil($review->avg('review_rating')) == 4)
                                    <span>Review Rating: </span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-muted fas fa-star"></span>

                                @elseif (ceil($review->avg('review_rating')) == 3)
                                    <span>Review Rating: </span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>

                                @elseif (ceil($review->avg('review_rating')) == 2)
                                    <span>Review Rating: </span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>

                                @elseif (ceil($review->avg('review_rating')) == 1)
                                    <span>Review Rating: </span>
                                    <span class="text-warning fas fa-star checked"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>
                                    <span class="text-muted fas fa-star"></span>

                                @endif
                            </div>


                            @if ($featuredProduct->discount_price == 0)

                                <div class="price"><h5 class="p-0"><span class="">Price: </span>{{$settings->currency}} {{$featuredProduct->selling_price}} </h5></div>
                            @else
                            <div class="price"><h5 class="p-0 mt-1"><span class="">Reguler Price: </span>{{$settings->currency}} {{$featuredProduct->selling_price}} </h5></div>
                                <div class="price"><h5 class="text-danger p-0"></span>Discount Price:</span>{{$settings->currency}}{{$featuredProduct->discount_price}} </h5></div>
                            @endif
                            @if (isset($featuredProduct->stack_quantity))
                                <div class="qty"><h5 class="p-0"> <span>Available Stack:</span> <span class="badge badge-success badge-md px-3">{{$featuredProduct->stack_quantity}}</span></h5></div>
                            @else
                                <div class="qty"><h5 class="p-0" disabled><span class="">Stack Request:</span><span class="badge badge-success badge-md px-3"> 0 </span></h5></div>
                            @endif
                        </div>
                        <div class="product-body mt-4">
                            <div class="color"><!--Product color-->
                                @isset($featuredProduct->color)
                                <div class="mb-3">
                                    <div class="color-area">
                                        <div class="title">
                                            <h5 class="p-0"><span>Available Colors:</span>
                                            @foreach ($colors as $color)
                                                <span class="text-info" >{{$color}},</span>
                                            @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                @endisset
                            </div>
                            <div class="size"><!--Product size-->
                                @isset($featuredProduct->size)
                                    <div class="mb-3">
                                        <div class="size-area">
                                            <div class="title">
                                                <h5 class="p-0"><span>Avaiiable Sizes:</span>
                                                    @foreach ($sizes as $size)
                                                        <span class="text-info">{{$size}},</span>
                                                    @endforeach
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endisset
                            </div>
                        </div>
                    </div>
                    <div class="row pt-2 text-center"><!--Cart & Wishlist button area-->
                        <div class="col-12">
                            @guest
                                <div class="wishlist"><a class="btn btn-info btn-md "  href="" data-toggle="popover" title="Please login to continue"><i class="fas fa-heart"></i> Add to Wishlist</a> </div>
                            @else
                                <div class="wishlist"><a class="btn btn-info btn-md" id="product-wishlist" data-id="{{$featuredProduct->id}}" href="javascript:void(0)"><i class="fas fa-heart"></i> Add to Wishlist</a> </div>
                            @endguest
                        </div>
                    </div><!--End Cart & Wishlist button area-->
                </div>

            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

// $('#add-to-cart').submit(function(e) {

//     e.preventDefault();
//     // $('.loading').removeClass('d-none');
//     var url = $(this).attr('action');
//     var request = $(this).serialize();
//     $.ajax({
//         url: url,
//         type: 'post',
//         anyne: false,
//         async: false,
//         data: request,
//         success:function(data) {
//             toastr.success(data);
//              $('#add-to-cart')[0].reset();
//             //  $('.loading').addClass('d-none');

//             // $('.card-body').load(location.href+' .card-body');
//             //  $(document).find('#myModal .close').trigger('click');
//         }
//     });
//     });


    $(document).on('click','#cart',function(e) {
        e.preventDefault();
    // $('.loading').removeClass('d-none');
    let id = $(this).data('id');
    let cart_item = $(this).closest('.card');
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
        $(document).find('#myModal .close').trigger('click');
            toastr.success(data);
           //$('')[0].reset();
        //   $('#modal-close').load(location.href+' #modal-close');
          // window.location.reload();
           $('.cart').load(location.href+' .cart');

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

</script>
