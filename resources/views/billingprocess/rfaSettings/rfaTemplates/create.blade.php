@extends('layouts.home-app')
@section('content')
<?php $billingId = 1;
if (isset($id)){
$billingId = $bRenderings->provider_type;
}
?>
<!-- START: Breadcrumbs-->
<!-- END: Breadcrumbs-->
    @if ($errors->any())
        <div class="row ">
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
            <div class="col-1 mt-4"></div>
        </div>
    @endif
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">
            <div class="card row-background" style="min-height: 565px;">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px; padding-left:20px;" class="w-sm-100 mr-auto">
                                <h2 class="heading">Add RFA Template </h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="col-12 mt-4">
                    <form action="{{ route('savePhysicianSetting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                        <input type="hidden" name="renderProviderId" id="renderProviderId" value="{{ $id }}">
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-4"><br>
                                        <h4 class="bold">Basic Information</h4>
                                        <label for="rendering_provider_npi" class="paddingtop">Requesting Physician<span class="required">*
                                            </span></label>
                                        <select class="form-control searcDrop" name="memberType" id="memberType">
                                    </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 ">
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-4">
                                        
                                        <label for="rendering_provider_npi" class="paddingtop">Name<span class="required">*
                                            </span></label>
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="rendering_provider_npi" class="paddingtop">Description<span class="required">*
                                            </span></label>
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                 <h4 class="bold form-row col-md-12">Treatments</h4>
                                <div class="form-row col-md-12">
                                   
                                    <div class="form-group col-md-3">
                                        <label for="rendering_provider_npi" class="paddingtop">Service or Good Requested<span class="required">*
                                            </span></label>
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="rendering_provider_npi" class="paddingtop">CPT/HCPCS<span class="required">*
                                            </span></label>
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rendering_provider_npi" class="paddingtop">Other Info<span class="required">*
                                            </span></label>
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-3">
                                        
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3">
                                        
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12 ">
                                <div class="form-row col-md-12">
                                    
                                    <div class="col-md-2 title">
                                    </div>
                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-4">
                                            <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                                <span class="ladda-label">Add</span></button>
                                            
                                            <button style="min-width: 120px" class="btn btn-primary ladda-button"><span
                                            class="ladda-label">Cancel</span></button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
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

<script>
$( document ).ready(function() {
var type = '<?php echo $billingId;?>';
    //console.log('##type',type);
    showOtherDIv(type);
});
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
