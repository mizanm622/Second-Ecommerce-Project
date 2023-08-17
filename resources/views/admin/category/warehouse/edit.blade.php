

<form action="{{route('warehouse.update')}}" method="post"  id="update-form">
    @csrf
    <div class="modal-body">
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Warehouse Name</label>
        <input type="text" value="{{$data->name}}" name="name" class="form-control" required>
        </div>
        <input type="hidden" value="{{$data->id }}" name="id">

    </div>
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Warehouse Address</label>
        <input type="text" id="address" name="address" value="{{$data->address}}" class="form-control dropify"/>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Warehouse Phone</label>
        <input type="text" id="phone" name="phone" value="{{$data->phone}}" class="form-control"/>
        </div>
    </div>



    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update Warehouse</button>
    </div>
</form>

<!-- include summernote css/js -->


