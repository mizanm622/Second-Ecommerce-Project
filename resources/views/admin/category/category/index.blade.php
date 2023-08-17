@extends('layouts.admin')

@section('admin-content')
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
            <table class="table">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Category Slug</th>
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
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form action="{{route('store.category')}}" method="post">
                @csrf
                <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Category Name</label>
                    <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Enter Category Name" required/>
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
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form action="{{route('update.category')}}" method="post">
                @csrf
                <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Category Name</label>
                    <input type="text" id="e_category_name" name="category_name" class="form-control"  />
                    <input type="hidden" id="e_category_id" name="id" class="form-control"  />
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
           </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>



  <script type="text/javascript">
  $('body').on('click','.edit',function(){
    let cat_id=$(this).data('id');
    $.get('category/edit/'+cat_id, function(data){
        $('#e_category_name').val(data.category_name);
        $('#e_category_id').val(data.id);

    });

  })

  </script>
@endsection
