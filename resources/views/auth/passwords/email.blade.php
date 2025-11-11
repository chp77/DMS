@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="padding: 120px;">
        <div class="col-md-8">
            <div class="card" style="padding: 50px 80px;">
                <div class="card-body" style="text-align: center;">
                    <img style="width: 110px; margin-bottom: 20px;" src="{{ asset('cms_logo.png') }}" alt="CMS" />
                    <label class="col-md-12" style="color: #1a2340; font-size: 18px; font-weight: 700;">{{ __('Reset Password') }}</label>
                    @if(isset($status))
                        <div class="alert alert-danger" role="alert">
                            {{ $status }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email Address') }}" />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
