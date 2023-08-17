
<div class="modal-body">
    <div class="row">
        <div class="col-xl-4 col-sm-6">
            <div class="img-thumb">
                <div class="card">
                    <div class="thumb">
                        <img src="{{asset($data->thumbnail)}}" alt="Logo" width="200px" height="300px">
                    </div>
                    <div class="image">
                        <img src="{{asset($data->images)}}" alt="Logo" width="100px" height="150px">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-sm-6">
            <div class="name">
                <table class="table table-striped">
                    <thead>
                        <tr><th>Name :</th><td>{{$data->name}}</td></tr>
                        <tr><th>Code :</th><td>{{$data->code}}</td></tr>
                        <tr><th>Size :</th><td>{{$data->size}}</td></tr>
                        <tr><th>Color :</th><td>{{$data->color}}</td></tr>
                        <tr><th>Quantity :</th><td>{{$data->stack_quantity}}</td></tr>
                        <tr><th>Purches Price :</th><td>{{$data->purches_price}}</td></tr>
                        <tr><th>Selling Price :</th><td>{{$data->selling_price}}</td></tr>
                        <tr><th>Discount Price :</th><td>{{$data->discount_price}}</td></tr>
                        <tr><th>Tags :</th><td>{{$data->tags}}</td></tr>
                        <tr><th>Warehouse :</th><td>{{$data->warehouse_id}}</td></tr>
                        <tr><th>Unit :</th><td>{{$data->unit}}</td></tr>
                        <tr><th>Featured :</th><td>{{$data->featured}}</td></tr>
                        <tr><th>Status :</th><td>{{$data->status}}</td></tr>
                        <tr><th>Todays Deal :</th><td>{{$data->todays_deal}}</td></tr>
                        <tr><th>Flash Deal :</th><td>{{$data->flash_deal_id}}</td></tr>
                        <tr><th>Delivery Method :</th><td>{{$data->cash_on_delivery}}</td></tr>
                    </thead>
                </table>

            </div>

        </div>

    </div>

    <div class="row">
      <div class="description">
        <p class="tw-600">Description: {{$data->description}}</p>
        <video src="{{$data->video}}"></video>
      </div>
    </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    </div>



<!-- include summernote css/js -->


