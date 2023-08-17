@extends('layouts.admin')

@section('admin-content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Forgot Password -->
        <div class="card">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
              <a href="index.html" class="app-brand-link gap-2">

                <span class="app-brand-text demo text-body fw-bolder">Sneat</span>
              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Change Password? 🔒</h4>

            <form id="formAuthentication" class="mb-3" action="{{route('admin.password.update')}}" method="POST">
                @csrf
              <div class="mb-3">
                <label for="password" class="form-label">Old Password</label>
                <input type="password"class="form-control"id="old_password"name="old_password"placeholder="Enter Old Password"autofocus
                />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password"class="form-control "  id="password" name="password"placeholder="Enter New Password"autofocus
                />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>



              <div class="mb-3">
                <label for="password" class="form-label">Confirm New Password</label>
                <input type="password"class="form-control"id="password_confirm"name="password_confirm"placeholder="Confirm Password"autofocus
                />

              </div>
              <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>

            </form>
            <div class="text-center">
              <a href="auth-login-basic.html" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
              </a>
            </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>
  </div>

@endsection
