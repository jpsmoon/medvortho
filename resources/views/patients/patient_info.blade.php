<style type="text/css">
    #billing_provider .select {
        border: 2px solid #999;
        margin: 0px;
        background-color: #ccc;
    }
</style>

<div class="form-row col-12 mt-4">
    <div class="form-group col-md-12">
        <label for="billing_provider_ids"> Select Billing Provider <span class="required">* </span></label>
        <select  id="billing_provider_id" onchange="getBillingInfoForView(this.value,'billingInfoDiv', 'billingInfobydefault');"
            name="add_billing_provider_id" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
            <option value="">Please Select</option>
            @foreach ($billingproviders as $billingprovider)
                <option value="{{ $billingprovider->id }}" {{($patient && $patient->billing_provider_id == $billingprovider->id) ? 'selected' : ''}}>{{ $billingprovider->professional_provider_name }}</option>
            @endforeach
        </select>
        @if ($errors->has('add_billing_provider_id'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong class="invalid-feedback">{{ $errors->first('add_billing_provider_id') }}</strong>
            </span>
        @endif
    </div>

    <input type="hidden" name="billing_provider_id" id="billing_provider_id" class="form-control">
    <div class="form-group col-md-4">
        <label for="first_name"> First Name <span class="required">* </span> </label>
        <input type="text" name="first_name" value="{{($patient && $patient->first_name) ? $patient->first_name : NULL }}" class="form-control" data-validation-event="change" data-validation="required, length"
            data-validation-length="2-100">
        @if ($errors->has('first_name'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong class="invalid-feedback">{{ $errors->first('first_name') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-4">
        <label for="last_name">Last Name <span class="required">* </span></label>
        <input type="text" value="{{($patient && $patient->last_name) ? $patient->last_name : NULL }}" name="last_name" data-validation-event="change" data-validation="required, length" data-validation-length="2-100"
            class="form-control" maxlength="100">
    </div>

    <div class="form-group col-md-2">
        <label for="mi"> MI </label>
        <input type="text" value="{{($patient && $patient->mi) ? $patient->mi : NULL }}" name="mi" maxlength="5" placeholder="Mi length 1-5" class="form-control"
           data-validation-event="change" data-validation="custom" data-validation-regexp ="^[a-zA-Z]+(\s+[a-zA-Z]+)*$" data-validation-optional="true" data-validation-error-msg="">
        @if ($errors->has('mi'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('mi') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-2">
        <label for="suffix"> Suffix </label>
        <input type="text" value="{{($patient && $patient->suffix) ? $patient->suffix : NULL }}" name="suffix" data-validation="custom" data-validation-regexp ="^[a-zA-Z]+(\s+[a-zA-Z]+)*$" 
        data-validation-optional="true"  data-validation-error-msg=""  class="form-control" maxlength="15">
    </div>
    <div class="form-group col-md-4">
        <label for="dob"> DOB <span class="required">* </span> </label>
        <input value="{{($patient && $patient->dob) ? date('m/d/Y', strtotime($patient->dob)) : NULL }}" type="text" name="dob" id="dobId" autocomplete="off" class="form-control" value=""
            data-validation-event="change" data-validation="required" data-mask="99/99/9999" data-validation-error-msg="Please Enter DOB in this formate mm/dd/yyyy" placeholder="">
        @if ($errors->has('dob'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('dob') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-4">
        <label for="ssn_no"> SSN </label>
        <input  type="text" value="{{($patient && $patient->ssn_no) ? $patient->ssn_no : NULL }}" name="ssn_no" id="ssn_noId" value="" data-mask="999-99-9999" data-validation-error-msg="Please Enter the 9 Digit SSN Number" class="form-control"
            maxlength="15">
        @if ($errors->has('ssn_no'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('ssn_no') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-4">
        <label for="gender">Gender<span class="required">* </span> </label>
        <select name="gender" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
            <option value="" class="option">Select</option>
            <option value="Male" {{($patient && $patient->gender == 'Male') ? 'selected' : '' }}> Male</option>
            <option value="Female" {{($patient && $patient->gender == 'Female') ? 'selected' : ''}}> Female</option>
        </select>
        @if ($errors->has('gender'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('gender') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="address_line1">Address Line1<span class="required">* </span> </label>
        <input type="text" value="{{($patient && $patient->address_line1) ? $patient->address_line1 : NULL }}" name="address_line1" class="form-control" style="resize: none;"
          data-validation-event="change"  data-validation-event="change" data-validation="required" data-validation-error-msg="">
        @if ($errors->has('address_line1'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('address_line1') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="address_line2"> Address Line2 </label>
        <input value="{{($patient && $patient->address_line2) ? $patient->address_line2 : NULL }}"  data-validation-optional="true"
            type="text" name="address_line2" class="form-control" style="resize: none;">
    </div>

    <div class="form-group col-md-4">
        <label for="zipcode">Zip code</label>
        <input value="{{($patient && $patient->zipcode) ? $patient->zipcode : NULL }}" onFocus="this.selectionStart = this.selectionEnd = this.value.length;"  type="text" id="zipcode" name="zipcode" class="form-control" onKeyUp="getStatesByZipCode(this.value ,'cityDD', 'stateDD');"
            data-validation-event="change" autocomplete="off" data-validation="number length" data-mask="99999" data-validation-error-msg="Please Enter the 5 Digit Zip code Number" data-validation-length="1-10" data-validation-optional="true"
            data-validation-error-msg="" maxlength="5">
        @if ($errors->has('zipcode'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('zipcode') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-md-4">
        <label for="city_id"> City </label>
        <input type="text" name="city_id" value="{{($patient && $patient->city_id) ? $patient->city_id : NULL }}" id="cityDD" class="form-control cityDD" maxlength="55">
    </div>

    <div class="form-group col-md-4">
        <label for="state_id"> State <span class="required">* </span> </label>
        <select name="state_id" class="form-control stateDD" id="stateDD" data-validation-event="change" data-validation="required"
            data-validation-error-msg="">
            <option value="" class="option">Select</option>
            @foreach ($states as $state)
                <option value="{{ $state['state_name'] }}" {{($patient && $patient->state_id == $state["state_name"]) ? "selected" : (($state["state_name"] == 'California') ? 'selected' : '')}}> {{ $state['state_name'] }}</option>
            @endforeach
        </select>

        @if ($errors->has('state_id'))
            <span class="invalid-feedback" style="display:block" role="alert">
                <strong>{{ $errors->first('state_id') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group col-md-4">
        <label for="mobile_no"> Mobile</label>
        <input value="{{($patient && $patient->contact_no) ? $patient->contact_no : NULL }}" onFocus="this.selectionStart = this.selectionEnd = this.value.length;"  type="text" name="mobile_no" class="form-control"  
        data-validation-optional="true" data-validation-event="change" data-mask="9999999999"  data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10"
            data-validation-optional="true" data-validation-error-msg="Please Enter the 10 Digit Mobile Number">
    </div>
    <div class="form-group col-md-4">
        <label for="contact_no">Telephone</label>
        <input value="{{($patient && $patient->landline_no) ? $patient->landline_no : NULL }}" type="text" name="landline_no" data-mask="(999) 999-9999" class="form-control" maxlength="12" data-validation-error-msg="Please Enter the 10 Digit Telephone Number">
    </div>

    <div class="form-group col-md-4">
        <label for="practice_id"> Practice Internal ID </label>
        <input value="{{($patient && $patient->practice_id) ? $patient->practice_id : NULL }}" type="text" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_  "
            data-validation-optional="true" name="practice_id" class="form-control" maxlength="55">
    </div>
</div>
