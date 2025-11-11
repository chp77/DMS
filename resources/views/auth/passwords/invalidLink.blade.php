@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="padding: 120px;">
        <div class="col-md-8">
            <div class="card" style="padding: 50px 80px;">
                <div class="card-body" style="text-align: center;">
                    <img style="width: 110px; margin-bottom: 20px;" src="{{ asset('cms_logo.png') }}" alt="CMS" />
                    <label class="col-md-12" style="color: #1a2340; font-size: 18px; font-weight: 700;">Sorry!</label>
                    <p>The password reset link was expired</p>

                    <a href="http://cms.infinitypro.asia/forgot-password" class="v-button v-size-width v-font-size" style="margin-top: 30px; box-sizing: border-box;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #3156dd; border-radius: 4px;-webkit-border-radius: 4px; -moz-border-radius: 4px; width:250px; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;font-size: 14px;">
                        <span style="display:block;padding:10px 20px;line-height:120%;"><span style="line-height: 16.8px;">Resend a link</span></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
