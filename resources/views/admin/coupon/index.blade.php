@extends('layouts.admin')

@section('admin-content')
<!-- Basic Bootstrap Table -->
<!-- include libraries(jQuery, bootstrap) -->

    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">Coupon Table</h4>
         <div class="card">

                <h5 class="card-header " > <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">+ Add New</button></h5>

            <div class="table-responsive text-nowrap table-border">
            <table class="table ytable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Coupon Type</th>
                    <th>Coupon Code</th>
                    <th>Coupon Amount</th>
                    <th>Validation</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">


                </tbody>
            </table>
            </div>

            </div>

          </div>

  <!--/ Basic Bootstrap Table -->

  <!-- Category Insert Modal area--->
  <div class="col-lg-4 col-md-6">
    <div class="mt-3">
      <!-- Button trigger modal -->
      <!--Insert Category Modal -->
      <div class="modal fade" id="insertModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Add New Coupon</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form action="{{route('coupon.store')}}" method="post" id="add-form">
                @csrf
                <div class="modal-body">

                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Coupon Type/Name</label>
                    <select type="text" id="coupon_type" name="coupon_type" class="form-control" placeholder="Coupon Type" required >
                        <option value="1">Fixed</option>
                        <option value="2">Percentage</option>
                    </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Coupon Code</label>
                    <input type="text" id="coupon_code" name="coupon_code" class="form-control" placeholder="Enter Coupon Code" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Coupon Amount</label>
                    <input type="text" id="coupon_amount" name="coupon_amount" class="form-control" placeholder="Enter Coupon Amount" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Validation Date</label>
                    <input type="date" id="valid_date" name="valid_date" class="form-control" placeholder="Valid Date" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Status</label>
                    <input type="text" id="status" name="status" class="form-control" placeholder="Coupon Status" required/>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save</button>
                </div>
           </form>
          </div>
        </div>
      </div>
    </div>
  </div>

   <!-- Category Update Modal area--->
   <div class="col-lg-4 col-md-6">
    <div class="mt-3">
      <!-- Button trigger modal -->
      <!-- Update Category Modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Update Coupon</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal_body">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.1/js/jquery.dataTables.min.js"></script>

  {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}

  <script type="text/javascript">
   $(function childcategory(){
    $.noConflict();
    var table=$('.ytable').DataTable({
        processing:true,
        serverSide:true,
        ajax: "{{route('coupon.index')}}",
        columns:[
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data:'coupon_type', name:'coupon_type'},
            {data:'coupon_code', name:'coupon_code'},
            {data:'coupon_amount',  name:'coupon_amount'},
            {data:'valid_date',  name:'valid_date'},
            {data:'status',  name:'status'},
            {data:'action', name:'action', orderable:true, searchable:true},

        ]
    });

   });

   $('body').on('click','.edit',function(){
      let id=$(this).data('id');
      $.get('coupon/edit/'+id, function(data){
        $('.modal_body').html(data);
      });

    })

</script>

@endsection
