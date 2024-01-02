@extends('layouts.home-new-app')
@section('content')

<!-- START: Breadcrumbs-->
    <div class="row mt-0">
         <div class="col-12  align-self-center">
            <div class="sub-header mt-0 py-3 px-2 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto margin07">
                   <h2 class="heading"><i class="fa-solid fa-file-pen"></i> Edit Profile</h2>
                </div>
                <div align="right" class="w-sm-100 ">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                     <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
                    </li>
                </ol>
                </div>
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
        <div class="col-9">
            <div class="card row-background customBoxHeight p-1">
                <div class="card-content">
                    <div class="card-body2">
                         @if($user) 
                        {!! Form::model($user, ['id'=>'update_profile','url' =>['updateUserProfile', $user->id]  ,  'class' => 'form-horizontal ladda-form', 'method' => 'post','enctype'=>'multipart/form-data']) !!}
                        
                        @csrf
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Name:</strong>
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
                                            <strong>Email:</strong>
                                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'disabled' , 'data-validation-event' =>"change", "data-validation" =>"required, email")) !!}
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <strong>User Id:</strong>
                                            {!! Form::text('emp_id', null, array('placeholder' => 'User Id','class' => 'form-control' , 'disabled')) !!}
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
                                @if($isLoginUser == 'NO')
                                    <div class="row"> 
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                            <strong>Billing Provider:</strong>
                                            <select name="billingProviders[]" id="billingProvidersId" class="form-control 4col formcls" , data-validation-event="change" data-validation="required">
                                                @foreach ($billingProvidersArray as $bp)
                                                    <option value="{{$bp->id}}"> {{$bp->professional_provider_name}}</option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('billingProviders'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billingProviders') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div> 
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <div class="form-group">
                                            <strong>Role:</strong>
                                            <select name="roles[]" id="roles"  class="form-control 4col formcls" , data-validation-event="change" data-validation="required">
                                                @foreach ($roles as $role)
                                                    <option value="{{$role->id}}"> {{$role->name}}</option>
                                                @endforeach
                                                </select>
                                                @if ($errors->has('roles'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('roles') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div> 
                                    </div>  
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        @endif
                    </div>
                </div>
         </div>
          <div class="col-3 rightside">
            <div id="billingInfoDiv"></div>
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
var arrayList = <?php echo json_encode($userRole); ?>;

console.log('#userRole',arrayList);
    jax('select[multiple]').multiselect({
        columns: 4,
        selectAll : true,
        placeholder: 'Select Role',
        enableFiltering: true,
        search: true,
        selectAllValue: arrayList
    });
});
</script>
