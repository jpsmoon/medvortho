<div class="form-row form-group">
    <div class="form-holder col-md-5">
        <label for="" style="float:left;">   Employer      </label>
        <input type="text" name="employer_name" id="employer_name" class="form-control">
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   Cumulative Trauma <span class="required">* </span>   </label>
        <div  class="form-holder"  style=" float: left; width: 100%;">
            <input class="" type="radio" style="float:left;" name="is_cumulative" id="trauma1" value="Yes"/>&nbsp;&nbsp;
            <label for="trauma1" style="float:left; cursor:hand;" >   Yes   </label>
            <input class="" type="radio" name="is_cumulative" id="trauma2" value="No"/>
            <label for="trauma2" style="cursor:hand;" >   No   </label>
        </div>
    </div>
    <div class="form-holder col-md-offset-1 col-md-3">
        <label for="" style="float:left;">   Start Date      </label>
        <input type="date" name="start_date" id="start_date" class="form-control">
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-5">
        <label for="" style="float:left;">   Claims Administrator  <span class="required">* </span>     </label>
        <select name="claim_admin_id" id="claim_admin_id" class="form-control searcDrop" >
            <option value="" class="option">Select</option>
            @foreach ($claim_admins as $claim)
            <option value="{{$claim->id}}"> {{$claim->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   &nbsp;   </label>
        <input class="" type="checkbox" style="float:left;" name="no_any_claim" id="no_any_claim" value="Yes"/>&nbsp;&nbsp;
        <label for="no_any_claim" style="float:left;">   None    </label>
    </div>
    <div class="form-holder col-md-offset-1 col-md-3">
        <label for="" style="float:left;">   End Date      </label>
        <input type="date" name="end_date" id="end_date" class="form-control">
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-5">
        <label for="" style="float:left;">   Payer   </label>
        <select name="payer_id" id="payer_id" class="form-control searcDrop">
            <option value="" class="option">Select</option>
            @foreach ($claim_admins as $claim)
            <option value="{{$claim->id}}"> {{$claim->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3">&nbsp;</div>
    <div class="form-holder col-md-offset-1 col-md-3">
        <label for="" style="float:left;">   Claim No.      </label>
        <input type="text" name="claim_no" id="claim_no" class="form-control">
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   Claim Status      </label>
        <select name="claim_status_id" id="claim_status_id" class="form-control searcDrop">
            <option value="" class="option">Select</option>
            @foreach ($claimstatuses as $claim)
            <option value="{{$claim->id}}"> {{$claim->claim_status}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   Claim Status Date      </label>
        <input type="date" name="claim_status_date" id="claim_status_date" class="form-control">
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   Medical Provider Network  <span class="required">* </span>     </label>
        <select name="medical_provider_id" id="medical_provider_id" class="form-control searcDrop">
            <option value="" class="option">Select</option>
            @foreach ($medical_providers as $medical_provider)
            <option value="{{$medical_provider->id}}"> {{$medical_provider->applicant_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3">
        <input class="" type="checkbox" style="float:left;" name="no_any_medical_provider" id="no_any_medical_provider" value="Yes"/>&nbsp;&nbsp;
        <label for="no_any_medical_provider" style="float:left;">   None    </label>
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   ADJ Number      </label>
        <input type="text" name="adj_no" id="adj_no" class="form-control">
    </div>
</div>
<div class="form-row">
    <h5>Employer Address</h5></div>
<div class="form-row form-group">
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">    Country  <span class="required">* </span>    </label>
        <select name="emp_country_id" class="form-control searcDrop" id="countryDD" onchange="get_states('worker_stateDD', this.value)">
            <option value="" class="option">Select Country</option>
            @foreach ($countries as $country)
            <option value="{{$country->id}}"> {{$country->country_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   State <span class="required">* </span>   </label>
        <select name="emp_state_id" class="form-control searcDrop" id="worker_stateDD" onchange="get_cities('worker_cityDD', this.value)">
            <option value="" class="option">Select State</option>
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   City <span class="required">* </span>   </label>
        <select name="emp_city_id" class="form-control searcDrop" id="worker_cityDD">
            <option value="" class="option">Select City</option>
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">    Zipcode   </label>
        <input type="text" name="emp_zipcode" id="emp_zipcode" class="form-control" maxlength="15">
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-6">
        <label for="" style="float:left;">    Address Line1 <span class="required">* </span>     </label>
        <textarea class="form-control" name="emp_address_line1" style="resize:none;"></textarea>
    </div>
    <div class="form-holder col-md-6">
        <label for="" style="float:left;">    Address Line2      </label>
        <textarea class="form-control" name="emp_address_line2" style="resize:none;"></textarea>
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">ICD-9 / ICD-10 Diagnosis Codes <span class="required">* </span> </label>
        <select name="work_dg_code_id[0][value]" id="work_dg_code_id1" class="form-control searcDrop">
            <option value="" class="option">Select </option>
            @foreach ($diagnoses as $diagnosis)
            <option value="{{$diagnosis->id}}">{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;"> &nbsp;</label>
        <select name="work_dg_code_id[1][value]" id="work_dg_code_id2" class="form-control searcDrop">
            <option value="" class="option">Select </option>
            @foreach ($diagnoses as $diagnosis)
            <option value="{{$diagnosis->id}}">{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3"><label for="" style="float:left;"> &nbsp;</label>
        <select name="work_dg_code_id[2][value]" id="work_dg_code_id3" class="form-control searcDrop">
            <option value="" class="option">Select </option>
            @foreach ($diagnoses as $diagnosis)
            <option value="{{$diagnosis->id}}">{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;"> &nbsp;</label>
        <select name="work_dg_code_id[3][value]" id="work_dg_code_id4" class="form-control searcDrop">
            <option value="" class="option">Select </option>
            @foreach ($diagnoses as $diagnosis)
            <option value="{{$diagnosis->id}}">{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
            @endforeach
        </select>
    </div>
</div>
