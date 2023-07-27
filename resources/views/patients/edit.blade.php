@extends('layouts.home-app')
@section('content')
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Update Patient</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ route('patients.index') }}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    @if ($errors->any())
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('updatePatient',$patient->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                            <div class="row">
                                <div class="col-9 mt-4 row-background style="margin-left: 10px;">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="billing_provider_id">  Select Billing Provider <span class="required">* </span> </label>
                                            <select name="patient_billing_provider_id" id="billing_provider_id" class="form-control">
                                                <option value="">Please Select</option>
                                                @foreach ($billingproviders as $billingprovider)
                                                    <option value="{{$billingprovider->id}}"
                                                    {{($patient->billing_provider_id == $billingprovider->id) ? 'selected' : ''}}>{{$billingprovider->professional_provider_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                            <input autocomplete="off"  type="hidden" name="billing_provider_id" value="{{$patient->billing_provider_id}}" class="form-control" >
                                            <div class="form-group col-md-6">
                                                <label for="">  First  Name <span class="required">* </span></label>
                                                <input autocomplete="off" type="text" name="first_name" value="{{$patient->first_name}}" class="form-control"  maxlength="100">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="">    Last Name     </label>
                                                <input autocomplete="off" type="text" name="last_name" value="{{$patient->last_name}}" class="form-control" maxlength="100">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for=""> MI     </label>
                                                <input autocomplete="off" type="text" name="mi" value="{{$patient->mi}}" class="form-control"  maxlength="25">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for=""> Suffix    </label>
                                                <input autocomplete="off" type="text" name="suffix" value="{{$patient->suffix}}" class="form-control"  maxlength="15">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="">   DOB  <span class="required">* </span>   </label>
                                                <input autocomplete="off" type="text" id="editDobId" name="dob" value="{{($patient->dob != "") ? date('m/d/Y',strtotime($patient->dob)) : ''}}" class="form-control"  maxlength="15">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="gender">   Gender  <span class="required">* </span>   </label>
                                                <select name="gender" class="form-control">
                                                    <option value="" class="option">Select</option>
                                                    <option value="Male" {{($patient->gender == 'Male') ? 'selected' : '' }}> Male</option>
                                                    <option value="Female" {{($patient->gender == 'Female') ? 'selected' : '' }}> Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for=""> SSN <span class="required">* </span>    </label>
                                                <input autocomplete="off" type="text" name="ssn_no" value="{{$patient->ssn_no}}" class="form-control" maxlength="25">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for=""> Address Line1 <span class="required">* </span>  </label>
                                                <input type name="address_line1" class="form-control" style="resize: none;" value="{{$patient->address_line1}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for=""> Address Line2 </label>
                                            <input type name="address_line2" class="form-control" style="resize: none;" value="{{$patient->address_line2}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="zipcode">   Zipcode  <span class="required">* </span>  </label>
                                            <input autocomplete="off" type="text" name="zipcode" value="{{$patient->zipcode}}" class="form-control" onkeypress="return isNumberKey(event)" maxlength="10">
                                        </div>
                                    </div>
                                            <div class="form-row">
                                            <div class="form-group col-md-6">
                                                    <label for=""> State  <span class="required">* </span> </label>
                                                    <select name="state_id" class="form-control stateDD" id="stateDD" data-validation-event="change" data-validation="required"
                                                        data-validation-error-msg="">
                                                            <option value="" class="option">Select</option>
                                                            @foreach ($states as $state)
                                                            <option value="{{$state["state_name"]}}" {{($patient->state_id == $state["state_name"]) ? "selected" : ""}}> {{$state["state_name"]}}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="cityDD"> City  <span class="required">* </span> </label>
                                                    <input type="text" name="city_id" id="cityDD" class="form-control cityDD" maxlength="55" value="{{$patient->city_id}}">
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for=""> Contact No.     </label>
                                                    <input autocomplete="off" type="text" name="contact_no" value="{{$patient->contact_no}}" class="form-control" onkeypress="return isContactNo(event)" maxlength="15">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for=""> Practice Internal ID    </label>
                                                    <input autocomplete="off" type="text" name="practice_id" value="{{$patient->practice_id}}" class="form-control" maxlength="55">
                                                </div>
                                            </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                            <button type="submit" class="btn btn-primary ladda-button"><span class="ladda-label">Submit</span></button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-3 mt-4 rightside">
                                    <div class="card">
                                    @include('patients.show-patient-info')
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('public/js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('public/js/controller/master_for_all.js') }}"></script>
<script>
    $( document ).ready(function() {
        $('#editDobId').datepicker({ dateFormat: 'mm/dd/yy', maxDate: new Date() });
        
    });
</script>
