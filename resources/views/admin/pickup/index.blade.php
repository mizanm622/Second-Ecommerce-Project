@extends('layouts.admin')

@section('admin-content')
<!-- Basic Bootstrap Table -->
<!-- include libraries(jQuery, bootstrap) -->

    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">Pickup Table</h4>
         <div class="card">

                <h5 class="card-header " > <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">+ Add New</button></h5>

            <div class="table-responsive text-nowrap table-border">
            <table class="table ytable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Pickup Name</th>
                    <th>Pickup Address</th>
                    <th>Phone One</th>
                    <th>Phone Two</th>
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

    </div>
  </div>
  <div class="modal fade" id="insertModal"  tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Add New Pickup</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form action="{{route('pickup.store')}}" method="post" id="add-form">
            @csrf
            <div class="modal-body">

            <div class="row">
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">Pickup Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter Your Pickup Name" required />

                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">Pickup Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Enter Your Pickup Address" required/>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">Phone</label>
                <input type="phone" id="phone_one" name="phone_one" class="form-control" placeholder="Enter Your Phone Number" required/>
                </div>
            </div>
            <div class="row">
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">Phone (Optional)</label>
                <input type="phone" id="phone_two" name="phone_two" class="form-control" placeholder="Enter Your Phone Number (Optional)" required/>
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
   <!-- Category Update Modal area--->
   <div class="col-lg-4 col-md-6">
    <div class="mt-3">
      <!-- Button trigger modal -->
      <!-- Update Category Modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Update Pickup</h5>
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

 <script type="text/javascript">// delete does not work
//start d.ready function
// $(document).ready(function(){

// $(document).on('click','#delete', function(e){
//     e.preventDefault();
//     var url =$(this).attr('href');
//     $("#deleted_form").attr('action', url);
//     swal({
//         title: 'Are you want to delete?',
//          text: 'Once Delete, This will be parmanently delete',
//          icon: 'warning',
//          button: true,
//          dangerMode: true,

//     }) .then((willDelete) => {
//         if(willDelete){
//             $("#deleted_form").submit();
//         }else{
//             swal('Safe Data!');
//         }
//     });

// });

// // delete data
// $('#deleted_form').submit(function(e){
//     e.preventDefault();
//     var url=$(this).attr('action');
//     var request=$(this).serialize();
//     $.ajax({
//         url:url,
//         type:'post',
//         anyne:false,
//         data:request,
//         success:function(data){
//             toastr.success(data);
//             $('#deleted_form')[0].reset();
//             table.ajax.reload();
//         }
//     });
// });

// });//end d.ready function

 </script>



 <script>
    // insert data
    $('#add-form').submit(function(e) {

        e.preventDefault();
        $('.loading').removeClass('d-none');
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
                $('.loading').addClass('d-none');
                $(document).find('#insertModal .btn-close').trigger('click');
                $('.ytable').DataTable().ajax.reload();
            }
        });
    });


</script>

<script type="text/javascript">
   $(function childcategory() {

    $.noConflict();
    var table = $('.ytable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('pickup.index')}}",
        columns: [
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data:'name', name:'name'},
            {data:'address', name:'address'},
            {data:'phone_one', name:'phone_one'},
            {data:'phone_two', name:'phone_two'},
            {data:'action', name:'action', orderable: true, searchable: true},
        ]
    });
   });

   // edit modal script
   $(document).on('click', '.edit', function() {
      let id = $(this).data('id');
      $.get('pickup/edit/'+id, function(data){
        $('.modal_body').html(data);
      });
    })
</script>



@endsection
