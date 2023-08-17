

<form action="{{route('coupon.update')}}" method="post"  id="update-form">
    @csrf
    <div class="modal-body">
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Coupon Typt/Name</label>
        <select type="text" id="coupon_type" name="coupon_type" class="form-control" placeholder="Coupon Type" required >
            <option value="1" @if ($data->coupon_type==1) selected="" @endif>Fixed</option>
            <option value="2" @if ($data->coupon_type==2) selected="" @endif>Percentage</option>
        </select>
        </div>
        <input type="hidden" value="{{$data->id }}" name="id">

    </div>
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Coupon Code</label>
        <input type="text" id="coupon_code" name="coupon_code" value="{{$data->coupon_code}}" class="form-control dropify"/>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Coupon Amount</label>
        <input type="text" id="coupon_amount" name="coupon_amount" value="{{$data->coupon_amount}}" class="form-control dropify"/>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Date Validation</label>
        <input type="text" id="valid_date" name="valid_date" value="{{$data->valid_date}}" class="form-control dropify"/>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Status</label>
        <input type="text" id="status" name="status" value="{{$data->status}}" class="form-control"/>
        </div>
    </div>



    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update Coupon</button>
    </div>
</form>

<!-- include summernote css/js -->


