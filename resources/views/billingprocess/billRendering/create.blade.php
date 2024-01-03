@extends('layouts.home-app')
@section('content')
<?php $billingId = 1;
if (isset($id)){
$billingId = $bRenderings->provider_type;
}
 ?>
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    
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
    <div class="row mt-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">Rendering Provider List</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                 
                             <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{url('add/billing/rendering',$id)}}"> Add Rendering Provider</a>
                            </li>    
                                 
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ url('/billing/rendering', $providerId) }}"> Back</a>
                            </li>
                        </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        <div class="row">
            <div class="col-12 mt-4">
                    <form action="{{ route('saveBillRender') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="pType" id="pType" value="{{ $pType }}">
                        <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                        <input type="hidden" name="renderProviderId" id="renderProviderId" value="{{ $id }}">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="col-md-2 title paddingtop">
                                        <label>CMS 1500 Box 24-J</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rendering_provider_npi" class="paddingtop">NPI<span class="required">*
                                            </span></label>
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="{{ $bRenderings ? $bRenderings->referring_provider_npi : null }}">
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
                                        <label>Select Provider Type</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <div class="form-group col-md-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input {{ $bRenderings ? ($bRenderings->provider_type == 1 ? 'checked' : ' ') : 'checked' }}
                                                    onclick="showOtherDIv(this.value);" class="custom-control-input"
                                                    type="radio" name="person_type" id="person_type" value="1" />
                                                <label for="person_type" class="custom-control-label"> Person </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input {{ ($bRenderings) ? ($bRenderings->provider_type == 2) ? "checked" :  " " :  " " }} onclick="showOtherDIv(this.value);" class="custom-control-input"
                                                    type="radio" name="person_type" id="person_type2" value="2" />
                                                <label for="person_type2" class="custom-control-label"> Non Person </label>
                                            </div>
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
                                        <label>CMS 1500 Box 31</label>
                                    </div>
                                    <div class="form-row col-md-10 d-none" id="personaleDiv">
                                        <div class="form-group col-md-3">
                                            <label for="fName"> First Name</label>
                                            <input value="{{ $bRenderings ? $bRenderings->referring_provider_first_name : null }}" type="text" name="fName" id="fName" class="form-control"
                                                maxlength="100">
                                            @if ($errors->has('fName'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('fName') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lName"> Last Name</label>
                                            <input type="text" value="{{ $bRenderings ? $bRenderings->referring_provider_last_name : null }}" name="lName" id="lName" class="form-control"
                                                maxlength="100">
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
                                    <div class="form-row col-md-10 d-none" id="nonPersonaleDiv">
                                        <div class="form-group col-md-3">
                                            <label for="entity_name"> Entity Name</label>
                                            <input value="{{ $bRenderings ? $bRenderings->entity_name : null }}" type="text" name="entity_name" id="entity_name" class="form-control"
                                                maxlength="100">
                                            @if ($errors->has('entity_name'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('entity_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="col-md-2 title">
                                        <label>CMS 1500 Box 24-J</label>
                                    </div>
                                    <div class="form-row col-md-10">
                                        <div class="form-group col-md-3">
                                            <label for="taxonomy_code">Taxonomy Code</label>
                                            <select class="form-control searcDrop" name="taxonomy_code" id="taxonomy_code">
                                                @foreach ($taxonomy_codes as $taxonomy_code)
                                                    <option value="{{ $taxonomy_code->id }}"
                                                    {{ $bRenderings ? ($bRenderings->taxonomy_code == $taxonomy_code->id ? 'selected' : ' ') : ' ' }}
                                                    > {{ $taxonomy_code->name }}
                                                        {{ $taxonomy_code->code }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('taxonomy_code'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('taxonomy_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="lName"> License Number </label>
                                            <input type="text" name="license_no" value="{{ $bRenderings ? $bRenderings->referring_provider_license_number : null }}"  class="form-control" maxlength="100">
                                            @if ($errors->has('license_no'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('license_no') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="suffix">State</label>
                                            <select name="rendering_state_id" class="form-control searcDrop stateDD" id="stateDD">
                                                <option value="" class="option">Select</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state['state_name'] }}"  {{ $bRenderings ? ($bRenderings->referring_provider_state_id == $state['state_name'] ? 'selected' : ' ') : ' ' }}>
                                                        {{ $state['state_name'] }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('rendering_state_id'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('rendering_state_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="col-md-2 title">
                                        <label>Signature(Optional)</label>
                                    </div>
                                    <div class="form-row col-md-3 ">
                                        <div class="form-group">
                                            <label for="taxonomy_code">Signature (PNG format) </label>
                                            <input type="file" name="signature_img" id="signature_img"
                                                class="form-control" maxlength="100">
                                            @if ($errors->has('signature_img'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong
                                                        class="invalid-feedback">{{ $errors->first('signature_img') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="col-md-2 title">
                                        <label>Other</label>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="taxonomy_code">Provider Type</label>
                                        <select name="provider_name_type" class="form-control" id="provider_name_type">
                                            <option value="" class="option">Select</option>
                                            <option value="1"  {{ $bRenderings ? ($bRenderings->provider_name_type == 1 ? 'selected' : ' ') : ' ' }}>Physician</option>
                                            <option value="2" {{ $bRenderings ? ($bRenderings->provider_name_type == 2 ? 'selected' : ' ') : ' ' }}>Non-Physician Practitioner</option>
                                            <option value="3" {{ $bRenderings ? ($bRenderings->provider_name_type == 3 ? 'selected' : ' ') : ' ' }}>Clinical Social Worker</option>
                                        </select>

                                        @if ($errors->has('provider_type'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong>{{ $errors->first('provider_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <button type="submit" class="btn btn-primary ladda-button"><span
                                        class="ladda-label">Submit</span></button>
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
<script src="{{ asset('public/js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('public/js/controller/master_for_all.js') }}"></script>

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
