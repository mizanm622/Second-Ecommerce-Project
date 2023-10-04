@extends('layouts.admin')

@section('admin-content')


 <!-- Basic Layout -->
 <div class="container">
 <div class="row">
    <div class="col-4 py-3 px-1">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Update Payment Gateway</h6>
          <small class="text-muted float-end">aamer pay</small>
        </div>
        <div class="card-body my-3 mx-3">
            <form action="{{route('payment.gateway.update')}}" method="post" id="aamer">
                @csrf
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Gateway Name</label>
                <input type="text" id="gateway_name" name="gateway_name" class="form-control" value="{{$data->gateway_name}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Store ID </label>
                <input type="text" id="store_id" name="store_id" class="form-control" value="{{$data->store_id}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Signature Key</label>
                <input type="text" id="signature_key" name="signature_key" class="form-control" value="{{$data->signature_key}}"/>

            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Live</label>
                <div class="form-check form-switch">
                    <input class="form-check-input btn" type="checkbox" name="status" value="1" role="switch" @if($data->status == 1) checked @endif>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Sandbox</label>
                <div class="form-check form-switch">
                    <input class="form-check-input btn" type="checkbox" name="status" value="0" role="switch" @if($data->status == 0) checked @endif>
                </div>
            </div>
            <input type="hidden" name="id" value="{{$data->id}}">

            <button type="submit" class="btn btn-primary text-center m-auto">Update</button>
          </form>
        </div>
      </div>
    </div><!--End aamer Pay-->
    <div class="col-4 py-3 px-1">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Update Payment Gateway</h6>
            <small class="text-muted float-end">Surjo</small>
          </div>
          <div class="card-body my-3 mx-3">
              <form action="{{route('payment.gateway.update')}}" method="post" id="surjo">
                  @csrf
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Gateway Name</label>
                  <input type="text" id="gateway_name" name="gateway_name" class="form-control" value="{{$surjo->gateway_name}}"/>
              </div>
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Store ID </label>
                  <input type="text" id="store_id" name="store_id" class="form-control" value="{{$surjo->store_id}}"/>
              </div>
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Signature Key</label>
                  <input type="text" id="signature_key" name="signature_key" class="form-control" value="{{$surjo->signature_key}}"/>

              </div>
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Live</label>
                  <div class="form-check form-switch">
                      <input class="form-check-input btn" type="checkbox" name="status" value="1" role="switch" @if($surjo->status == 1) checked @endif>
                  </div>
              </div>
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Sandbox</label>
                  <div class="form-check form-switch">
                      <input class="form-check-input btn" type="checkbox" name="status" value="0" role="switch" @if($surjo->status == 0) checked @endif>
                  </div>
              </div>
              <input type="hidden" name="id" value="{{$surjo->id}}">

              <button type="submit" class="btn btn-primary text-center m-auto">Update</button>
            </form>
          </div>
        </div>
      </div><!--End Surjo Pay-->
      <div class="col-4 py-3 px-1">
        <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Update Payment Gateway</h6>
            <small class="text-muted float-end">SSL Commerz</small>
          </div>
          <div class="card-body my-3 mx-3">
              <form action="{{route('payment.gateway.update')}}" method="post" id="ssl">
                  @csrf
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Gateway Name</label>
                  <input type="text" id="gateway_name" name="gateway_name" class="form-control" value="{{$ssl_commerz->gateway_name}}"/>
              </div>
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Store ID </label>
                  <input type="text" id="store_id" name="store_id" class="form-control" value="{{$ssl_commerz->store_id}}"/>
              </div>
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Signature Key</label>
                  <input type="text" id="signature_key" name="signature_key" class="form-control" value="{{$ssl_commerz->signature_key}}"/>

              </div>
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Live</label>
                  <div class="form-check form-switch">
                      <input class="form-check-input btn" type="checkbox" name="status" value="1" role="switch" @if($ssl_commerz->status == 1) checked @endif>
                  </div>
              </div>
              <div class="form-group mb-3">
                  <label for="nameBasic" class="form-label">Sandbox</label>
                  <div class="form-check form-switch">
                      <input class="form-check-input btn" type="checkbox" name="status" value="0" role="switch" @if($ssl_commerz->status == 0) checked @endif>
                  </div>
              </div>
              <input type="hidden" name="id" value="{{$ssl_commerz->id}}">

              <button type="submit" class="btn btn-primary text-center m-auto">Update</button>
            </form>
          </div>
        </div>
      </div><!--End SSL-Commerz Pay-->
 </div>
</div>
  <!-- Category Insert Modal area--->


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
          // update payment method
          $('#aamer').submit(function(e) {
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
                  toastr.success(data);
              }
          });
          });

          $('#surjo').submit(function(e) {
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
                  toastr.success(data);
              }
          });
          });


          $('#ssl').submit(function(e) {
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
                  toastr.success(data);
              }
          });
          });

  </script>
@endsection


