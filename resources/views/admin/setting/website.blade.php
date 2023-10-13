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
            <div class="row">
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Website Name<span class="text-danger fw-bold">*</span></label>
                    <input type="text" id="website_name" name="website_name" class="form-control" value="{{$data->website_name}}"/>
                </div>
                <div class="form-group mb-3 col-4">
                    <label for="nameBasic" class="form-label">Currency Name<span class="text-danger fw-bold">*</span></label>
                    <select type="text" id="currency" name="currency_name" class="form-control" value="{{$data->currency_name}}">
                        <option value="BDT" {{$data->currency== '৳' ? 'selected': ''}}> BDT</option>
                        <option value="USD" {{$data->currency== '$' ? 'selected': ''}}> USD</option>
                    </select>
                </div>
                <div class="form-group mb-3 col-2">
                    <label for="nameBasic" class="form-label">Currency<span class="text-danger fw-bold">*</span></label>
                    <select type="text" id="currency" name="currency" class="form-control" value="{{$data->currency}}">
                        <option value="৳" {{$data->currency== '৳' ? 'selected': ''}}> ৳</option>
                        <option value="$" {{$data->currency== '$' ? 'selected': ''}}> $</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Phone(One)<span class="text-danger fw-bold">*</span></label>
                    <input type="phone" id="phone_one" name="phone_one" class="form-control" value="{{$data->phone_one}}"/>
                </div>
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Phone(Two)</label>
                    <input type="phone" id="phone_two" name="phone_two" class="form-control" value="{{$data->phone_two}}"/>

                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Main Email<span class="text-danger fw-bold">*</span></label>
                    <input type="email" id="main_email" name="main_email" class="form-control" value="{{$data->main_email}}" />
                </div>
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Support Email</label>
                    <input type="email" id="support_email" name="support_email" class="form-control" value="{{$data->support_email}}"/>

                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Village/Area<span class="text-danger fw-bold">*</span></label>
                    <input type="text" id="address" name="address" class="form-control" value="{{$data->address}}"/>
                </div>
                <div class="form-group mb-3 col-3">
                    <label for="nameBasic" class="form-label">Town<span class="text-danger fw-bold">*</span></label>
                    <input type="text" id="town" name="town" class="form-control" value="{{$data->town}}"/>
                </div>
                <div class="form-group mb-3 col-3">
                    <label for="nameBasic" class="form-label">City<span class="text-danger fw-bold">*</span></label>
                    <input type="text" id="city" name="city" class="form-control" value="{{$data->city}}"/>
                </div>
            </div>
            <div class="row">
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Country<span class="text-danger fw-bold">*</span></label>
                    <input type="text" id="country" name="country" class="form-control" value="{{$data->country}}"/>
                </div>
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Zip Code<span class="text-danger fw-bold">*</span></label>
                    <input type="text" id="zip" name="zip" class="form-control" value="{{$data->zip}}"/>
                </div>
            </div>

            <strong class="strong">Social Area <span class="text-danger fw-bold">*</span></strong>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Facebook</label>
                <input type="text" id="facebook" name="facebook" class="form-control" value="{{$data->facebook}}"/>
            </div>
            <div class="form-group mb-3">
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
            <div class="row">
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Logo<span class="text-danger fw-bold">*</span></label>
                    <input type="file" id="logo" name="logo" class="form-control dropify" />
                    <div class="row">
                        <div class="col-3">
                            <img src="{{asset($data->logo)}}" height="50px" alt="Logo ">
                        </div>
                    </div>
                    <input type="hidden" name="old_logo" value="{{$data->logo}}">
                </div>
                <div class="form-group mb-3 col-6">
                    <label for="nameBasic" class="form-label">Favicon<span class="text-danger fw-bold">*</span></label>
                    <input type="file" id="favicon" name="favicon" class="form-control dropify"/>
                    <div class="row">
                        <div class="col-3">
                            <img src="{{asset($data->favicon)}}" height="50px" alt="Logo ">
                        </div>
                    </div>
                    <input type="hidden" name="old_favicon" value="{{$data->favicon}}">
                </div>
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
