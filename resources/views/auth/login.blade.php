@extends('layouts.app')

@section('content')
<div class="container-fluid h-custom" style="top: 15%; position: absolute;">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <!-- <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div> -->
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST" action="{{ route('postlogin') }}">
            @csrf
            <div style="justify-content: center; display: flex; margin-bottom : 10px;">
                <img style="width: 110px; float: center;" src="{{ asset('inventory.png') }}" alt="AMS" />
            </div>
            <div style="justify-content: center; display: flex; font-size: 24px; margin-bottom: 10px;">
                <b>Asset Management System</b>
            </div>
            <p class="lead fw-normal mb-0 me-3"></p>

            @error('email')
                <span class="text-danger" style="justify-content: center; display: flex;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label">Email address</label>
            <input id="email" type="email" class="form-control form-control-lg" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label">Password</label>
            <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password">
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember" style="font-size: 14px;">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <!-- <a href="{{ route('password.request') }}" class="text-body">Forgot password?</a> -->
          </div>
          
          <!-- T&C -->
          <!-- <div class="form-outline mt-2">
            <label class="form-check-label" for="tnc" style="font-size: 14px;">
              By signing in, I agree to the CMS's Privacy Statement and Terms of Service.
            </label>
          </div> -->

          <div class="text-center text-lg-start mt-1 pt-2">
              <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">
                {{ __('Login') }}
              </button>
              <!-- @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
              @endif -->
              <!-- <a class="btn btn-secondary" href="{{ route('register') }}">{{ __('Register') }}</a> -->
            <!-- <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
                class="link-danger">Register</a></p> -->
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection