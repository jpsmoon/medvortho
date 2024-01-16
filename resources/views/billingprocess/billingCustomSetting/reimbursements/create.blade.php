@extends('layouts.home-new-app')
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
            <div class="card row-background">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> 
                                @if (isset($id)) Edit   @else Add   @endif Expected Reimbursements </h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/list-of-reimbursements', $providerId) }}"> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="col-12 mt-4">
                    <form action="{{ route('saveBillRender') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                        <input type="hidden" name="renderProviderId" id="renderProviderId" value="{{ $id }}">
                        <div class="row">
                            
                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="form-row col-md-12 pt-2 d-none" id="personaleDiv">
                                        
                                        
                                        <div class="form-group col-md-3">
                                            <label for="fName"> Expected Reimbursement Name</label>
                                            <input value="" type="text" name="fName" id="fName" class="form-control"
                                                maxlength="100">
                                            @if ($errors->has('fName'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('fName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lName"> Injury States</label>
                                            <input type="text" value="" name="lName" id="lName" class="form-control"
                                                maxlength="100">
                                            @if ($errors->has('lName'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('lName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="mName"> Effective DOS</label>
                                            <input type="text" value="" name="mName" id="mName" class="form-control"
                                                maxlength="100">
                                            @if ($errors->has('mName'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('mName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="suffix"> Expiration DOS </label>
                                            <input type="text"  value="" name="suffix" id="suffix" class="form-control"
                                                maxlength="100">
                                            @if ($errors->has('suffix'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('suffix') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>

                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <h4 class="bold form-row col-md-12">Service Line Items</h4>
                                <div class="form-row col-md-12">
                                   
                                    <div class="form-group col-md-3">
                                        <label for="rendering_provider_npi" class="paddingtop">Procedure Code<span class="required">*
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
                                        <label for="rendering_provider_npi" class="paddingtop">Modifiers <span class="required">*
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
                                        <label for="rendering_provider_npi" class="paddingtop">Expected Per Unit<span class="required">*
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
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary ladda-button">
                            <span class="ladda-label">Submit</span></button>
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
