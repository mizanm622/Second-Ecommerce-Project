@extends('layouts.admin')

@section('admin-content')

<div class="container-xxl flex-grow-1 container-p-y">

    <div class="card">
      <h4 class="fw-bold text-center bg-dark text-light py-2">Complete Orders</h4>

      <h5 class="card-header">
          @foreach ($address as $items)
          <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#id{{$items->id}}">
            <div class=""> <span class="text-left col-4"> Ordere: #{{$loop->iteration}}</span> Status:<span class="text-center col-4">{!!$items->status == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</span> Tracking:<span class="text-center col-4">{!!$items->tracking == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</span>Date:<span class="text-right col-4"> {{$items->order_date}}</span></div>
          </button>

          @endforeach
      </h5>
       <div class="table-responsive text-nowrap table-border">
      </div>
  </div>
</div>
<!--/ Basic Bootstrap Table -->
<div class="container">
  <div class="row">
      @foreach ($address as $items)
      <div class="col-lg-4 col-md-6">
          <div class="mt-3">
              <!--Insert Category Modal -->
              <div class="modal fade" id="id{{$items->id}}" tabindex="-1" aria-hidden="true">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                          <h5 class="modal-title m-auto" id="exampleModalLabel1">Single Order</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close" ></button>
                          </div>
                          <div class="modal-body">
                              <div class="table-responsive text-nowrap table-border">
                                  <table class="table table-responsive" id="data-table"><!--Product table-->
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
                                                  <tr><!--Order Items-->
                                                      <td>{{$loop->iteration}}</td>
                                                      <td><img src="{{asset($item->product_image)}}" alt="{{$item->product_image}}" width="40" height="40"></td>
                                                      <td>{{$item->product_name}}</td>
                                                      <td>{{$item->product_quantity}}</td>
                                                      <td>{{$item->product_color}}</td>
                                                      <td>{{$item->product_size}}</td>
                                                      <td>{{$settings->currency}}{{$item->product_price}} /-</td>
                                                  </tr><!--End Order Items-->
                                              @endif
                                          @endforeach
                                              <!--Items Calculatio-->
                                              <tr class="text-right"><th class="text-right" colspan="3">Subtotal:<td colspan="4">{{$settings->currency}} {{$items->subtotal}} /-</td></th></tr>
                                              @if($items->coupon_code == 0)

                                              @else
                                                  <tr class="text-right"><th class="text-right" colspan="3">Coupon Code:<td colspan="4">{{$items->coupon_code}}</td></th></tr>
                                                  <tr class="text-right"><th class="text-right" colspan="3">Discount:<td colspan="4">(-) {{$settings->currency}} {{$items->discount_amount}} /-</td></th></tr>
                                              @endif
                                              <tr class="text-right"><th class="text-right" colspan="3">Tax:<td colspan="4">(+) {{$settings->currency}} {{$items->tax}} /-</td></th></tr>
                                              <tr class="text-right"><th class="text-right" colspan="3">Delivery Charge:<td colspan="4">(+) {{$settings->currency}} {{$items->delivery_charge}} /-</td></th></tr>
                                              <tr class="text-right"><th class="text-right" colspan="3">Total Paid:<td colspan="4">{{$settings->currency}} {{$items->total}} /-</td></th></tr>
                                                  <!--End Items Calculatio-->

                                              <div class="address"><!--Shipping address-->
                                                  <span class="bg-dark text-light h6 my-2">Shipping Address</span>
                                                  <p class="m-0 p-0 text-dark">   Phone:<span>{{$items->phone}}</span></p>
                                                  <p class="m-0 p-0 text-dark">   Email:<span>{{$items->email}}</span></p>
                                                  <p class="m-0 p-0 text-dark"> Address:<span>{{$items->address}}</span></p>
                                                  <p class="m-0 p-0 text-dark">    Town:<span>{{$items->town}}</span></p>
                                                  <p class="m-0 p-0 text-dark">    City:<span>{{$items->city}}</span></p>
                                                  <p class="m-0 p-0 text-dark">Zip Code:<span>{{$items->zip}}</span></p>
                                                  <p class="m-0 p-0 text-dark"> Country:<span>{{$items->country}}</span></p>
                                                  <p class="text-dark"> Order Status:<span class="text-center col-4"><a href="javascript:void(0)" id="status" data-status="{{$items->status}}" data-id="{{$items->id}}"> {!!$items->status == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</a></span></p>
                                                  <p class="text-dark"> Order Tracking:<span class="text-center col-4"><a href="javascript:void(0)" id="tracking" data-tracking="{{$items->tracking}}" data-id="{{$items->id}}"> {!!$items->tracking == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</a></span></p>

                                              </div><!--End Shipping address-->
                                      </tbody>
                                  </table><!--End Product table-->
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                      Close
                                  </button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @endforeach
  </div>
</div>
<!-- Category Insert Modal area--->
{{-- <div class="container"><!--Pending Order List container-->
    <div class="order-list">
        <div class="card">
            <div class="card-header">
                <h5>Complete Orders</h5>
            </div>
            <div class="card-body"><!--Pending Order List-->
                @foreach ($address as $items)
                    <div class="single-order-area"><!--Single Order area-->
                        <div class="card-header"><!--Collapse button-->
                            <button class="btn btn-block btn-primary" type="button" data-toggle="collapse" data-target="#{{$items->id}}" aria-expanded="false" aria-controls="collapseExample">
                                <div class=""> <span class="text-left col-4"> Ordere: #{{$loop->iteration}}</span> Status:<span class="text-center col-4">{!!$items->status == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</span> Tracking:<span class="text-center col-4">{!!$items->tracking == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</span>Date:<span class="text-right col-4"> {{$items->order_date}}</span></div>
                            </button>
                        </div><!--End Collapse button-->
                        <div class="card-body"><!--Collapse body-->
                            <div class="collapse" id="{{$items->id}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table" id="data-table"><!--Product table-->
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
                                                            <tr><!--Order Items-->
                                                                <td>{{$loop->iteration}}</td>
                                                                <td><img src="{{asset($item->product_image)}}" alt="{{$item->product_image}}" width="40" height="40"></td>
                                                                <td>{{$item->product_name}}</td>
                                                                <td>{{$item->product_quantity}}</td>
                                                                <td>{{$item->product_color}}</td>
                                                                <td>{{$item->product_size}}</td>
                                                                <td>{{$item->product_price}}</td>
                                                            </tr><!--End Order Items-->
                                                        @endif
                                                    @endforeach
                                                        <!--Items Calculatio-->
                                                        <tr class="text-right"><th class="text-right" colspan="3">Subtotal:<td colspan="4">{{$settings->currency}} {{$items->subtotal}} /-</td></th></tr>
                                                        @if($items->coupon_code == 0)

                                                        @else
                                                            <tr class="text-right"><th class="text-right" colspan="3">Coupon Code:<td colspan="4">{{$items->coupon_code}}</td></th></tr>
                                                            <tr class="text-right"><th class="text-right" colspan="3">Discount:<td colspan="4">(-) {{$settings->currency}} {{$items->discount_amount}} /-</td></th></tr>
                                                        @endif
                                                        <tr class="text-right"><th class="text-right" colspan="3">Tax:<td colspan="4">(+) {{$settings->currency}} {{$items->tax}} /-</td></th></tr>
                                                        <tr class="text-right"><th class="text-right" colspan="3">Delivery Charge:<td colspan="4">(+) {{$settings->currency}} {{$items->delivery_charge}} /-</td></th></tr>
                                                        <tr class="text-right"><th class="text-right" colspan="3">Total Paid:<td colspan="4">{{$settings->currency}} {{$items->total}} /-</td></th></tr>
                                                            <!--End Items Calculatio-->

                                                        <div class="address"><!--Shipping address-->
                                                            <span class="bg-dark text-light h6 my-2">Shipping Address</span>
                                                            <p class="m-0 p-0 text-dark">   Phone:<span>{{$items->phone}}</span></p>
                                                            <p class="m-0 p-0 text-dark">   Email:<span>{{$items->email}}</span></p>
                                                            <p class="m-0 p-0 text-dark"> Address:<span>{{$items->address}}</span></p>
                                                            <p class="m-0 p-0 text-dark">    Town:<span>{{$items->town}}</span></p>
                                                            <p class="m-0 p-0 text-dark">    City:<span>{{$items->city}}</span></p>
                                                            <p class="m-0 p-0 text-dark">Zip Code:<span>{{$items->zip}}</span></p>
                                                            <p class="m-0 p-0 text-dark"> Country:<span>{{$items->country}}</span></p>
                                                            <p class="text-dark"> Order Status:<span class="text-center col-4"><a href="javascript:void(0)" id="status" data-status="{{$items->status}}" data-id="{{$items->id}}"> {!!$items->status == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</a></span></p>
                                                            <p class="text-dark"> Order Tracking:<span class="text-center col-4"><a href="javascript:void(0)" id="tracking" data-tracking="{{$items->tracking}}" data-id="{{$items->id}}"> {!!$items->tracking == 0 ? '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:red"></i>' : '<i class="fa fa-check" style="font-size:24px;color:green"></i>'!!}</a></span></p>

                                                        </div><!--End Shipping address-->
                                                </tbody>
                                            </table><!--End Product table-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div><!--End Collapse body-->
                    </div><!--End Single Order area-->
                @endforeach
            </div>
        </div><!--End Pending Order List-->
    </div>
</div><!--End Pending Order List container--> --}}


<script src="{{asset('front-end/assets/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript">
    // status
    $(document).on('click','#status', function(e){
        e.preventDefault();
        let id =$(this).data('id');
        let status =$(this).data('status');
        let url = "{{route('order.status')}}";
        $.ajax({
            url : url,
           type : 'get',
           anyne:false,
           data : {
                 id : id,
             status : status,
           },
           success:function(data){
            toastr.success(data);
            $('.card').load(location.href+' .card');
            $(document).find('.modal .btn-close').trigger('click');

           }

        });
    });
    // tracking
    $(document).on('click','#tracking', function(e){
    e.preventDefault();
    let id =$(this).data('id');
    let tracking =$(this).data('tracking');
    let url = "{{route('tracking.status')}}";
    $.ajax({
        url : url,
       type : 'get',
       anyne:false,
       data : {
             id : id,
       tracking : tracking,
       },
       success:function(data){
        toastr.success(data);
        $('.card').load(location.href+' .card');
        $(document).find('.modal .btn-close').trigger('click');

       }

    });
});

    </script>
@endsection


