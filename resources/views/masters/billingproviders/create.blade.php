@extends('layouts.home-new-app')
@section('content')
<style>
.ms-options-wrap > .ms-options > ul label {
    position: relative;
    display: inline-block;
    width: 100%;
    padding: 4px;
    margin: 1px 0;
    background-color: #9DCEFF;
    
}

.ms-options-wrap > .ms-options > ul li.selected label,
.ms-options-wrap > .ms-options > ul label:hover {
    background-color: #003A75;
    color:#fff;
}
</style>
<!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    @if ($errors->any())
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Billing Provider</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ route('billingproviders.index')}}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
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
        <div class="col-12 mt-4">
                <div class="card row-background">
            <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-4 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                <div style="padding-top:10px" class="w-sm-100 mr-auto"><h2 class="heading">Add Billing Provider</h2></div>
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li style="padding-bottom:10px" class="breadcrumb-item">
                        <a class="btn btn-primary"  href="{{url('/billingproviders')}}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
                 <div class="card-content">
                 <div class="card-body">
                        <form action="{{ route('saveBillProvider')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="providerId" value="">
                            <div class="row">
                                <div class="form-row col-12 border-bottom2">
                                    <div class="form-group col-md-2 title">
                                    <label for=""> Injury State <span class="required">*</span> </label>
                                    </div>
                                    <div class="form-group col-md-2">
                                    <select data-validation-event="change" data-validation="required" data-validation-error-msg="" name="injury_state_id" id="injury_state_id" class="form-control">
                                        <option value="" class="option">Select</option>
                                        @foreach ($states as $state)
                                        <option value="{{$state["state_name"]}}" {{($state["state_name"] == 'California') ? 'selected' : ''}}> {{$state["state_name"]}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('injury_state_id'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('injury_state_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row d-none col-12 border-bottom2" id="showBillingTypeDiv">
                                <div class="form-group col-md-2 title">
                                <label for=""> Bill Type <span class="required">* </span> </label>
                                </div>
                                <div class="form-group col-md-10">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input checked data-validation-event="change" data-validation="required"  data-validation-error-msg="" onclick="showOtherInputsFOrBillType(this.value);"
                                        class="custom-control-input" type="radio" name="bill_type" id="flexRadioDefault1" value="Professional" />
                                        <label class="custom-control-label"  for="flexRadioDefault1"> Professional </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input data-validation-event="change" data-validation="required"  data-validation-error-msg="" onclick="showOtherInputsFOrBillType(this.value);" class="custom-control-input" type="radio" name="bill_type" id="flexRadioDefault2" value="Pharmacy" />
                                        <label class="custom-control-label"  for="flexRadioDefault2"> Pharmacy </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input data-validation-event="change" data-validation="required"  data-validation-error-msg="" onclick="showOtherInputsFOrBillType(this.value);" class="custom-control-input" type="radio" name="bill_type" id="flexRadioDefault3" value="Institutional" />
                                        <label class="custom-control-label"  for="flexRadioDefault3">
                                            Institutional </label>
                                    </div>
                                    @if($errors->has('bill_type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('bill_type') }}</strong>
                                    </span>
                                    @endif
                                </div> 
                            </div>
                            <!-- professhionalDiv start-->
                            <div class="form-row d-none" id="professhionalDiv">

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                            <label for="" class="pr-2"> Provider Type </label>
                                            </div>
                                            <div class="form-group col-md-10">
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input onclick="showOtherInputsFOrBillType(this.value);" class="custom-control-input" type="radio" name="provider_type"  id="flexProviderType1" value="Organization" />
                                                <label for="flexProviderType1" class="custom-control-label"> Organization </label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input onclick="showOtherInputsFOrBillType(this.value);" class="custom-control-input" type="radio" name="provider_type" id="flexProviderType2" value="Individual" />
                                                <label for="flexProviderType2" class="custom-control-label"> Individual </label>
                                            </div>
                                            @if($errors->has('provider_type'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong>{{ $errors->first('provider_type') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 d-none pl-0 pr-0" id="organizationDiv">

                                <div class="form-row col-md-12 border-bottom2">
                                    <div class="col-md-2 title"> <label>CMS 1500 Box 251</label> </div>
                                    <div class="form-group col-md-2">
                                        <label for=""> Tax ID <span class="required">* </span> </label>
                                        <input type="text" id="professional_tax_id" name="professional_tax_id" class="form-control" data-validation-event="onkeypress" data-validation="custom" data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit Tax ID ">
                                        @if($errors->has('professional_tax_id'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong>{{ $errors->first('professional_tax_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-8">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input checked data-validation-event="change" data-validation="required"  data-validation-error-msg=""  class="custom-control-input" type="radio" name="tax_id_type" id="tax_id_type1" value="SSN" />
                                            <label class="custom-control-label"  for="tax_id_type1"> SSN </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input data-validation-event="change" data-validation="required"  data-validation-error-msg=""  class="custom-control-input" type="radio" name="tax_id_type" id="tax_id_type2" value="EIN" />
                                            <label class="custom-control-label"  for="tax_id_type2"> EIN </label>
                                        </div> 
                                        @if($errors->has('tax_id_type'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong>{{ $errors->first('tax_id_type') }}</strong>
                                        </span>
                                        @endif
                                    </div> 
                                </div>

                                <div class="form-row col-md-12">
                                        <div class="col-md-2 title" >
                                        <label>CMS 1500 Box 33</label>
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Billing Provider Name</label>
                                                    <input type="text" name="professional_provider_name" class="form-control">
                                                    @if($errors->has('professional_provider_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('professional_provider_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> Nickname  (Optional) </label>
                                                    <input type="text" name="professional_nick_name" class="form-control">
                                                    @if($errors->has('professional_nick_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('professional_nick_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> Telephone </label>
                                                    <input type="text" name="professional_telephone" class="form-control" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit Telephone Number">
                                                    @if($errors->has('professional_telephone'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('professional_telephone') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                        </div>

                                <div class="form-row col-md-12">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 1</label>
                                                    <input type="text" name="professional_addres1" class="form-control">
                                                    @if($errors->has('professional_addres1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('professional_addres1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 2 </label>
                                                    <input type="text" name="professional_addres2" class="form-control">
                                                    @if($errors->has('professional_addres2'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('professional_addres2') }}</strong>
                                                </span>
                                            @endif
                                                </div>
                                        </div>

                                <div class="form-row col-md-12 border-bottom2">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> City </label>
                                                    <input type="text" name="professional_city" class="form-control">
                                                    @if($errors->has('professional_city'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('professional_city') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> State </label>
                                                    <select name="professional_state" class="form-control stateDD"   id="stateDD" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('professional_state'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('professional_state') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="">Zip Code </label>
                                                    <input type="text" name="professional_zip" class="form-control"  data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit ZIP Code No.">
                                                    @if($errors->has('professional_zip'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('professional_zip') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>

                                <div class="form-row col-md-12 border-bottom2">
                                        <div class="col-md-2 title">
                                        <label>CMS 1500 Box 33 a</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> NPI <span class="required">* </span> </label>
                                                <input type="text" name="professional_npi" class="form-control" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit NPI ID">
                                                @if($errors->has('professional_npi'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('professional_npi') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                <div class="form-row col-md-12 border-bottom2">
                                        <div class="col-md-2 title">
                                        <label>CMS 1500 Box 33 b<br>(Optional)</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for="">DOL Provider Number <span class="required">* </span> </label>
                                                <input type="text" name="dol_provider_name" class="form-control" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit DOL Number" >
                                                @if($errors->has('dol_provider_name'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('dol_provider_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>        

                                <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Physical Address</label>
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 1</label>
                                                    <input type="text" name="professional_address1" class="form-control">
                                                    @if($errors->has('professional_address1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('professional_address1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 2 </label>
                                                    <input type="text" name="professional_address2" class="form-control">
                                                    @if($errors->has('professional_address2'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('professional_address2') }}</strong>
                                                </span>
                                            @endif
                                                </div>
                                        </div>

                                <div class="form-row col-md-12 border-bottom2">
                                        <div class="col-md-2">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for=""> City </label>
                                            <input type="text" name="professional_city1" class="form-control">
                                            @if($errors->has('professional_city1'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong>{{ $errors->first('professional_city1') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> State </label>
                                                    <select name="professional_state1" class="form-control"  id="stateDD" data-validation-event="change" data-validation="required"
                                                        data-validation-error-msg="">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($states as $state)
                                                        <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                        @endforeach
                                                    </select>
                                                        @if($errors->has('professional_state1'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong>{{ $errors->first('professional_state1') }}</strong>
                                                        </span>
                                                        @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="">Zip Code </label>
                                                    <input type="text" name="professional_zipcode1" class="form-control"  data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit ZIP Code No.">
                                                    @if($errors->has('professional_zipcode1'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('professional_zipcode1') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>

                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 d-none pl-0 pr-0" id="individualDiv">

                                   <div class="form-row col-md-12 border-bottom2">
                                        <div class="col-md-2 title">
                                        <label>CMS 1500 Box 25</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Tax ID<span class="required">* </span> </label>
                                                <input type="text" name="billProvider_box_25_tax_id" class="form-control " data-mask="99-9999999">
                                                @if($errors->has('billProvider_box_25_tax_id'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('billProvider_box_25_tax_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                <div class="form-row col-md-12">
                                        <div class="col-md-2 title" >
                                        <label>CMS 1500 Box 33</label>
                                        </div>
                                                <div class="form-group col-md-2">
                                                    <label for="">First Name</label>
                                                    <input type="text" name="billProvider_namebox_33_first_name" class="form-control">
                                                    @if($errors->has('billProvider_namebox_33_first_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_first_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="">Last Name </label>
                                                    <input type="text" name="billProvider_namebox_33_last_name" class="form-control">
                                                    @if($errors->has('billProvider_namebox_33_last_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_last_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-1">
                                                    <label for="">MI</label>
                                                    <input type="text" name="billProvider_namebox_33_mi" class="form-control" maxLength="5">
                                                    @if($errors->has('billProvider_namebox_33_mi'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_mi') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-1">
                                                    <label for="">Suffix</label>
                                                    <input type="text" name="billProvider_namebox_33_suffix" class="form-control" maxLength="5">
                                                    @if($errors->has('billProvider_namebox_33_suffix'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_suffix') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for=""> Telephone </label>
                                                    <input type="text" name="billProvider_namebox_33_telephone" class="form-control" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit Telephone Number">
                                                    @if($errors->has('billProvider_namebox_33_telephone'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_telephone') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                        </div>

                                <div class="form-row col-md-12">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 1</label>
                                                    <input type="text" name="billProvider_namebox_33_address1" class="form-control">
                                                    @if($errors->has('billProvider_namebox_33_address1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_address1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 2 </label>
                                                    <input type="text" name="billProvider_namebox_33_address2" class="form-control">
                                                    @if($errors->has('billProvider_namebox_33_address2'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('billProvider_namebox_33_address2') }}</strong>
                                                </span>
                                            @endif
                                                </div>
                                        </div>

                                <div class="form-row col-md-12 border-bottom2">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4 ">
                                                    <label for=""> City </label>
                                                    <input type="text" name="billProvider_namebox_33_city" class="form-control">
                                                    @if($errors->has('billProvider_namebox_33_city'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_city') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> State </label>
                                                    <select name="billProvider_namebox_33_state" class="form-control stateDD"  id="stateDD" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('billProvider_namebox_33_state'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_state') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="">Zip Code </label>
                                                    <input type="text" name="billProvider_namebox_33_zipCode" class="form-control" data-mask="99999-9999" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit ZIP Code No.">
                                                    @if($errors->has('billProvider_namebox_33_zipCode'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('billProvider_namebox_33_zipCode') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>

                                <div class="form-row col-md-12 border-bottom2">
                                        <div class="col-md-2 title">
                                        <label>CMS 1500 Box 33 a</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> NPI  <span class="required">* </span> </label>
                                                <input type="text" name="billProvider_namebox_33_npi" class="form-control" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit NPI ID">
                                                @if($errors->has('billProvider_namebox_33_npi'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('billProvider_namebox_33_npi') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Physical Address</label>
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 1</label>
                                                    <input type="text" name="billProvider_namebox_33_a_address1" class="form-control">
                                                    @if($errors->has('billProvider_namebox_33_a_address1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_a_address1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 2 </label>
                                                    <input type="text" name="billProvider_namebox_33_a_address2" class="form-control">
                                                    @if($errors->has('billProvider_namebox_33_a_address2'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('billProvider_namebox_33_a_address2') }}</strong>
                                                </span>
                                            @endif
                                                </div>
                                        </div>

                                <div class="form-row col-md-12 border-bottom2">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> City </label>
                                                    <input type="text" name="billProvider_namebox_33_a_city" class="form-control">
                                                    @if($errors->has('billProvider_namebox_33_a_city'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_a_city') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> State </label>
                                                    <select name="billProvider_namebox_33_a_stateId" class="form-control" id="stateDD" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('billProvider_namebox_33_a_stateId'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('billProvider_namebox_33_a_stateId') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="">Zip Code </label>
                                                    <input type="text" name="billProvider_namebox_33_a_zipcode" class="form-control" data-mask="99999-9999" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit ZIP Code No.">
                                                    @if($errors->has('billProvider_namebox_33_a_zipcode'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('billProvider_namebox_33_a_zipcode') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>
                                </div>


                               <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Billing Provider W-9</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> W-9 - PDF Format <span class="required">* </span> </label>
                                                <input type="file" name="professional_file" class="form-control">
                                                @if($errors->has('professional_file'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('professional_file') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div> 
                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                            <label>DaisyBill Cover Sheet <br>(Optional)</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Fax Number <span class="required">* </span> </label>
                                                <input type="text" name="professional_fax_number" class="form-control " data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit Fax No.">
                                                @if($errors->has('professional_fax_number'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('professional_fax_number') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <!-- professhionalDiv end-->

                            <!-- pharmacyDiv start-->
                            <div class="form-row d-none" id="pharmacyDiv">
                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>NCPDP Box 49</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Tax ID <span class="required">* </span> </label>
                                                <input type="text" name="pharmacy_tax_id" class="form-control " data-validation-event="keypress"   data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit Tax ID ">
                                                @if($errors->has('pharmacy_tax_id'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_tax_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title" >
                                        <label>NCPDP Box 51</label>
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Billing Provider Name</label>
                                                    <input type="text" name="pharmacy_billing_provider_name" class="form-control">
                                                    @if($errors->has('pharmacy_billing_provider_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('pharmacy_billing_provider_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Nickname  (Optional) </label>
                                                    <input type="text" name="pharmacy_billing_nick_name" class="form-control">
                                                    @if($errors->has('pharmacy_billing_nick_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('pharmacy_billing_nick_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 pl-0 pr-0">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title"><label>NCPDP Box 52-55</label>
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 1</label>
                                                    <input type="text" name="pharmacy_address1" class="form-control">
                                                    @if($errors->has('pharmacy_billing_address1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('pharmacy_billing_address1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 2 </label>
                                                    <input type="text" name="pharmacy_address2" class="form-control">
                                                    @if($errors->has('pharmacy_address2'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_address2') }}</strong>
                                                </span>
                                            @endif
                                                </div>

                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 pl-0 pr-0 border-bottom2 ">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4 ">
                                                    <label for=""> City </label>
                                                    <input type="text" name="pharmacy_city" class="form-control">
                                                    @if($errors->has('pharmacy_city'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('pharmacy_city') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> State </label>
                                                    <select name="pharmacy_state" class="form-control stateDD" onchange="getGetCityBySTateCOde(this.value,'cityDD');"
                                            id="stateDD" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('pharmacy_state'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('pharmacy_state') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="">Zip Code </label>
                                                    <input type="text" name="pharmacy_zipcode" class="form-control" data-mask="99999-9999" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit ZIP Code No.">
                                                    @if($errors->has('pharmacy_zipcode'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_zipcode') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>NCPDP Box 56</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Telephone <span class="required">* </span> </label>
                                                <input type="text" name="pharmacy_telephone" class="form-control " data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit Telephone Number">
                                                @if($errors->has('pharmacy_telephone'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_telephone') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Signature (Optional)</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Signature (PNG format) <span class="required">* </span> </label>
                                                <input type="file" name="pharmacy_signature" class="form-control ">
                                                @if($errors->has('pharmacy_signature'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_signature') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Other</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> NPI <span class="required">* </span> </label>
                                                <input type="text" name="pharmacy_npi" class="form-control" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit NPI ID">
                                                @if($errors->has('pharmacy_npi'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_npi') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                               <div class="col-xs-12 col-sm-12 col-md-12 ">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Physical Address</label>
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 1</label>
                                                    <input type="text" name="pharmacy_billing_address1" class="form-control">
                                                    @if($errors->has('pharmacy_billing_address1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('pharmacy_billing_address1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 2 </label>
                                                    <input type="text" name="pharmacy_billing_address2" class="form-control">
                                                    @if($errors->has('pharmacy_billing_address2'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_billing_address2') }}</strong>
                                                </span>
                                            @endif
                                                </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> City </label>
                                                    <input type="text" name="pharmacy_billing_city" class="form-control">
                                                    @if($errors->has('pharmacy_billing_city'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('pharmacy_billing_city') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> State </label>
                                                    <select name="pharmacy_billing_state" class="form-control stateDD" onchange="getGetCityBySTateCOde(this.value,'cityDD');"
                                            id="stateDD" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('pharmacy_billing_state'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('pharmacy_billing_state') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="">Zip Code </label>
                                                    <input type="text" name="pharmacy_billing_zipcode" class="form-control" data-mask="99999-9999" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit ZIP Code No.">
                                                    @if($errors->has('pharmacy_billing_zipcode'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_billing_zipcode') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>
                                </div>
                               <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Billing Provider W-9</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> W-9 - PDF Format <span class="required">* </span> </label>
                                                <input type="file" name="pharmacy_billing_file" class="form-control">
                                                @if($errors->has('pharmacy_billing_file'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_billing_file') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Billing Provider<br>User Access</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Users with Access <span class="required">* </span> </label>
                                                <select name="pharmacy_billing_user_access[]"  multiple="multiple"
                                                class="form-control 4colactive" 
                                            id="pharmacy_billing_user_accessId" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                    @foreach ($users as $user)
                                                    <option value="{{$user["id"]}}"> {{$user["name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('pharmacy_billing_user_access'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_billing_user_access') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>DaisyBill Cover Sheet <br>(Optional)</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Fax Number <span class="required">* </span> </label>
                                                <input type="text" name="pharmacy_billing_fax_number" class="form-control " data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit Fax No.">
                                                @if($errors->has('pharmacy_billing_fax_number'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('pharmacy_billing_fax_number') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                            </div>
                            <!-- pharmacyDiv end-->

                            <!-- institutionalDiv start-->
                            <div class="form-row d-none" pl-0 pr-0 id="institutionalDiv">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title" >
                                        <label>UB04 Box 1 <br>Billing Provider</label>
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Billing Provider Name</label>
                                                    <input type="text" name="institution_provider_name" class="form-control">
                                                    @if($errors->has('institution_provider_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_provider_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> Nickname  (Optional) </label>
                                                    <input type="text" name="institution_nick_name" class="form-control">
                                                    @if($errors->has('institution_nick_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_nick_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> Telephone </label>
                                                    <input type="text" name="institution_telephone" class="form-control" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit Telephone Number">
                                                    @if($errors->has('institution_telephone'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_telephone') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                        </div>
                                </div>

                                 <div class="col-xs-12 col-sm-12 col-md-12 ">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 1</label>
                                                    <input type="text" name="institution_address1" class="form-control">
                                                    @if($errors->has('institution_address1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_address1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 2 </label>
                                                    <input type="text" name="institution_address2" class="form-control">
                                                    @if($errors->has('institution_address2'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_address2') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12 ">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4 ">
                                                    <label for=""> City </label>
                                                    <input type="text" name="institution_city" class="form-control">
                                                    @if($errors->has('institution_city'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_city') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> State </label>
                                                    <select name="institution_state" class="form-control stateDD" onchange="getGetCityBySTateCOde(this.value,'cityDD');"
                                            id="stateDD" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('institution_state'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_state') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="">Zip Code </label>
                                                    <input type="text" name="institution_zipCode" class="form-control" data-mask="99999-9999" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit ZIP Code No.">
                                                    @if($errors->has('institution_zipCode'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_zipCode') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 ">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title"><label> UB04 Box 2 <br> Pay To Address</label>
                                        </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 1</label>
                                                    <input type="text" name="institution_address11" class="form-control">
                                                    @if($errors->has('institution_address11'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_address11') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for=""> Address Line 2 </label>
                                                    <input type="text" name="institution_address22" class="form-control">
                                                    @if($errors->has('institution_address22'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_address22') }}</strong>
                                                </span>
                                            @endif
                                                </div>

                                             </div>
                                         </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2">
                                        </div>
                                                <div class="form-group col-md-4 ">
                                                    <label for=""> City </label>
                                                    <input type="text" name="institution_city1" class="form-control">
                                                    @if($errors->has('institution_city1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_city1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for=""> State </label>
                                                    <select name="institution_state1" class="form-control stateDD" onchange="getGetCityBySTateCOde(this.value,'cityDD');"
                                            id="stateDD" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}"> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('institution_state1'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_state1') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <label for="">Zip Code </label>
                                                    <input type="text" name="institution_zipCode1" class="form-control" data-mask="99999-9999" data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit ZIP Code No.">
                                                    @if($errors->has('institution_zipCode1'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_zipCode1') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>UB04 Box 5</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Tax ID <span class="required">* </span> </label>
                                                <input type="text" name="institution_tax_id" class="form-control " data-validation-event="keypress"   data-validation="custom"  data-validation-regexp="^[0-9]{9}$" maxLength="9" data-validation-error-msg="Please Enter the 9 Digit Tax ID ">
                                                @if($errors->has('institution_tax_id'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_tax_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>UB04 Box 56</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> NPI  <span class="required">* </span> </label>
                                                <input type="text" name="institution_npi" class="form-control " data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit NPI ID">
                                                @if($errors->has('institution_npi'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_npi') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>UB04 Box 81</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Taxonomy Code <span class="required">* </span> </label>
                                                <input type="text" name="institution_taxonomy" class="form-control " data-mask="99-9999999">
                                                @if($errors->has('institution_taxonomy'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_taxonomy') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Signature (Optional)</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Signature (PNG format) <span class="required">* </span> </label>
                                                <input type="file" name="institution_file" class="form-control " data-mask="99-9999999">
                                                @if($errors->has('institution_file'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_file') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                               <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Other</label>
                                        </div>
                                                <div class="form-group col-md-2">
                                                    <label for="">County Name </label>
                                                    <input type="text" name="institution_county_name" class="form-control">
                                                    @if($errors->has('institution_county_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('institution_county_name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="">Facility Type </label>
                                                    <input type="text" name="institution_facility_type" class="form-control">
                                                    @if($errors->has('institution_facility_type'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_facility_type') }}</strong>
                                                </span>
                                            @endif
                                                </div>
                                        </div>
                                </div>

                               <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Billing Provider W-9</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> W-9 - PDF Format <span class="required">* </span> </label>
                                                <input type="file" name="institution_file2" class="form-control">
                                                @if($errors->has('institution_file2'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_file2') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>Billing Provider<br>User Access</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> Users with Access <span class="required">* </span> </label>
                                                <select name="institution_user_acess[]"  multiple="multiple"
                                                class="form-control 4colactive" 
                                            id="institution_user_acessID" data-validation-event="change" data-validation="required"
                                                data-validation-error-msg="">
                                                     @foreach ($users as $user)
                                                    <option value="{{$user["id"]}}"> {{$user["name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('institution_user_acess'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_user_acess') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>DaisyBill Cover Sheet <br>(Optional)</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Fax Number <span class="required">* </span> </label>
                                                <input type="text" name="institution_fax_number" class="form-control " data-validation-event="keypress" data-validation="custom"  data-validation-regexp="^[0-9]{10}$" maxLength="10" data-validation-error-msg="Please Enter the 10 Digit Fax No.">
                                                @if($errors->has('institution_fax_number'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('institution_fax_number') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- institutionalDiv end-->

                            <div class="form-row col-12">
                                    <div class="form-group col-md-2">
                                    <label for="">  <span class="required"></span> </label>
                                    </div>
                                    <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
                                </div>
                            </div>


                        </form>
                    </div>
                 </div>

                </div>
            </div>
        <div class="col-1 mt-4"></div>
        </div>
        </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('public/js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('public/js/controller/master_for_all.js') }}"></script>

<!-- MDB -->
<link rel="stylesheet" type="text/css" href="{{ url('new_assets/app-assets/css/jquery.multiselect.css') }}">
<script src="{{ asset('new_assets/app-assets/js/jquery.multiselect.js') }}"></script>
<script>
$( document ).ready(function() {
    var selectVal = $("#injury_state_id").val();
    showOtherInputs(selectVal);
    $("#injury_state_id").change(function(){
        showOtherInputs($(this).find(":selected").val());
    });
    showOtherInputsFOrBillType('Professional'); 
});
function showOtherInputs(val){
    console.log('val#',val);
    if(val != null){
        $("#showBillingTypeDiv").removeClass('d-none');
    }
    else{
        $("#showBillingTypeDiv").addClass('d-none');
    }
}
    function showOtherInputsFOrBillType(val){
        console.log('val',val); 
        if(val == 'Professional'){
            $("#professhionalDiv").removeClass('d-none');
            $("#pharmacyDiv").addClass('d-none');
            $("#institutionalDiv").addClass('d-none');
             $("#individualDiv").addClass('d-none');
            $("#organizationDiv").removeClass('d-none');
            //flexProviderType1
            $("#flexProviderType1").prop( "checked", true );
        }
        else if(val == 'Pharmacy'){
            $("#professhionalDiv").addClass('d-none');
            $("#pharmacyDiv").removeClass('d-none');
            $("#institutionalDiv").addClass('d-none');
        }
        else if(val == 'Institutional'){
            $("#professhionalDiv").addClass('d-none');
            $("#pharmacyDiv").addClass('d-none');
            $("#institutionalDiv").removeClass('d-none');
        }

        else if(val == 'Organization'){
            $("#individualDiv").addClass('d-none');
            $("#organizationDiv").removeClass('d-none');
        }
        else if(val == 'Individual'){
           $("#individualDiv").removeClass('d-none');
            $("#organizationDiv").addClass('d-none');
        }

    }
    
</script>

<script>
//pharmacy_billing_user_accessId
var jax = $.noConflict();

jax(document).ready(function() {       
	
    jax('select[multiple]').multiselect({
    columns: 2,
    selectAll : true,
    placeholder: 'Select user',
    //unSelectAll : true,
    // allSelectedText: 'All',
    // includeSelectAllOption: true
});

}); 
</script>
 
   <script>
   
    
  </script> 


