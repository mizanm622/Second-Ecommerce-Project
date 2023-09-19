@extends('layouts.admin')

@section('admin-content')
<link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" />
<!-- Basic Bootstrap Table -->
<!-- include libraries(jQuery, bootstrap) -->

    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">Page Table</h4>
         <div class="card">
                <h5 class="card-header " > <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">+ Add New</button></h5>
            <div class="table-responsive text-nowrap table-border">
                <table class="table ytable table-responsive">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>P.Name</th>
                        <th>P.Title</th>
                        <th>H.One</th>
                        <th>Des.One</th>
                        <th>H.Two</th>
                        <th>Des.Two</th>
                        <th>H.Three</th>
                        <th>Des.Three</th>
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
                            <h5 class="modal-title" id="exampleModalLabel1">Add New Page</h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                            ></button>
                        </div>
                        <form action="{{route('page.store')}}" method="post" id="add-form" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="nameBasic" class="form-label">Page Name</label>
                                    <input type="text" id="page_name" name="page_name" class="form-control" placeholder="Enter Page Name" required/>
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="nameBasic" class="form-label">Title Name</label>
                                    <input type="text" id="page_title" name="page_title" class="form-control" placeholder="Enter Page Title" required/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="nameBasic" class="form-label">Heading(One)</label>
                                    <input type="text" id="heading_one" name="heading_one" class="form-control" placeholder="Enter Page Title" required/>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="nameBasic" class="form-label">Heading(two)</label>
                                    <input type="text" id="heading_two" name="heading_two" class="form-control" placeholder="Enter Page Title" required/>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="nameBasic" class="form-label">Heading(three)</label>
                                    <input type="text" id="heading_three" name="heading_three" class="form-control" placeholder="Enter Page Title" required/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="nameBasic" class="form-label">Image(One)</label>
                                    <input type="file" id="image_one" name="image_one" class="form-control dropify" placeholder="Enter Page Title" required/>
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="nameBasic" class="form-label">Image(two)</label>
                                    <input type="file" id="image_two" name="image_two" class="form-control dropify" placeholder="Enter Page Title" required/>
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="nameBasic" class="form-label">Image(three)</label>
                                    <input type="file" id="image_three" name="image_three" class="form-control dropify" placeholder="Enter Page Title" required/>
                                </div>


                            </div>

                            <div class="row">
                                <div class="col- mb-3">
                                    <label for="nameBasic" class="form-label">Description(One)</label>
                                    <textarea name="description_one" id="description_one" class="form-control" cols="30" rows="5">
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col- mb-3">
                                    <label for="nameBasic" class="form-label">Description(two)</label>
                                    <textarea name="description_two" id="description_two" class="form-control" cols="30" rows="5">
                                    </textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col- mb-3">
                                    <label for="nameBasic" class="form-label">Description(three)</label>
                                    <textarea name="description_three" id="description_three" class="form-control" cols="30" rows="5">
                                    </textarea>
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Save Page</button>
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
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Update Page</h5>
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
  {{-- <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}



  <script type="text/javascript">

    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',

        }
    });


   $(function childcategory(){
    $.noConflict();
    var table=$('.ytable').DataTable({
        processing:true,
        serverSide:true,
        ajax: "{{route('page.index')}}",
        columns:[
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data:'page_name', name:'page_name'},
            {data:'page_title', name:'page_title'},
            {data:'heading_one',  name:'heading_one'},
            {data:'description_one',  name:'description_one'},
            {data:'heading_two',  name:'heading_two'},
            {data:'description_two',  name:'description_two'},
            {data:'heading_three',  name:'heading_three'},
            {data:'description_three', name:'description_three'},
            {data:'action', name:'action', orderable:true, searchable:true},

        ]
    });

   });

   $('body').on('click','.edit',function(){
      let id=$(this).data('id');
      $.get('page/edit/'+id, function(data){
        $('.modal_body').html(data);
      });

    })

</script>

@endsection
