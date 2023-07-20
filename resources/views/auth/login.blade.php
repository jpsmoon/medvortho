@extends('layouts.login-app')

@section('content')
<!-- START: Main Content-->
<div class="container login__layout">
    <div class="row vh-100 justify-content-between align-items-center">
        <div class="col-12 col-md-12  justify-content-center">
            <div  style="display: flex; align-items: center; justify-content:center; text-align:center; margin-bottom:20px;">
                <a href="https://medvortho.com/" title="https://medvortho.com"><img src="https://medvortho.com/new_assets/app-assets/images/logo.png" width="250px" alt="logo"></a>
                
                <!--<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 310 72" class="v3-logo">-->
                <!--    <circle cx="36" cy="36" r="36" fill="red"></circle>-->
                <!--    <path fill="url(#a)" d="M43.2 57.7c0 4-3.2 7.1-7.2 7.1s-7.2-3.2-7.2-7.1V53l14.4-14.4v19Z"></path>-->
                <!--    <path fill="url(#b)" d="M14.3 43.2c-4 0-7.1-3.2-7.1-7.2s3.2-7.2 7.1-7.2H19l14.4 14.4h-19Z"></path>-->
                <!--    <path fill="url(#c)" d="M57.7 28.8c4 0 7.1 3.2 7.1 7.2s-3.2 7.2-7.1 7.2H53L38.6 28.8h19Z"></path>-->
                <!--    <path fill="url(#d)" d="M15.6 25.8a7.2 7.2 0 0 1 0-10.2 7.2 7.2 0 0 1 10.2 0l3.2 3.3v20.4L15.7 25.8Z"></path>-->
                <!--    <path fill="url(#e)" d="M56.4 46.2a7.2 7.2 0 0 1 0 10.2 7.2 7.2 0 0 1-10.2 0L43 53.1V32.7l13.4 13.5Z"></path>-->
                <!--    <path fill="url(#f)" d="M25.8 56.4a7.2 7.2 0 0 1-10.2 0 7.2 7.2 0 0 1 0-10.2l3.3-3.2h20.4L25.8 56.3Z"></path>-->
                <!--    <path fill="url(#g)" d="M46.2 15.6a7.2 7.2 0 0 1 10.2 0 7.2 7.2 0 0 1 0 10.2L53.1 29H32.7l13.5-13.4Z"></path>-->
                <!--    <path fill="url(#h)" d="M28.8 14.3c0-4 3.2-7.1 7.2-7.1s7.2 3.2 7.2 7.1V19L28.8 33.4v-19Z"></path>-->
                <!--    <circle cx="36" cy="36" r="7.7" fill="#fff"></circle>-->
                <!--    <circle cx="36" cy="36" r="7.2" fill="#FFDA00"></circle>-->
                <!--    <defs>-->
                <!--        <linearGradient id="a" x1="42.8" x2="31.5" y1="53.5" y2="48.9" gradientUnits="userSpaceOnUse">-->
                <!--        <stop offset=".2" stop-color="#fff"></stop>-->
                <!--        <stop offset=".8" stop-color="#fff" stop-opacity=".8"></stop>-->
                <!--        </linearGradient>-->
                <!--        <linearGradient id="b" x1="18.4" x2="23.1" y1="42.8" y2="31.5" gradientUnits="userSpaceOnUse">-->
                <!--        <stop offset=".2" stop-color="#fff"></stop>-->
                <!--        <stop offset=".8" stop-color="#fff" stop-opacity=".8"></stop>-->
                <!--        </linearGradient>-->
                <!--        <linearGradient id="c" x1="53.6" x2="48.9" y1="29.2" y2="40.5" gradientUnits="userSpaceOnUse">-->
                <!--        <stop offset=".2" stop-color="#fff"></stop>-->
                <!--        <stop offset=".8" stop-color="#fff" stop-opacity=".8"></stop>-->
                <!--        </linearGradient>-->
                <!--        <linearGradient id="d" x1="18.8" x2="30" y1="28.4" y2="23.7" gradientUnits="userSpaceOnUse">-->
                <!--        <stop offset=".2" stop-color="#fff"></stop>-->
                <!--        <stop offset=".8" stop-color="#fff" stop-opacity=".8"></stop>-->
                <!--        </linearGradient>-->
                <!--        <linearGradient id="e" x1="53.2" x2="42" y1="43.6" y2="48.3" gradientUnits="userSpaceOnUse">-->
                <!--        <stop offset=".2" stop-color="#fff"></stop>-->
                <!--        <stop offset=".8" stop-color="#fff" stop-opacity=".8"></stop>-->
                <!--        </linearGradient>-->
                <!--        <linearGradient id="f" x1="28.4" x2="23.7" y1="53.2" y2="42" gradientUnits="userSpaceOnUse">-->
                <!--        <stop offset=".2" stop-color="#fff"></stop>-->
                <!--        <stop offset=".8" stop-color="#fff" stop-opacity=".8"></stop>-->
                <!--        </linearGradient>-->
                <!--        <linearGradient id="g" x1="43.6" x2="48.3" y1="18.8" y2="30" gradientUnits="userSpaceOnUse">-->
                <!--        <stop offset=".2" stop-color="#fff"></stop>-->
                <!--        <stop offset=".8" stop-color="#fff" stop-opacity=".8"></stop>-->
                <!--        </linearGradient>-->
                <!--        <linearGradient id="h" x1="29.2" x2="40.5" y1="18.5" y2="23.1" gradientUnits="userSpaceOnUse">-->
                <!--        <stop offset=".2" stop-color="#fff"></stop>-->
                <!--        <stop offset=".8" stop-color="#fff" stop-opacity=".8"></stop>-->
                <!--        </linearGradient>-->
                <!--    </defs>-->
                <!--    <text x="70" y="65" font-size="30" font-weight="bold" fill="white">Meraki RCM</text>-->
                <!--</svg>-->
            </div>
            <div class="login-form login_form2 col-12  col-md-12">
                <div class="form-group mb-3 login-title">
                    <label for="title">Welcome</label>
                </div>
                <div class="col-12  col-md-12">
                    @if(count($errors) > 0)
                        @foreach( $errors->all() as $message )
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span>{{ $message }}</span>
                            </div>
                        @endforeach
                    @endif
                </div>
            <form method="POST" action="{{ route('login') }}" class="row row-eq-height mt-0 custom-login">
            @csrf
            <div class="col-12  col-md-12">
                <div class="form-group mb-3 btn-title">
                    <label for="emailAddress">Email <span class="required-class">*</span></label>
                    <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                    required autocomplete="email" autofocus id="emailAddress" type="email">
                    <!-- @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif -->
                </div>
                <div class="form-group mt-3 mb-3 btn-title">
                    <label for="password1">Password <span class="required-class">*</span></label>
                    <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password1" type="password">
                    <!-- @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror -->
                </div>

                <div class="form-group mb-0 login-action">
                    <button class="btn login-btn" type="submit"> {{ __('Sign In') }} </button>
                        <a href="{{ route('password.request') }}" class="login-btn1">{{ __('Forgot Your Password?') }}</a>
                </div>
            </div>
                {!! Form::close() !!}
                </div>
            <div class="mt-0 text-light col-12">Don't have an account? <a class="login-btn1" href="/register">Create an Account</a></div>
        </div>
    </div>
</div>
        <!-- END: Content-->
@endsection
