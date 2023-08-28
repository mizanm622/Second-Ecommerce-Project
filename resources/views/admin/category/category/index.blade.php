@extends('layouts.admin')

@section('admin-content')
<link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" />
<!-- Basic Bootstrap Table -->


    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">Category Table</h4>
         <div class="card">
            @if (Session()->has('msg'))
            <div class="alert alert-success">
                {{Session()->get('msg')}}
            </div>
            @endif
                <h5 class="card-header " > <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">+ Add New</button></h5>

            <div class="table-responsive text-nowrap table-border">
            <table class="table c-table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                     {{-- get data from catagory table --}}
                    @foreach ($categories as $category=>$value)

                <tr>

                    <td>{{$category+1}}</td>
                    <td>{{$value->category_name}}</td>
                    <td>{{$value->category_slug}}</td>
                    <td>{{$value->status}}</td>
                    <td><a href="" data-bs-toggle="modal" class="edit" data-id="{{$value->id}}" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a id="delete" href="{{route('delete.category',$value->id)}}"><i class="bx bx-trash" ></i></a></td>

                </tr>
                @endforeach
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
                        <h5 class="modal-title" id="exampleModalLabel1">Add Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close" ></button>
                        </div>
                        <form action="{{route('store.category')}}" method="post" enctype="multipart/form-data" id="add-form">
                            @csrf
                            <div class="modal-body">
                            <div class="row">
                                <div class="col-9 mb-3">
                                <label for="nameBasic" class="form-label">Category Name</label>
                                <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter Category Name" required/>
                                </div>


                                <div class="col-3 mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Status</label>
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="status" value="0">
                                        <input class="form-check-input btn" type="checkbox" value="1" name="status" role="switch" checked>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Save Category</button>
                            </div>
                        </form>
                    </div>
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
              <h5 class="modal-title" id="exampleModalLabel1">Update Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal_body">

                </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
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

$(document).on('click','.edit',function(){
        let id=$(this).data('id');
        $.get('category/edit/'+id, function(data){
            $('.modal_body').html(data);
        });
        })

//   $(document).on('click','.edit',function(){
//     let cat_id=$(this).data('id');
//     $.get('category/edit/'+cat_id, function(data){
//         $('#e_category_name').val(data.category_name);
//         $('#e_category_id').val(data.id);
//         $('#file').val(data.category_logo);
//         $('#status').val(data.status);

//     });

//   })



//insert review data
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
             $(document).find('#insertModal .btn-close').trigger('click');
             $('.c-table').load(location.href+' .c-table');
        }
    });
    });

   // insert data with image using ajax
        // $(document).ready(function(){
        //       $('#add-form').on('submit', function(event){
        //             event.preventDefault();

        //             var url = $(this).attr('action');

        //             $.ajax({
        //                 url: url,
        //                 method: 'POST',
        //                 data: new FormData(this),
        //                 dataType: 'JSON',
        //                 contentType: false,
        //                 cache: false,
        //                 processData: false,
        //                 success:function(response)
        //                 {
        //                     toastr.success(response.message);
        //                     $('#add-form')[0].reset();
        //                     $(document).find('#insertModal .btn-close').trigger('click');
        //                     $('.c-table').load(location.href+' .c-table');

        //                 },
        //                 error: function(response) {
        //                     $('.error').remove();
        //                     $.each(response.responseJSON.errors, function(k, v) {
        //                         $('[name=\"images\"]').after('<p class="error">'+v[0]+'</p>');
        //                     });
        //                 }
        //             });
        //         });

        //     });



  </script>
@endsection
