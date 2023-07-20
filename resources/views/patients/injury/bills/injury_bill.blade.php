    <div class="col-xs-12 col-sm-12 col-md-12">
    <input autocomplete="off" type="hidden" id="billId" name="billId" value="{{($injuryBillInfo) ? $injuryBillInfo->id : null}}">
    <input autocomplete="off" type="hidden" id="patientId" name="patientId" value="{{$patientId}}">
    <input autocomplete="off" type="hidden" id="injuryId" name="injuryId" value="{{$injuryId}}">
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="bill_dos">   DOS <span class="required">*</span></label>
                        <input autocomplete="off" value="{{($injuryBillInfo) ? ($injuryBillInfo->dos != "" && $injuryBillInfo->dos != '0000-00-00') ? date('m/d/Y',strtotime($injuryBillInfo->dos)) : null : null}}"  type="text" id="bill_dos"  name="bill_dos" 
                        data-validation-event="change" data-validation="required date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                        <i class="icon-calendar"></i>
                        @if($errors->has('bill_dos'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_dos') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="bill_place_of_service">   Place of Service <span class="required">* </span></label>
                        @if(count($masterPlaceServices) > 0)
                            <select data-validation-event="change" data-validation="required" data-validation-error-msg="" name="bill_place_of_service" class="form-control searcDrop" id="bill_place_of_service" data-validation-event="change" data-validation="required" data-validation-error-msg="">  
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
                    <div class="form-group col-md-12">
                        <label for="bill_rendering_provider">   Rendering Provider<span class="required">* </span></label>
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
                                    <label for="bill_template">   Billing Template     </label>
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
                        <label for="bill_authorization_number">   Authorization Number    </label>
                        <input data-validation-optional="true" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ " autocomplete="off"  type="text" name="bill_authorization_number" value="{{($injuryBillInfo) ? $injuryBillInfo->bill_authorization_number : null}}" class="form-control" maxlength="100">
                        @if($errors->has('bill_authorization_number'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong class="invalid-feedback" >{{ $errors->first('bill_authorization_number') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bill_practice_bill_id">   Practice Bill ID    </label>
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
                    <div class="form-group col-md-6">
                        <label for="bill_adminssion_date">   Admission Date    </label>
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
                    <div class="form-group col-md-6">
                        <label for="dos_end">   DOS End     </label>
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
                @php $i=1; @endphp
                <?php for($ii=0; $ii < count($refProviderForEdit); $ii++){ ?>
                    <div class="form-row cloneDivProviderTypeDiv" id="providerDiv_{{$i}}">
                        @if(count($refProviderForEdit) > 0)
                        @if($injuryBillInfo)
                         
                        <div class="form-group col-md-12 providerTypeDiv  id="showProviderDiv_{{$i}}">
                        @else
                        <div class="form-group col-md-12 providerTypeDiv {{($ii ===1) ? '' : 'd-none'}}" id="showProviderDiv_{{$i}}">
                        @endif
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="bill_provider_type">   Provider Type   </label>
                                        <select name="bill_provider_type[]" id="billProviderTypeDrop_{{$i}}"
                                        onchange="removeSelectedOption(event, this.value),getReferningProvider(this.value,{{$injuryId}},'bill_provider_name_'+{{$i}}, 'providerNameDiv_'+{{$i}});" class="form-control proDiv">
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
                                            <select name="bill_provider_name[]" id="bill_provider_name_{{$i}}" class="form-control providename" >

                                            </select>
                                        @if($errors->has('bill_provider_name'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('bill_provider_name') }}</strong>
                                        </span>
                                        @endif
                                </div>
                                <div class="form-group col-md-2 pt-4">
                                    <label>&nbsp;</label>
                                    <span class="pt-5">
                                        <i class="icon-trash showPointer removeItem" id="removeItemId_{{$i}}" onClick="deleteProviderNameIndex(this);"/></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                <?php $i++; }?>
                 @php $ii= (count($refProviderForEdit) > 0 ) ?  count($refProviderForEdit) + 1 : 1;@endphp
                 <?php for($ij=1; $ij <= count($referingOrderProviders); $ij++){ ?>
                <div class="form-row cloneDivProviderTypeDiv" id="providerDiv_{{$ii}}">
                    @if(count($referingOrderProviders) > 0)
                        <div class="form-group col-md-12 providerTypeDiv {{($ij ===1) ? '' : 'd-none'}}" id="showProviderDiv_{{$ij}}">
                            <div class="form-row">
                                <div class="form-group col-md-5">
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
                                    <div class="form-group col-md-2 pt-4" id="removeDivId_{{$ij}}">
                                        <label>&nbsp;</label>
                                        <span class="pt-5">
                                            <i class="icon-trash showPointer pt-2 removeItem" id="removeItemId_{{$ij}}" onClick="deleteProviderNameIndex(this);"/></i>
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
        <div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="diagnosis_code">   Diagnosis Codes</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"  type="radio" {{ ($diagnosesType == 9) ? 'checked' : ''}}
                            name="diagnosis_code_type" id="diagnosis_code1" value="9">
                        <label class="form-check-label" for="diagnosis_code1">ICD-9</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" {{ ($diagnosesType == 10) ? 'checked' : ''}}
                            type="radio" name="diagnosis_code_type" id="diagnosis_code2" value="10">
                        <label class="form-check-label" for="diagnosis_code2">ICD-10</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <fieldset>
                    <legend><span id="icdId">ICD-{{ ($diagnosesType == 9) ? '9' : '10'}}</span> Diagnosis Codes </legend>
                        <div class="form-row cloneDCDiv" id="diagnosesDiv1">
                            @if (count($diagnoses) > 0)
                            @php $dC = ( count($diagnoses) > 0 ) ? count($diagnoses) +1 : 1;
                                @endphp
                                <?php for($j= 1; $j <= count($diagnoses); $j++){?>
                                    <div class="form-group col-md-3 cloneDivDiagnosisCode" id="dio_Code_{{$j}}">
                                        <label for="diagnoses_code1">   &nbsp;   </label>
                                        <select name="work_dg_code_id[]" class="form-control diagnosisCodeSelect addedSelect" id="work_dg_code_id_{{$j}}">
                                            
                                        </select>
                                        @if($errors->has('work_dg_code_id'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('work_dg_code_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                <?php $dC++; }?>
                                @endif
                             @php  if(count($diagnoses) > 4){
                                echo '</div> <div class="form-row cloneDCDiv" id="diagnosesDiv2">';
                             }
                             @endphp  
                        
                             @if ($diagnosis_Codes > 0)
                                @php $dC1 = ( count($diagnoses) > 0 ) ? count($diagnoses) +1 : 1;
                                @endphp
                                <?php for($ji= 1; $ji <= $diagnosis_Codes; $ji++){?>
                                    <div class="form-group col-md-3 cloneDivDiagnosisCode" id="dio_Code_{{$dC1}}">
                                        <label for="diagnoses_code1">   &nbsp;   </label>
                                        <select name="work_dg_code_id[]" class="form-control diagnosisCodeSelect diagnosesCode" id="work_dg_code_id_{{$dC1}}">
                                            
                                        </select>
                                        @if($errors->has('work_dg_code_id'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('work_dg_code_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                <?php $dC1++; }?>
                                @endif
                        </div>
                        <div class="form-row cloneDCDiv" id="diagnosesDiv3">
                        </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <fieldset id="cloneDivStr">
                    <legend><i class="icon-list-ul"></i> Service Line Items </legend>
                    @php $cpdCnt = 1; @endphp
                    @if($injuryBillInfo && $injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices))
                        @php $cpdCnt = (count($injuryBillInfo->getBillServices)  + 1);  
                        $kk =1;
                        @endphp
                        
                        @foreach ($injuryBillInfo->getBillServices as $key =>  $service)
                            <div class="row cloneDiv" id="input_{{$kk}}">
                                <div class=" col-md-2">
                                     <label for="bill_procedure_code">  Procedure Code   </label>
                                        <input placeholder="Procedure Code" data-validation-event="change" data-validation="custom" data-validation-regexp ="^[a-zA-Z0-9]+(\s+[a-zA-Z0-9]+)*$" data-validation-optional="true" data-validation-error-msg="" 
                                        onkeyup='setUnitCodeOnChangeProcedureCode(event,<?php echo count($injuryBillInfo->getBillServices); ?>)' id="bill_procedure_code_{{$kk}}" autocomplete="off" type="text" name="bill_procedure_code[]" 
                                        value="{{$service->bill_procedure_code}}" class="form-control procedure_code_input" maxlength="100">
                                        @if($errors->has('bill_procedure_code'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback" >{{ $errors->first('bill_procedure_code') }}</strong>
                                        </span>
                                        @endif 
                                </div>
                                <div class=" col-md-3">
                                    <label for="bill_modifiers">  Modifiers   </label>
                                    <select name="bill_modifiers[]" onChange='setUnitCodeOnChangeProcedureCode(event,<?php echo $service_lineCnt?>)' class="form-control modefierCode" id="billModifiersId_{{$kk}}" >
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
                                    <input placeholder="Units"  data-validation-event="change" data-validation="custom" data-validation-regexp ="^[0-9]+(\s+[0-9]+)*$" data-validation-optional="true" data-validation-error-msg="" autocomplete="off" id="bill_units{{$kk}}" type="text" name="bill_units[]"  class="form-control bill_unit" maxlength="100"
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
                                            <td><input onKeyup='checkDiagCodesForServices(event,this.value)' placeholder="Diag Code 1" autocomplete="off" type="text" id="bill_diag_codes1{{$kk}}" name="bill_diag_codes1[]" value="{{$service->bill_diag_codes1}}" class="form-control bill_diag_codes1" maxlength="50"></td>
                                            <td><input onKeyup='checkDiagCodesForServices(event,this.value)' placeholder="Diag Code 2" autocomplete="off" type="text" id="bill_diag_codes2{{$kk}}" name="bill_diag_codes2[]" value="{{$service->bill_diag_codes2}}" class="form-control" maxlength="50"></td>
                                            <td><input onKeyup='checkDiagCodesForServices(event,this.value)' placeholder="Diag Code 3" autocomplete="off" type="text" id="bill_diag_codes3{{$kk}}" name="bill_diag_codes3[]" value="{{$service->bill_diag_codes3}}" class="form-control" maxlength="50"></td>
                                            <td><inpu onKeyup='checkDiagCodesForServices(event,this.value)'  placeholder="Diag Code 4" autocomplete="off" type="text" id="bill_diag_codes4{{$kk}}" name="bill_diag_codes4[]" value="{{$service->bill_diag_code4}}" class="form-control" maxlength="50"></td>
                                            <td><a href='javascript:void(0);' class='remove' id="remove_item_icon_{{$kk}}"><i class='icon-trash'></i></a></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" id="showDiagCodeError_{{$kk}}">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-4 pt-1 pl-0">
                                    <input type="text" placeholder="Additional Information" class="form-control"  name="additional_information[]" id="additional_information_{{$kk}}"  data-validation-optional="true" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ " value="{{$service->additional_information}}" >
                                    @if($errors->has('additional_information'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('additional_information') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4 pt-1 pl-0">
                                    <input type="text" placeholder="Unit Amount" class="form-control {{ ($service) ?  ($service->is_master_found == 0 || $service->is_master_found == null ) ? 'd-none' : 'NA' : 'd-none'}}" name="master_charge[]" id="bill_master_charge{{$kk}}" value="{{$service->master_unit_amount}}">
                                </div>
                                <div class="col-md-4 pt-1 pl-0">
                                    <input type="text" class="form-control d-none" name="isMasterChargeFound[]" id="isMasterChargeFound_{{$kk}}" value="{{$service->is_master_found}}">
                                    <input type="text" class="form-control d-none"  name="master_charge_id[]" id="bill_master_charge_id{{$kk}}" value="{{$service->master_procedure_code_charge_id}}">
                                </div>
                            </div>
                             @php    $kk++;  @endphp
                        @endforeach
                    @endif
                        <?php for($i=$cpdCnt; $i <= $service_lineCnt; $i++){?>
                            <div class="row cloneDiv" id="input_{{$i}}">
                                <div class=" col-md-2">
                                        <label for="bill_procedure_code">  Procedure Code   </label>
                                    <input  placeholder="Procedure Code"  data-validation-event="change" data-validation="custom" data-validation-regexp ="^[a-zA-Z0-9]+(\s+[a-zA-Z0-9]+)*$" data-validation-optional="true" data-validation-error-msg="" 
                                    onkeyup='setUnitCodeOnChangeProcedureCode(event,<?php echo $service_lineCnt?>)' id="bill_procedure_code_{{$i}}" autocomplete="off" type="text" name="bill_procedure_code[]" value=""
                                    class="form-control procedure_code_input" maxlength="100">
                                    @if($errors->has('bill_procedure_code'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('bill_procedure_code') }}</strong>
                                    </span>
                                    @endif 
                                </div>
                                <div class=" col-md-1 pt-4 d-none" id="addition_info_icon_{{$i}}">
                                    <span><i class="icon-plus showPointer" onClick="showAdditionalInfoInput('addition_info_div_{{$i}}');"></i></span>
                                </div>
                                <div class=" col-md-2">
                                    <label for="bill_modifiers">  Modifiers   </label>
                                    <select name="bill_modifiers[]" onChange='setUnitCodeOnChangeProcedureCode(event,<?php echo $service_lineCnt?>)' class="form-control modefierCode" id="bill_modifiers{{$i}}" >
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
                                    <input placeholder="Units" data-validation-event="change" data-validation="custom" data-validation-regexp ="^[0-9]+(\s+[0-9]+)*$" data-validation-optional="true" data-validation-error-msg="" autocomplete="off" id="bill_units{{$i}}" type="text" name="bill_units[]" value="" class="form-control bill_unit" maxlength="100">
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
                                            <td><input placeholder="Diag Code 1" onKeyup='checkDiagCodesForServices(event,this.value)' autocomplete="off" type="text" id="billDiagCodes1_{{$i}}" name="bill_diag_codes1[]" value="" class="form-control bill_diag_codes1" maxlength="50"></td>
                                            <td><input placeholder="Diag Code 2" onKeyup='checkDiagCodesForServices(event,this.value)' autocomplete="off" type="text" id="billDiagCodes2_{{$i}}" name="bill_diag_codes2[]" value="" class="form-control" maxlength="50"></td>
                                            <td><input placeholder="Diag Code 3" onKeyup='checkDiagCodesForServices(event,this.value)' autocomplete="off" type="text" id="billDiagCodes3_{{$i}}" name="bill_diag_codes3[]" value="" class="form-control" maxlength="50"></td>
                                            <td><input placeholder="Diag Code 4" onKeyup='checkDiagCodesForServices(event,this.value)' autocomplete="off" type="text" id="billDiagCodes4_{{$i}}" name="bill_diag_codes4[]" value="" class="form-control" maxlength="50"></td>
                                            <td><a id="remove_item_icon_{{$i}}" href='javascript:void(0);' class='remove'><i class='icon-trash'></i></a></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" id="showDiagCodeError_{{$i}}">
                                            </td>
                                        </tr>
                                    </table>
                                </div> 
                                <div class="col-md-4 pt-1 pl-0 d-none" id="addition_info_div_{{$i}}">
                                    <input type="text" placeholder="Additional Information" class="form-control"  name="additional_information[]" id="additional_information_{{$i}}"  data-validation-optional="true" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ ">
                                    @if($errors->has('additional_information'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback" >{{ $errors->first('additional_information') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4 pt-1 pl-0">
                                    <input type="text" class="form-control d-none" name="isMasterChargeFound[]" id="isMasterChargeFound{{$i}}" value="">
                                    <input placeholder="Unit Amount" type="text" class="form-control d-none" name="master_charge[]" id="bill_master_charge{{$i}}" value="">
                                </div>
                                <div class="col-md-4 pt-1 pl-0">
                                    <input type="text" class="form-control d-none" name="master_charge_id[]" id="bill_master_charge_id{{$i}}" value="">
                                </div>
                            </div>
                        <?php }?>
                </fieldset>
            </div>
        </div>
