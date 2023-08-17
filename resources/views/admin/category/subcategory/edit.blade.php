<form action="{{route('update.subcategory')}}" method="post">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col mb-3">
            <label for="nameBasic" class="form-label">Category Name</label>
            <select class="form-control" name="category_id" id="category_id" required>

                @foreach ($categories as $value)
                <option value="{{$value->id}}" @if ($value->id==$data->category_id) selected=""

                @endif>{{$value->category_name}}</option>
                @endforeach
            </select>
            <input type="hidden"  name="id"  value="{{$data->id}}" class="form-control"  />
            </div>
        </div>
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Sub Category Name</label>
        <input type="text"  name="subcategory_name" value="{{$data->subcategory_name}}"class="form-control"  />

        </div>
    </div>

    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update Subcategory</button>
    </div>
</form>
