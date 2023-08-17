

<form action="{{route('pickup.update')}}" method="post"  id="update-form">
    @csrf
    <div class="modal-body">

    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Pickup Name</label>
        <input type="text" id="name" name="name" value="{{$data->name}}" class="form-control"/>
        </div>
        <input type="hidden" value="{{$data->id }}" name="id">
    </div>

    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Pickup Address</label>
        <input type="text" id="address" name="address" value="{{$data->address}}" class="form-control dropify"/>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Phone Number</label>
        <input type="phone" id="phone_one" name="phone_one" value="{{$data->phone_one}}" class="form-control dropify"/>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Phone Number (Optional)</label>
        <input type="phone" id="phone_two" name="phone_two" value="{{$data->phone_two}}" class="form-control"/>
        </div>
    </div>



    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update Pickup</button>
    </div>
</form>

<!-- include summernote css/js -->


