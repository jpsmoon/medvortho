<div class="form-row form-group">
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   Attorney Name      </label>
        <input type="text" name="p_attorney_name" id="p_attorney_name" class="form-control">
    </div>
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   Payer Name      </label>
        <input type="text" name="p_payer_name" id="p_payer_name" class="form-control">
    </div>
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   Law Officer Name      </label>
        <input type="text" name="p_law_officer_name" id="p_law_officer_name" class="form-control">
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   Date of Injury      </label>
        <input type="date" name="p_injury_date" id="p_injury_date" class="form-control">
    </div>
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   Claim ID   </label>
        <input type="text" name="p_claim_id" id="p_claim_id" class="form-control">
    </div>
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   SSN      </label>
        <input type="text" name="p_ssn_no" id="p_ssn_no" class="form-control">
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   Handling Attorney Individual      </label>
        <input type="text" name="p_handle_attorn_individual" id="p_handle_attorn_individual" class="form-control">
    </div>
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   Contact No.      </label>
        <input type="text" name="p_contact_no" id="p_contact_no" class="form-control" maxlength="15">
    </div>
    <div class="form-holder col-md-4">
        <label for="" style="float:left;">   Others      </label>
        <input type="text" name="p_others" id="p_others" class="form-control"  maxlength="25">
    </div>
</div>
<div class="form-row">
    <h5>Address</h5></div>
<div class="form-row form-group">
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">    Country  <span class="required">* </span>    </label>
        <select name="p_country_id"  id="countryDD" class="form-control" onchange="get_states('p_stateDD', this.value)">
            <option value="" class="option">Select Country</option>
            @foreach ($countries as $country)
            <option value="{{$country->id}}"> {{$country->country_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   State <span class="required">* </span>   </label>
        <select name="p_state_id" id="p_stateDD" class="form-control searcDrop" onchange="get_cities('p_cityDD', this.value)">
            <option value="" class="option">Select State</option>
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">   City <span class="required">* </span>   </label>
        <select name="p_city_id" id="p_cityDD" class="form-control searcDrop">
            <option value="" class="option">Select City</option>
        </select>
    </div>
    <div class="form-holder col-md-3">
        <label for="" style="float:left;">    Zipcode   </label>
        <input type="text" name="p_zipcode" id="p_zipcode" class="form-control" maxlength="15">
    </div>
</div>
<div class="form-row form-group">
    <div class="form-holder col-md-6">
        <label for="" style="float:left;">    Address Line1 <span class="required">* </span>     </label>
        <textarea class="form-control" name="p_address_line1" style="resize:none;"></textarea>
    </div>
    <div class="form-holder col-md-6">
        <label for="" style="float:left;">    Address Line2      </label>
        <textarea class="form-control" name="p_address_line1" style="resize:none;"></textarea>
    </div>
</div>
