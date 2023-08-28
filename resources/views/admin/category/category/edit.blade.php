<link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" />

<form action="{{route('update.category')}}" method="post" enctype="multipart/form-data" id="update-form">
    @csrf
    <div class="modal-body modal_body">
    <div class="row">
        <div class="col-9 mb-3">
        <label for="nameBasic" class="form-label">Category Name</label>
        <input type="text" id="category_name" name="category_name"  value="{{$data->category_name}}" class="form-control" />
        <input type="hidden" id="id" name="id" value="{{$data->id}}" class="form-control"  />
        </div>

        <div class="col-3 mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Status</label>
            <div class="form-check form-switch">
                <input type="hidden" name="status" id="status" value="0">
                <input class="form-check-input btn" type="checkbox" value="1" id="status" name="status" role="switch" id="flexSwitchCheckChecked" @if($data->status == 1) checked @endif>
            </div>
        </div>
    </div>

    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update Category</button>
    </div>
</form>


<script src="{{asset('assets/vendor/js/dropify.min.js')}}"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>


<script type="text/javascript">

$('.dropify').dropify({
  messages: {
      'default': 'Drag and drop a file here or click',
      'replace': 'Drag and drop or click to replace',
      'remove':  'Remove',
      'error':   'Ooops, something wrong happended.'
  }
});



 // insert data with image using ajax
 $('#update-form').submit(function(e) {
    e.preventDefault();
    var url = $(this).attr('action');
    var request = $(this).serialize();
    $.ajax({
        url: url,
        type: 'post',
        anyne: false,
        data: request,
        success:function(data) {
            toastr.success(data);
             $('#update-form')[0].reset();
             $(document).find('#updatetModal .btn-close').trigger('click');
             $('.c-table').load(location.href+' .c-table');
        }
    });
    });

</script>
