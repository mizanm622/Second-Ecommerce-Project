@extends('layouts.admin')

@section('admin-content')
<link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" />
<!-- Basic Bootstrap Table -->


    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">Campaing List Table</h4>
         <div class="card">

                <h5 class="card-header " > <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">+ Add New</button></h5>

            <div class="table-responsive text-nowrap table-border">
            <table class="table ytable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Logo</th>
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
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Add New Campaing</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form action="{{route('store.campaing')}}" method="post" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-body">

                <div class="row">
                    <div class="col-6 mb-3">
                    <label for="nameBasic" class="form-label">Title</label>
                    <input type="text" id="campaing_title" name="campaing_title" class="form-control" placeholder="Enter Title" required/>
                    </div>
                    <div class="col-3 mb-3">
                        <label for="nameBasic" class="form-label">Discount</label>
                        <input type="text" id="discount" name="discount" class="form-control" placeholder="Enter Discount" required/>
                    </div>

                    <div class="col-3 mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input btn" type="checkbox" value="1" name="status" role="switch" checked>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                    <label for="nameBasic" class="form-label">Start Date</label>
                    <input type="date" id="input-file-now"  name="start_date" class="form-control"  required/>
                    </div>

                    <div class="col-6 mb-3">
                    <label for="nameBasic" class="form-label">Start Date</label>
                    <input type="date" id="input-file-now" name="end_date" class="form-control"  required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                    <label for="nameBasic" class="form-label">Description</label>
                    <textarea type="text" id="campaing_description" name="campaing_description" class="form-control" placeholder="Enter Description" cols="10" rows="5" required ></textarea>
                    </div>

                    <div class="col-6 mb-3">
                        <label for="nameBasic" class="form-label">Logo</label>
                        <input type="file" id="file"  name="images" class="form-control dropify"  required/>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save Campaing</button>
                </div>
           </form>
          </div>
        </div>
      </div>
    </div>
  </div>

   <!-- Brand Update Modal area--->
   <div class="col-lg-4 col-md-6">
    <div class="mt-3">
      <!-- Button trigger modal -->
      <!-- Update Category Modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Campaing Brand</h5>
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
  <script src="{{asset('assets/vendor/js/dropify.min.js')}}"></script>

  <script type="text/javascript">
$('.dropify').dropify({
    messages: {
        'default': 'Drag and drop a file here or click',
        'replace': 'Drag and drop or click to replace',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
    }
});

 // insert data
//  $('#add-form').submit(function(e) {
//         e.preventDefault();

//         $('.loading').removeClass('d-none');
//         var url = $(this).attr('action');
//         var request = $(this).serialize();
//         $.ajax({
//             url: url,
//             type: 'post',
//             anyne: false,
//             dataType: 'json',
//             data: request,
//             success:function(data) {
//                 toastr.success(data);
//                 $('#add-form')[0].reset();
//                 $('.loading').addClass('d-none');
//                 $(document).find('#insertModal .btn-close').trigger('click');
//                 $('.ytable').DataTable().ajax.reload();
//             }
//         });
//         });

        // insert data with image using ajax
        $(document).ready(function(){
              $('#add-form').on('submit', function(event){
                    event.preventDefault();

                    var url = $(this).attr('action');

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(response)
                        {
                            toastr.success(response.message);
                            $('#add-form')[0].reset();
                            $(document).find('#insertModal .btn-close').trigger('click');
                            $('.ytable').DataTable().ajax.reload();

                        },
                        error: function(response) {
                            $('.error').remove();
                            $.each(response.responseJSON.errors, function(k, v) {
                                $('[name=\"images\"]').after('<p class="error">'+v[0]+'</p>');
                            });
                        }
                    });
                });

            });






 // insert review data
//  $('#add-form').submit(function(e) {
//     e.preventDefault();
//     var url = $(this).attr('action');
//     var request = $(this).serialize();
//     $.ajax({
//         url: url,
//         type: 'post',
//         anyne: false,
//         data: request,
//         success:function(data) {
//             toastr.success(data);
//              $('#add-form')[0].reset();
//              $('.ytable').load(location.href+' .ytable');
//         }
//     });
//     });

   $(function champaing(){
    $.noConflict();
    var table=$('.ytable').DataTable({
        processing:true,
        serverSide:true,
        ajax: "{{route('campaing.index')}}",
        columns:[
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data:'campaing_title', name:'campaing_title'},
            {data:'campaing_description', name:'campaing_description'},
            {data:'discount', name:'discount'},
            {data:'status', name:'status'},
            {data:'start_date', name:'start_date'},
            {data:'end_date', name:'end_date'},
            {data:'images', name:'images',render: function(data, type, full, meta){
                return "<img src=\""+data+"\" height=\"40\" width=\"40\" />"
            }},
            {data:'action', name:'action', orderable:true, searchable:true},

        ]
    });

   });
    // edit data
    $(document).on('click','.update',function(){
        let id=$(this).data('id');
        $.get('campaing/edit/'+id, function(data){
            $('.modal_body').html(data);
        });
        })

          // delete data
    $(document).on('click','#delete',function(){
        let id=$(this).data('id');
        $.get('campaing/delete/'+id, function(data){
            toastr.success(data.message);
            $('.ytable').DataTable().ajax.reload();
        });
        })

      // status change
      $(document).on('click', '.status', function() {

        let object = $(this)
        let id = $(this).data('id');
        let status = $(this).data('status');
        let url = "{{ url('/campaing/status') }}/"+id;

        $.ajax({
            url:url,
            type:'get',
            data: {
                status:status,
            },
            success:function(data) {
                status = status == 1 ? 0 : 1;
                if(data.status == 'success') {
                    if(status == 1) {
                        toastr.success('Status Successfully Enabled!');
                        object.closest('td').html(`<a href="javascript:void(0)" class="status" data-id="${ id }" data-status="${ status }">
                                <i class="bx bxs-bell bx-flip-horizontal text-success"></i>
                            </a>`);
                    } else {
                        toastr.success('Status Successfully Dissabled!');
                        object.closest('td').html(`<a href="javascript:void(0)" class="status" data-id="${ id }" data-status="${ status }">
                                <i class="bx bxs-bell-off bx-flip-horizontal text-danger"></i>
                            </a>`);

                    }
                }
            }
        });
        });



    </script>

@endsection
