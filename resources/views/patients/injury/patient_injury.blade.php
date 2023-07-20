                                    <style>
                                        .input-icons i {
                                            position: absolute;
                                        }

                                        .input-icons input {
                                            width: 100%;
                                            margin-bottom: 10px;
                                        }

                                        .card {
                                            position: relative;
                                            display: -ms-flexbox;
                                            display: flex;
                                            -ms-flex-direction: column;
                                            flex-direction: column;
                                            min-width: 0;
                                            word-wrap: break-word;
                                            background-color: #fff;
                                            background-clip: border-box;
                                            border: 1px solid rgba(0, 0, 0, .125);
                                            border-radius: .25rem;
                                        }

                                        .card-header:first-child {
                                            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
                                        }

                                        .card-header {
                                            padding: .75rem 1.25rem;
                                            margin-bottom: 0;
                                            background-color: rgba(0, 0, 0, .03);
                                            border-bottom: 1px solid rgba(0, 0, 0, .125);
                                        }

                                        .card-body {
                                            -ms-flex: 1 1 auto;
                                            flex: 1 1 auto;
                                            padding: 1.25rem;
                                        }

                                        #contactTbleId .table td {
                                            padding: 0px !important;
                                        }

                                        #contactTbleId .table th {
                                            padding: 4px !important;
                                        }
                                    </style>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off" type="radio"
                                                            onClick="showHideInjuryDiv(this.value)"
                                                            class="custom-control-input" name="financial_class"
                                                            id="injuryType1"
                                                            {{ $pInjuries ? ($pInjuries->financial_class == 1 ? 'checked' : '') : 'checked' }}
                                                            value="1">
                                                        <label class="custom-control-label" for="injuryType1">Worker
                                                            Comp.</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off" type="radio"
                                                            onClick="showHideInjuryDiv(this.value)"
                                                            class="custom-control-input" name="financial_class"
                                                            id="injuryType2"
                                                            {{ $pInjuries ? ($pInjuries->financial_class == 2 ? 'checked' : '') : '' }}
                                                            value="2">
                                                        <label class="custom-control-label" for="injuryType2">Private /
                                                            Government</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off" type="radio"
                                                            onClick="showHideInjuryDiv(this.value)"
                                                            class="custom-control-input" name="financial_class"
                                                            id="injuryType3"
                                                            {{ $pInjuries ? ($pInjuries->financial_class == 3 ? 'checked' : '') : '' }}
                                                            value="3">
                                                        <label class="custom-control-label" for="injuryType3">Personal
                                                            Injury</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="workerCompId">
                                        <div class="col-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="description">Injury Description <span class="required">*
                                                        </span> </label>
                                                    <input type="text" data-validation-event="change" data-validation="required"  data-validation-error-msg="" id="description" class="form-control" name="description"
                                                        value="{{ $pInjuries ? $pInjuries->description : '' }}">
                                                    @if ($errors->has('description'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="injury_state_id">State </label>
                                                    <select name="injury_state_id" class="form-control"
                                                        id="injury_state_id">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state['state_name'] }}"
                                                                {{ $pInjuries ? ($pInjuries->injury_state_id == $state['state_name'] ? 'selected' : '') : ('California' == $state['state_name'] ? 'selected' : ' ') }}>
                                                                {{ $state['state_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('injury_state_id'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('injury_state_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="employer_name"> Employer <span class="required">*
                                                        </span></label>
                                                    <input autocomplete="off" data-validation-event="change" data-validation="required" data-validation-error-msg=""
                                                        type="text" name="employer_name"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->employer_name : '') : '' }}"
                                                        class="form-control" maxlength="100">
                                                    @if ($errors->has('employer_name'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('employer_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4"
                                                    style="margin-top:-5px; margin-left:0px;">
                                                    <label for="employer_name_address" class="pt-4"> Employer Address
                                                        (Optional)</label>
                                                    <div
                                                        class="custom-control custom-control custom-checkbox custom-control-inline">
                                                        <input autocomplete="off" type="checkbox"
                                                            {{ ($pInjuries && $pInjuries->getInjuryClaim &&$pInjuries->getInjuryClaim->is_employer_address_optional == 1) ? 'checked' : '' }}
                                                            class="custom-control-input" name="employer_name_address"
                                                            id="employer_name_address" value="1">
                                                        <label class="custom-control-label checkbox-primary"
                                                            for="employer_name_address">Yes</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="start_date_injury"> Injury Start Date </label>
                                                    <div class="input-icons">
                                                        <input autocomplete="off" data-validation-event="change"
                                                            data-validation="required date"
                                                            data-validation-format="mm/dd/yyyy"
                                                            data-validation-error-msg="" autocomplete="off"
                                                            name="start_date" id="start_date_injury"
                                                            value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? date('m/d/Y', strtotime($pInjuries->getInjuryClaim->start_date)) : '') : '' }}"
                                                            class="form-control" maxlength="100">
                                                        <i class="icon-calendar form-control-feedback"></i>
                                                    </div>
                                                    @if ($errors->has('start_date'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('start_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-3" style="padding-top:35Px;">
                                                    <label for="cumulative-trauma1"> Cumulative Trauma </label>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off" type="radio"
                                                            class="custom-control-input" name="cumulative_trauma"
                                                            onClick="showHideInjuryDate(this.value)"
                                                            id="cumulative-trauma1"
                                                            value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->is_cumulative : '') : 1 }}">
                                                        <label class="custom-control-label"
                                                            for="cumulative-trauma1">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input autocomplete="off" type="radio"
                                                            class="custom-control-input" name="cumulative_trauma"
                                                            id="cumulative-trauma2" checked=""
                                                            onClick="showHideInjuryDate(this.value)"
                                                            value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->is_cumulative : '') : 2 }}">
                                                        <label class="custom-control-label"
                                                            for="cumulative-trauma2">No</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-3 d-none" id="injury-end-date-divId">
                                                    <label for="injury-end-date"> Injury End Date </label>
                                                    <input autocomplete="off" data-validation-event="change"
                                                        data-validation="date" data-validation-optional="true"
                                                        data-validation-format="mm/dd/yyyy"
                                                        data-validation-error-msg="" autocomplete="off"
                                                        type="text" name="injury_end_date" id="injury-end-date"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? date('m/d/Y', strtotime($pInjuries->getInjuryClaim->end_date)) : '') : '' }}"
                                                        class="form-control" maxlength="100">
                                                    <i class="facalendar icon-calendar"></i>
                                                    @if ($errors->has('injury_end_date'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('injury_end_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="claim_admin_id"> Claims Administrator </label>
                                                    <select name="claim_admin_id" class="form-control"
                                                        id="claim_admin_id" data-validation-event="change"
                                                        data-validation="required" data-validation-error-msg="">
                                                        <option value="">Select</option>
                                                        @foreach ($claimsAdministers as $claimAdmin)
                                                            <option value="{{ $claimAdmin->id }}"
                                                                {{ $pInjuries ? ($pInjuries->getInjuryClaim ? ($pInjuries->getInjuryClaim->claim_admin_id == $claimAdmin->id ? 'selected' : '') : '') : '' }}>
                                                                {{ $claimAdmin->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('claim_admin_id'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('claim_admin_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2"
                                                    style="margin-top:-5px; margin-left:0px;">
                                                    <label for="claim_admin_id" class="pt-4"> &nbsp;</label>
                                                    <div
                                                        class="custom-control custom-control custom-checkbox custom-control-inline">
                                                        <input autocomplete="off" type="checkbox"
                                                            class="custom-control-input" name="no_any_claim1"
                                                            id="no_any_claim_id"
                                                            value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->no_any_claim : 0) : 0 }}">
                                                        <label class="custom-control-label checkbox-primary"
                                                            for="no_any_claim_id">None</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="claim_no"> Claim Number  </label>
                                                    <input autocomplete="off" type="text" name="claim_no"
                                                        data-validation-optional="true" data-validation-event="change"
                                                        data-validation="required, alphanumeric"
                                                        data-validation-allowing="-_ " id="claim_no"
                                                        class="form-control" maxlength="100"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->claim_no : '') : '' }}">
                                                    @if ($errors->has('claim_no'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('claim_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="claim_admin_id"> Claim Status </label>
                                                    <select name="claim_status" class="form-control searcDrop"
                                                        id="claim_status">
                                                        <option value="">-Select-</option>
                                                        @foreach ($claimStatus as $status)
                                                            <option value="{{ $status['claim_status'] }}"
                                                                {{ $pInjuries ? ($pInjuries->getInjuryClaim ? ($pInjuries->getInjuryClaim->claim_status_id === $status['claim_status'] ? 'selected' : '') : '') : '' }}>
                                                                {{ $status['claim_status'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('claim_status'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('claim_status') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4" id="showClaimStatusDate">
                                                    <label for="injury-end-date"> Claim Status Date </label>
                                                    <input autocomplete="off" type="text"
                                                        data-validation-event="change" data-validation="date"
                                                        data-validation-optional="true"
                                                        data-validation-format="mm/dd/yyyy" id="claim_status_dateId"
                                                        name="claim_status_date" class="form-control" maxlength="100"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? date('m/d/Y', strtotime($pInjuries->getInjuryClaim->claim_status_date)) : '') : '' }}">
                                                    @if ($errors->has('claim_status_date'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('claim_status_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="injury-end-date">ADJ Number</label>
                                                    <input data-validation-optional="true"
                                                        data-validation-event="change"
                                                        data-validation="required, alphanumeric"
                                                        data-validation-allowing="-_ " autocomplete="off"
                                                        type="text" id="adj_number" name="adj_number"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->adj_no : '') : '' }}"
                                                        class="form-control" maxlength="50">
                                                    @if ($errors->has('adj_number'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('adj_number') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="injury-end-date">Practice Internal ID </label>
                                                    <input autocomplete="off" type="text" id="practiceInternalId"
                                                        name="practiceInternalId"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->adj_no : '') : '' }}"
                                                        class="form-control" maxlength="100">
                                                    @if ($errors->has('practiceInternalId'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('practiceInternalId') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="claim_admin_id"> Medical Provider Network </label>
                                                    <span class="btn btn-primary" id="labelMedicalNetworkList"
                                                        data-toggle="modal"
                                                        data-target="#medicalNetworkProviderModal">Select Medical
                                                        Provider Network </span>
                                                    <span id="medical_provider_name"></span>
                                                    <input type="hidden" name="medical_provider_network"
                                                        class="form-control" id="medical_provider_network">

                                                </div>
                                                <div class="form-group col-md-1"
                                                    style="margin-top:-5px; margin-left:0px;">
                                                    <label for="claim_admin_id" class="pt-4"> &nbsp;</label>
                                                    <div
                                                        class="custom-control custom-control custom-checkbox custom-control-inline">
                                                        <input autocomplete="off" type="checkbox"
                                                            class="custom-control-input" name="no_any_network"
                                                            id="no_any_network_id" value="0">
                                                        <label class="custom-control-label checkbox-primary"
                                                            for="no_any_network_id">None</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <fieldset id="showEmployerAddressDiv" class="d-none">
                                                        <legend>Employer Address</legend>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="address_line1"> Address Line1
                                                                    <span class="required d-none"
                                                                        id="addressAstrixSpan">*
                                                                    </span> </label>
                                                                <input type="text" data-validation-event="change"
                                                                    data-validation="alphanumeric"
                                                                    data-validation-allowing="-_ "
                                                                    data-validation-optional="true"
                                                                    name="address_line1" id="address_line1"
                                                                    class="form-control" style="resize: none;"
                                                                    value="{{ ($pInjuries && $pInjuries->getInjuryClaim)  ? $pInjuries->getInjuryClaim->emp_address_line1 : '' }}">
                                                                @if ($errors->has('address_line1'))
                                                                    <span class="invalid-feedback"
                                                                        style="display:block" role="alert">
                                                                        <strong>{{ $errors->first('address_line1') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="address_line2"> Address Line2</label>
                                                                <input type="text" data-validation-event="change"
                                                                    data-validation="alphanumeric"
                                                                    data-validation-allowing="-_ "
                                                                    data-validation-optional="true"
                                                                    name="address_line2" class="form-control"
                                                                    style="resize: none;"
                                                                    value="{{ ($pInjuries && $pInjuries->getInjuryClaim)  ? $pInjuries->getInjuryClaim->emp_address_line2 : '' }}">

                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="zipcode"> Zip code </label>
                                                                <input
                                                                    onKeyUp="getStatesByZipCode(this.value,'stateDD','cityDD');"
                                                                    autocomplete="off" type="text" name="zipcode"
                                                                    class="form-control" maxlength="10"
                                                                    value="{{ ($pInjuries && $pInjuries->getInjuryClaim )  ? $pInjuries->getInjuryClaim->emp_zipcode : '' }}">
                                                                @if ($errors->has('zipcode'))
                                                                    <span class="invalid-feedback"
                                                                        style="display:block" role="alert">
                                                                        <strong>{{ $errors->first('zipcode') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="state_id"> State</label>
                                                                <select name="state_id" class="form-control stateDD"
                                                                    id="stateDD">
                                                                    <option value="" class="option">Select
                                                                    </option>
                                                                    @foreach ($states as $state)
                                                                        <option value="{{ $state['state_name'] }}"
                                                                            {{ $pInjuries ? ($pInjuries->getInjuryClaim ? ($pInjuries->getInjuryClaim->emp_state_id == $state['state_name'] ? 'selected' : '') : '') : ' ' }}>
                                                                            {{ $state['state_name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('state_id'))
                                                                    <span class="invalid-feedback"
                                                                        style="display:block" role="alert">
                                                                        <strong>{{ $errors->first('state_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="city_id"> City </label>
                                                                <input type="text" name="city_id" id="cityDD"
                                                                    class="form-control cityDD"
                                                                    value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->emp_city_id : '') : '' }}"
                                                                    maxlength="55">
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col-sm-12">
                                                    <fieldset>
                                                        <legend>ICD-10 Diagnosis Codes</legend>
                                                        <div class="form-row" id="diagnosisCodeContainer">
                                                            @php $addedDia = count($selectedDianos);
                                                            $totalCnt = 4;
                                                            $leftCnt = ($totalCnt - $addedDia ) + 1;
                                                            @endphp
                                                            @for ($i = 1; $i <= $leftCnt; $i++)
                                                                <div class="form-group col-md-3">
                                                                    <label for="diagnoses_code1"> &nbsp; </label>
                                                                    <select name="work_dg_code_id[]" class="form-control injuryDiagnosesCode" id="work_dg_code_id_{{ $i }}"> 
                                                                    </select>
                                                                    @if ($errors->has('diagnoses_code1'))
                                                                        <span class="invalid-feedback"
                                                                            style="display:block" role="alert">
                                                                            <strong
                                                                                class="invalid-feedback">{{ $errors->first('diagnoses_code1') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            @endfor
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if ($pInjuries)
                                                    <div class="col-sm-12">
                                                        @if (count($pInjuries->getInjuryContacts) > 0)
                                                            <div class="card">
                                                                <div class="card-header">Added Contacts
                                                                    ({{ count($pInjuries->getInjuryContacts) > 0 ? count($pInjuries->getInjuryContacts) : 0 }})
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive">
                                                                        <table id="contactTbleId"
                                                                            class="table layout-secondary dataTable table-striped table-bordered">
                                                                            <thead class="thead-dark">
                                                                                <tr>
                                                                                    <th scope="col">Company</th>
                                                                                    <th scope="col">First/Last Name
                                                                                    </th>
                                                                                    <th scope="col">Email</th>
                                                                                    <th scope="col">Phone Number
                                                                                    </th>
                                                                                    <th scope="col">Fax</th>
                                                                                    <th scope="col">Address</th>
                                                                                    <th scope="col">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @if (count($pInjuries->getInjuryContacts))
                                                                                    @foreach ($pInjuries->getInjuryContacts as $contact)
                                                                                        <tr>
                                                                                            <td>{{ $contact->company }}
                                                                                            </td>
                                                                                            <td>{{ $contact->first_name . '  ' . $contact->last_name }}
                                                                                            </td>
                                                                                            <td> {{ $contact->email }}
                                                                                            </td>
                                                                                            <td>{{ $contact->phone_number }}
                                                                                            </td>
                                                                                            <td>{{ $contact->fax_number }}
                                                                                            </td>
                                                                                            <td>{{ $contact->address_line1 . ' ' . $contact->address_line2 . ' ' . $contact->zip_code . ' ' . $contact->city . ' ' . $contact->state }}
                                                                                            </td>
                                                                                            <td><a
                                                                                                    href="javascript:void(0)"><i
                                                                                                        class="icon-pencil  showPointer" /></i></a>
                                                                                                <a
                                                                                                    href="javascript:void(0)"><i
                                                                                                        class="icon-trash showPointer" /></i></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                @else
                                                                                    <tr>
                                                                                        <td colspan="10">No Records
                                                                                            Found.</td>
                                                                                    </tr>
                                                                                @endif
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                                <div class="col-sm-6">
                                                    <div class="form-row">
                                                        <div class="col-md-12 clonedWrapper" id="cloneContactWrapper">
                                                            <div class="card" id="cardDivd1">
                                                                <div class="card-header" id="cardHeadId1">Contacts - Optional
                                                                </div>
                                                                <div class="card-body">
                                                                    <input type="hidden" class="contactRoleName"
                                                                        name="contactRoleName[]" id="contactRoleName_1"
                                                                        value="">
                                                                    <div class="form-row" id="cloneContactRoleSelect1">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="contact_role"> Contact Role </label>
                                                                            <select name="contact_role[]"
                                                                                onChange="showcontactInfoBox(event,this.value);"
                                                                                class="form-control contactRole"
                                                                                id="contactRole_1">
                                                                                <option value="">-Select-</option>
                                                                                @foreach ($contact_roles as $c_role)
                                                                                    <option value="{{ $c_role['id'] }}">
                                                                                        {{ $c_role['name'] }}</option>
                                                                                @endforeach
                                                                            </select>

                                                                            @if ($errors->has('contact_role'))
                                                                                <span class="invalid-feedback"
                                                                                    style="display:block" role="alert">
                                                                                    <strong
                                                                                        class="invalid-feedback">{{ $errors->first('contact_role') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row d-none showSelectedNameDiv"
                                                                        id="showIdSelected_1">
                                                                        <div class="form-group col-md-12">
                                                                            <div class="form-row d-none showfirstLastName"
                                                                                id="showfirstLastName_1">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="injury-end-date">First Name
                                                                                    </label>
                                                                                    <input data-validation-event="change"
                                                                                        data-validation="custom"
                                                                                        data-validation-regexp="^[a-zA-Z]+(\s+[a-zA-Z]+)*$"
                                                                                        data-validation-optional="true"
                                                                                        data-validation-error-msg=""
                                                                                        autocomplete="off" type="text"
                                                                                        id="contact_first_name"
                                                                                        name="contact_first_name[]"
                                                                                        value="" class="form-control"
                                                                                        maxlength="100">
                                                                                    @if ($errors->has('contact_first_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong
                                                                                                class="invalid-feedback">{{ $errors->first('contact_first_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="injury-end-date">Last
                                                                                        Name</label>
                                                                                    <input data-validation-event="change" data-validation="custom" data-validation-regexp="^[a-zA-Z]+(\s+[a-zA-Z]+)*$" data-validation-optional="true" data-validation-error-msg=""
                                                                                                autocomplete="off" type="text" id="contact_last_name"  name="contact_last_name[]" value="" class="form-control" maxlength="100">
                                                                                        @if ($errors->has('contact_last_name'))
                                                                                            <span class="invalid-feedback"
                                                                                                style="display:block"
                                                                                                role="alert">
                                                                                                <strong
                                                                                                    class="invalid-feedback">{{ $errors->first('contact_last_name') }}</strong>
                                                                                            </span>
                                                                                        @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="injury-end-date">Company
                                                                                    </label>
                                                                                    <input data-validation-optional="true"
                                                                                        data-validation-event="change"
                                                                                        data-validation="required, alphanumeric"
                                                                                        data-validation-allowing="-_ "
                                                                                        autocomplete="off" type="text"
                                                                                        id="contact_company_name"
                                                                                        name="contact_company_name[]"
                                                                                        value="" class="form-control"
                                                                                        maxlength="100">
                                                                                    @if ($errors->has('contact_company_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong
                                                                                                class="invalid-feedback">{{ $errors->first('contact_company_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-12">
                                                                                    <label for="injury-end-date">Email </label>
                                                                                    <input data-validation-event="change"
                                                                                        data-validation-optional="true"
                                                                                        data-validation-error-msg=""
                                                                                        data-validation="required, email"
                                                                                        autocomplete="off" type="email"
                                                                                        id="contact_email_name"
                                                                                        name="contact_email_name[]"
                                                                                        value="" class="form-control"
                                                                                        maxlength="100">
                                                                                    @if ($errors->has('contact_email_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong
                                                                                                class="invalid-feedback">{{ $errors->first('contact_email_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="injury-end-date">Phone Number
                                                                                    </label>
                                                                                    <input autocomplete="off"
                                                                                        data-mask="(999) 999-9999 x9999999"
                                                                                        type="text" id="contact_phone_name"
                                                                                        name="contact_phone_name[]"
                                                                                        value="" class="form-control"
                                                                                        maxlength="100">
                                                                                    @if ($errors->has('contact_phone_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong
                                                                                                class="invalid-feedback">{{ $errors->first('contact_phone_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="injury-end-date">Fax </label>
                                                                                    <input autocomplete="off"
                                                                                        data-mask="999-999-9999"
                                                                                        type="text" id="contact_fax_name"
                                                                                        name="contact_fax_name[]"
                                                                                        value="" class="form-control"
                                                                                        maxlength="100">
                                                                                    @if ($errors->has('contact_fax_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong
                                                                                                class="invalid-feedback">{{ $errors->first('contact_fax_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="injury-end-date">Address Line 1
                                                                                    </label>
                                                                                    <input data-validation-optional="true"
                                                                                        autocomplete="off" type="text"
                                                                                        id="contact_address1_name"
                                                                                        name="contact_address1_name[]"
                                                                                        value="" class="form-control"
                                                                                        maxlength="100">
                                                                                    @if ($errors->has('contact_address1_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong
                                                                                                class="invalid-feedback">{{ $errors->first('contact_address1_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="injury-end-date">Address Line 2
                                                                                    </label>
                                                                                    <input autocomplete="off" type="text"
                                                                                        id="contact_address2_name"
                                                                                        name="contact_address2_name[]"
                                                                                        value="" class="form-control"
                                                                                        maxlength="100">
                                                                                    @if ($errors->has('contact_address2_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong
                                                                                                class="invalid-feedback">{{ $errors->first('contact_address2_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-row">
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="contact_zip_name"> Zip code
                                                                                    </label>
                                                                                    <input autocomplete="off" type="text"
                                                                                        id="contact_zip_name_1"
                                                                                        name="contact_zip_name[]"
                                                                                        class="form-control zipCodeDop"
                                                                                        value="">
                                                                                    @if ($errors->has('contact_zip_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong>{{ $errors->first('contact_zip_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="contact_state_name">
                                                                                        State</label>
                                                                                    <select name="contact_state_name[]"
                                                                                        class="form-control stateDD stateName"
                                                                                        id="contact_state_name_1">
                                                                                        <option value="" class="option">
                                                                                            Select
                                                                                        </option>
                                                                                        @foreach ($states as $state)
                                                                                            <option
                                                                                                value="{{ $state['state_name'] }}">
                                                                                                {{ $state['state_name'] }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @if ($errors->has('contact_state_name'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong>{{ $errors->first('contact_state_name') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="contact_city_name"> City
                                                                                    </label>
                                                                                    <input type="text"
                                                                                        name="contact_city_name[]"
                                                                                        id="contact_city_name_1"
                                                                                        class="form-control cityDD cityNameInput"
                                                                                        value="" maxlength="55">
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row d-none" id="showCloneLink">
                                                        <div class="form-group col-md-6" onClick="cloneNewContact();">
                                                            <label for="addNewContact"> <span
                                                                    class="btn btn-outline-secondary">Add Another Contact
                                                                </span></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="privateGovId">
                                        <div class="col-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="description2"> Injury Description <span
                                                            class="required">* </span> </label>
                                                    <textarea data-validation-event="change" data-validation="required" data-validation-error-msg="" id="description2"
                                                        class="form-control" name="description2">{{ $pInjuries ? ($pInjuries->description ? $pInjuries->description : '') : '' }} </textarea>
                                                    @if ($errors->has('description2'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('description2') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="stateDD">State </label>
                                                    <select name="injury_state_id2" class="form-control stateDD"
                                                        id="injury_state_id2" data-validation-event="change"
                                                        data-validation="required" data-validation-error-msg="">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state['state_name'] }}"
                                                                {{ $pInjuries ? ($pInjuries->injury_state_id == $state['state_name'] ? 'selected' : '') : ('California' == $state['state_name'] ? 'selected' : ' ') }}>
                                                                {{ $state['state_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('injury_state_id2'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('injury_state_id2') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for=""> Insurance Payer </label>
                                                    <input autocomplete="off" type="text" name="ins_payer"
                                                        id="ins_payer" class="form-control"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->ins_payer : '') : '' }}">
                                                    @if ($errors->has('ins_payer'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('ins_payer') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""> Subscriber ID </label>
                                                    <input autocomplete="off" type="text" name="ins_subscriber"
                                                        id="ins_subscriber" class="form-control" maxlength="25"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->ins_subscriber : '') : '' }}">
                                                    @if ($errors->has('ins_subscriber'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('ins_subscriber') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="ins_group_no"> Group No. </label>
                                                    <input autocomplete="off" type="text" name="ins_group_no"
                                                        id="ins_group_no" class="form-control" maxlength="25"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->ins_group_no : '') : '' }}">
                                                    @if ($errors->has('ins_group_no'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('ins_group_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="ins_deduct_amt"> Deductible Amt. </label>
                                                    <input autocomplete="off" type="text" name="ins_deduct_amt"
                                                        id="ins_deduct_amt" class="form-control" maxlength="10"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->ins_deduct_amt : '') : '' }}">
                                                    @if ($errors->has('ins_deduct_amt'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('ins_deduct_amt') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="ins_copay_amt"> Co-payment Amt. </label>
                                                    <input autocomplete="off" type="text" name="ins_copay_amt"
                                                        id="ins_copay_amt" class="form-control" maxlength="10">
                                                    @if ($errors->has('ins_copay_amt'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('ins_copay_amt') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""> Co-Insurance Amt. </label>
                                                    <input autocomplete="off" type="text" name="ins_coins_amt"
                                                        id="ins_coins_amt" class="form-control" maxlength="10">
                                                    @if ($errors->has('ins_coins_amt'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('ins_coins_amt') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-holder col-md-6">
                                                    <label for="ins_authinfo"> Authorization Info.</label>
                                                    <textarea class="form-control" name="ins_authinfo" id="ins_authinfo" style="resize:none;">{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->ins_authinfo : '') : '' }}</textarea>
                                                    @if ($errors->has('ins_authinfo'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('ins_authinfo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-holder col-md-6">
                                                    <label for="ins_no_of_visit"> No. of visit authorized </label>
                                                    <input autocomplete="off" type="text" name="ins_no_of_visit"
                                                        id="ins_no_of_visit" class="form-control" maxlength="3"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->ins_no_of_visit : '') : '' }}">
                                                    @if ($errors->has('ins_no_of_visit'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('ins_no_of_visit') }}</strong>
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
                                                    <label for="description3"> Injury Description <span
                                                            class="required">* </span> </label>
                                                    <textarea data-validation-event="change" data-validation="required" data-validation-error-msg="" id="description3"
                                                        class="form-control" name="description3">{{ $pInjuries ? ($pInjuries->description ? $pInjuries->description : '') : '' }} </textarea>
                                                    @if ($errors->has('description3'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('description3') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="stateDD"> State </label>
                                                    <select name="injury_state_id3" class="form-control stateDD"
                                                        id="injury_state_id3" data-validation-event="change"
                                                        data-validation="required" data-validation-error-msg="">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state['state_name'] }}"
                                                                {{ $pInjuries ? ($pInjuries->injury_state_id == $state['state_name'] ? 'selected' : '') : ('California' == $state['state_name'] ? 'selected' : ' ') }}>
                                                                {{ $state['state_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('injury_state_id3'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('injury_state_id3') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="p_attorney_name"> Attorney Name </label>
                                                    <input autocomplete="off" type="text" name="p_attorney_name"
                                                        id="p_attorney_name" class="form-control"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_attorney_name : '') : '' }}">
                                                    @if ($errors->has('p_attorney_name'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('p_attorney_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="p_payer_name"> Payer Name </label>
                                                    <input autocomplete="off" type="text" name="p_payer_name"
                                                        id="p_payer_name" class="form-control"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_payer_name : '') : '' }}">
                                                    @if ($errors->has('p_payer_name'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('p_payer_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="p_law_officer_name"> Law Officer Name </label>
                                                    <input autocomplete="off" type="text"
                                                        name="p_law_officer_name" id="p_law_officer_name"
                                                        class="form-control"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_law_officer_name : '') : '' }}">
                                                    @if ($errors->has('p_law_officer_name'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('p_law_officer_name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="p_injury_date"> Date of Injury </label>
                                                    <input autocomplete="off" type="date" name="p_injury_date"
                                                        id="p_injury_date" class="form-control"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_injury_date : '') : '' }}">
                                                    @if ($errors->has('p_injury_date'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('p_injury_date') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="p_claim_id"> Claim ID </label>
                                                    <input autocomplete="off" type="text" name="p_claim_id"
                                                        id="p_claim_id" class="form-control"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_claim_id : '') : '' }}">
                                                    @if ($errors->has('p_claim_id'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('p_claim_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="p_ssn_no"> SSN </label>
                                                    <input autocomplete="off" type="text" name="p_ssn_no"
                                                        id="p_ssn_no" class="form-control"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_ssn_no : '') : '' }}">
                                                    @if ($errors->has('p_ssn_no'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('p_ssn_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="p_handle_attorn_individual"> Handling Attorney
                                                        Individual </label>
                                                    <input autocomplete="off" type="text"
                                                        name="p_handle_attorn_individual"
                                                        id="p_handle_attorn_individual" class="form-control"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_handle_attorn_individual : '') : '' }}">
                                                    @if ($errors->has('p_handle_attorn_individual'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('p_handle_attorn_individual') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="p_contact_no"> Contact No. </label>
                                                    <input autocomplete="off" type="text" name="p_contact_no"
                                                        id="p_contact_no" class="form-control" maxlength="15"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_contact_no : '') : '' }}">
                                                    @if ($errors->has('p_contact_no'))
                                                        <span class="invalid-feedback" style="display:block"
                                                            role="alert">
                                                            <strong
                                                                class="invalid-feedback">{{ $errors->first('p_contact_no') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="p_others"> Others </label>
                                                    <input autocomplete="off" type="text" name="p_others"
                                                        id="p_others" class="form-control" maxlength="25"
                                                        value="{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_others : '') : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-row d-none">
                                                <div class="form-group col-md-12">
                                                    <fieldset>
                                                        <legend>Employer Address</legend>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="p_address_line1"> Address Line1 <span
                                                                        class="required">* </span> </label>
                                                                <textarea name="p_address_line1" class="form-control" style="resize: none;" data-validation-event="change"
                                                                    data-validation="alphanumeric" data-validation-allowing="-_ " data-validation-optional="true"
                                                                    data-validation-error-msg="">{{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_address_line1 : '') : '' }}</textarea>
                                                                @if ($errors->has('p_address_line1'))
                                                                    <span class="invalid-feedback"
                                                                        style="display:block" role="alert">
                                                                        <strong>{{ $errors->first('p_address_line1') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="p_address_line2"> Address Line2 </label>
                                                                <textarea data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ "
                                                                    data-validation-optional="true" name="p_address_line2" class="form-control" style="resize: none;">
                                                                {{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_address_line2 : '') : '' }}
                                                            </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="p_state_id"> State <span
                                                                        class="required">* </span> </label>
                                                                <select name="p_state_id" class="form-control stateDD"
                                                                    id="stateDD" data-validation-event="change"
                                                                    data-validation="required"
                                                                    data-validation-error-msg="">
                                                                    <option value="" class="option">Select
                                                                    </option>
                                                                    @foreach ($states as $state)
                                                                        <option value="{{ $state['state_name'] }}">
                                                                            {{ $state['state_name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('p_state_id'))
                                                                    <span class="invalid-feedback"
                                                                        style="display:block" role="alert">
                                                                        <strong>{{ $errors->first('p_state_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="p_city_id"> City <span class="required">*
                                                                    </span> </label>
                                                                <select name="p_city_id" class="form-control cityDD"
                                                                    id="cityDD">
                                                                    <option value="" class="option">Select
                                                                    </option>
                                                                </select>
                                                                @if ($errors->has('p_city_id'))
                                                                    <span class="invalid-feedback"
                                                                        style="display:block" role="alert">
                                                                        <strong>{{ $errors->first('p_city_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="p_zipcode"> Zip code </label>
                                                                <input autocomplete="off" type="text"
                                                                    name="p_zipcode" class="form-control"
                                                                    data-validation-event="change"
                                                                    data-validation="number length"
                                                                    data-validation-length="1-10"
                                                                    data-validation-optional="true"
                                                                    data-validation-error-msg="" maxlength="10"
                                                                    {{ $pInjuries ? ($pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->p_zipcode : '') : '' }}>
                                                                @if ($errors->has('p_zipcode'))
                                                                    <span class="invalid-feedback"
                                                                        style="display:block" role="alert">
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
                                    <div class="modal fade" id="medicalNetworkProviderModal" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Medical Provider
                                                        Networks List</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table id="example"
                                                            class="table layout-secondary dataTable table-striped table-bordered">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">MPN ID</th>
                                                                    <th scope="col">Applicant Name</th>
                                                                    <th scope="col">Applicant Type</th>
                                                                    <th scope="col">MPN Name</th>
                                                                    <th scope="col">MPN Status</th>
                                                                    <th scope="col">Approval Date</th>
                                                                    <th scope="col">Website</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($medical_providers))
                                                                    @foreach ($medical_providers as $medical_provider)
                                                                        <tr>
                                                                            <td><a href="javascript:void(0)"
                                                                                    data-dismiss="modal"
                                                                                    onclick="chooseMedicalProviderNetwork({{ $medical_provider }});">Select</a>
                                                                            </td>
                                                                            <td>{{ $medical_provider->applicant_name }}
                                                                            </td>
                                                                            <td>{{ $medical_provider->applicant_name }}
                                                                            </td>
                                                                            <td>{{ $medical_provider->applicant_name }}
                                                                            </td>
                                                                            <td>{{ $medical_provider->applicant_name }}
                                                                            </td>
                                                                            <td>{{ $medical_provider->applicant_name }}
                                                                            </td>
                                                                            <td>{{ $medical_provider->applicant_name }}
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
