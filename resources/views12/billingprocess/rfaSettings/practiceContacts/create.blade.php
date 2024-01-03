@extends('layouts.home-app')
@section('content')
  <style>
      .dataTables_length
        {
          padding-top: 2%;  
        }  
  </style>  
    
    @if ($errors->any())
        <div class="row mt-2 customBox">
            <div align="center" class="col-12  align-self-center">
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    
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


    <div class="row mt-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">{{$title}}</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                             <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ url('/list/practice/contact', $providerId) }}"> Back</a>
                            </li>
                        </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        <div class="row">
            <div class="col-12">
                <div class="card">
                        <form action="{{ route('practiceContact') }}" enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                        @csrf
                        <input type="hidden" name="billing_provider_id" id="billing_provider_id" value="{{ $providerId }}">
                        <input type="hidden" name="id" id="practiceContactId" value="{{ $id }}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="first_name" class="paddingtop">First Name<span class="required">*
                                        </span></label>
                                    <input type="text" name="first_name" data-validation-event="change" data-validation="required"data-validation-error-msg="" class="form-control" maxlength="100" 
                                    value="{{ ($bPracticeContact && $bPracticeContact->first_name) ? $bPracticeContact->first_name : ''}}">
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback">{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="middle_name" class="paddingtop">MI</label>
                                    <input type="text" name="middle_name"  class="form-control" maxlength="100" value="{{ ($bPracticeContact && $bPracticeContact->middle_name) ? $bPracticeContact->middle_name : ''}}">
                                    @if ($errors->has('middle_name'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback">{{ $errors->first('middle_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="last_name" class="paddingtop">Last Name<span class="required">*
                                        </span></label>
                                    <input type="text" name="last_name" data-validation-event="change" data-validation="required"data-validation-error-msg="" class="form-control" maxlength="100" value="{{ ($bPracticeContact && $bPracticeContact->last_name) ? $bPracticeContact->last_name : ''}}">
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong
                                                class="invalid-feedback">{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="suffix_name" class="paddingtop">Suffix</label>
                                    <input type="text" name="suffix_name" class="form-control" maxlength="100" value="{{ ($bPracticeContact && $bPracticeContact->suffix_name) ? $bPracticeContact->suffix_name : ''}}">
                                    @if ($errors->has('suffix_name'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong
                                                class="invalid-feedback">{{ $errors->first('suffix_name') }}</strong>
                                        </span>
                                    @endif
                                </div>                                    
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="telephone" class="paddingtop">Telephone<span class="required">*
                                        </span></label>
                                    <input type="text" data-mask="(999) 999-9999" name="telephone" data-validation-event="change" data-validation="required" data-validation-error-msg="" class="form-control" maxlength="100" value="{{ ($bPracticeContact && $bPracticeContact->telephone) ? $bPracticeContact->telephone : ''}}">
                                    @if ($errors->has('telephone'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong
                                                class="invalid-feedback">{{ $errors->first('telephone') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                                <div class="form-group col-md-4">
                                    <label for="rendering_provider_npi" class="paddingtop">Email Address<span class="required">*
                                        </span></label>
                                    <input type="text" name="email" data-validation-event="change" data-validation="required" data-validation-error-msg=""
                                        class="form-control" maxlength="100" value="{{ ($bPracticeContact && $bPracticeContact->email) ? $bPracticeContact->email : ''}}">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong
                                                class="invalid-feedback">{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>  
                            <div class="form-row">
                                <div class=" col-md-12">
                                    <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button"> <span class="ladda-label">{{ ($id) ? 'Update' : 'Add' }}</span></button>
                                    @if(!$id)
                                    <button style="min-width: 120px" class="btn btn-primary ladda-button"><span class="ladda-label">Cancel</span></button>
                                    @endif
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script></script>

<script>
$( document ).ready(function() {

function showOtherDIv(val){
    if(val == 1){
        $('#personaleDiv').removeClass('d-none');
        $('#nonPersonaleDiv').addClass('d-none');
    }
    else{
        $('#personaleDiv').addClass('d-none');
        $('#nonPersonaleDiv').removeClass('d-none');
    }
}
</script>

