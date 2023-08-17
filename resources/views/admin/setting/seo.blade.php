@extends('layouts.admin')

@section('admin-content')


 <!-- Basic Layout -->
 <div class="container">
 <div class="row">
    <div class="col-xl-8 col-sm-8 py-3 px-3">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Update SEO</h5>
          <small class="text-muted float-end">Update SEO</small>
        </div>
        <div class="card-body">
            <form action="{{route('seo.update', $data->id)}}" method="post">
                @csrf
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{$data->meta_title}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Meta Author</label>
                <input type="text" id="meta_author" name="meta_author" class="form-control" value="{{$data->meta_author}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Meta Tag</label>
                <input type="text" id="meta_tag" name="meta_tag" class="form-control" value="{{$data->meta_tag}}"/>
                <small>Example: ecommerce, online Shop, Online Market</small>

            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Meta Description</label>
                <textarea type="text" id="meta_description" name="meta_description" class="form-control">{{$data->meta_description}}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Meta Keyword</label>
                <input type="text" id="meta_keyword" name="meta_keyword" class="form-control" value="{{$data->meta_keyword}}"/>
                <small>Example: ecommerce, online Shop, Online Market</small>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Google Verification</label>
                <input type="text" id="google_verification" name="google_verification" class="form-control" value="{{$data->google_verification}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Alexa Verification</label>
                <input type="text" id="alexa_verification" name="alexa_verification" class="form-control" value="{{$data->alexa_verification}}"/>
            </div>
            <div class="form-group mb-3">
                <div class="col mb-3">
                <label for="nameBasic" class="form-label">Google Analytics</label>
                <input type="text" id="google_analytics" name="google_analytics" class="form-control" value="{{$data->google_analytics}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Google Adsencs</label>
                <input type="text" id="google_adsence" name="google_adsence" class="form-control" value="{{$data->google_adsence}}"/>
            </div>
            <div class="mb-3">

            </div>
            <button type="submit" class="btn btn-primary text-center m-auto">Update</button>
          </form>
        </div>
      </div>
    </div>
 </div>
</div>
  <!-- Category Insert Modal area--->



@endsection
