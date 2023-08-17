


<form action="{{route('page.update')}}" method="post"  id="update-form">
    @csrf
    <div class="modal-body">
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Page Name</label>
        <input type="text" value="{{$data->page_name}}" name="page_name" class="form-control" required>
        </div>
        <input type="hidden" value="{{$data->id }}" name="id">

    </div>
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Page Title</label>
        <input type="text" id="brand_logo" name="page_title" value="{{$data->page_title}}" class="form-control dropify"/>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Page Position</label>
        <select class="form-control" name="page_position" id="page_position" required>
            <option value="1" @if ($data->page_position==1) selected=""

            @endif>First</option>
            <option value="2"@if ($data->page_position==2) selected=""

                @endif>Second</option>
            <option value="3" @if ($data->page_position==3) selected=""

                @endif>Third</option>
        </select>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Page Description</label>
        <textarea name="page_description" id="page_description"  class="form-control" cols="30" rows="5">
            {{$data->page_description}}
        </textarea>
        </div>
    </div>

    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update Brand</button>
    </div>
</form>

<!-- include summernote css/js -->


