@extends('layouts.login-app')

@section('content')
<!-- START: Main Content-->
<div class="container login__layout">
    <div class="row vh-100 justify-content-between align-items-center">
        <div class="col-12 col-md-12  justify-content-center">
            <div  style="display: flex; align-items: center; justify-content:center; text-align:center; margin-bottom:20px;">
                <a href="https://medvortho.com/" title="https://medvortho.com">
                    <img src="{{ asset('public/new_assets/app-assets/images/logo.png') }}"  width="250px" alt="logo"></a>
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
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group mt-3 mb-3 btn-title">
                    <label for="password1">Password <span class="required-class">*</span></label>
                    <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="password1" type="password">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
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
