<style>
.pt-3 {
    padding-top: 2.5rem!important;
    position: relative;
    top: 0px;
    left: 1px;
}
</style>
   
    <div class="col-xs-12 col-sm-12 col-md-12">
    <input autocomplete="off" type="hidden" id="billId" name="billId" value="{{($injuryBillInfo) ? $injuryBillInfo->id : null}}">
    <input autocomplete="off" type="hidden" id="patientId" name="patientId" value="{{$patientId}}">
    <input autocomplete="off" type="hidden" id="injuryId" name="injuryId" value="{{$injuryId}}">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-12 input-icons">
                        <label for="bill_dos"> DOS <span class="required">*</span></label>
                        <input autocomplete="off" value="{{($injuryBillInfo) ? ($injuryBillInfo->dos != "" && $injuryBillInfo->dos != '0000-00-00') ? date('m/d/Y',strtotime($injuryBillInfo->dos)) : null : null}}"  type="text" id="bill_dos"  name="bill_dos" 
                        data-validation-event="change" data-validation="required date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                        <i class="icon-calendar"></i>
                        @if($errors->has('bill_dos'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_dos') }}</strong>
                        </span>
                        @endif
                        <span class="invalid-feedback" style="display:none" role="alert" id="showInjuryDateError">
                            <strong class="invalid-feedback" >DOS is before the injury's start date</strong>
                        </span>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="bill_place_of_service">   Place of Service <span class="required">* </span></label>
                        @if(count($masterPlaceServices) > 0)
                            <select data-validation-event="change" data-validation="required" data-validation-error-msg="" name="bill_place_of_service" class="form-control searcDrop" id="bill_place_of_service" data-validation-event="change" data-validation="required" data-validation-error-msg="">  
                                <option value="">-Select-</option>
                                @foreach($masterPlaceServices as $bs)
                                    <option value="{{$bs->id}}" {{($injuryBillInfo) ? ($injuryBillInfo->bill_place_of_service == $bs->id) ? 'selected' : '' : ''}} >{{$bs->nick_name}}</option>
                                @endforeach
                            </select>
                        @else
                        <select name="bill_place_of_service" class="form-control" id="bill_place_of_service">  
                        </select>
                        @endif                          
                        @if($errors->has('bill_place_of_service'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_place_of_service') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12 input-icons">
                        <label for="bill_rendering_provider"> Rendering Provider<span class="required">* </span></label>
                            <select data-validation-event="change" data-validation="required" data-validation-error-msg=""  name="bill_rendering_provider" class="form-control searcDrop" id="bill_rendering_provider" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                <option value="">-Select-</option>
                                @foreach($billRenderinProviders as $bRP)
                                    <option value="{{$bRP->id}}" {{($injuryBillInfo) ? ($injuryBillInfo->bill_rendering_provider == $bRP->id) ? 'selected' : '' : ''}}>{{$bRP->referring_provider_first_name}} {{($bRP->referring_provider_last_name) ? $bRP->referring_provider_last_name : '' }}</option>
                                @endforeach
                            </select>
                        @if($errors->has('bill_rendering_provider'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_rendering_provider') }}</strong>
                        </span>
                        @endif
                    </div>
                     @if($billingTemplate && count($billingTemplate) > 0 )
                    <div class="form-group col-md-12"> 
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <div class="form-group">
                                    <label for="bill_template">Billing Template     </label>
                                    <select name="bill_template" class="form-control" id="bill_template">
                                        <option value="">Select Template</option>
                                        @foreach($billingTemplate as $tempLate)
                                            <option value="{{$tempLate->id}}" {{($injuryBillInfo) ? ($injuryBillInfo->template_id == $tempLate->id) ? 'selected' : '' : ''}}>{{$tempLate->template_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <button type="button" class="btn btn-primary" name="billing_template_btn" onClick="applyBillingTemplate();" id="billing_template_btn">Apply</button>
                            </li>
                        </ul>
                      </div>
                      @endif
                </div>
            </div>
            
            
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="bill_authorization_number">Authorization Number   </label>
                        <input data-validation-optional="true" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ " autocomplete="off"  type="text" name="bill_authorization_number" value="{{($injuryBillInfo) ? $injuryBillInfo->bill_authorization_number : null}}" class="form-control" maxlength="100">
                        @if($errors->has('bill_authorization_number'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_authorization_number') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bill_practice_bill_id">Practice Bill ID    </label>
                        <input autocomplete="off"  type="text" name="bill_practice_bill_id"
                        data-validation-optional="true" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ "
                        value="{{($injuryBillInfo) ? $injuryBillInfo->bill_practice_bill_id : null}}" class="form-control" maxlength="100">
                        @if($errors->has('bill_practice_bill_id'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_practice_bill_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-row">
                     <div class="form-group col-md-6 input-icons">
                        <label for="bill_adminssion_date">Admission Date    </label>
                        <input data-validation-optional="true" data-validation-event="change" data-validation="date" data-validation-format="mm/dd/yyyy" data-validation-error-msg="" autocomplete="off"  type="text" id="bill_adminssion_date"
                        value="{{($injuryBillInfo) ? ($injuryBillInfo->bill_adminssion_date != "" && $injuryBillInfo->bill_adminssion_date != '0000-00-00') ? date('m/d/Y',strtotime($injuryBillInfo->bill_adminssion_date)) : null  : null}}"
                        name="bill_adminssion_date" class="form-control" maxlength="100">
                        <i class="icon-calendar"></i>
                        @if($errors->has('bill_adminssion_date'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_adminssion_date') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6 input-icons">
                        <label for="dos_end">DOS End </label>
                        <input data-validation-optional="true" data-validation-event="change" data-validation="date" data-validation-format="mm/dd/yyyy" data-validation-error-msg="" autocomplete="off" value="{{($injuryBillInfo) ? ($injuryBillInfo->dos_end != "") ? date('m/d/Y',strtotime($injuryBillInfo->dos_end)) : null : null}}"
                        type="text" id="dos_end"  name="dos_end" class="form-control" maxlength="100">
                        <i class="icon-calendar"></i>
                        @if($errors->has('dos_end'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('dos_end') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                   @php $bb=1; @endphp
                   <?php for($ii=0; $ii < count($refProviderForEdit); $ii++){ ?>
                    <div class="form-row cloneDivProviderTypeDiv" id="providerDiv_{{$bb}}">
                        @if(count($refProviderForEdit) > 0)
                        @if($injuryBillInfo)
                         
                        <div class="form-group col-md-12 providerTypeDiv"  id="showProviderDiv_{{$bb}}">
                        @else
                        <div class="form-group col-md-12 providerTypeDiv {{($ii ===1) ? '' : 'd-none'}}" id="showProviderDiv_{{$bb}}">
                        @endif
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bill_provider_type">   Provider Type   </label>
                                        <select name="bill_provider_type[]" id="billProviderTypeDrop_{{$bb}}"
                                        onchange="removeSelectedOption(event, this.value),getReferningProvider(this.value,{{$injuryId}},'bill_provider_name_'+{{$bb}}, 'providerNameDiv_'+{{$bb}});" class="form-control proDiv">
                                            <option value="">-Select-</option>
                                            @foreach($refProviderForEdit as $provider)
                                                <option value="{{$provider['id']}}" {{ ($injuryBillInfo && $refProviderForEdit[$ii]['id'] == $provider['id']) ? 'selected' : '' }}>{{$provider['name']}}</option>
                                            @endforeach
                                        </select>
                                    @if($errors->has('bill_provider_type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_pbill_provider_typerovider_type_drop') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="bill_provider_type">   Provider Name  </label>
                                            <select name="bill_provider_name[]" id="bill_provider_name_{{$bb}}" class="form-control providename" >

                                            </select>
                                        @if($errors->has('bill_provider_name'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('bill_provider_name') }}</strong>
                                        </span>
                                        @endif
                                </div>
                                <div class="form-group col-md-1 pt-3">
                                    <label>&nbsp;</label>
                                    <span class="pt-5">
                                        <i class="icon-trash showPointer removeItem" id="removeItemId_{{$bb}}" onClick="deleteProviderNameIndex(this);"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                <?php $bb++; }?>
                 @php $ii= (count($refProviderForEdit) > 0 ) ?  count($refProviderForEdit) + 1 : 1;@endphp
                 <?php for($ij=1; $ij <= count($referingOrderProviders); $ij++){ ?>
                <div class="form-row cloneDivProviderTypeDiv" id="providerDiv_{{$ii}}">
                    @if(count($referingOrderProviders) > 0)
                        <div class="form-group col-md-12 providerTypeDiv {{($ij ===1) ? '' : 'd-none'}}" id="showProviderDiv_{{$ij}}">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="bill_provider_type">   Provider Type   </label>
                                        <select name="bill_provider_type[]" id="billProviderTypeDrop_{{$ij}}"
                                        onchange="removeSelectedOption(event, this.value),getReferningProvider(this.value,{{$injuryId}},'bill_provider_name_'+{{$ij}}, 'providerNameDiv_'+{{$ij}});" class="form-control proDiv">
                                            <option value="">-Select-</option>
                                            @foreach($referingOrderProviders as $provider)
                                                <option value="{{$provider['id']}}">{{$provider['name']}}</option>
                                            @endforeach
                                        </select>
                                    @if($errors->has('bill_provider_type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_pbill_provider_typerovider_type_drop') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="bill_provider_type">   Provider Name </label>
                                            <select name="bill_provider_name[]" id="bill_provider_name_{{$ij}}" class="form-control providename" >

                                            </select>
                                        @if($errors->has('bill_provider_name'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('bill_provider_name') }}</strong>
                                        </span>
                                        @endif 
                                </div>
                                   <div class="form-group col-md-1 pt-3">
                                    <label>&nbsp;</label>
                                    <span class="pt-5">
                                        <i class="icon-trash showPointer removeItem" id="removeItemId_{{$ij}}" onClick="deleteProviderNameIndex(this);"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <?php $ii++; }?>
                <div class="form-row" id="addButtonDiv">
                    <div class="form-group col-md-5" onClick="cloneForProviderType();">
                        <label for="add_new_providers" style="cursor: pointer;" ><i class="icon-plus"></i> Add another</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="bill_additiona_information_box">   Additional Information (Box 19)</label>
                        <input data-validation-optional="true" data-validation-event="change" data-validation="required, alphanumeric" data-validation-allowing=",-_ " autocomplete="off" value="{{($injuryBillInfo) ? $injuryBillInfo->bill_additiona_information_box : null}}"
                        type="text" name="bill_additiona_information_box" class="form-control" maxlength="100">
                        @if($errors->has('bill_additiona_information_box'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_additiona_information_box') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
         <div class="row pt-1 bg-light mt-2">
            <div class="col-xs-12 col-sm-12 col-md-12">
             <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="diagnosis_code"> Diagnosis Codes</label>
                    <div class="form-check form-check-inline custom-control custom-radio custom-control-inline">
                        <input class="form-check-input"  type="radio"  name="diagnosis_code_type" id="diagnosis_code1" value="9" {{ ($diagnosesType == 9) ? 'checked' : ''}} {{ ($diagnosesType == 10) ? 'disabled' : ''}}>
                        <label class="form-check-label" for="diagnosis_code1">ICD-9</label>
                    </div>
                    <div class="form-check form-check-inline custom-control custom-radio custom-control-inline">
                        <input class="form-check-input" type="radio" name="diagnosis_code_type" id="diagnosis_code2" value="10" {{ ($diagnosesType == 10) ? 'checked' : ''}} {{ ($diagnosesType == 9) ? 'disabled' : ''}}>
                        <label class="form-check-label" for="diagnosis_code2">ICD-10</label>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="row pt-1 bg-light">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <fieldset>
                    <legend><span id="icdId">ICD-{{ ($diagnosesType == 9) ? '9' : '10'}}</span> Diagnosis Codes </legend>
                        @php $aa = 1; $aa2 = 1; $leftDignosCnt = 4; $masterCnt =4; $dC = 0; $totCnt = 0; @endphp
                        <div class="form-row">
                         @if($injuryBillInfo && $injuryBillInfo && $injuryBillInfo->getBillDiagnosis)
                           @php $dC = ( count($injuryBillInfo->getBillDiagnosis) > 0 ) ? count($injuryBillInfo->getBillDiagnosis) +1 : 1;
                           $totCnt = count($injuryBillInfo->getBillDiagnosis);
                           if( $totCnt  > 0  && $totCnt > $masterCnt ) {
                                $leftDignosCnt = (count($injuryBillInfo->getBillDiagnosis ) - $masterCnt );
                           }  
                           @endphp 
                            @foreach ($injuryBillInfo->getBillDiagnosis as $key =>  $dCode1)
                                <div class="form-group col-md-3 cloneDivDiagnosisCode" id="dio_Code_{{$aa}}">
                                        <label for="work_dg_code_id_{{$aa}}">   &nbsp;  </label> 
                                        <input type="hidden" name="work_dg_code_id[]" value="{{$dCode1->diagnose_code_id}}">
                                        <input type="text" name="work_dg_code_id[]" class="work_dg_original" id="work_dg_code_id_{{$aa}}"  placeholder="{{($dCode1->getBillDiagnosisName && $dCode1->getBillDiagnosisName->diagnosis_code) ? $dCode1->getBillDiagnosisName->diagnosis_code : ''}} 
                                        {{($dCode1->getBillDiagnosisName && $dCode1->getBillDiagnosisName->diagnosis_name) ? " - ".$dCode1->getBillDiagnosisName->diagnosis_name : ''}}"> 
                                        <input type="hidden" name="workCodesArray[]" id="work_codes_array_id_{{$aa}}">
                                        @if($errors->has('work_dg_code_id'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('work_dg_code_id') }}</strong>
                                        </span>
                                        @endif
                                        <span id="diagnosError_{{$aa}}" class="dc_error"></span>
                                </div>
                                @php $aa++; @endphp
                            @endforeach 
                        @else
                            @if($pInjuries && $pInjuries->getInjuryClaim && $pInjuries->getInjuryClaim->getInjuryDianoses) 
                             @php $dC = ( count($pInjuries->getInjuryClaim->getInjuryDianoses) > 0 ) ? count($pInjuries->getInjuryClaim->getInjuryDianoses) +1 : 1; @endphp
                                @foreach ($pInjuries->getInjuryClaim->getInjuryDianoses as $key =>  $dCode)
                                    <div class="form-group col-md-3 cloneDivDiagnosisCode" id="dio_Code_{{$aa2}}">
                                            <label for="work_dg_code_id_{{$aa2}}">   &nbsp;  </label>
                                            <input type="hidden" name="work_dg_code_id[]" value="{{$dCode->diagnosis_code_id}}">
                                            <input type="text" name="work_dg_code_id[]" class="work_dg_original" id="work_dg_code_id_{{$aa2}}" placeholder="{{($dCode->getDianoses && $dCode->getDianoses->diagnosis_code) ? $dCode->getDianoses->diagnosis_code : ''}} {{($dCode->getDianoses && $dCode->getDianoses->diagnosis_name) ? " - ".$dCode->getDianoses->diagnosis_name : ''}}"> 
                                            <input type="hidden" name="workCodesArray[]" id="work_codes_array_id_{{$aa2}}">
                                            @if($errors->has('work_dg_code_id'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong class="invalid-feedback" >{{ $errors->first('work_dg_code_id') }}</strong>
                                            </span>
                                            @endif
                                            <span id="diagnosError_{{$aa2}}" class="dc_error"></span>
                                    </div>
                                    @php $aa2++; @endphp
                                @endforeach 
                            @endif 
                        @endif 
                        @for($ji= 1; $ji <= $leftDignosCnt; $ji++)
                            <div class="form-group col-md-3 cloneDivDiagnosisCode" id="dio_Code_{{$dC}}">
                                <label for="work_dg_code_id_{{$dC}}">   &nbsp;  </label>
                                <input type="text" name="work_dg_code_id[]" class="work_dg_original" id="work_dg_code_id_{{$dC}}"> 
                                <input type="hidden" name="workCodesArray[]" id="work_codes_array_id_{{$dC}}">
                                @if($errors->has('work_dg_code_id'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong class="invalid-feedback" >{{ $errors->first('work_dg_code_id') }}</strong>
                                </span>
                                @endif
                                <span id="diagnosError_{{$dC}}" class="dc_error"></span>
                            </div> 
                            @php $dC++; @endphp
                        @endfor
                        </div> 
                        <div class="form-row cloneDCDiv" id="diagnosesDivClonedDiv"></div>
                        <div class="form-row d-now" id="showCopyDiagnosisDiv">
                            <div class="form-group col-md-3">
                                <input onClick="checkLastDigonsisCodeForClone();" type="checkbox" name="copyDiagnosisCode" value="" id="copyDiagnosisCodeId"> </li>
                                 <label for="copyDiagnosisCodeId">Copy diagnosis codes to line items</label>                                
                            </div>
                        
                        </div> 
                </fieldset>
            </div>
        </div>
        <div class="row pt-1 bg-light">
            <div class="col-xs-12 col-sm-12 col-md-12">
            
                <fieldset id="cloneDivStr">
                    <legend>
                        <div class="col-xs-6 col-sm-6 col-md-6"> <i class="icon-list-ul"></i> Service Line Items</div>
                        <div class="col-xs-6 col-sm-6 col-md-6"><span class="showPointer" onClick="addMoreInputsForProcedureCode();"><i class="icon-plus showPointer"></i> Add More Row</span></div>
                     </legend> 
                    @php $cpdCnt = 1;  @endphp
                    @if($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices))
                        @php $cpdCnt = (count($injuryBillInfo->getBillServices)  + 1);  
                        $kk =1;
                        @endphp
                        
                        @foreach ($injuryBillInfo->getBillServices as $key =>  $service) 
                            <div class="row cloneDiv bg-light p-2 pt-0" id="input_{{$kk}}">
                                <div class=" col-md-2">
                                     <label for="bill_procedure_code">  Procedure Code   </label>
                                        <input placeholder="Procedure Code" onkeyup='setUnitCodeOnChangeProcedureCode(event,<?php echo count($injuryBillInfo->getBillServices); ?>); searchAutoForProcedureCode(event);' id="bill_procedure_code_{{$kk}}" autocomplete="off" type="text" name="bill_procedure_code[]" 
                                        value="{{$service->bill_procedure_code}}" class="form-control procedure_code_input" maxlength="100">
                                        <ul id="search_bill_procedure_code_{{$kk}}" class="autoCompete-css"></ul>
                                        @if($errors->has('bill_procedure_code'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('bill_procedure_code') }}</strong>
                                        </span>
                                        @endif 
                                </div>
                                <div class=" col-md-3">
                                    <label for="bill_modifiers">  Modifiers   </label>
                                    <select name="bill_modifiers[]"  multiple   class=" select2-original modefierCode"  onChange='setUnitCodeOnChangeProcedureCode(event,<?php echo $service_lineCnt?>)'   id="billModifiersId_{{$kk}}" >
                                        <option value="">-Select-</option>
                                        @foreach ($modifiersArray as $modifiyer)
                                        <option value="{{$modifiyer->id}}" {{($service->bill_modifiers == $modifiyer->id) ? "selected" : ""}}>{{$modifiyer->name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('bill_modifiers'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_modifiers') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class=" col-md-1">
                                    <label for="bill_units">  Units   </label>
                                    <input placeholder="Units" autocomplete="off" id="bill_units{{$kk}}" type="text" name="bill_units[]"  class="form-control bill_unit" maxlength="5"
                                    value="{{$service->bill_units}}">
                                    @if($errors->has('bill_units'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_units') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class=" col-md-6">
                                    <label for="bill_units">  Diag Codes   </label>
                                    <table>
                                        <tr>
                                            <td><input onKeyup='checkDiagCodesForServices(event,this.value)' placeholder="Diag Code 1" autocomplete="off" type="text"  id="bill_diag_codes1_{{$kk}}" name="bill_diag_codes1[]" value="{{$service->bill_diag_codes1}}" class="form-control bill_diag_codes1" maxlength="50"></td>
                                            <td><input onKeyup='checkDiagCodesForServices(event,this.value)' placeholder="Diag Code 2" autocomplete="off" type="text"  id="bill_diag_codes2_{{$kk}}" name="bill_diag_codes2[]" value="{{$service->bill_diag_codes2}}" class="form-control bill_diag_codes2" maxlength="50"></td>
                                            <td><input onKeyup='checkDiagCodesForServices(event,this.value)' placeholder="Diag Code 3" autocomplete="off" type="text"  id="bill_diag_codes3_{{$kk}}" name="bill_diag_codes3[]" value="{{$service->bill_diag_codes3}}" class="form-control bill_diag_codes3" maxlength="50"></td>
                                            <td><input onKeyup='checkDiagCodesForServices(event,this.value)'  placeholder="Diag Code 4" autocomplete="off" type="text" id="bill_diag_codes4_{{$kk}}" name="bill_diag_codes4[]" value="{{$service->bill_diag_code4}}" class="form-control bill_diag_codes4" maxlength="50"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="error_msg" id="showDiagCodeError_{{$kk}}">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                 <div class="col-md-2 pt-1 pl-0 d-none addInfoDiv" id="addition_info_div_{{$kk}}">
                                    <input type="text" placeholder="Additional Information" class="form-control"  name="additional_information[]" id="additional_information_{{$kk}}"  data-validation-optional="true" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ " value="{{$service->additional_information}}" >
                                    @if($errors->has('additional_information'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('additional_information') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-2 pt-1 pl-0">
                                    <input type="text" placeholder="Unit Amount" class="form-control chargeAmt" name="master_charge[]" id="bill_master_charge{{$kk}}" value="{{$service->master_unit_amount}}">
                                </div>
                                <div class="col-md-2 pt-1 pl-0">
                                    <input type="text" class="form-control d-none master_charge_found" name="isMasterChargeFound[]" id="isMasterChargeFound_{{$kk}}" value="{{$service->is_master_found}}">
                                    <input type="text" class="form-control d-none master_charge"  name="master_charge_id[]" id="bill_master_charge_id{{$kk}}" value="{{$service->master_procedure_code_charge_id}}">
                                </div>
                            </div>
                             @php    $kk++;  @endphp
                        @endforeach
                    @endif 
                        <?php for($i=1; $i <= 1; $i++){?>
                            <div class="row cloneDiv bg-light p-2 pt-0" id="input_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}">
                                <div class=" col-md-2">
                                        <label for="bill_procedure_code">  Procedure Code   </label>
                                        <input onkeyup='searchAutoForProcedureCode(event);' placeholder="Procedure Code" id="bill_procedure_code_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" autocomplete="off" type="text" name="bill_procedure_code[]" value=""
                                        class="form-control procedure_code_input" maxlength="100">
                                        <ul id="search_bill_procedure_code_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" class="autoCompete-css procedure_code_ul"></ul>
                                        @if($errors->has('bill_procedure_code'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('bill_procedure_code') }}</strong>
                                        </span>
                                        @endif 
                                        <div class=" col-md-1  cus-plus d-none" id="addition_info_icon_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" style="max-width: 2%;">
                                            <span><i class="icon-plus showPointer" onClick="showAdditionalInfoInput('addition_info_div_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}"');"></i></span>
                                        </div>
                                </div>
                                
                                <div class=" col-md-3">
                                    <label for="bill_modifiers">  Modifiers   </label>
                                    <select name="bill_modifiers[]"  multiple onChange='setUnitCodeOnChangeProcedureCode(event,<?php echo $service_lineCnt?>)'   class=" select2-original modefierCode"   id="bill_modifiers{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" >
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
                                <div class=" col-md-1">
                                    <label for="bill_units">  Units   </label>
                                    <input placeholder="Units"  autocomplete="off" id="bill_units{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" type="text" name="bill_units[]" value="" class="form-control bill_unit" maxlength="5">
                                    @if($errors->has('bill_units'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_units') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class=" col-md-6" id="childPt">
                                    <label for="bill_units">  Diag Codes </label>
                                    <table>
                                        <tr>
                                            <td><input placeholder="Diag Code 1" onKeyup='checkDiagCodesForServices(event,this.value)' autocomplete="off" type="text" id="bill_diag_codes1_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" name="bill_diag_codes1[]" value="" class="form-control bill_diag_codes1" maxlength="50"></td>
                                            <td><input placeholder="Diag Code 2" onKeyup='checkDiagCodesForServices(event,this.value)' autocomplete="off" type="text" id="bill_diag_codes2_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" name="bill_diag_codes2[]" value="" class="form-control bill_diag_codes2" maxlength="50"></td>
                                            <td><input placeholder="Diag Code 3" onKeyup='checkDiagCodesForServices(event,this.value)' autocomplete="off" type="text" id="bill_diag_codes3_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" name="bill_diag_codes3[]" value="" class="form-control bill_diag_codes3" maxlength="50"></td>
                                            <td><input placeholder="Diag Code 4" onKeyup='checkDiagCodesForServices(event,this.value)' autocomplete="off" type="text" id="bill_diag_codes4_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" name="bill_diag_codes4[]" value="" class="form-control bill_diag_codes4" maxlength="50"></td>
                                            <td class='removeBtn' id="remove_item_icon_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}"><a  href='javascript:void(0);'><i class='icon-trash'></i></a></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="error_msg" id="showDiagCodeError_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}">
                                            </td>
                                        </tr>
                                    </table>
                                </div> 
                                <div class="col-md-2 pt-1 pl-0 d-none addInfoDiv" id="addition_info_div_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}">
                                    <input type="text" placeholder="Additional Information" class="form-control"  name="additional_information[]" id="additional_information_{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}"  data-validation-optional="true" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ ">
                                    @if($errors->has('additional_information'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('additional_information') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-2 pt-1 pl-0">
                                    <input type="text" class="form-control d-none" name="isMasterChargeFound[]" id="isMasterChargeFound{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" value="">
                                    <input placeholder="Unit Amount" type="text" class="form-control chargeAmt d-none" name="master_charge[]" id="bill_master_charge{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" value="">
                                </div>
                                <div class="col-md-2 pt-1 pl-0">
                                    <input type="text" class="form-control d-none" name="master_charge_id[]" id="bill_master_charge_id{{($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0) ? (count($injuryBillInfo->getBillServices) + 1) : $i}}" value="">
                                </div>
                            </div>
                        <?php }?>
                </fieldset>
            </div>
        </div>
