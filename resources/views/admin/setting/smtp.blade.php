@extends('layouts.admin')

@section('admin-content')


 <!-- Basic Layout -->
 <div class="container">
 <div class="row">
    <div class="col-xl-8 col-sm-8 py-3 px-3">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Update SMTPS</h5>
          <small class="text-muted float-end">Update SMTP</small>
        </div>
        <div class="card-body my-3 mx-3">
            <form action="{{route('smtp.update', $data->id)}}" method="post">
                @csrf
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Mailer</label>
                <input type="text" id="mailer" name="mailer" class="form-control" value="{{$data->mailer}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Host </label>
                <input type="text" id="host" name="host" class="form-control" value="{{$data->host}}"/>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Port</label>
                <input type="text" id="port" name="port" class="form-control" value="{{$data->port}}"/>

            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">User Name</label>
                <textarea type="text" id="user_name" name="user_name" class="form-control">{{$data->user_name}}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="nameBasic" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" value="{{$data->password}}"/>

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
