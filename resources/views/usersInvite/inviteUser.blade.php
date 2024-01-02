@extends('layouts.home-new-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <div class="row mt-0">
         <div class="col-12  align-self-center">
            <div class="sub-header mt-0 py-3 px-2 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto margin05">
                   <h2><i class="fa-solid fa-user-check"></i> Invite User</h2>
                </div>
                <div align="right" class="w-sm-100 ">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                     <a class="btn btn-primary" href="{{ route('manageUsers') }}"> Back</a>
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
        <div class="col-12">
            <div class="card p-1">
                    <div class="card-body2">
                        {!! Form::open(['id'=>'send_user_invite','url' => 'inviteProcess',  'class' => 'form-horizontal ladda-form', 'method' => 'post','enctype'=>'multipart/form-data']) !!}
                        @csrf
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <strong>Email:<span class="required">* </span></strong>
                                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'data-validation-event' =>"change", "data-validation" =>"required, email")) !!}
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                           <strong>Role:<span class="required">* </span></strong>
                                           <select name="roles" id="roles"   class="form-control 4col formcls" , data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                            <option value="">-Select-</option>
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
                                    
                                      <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                           <strong>Billing Provider:<span class="required">* </span></strong>
                                           <select name="billingProviders[]" id="billingProvidersId" class="form-control 4col formcls" , data-validation-event="change" data-validation="required" data-validation-error-msg="">
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
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                    <button type="submit" class="btn btn-primary">Invite</button>
                                </div>
                            </div>
                        {!! Form::close() !!} 
                </div>
            </div>

    </div>

    <div class="row">
         <div class="col-12  align-self-center">
            <div class="sub-header mt-0 py-3 px-2 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto margin05">
                   <h2><i class="fa-solid fa-user-group"></i> Invited Users</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div class="col-12">
                <div class="card customBoxHeight4 p-1">
                    <div class="card-body2">
                        <div class="table-responsive">
                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                      <th scope="col">First Name</th>
                                      <th scope="col">Last Name</th>
                                      <th scope="col">Email</th>
                                      <th scope="col">Roles</th>
                                      <th scope="col">Date Activate</th>
                                      <th scope="col">Date Locked</th>
                                      <th scope="col">Billing Provider Access</th>
                                      <th scope="col">Last Sign In Date</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    @inject('userClass', 'App\Http\Controllers\UserInviteController')
                                        @if(count($inviteUser))
                                                @foreach ($inviteUser as $key => $user)
                                                @php 
                                                $isFoundBillingAcees = $userClass->checkBillingProviderAccess($user->id);
                                                @endphp
                                                  <tr>
                                                    <td colspan="9">No Records Found.{{ $user->name }}</td>
                                                  </tr>
                                                  @endforeach
                                                  @else
                                                  <tr class="jsgrid-row">
                                                     <td class="jsgrid-cell">No Records Found.</td>
                                                  </tr>
                                                  @endif
                                        </tbody>
                                </table>
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
        placeholder: 'Select Provider',
        enableFiltering: true,
        search: true,
        selectAllValue: arrayList
    });
});
</script>
