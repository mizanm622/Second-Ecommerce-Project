@extends('layouts.admin')

@section('admin-content')
<link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" />
<!-- Basic Bootstrap Table -->


    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">Sub Category Table</h4>
         <div class="card">
                <h5 class="card-header " > <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">+ Add New</button></h5>

            <div class="table-responsive text-nowrap table-border">
            <table class="table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Subcategory Name</th>
                    <th>Subcategory Slug</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Logo</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                     {{-- get data from subcatagory table --}}
                    @foreach ($subcategories as $category=>$value)



                <tr>


                    <td>{{$category+1}}</td>
                    <td>{{$value->subcategory_name}}</td>
                    <td>{{$value->subcategory_slug}}</td>
                    <td>{{$value->category_name}}</td>
                    <td>{!! $value->status == 1 ? '<i class="bx bxs-bell text-success"></i>' : '<i class="bx bxs-bell-off text-danger"></i>' !!}</td>
                    <td><img src="{{$value->subcategory_logo}}" alt="{{$value->subcategory_logo}}" width="40" height="20"> </td>
                    <td><a href="" data-bs-toggle="modal" class="edit" data-id="{{$value->id}}" data-bs-target="#updateModal"> <i class="bx bx-edit"></i></a>| <a id="delete" href="{{route('delete.subcategory',$value->id)}}"><i class="bx bx-trash" ></i></a></td>

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
              <h5 class="modal-title" id="exampleModalLabel1">Add Sub Category</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form action="{{route('store.subcategory')}}" method="post" enctype="multipart/form-data" id="add-form">
                @csrf
                <div class="modal-body">
                <div class="row">
                    <div class="col-6 mb-3">
                    <label for="nameBasic" class="form-label">Category Name</label>
                    <select class="form-control" name="category_id" id="category_id" required>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="col-6 mb-3">
                    <label for="nameBasic" class="form-label">Sub Category Name</label>
                    <input type="text" id="subcategory_name" name="subcategory_name" class="form-control" placeholder="Enter Sub Category Name" required/>
                    </div>
                </div>

                <div class="row">
                    <div class="col-9 mb-3">
                        <label for="nameBasic" class="form-label">Logo</label>
                        <input type="file" id="subcategory_logo" name="subcategory_logo"  class="form-control dropify"/>

                    </div>

                    <div class="col-3 mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input btn" type="checkbox" value="1" name="status" role="switch" id="flexSwitchCheckChecked" checked >
                        </div>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save Subcategory</button>
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
              <h5 class="modal-title" id="exampleModalLabel1">Update Sub Category</h5>
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

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}
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
        // edit subcategory
        $(document).on('click','.edit',function(){
        let subcat_id=$(this).data('id');
        $.get('subcategory/edit/'+subcat_id, function(data){
            $('.modal_body').html(data);
        });

        })

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
                            $('.table').load(location.href+' .table');

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


    </script>

@endsection
