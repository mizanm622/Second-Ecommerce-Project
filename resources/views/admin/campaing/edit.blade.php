
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" /> --}}

<form action="{{route('update.campaing')}}" method="post" enctype="multipart/form-data" id="update-form">
    @csrf
    <div class="modal-body">
    <div class="row">
        <div class="col-6 mb-3">
        <label for="nameBasic" class="form-label">Title</label>
        <input type="text" value="{{$data->campaing_title}}" name="campaing_title" class="form-control" required>
        </div>
        <input type="hidden" value="{{$data->id}}" name="id">

        <div class="col-3 mb-3">
            <label for="nameBasic" class="form-label">Discount</label>
            <input type="text" value="{{$data->discount}}" name="discount" class="form-control" required>
            </div>

        <div class="col-3 mb-3">
            <label class="form-label" for="basic-icon-default-fullname">Status</label>
            <div class="form-check form-switch">
                <input type="hidden" name="status" value="0">
                <input class="form-check-input btn" type="checkbox" value="1" name="status" role="switch" id="flexSwitchCheckChecked" @if($data->status == 1) checked @endif>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-6">
        <label for="nameBasic" class="form-label">Start Date</label>
        <input type="date" value="{{$data->start_date}}" name="start_date" class="form-control" required>
        </div>


        <div class="col-6 mb-3">
        <label for="nameBasic" class="form-label">End Date</label>
        <input type="date" value="{{$data->end_date}}" name="end_date" class="form-control" required>
        </div>

    </div>
    <div class="row">
        <div class="col-6 ">
            <label for="nameBasic" class="form-label">Description</label>
            <textarea type="text" name="campaing_description" class="form-control" cols="10" rows="5" required>{{$data->campaing_description}}</textarea>
            </div>

        <div class="col-6 mb-3">
            <label for="nameBasic" class="form-label">Logo</label>
            <input type="file" id="images" name="images"  class="form-control dropify"/>
            <input type="hidden" value="{{$data->images}}" name="old_images">
            <img src="{{asset($data->images)}}" alt="" width="70" height="40">
        </div>

    </div>

    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update Campaing</button>
    </div>
</form>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

// Update data with image using ajax
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
                            $('.ytable').load(location.href+' .ytable');
                            $('.ytable').DataTable().ajax.reload();

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

