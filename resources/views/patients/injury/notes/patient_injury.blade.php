                                    <style>
                                        .input-icons i {
                                        position: absolute;
                                        }

                                        .input-icons  input{
                                        width: 100%;
                                        margin-bottom: 10px;
                                        }
                                    </style>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off"  type="radio" onClick="showHideInjuryDiv(this.value)" class="custom-control-input"
                                                        name="financial_class" id="injuryType1" {{ ($pInjuries) ? ($pInjuries->financial_class == 1) ? 'checked' : '' : 'checked'}} value="1">
                                                        <label class="custom-control-label" for="injuryType1">Worker Comp.</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off"  type="radio" onClick="showHideInjuryDiv(this.value)" class="custom-control-input" name="financial_class" id="injuryType2"  {{ ($pInjuries) ?  ($pInjuries->financial_class == 2) ?  'checked' : '' : ''}} value="2">
                                                        <label class="custom-control-label" for="injuryType2">Private / Government</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off"  type="radio" onClick="showHideInjuryDiv(this.value)" class="custom-control-input" name="financial_class"  id="injuryType3"  {{ ($pInjuries) ?  ($pInjuries->financial_class == 3) ?  'checked' : '' : ''}} value="3">
                                                        <label class="custom-control-label" for="injuryType3">Personal Injury</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                    <div class="row d-none" id="workerCompId">
                                        <div class="col-12">
                                            <div class="form-row">
                                                <input autocomplete="off"  type="hidden" name="patient_id" value="{{$patientId}}" class="form-control" >
                                                <input autocomplete="off"  type="hidden" name="injuryId" value="{{$injuryId}}" class="form-control" >
                                                <div class="form-group col-md-6">
                                                    <label for="description">Injury Description <span class="required">* </span> </label>
                                                    <input type="text" data-validation-event="change" data-validation="required"
                                                    data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ "  data-validation-error-msg="" id="description"  class="form-control" name="description" {{($pInjuries) ? $pInjuries->description : ''}}>
                                                    @if($errors->has('description'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('description') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="stateDD">State </label>
                                                    <select name="injury_state_id" class="form-control searcDrop" id="injury_state_id" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($states as $state)
                                                        <option value="{{$state["state_name"]}}" {{ ($pInjuries) ?
                                                            ($pInjuries->injury_state_id == $state["state_name"]) ? "selected" :  " " :  " " }}> {{$state["state_name"]}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('injury_state_id'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('injury_state_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="employer_name"> Employer </label>
                                                    <input autocomplete="off"  type="text" name="employer_name" data-validation-event="change" data-validation="required" data-validation-error-msg="" value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->employer_name : '' : ''}}" class="form-control" maxlength="100">
                                                    @if($errors->has('employer_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('employer_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                            <div class="form-group col-md-6">
                                                    <label for="start_date_injury"> Injury Start Date </label>
                                                    <div class="input-icons">
                                                        <input autocomplete="off"  autocomplete="off" type="text"  data-validation-event="change" data-validation="required"
                                                        name="start_date" id="start_date_injury"
                                                        value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->start_date : '' : ''}}"
                                                            class="form-control" maxlength="100">
                                                            <i class="icon-calendar form-control-feedback"></i>
                                                    </div>
                                                       @if($errors->has('start_date'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong class="invalid-feedback" >{{ $errors->first('start_date') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            <div class="form-group col-md-3" style="padding-top:35Px;">
                                                    <label for="cumulative-trauma1"> Cumulative Trauma </label>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off"  type="radio" class="custom-control-input" name="cumulative_trauma" onClick="showHideInjuryDate(this.value)" id="cumulative-trauma1"
                                                        value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->is_cumulative : '' : ''}}">
                                                        <label class="custom-control-label" for="cumulative-trauma1">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off"  type="radio" class="custom-control-input" name="cumulative_trauma"  id="cumulative-trauma2"  checked="" onClick="showHideInjuryDate(this.value)"
                                                        value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->is_cumulative : '' : ''}}">
                                                        <label class="custom-control-label" for="cumulative-trauma2">No</label>
                                                    </div>
                                                </div>
                                            <div class="form-group col-md-3 d-none" id="injury-end-date-divId">
                                                    <label for="injury-end-date">   Injury End Date    </label>
                                                        <input autocomplete="off"  autocomplete="off" type="text"  data-validation-event="change" data-validation="required"   name="injury_end_date" id="injury-end-date"
                                                        value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->end_date : '' : ''}}"
                                                        class="form-control" maxlength="100">
                                                        <i class="facalendar icon-calendar"></i>
                                                        @if($errors->has('injury_end_date'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong class="invalid-feedback" >{{ $errors->first('injury_end_date') }}</strong>
                                                            </span>
                                                        @endif
                                                </div>
                                            </div>    
                                            
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="claim_admin_id"> Claims Administrator </label>
                                                    <select name="claim_admin_id" class="form-control searcDrop" id="claim_admin_id" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                        <option value="">Select</option>
                                                        @foreach ($claimsAdministers as $claimAdmin)
                                                        <option value="{{$claimAdmin->id}}" {{($pInjuries) ? ($pInjuries->getInjuryClaim->claim_admin_id === $claimAdmin->id) ? 'selected' : '' : ''}}> {{$claimAdmin->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('claim_admin_id'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('claim_admin_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2" style="margin-top:-5px; margin-left:0px;">
                                                    <label for="claim_admin_id" class="pt-4">  &nbsp;</label>
                                                    <div class="custom-control custom-control custom-checkbox custom-control-inline">
                                                        <input autocomplete="off"  type="checkbox" class="custom-control-input"  name="no_any_claim1" id="no_any_claim_id"
                                                        value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->no_any_claim : 0 : 0}}">
                                                        <label class="custom-control-label checkbox-primary" for="no_any_claim_id">None</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                              <div class="form-group col-md-4">
                                                    <label for="claim_no"> Claim Number </label>
                                                    <input autocomplete="off"  type="text" name="claim_no" data-validation-event="change" data-validation="required number" id="claim_no" class="form-control" maxlength="100"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->claim_no : '' : ''}}">
                                                    @if($errors->has('claim_no'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong class="invalid-feedback" >{{ $errors->first('claim_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="claim_admin_id"> Claim Status </label>
                                                    <select name="claim_status" class="form-control searcDrop" id="claim_status" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                    </select>
                                                    @if($errors->has('claim_status'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('claim_status') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="injury-end-date"> Claim Status Date </label>
                                                    <input autocomplete="off"  type="text" data-validation-event="change" data-validation="required date" id="claim_status_dateId"   name="claim_status_date" class="form-control" maxlength="100"
                                                    value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->claim_status_date : '' : ''}}">
                                                    @if($errors->has('claim_status_date'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong class="invalid-feedback" >{{ $errors->first('claim_status_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>  
                                                
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="injury-end-date">ADJ Number</label>
                                                    <input autocomplete="off"  type="text" data-validation-event="change" data-validation="required number" id="adj_number"  name="adj_number"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->adj_no : '' : ''}}" class="form-control" maxlength="100">
                                                    @if($errors->has('adj_number'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong class="invalid-feedback" >{{ $errors->first('adj_number') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-group col-md-4">
                                                    <label for="injury-end-date">Practice Internal ID </label>
                                                    <input autocomplete="off"  type="text" data-validation-event="change" data-validation="required number" id="adj_number"  name="adj_number"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->adj_no : '' : ''}}" class="form-control" maxlength="100">
                                                    @if($errors->has('adj_number'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong class="invalid-feedback" >{{ $errors->first('adj_number') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-group col-md-3">
                                                    <label for="claim_admin_id"> Medical Provider Network </label>
                                                    <select name="medical_provider_network" class="form-control searcDrop" id="medical_provider_network" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                    @foreach ($medical_providers as $medical_provider)
                                                    <option value="{{$medical_provider->id}}" {{($pInjuries) ? ($pInjuries->getInjuryClaim->medical_provider_id === $medical_provider->id) ? 'selected' : '' : ''}}> {{$medical_provider->applicant_name}}</option>
                                                    @endforeach
                                                    </select>
                                                    @if($errors->has('medical_provider_network'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('medical_provider_network') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-1" style="margin-top:-5px; margin-left:0px;">
                                                    <label for="claim_admin_id" class="pt-4">   &nbsp;</label>
                                                    <div class="custom-control custom-control custom-checkbox custom-control-inline">
                                                        <input autocomplete="off"  type="checkbox" class="custom-control-input"  name="no_any_network" id="no_any_network_id"
                                                        value="0">
                                                        <label class="custom-control-label checkbox-primary" for="no_any_network_id">None</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <fieldset>
                                                <legend>Employer Address</legend>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="address_line1"> Address Line1 <span class="required">* </span>  </label>
                                                            <input type="text" name="address_line1" class="form-control" style="resize: none;" data-validation-event="change" data-validation="required"
                                                            data-validation-error-msg="" {{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->emp_address_line1 : '' : ''}}>
                                                            @if($errors->has('address_line1'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong>{{ $errors->first('address_line1') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="address_line2"> Address Line2 </label>
                                                            <input type="text" name="address_line2" class="form-control" style="resize: none;" {{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->emp_address_line2 : '' : ''}}>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-4">
                                                            <label for="zipcode"> Zip code </label>
                                                            <input onKeyUp="getStatesByZipCode(this.value);" autocomplete="off"  type="text" name="zipcode"
                                                            class="form-control" data-validation-event="change" data-validation="number"
                                                            data-validation-error-msg="" maxlength="10" value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->emp_zipcode : '' : '' }}">
                                                            @if($errors->has('zipcode'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong>{{ $errors->first('zipcode') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="state_id"> State  <span class="required">* </span> </label>
                                                            <select name="state_id" class="form-control searcDrop stateDD" id="stateDD" data-validation-event="change" data-validation="required"
                                                                data-validation-error-msg="">
                                                                    <option value="" class="option">Select</option>
                                                                    @foreach ($states as $state)
                                                                    <option value="{{$state["state_name"]}}"
                                                                    {{($pInjuries) ? ($pInjuries->getInjuryClaim->emp_state_id == $state["state_name"]) ? 'selected' : '' : '' }}> {{$state["state_name"]}}</option>
                                                                    @endforeach
                                                                </select>
                                                            @if($errors->has('state_id'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong>{{ $errors->first('state_id') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="city_id"> City  <span class="required">* </span> </label>
                                                            <input type="text" name="city_id" id="cityDD" class="form-control cityDD"
                                                            value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->emp_city_id : '' : '' }}"
                                                             maxlength="55">
                                                        </div>

                                                    </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>ICD-10 Diagnosis Codes <?php print_r($dCode);?></legend>
                                                    <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                            <label for="diagnoses_code1"> &nbsp; </label>
                                                            <select name="work_dg_code_id[0][value]" class="form-control searcDrop" data-show-subtext="true" data-live-search="true"
                                                             id="work_dg_code_id" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                @foreach ($diagnoses as $diagnosis)
                                                                <?php $i=1;?>
                                                                <option value="{{$diagnosis->id}}"
                                                                <?php if ( in_array( $diagnosis->id, $dCode ) ) { echo "selected"; }  else { echo " "; }?>
                                                                >{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('diagnoses_code1'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong class="invalid-feedback" >{{ $errors->first('diagnoses_code1') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="diagnoses_code2">   &nbsp;   </label>
                                                            <select name="work_dg_code_id[1][value]" class="form-control searcDrop" id="diagnoses_code2" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                @foreach ($diagnoses as $diagnosis)
                                                                <option value="{{$diagnosis->id}}" >{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('diagnoses_code2'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong class="invalid-feedback" >{{ $errors->first('diagnoses_code2') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="diagnoses_code3">   &nbsp; </label>
                                                            <select name="work_dg_code_id[2][value]" class="form-control searcDrop" id="diagnoses_code3" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                @foreach ($diagnoses as $diagnosis)
                                                                <option value="{{$diagnosis->id}}" {{($pInjuries) ? ($pInjuries->getInjuryClaim) ? 'selected' : '' : '' }}>{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('diagnoses_code3'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong class="invalid-feedback" >{{ $errors->first('diagnoses_code3') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <label for="diagnoses_code4">   &nbsp;   </label>
                                                            <select name="work_dg_code_id[3][value]"class="form-control searcDrop" id="diagnoses_code4" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                @foreach ($diagnoses as $diagnosis)
                                                                <option value="{{$diagnosis->id}}" {{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? 'selected' : '' : '' }}>{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if($errors->has('diagnoses_code4'))
                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                <strong class="invalid-feedback" >{{ $errors->first('diagnoses_code4') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="privateGovId">
                                        <div class="col-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="description2">  Injury Description <span class="required">* </span>     </label>
                                                    <textarea data-validation-event="change" data-validation="required" data-validation-error-msg="" id="description2"  class="form-control" name="description2" >{{ ($pInjuries) ? ($pInjuries->description) ? $pInjuries->description : '' : ''}} </textarea>
                                                    @if($errors->has('description2'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('description2') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="stateDD">State </label>
                                                    <select name="injury_state_id2" class="form-control" id="injury_state_id2" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($states as $state)
                                                        <option value="{{$state["state_name"]}}" {{ ($pInjuries) ?
                                                            ($pInjuries->injury_state_id == $state["state_name"]) ? "selected" :  " " :  " " }}> {{$state["state_name"]}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('injury_state_id2'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('injury_state_id2') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="">   Insurance Payer      </label>
                                                    <input autocomplete="off"  type="text" name="ins_payer" id="ins_payer" class="form-control" value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->ins_payer : '' : '' }}">
                                                    @if($errors->has('ins_payer'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('ins_payer') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">   Subscriber ID      </label>
                                                    <input autocomplete="off"  type="text" name="ins_subscriber" id="ins_subscriber" class="form-control" maxlength="25"
                                                    value="{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->ins_subscriber: ''  : ''}}">
                                                    @if($errors->has('ins_subscriber'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('ins_subscriber') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="ins_group_no">   Group No.      </label>
                                                    <input autocomplete="off"  type="text" name="ins_group_no" id="ins_group_no" class="form-control" maxlength="25"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->ins_group_no : '' : '' }}">
                                                    @if($errors->has('ins_group_no'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('ins_group_no') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="ins_deduct_amt">   Deductible Amt.      </label>
                                                    <input autocomplete="off"  type="text" name="ins_deduct_amt" id="ins_deduct_amt" class="form-control" maxlength="10"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->ins_deduct_amt : '' : '' }}">
                                                    @if($errors->has('ins_deduct_amt'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('ins_deduct_amt') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="ins_copay_amt">   Co-payment Amt.     </label>
                                                    <input autocomplete="off"  type="text" name="ins_copay_amt" id="ins_copay_amt" class="form-control" maxlength="10">
                                                    @if($errors->has('ins_copay_amt'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('ins_copay_amt') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">  Co-Insurance Amt.     </label>
                                                    <input autocomplete="off"  type="text" name="ins_coins_amt" id="ins_coins_amt" class="form-control" maxlength="10">
                                                    @if($errors->has('ins_coins_amt'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('ins_coins_amt') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                            <div class="form-holder col-md-6">
                                                <label for="ins_authinfo"> Authorization Info.</label>
                                                <textarea class="form-control" name="ins_authinfo" id="ins_authinfo" style="resize:none;" >{{($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->ins_authinfo : '' : '' }}</textarea>
                                                @if($errors->has('ins_authinfo'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong class="invalid-feedback" >{{ $errors->first('ins_authinfo') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-holder col-md-6">
                                                <label for="ins_no_of_visit"> No. of visit authorized </label>
                                                <input autocomplete="off"  type="text" name="ins_no_of_visit" id="ins_no_of_visit" class="form-control" maxlength="3"
                                                value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->ins_no_of_visit : '' : '' }}">
                                                @if($errors->has('ins_no_of_visit'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('ins_no_of_visit') }}</strong>
                                                    </span>
                                                    @endif
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="personalDivId">
                                        <div class="col-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="description3">  Injury Description <span class="required">* </span> </label>
                                                    <textarea data-validation-event="change" data-validation="required" data-validation-error-msg="" id="description3"  class="form-control" name="description3" >{{  ($pInjuries) ? ($pInjuries->description) ? $pInjuries->description : '' : '' }} </textarea>
                                                    @if($errors->has('description3'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('description3') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="stateDD"> State </label>
                                                    <select name="injury_state_id3" class="form-control" id="injury_state_id3" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($states as $state)
                                                        <option value="{{$state["state_name"]}}" {{ ($pInjuries) ?
                                                            ($pInjuries->injury_state_id == $state["state_name"]) ? "selected" :  " " :  " " }}> {{$state["state_name"]}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('injury_state_id3'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('injury_state_id3') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="p_attorney_name"> Attorney Name </label>
                                                    <input autocomplete="off"  type="text" name="p_attorney_name" id="p_attorney_name" class="form-control"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_attorney_name : '' : '' }}">
                                                    @if($errors->has('p_attorney_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('p_attorney_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="p_payer_name">   Payer Name      </label>
                                                    <input autocomplete="off"  type="text" name="p_payer_name" id="p_payer_name" class="form-control"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_payer_name : '' : '' }}">
                                                    @if($errors->has('p_payer_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('p_payer_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="p_law_officer_name">   Law Officer Name      </label>
                                                    <input autocomplete="off"  type="text" name="p_law_officer_name" id="p_law_officer_name" class="form-control"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_law_officer_name : '' : '' }}">
                                                    @if($errors->has('p_law_officer_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('p_law_officer_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="p_injury_date">   Date of Injury      </label>
                                                    <input autocomplete="off"  type="date" name="p_injury_date" id="p_injury_date" class="form-control"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_injury_date : '' : '' }}">
                                                    @if($errors->has('p_injury_date'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('p_injury_date') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="p_claim_id">   Claim ID   </label>
                                                    <input autocomplete="off"  type="text" name="p_claim_id" id="p_claim_id" class="form-control"
                                                    value="{{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_claim_id : '' : '' }}">
                                                    @if($errors->has('p_claim_id'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('p_claim_id') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="p_ssn_no">   SSN      </label>
                                                    <input autocomplete="off"  type="text" name="p_ssn_no" id="p_ssn_no" class="form-control"
                                                    value="{{  ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_ssn_no : '' : '' }}">
                                                    @if($errors->has('p_ssn_no'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('p_ssn_no') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="p_handle_attorn_individual">   Handling Attorney Individual      </label>
                                                    <input autocomplete="off"  type="text" name="p_handle_attorn_individual" id="p_handle_attorn_individual" class="form-control"
                                                    value="{{($pInjuries) ?  ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_handle_attorn_individual : '' : '' }}">
                                                    @if($errors->has('p_handle_attorn_individual'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('p_handle_attorn_individual') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="p_contact_no">   Contact No.      </label>
                                                    <input autocomplete="off"  type="text" name="p_contact_no" id="p_contact_no" class="form-control" maxlength="15"
                                                    value="{{ ($pInjuries) ?  ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_contact_no : '' : '' }}">
                                                    @if($errors->has('p_contact_no'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('p_contact_no') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="p_others">   Others      </label>
                                                    <input autocomplete="off"  type="text" name="p_others" id="p_others" class="form-control"  maxlength="25"
                                                    value="{{ ($pInjuries) ?  ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_others : '' : ''}}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <fieldset>
                                                        <legend>Employer Address</legend>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="p_address_line1">   Address Line1   <span class="required">* </span>  </label>
                                                                <textarea name="p_address_line1" class="form-control" style="resize: none;" data-validation-event="change" data-validation="required"
                                                                data-validation-error-msg="">{{ ($pInjuries) ?  ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_address_line1  : '' : '' }}</textarea>
                                                                @if($errors->has('p_address_line1'))
                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                    <strong>{{ $errors->first('p_address_line1') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="p_address_line2">   Address Line2     </label>
                                                                <textarea name="p_address_line2" class="form-control" style="resize: none;">
                                                                {{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_address_line2 : '' : '' }}
                                                            </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="p_state_id"> State  <span class="required">* </span> </label>
                                                                <select name="p_state_id" class="form-control" id="stateDD" data-validation-event="change" data-validation="required"
                                                                data-validation-error-msg="">
                                                                    <option value="" class="option">Select</option>
                                                                    @foreach ($states as $state)
                                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if($errors->has('p_state_id'))
                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                    <strong>{{ $errors->first('p_state_id') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="p_city_id"> City  <span class="required">* </span> </label>
                                                                <select name="p_city_id" class="form-control" id="cityDD">
                                                                    <option value="" class="option">Select</option>
                                                                </select>
                                                                @if($errors->has('p_city_id'))
                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                    <strong>{{ $errors->first('p_city_id') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="p_zipcode"> Zip code </label>
                                                                <input autocomplete="off" type="text" name="p_zipcode" class="form-control" data-validation-event="change" data-validation="number length"
                                                                data-validation-length="1-10" data-validation-optional="true"
                                                                data-validation-error-msg="" maxlength="10" {{ ($pInjuries) ? ($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->p_zipcode : '' : '' }}>
                                                                @if($errors->has('p_zipcode'))
                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                    <strong>{{ $errors->first('p_zipcode') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

