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
            <div class="card row-background" style="min-height: 565px;">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> 
                                @if (isset($id)) Edit @else Add @endif Referring or Ordering Providers</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/billing/referring', $providerId) }}"> Back</a>
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
                            <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="col-md-2 title paddingtop">
                                        <label>CMS 1500 Box 17b</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rendering_provider_npi" class="paddingtop">NPI<span class="required">*
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

                                    @if (!isset($id))
                                        <div class="form-group col-md-4 mt-1">
                                            <label for="rendering_provider_npi"></label>
                                            <div class="mt-1">
                                                <button type="button" class="btn btn-primary ladda-button"><span
                                                 class="ladda-label">Search</span></button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="col-md-2 title">
                                        <label>Select Provider Type<span class="required">* </span></label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group col-md-10">
                                            <div class="custom-control custom-radio custom-control-inline paddingtop">
                                                <input {{ $bRenderings ? ($bRenderings->provider_type == 2 ? 'checked' : ' ') : '' }}
                                                    class="custom-control-input"  type="radio" name="person_type" id="person_type" value="2"
                                                    data-validation="required"data-validation-error-msg="" />
                                                <label for="person_type" class="custom-control-label"> Referring Provider </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input {{ ($bRenderings) ? ($bRenderings->provider_type == 3) ? "checked" :  " " :  " " }} class="custom-control-input"
                                                    type="radio" name="person_type" id="person_type2" value="3" data-validation="required"data-validation-error-msg="" />
                                                <label for="person_type2" class="custom-control-label"> Ordering Provider </label>
                                            </div><br>
                                            @if ($errors->has('person_type'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('person_type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="col-md-2 title">
                                        <label>CMS 1500 Box 17</label>
                                    </div>
                                    <div class="form-row col-md-10 d-none" id="personaleDiv">
                                        <div class="form-group col-md-3">
                                            <label for="fName"> First Name<span class="required">* </span></label>
                                            <input value="{{ $bRenderings ? $bRenderings->referring_provider_first_name : null }}" type="text" name="fName" id="fName" class="form-control"
                                                maxlength="100" data-validation="required"data-validation-error-msg="">
                                            @if ($errors->has('fName'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('fName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lName"> Last Name<span class="required">* </span></label>
                                            <input type="text" value="{{ $bRenderings ? $bRenderings->referring_provider_last_name : null }}" name="lName" id="lName" class="form-control"
                                                maxlength="100" data-validation="required"data-validation-error-msg="">
                                            @if ($errors->has('lName'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('lName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="mName"> MI</label>
                                            <input type="text" value="{{ $bRenderings ? $bRenderings->referring_provider_middle_name : null }}" name="mName" id="mName" class="form-control"
                                                maxlength="100">
                                            @if ($errors->has('mName'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('mName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="suffix"> Suffix</label>
                                            <input type="text"  value="{{ $bRenderings ? $bRenderings->referring_provider_suffix : null }}" name="suffix" id="suffix" class="form-control"
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
                                    <div class="col-md-2 title">
                                        <label>CMS 1500 Box 17a</label>
                                    </div>
                                    <div class="form-row col-md-10">
                                        
                                        <div class="form-group col-md-3">
                                            <label for="lName"> State License Number </label>
                                            <input type="text" name="license_no" value=""  class="form-control" maxlength="100">
                                            @if ($errors->has('license_no'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('license_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="col-md-2 title">
                                    </div>
                                    <div class="form-row col-md-10">
                                        <div class="form-group col-md-3">
                                            <button type="submit" class="btn btn-primary ladda-button"><span
                                            class="ladda-label">Submit</span></button>
                                            
                                            <button class="btn btn-primary ladda-button"><span
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
