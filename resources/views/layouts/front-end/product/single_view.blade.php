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
                                <h4 class="m-0 pb-2">{{$featuredProduct->name}}</h4><!--Product name-->
                                <input type="hidden" value="{{$featuredProduct->name}}" id="name" name="name">
                                <input type="hidden" value="{{$featuredProduct->thumbnail}}" id="image" name="image">
                            </div>
                            @if ($featuredProduct->discount_price == 0)
                                <input type="hidden" value="{{$featuredProduct->selling_price}}" id="price" name="price">
                                <div class="price"><h5 class="m-0 p-0"><span class="text-danger">{{$settings->currency}} {{$featuredProduct->selling_price}}</span> </h5></div>
                            @else
                                <input type="hidden" value="{{$featuredProduct->discount_price}}" id="price" name="price">
                                <div class="price"><h5 class="m-0 p-0"><del>{{$settings->currency}}{{$featuredProduct->selling_price}}</del> <span class="text-danger">{{$settings->currency}} {{$featuredProduct->discount_price}}</span> </h5></div>
                            @endif
                            @if (isset($featuredProduct->stack_quantity))
                                <div class="quantity"><h6 class="m-0 pt-1">Available Stack <span class="badge badge-success badge-md px-3">{{$featuredProduct->stack_quantity}}</span></h6></div>
                            @else
                                <div class="quantity"><h6 class="m-0 pt-1" disabled >Stack Request <span class="badge badge-success badge-md px-3"> 0 </span></h6></div>
                            @endif
                        </div>
                        <div class="product-body mt-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="quantity"><!--Product quantity-->
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="basic-default-company">Quantit:</label>
                                                <input type="number" id="quantity" class="form-control form-control-sm ml-0" min="1" max="9" value="1" name="quantity" style="margin-left:0px !important">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="color"><!--Product color-->
                                        @isset($featuredProduct->color)
                                        <div class="mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="basic-default-company">Color:</label>
                                                <select type="text" class="form-control form-control-sm ml-0" id="color" name="color" style="margin-left:0px !important" >
                                                    @foreach ($colors as $color)
                                                    <option value="{{$color}}">{{$color}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endisset
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="size"><!--Product size-->
                                        @isset($featuredProduct->size)
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="basic-default-company">Size:</label>
                                                    <select type="text" class="form-control form-control-sm ml-0" id="size" name="size" style="margin-left:0px !important" >
                                                        @foreach ($sizes as $size)
                                                        <option value="{{$size}}">{{$size}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-2"><!--Cart & Wishlist button area-->
                <div class="col-6">
                    <div class="form-group">
                        @guest
                            <button  data-toggle="popover" title="Please login to continue" class="form-control btn btn-primary btn-md text-light" ><i  class="fa fa-shopping-cart"></i> Add to Cart</button>
                        @else
                            <a href="javascript:void(0)" data-id="{{$featuredProduct->id}}" class="form-control btn btn-primary btn-md text-light" id="cart" name="cart"><i  class="fa fa-shopping-cart"></i> Add to Cart</a>
                        @endguest
                    </div>
                </div>
                <div class="col-6">
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
             $('.wishlist_count').load(location.href+' .wishlist_count');
        }
    });
    });

</script>
