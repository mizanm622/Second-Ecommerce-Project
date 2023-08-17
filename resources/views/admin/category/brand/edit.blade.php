
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" /> --}}

<form action="{{route('update.brand')}}" method="post" enctype="multipart/form-data" id="update-form">
    @csrf
    <div class="modal-body">
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Brand Name</label>
        <input type="text" value="{{$data->brand_name}}" name="brand_name" class="form-control" required>
        </div>
        <input type="hidden" value="{{$data->id}}" name="id">

    </div>
    <div class="row">
        <div class="col mb-3">
        <label for="nameBasic" class="form-label">Brand Logo</label>
        <input type="file" id="brand_logo" name="brand_logo"  class="form-control dropify"/>
        </div>
        <input type="hidden" value="{{$data->brand_logo}}" name="old_logo">
    </div>
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update Brand</button>
    </div>
</form>

{{-- <script src="{{asset('assets/vendor/js/dropify.min.js')}}"></script> --}}
<script type="text/javascript">
    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        }
    });

</script>

