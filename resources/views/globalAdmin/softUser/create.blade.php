@extends('layouts.home-new-app')


@section('content')
<div class="row">
    <div class="col-md-9">
        <h2> Create New User </h2>
    </div>
    <div class="col-md-3" style="text-align:right;">
        <a class="btn btn-primary"  href="{{ url('/show/all/soft/user') }}"> Back</a>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif



<form action="{{ url('/global/save/soft/user') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form" method="POST">
  @csrf
  <input type="hidden" name="userId" id="userId" value="{{ ($user) ? $user->id : '' }}">
<div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>First Name:</strong>
                <input type="text" data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="fName" class="form-control" name="fName" value="{{ ($user) ? $user->name : '' }}">
                @if ($errors->has('fName'))
                    <span class="invalid-feedback" style="display:block" role="alert">
                        <strong class="invalid-feedback">{{ $errors->first('fName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Last Name:</strong>
                <input type="text" data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="lName" class="form-control" name="lName" value="{{ ($user) ? $user->last_name : '' }}">
                @if ($errors->has('lName'))
                    <span class="invalid-feedback" style="display:block" role="alert">
                        <strong class="invalid-feedback">{{ $errors->first('lName') }}</strong>
                    </span>
                @endif
            </div>
        </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Email:</strong>
            <input type="text" data-validation-event="change" data-validation="required, email"  data-validation-error-msg="" id="email" class="form-control" name="email" {{ ($user && $user->email) ? 'disabled' : '' }} value="{{ ($user && $user->email) ? $user->email : '' }}">
            @if ($errors->has('email'))
                <span class="invalid-feedback" style="display:block" role="alert">
                    <strong class="invalid-feedback">{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Phone Number:</strong>
            <input type="text" data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="phone_no" class="form-control" name="phone_no" value="{{ ($user && $user->phone_no) ? $user->phone_no : '' }}">
            @if ($errors->has('phone_no'))
                <span class="invalid-feedback" style="display:block" role="alert">
                    <strong class="invalid-feedback">{{ $errors->first('phone_no') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Role:</strong>
            <select name="roles" id="roles" class="form-control"  data-validation-event="change" data-validation="required"  data-validation-error-msg="">
                <option value="" class="option">Select</option>
                @foreach ($roles as $role)
                <option value="{{$role->id}}" {{($userRole && $userRole->role_id == $role->id) ? 'selected' : ''}}> {{$role->name }} </option>
                @endforeach
            </select> 
        </div>
    </div> 
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Gender:</strong>
            <select name="gender" id="gender" class="form-control"  data-validation-event="change" data-validation="required"  data-validation-error-msg="">
                 <option value="" class="option">Select</option>
                <option value="Male" {{($user && $user->gender &&  $user->gender == 'Male') ? 'selected' : ''}}> Male</option>
                <option value="Female" {{($user && $user->gender && $user->gender == 'Female') ? 'selected' : ''}}> Female</option> 
            </select> 
        </div>
    </div> 
</div>  
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Password:</strong>
             <input type="password" data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="password" class="form-control" name="password" value="{{ ($user && $user->original_pass) ? $user->original_pass : '' }}">
            @if ($errors->has('password'))
                <span class="invalid-feedback" style="display:block" role="alert">
                    <strong class="invalid-feedback">{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Confirm Password:</strong>
             <input type="password" data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="confirm-password" class="form-control" name="confirm-password" value="">
            @if ($errors->has('confirm-password'))
                <span class="invalid-feedback" style="display:block" role="alert">
                    <strong class="invalid-feedback">{{ $errors->first('confirm-password') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Profile Image:</strong>
            {!! Form::file('profile_image',  array('placeholder' => 'Profile Image','class' => 'form-control fileControl' , 'data-validation-event' =>"change",  "data-validation" => "mime size",
                'data-validation-allowing' =>"jpg, jpeg, png", "data-validation-max-size" => "2M")) !!}
            @if ($errors->has('profile_image'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('profile_image') }}</strong>
            </span>
        @endif
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Zip Code:</strong>
            <input type="text"  onKeyUp="getStatesByZipCode(this.value ,'city_id', 'state_id');"  data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="zipe_code_id" class="form-control" name="zipe_code_id" value="">
            @if ($errors->has('zipe_code_id'))
                <span class="invalid-feedback" style="display:block" role="alert">
                    <strong class="invalid-feedback">{{ $errors->first('zipe_code_id') }}</strong>
                </span> 
            @endif
        </div>
    </div> 
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>Address 1:</strong>
            <input type="text"  data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="address1" class="form-control" name="address1" value="">
            @if ($errors->has('address1'))
                <span class="invalid-feedback" style="display:block" role="alert">
                    <strong class="invalid-feedback">{{ $errors->first('address1') }}</strong>
                </span> 
            @endif
        </div>
    </div> 
    <div class="col-xs-6 col-sm-6 col-md-6">
         <div class="form-group">
            <strong>Address 2:</strong>
            <input type="text"  data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="address2" class="form-control" name="address2" value="">
            @if ($errors->has('address2'))
                <span class="invalid-feedback" style="display:block" role="alert">
                    <strong class="invalid-feedback">{{ $errors->first('address2') }}</strong>
                </span> 
            @endif
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>State:</strong>
            <select data-validation-event="change" data-validation="required" data-validation-error-msg="" name="state_id" id="state_id" class="form-control">
                <option value="" class="option">Select</option>
                @foreach ($states as $state)
                    <option value="{{$state["state_name"]}}" {{($state["state_name"] == 'California') ? 'selected' : ''}}> {{$state["state_name"]}}</option>
                @endforeach
            </select>
            @if ($errors->has('state_id'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('state_id') }}</strong>
            </span>
        @endif
        </div>
    </div> 
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <strong>City:</strong>
            <input type="text" data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="city_id" class="form-control" name="city_id" value="">
            @if ($errors->has('city_id'))
                <span class="invalid-feedback" style="display:block" role="alert">
                    <strong class="invalid-feedback">{{ $errors->first('city_id') }}</strong>
                </span> 
            @endif
        </div>
    </div>
    
</div>
<div class="row"> 
    <div class="col-xs-12 col-sm-12 col-md-12 text-left"> 
        <button type="submit" class="btn btn-primary ladda-button mx-2 mt-1"><span class="ladda-label">{{ trans('billLabel.save') }}</span></button>
    </div>
</div>
{!! Form::close() !!}  
@endsection 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script> 
<script src="{{ asset('/js/controller/master_for_all.js') }}"></script>
