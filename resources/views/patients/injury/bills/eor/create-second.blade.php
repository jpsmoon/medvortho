@extends('layouts.home-new-app')

@section('content')
<style>
        .showLoad {}

        .showLoad .progress {
            position: relative;
            height: 10px;
            width: 100%;
            border: 3px solid #f4a261;
            border-radius: 15px;
        }

        .progress .color {
            position: absolute;
            background-color: green;
            width: 0px;
            height: 10px;
            border-radius: 15px;
            animation: progres 4s infinite linear;
        }

        @keyframes progres {
            0% {
                width: 0%;
            }

            25% {
                width: 50%;
            }

            50% {
                width: 75%;
            }

            75% {
                width: 85%;
            }

            100% {
                width: 100%;
            }
        }

        .table .main-head td {
            color: #3C4244;
            background-color: #ccc;
            border-color: #3C4244;
        }

        .table .thead-dark th {
            color: #3C4244;
            background-color: #ccc;
            border-color: #3C4244;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #E3EBF3;
            border-top: 0px solid #E3EBF3;
        }

        .tab-content,
        .border-primary {
            border: 0px solid rgba(33, 40, 50, .125) !important;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 1px;
        }

        #multi-step-form-container ul.form-stepper {
            counter-reset: section;
            margin-bottom: 0.5rem;
        }
    </style>
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
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    
    <div class="row">
        <div class="col-xl-9 col-lg-9 bg-white">
            <div class="row">
                <div class="col-12 col-md-12 mt-1 mb-1 row-background2">
                    <!-- START: Breadcrumbs-->
                        <div class="row mt-0">
                            <div class="col-12  align-self-center">
                                <div class="sub-header mt-0 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                                    <div class="w-sm-100 mr-auto  margin05">
                                        <h2><i class="fa-solid fa-file-invoice-dollar"></i> {{ $title }}</h2>
                                    </div>

                                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                        <li class="breadcrumb-item">
                                            <a class="btn btn-primary" href="{{ url('/view/patient/injury/bill/info') }}/{{$injuryBillInfo->id}}"> Back</a> 
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    <!-- END: Breadcrumbs-->
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body"> 
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <nav>
                                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                                     <a onClick="changeUrl({{$injuryBillInfo->id}}, 'first', {{($paymentInId) ? $paymentInId : null}});" class="nav-item nav-link {{ ($tabId == 'first') ? 'active' : ''}}" id="single-payment-tab" data-toggle="tab"  href="javascript:void(0);
                                                     role="tab" aria-controls="single-payment" aria-selected="true"><i
                                                            class="fa-solid fa-list-check"></i> Single Bill Payment</a> 
                                                    <a onClick="changeUrl({{$injuryBillInfo->id}}, 'multiple', {{($paymentInId) ? $paymentInId : null}});" class="nav-item nav-link {{ ($tabId == 'multiple') ? 'active' : ''}}" id="multiple-payment-tab" data-toggle="tab"  href="javascript:void(0);
                                                       role="tab" aria-controls="multiple-payment" aria-selected="false"><i class="fa-solid fa-file-invoice-dollar"></i> Multiple Bill Payments</a> 
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent" style="border:0px solid #333">
                                                <div class="tab-pane fade {{ ($tabId == 'multiple') ? 'show active' : ''}}  pr-0 pl-0" id="multiple-bill-payment" role="tabpanel" aria-labelledby="multiple-payment-tab">
                                                    <div class="form-row pb-5">
                                                        <div class="col-md-12">
                                                            <div id="multi-step-form-container">
                                                                <!-- Form Steps / Progress Bar --> 
                                                                <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0"> 
                                                                    <li class="form-stepper-active text-center form-stepper-list" step="1" id="process_level_1">
                                                                        <a class="mx-2">
                                                                            <span class="form-stepper-circle">
                                                                                <span>1</span>
                                                                            </span>
                                                                            <div  class="label"> Payment Information</div>
                                                                        </a>
                                                                    </li>
                                                                    <li class=" {{($isSubmission) ? 'form-stepper-active' : 'form-stepper-unfinished' }} text-center form-stepper-list 
                                                                      step="2" id="process_level_2">
                                                                        <a class="mx-2">
                                                                            <span class="form-stepper-circle">
                                                                                <span>2</span>
                                                                            </span>
                                                                            <div  class="label text-muted">Bill Submission Payment </div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="form-stepper-unfinished text-center form-stepper-list" step="3" id="process_level_3">
                                                                        <a class="mx-2">
                                                                            <span class="form-stepper-circle">
                                                                                <span>3</span>
                                                                            </span>
                                                                            <div  class="label text-muted">Paper EOR </div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="form-stepper-unfinished text-center form-stepper-list" step="4" id="process_level_4">
                                                                        <a class="mx-2">
                                                                            <span class="form-stepper-circle">
                                                                                <span>4</span>
                                                                            </span>
                                                                            <div  class="label text-muted">Post </div>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form  action="{{ url('/save/multiple/first/step') }}"  enctype="multipart/form-data" id=multipleBillPaymentFrm" class="form-horizontal ladda-form'" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="multiple_bill_id" id="multiple_bill_id" value="{{$injuryBillInfo->id}}">
                                                        <input type="hidden" name="stepType" id="stepType" value="2">
                                                        <input type="text" name="submissionType="submissionType" value="{{ ($paymentInId) ? 1 : null }}">
                                                        <input type="hidden" name="paymentInId" id="paymentInId" value="{{$paymentInId}}"> 
                                                        <input type="text" name="pType" id="pType" value="{{$pType}}"> 
                                                        <fieldset id="showMultiplePaymentInforSubmissionRowId" }}">
                                                            <legend><i class="fa fa-credit-card"></i> Payment Information</legend>
                                                            <div class="form-row">  
                                                                <div class="form-group col-md-6">
                                                                    <label for="bill_payment_amount">Amount   <span class="required">*</span></label>
                                                                    <input type="text"  onkeyup="setProcessLevelStep();" id="bill_payment_amount_id"  data-validation-event="change" data-validation="required, number"  autocomplete="off"  name="bill_payment_amount" 
                                                                    value="{{($billPaymentInfo  && $billPaymentInfo->payment_amount) ?  $billPaymentInfo->payment_amount: null }}" class="form-control" maxlength="10">
                                                                    @if($errors->has('bill_payment_amount'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_payment_amount') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="bill_payment_reference_number">Reference Number   <span class="required">*</span></label>
                                                                    <input type="text" onkeyup="setProcessLevelStep();" id="bill_payment_reference_number_id"  data-validation-event="change" data-validation="required"  autocomplete="off" name="bill_payment_reference_number" 
                                                                    value="{{($billPaymentInfo  && $billPaymentInfo->refence_number) ?  $billPaymentInfo->refence_number: null }}" class="form-control" maxlength="10">
                                                                    @if($errors->has('bill_payment_reference_number'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_payment_reference_number') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-row"> 
                                                                <div class="form-group col-md-6 input-icons">
                                                                    <label for="bill_paymeny_effective_date"> Effective Date <span class="required">*</span></label>
                                                                    <input value="{{($billPaymentInfo  && $billPaymentInfo->payment_effective_date) ?  $billPaymentInfo->payment_effective_date: null }}" onkeyup="setProcessLevelStep();" autocomplete="off" value=""  type="text" id="bill_paymeny_effective_date_id"  name="bill_paymeny_effective_date"  data-validation-event="change" data-validation="required date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                                                                    <i class="icon-calendar"></i>
                                                                    @if($errors->has('bill_paymeny_effective_date'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_paymeny_effective_date') }}</strong>
                                                                    </span>
                                                                    @endif 
                                                                </div>
                                                                <div class="form-group col-md-6 input-icons">
                                                                    <label for="bill_paymeny_from"> Payment Form </label> 
                                                                    <select onChange="setProcessLevelStep();" name="bill_paymeny_from" class="form-control" id="bill_paymeny_from" >
                                                                        <option value="">-Select-</option>
                                                                        <option value="paper_check" {{($billPaymentInfo  && $billPaymentInfo->payment_from && $billPaymentInfo->payment_from == "paper_check") ?  'selected' : null }}>Check</option>
                                                                        <option value="eft" {{($billPaymentInfo  && $billPaymentInfo->payment_from && $billPaymentInfo->payment_from == "eft") ?  'selected' : null }}>EFT</option>
                                                                        <option value="virtual_credit_card" {{($billPaymentInfo  && $billPaymentInfo->payment_from && $billPaymentInfo->payment_from == "virtual_credit_card") ? 'selected' : null }}>Credit Card</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group col-md-3 pt-2">
                                                                    <label for="bill_single_payment_deposit">Payment Deposited</label>
                                                                    <div class="controls">
                                                                        <label class="radio inline">
                                                                            <input type="radio" {{($billPaymentInfo  && $billPaymentInfo->payment_deposite) ? 'checked' : null }} onClick="showDepositeDateDiv(this.value, 'showDepositDiv'); setProcessLevelStep();" name="bill_single_payment_deposit" id="bill_single_payment_deposit1" value="1"/>
                                                                            YES
                                                                        </label>
                                                                        <label class="radio inline">
                                                                            <input type="radio" {{($billPaymentInfo  && $billPaymentInfo->payment_deposite) ?  'checked' : null }} onClick="showDepositeDateDiv(this.value, 'showDepositDiv'); setProcessLevelStep();" name="bill_single_payment_deposit" id="bill_single_payment_deposit2" value="2"/>
                                                                            NO
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group col-md-3 input-icons d-none" id="showDepositDiv">
                                                                    <label for="bill_paymeny_deposite_date"> Deposit Date </label>
                                                                    <input type="text" value="{{($billPaymentInfo  && $billPaymentInfo->payment_deposit_date) ?  $billPaymentInfo->payment_deposit_date: null }}"  onkeyup="setProcessLevelStep();" autocomplete="off"  id="bill_paymeny_deposite_date_id"  name="bill_paymeny_deposite_date"  data-validation-event="change" data-validation="date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                                                                    <i class="icon-calendar"></i>
                                                                    @if($errors->has('bill_paymeny_deposite_date'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_paymeny_deposite_date') }}</strong>
                                                                    </span>
                                                                    @endif 
                                                                </div>
                                                            </div>
                                                        </fieldset>  
                                                        <div class="row pt-0 pl-0 ml-1 mt-1" style="margin-left:19px!important">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                                                <button  type="submit" class="btn btn-primary ladda-button"><span class="ladda-label">Add Bill Payment</span></button>
                                                            </div>
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
            </div> 
        </div>
        <div class="col-xl-3 col-lg-4 mt-0 rightside sticky" style="padding-left:5px!important; padding-right:5px!important; top:70px">
             @include('patients.show-patient-info')
        </div>
    </div>
    </div>
     <!-- Modal content -->
    <div class="modal fade" id="addWriteOfLetterrForCloseBillModal" role="dialog"
        aria-labelledby="addWriteOfLetterrForCloseBillModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
             <input type="hidden" name="billId" class="" id="billId_1" value="{{ $injuryBillInfo->id }}"> 
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addWriteOfLetterrForCloseBillModalLabel">Add Reason For Bill Close
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class=" col-md-9">
                                <label for="writeOfReason">Library Bill Write Off Reason<span class="required">*
                                    </span></label>
                                <select name="bill_provider_write_of_reason" class="form-control"
                                    data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="">
                                    <option value="">-Select-</option>
                                    @foreach ($providerReasonForCloseBill as $writeReason)
                                        <option value="{{ $writeReason->id }}">
                                            {{ $writeReason->reason_text ? substr($writeReason->reason_text, 0, 80) : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bill_provider_write_of_reason'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong
                                            class="invalid-feedback">{{ $errors->first('bill_provider_write_of_reason') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-9">
                                <label for="write_of_reason_description">Description <span class="required">*
                                    </span></label>
                                <textarea id="write_of_reason_description" data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="" class="form-control" rows="10" name="write_of_reason_description"> </textarea>
                                @if ($errors->has('description2'))
                                    <span class="invalid-feedback" style="display:block" role="alert"><strong
                                            class="invalid-feedback">{{ $errors->first('write_of_reason_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div> 
        </div>
    </div>
    <!-- Modal content -->
@endsection
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>

<script> 
function setOriginalPayment(val,index,omfs_unit, procedureChareg){
    console.log('procedureChareg', procedureChareg);
    var billPayment = 0;
    var balanceDue = 0;
    var totalPercent = 0;
    if(val > 0 && omfs_unit > 0 &&  omfs_unit > val){
        balanceDue = Math.round((omfs_unit - val));
    }
    if(val > 0 && omfs_unit > 0 &&  omfs_unit > val){
        totalPercent = Math.round((val / omfs_unit) *100);
    } 
    $("#bill_payment_total_"+index).text(val);
    $("#bill_due_balance_"+index).text(balanceDue);
    $("#calculated_br_reduction_"+index).text(balanceDue);
    $("#bill_expected_fee_shedule_percent_"+index).text(totalPercent);

    $('#pcCharge_input_id_'+ index).val(procedureChareg);
    $('#expected_fee_shedule_input_id_'+ index).val(omfs_unit);
    $('#calculated_br_reduction_input_id_'+ index).val(balanceDue);
    $('#bill_payment_total_input_id_'+ index).val(val);
    $('#bill_due_balance_id_'+ index).val(balanceDue);
    $('#bill_expected_fee_shedule_percent_id_'+ index).val(totalPercent); 
    setTotalForEveryTr();
} 
function removeDisableFromSpan(val){
    console.log('#removeDisableFromSpan#',val);
    if(val == 1){
        $('#writeOffReasonDiv').removeAttr("disabled");
         $('#writeOffReasonDiv').css('pointer-events', 'auto');
        $('#writeOffReasonDiv').addClass('text-primary');
    }
    else{
    $('#writeOffReasonDiv').attr("disabled");
    $('#writeOffReasonDiv').css('pointer-events', 'none');
    $('#writeOffReasonDiv').removeClass('text-primary');
    }
}
function showDepositeDateDiv(val, divId){
    if(val == 1){
        $("#"+divId).removeClass('d-none');
    }
    else{
        $("#"+divId).addClass('d-none');
    }
}
$(document).ready(function() {  
    setTotalForEveryTr(); 
    $('#bill_paymeny_effective_date_id').datepicker({
        dateFormat: 'mm/dd/yy', 
        changeMonth: true,
        changeYear: true,
    });
    $('#bill_paymeny_deposite_date_id').datepicker({
        dateFormat: 'mm/dd/yy', 
        changeMonth: true,
        changeYear: true,
    });
    
});

function setProcessLevelStep(){
    setTotalForEveryTr();
    //var singlePaymentAmt = $("#bill_payment_amount_id").val();
    //var singleReferenceNumber = $("#bill_payment_reference_number_id").val();
    //var singleControlNumber = $("#bill_payment_claim_control_number_id").val(); 
    //if(singlePaymentAmt && singlePaymentAmt != '' && singleReferenceNumber && singleReferenceNumber !=''){
        //$("#process_level_2").addClass("form-stepper-active");
        //$("#process_level_2").removeClass("form-stepper-unfinished");
    //}
    //if(singlePaymentAmt && singlePaymentAmt != '' && singleReferenceNumber && singleReferenceNumber !='' && singleControlNumber && singleControlNumber != ''){
        //$("#process_level_3").addClass("form-stepper-active");
        //$("#process_level_3").removeClass("form-stepper-unfinished");
    //} 
}
function setTotalForEveryTr(){
        console.log('checking function calling');
        var sumUnitAmt = 0; var sumCharegeAmt = 0; var sumExpectedFeeAmt = 0; var sumCalculateAmt = 0; var sumOriginalSubmisionAmt = 0; var sumTotalAmt = 0; var sumDueAmt = 0; var sumExpeFeePerAmt = 0;
        $('tr').each(function () { 
            $(this).find('.pcUnit').each(function () {
                var pcUnitAmt = $(this).text();
                if (!isNaN(pcUnitAmt) && pcUnitAmt.length !== 0) {
                    sumUnitAmt += parseFloat(pcUnitAmt);
                }
            });  
            $(this).find('.pcCharge').each(function (index) {
                var pcChargeAmt = $(this).text(); 
                if (!isNaN(pcChargeAmt) && pcChargeAmt.length !== 0) {
                    sumCharegeAmt += parseFloat(pcChargeAmt);
                }
            });
            $(this).find('.exFeeShedule').each(function () {
                var pcFeeSheduleAmt = $(this).text();
                if (!isNaN(pcFeeSheduleAmt) && pcFeeSheduleAmt.length !== 0) {
                    sumExpectedFeeAmt += parseFloat(pcFeeSheduleAmt);
                }
            });
            $(this).find('.calBrReduction').each(function (index) {
                var pcCalSumAmt = $(this).text(); 
                if (!isNaN(pcCalSumAmt) && pcCalSumAmt.length !== 0) {
                    sumCalculateAmt += parseFloat(pcCalSumAmt);
                }
            }); 
            $(this).find('.originalSubmiPayement').each(function () {
                var pcOriSubAmt = $(this).val();
                if (!isNaN(pcOriSubAmt) && pcOriSubAmt.length !== 0) {
                    sumOriginalSubmisionAmt += parseFloat(pcOriSubAmt);
                }
            });
            $(this).find('.totalPayment').each(function () {
                var pcTotAmt = $(this).text();
                if (!isNaN(pcTotAmt) && pcTotAmt.length !== 0) {
                    sumTotalAmt += parseFloat(pcTotAmt);
                }
            });
            $(this).find('.duesPayment').each(function () {
                var pcDueAmt = $(this).text();
                if (!isNaN(pcDueAmt) && pcDueAmt.length !== 0) {
                    sumDueAmt += parseFloat(pcDueAmt);
                }
            });
            $(this).find('.billExpectedFeeShedulePercent').each(function () {
                var pcExFeePercAmt = $(this).text();
                if (!isNaN(pcExFeePercAmt) && pcExFeePercAmt.length !== 0) {
                    sumExpeFeePerAmt += parseFloat(pcExFeePercAmt);
                }
            });
        });

        $('#pcCodeThUnitId').text(sumUnitAmt);
        $('#pcCodeTotalAmount').text(sumCharegeAmt);
        $('#pcCodeExpectedFeeShedule').text(sumExpectedFeeAmt);
        $('#pcCodeCalculatedAmountId').text(sumCalculateAmt);
        $('#pcCodeOriginAmountId').text(sumOriginalSubmisionAmt);
        $('#pcCodeBillPaymentId').text(sumTotalAmt);
        $('#pcCodeDueAmountId').text(sumDueAmt);
        $('#pcCodeDExpectedFeetPercentId').text(sumExpeFeePerAmt);
        let paymAmt = parseFloat($("#bill_payment_amount_id").val());  
}
function showOriginalBillSubmissionDiv(){
    if(!checkMultiStepNotBlank()){ 

    } 
    else{
        $("#bill_multiple_payment_amount_id").focus();
        $("#bill_multiple_payment_reference_number_id").focus();
        $("#bill_multiple_paymeny_effective_date_input_id").focus();
        $("#bill_multiple_paymeny_from").focus();
    }
}
function checkMultiStepNotBlank(){
    if($("#bill_multiple_payment_amount_id").val() == '' 
    && $("#bill_multiple_payment_reference_number_id").val() == '' 
    && $("#bill_multiple_paymeny_effective_date_input_id").val() == '' 
    && $("#bill_multiple_paymeny_from").val() == ''){
        return true;;
    }else{
        return false;
    } 
}  
</script>
