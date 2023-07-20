@extends('layouts.home-app')
<style type="text/css">
.card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
        </style>
@section('content')
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Accept Invitation</h4></div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    @if ($message = Session::get('flash_success_message'))
    <div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('flash_error_message'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

    <div class="row">
    
        <div class="col-9 mt-4">
            <div class="card row-background">
                <div class="card-content">
                    <div class="card-body">
                            {!! Form::model($inviteUser, ['id'=>'send_user_invite','url' => 'accept/invite/proccess',  'class' => 'form-horizontal ladda-form', 'method' => 'post','enctype'=>'multipart/form-data']) !!}
                            @csrf
                            <input type="hidden" name="inviteToken" id="inviteToken" value="{{$inviteUser->token}}">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Email:</strong>
                                        {!! Form::text('email',  null, array('placeholder' => 'Email','class' => 'form-control' , 'disabled' )) !!}
                                        @if ($errors->has('email'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>First Name:</strong>
                                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control' , 'data-validation-event' =>"change", "data-validation" =>"required, length",
                                            'data-validation-length' =>"2-100")) !!}
                                            @if ($errors->has('name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>Last Name:</strong>
                                            {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control' , 'data-validation-event' =>"change", "data-validation" =>"required, length", 'data-validation-length' =>"2-100")) !!}
                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Phone:</strong>
                                        {!! Form::text('phone_no', null, array('placeholder' => 'Phone No','class' => 'form-control', 'data-validation-event' =>"change", "data-validation" =>"required, number")) !!}
                                        @if ($errors->has('phone_no'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong>{{ $errors->first('phone_no') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    @php  $genders = array(array('id'=>1, 'name'=> 'Male'),array('id'=>2, 'name'=> 'Female'), array('id'=>3, 'name'=> 'Transgender'),);
                                    @endphp
                                    <div class="form-group">
                                        <strong>Gender:</strong>
                                        <select name="gender" id="gender" class="form-control" , data-validation-event="change" data-validation="required">
                                                @foreach ($genders as $gender)
                                                    <option value="{{$gender['id']}}"> {{$gender['name']}}</option>
                                                @endforeach
                                                </select>
                                        @if ($errors->has('phone_no'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong>{{ $errors->first('phone_no') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Password:</strong>
                                        {!! Form::password('password',  array('placeholder' => 'Password','class' => 'form-control' , 'data-validation-event' =>"change", 'data-validation' =>"custom", 'data-validation-regexp' =>"^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{6,})",
                                        "data-validation-optional" =>"true")) !!}
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Confirm Password:</strong>
                                        {!! Form::password('confirm_password', array('placeholder' => 'Confirm Password','class' => 'form-control' , 'data-validation-event' =>"change", 'data-validation' =>"custom", 'data-validation-regexp' =>"^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{6,})", "data-validation-optional" =>"true")) !!}
                                        @if ($errors->has('confirm_password'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong>{{ $errors->first('confirm_password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                    <button type="submit" class="btn btn-primary">I Accept</button>
                                </div>
                            </div>
                        {!! Form::close() !!} 
                    </div>
                </div>
            </div>
        </div>
            <div class="col-3 mt-4 rightside">
                <div class="row ">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header showButtonColor">
                                <h4 class="card-title showButtonColor">{{ ($inviteUser->getRoleInfo) ? $inviteUser->getRoleInfo->name : '' }}</h4>
                            </div> 
                        </div>
                        <div class="card">
                            <div class="card-header showButtonColor">
                                <h4 class="card-title showButtonColor">Billing Providers</h4>
                            </div>
                            <div class="card-body" style="padding:0px !important;">
                                <ul class="list-group list-group-flush">
                                    @if($providers)
                                    @foreach ($providers as $provider)
                                    <input type="hidden" name="inviteProviders[]" id="inviteProvidersId" value="{{$provider->id}}"> 
                                        <li class="list-group-item">
                                            {{ ($provider->professional_provider_name) ?  $provider->professional_provider_name : '' }}
                                        </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<link rel="stylesheet" type="text/css" href="{{ url('new_assets/app-assets/css/jquery.multiselect.css') }}">
<script src="{{ asset('new_assets/app-assets/js/jquery.multiselect.js') }}"></script>
<script>
var jax = $.noConflict();
jax(document).ready(function() { 
var arrayList = [];
    jax('#billingProvidersId').multiselect({
        columns: 4,
        selectAll : true,
        placeholder: 'Select Role',
        enableFiltering: true,
        search: true,
        selectAllValue: arrayList
    });
});
</script>
