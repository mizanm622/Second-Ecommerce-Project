@extends('layouts.admin')

@section('admin-content')
<!--dropify css cdn-->
<link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" />


<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Basic Layout -->
    <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card mb-4">
                    <div class="card-header text-center">
                        <h4 class="text-info">Update Product</h4>
                    </div>
            </div>
            <div class="col-xl-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row"><!--Start row-->
                            <div class="col-xl-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">Product Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$products->name}}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Code</label>
                                    <input type="text" class="form-control" name="code" value="{{$products->code}}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Category/Subcategory</label>
                                    <select class="form-control" name="subcategory_id" id="subcategory_id" required>
                                        @foreach ($categories as $category)
                                            @php
                                                $sub_cat=App\Models\Subcategory::where('category_id',$category->id)->get();
                                            @endphp
                                            <option disabled>{{$category->category_name}}</option>
                                        @foreach ($sub_cat as $row)
                                            <option value=" {{$row->id}}" @if($row->id==$products->subcategory_id) selected="" @endif>=>{{$row->subcategory_name}}</option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Child Category</label>
                                    <select type="text" class="form-control" name="childcategory_id" id="childcategory_id" placeholder="Product Child Category" required >
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Brand</label>
                                    <select type="text" class="form-control" name="brand_id" >
                                        @foreach ($brands as $row)
                                        <option value="{{$row->id}}" @if($row->id==$products->brand_id) selected="" @endif>{{$row->brand_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Warehouse</label>
                                    <select type="text" class="form-control" name="warehouse_id">
                                        @foreach ($warehouses as $row)
                                        <option value="{{$row->id}}" @if($row->id==$products->warehouse_id) selected="" @endif>{{$row->warehouse_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Pickup</label>
                                    <select type="text" class="form-control" name="pickup_id" >
                                        @foreach ($pickups as $row)
                                        <option value="{{$row->id}}" @if($row->id==$products->pickup_id) selected="" @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Unit</label>
                                    <input type="number"  min="1" class="form-control" name="unit" value="{{$products->unit}}" >
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Purchase Price</label>
                                <input type="text" class="form-control" name="purches_price" value="{{$products->purches_price}}" required>
                            </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Discount Price</label>
                                <input type="text" class="form-control" name="discount_price" value="{{$products->discount_price}}" required>
                            </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">Selling Price</label>
                                <input type="text" class="form-control" name="selling_price" value="{{$products->selling_price}}" required>
                            </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Stack</label>
                                    <input type="text" class="form-control" name="stack_quantity" value="{{$products->stack_quantity}}" required>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Color</label>
                                    <input type="text" class="form-control" name="color" value="{{$products->color}}" >
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Size</label>
                                    <input type="hidden" name="size" value="0">
                                    <input type="text" class="form-control" name="size" value="{{$products->size}}">
                                </div>
                            </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company">Tags</label>
                                    <input type="text" class="form-control" name="tags" value="{{$products->tags}}"  required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Description</label>
                                    <textarea type="text" name="description" class="form-control"  >{{$products->description}}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message">Vedio</label>
                                    <input type="text" name="video" class="form-control" value="{{$products->video}}" >
                                </div>
                            </div>  <!--End row-->
                        </div>
                    </div>
            </div>
            <div class="col-xl-4">
                <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Product Thumbnail</label>
                        <input type="file" class="form-control dropify" name="thumbnail" placeholder="Product Thumbnail">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{asset($products->thumbnail)}}" height="30px" alt="Logo ">
                            </div>
                        </div>
                        <input type="hidden" name="old_thumbnail" value="{{$products->thumbnail}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Product Image</label>
                        <input type="file" class="form-control dropify" name="image" placeholder="Product Image">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{asset($products->images)}}" height="30px" alt="Logo ">
                            </div>
                        </div>
                        <input type="hidden" name="old_image" value="{{$products->images}}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Featured </label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="featured" value="0">
                            <input class="form-check-input btn" type="checkbox" value="1" name="featured" role="switch" @if($products->featured == 1) checked @endif>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">New</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="is_new" value="0">
                            <input class="form-check-input btn" type="checkbox" value="1" name="is_new" role="switch" @if($products->is_new == 1) checked @endif>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Trending </label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="trending" value="0">
                            <input class="form-check-input btn" type="checkbox" value="1" name="trending" role="switch" @if($products->trending == 1) checked @endif>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Slider Show</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="product_slider" value="0">
                            <input class="form-check-input btn" type="checkbox" value="1" name="product_slider" role="switch"  @if($products->product_slider == 1) checked @endif>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Todays Deal </label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="todays_deal" value="0">
                                <input class="form-check-input btn" type="checkbox" value="1" name="todays_deal" role="switch" @if($products->todays_deal == 1) checked @endif>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Status</label>
                        <div class="form-check form-switch">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input btn" type="checkbox" name="status" value="1" role="switch" @if($products->status == 1) checked @endif>
                        </div>
                    </div>
                    <input type="hidden" name="id" value="{{$products->id}}">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.js"></script> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.1/js/jquery.dataTables.min.js"></script> --}}
<script src="{{asset('assets/vendor/js/dropify.min.js')}}"></script>


<script type="text/javascript">

$('.dropify').dropify({
  messages: {
      'default': 'Drag and drop '
  }
});

</script>
<script type="text/javascript">
 // get child category to select subcategory using ajax request

 $(document).on('change', '#subcategory_id' ,function(){
    var id=$(this).val();
    $.ajax({
        url: '/get-child-category/'+id,
        type: 'get',
        dataType: 'json',
        success:function(data){
           // alert(data.childcategory_name);
            $('select[name=childcategory_id]').empty();
            $.each(data, function(key, data){

                $('select[name=childcategory_id]').append('<option value="'+data.id+'">'+data.childcategory_name+'</option>');

            });
        }
    });
 });


</script>
  @endsection
