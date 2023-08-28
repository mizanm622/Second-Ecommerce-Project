<form action="{{route('update.subcategory')}}" method="post" enctype="multipart/form-data" id="update-form">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-6 mb-3">
                <label for="nameBasic" class="form-label">Category Name</label>
                <select class="form-control" name="category_id" id="category_id" required>

                    @foreach ($categories as $value)
                    <option value="{{$value->id}}" @if ($value->id==$data->category_id) selected=""

                    @endif>{{$value->category_name}}</option>
                    @endforeach
                </select>
                <input type="hidden"  name="id"  value="{{$data->id}}" class="form-control"  />
            </div>

            <div class="col-6 mb-3">
            <label for="nameBasic" class="form-label">Sub Category Name</label>
            <input type="text"  name="subcategory_name" value="{{$data->subcategory_name}}"class="form-control"  />
            </div>
        </div>

        <div class="row">
            <div class="col-9 mb-3">
                <label for="nameBasic" class="form-label">Logo</label>
                <input type="file" id="subcategory_logo" name="subcategory_logo"  class="form-control dropify"/>
                <input type="hidden" value="{{$data->subcategory_logo}}" name="old_images">
                <img src="{{asset($data->subcategory_logo)}}" alt="" width="70" height="40">
            </div>

            <div class="col-3 mb-3">
                <label class="form-label" for="basic-icon-default-fullname">Status</label>
                <div class="form-check form-switch">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input btn" type="checkbox" value="1" name="status" role="switch" id="flexSwitchCheckChecked" @if($data->status == 1) checked @endif>
                </div>
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

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="{{asset('assets/vendor/js/dropify.min.js')}}"></script>
<script type="text/javascript">

    $('.dropify').dropify({
        messages: {
            'default': 'Drag and drop a file here or click',
            'replace': 'Drag and drop or click to replace',
            'remove':  'Remove',
            'error':   'Ooops, something wrong happended.'
        }
    });


    // update data with image using ajax
     $(document).ready(function(){
              $('#update-form').on('submit', function(event){
                    event.preventDefault();

                    var url = $(this).attr('action');

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(response)
                        {
                            toastr.success(response.message);
                            $('#update-form')[0].reset();
                            $(document).find('#updateModal .btn-close').trigger('click');
                            $('.table').load(location.href+' .table');

                        },
                        error: function(response) {
                            $('.error').remove();
                            $.each(response.responseJSON.errors, function(k, v) {
                                $('[name=\"images\"]').after('<p class="error">'+v[0]+'</p>');
                            });
                        }
                    });
                });

            });

</script>
