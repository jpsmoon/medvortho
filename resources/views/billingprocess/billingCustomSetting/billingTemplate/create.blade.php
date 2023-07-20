@extends('layouts.home-app')
@section('content')
 
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">{{ ($id) ? 'Update' : 'Add' }} Billing Template</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        @if($id)
                            <a class="btn btn-primary" href="{{ url('/add-custom-billing-template', $providerId) }}"> Back</a>
                        @else
                            <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
                        @endif
                    </li>
                </ol>
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
                        <form action="{{ route('saveProviderBillingTemplate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                         <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                        <input type="hidden" name="billingTemplateId" id="billingTemplateId" value="{{ $id }}">
                        <div class="form-row col-12 mt-4">
                            <div class="form-group col-md-12"><h4 class="bold form-row col-md-12" style="margin-top: 10;">Basic Information</h4> </div>
                        </div>
                        <div class="form-row col-12 mt-4">
                            <div class="form-group col-md-6">
                                <label for="template_name"> Name <span class="required">* </span></label>
                                 <input type="text" value="{{($templateInfo && $templateInfo->template_name) ? $templateInfo->template_name : ''}}" id="template_name" name="template_name" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" class="form-control" maxlength="100">
                                @if ($errors->has('template_name'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('template_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="description"> Description</label>
                                 <input type="text" value="{{($templateInfo && $templateInfo->description) ? $templateInfo->description : ''}}" id="template_description" name="template_description" 
                                 data-validation-event="change" data-validation-optional="true" data-validation="length" data-validation-length="2-100" class="form-control" maxlength="100">
                                @if ($errors->has('template_description'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('template_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @if($templateInfo && $templateInfo->getTemplateServiceItems)
                        @php $ii=1; @endphp
                         @foreach ($templateInfo->getTemplateServiceItems as $item) 
                            <div class="form-row col-12 mt-4 cloneDiv" id="input_{{$ii}}"> 
                                <div class=" col-md-4">
                                    <label for="bill_procedure_code">  Procedure Code   </label>
                                    <input  placeholder="Procedure Code"  data-validation-event="change" data-validation="custom" data-validation-regexp ="^[a-zA-Z0-9]+(\s+[a-zA-Z0-9]+)*$" data-validation-optional="true" data-validation-error-msg="" 
                                    id="bill_procedure_code_{{$ii}}" autocomplete="off" type="text" name="bill_procedure_code[]" 
                                    value="{{$item->procedure_code}}" class="form-control procedure_code_input" maxlength="100">
                                    @if($errors->has('bill_procedure_code'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_procedure_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class=" col-md-4">
                                    <label for="bill_modifiers">  Modifiers   </label>
                                    <select name="bill_modifiers[]" class="form-control modefierCode" id="bill_modifiers{{$ii}}" >
                                        <option value="">-Select-</option>
                                        @foreach ($modifiersArray as $modifiyer)
                                        <option value="{{$modifiyer->id}}" {{ ($item->modifiers_id == $modifiyer->id) ? 'selected' : ''}}>{{$modifiyer->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('bill_modifiers'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_modifiers') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class=" col-md-3">
                                    <label for="bill_units">  Units   </label>
                                    <input placeholder="Units" value="{{$item->units}}" data-validation-event="change" data-validation="custom" data-validation-regexp ="^[0-9]+(\s+[0-9]+)*$" data-validation-optional="true" data-validation-error-msg="" autocomplete="off" id="bill_units{{$ii}}" type="text" name="bill_units[]"  class="form-control bill_unit" maxlength="100">
                                    @if($errors->has('bill_units'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_units') }}</strong>
                                    </span>
                                    @endif
                                </div>  
                            </div>
                            @php $ii++; @endphp
                        @endforeach
                        @endif 
                        @php 
                        $cnt = ($templateInfo && count($templateInfo->getTemplateServiceItems) > 0) ? count($templateInfo->getTemplateServiceItems) +1 : 2;
                        for($i=$cnt; $i <= $cnt; $i++){ 
                        @endphp
                        <div class="form-row col-12 mt-4 cloneDiv" id="input_{{$i}}"> 
                            <div class=" col-md-4">
                                <label for="bill_procedure_code">  Procedure Code   </label>
                                <input  placeholder="Procedure Code"  data-validation-event="change" data-validation="custom" data-validation-regexp ="^[a-zA-Z0-9]+(\s+[a-zA-Z0-9]+)*$" data-validation-optional="true" data-validation-error-msg="" 
                                 id="bill_procedure_code_{{$i}}" autocomplete="off" type="text" name="bill_procedure_code[]" 
                                 value="" class="form-control procedure_code_input" maxlength="100">
                                @if($errors->has('bill_procedure_code'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong class="invalid-feedback" >{{ $errors->first('bill_procedure_code') }}</strong>
                                </span>
                                @endif
                            </div>
                             <div class=" col-md-4">
                                <label for="bill_modifiers">  Modifiers   </label>
                                <select name="bill_modifiers[]" class="form-control modefierCode" id="bill_modifiers{{$i}}" >
                                    <option value="">-Select-</option>
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
                            <div class=" col-md-3">
                                <label for="bill_units">  Units   </label>
                                <input placeholder="Units" data-validation-event="change" data-validation="custom" data-validation-regexp ="^[0-9]\d*(\.\d+)?$" data-validation-optional="true" data-validation-error-msg="" autocomplete="off" id="bill_units{{$i}}" type="text" name="bill_units[]" value="" class="form-control bill_unit" maxlength="100">
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
                            <div class="col-xs-12 col-sm-12 col-md-12"> 
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary ladda-button"><span class="ladda-label">Submit</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(!$id)
            <div class="card row-background">
                <div class="card-content">
                    <div class="card-body">
                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Procedure Code Count</th>
                                        <th scope="col">Created On</th>
                                        <th scope="col">Active</th> 
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @if(count($billingTemplates))
                                        @inject('testPatientClass', 'App\Http\Controllers\BillingCustomSettingController')
                                        @foreach ($billingTemplates as $bTemplate)
                                            <tr>
                                                <td><a class="" data-id="{{$bTemplate->id}}"  href="{{url('/add-custom-billing-template/'.$bTemplate->provider_id."/".$bTemplate->id)}}">{{$bTemplate->template_name}}</a></td>
                                                <td>{{$bTemplate->description}}</td>
                                                <td>{{ ($bTemplate->getTemplateServiceItems)  ? count($bTemplate->getTemplateServiceItems) : 0 }}</td> 
                                                <td>{{($bTemplate->created_at) ? date('m-d-Y', strtotime($bTemplate->created_at))  :  ''}}</td> 
                                                <td>{{($bTemplate->is_active) ? 'Yes' : 'No'}}</td> 
                                                <td> 
                                                  @if(count($bTemplate->getBillCount) == 0)
                                                    <a href="javascript:void(0)" class="text-danger" data-id="{{$bTemplate->id}}">
                                                    <i  class="icon-trash showPointer"/></i>
                                                </a> 
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="10">No Records Found.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-3 mt-4 rightside">
            <div id="billingInfoDiv"></div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>

<script>
$( document ).ready(function() { 
    $('.remove').on('click', function () {
        var num = $('.cloneDiv').length;
        $(this).closest('div').parent('div').remove();
        checkLastIdForProcedureCodeClone();
    });
    $("#input_1").find("#remove_item_icon_1").remove();
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
        var cloneId = 'input_' + newNum;
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
</script>
