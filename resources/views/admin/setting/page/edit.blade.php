
<link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" />

<form action="{{route('page.update')}}" method="post"  id="update-form" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">

        <div class="row">
            <div class="col-6 mb-3">
                <label for="nameBasic" class="form-label">Page Name</label>
                <input type="text" id="page_name" name="page_name" class="form-control" value="{{$data->page_name}}"placeholder="Enter Page Name" required/>
            </div>

            <div class="col-6 mb-3">
                <label for="nameBasic" class="form-label">Title Name</label>
                <input type="text" id="page_title" name="page_title" class="form-control" value="{{$data->page_title}}"placeholder="Enter Page Title" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-4 mb-3">
                <label for="nameBasic" class="form-label">Heading(One)</label>
                <input type="text" id="header_one" name="header_one" class="form-control" value="{{$data->heading_one}}"placeholder="Enter Page Heading" required/>
            </div>

            <div class="col-4 mb-3">
                <label for="nameBasic" class="form-label">Heading(two)</label>
                <input type="text" id="header_two" name="header_two" class="form-control" value="{{$data->heading_two}}"placeholder="Enter Page Heading" required/>
            </div>

            <div class="col-4 mb-3">
                <label for="nameBasic" class="form-label">Heading(three)</label>
                <input type="text" id="header_three" name="header_three" class="form-control" value="{{$data->heading_three}}"placeholder="Enter Page Heading" required/>
            </div>
        </div>

        <div class="row">
            <div class="col-4 mb-3">
                <label for="nameBasic" class="form-label">Image(One)</label>
                <input type="file" id="image_one" name="image_one" class="form-control dropify" value=""/>
                <input type="hidden" name="img_one_old" value="{{$data->image_one}}">
            </div>

            <div class="col-4 mb-3">
                <label for="nameBasic" class="form-label">Image(two)</label>
                <input type="file" id="image_two" name="image_two" class="form-control dropify" value=""/>
                <input type="hidden" name="img_two_old" value="{{$data->image_two}}">
            </div>

            <div class="col-4 mb-3">
                <label for="nameBasic" class="form-label">Image(three)</label>
                <input type="file" id="image_three" name="image_three" class="form-control dropify" value=""/>
                <input type="hidden" name="img_three_old" value="{{$data->image_three}}">
            </div>
        </div>

        <div class="row">
            <div class="col- mb-3">
                <label for="nameBasic" class="form-label">Description(One)</label>
                <textarea name="description_one" id="description_one" class="form-control" value="{{$data->description_one}}"cols="30" rows="5">
                </textarea>
            </div>
        </div>
        <div class="row">
            <div class="col- mb-3">
                <label for="nameBasic" class="form-label">Description(two)</label>
                <textarea name="description_two" id="description_two" class="form-control" value="{{$data->description_two}}"cols="30" rows="5">
                </textarea>
            </div>
        </div>
        <div class="row">
            <div class="col- mb-3">
                <label for="nameBasic" class="form-label">Description(three)</label>
                <textarea name="description_three" id="description_three" class="form-control" value="{{$data->description_three}}"cols="30" rows="5">
                </textarea>
            </div>
        </div>
        </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">Update </button>
    </div>
</form>

<script src="{{asset('assets/vendor/js/dropify.min.js')}}"></script>
{{-- <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}



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
<!-- include summernote css/js -->


