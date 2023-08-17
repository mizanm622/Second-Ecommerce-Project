@extends('layouts.admin')

@section('admin-content')

<link rel="stylesheet" href="{{asset('assets/vendor/css/dropify.min.css')}}" class="template-customizer-core-css" />
 <!-- Basic Layout -->
 <div class="container">
 <div class="row">
    <div class="col-xl-8 col-sm-8 py-3 px-3">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Website Settings</h5>
          <small class="text-muted float-end">Update Web Settings</small>
        </div>
        <div class="card-body">
            <form action="{{route('website.update', $data->id)}}"  enctype="multipart/form-data" method="post">
                @csrf
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Currency</label>
                <select type="text" id="currency" name="currency" class="form-control" value="{{$data->currency}}">
                    <option value="৳" {{$data->currency== '৳' ? 'selected': ''}}> Taka</option>
                    <option value="$" {{$data->currency== '$' ? 'selected': ''}}> USD</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Phone(One)</label>
                <input type="phone" id="phone_one" name="phone_one" class="form-control" value="{{$data->phone_one}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Phone(Two)</label>
                <input type="phone" id="phone_two" name="phone_two" class="form-control" value="{{$data->phone_two}}"/>

            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Main Email</label>
                <input type="email" id="main_email" name="main_email" class="form-control" value="{{$data->main_email}}" />
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Support Email</label>
                <input type="email" id="support_email" name="support_email" class="form-control" value="{{$data->support_email}}"/>

            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control" value="{{$data->address}}"/>
            </div>

            <strong class="strong">Social Area *</strong>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Facebook</label>
                <input type="text" id="facebook" name="facebook" class="form-control" value="{{$data->facebook}}"/>
            </div>
            <div class="form-group mb-3">
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">Youtube</label>
                <input type="text" id="youtube" name="youtube" class="form-control" value="{{$data->youtube}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Instagram</label>
                <input type="text" id="instagram" name="instagram" class="form-control" value="{{$data->instagram}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Linkedin</label>
                <input type="text" id="linkedin" name="linkedin" class="form-control" value="{{$data->linkedin}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Twitter</label>
                <input type="text" id="twitter" name="twitter" class="form-control" value="{{$data->twitter}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Logo</label>
                <input type="file" id="logo" name="logo" class="form-control dropify" />
                <div class="row">
                    <div class="col-3">
                        <img src="{{asset($data->logo)}}" height="50px" alt="Logo ">
                    </div>
                </div>
                <input type="hidden" name="old_logo" value="{{$data->logo}}">
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Favicon</label>
                <input type="file" id="favicon" name="favicon" class="form-control dropify"/>
                <div class="row">
                    <div class="col-3">
                        <img src="{{asset($data->favicon)}}" height="50px" alt="Logo ">
                    </div>
                </div>
                <input type="hidden" name="old_favicon" value="{{$data->favicon}}">
            </div>

            <button type="submit" class="btn btn-primary text-center m-auto">Update</button>
          </form>
        </div>
      </div>
    </div>
 </div>
</div>
  <!-- Category Insert Modal area--->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
  </script>

@endsection
