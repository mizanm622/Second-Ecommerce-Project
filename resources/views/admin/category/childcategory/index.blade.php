@extends('layouts.admin')

@section('admin-content')
<!-- Basic Bootstrap Table -->


    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">Child Category Table</h4>
         <div class="card">

                <h5 class="card-header " > <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertModal">+ Add New</button></h5>

            <div class="table-responsive text-nowrap table-border">
            <table class="table ytable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Subcategory Name</th>
                    <th>Childcategory Name</th>
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
              <h5 class="modal-title" id="exampleModalLabel1">Add Child Category</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <form action="{{route('store.childcategory')}}" method="post" id="add-form">
                @csrf
                <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Category/Subcategory Name</label>
                    <select class="form-control" name="subcategory_id" id="subcategory_id" required>

                        @foreach ($categories as $category)
                        @php
                            $sub_cat=App\Models\Subcategory::where('category_id',$category->id)->get();
                        @endphp
                        <option disabled>{{$category->category_name}}</option>

                        @foreach ($sub_cat as $row)
                        <option value="{{$row->id}}">=>{{$row->subcategory_name}}</option>
                        @endforeach

                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                    <label for="nameBasic" class="form-label">Child Category Name</label>
                    <input type="text" id="childcategory_name" name="childcategory_name" class="form-control" placeholder="Enter Sub Category Name" required/>
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save Childcategory</button>
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
              <h5 class="modal-title" id="exampleModalLabel1">Update Child Category</h5>
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
        ajax: "{{route('childcategory.index')}}",
        columns:[
            {data:'DT_RowIndex', name:'DT_RowIndex'},
            {data:'category_name', name:'category_name'},
            {data:'subcategory_name', name:'subcategory_name'},
            {data:'childcategory_name', name:'childcategory_name'},
            {data:'action', name:'action', orderable:true, searchable:true},

        ]
    });

   });

   $('body').on('click','.edit',function(){
      let id=$(this).data('id');
      $.get('childcategory/edit/'+id, function(data){
        $('.modal_body').html(data);
      });

    })


    </script>

@endsection
