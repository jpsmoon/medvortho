<style type="text/css">
    .hide{
        display: none;
    }
</style>
@extends('layouts.home-new-app')

@section('content')
    <!-- START: Breadcrumbs-->
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Edit Claim Administrator</h4></div>

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

<link href="{{ asset('css/step-content.css') }}" rel="stylesheet">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row step">
                                    <div id="div1" class="col-md-2 ml-4 activestep" onclick="javascript: resetActive(event, 0, '1');">
                                        <span class="fa fa-cloud-download"></span>
                                        <p>Main</p>
                                    </div>
                                    <div id="div2" class="col-md-2" onclick="javascript: resetActive(event, 20, '2');">
                                        <span class="fa fa-pencil"></span>
                                        <p>Bill Review</p>
                                    </div>
                                    <div id="div3" class="col-md-2" onclick="javascript: resetActive(event, 40, '3');">
                                        <span class="fa fa-refresh"></span>
                                        <p>Authorization Info</p>
                                    </div>
                                    <div id="div4" class="col-md-2" onclick="javascript: resetActive(event, 60, '4');">
                                        <span class="fa fa-dollar"></span>
                                        <p>Mailing Address</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 ml-4">
                                <input type="hidden" id="claimadministrator_id" class="form-control" value="{{$claimadministrator->id}}">
                                <div class="row setup-content step activeStepInfo" id="step-1">

                                    <form id="frmClaim1" action="{{ route('claimadministrators.update',$claimadministrator->id) }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                            <input type="hidden" name="step" class="form-control" value="step1">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;"> Type  <span class="required">* </span> </label>
                                                        <select name="company_type_id" class="form-control" id="stateDD">
                                                            <option value="" class="option">Select</option>
                                                            @foreach ($company_types as $company_type)
                                                            <option value="{{$company_type->id}}" {{$claimadministrator->company_type_id == $company_type->id ? 'selected' : ''}} > {{$company_type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;">   DaisyBill Payer ID  <span class="required">* </span>  </label>
                                                        <input type="text" name="payer_id" value="{{$claimadministrator->payer_id}}" class="form-control" maxlength="25">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;">  Payer  <span class="required">* </span>  </label>
                                                        <input type="text" name="payer_name" value="{{$claimadministrator->payer_name}}" class="form-control" maxlength="25">
                                                    </div>

                                                    <div class="form-holder col-md-6">
                                                        <label for="" style="float:left;">  Name <span class="required">* </span>     </label>
                                                        <input type="text" name="name" value="{{$claimadministrator->name}}" class="form-control"  maxlength="155" onkeypress="return isAlpha(event)">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;"> Alias Name     </label>
                                                        <input type="text" name="alias" value="{{$claimadministrator->alias}}" class="form-control"  maxlength="25" onkeypress="return isAlpha(event)">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;">  Contact No.       </label>
                                                        <input type="text" name="contact_no" value="{{$claimadministrator->contact_no}}" class="form-control"  onkeypress="return isContactNo(event)" maxlength="25">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;">  Website <span class="required">* </span>     </label>
                                                        <input type="text" name="website" value="{{$claimadministrator->website}}" class="form-control"  maxlength="155">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;">    Email ID     </label>
                                                        <input type="text" name="email" value="{{$claimadministrator->email}}" class="form-control"  maxlength="55">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;"> Start Time    </label>
                                                        <input type="time" name="start_time" value="{{$claimadministrator->start_time}}" class="form-control"  maxlength="10">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="" style="float:left;"> End Time    </label>
                                                        <input type="time" name="end_time" value="{{$claimadministrator->end_time}}" class="form-control"  maxlength="10">
                                                    </div>end_time
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-holder col-md-6">
                                                        <label for="" style="float:left;"> Description  <span class="required">* </span>  </label>
                                                        <textarea name="description" class="form-control" style="resize: none;">{{$claimadministrator->description}}</textarea>
                                                    </div>
                                                    <div class="form-holder col-md-6">
                                                        <label for="" style="float:left;"> Bill Process Flow Note     </label>
                                                        <textarea name="bill_process_flow_note" class="form-control" style="resize: none;">{{$claimadministrator->bill_process_flow_note}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                                    <button type="button" class="btn btn-primary" onclick="edit_claim('step1', 'frmClaim1')">Next</button>
                                                </div>
                                    </form>
                                </div>
                                <div class="row setup-content step hiddenStepInfo" id="step-2">
                                    <form id="frmClaim2" action="{{ route('claimadministrators.update',$claimadministrator->id) }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="step" class="form-control" value="step2">
                                    <input type="hidden" name="claim_admin_id" id="claim_admin_id" class="form-control" >

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
                                                <input type="hidden" name="billrvws[{{$k}}][key]"  value="{{$claim_bill->id}}" >
                                                <input type="text" name="billrvws[{{$k}}][name]"  value="{{$claim_bill->name}}" class="form-control"  maxlength="155" onkeypress="return isAlpha(event)">
                                            </td>
                                            <td><input type="text" name="billrvws[{{$k}}][contact_no]"  value="{{$claim_bill->contact_no}}" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                            <td><input type="text" name="billrvws[{{$k}}][website]"  value="{{$claim_bill->website}}" class="form-control"  maxlength="155"></td>
                                            <td><input type="text" name="billrvws[{{$k}}][email]"  value="{{$claim_bill->email}}" class="form-control"  maxlength="55"></td>
                                            <td><input type="text" name="billrvws[{{$k}}][fax_no]"  value="{{$claim_bill->fax_no}}" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                            <td><textarea name="billrvws[{{$k}}][address_line1]"  class="form-control" style="resize: none;">{{$claim_bill->address_line1}}</textarea></td>
                                            @if($k == 0)
                                            <td><a id="addOption" href="javascript:void(0);" onclick="addReviewCtrl({{$total_claim_bill}})"> + Add More  </a></td>
                                            @else
                                                <td><a href="javascript:void(0);" onclick="removeCtrl('row{{$k}}')"> Remove  </a> </td>
                                            @endif
                                        </tr>
                                        @php $k++;      @endphp
                                        @endforeach
                                        @endif

                                        @for($i = $total_claim_bill; $i <= 5; $i++)
                                        <tr id="row{{$i}}"  class ="{{$i > 0 ? 'hide' : ''}}">
                                            <td><input type="hidden" name="billrvws[{{$i}}][key]"  value="0" >
                                                <input type="text" name="billrvws[{{$i}}][name]"  onkeypress="return isAlpha(event)" class="form-control"  maxlength="155">
                                            </td>
                                            <td><input type="text" name="billrvws[{{$i}}][contact_no]"  class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                            <td><input type="text" name="billrvws[{{$i}}][website]" class="form-control"  maxlength="155"></td>
                                            <td><input type="text" name="billrvws[{{$i}}][email]" class="form-control"  maxlength="55"></td>
                                            <td><input type="text" name="billrvws[{{$i}}][fax_no]"  class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                            <td><textarea name="billrvws[{{$i}}][address_line1]"  class="form-control" style="resize: none;"></textarea></td>
                                            @if($i == 0)
                                            <td><a id="addOption" href="javascript:void(0);" onclick="addReviewCtrl()"> + Add More  </a></td>
                                            @else
                                                <td><a href="javascript:void(0);" onclick="removeCtrl('row{{$i}}')"> Remove  </a> </td>
                                            @endif
                                        </tr>
                                        @endfor
                                    </table>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="button" class="btn btn-primary pull-left" onclick="resetActive(event, 0, '1')">Prev</button>
                                        <button type="button" class="btn btn-primary pull-right" onclick="edit_claim('step2', 'frmClaim2')">Next</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="row setup-content step hiddenStepInfo" id="step-3">
                                    <form id="frmClaim3" action="{{ route('claimadministrators.update',$claimadministrator->id) }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="step" class="form-control" value="step3">
                                    <input type="hidden" name="claim_admin_step3" id="claim_admin_step3" class="form-control" >

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
                                                <input type="text" name="rfaauths[{{$k}}][rfa_fax_no]" value="{{$claim_auth->rfa_fax_no}}" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)">
                                            </td>
                                            <td><input type="text" name="rfaauths[{{$k}}][rfa_contact_no]" value="{{$claim_auth->rfa_contact_no}}" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                            @if($k == 0)
                                            <td><a id="addRfaOption" href="javascript:void(0);" onclick="addRfaCtrl({{$total_claim_auth}})"> + Add More  </a></td>
                                            @else
                                            <td><a href="javascript:void(0);" onclick="removeCtrl('rfa{{$k}}')"> Remove  </a> </td>
                                            @endif
                                        </tr>
                                        @php $k++; @endphp
                                        @endforeach
                                        @endif

                                        @for($i = $total_claim_auth; $i <= 5; $i++)
                                        <tr id="rfa{{$i}}" class ="{{$i > 0 ? 'hide' : ''}}">
                                            <td>
                                                <input type="hidden" name="rfaauths[{{$i}}][key]"  value="0" >
                                                <input type="text" name="rfaauths[{{$i}}][rfa_fax_no]" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                            <td><input type="text" name="rfaauths[{{$i}}][rfa_contact_no]" class="form-control"  maxlength="25" onkeypress="return isContactNo(event)"></td>
                                            @if($i == 0)
                                            <td><a id="addRfaOption" href="javascript:void(0);" onclick="addRfaCtrl()"> + Add More  </a></td>
                                            @else
                                            <td><a href="javascript:void(0);" onclick="removeCtrl('rfa{{$i}}')"> Remove  </a> </td>
                                            @endif
                                        </tr>
                                        @endfor
                                    </table>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="button" class="btn btn-primary pull-left" onclick="resetActive(event, 0, '2')">Prev</button>
                                        <button type="button" class="btn btn-primary pull-right" onclick="edit_claim('step3', 'frmClaim3')" >Next</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="row setup-content step hiddenStepInfo" id="step-4">
                                    <form id="frmClaim4" action="{{ route('claimadministrators.update',$claimadministrator->id) }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" name="step" class="form-control" value="step4">
                                    <input type="hidden" name="claim_admin_step4" id="claim_admin_step4" class="form-control" >

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
                                        @if(count($claim_mails) && !empty($claim_mails))
                                        @foreach ($claim_mails as $claim_mail)
                                        <tr id="mail{{$k}}">
                                            <td>
                                                <input type="hidden" name="mailadr[{{$k}}][key]"  value="{{$claim_mail->id}}" >
                                                <input type="text" name="mailadr[{{$k}}][company_name]" value="{{$claim_mail->company_name}}" class="form-control"  maxlength="25">
                                            </td>
                                            <td>
                                                <select name="mailadr[{{$k}}][bill_treatment_type_id]" class="form-control">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($bill_treatment_types as $treatment_type)
                                                    <option value="{{$treatment_type->id}}" {{ (collect($claim_mail->bill_treatment_type_id)->contains($treatment_type->id)) ? 'selected' : '' }} > {{$treatment_type->bill_treatment_type }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="mailadr[{{$k}}][bill_submission_type_id][]" class="form-control" multiple>
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($bill_submission_types as $submission_type)
                                                    <option value="{{$submission_type->id}}" {{ (collect($claim_mail->bill_submission_type_id)->contains($submission_type->id)) ? 'selected' : '' }} > {{$submission_type->bill_submission_type}} </option>

                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><textarea name="mailadr[{{$k}}][mail_address_line1]" class="form-control" style="resize: none;">{{$claim_mail->address_line1}}</textarea></td>
                                            <td><textarea name="mailadr[{{$k}}][notes]" class="form-control" style="resize: none;">{{$claim_mail->notes}}</textarea></td>
                                            @if($k == 0)
                                            <td><a id="addMailOption" href="javascript:void(0);" onclick="addMailCtrl({{$total_claim_mails}})"> + Add More  </a></td>
                                            @else
                                            <td><a href="javascript:void(0);" onclick="removeCtrl('mail{{$k}}')"> Remove  </a> </td>
                                            @endif
                                        </tr>
                                        @php $k++; @endphp
                                        @endforeach
                                        @endif

                                        @for($i = $total_claim_mails; $i <= 5; $i++)
                                        <tr id="mail{{$i}}" class="{{$i > 0 ? 'hide' : ''}}">
                                            <td>
                                                <input type="hidden" name="mailadr[{{$i}}][key]"  value="0" >
                                                <input type="text" name="mailadr[{{$i}}][company_name]" class="form-control"  maxlength="25">
                                            </td>
                                            <td>
                                                <select name="mailadr[{{$i}}][bill_treatment_type_id]" class="form-control">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($bill_treatment_types as $treatment_type)
                                                    <option value="{{$treatment_type->id}}"> {{$treatment_type->bill_treatment_type }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <select name="mailadr[{{$i}}][bill_submission_type_id][]" class="form-control" multiple>
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($bill_submission_types as $submission_type)
                                                    <option value="{{$submission_type->id}}"> {{$submission_type->bill_submission_type }} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><textarea name="mailadr[{{$i}}][mail_address_line1]" class="form-control" style="resize: none;"></textarea></td>
                                            <td><textarea name="mailadr[{{$i}}][notes]" class="form-control" style="resize: none;"></textarea></td>
                                            @if($i == 0)
                                            <td><a id="addMailOption" href="javascript:void(0);" onclick="addMailCtrl()"> + Add More  </a></td>
                                            @else
                                            <td><a href="javascript:void(0);" onclick="removeCtrl('mail{{$i}}')"> Remove  </a> </td>
                                            @endif
                                        </tr>
                                        @endfor
                                    </table>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="button" class="btn btn-primary pull-left" onclick="resetActive(event, 0, '3')">Prev</button>
                                        <button type="button" class="btn btn-primary pull-right" onclick="edit_claim('step4', 'frmClaim4')">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/controller/claimadministrators.js') }}"></script>
<script type="text/javascript">

    function resetActive(event, percent, step) {
        hideSteps();
        showCurrentStepInfo(step);
    }
    function hideSteps() {
        $("div").each(function () {
            if ($(this).hasClass("activeStepInfo")) {
                $(this).removeClass("activeStepInfo");
                $(this).addClass("hiddenStepInfo");
            }


        });
    }
    function showCurrentStepInfo(step) {
        var id = "#step-" + step;
        $(id).addClass("activeStepInfo");
        $("div").each(function () {
            if ($(this).hasClass("activestep")) {
                $(this).removeClass("activestep");
            }
        });
        $('#div'+step).addClass("activestep");
    }
</script>
@endsection
