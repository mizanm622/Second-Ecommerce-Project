@extends('layouts.admin')

@section('admin-content')
<!-- Basic Bootstrap Table -->
<!-- include libraries(jQuery, bootstrap) -->

    <div class="container-xxl flex-grow-1 container-p-y">
       <h4 class="fw-bold py-3 mb-4">Product Table</h4>
         <div class="card">

        <h5 class="card-header " > <a class="btn btn-primary" href="{{route('product.index')}}">+ Add New</a></h5>


        <div class="row">

            <div class="form-group col-3">
                <label class="form-label" for="basic-default-company">Category</label>
                <select class="form-control submitable" name="category_id" id="category_id" >
                    <option value="0">All</option>
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-3">
                <label class="form-label " for="basic-default-company">Subcategory</label>
                <select class="form-control submitable" name="subcategory_id" id="subcategory_id">
                    <option value="0">All</option>
                    @foreach ($subcategories as $category)
                    <option value="{{$category->id}}">{{$category->subcategory_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-3">
                <label class="form-label" for="basic-default-company">Brand</label>
                <select class="form-control submitable" name="brand_id" id="brand_id">
                    <option value="0">All</option>
                    @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->brand_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-3">
                <label class="form-label" for="basic-default-company">Warehouse</label>
                <select class="form-control submitable" name="warehouse_id" id="warehouse_id">
                    <option value="0">All</option>
                    @foreach ($warehouses as $warehouse)
                    <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}}</option>
                    @endforeach
                </select>
            </div>


        </div>


            <div class="table-responsive text-nowrap table-border">
            <table class="table ytable">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Cat.Name</th>
                    <th>Subcat.Name</th>
                    <th>Brand Name</th>
                    <th>Code</th>
                    <th>Featured</th>
                    <th>status</th>
                    <th>Thumb</th>
                    <th>Image</th>
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

   <!-- Category Update Modal area--->
   <div class="col-lg-4 col-md-6">
    <div class="mt-3">
      <!-- Button trigger modal -->
      <!-- Update Category Modal -->
      <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-center" id="exampleModalLabel1">Product Description</h5>
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

  <script>

$(document).on('click', '#search', function(e){
    e.preventDefault();
    let category_id = $('#category_id').val();
    let subcategory_id = $('#subcategory_id').val();


    $.ajax({
        url: "{{ url('/product/show') }}/",
        type: 'get',
        data: {
            category_id: category_id,
            subcategory_id: subcategory_id
        },
        success: function(data){
            $('.table').html(data);
        },

    });


   });

   $(document).on('click', '.edit', function(){
    // let url=`{{url('product/edit/#ID') }}`
    let id=$(this).data('id');
    //  url = url.replace("#ID", id)
      $.get('/product/view/'+id, function(data){
        $('.modal_body').html(data);
      });

    })

    // status change
    $(document).on('click', '.status', function() {

        let object = $(this)
        let id = $(this).data('id');
        let status = $(this).data('status');
        let url = "{{ url('/product/status') }}/"+id;

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

     // featured change
$(document).on('click', '.featured', function() {

let object = $(this)
let id = $(this).data('id');
let featured = $(this).data('featured');
let url = "{{ url('/product/featured') }}/"+id;

$.ajax({
    url:url,
    type:'get',
    data: {
        featured:featured,
    },
    success:function(data) {
        featured = featured == 1 ? 0 : 1;
        if(data.featured == 'success') {
            if(featured == 1) {
                toastr.success('Featured Successfully Enabled!');
                object.closest('td').html(`<a href="javascript:void(0)" class="status" data-id="${ id }" data-status="${ featured }">
                        <i class="bx bxs-bell bx-flip-horizontal text-success"></i>
                    </a>`);
            } else {
                toastr.success('Featured Successfully Dissabled!');
                object.closest('td').html(`<a href="javascript:void(0)" class="status" data-id="${ id }" data-status="${ featured }">
                        <i class="bx bxs-bell-off bx-flip-horizontal text-danger"></i>
                    </a>`);

            }
        }
    }
});
});

        // product delete
 $(document).on('click','#delete',function(){

    let id=$(this).data('id');
    var url= "{{ url('/product/delete') }}/"+id;
     $.ajax({
        url:url,
        type:'get',
        success:function(data) {
            toastr.success(data);
            //table.ajax.reload();
        }
     });

    })

 </script>

<script type="text/javascript">



        $(function products() {
            $.noConflict();
            table = $('.ytable').DataTable({
                processing:true,
                serverSide:true,
                searchable:true,
                ajax: {
                    url: "{{ route('product.show') }}",
                    data: function(e) {
                        e.category_id = $('#category_id').val();
                        e.subcategory_id = $('#subcategory_id').val();
                        e.brand_id = $('#brand_id').val();
                        e.warehouse_id = $('#warehouse_id').val()
                    }
                },
                columns: [
                    {data:'DT_RowIndex', name:'DT_RowIndex'},
                    {data:'name', name:'name'},
                    {data:'category_name', name:'category_name'},
                    {data:'subcategory_name', name:'subcategory_name'},
                    {data:'brand_name', name:'brand_name'},
                    {data:'code', name:'code'},
                    {data:'featured',  name:'featured'},
                    {data:'status',  name:'status'},
                    {data:'thumbnail',  name:'thumbnail'},
                    {data:'images',  name:'images', render: function(data, type, full, meta) {
                            return '<img src="'+ '/' + data + '" width="30" height="30" />'
                        }
                    },
                    {data:'action', name:'action', orderable:true, searchable:true},

                ]
            });


            $('.submitable').change(function() {
                table.draw();
            });
        })
</script>



@endsection
