@extends('layouts.home-new-app')
@section('content')
 
<!-- START: Breadcrumbs-->
    <div class="row  mt-2">
        <div class="col-12 d-flex align-self-center">
            <div class="sub-header mt-0 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto"><h2 class="margin05 mb-0">{{$title}}</h2></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ route('claimadministrators.index') }}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

       @if ($errors->any())
    <div class="row  mb-2">
        <div class="col-12 align-self-center">
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
 <link href="{{ asset('css/step-content.css') }}" rel="stylesheet">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card row-background ">
                <div class="card-body">
                <form id="frmClaim1" method="POST" action="{{ route('storeClaimAdminInfo') }}">
                   @csrf
                   <input type="hidden" id="claimAdminId" name="claimAdminId" class="form-control" value="{{ ($claimadministrator) ? $claimadministrator->id : null}}">
                    <div class="row">
                        <div class="col-12 p-2"> 
                            <fieldset>
                                <h4 class="px-1 py-0"><i class="fa-solid fa-user"></i> Main</h4>
                                    <!--<legend>Main</legend>-->
                                    <div class="form-row">
                                        <div class="form-holder col-md-4">
                                            <label for="" style="float:left;">  Name <span class="required">* </span>     </label>
                                            <input data-validation-event="change" data-validation="required" data-validation-error-msg="" type="text" name="claimName" class="form-control"  maxlength="155" value="{{($claimadministrator) ? $claimadministrator->name : null}}">
                                        </div>
                                        <div class="form-holder col-md-6">
                                            <label for="" style="float:left;"> Description  <span class="required">* </span>  </label>
                                            <textarea name="description" data-validation-event="change" data-validation="required" data-validation-error-msg="" class="form-control" style="resize: none;">{{ ($claimadministrator) ? $claimadministrator->description : null}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="" style="float:left;"> Type  <span class="required">* </span> </label>
                                            <select data-validation-event="change" data-validation="required" data-validation-error-msg="" name="company_type_id" class="form-control stateDD" id="stateDD">
                                                <option value="" class="option">Select</option>
                                                @foreach ($company_types as $company_type)
                                                <option value="{{$company_type->id}}" {{($claimadministrator) ? $claimadministrator->company_type_id == $company_type->id ? 'selected' : '' : ''}}> {{$company_type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                        <div class="form-group col-md-6">
                                            <label for="" style="float:left;">Payer ID  <span class="required">* </span>  </label>
                                            <input data-validation-event="change" data-validation="required" data-validation-error-msg="" type="text" name="payer_id" class="form-control" maxlength="25" value="{{ ($claimadministrator) ? $claimadministrator->payer_id : null}}">
                                        </div>
                                        
                                        
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="affiliated_entries" style="float:left;">Affiliated Entries  <span class="required">* </span>  </label>
                                            <textarea name="affiliated_entries" class="form-control" style="resize: none;">{{($claimadministrator) ? $claimadministrator->affiliated_entries : null}}</textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="" style="float:left;">  Website <span class="required">* </span>     </label>
                                            <input type="text" data-validation-event="change" data-validation="required" data-validation-error-msg="" name="claimWebsite" class="form-control"  maxlength="155" value="{{($claimadministrator) ? $claimadministrator->website : null}}">
                                        </div> 
                                        <div class="form-holder col-md-4">
                                            <label for="" style="float:left;"> Phone Number  <span class="required">* </span>  </label>
                                             <textarea name="phone_number" class="form-control" style="resize: none;">{{($claimadministrator && $claimadministrator->phone_number) ? $claimadministrator->phone_number : null}}</textarea> 
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="" style="float:left;"> Start Time    </label>
                                            <input type="time" name="start_time" class="form-control"  maxlength="10" value="{{ ($claimadministrator && $claimadministrator->start_time) ? $claimadministrator->start_time : null}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="" style="float:left;"> End Time    </label>
                                            <input type="time" name="end_time" class="form-control"  maxlength="10" value="{{ ($claimadministrator && $claimadministrator->end_time) ? $claimadministrator->end_time : null}}">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="" style="float:left;"> Time ZOne    </label>
                                             <select name="time_zone_type" class="form-control" id="time_zone_type">
                                                <option value="" class="option">Select</option>
                                                <option value="CST" {{ ($claimadministrator && $claimadministrator->time_zone_type == 'CST') ? 'selected' : ''}}>CST</option>
                                                <option value="EST" {{ ($claimadministrator && $claimadministrator->time_zone_type == 'EST') ? 'selected' : ''}}>EST</option>
                                                <option value="MST" {{ ($claimadministrator && $claimadministrator->time_zone_type == 'MST') ? 'selected' : ''}}>MST</option> 
                                                <option value="PST" {{ ($claimadministrator && $claimadministrator->time_zone_type == 'PST') ? 'selected' : ''}}>PST</option>
                                                <option value="EDT" {{ ($claimadministrator && $claimadministrator->time_zone_type == 'EDT') ? 'selected' : ''}}>EDT</option>
                                                <option value="PDT" {{ ($claimadministrator && $claimadministrator->time_zone_type == 'PDT') ? 'selected' : ''}}>PDT</option> 
                                            </select>
                                        </div>
                                    </div>   
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="" style="float:left;">Clearing House  <span class="required">* </span>  </label>
                                            <input data-validation-event="change" data-validation="required" data-validation-error-msg="" type="text" name="clearing_house" 
                                            class="form-control" maxlength="25" value="{{($claimadministrator) ? $claimadministrator->clearing_house : null}}">
                                        </div> 
                                        <div class="form-group col-md-4">
                                            <label for="" style="float:left;">    Email ID     </label>
                                            <input type="text" name="claimEmail" class="form-control"  maxlength="55" value="{{($claimadministrator && $claimadministrator->email) ? $claimadministrator->email : null}}">
                                        </div>
                                         <div class="form-holder col-md-4">
                                            <label for="" style="float:left;"> Fax Number  <span class="required">* </span>  </label>
                                            <input type="text" name="admin_fax_no" class="form-control"  maxlength="55" value="{{($claimadministrator && $claimadministrator->admin_fax_no) ? $claimadministrator->admin_fax_no : null}}">
                                        </div>  
                                    </div> 
                                    <div class="form-row">
                                        <div class="form-holder col-md-4">
                                            <label for="" style="float:left;"> Web Portal </label>
                                            <textarea name="bill_portal" class="form-control" style="resize: none;">{{ ($claimadministrator && $claimadministrator->bill_portal) ? $claimadministrator->bill_portal : null}}</textarea>
                                        </div>
                                       <div class="form-holder col-md-34">
                                            <label for="" style="float:left;"> Bill Process Flow Note     </label>
                                            <textarea name="bill_process_flow_note" class="form-control" style="resize: none;">{{($claimadministrator && $claimadministrator->bill_process_flow_note) ? $claimadministrator->bill_process_flow_note : '-'}}</textarea>
                                        </div>
                                        <div class="form-holder col-md-4">
                                            <label for="" style="float:left;"> Address     </label>
                                            <textarea name="admin_address" class="form-control" style="resize: none;">{{($claimadministrator && $claimadministrator->admin_address) ? $claimadministrator->admin_address : null}}</textarea>
                                        </div>
                                    </div>
                            </fieldset> 
                            <fieldset class="mt-2">
                                    <legend>Bill Review</legend>
                                    <div class="form-row">
                                        <div class="form-holder col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Contact No.</th>
                                                    <th>Website</th>
                                                    <th>Email</th>
                                                    <th>Fax</th>
                                                    <th>Address</th>
                                                    <th>Option</th>
                                                </tr>
                                                @php
                                                $k = 0; $total_claim_bill = count($claim_bills);
                                                @endphp
                                                @if(count($claim_bills) && !empty($claim_bills))
                                                    @foreach ($claim_bills as $claim_bill)
                                                    <tr id="row{{$k}}">
                                                        <td>
                                                            <input type="text" name="name[]"  value="{{$claim_bill->name}}" class="form-control"  maxlength="155" onkeypress="return isAlpha(event)">
                                                        </td>
                                                        <td><input type="text" name="contact_no[]"  value="{{$claim_bill->contact_no}}" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                                        <td><input type="text" name="website[]"  value="{{$claim_bill->website}}" class="form-control"  maxlength="155"></td>
                                                        <td><input type="text" name="email[]"  value="{{$claim_bill->email}}" class="form-control"  maxlength="55"></td>
                                                        <td><input type="text" name="fax_no[]"  value="{{$claim_bill->fax_no}}" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                                        <td><textarea name="address_line1[]"  class="form-control" style="resize: none;">{{$claim_bill->address_line1}}</textarea></td>
                                                        @if($k == 0)
                                                        <td><a id="addOption" href="javascript:void(0);" onclick="addReviewCtrl({{$total_claim_bill}})"> + Add More  </a></td>
                                                        @else
                                                            <td><a href="javascript:void(0);" onclick="removeCtrl('row{{$k}}')"> Remove  </a> </td>
                                                        @endif
                                                    </tr>
                                                    @php $k++;      @endphp
                                                    @endforeach
                                                @endif 
                                                <tr>
                                                    <td><input type="text" name="name[]" class="form-control"  maxlength="155"></td>
                                                    <td><input type="text" name="contact_no[]" class="form-control"  maxlength="25"></td>
                                                    <td><input type="text" name="website[]" class="form-control"  maxlength="155"></td>
                                                    <td><input type="text" name="email[]" class="form-control"  maxlength="55"></td>
                                                    <td><input type="text" name="fax_no[]" class="form-control"  maxlength="25"></td>
                                                    <td><textarea name="address_line1[]" class="form-control" style="resize: none;"></textarea></td>
                                                    <td><a id="addOption" href="javascript:void(0);" onclick="addReviewCtrl()"> + Add More  </a></td>
                                                </tr>
                                                @for($i = 1; $i <= 5; $i++)
                                                <tr id="row{{$i}}"  style="display:none;">
                                                    <td><input type="text" name="name[]" class="form-control"  maxlength="155"></td>
                                                    <td><input type="text" name="contact_no[]" class="form-control"  maxlength="25"></td>
                                                    <td><input type="text" name="website[]" class="form-control"  maxlength="55"></td>
                                                    <td><input type="text" name="email[]" class="form-control"  maxlength="55"></td>
                                                    <td><input type="text" name="fax_no[]" class="form-control"  maxlength="25"></td>
                                                    <td><textarea name="address_line1[]" class="form-control" style="resize: none;"></textarea></td>
                                                    <td><a href="javascript:void(0);" onclick="removeCtrl('row{{$i}}')"> Remove  </a> </td>
                                                </tr>
                                                @endfor 
                                            </table>
                                        </div> 
                                    </div>
                            </fieldset> 
                            <fieldset  class="mt-2">
                                    <legend>Authorization Info</legend>
                                        <div class="form-row">
                                            <div class="form-holder col-md-12">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>RFA Fax No.</th>
                                                        <th>Contact No.</th>
                                                        <th>Option</th>
                                                    </tr>
                                                     @php
                                                        $k = 0; $total_claim_auth = count($claim_auths);
                                                        @endphp
                                                        @if(count($claim_auths) && !empty($claim_auths))
                                                        @foreach ($claim_auths as $claim_auth)
                                                        <tr id="rfa{{$k}}">
                                                            <td>
                                                                <input type="hidden" name="rfaauths[{{$k}}][key]"  value="{{$claim_auth->id}}" >
                                                                <input type="text" name="rfa_fax_no[]" value="{{$claim_auth->rfa_fax_no}}" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)">
                                                            </td>
                                                            <td><input type="text" name="rfa_contact_no[]" value="{{$claim_auth->rfa_contact_no}}" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                                            @if($k == 0)
                                                            <td><a id="addRfaOption" href="javascript:void(0);" onclick="addRfaCtrl({{$total_claim_auth}})"> + Add More  </a></td>
                                                            @else
                                                            <td><a href="javascript:void(0);" onclick="removeCtrl('rfa{{$k}}')"> Remove  </a> </td>
                                                            @endif
                                                        </tr>
                                                        @php $k++; @endphp
                                                        @endforeach
                                                        @endif
                                                    <tr>
                                                        <td><input type="text" name="rfa_fax_no[]" class="form-control"  maxlength="25"></td>
                                                        <td><input type="text" name="rfa_contact_no[]" class="form-control"  maxlength="25"></td>
                                                        <td><a id="addRfaOption" href="javascript:void(0);" onclick="addRfaCtrl()"> + Add More  </a></td>
                                                    </tr>
                                                    @for($i = 1; $i <= 5; $i++)
                                                    <tr id="rfa{{$i}}"  style="display:none;">
                                                        <td><input type="text" name="rfa_fax_no[]" class="form-control"  maxlength="25"></td>
                                                        <td><input type="text" name="rfa_contact_no[]" class="form-control"  maxlength="25"></td>
                                                        <td><a href="javascript:void(0);" onclick="removeCtrl('rfa{{$i}}')"> Remove  </a> </td>
                                                    </tr>
                                                    @endfor
                                                </table>
                                            </div>
                                        </div>
                            </fieldset> 
                            <fieldset  class="mt-2">
                                    <legend>Mailing Address</legend>
                                    <div class="form-row">
                                        <div class="form-holder col-md-12">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>Company</th>
                                                    <th>Bill Treatment Type</th>
                                                    <th>Bill Submission Type</th>
                                                    <th>Address</th>
                                                    <th>Notes</th>
                                                    <th>Option</th>
                                                </tr>
                                                @php
                                                $k = 0; $total_claim_mails = count($claim_mails);
                                                @endphp
                                                @if(count($claim_mails) > 0 && !empty($claim_mails))
                                                @foreach ($claim_mails as $claim_mail)
                                                    <tr id="mail{{$k}}">
                                                        <td>
                                                            <input type="hidden" name="mailadr[{{$k}}][key]"  value="{{$claim_mail->id}}" >
                                                            <input type="text" name="company_name[]" value="{{$claim_mail->company_name}}" class="form-control"  maxlength="100">
                                                        </td>
                                                        <td>
                                                            <select name="bill_treatment_type_id[]" class="form-control">
                                                                <option value="" class="option">Select</option>
                                                                @foreach ($bill_treatment_types as $treatment_type)
                                                                <option value="{{$treatment_type->id}}" {{ (collect($claim_mail->bill_treatment_type_id)->contains($treatment_type->id)) ? 'selected' : '' }} > {{$treatment_type->bill_treatment_type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="bill_submission_type_id[0][]" class="form-control" multiple>
                                                                <option value="" class="option">Select</option>
                                                                @foreach ($bill_submission_types as $submission_type)
                                                                <option value="{{$submission_type->id}}" {{ (collect($claim_mail->bill_submission_type_id)->contains($submission_type->id)) ? 'selected' : '' }} > {{$submission_type->bill_submission_type}} </option>

                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><textarea name="mail_address_line1[]" class="form-control" style="resize: none;">{{$claim_mail->address_line1}}</textarea></td>
                                                        <td><textarea name="notes[]" class="form-control" style="resize: none;">{{$claim_mail->notes}}</textarea></td>
                                                        @if($k == 0)
                                                        <td><a id="addMailOption" href="javascript:void(0);" onclick="addMailCtrl({{$total_claim_mails}})"> + Add More  </a></td>
                                                        @else
                                                        <td><a href="javascript:void(0);" onclick="removeCtrl('mail{{$k}}')"> Remove  </a> </td>
                                                        @endif
                                                    </tr>
                                                @php $k++; @endphp
                                                @endforeach
                                                @endif
                                                <tr>
                                                    <td><input type="text" name="company_name[]" class="form-control"  maxlength="100"></td>
                                                    <td>
                                                        <select name="bill_treatment_type_id[]" class="form-control">
                                                            <option value="" class="option">Select</option>
                                                            @foreach ($bill_treatment_types as $treatment_type)
                                                            <option value="{{$treatment_type->id}}"> {{$treatment_type->bill_treatment_type }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="bill_submission_type_id[0][]" class="form-control" multiple>
                                                            <option value="" class="option">Select</option>
                                                            @foreach ($bill_submission_types as $submission_type)
                                                            <option value="{{$submission_type->id}}"> {{$submission_type->bill_submission_type }} </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><textarea name="mail_address_line1[]" class="form-control" style="resize: none;"></textarea></td>
                                                    <td><textarea name="notes[]" class="form-control" style="resize: none;"></textarea></td>
                                                    <td><a id="addMailOption" href="javascript:void(0);" onclick="addMailCtrl()"> + Add More  </a></td>
                                                </tr>
                                                @for($i = 1; $i <= 5; $i++)
                                                    <tr id="mail{{$i}}"  style="display:none;">
                                                        <td><input type="text" name="company_name[]" class="form-control"  maxlength="25"></td>
                                                        <td>
                                                            <select name="bill_treatment_type_id[]" class="form-control">
                                                                <option value="" class="option">Select</option>
                                                                @foreach ($bill_treatment_types as $treatment_type)
                                                                <option value="{{$treatment_type->id}}"> {{$treatment_type->bill_treatment_type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="bill_submission_type_id[{{$i}}][]" class="form-control" multiple>
                                                                <option value="" class="option">Select</option>
                                                                @foreach ($bill_submission_types as $submission_type)
                                                                <option value="{{$submission_type->id}}"> {{$submission_type->bill_submission_type }} </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><textarea name="mail_address_line1[]" class="form-control" style="resize: none;"></textarea></td>
                                                        <td><textarea name="notes[]" class="form-control" style="resize: none;"></textarea></td>
                                                        <td><a href="javascript:void(0);" onclick="removeCtrl('mail{{$i}}')"> Remove  </a> </td>
                                                    </tr>
                                                @endfor
                                            </table>
                                        </div>
                                    </div>
                            </fieldset> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                             <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
<script src="{{ asset('js/controller/claimadministrators.js') }}"></script>
<script>

</script>
<script type="text/javascript">
    function resetActive(event, percent, step, cStep, clickTab, removeClick) {
        $("#"+cStep).addClass('fade');
         $("#"+cStep).removeClass("active show");
        $("#"+step).addClass("active show");
        $("#"+step).removeClass('fade');
         $("#"+clickTab).addClass("active show");
         $("#"+removeClick).removeClass("active show");

    }
</script>