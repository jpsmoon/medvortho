@extends('layouts.home-app')
@section('content')

<style>
#myDIV {
  width: 100%;
  padding: 10px 0;
  
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $billingId = 1;
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
                                @if($ctype != 2)
                                <h2 class="heading">Add Practice Charges</h2>
                                @else
                                <h2 class="heading">Enter Expected Reimbursements</h2> 
                                @endif
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/setting/billing/provider/charge/add', $providerId) }}"> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="col-12 mt-3">
                    <form action="{{ route('savePracticeCharge') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="ctype" id="ctypeId" value="{{ $ctype }}">
                        <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                        <input type="hidden" name="practiceChargeId" id="practiceChargeId" value="{{ ($checkMasterCharge) ? $checkMasterCharge->id : null }}">
                        <input type="hidden" name="chargeId" id="chargeId" value="{{ ($checkMasterCharge) ? $checkMasterCharge->id : null }}">
                        
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for=""> Practice Charge Name<span class="required">* </span> </label>
                                <input type="text"  data-validation-event="change" data-validation="required" data-validation-error-msg="" id="practice_charge_name" name="practice_charge_name" class="form-control ">
                                @if($errors->has('practice_charge_name'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('practice_charge_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""> State<span class="required">* </span> </label>
                                <select  data-validation-event="change" data-validation="required" data-validation-error-msg="" name="states_code[]"  multiple="multiple"
                                class="form-control 4 colactive"  id="statesId" data-validation="required" data-validation-error-msg="">
                                    @foreach ($states as $state)
                                    <option value="{{$state["state_code"]}}"> {{$state["state_name"]}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('states_code'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('states_code') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""> Effective DOS<span class="required">* </span> </label>
                                <input type="text" id="effective_dos"  data-validation-event="change" data-validation="required"data-validation-error-msg="" name="effective_dos" class="form-control ">
                                @if($errors->has('effective_dos'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('effective_dos') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""> Expiration DOS<span class="required">* </span> </label>
                                <input type="text" data-validation-event="change" data-validation="required" data-validation-error-msg="" id="expiration_dos" name="expiration_dos" class="form-control ">
                                @if($errors->has('expiration_dos'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('expiration_dos') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        @php 
                        $cnt = 2;
                        for($i=1; $i <= $cnt; $i++){ 
                        @endphp
                        <div class="row cloneDiv" id="inputChargeDiv_{{$i}}">
                            <div class="form-group col-md-3">
                                <label for=""> Procedure Code </label>
                                <input type="text" id="bill_procedure_code_{{$i}}" name="procedure_code[]" class="form-control ">
                                @if($errors->has('procedure_code'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('procedure_code') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bill_modifiers">  Modifiers   </label>
                                <select name="bill_modifiers[]" class="form-control modefierCode searcDrop" id="bill_modifiers{{$i}}" >
                                    <option value="">Select modifier</option>
                                    @foreach ($modifiersArray as $modifiyer)
                                    <option value="{{$modifiyer->id}}">{{$modifiyer->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('bill_modifiers'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong class="invalid-feedback" >{{ $errors->first('bill_modifiers') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ndc_number"> NDC Number   </label>
                                <input autocomplete="off" id="ndc_number{{$i}}" type="text" name="ndc_number[]" value="" class="form-control" maxlength="100">
                                @if($errors->has('ndc_number'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong class="invalid-feedback" >{{ $errors->first('ndc_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-2">
                                <label for="bill_units">  Charge Per Unit   </label>
                                <input autocomplete="off" id="bill_units{{$i}}" type="text" name="bill_units[]" value="" class="form-control" maxlength="100">
                                @if($errors->has('bill_units'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong class="invalid-feedback" >{{ $errors->first('bill_units') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group col-md-1">
                                <label for=" " class="pt-4"></label>
                                <a id="remove_item_icon_{{$i}}" href='javascript:void(0);' class='remove'><i class='icon-trash'></i></a>
                            </div> 
                        </div>
                        <?php }?>
                        <div class="row">
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-4">
                                    <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                        <span class="ladda-label buttonfont">Add</span></button>
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
<!-- MDB -->
<link rel="stylesheet" type="text/css" href="{{ url('new_assets/app-assets/css/jquery.multiselect.css') }}">
<script src="{{ asset('new_assets/app-assets/js/jquery.multiselect.js') }}"></script>
 
<script>

$( document ).ready(function() { 
    $('.remove').on('click', function () {
        var num = $('.cloneDiv').length;
        $(this).closest('div').parent('div').remove();
        checkLastIdForProcedureCodeClone();
    });
    $("#inputChargeDiv_1").find("#remove_item_icon_1").remove();
    $('#effective_dos').datepicker({ dateFormat: 'mm-dd-yy', maxDate: new Date() });
    $('#expiration_dos').datepicker({ dateFormat: 'mm-dd-yy', minDate: new Date() });
});

window.onload = function afterWebPageLoad() {
     checkLastIdForProcedureCodeClone(); 
};
function checkLastIdForProcedureCodeClone() {
    var lastCloneDivId = $('div .procedure_code_input:last').attr('id');
    console.log('#lastCloneDivId', lastCloneDivId);
    $("#" + lastCloneDivId).on("change", function () {
        addMoreInputsForProcedureCode();
    });
}
function addMoreInputsForProcedureCode() {
    var getLastDiId = $('div .cloneDiv:last').attr('id');
    console.log('#getLastDiId', getLastDiId);
    let billProcedureCode = $("#" + getLastDiId + ' input[name="bill_procedure_code[]"]').val();
    let billModifiers = $("#" + getLastDiId + ' input[name="bill_modifiers[]"]').val();
    let billUnits = $("#" + getLastDiId + ' input[name="bill_units[]"]').val();

    if (billProcedureCode != "" && billModifiers != "" && billUnits != "" ) {
        var num = $('.cloneDiv').length;
        var newNum = new Number(num + 1);
        var cloneId = 'inputChargeDiv_' + newNum;
        var clonedRow = $('div .cloneDiv:last').clone().attr('id', cloneId);
        clonedRow.find('.procedure_code_input').attr('id', 'bill_procedure_code_' + newNum);
        clonedRow.find('.modefierCode').attr('id', 'billModifiersId_' + newNum);
        clonedRow.find('.bill_unit').attr('id', 'bill_units' + newNum);  
        

        $('div .cloneDiv:last').after(clonedRow);
        var eleId = cloneId;
        $("#" + eleId + " .procedure_code_input").one("click", function () {
            addMoreInputsForProcedureCode();
        });
    }
}
var jax = $.noConflict();
jax(document).ready(function() {   
    jax('select[multiple]').multiselect({
        columns: 2,
        selectAll : true,
        placeholder: 'Select State',
        unSelectAll : false,
        // allSelectedText: 'All',
        // includeSelectAllOption: true
    }); 
}); 
</script>


