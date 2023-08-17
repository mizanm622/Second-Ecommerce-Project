<form action="{{route('update.childcategory')}}" method="post" id="add-form">
    @csrf
    <div class="modal-body">
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Category Name</label>
        <select class="form-control" name="subcategory_id" id="subcategory_id" required>

            @foreach ($categories as $category)
            @php
                $sub_cat=App\Models\Subcategory::where('category_id',$category->id)->get();
            @endphp
            <option disabled>{{$category->category_name}}</option>

            @foreach ($sub_cat as $row)
            <option value="{{$row->id}}" @if($row->id==$data->subcategory_id) selected="" @endif>=>{{$row->subcategory_name}}</option>
            @endforeach

            @endforeach
        </select>
         <input type="hidden" value="{{$data->id}}" name="id">
        </div>

    </div>
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Child Category Name</label>
        <input type="text" id="childcategory_name" name="childcategory_name" value="{{$data->childcategory_name}}" class="form-control" required/>
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
