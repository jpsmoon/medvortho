<style type="text/css">
     #billing_provider .select {border:2px solid #999;margin:0px; background-color:  #ccc;}
</style>


<div class="form-row">
    <div class="form-group col-md-6">
        <label for="billing_provider_ids">  Select Billing Provider <span class="required">* </span>     </label>
        <select name="billing_provider_ids" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
            <option value="">Please Select</option>
            @foreach ($billingproviders as $billingprovider)
                <option value="{{$billingprovider->id }}">{{$billingprovider->name }}</option>
            @endforeach
        </select>
        @if($errors->has('billing_provider_ids'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong class="invalid-feedback" >{{ $errors->first('billing_provider_ids') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="mi"> MI     </label>
        <input type="text" name="mi" maxlength="5" placeholder="Mi length 1-5" class="form-control" data-validation-event="change" data-validation="length"
        data-validation-length="1-5" data-validation-optional="true" data-validation-error-msg="">
        @if($errors->has('mi'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong>{{ $errors->first('mi') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-row">
    <input type="hidden" name="billing_provider_id" id="billing_provider_id" class="form-control" >
    <div class="form-group col-md-6">
        <label for="first_name">  First  Name <span class="required">* </span>     </label>
        <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length"
        data-validation-length="2-100" >
        @if($errors->has('first_name'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong class="invalid-feedback" >{{ $errors->first('first_name') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="last_name">    Last Name     </label>
        <input type="text" name="last_name" class="form-control" maxlength="100">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="suffix"> Suffix    </label>
        <input type="text" name="suffix" class="form-control"  maxlength="15">
    </div>
    <div class="form-group col-md-6">
        <label for="dob">   DOB  <span class="required">* </span>   </label>
        <input type="text" name="dob" class="form-control"  maxlength="15" value=""
        data-validation-event="change" data-validation="required"  data-validation-error-msg="" placeholder="">
        @if($errors->has('dob'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong>{{ $errors->first('dob') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="gender">   Gender  <span class="required">* </span>   </label>
        <select name="gender" class="form-control" data-validation-event="change" data-validation="required"   data-validation-error-msg="">
            <option value="" class="option">Select</option>
            <option value="Male"> Male</option>
            <option value="Female"> Female</option>
        </select>
        @if($errors->has('gender'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong>{{ $errors->first('gender') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="ssn_no"> SSN <span class="required">* </span>    </label>
        <input type="text" name="ssn_no" id="ssn_noId"  value="" data-mask="999-99-9999" class="form-control"
         data-validation-error-msg="" data-validation-event="change" data-validation="required"  maxlength="15">
        @if($errors->has('ssn_no'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong>{{ $errors->first('ssn_no') }}</strong>
        </span>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="address_line1">   Address Line1   <span class="required">* </span>  </label>
        <textarea name="address_line1" class="form-control" style="resize: none;" data-validation-event="change" data-validation="required"
        data-validation-error-msg=""></textarea>
        @if($errors->has('address_line1'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong>{{ $errors->first('address_line1') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="address_line2">   Address Line2     </label>
        <textarea name="address_line2" class="form-control" style="resize: none;"></textarea>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="zipcode">   Zip code </label>
        <input type="text" name="zipcode" class="form-control" onKeyUp="getStatesByZipCode(this.value);"
         data-validation-event="change" data-validation="number length"
        data-validation-length="1-10" data-validation-optional="true"
        data-validation-error-msg="" maxlength="10">
        @if($errors->has('zipcode'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong>{{ $errors->first('zipcode') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
        <label for="practice_id"> Practice Internal ID    </label>
        <input type="text" name="practice_id" class="form-control" maxlength="55">
    </div>
</div>
<div class="form-row">
<div class="form-group col-md-6">
        <label for="state_id"> State  <span class="required">* </span> </label>
        <select name="state_id" class="form-control stateDD" id="stateDD" data-validation-event="change" data-validation="required"
        data-validation-error-msg="">
            <option value="" class="option">Select</option>
            @foreach ($states as $state)
            <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
            @endforeach
        </select>

        @if($errors->has('state_id'))
        <span class="invalid-feedback" style="display:block" role="alert">
            <strong>{{ $errors->first('state_id') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group col-md-6">
            <label for="city_id"> City </label>
            <input type="text" name="city_id" id="cityDD" class="form-control cityDD" maxlength="55">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="mobile_no"> Mobile No.     </label>
        <input type="text" name="mobile_no" class="form-control" maxlength="15"
        data-validation-event="change" data-validation="length" data-validation-length="1-15" data-validation-optional="true"
        data-validation-error-msg="">
    </div>
    <div class="form-group col-md-6">
        <label for="contact_no"> Landline No.     </label>
        <input type="text" name="contact_no" class="form-control" maxlength="15"
        data-validation-event="change" data-validation="length" data-validation-length="1-15" data-validation-optional="true"
        data-validation-error-msg="">
    </div>
</div>
