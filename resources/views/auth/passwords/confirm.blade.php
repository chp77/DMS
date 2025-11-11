@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="padding: 120px;">
        <div class="col-md-8">
            <div class="card" style="padding: 50px 80px;">

                <div class="card-body" style="text-align: center;">
                    <img style="width: 110px; margin-bottom: 20px;" src="{{ asset('cms_logo.png') }}" alt="CMS" />
                    <label class="col-md-12" style="color: #1a2340; font-size: 18px; font-weight: 700;">Reset new password</label>

                    <form method="POST" action="{{ route('password.confirmReset') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="New Password" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm Password" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
