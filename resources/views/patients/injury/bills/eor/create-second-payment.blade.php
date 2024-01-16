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
        .confirmShowbox {
            font-family: Arial, Helvetica, sans-serif;
            width:90vw;
            max-width: 600px;
            //border: 2px solid #bbb;
            padding:3px;
            margin: 20px;
        }
        
       .confirmShowbox .title { 
            font-size:24px;
            font-weight: bold;
            font-color: #666;
        }
        
        .confirmShowbox .confirm {
            width: 50%;
            height: 40px;
            font-color: #666;
        }
        
        .confirmShowbox .divider {
            display: block;
            border-top: 1px solid #bbb;
            margin: 10px 0;
            clear: both;	
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
                                                    <form  action=" "   enctype="multipart/form-data" id="multipleBillPaymentFrm" class="form-horizontal ladda-form'" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="multiple_bill_id" id="multiple_bill_id" value="{{$injuryBillInfo->id}}">
                                                        <input type="hidden" name="stepType" id="stepType" value="2">
                                                        <input type="text" name="submissionType="submissionType" value="{{ ($paymentInId) ? 1 : null }}">
                                                        <input type="hidden" name="paymentInId" id="paymentInId" value="{{$paymentInId}}"> 
                                                         <input type="hidden" name="searchNext" id="searchNextId" value="">
                                                        <fieldset  id="">
                                                            <hr class="pb-2">
                                                            <legend><i class="fa fa-credit-card"></i> Bill Submission Payment</legend>
                                                            <div class="form-row">  
                                                                <div class="form-group col-md-4">
                                                                    <label for="">Bill ID</label>
                                                                    <input class="form-control" disabled value="{{ 'Bill00'.$injuryBillInfo->id}}">
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="bill_payment_claim_control_number">Payer Claim Control Number <span class="required">*</span></label>
                                                                    <input value="{{ ($paymentSubmissionInfo && $paymentSubmissionInfo != null) ? (($paymentSubmissionInfo->getPaymentInfo && $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo && $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo->payer_claim_control_cumber	) ? $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo->payer_claim_control_cumber : null) : null }}" id="bill_payment_claim_control_number_id" onkeyup="setProcessLevelStep();" data-validation-event="change" data-validation="required"  autocomplete="off"  type="text" name="bill_payment_claim_control_number"   class="form-control" maxlength="10">
                                                                    @if($errors->has('bill_payment_claim_control_number'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_payment_claim_control_number') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div> 
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-4 control-group">
                                                                    <label for="bill_single_payment_panalty_interest_paid">Penalty or Interest Paid </label>
                                                                    <div class="controls">
                                                                    <label class="radio inline">
                                                                        <input {{($paymentSubmissionInfo && $paymentSubmissionInfo->getPaymentInfo && $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo && $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo->panality_or_interest_paid && $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo->panality_or_interest_paid == 1) ? 'checked' : '' }} onClick="setProcessLevelStep();" type="radio" name="bill_single_payment_panalty_interest_paid" id="bill_single_payment_panalty_interest_paid1" value="1"/>
                                                                        YES
                                                                    </label>
                                                                    <label class="radio inline">
                                                                        <input  {{($paymentSubmissionInfo && $paymentSubmissionInfo->getPaymentInfo && $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo && $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo->panality_or_interest_paid && $paymentSubmissionInfo->getPaymentInfo->getBillPaymentMultipleClaimNumberInfo->panality_or_interest_paid == 2) ? 'checked' : '' }} onClick="setProcessLevelStep();" type="radio" name="bill_single_payment_panalty_interest_paid" id="bill_single_payment_panalty_interest_paid2" value="2"/>
                                                                        NO
                                                                    </label>
                                                                </div> 
                                                                </div>
                                                            </div>
                                                            <div class="form-row pt-2">  
                                                                <div class="col-sm-12 pl-0 pr-0">
                                                                    <div class="card mb-1">
                                                                        <div class="card-header">
                                                                            <h5 class="card-title text-warning"><i class="fa-solid fa-network-wired"></i> Procedure Code Detail</h5>
                                                                        </div>
                                                                        <div class="card-body2">
                                                                            <div class="table-responsive2">
                                                                                <table id="procedureCodeDetail"
                                                                                    class="table layout-secondary table-striped table-bordered">
                                                                                    <thead class="thead-dark main-head">
                                                                                        <tr> 
                                                                                            <td>Procedure Code</td>
                                                                                            <td>Units</td>
                                                                                            <td>Charge</td>
                                                                                            <td>Expected Fee Schedule</td>
                                                                                            <td>Calculated BR Reduction</td>
                                                                                            <td>Original Submission Payment</td>
                                                                                            <td>Bill Payment Total</td> 
                                                                                            <td>Balance Due</td>
                                                                                            <td>Expected Fee Schedule %</td>
                                                                                        </tr>

                                                                                    </thead>
                                                                                    <tbody id="tbodyDivId">
                                                                                        @php 
                                                                                            $pcUnitTot = 0;
                                                                                            $pcChargeTot = 0;
                                                                                            $pcExChargeTot = 0;
                                                                                            $pcCalBrTot = 0;
                                                                                            $pcOriginSubTot = 0;
                                                                                            $pcBillPaymentChargeTot = 0;
                                                                                            $pcWriteOfAmtChargeTot = 0; 
                                                                                            $pcDueBalanceChargeTot = 0;
                                                                                            $pcExFeePerChargeTot = 0;
                                                                                            $i = 1;
                                                                                        @endphp
                                                                                        @if ($injuryBillInfo && count($injuryBillInfo->getBillServices))
                                                                                            @foreach ($injuryBillInfo->getBillServices as $bill)
                                                                                                @php
                                                                                                    $pcUnit =0;  $pcCharge =0; $pcExCharge =0;  $pcCalBrCharge =0; $pcOriginSubCharge =0; $pcBillPaymentCharge =0;
                                                                                                    $pcWriteOfAmtCharge =0; $pcDueBalanceCharge =0; $pcExFeePerCharge =0; 
                                                                                                    $pcUnit = $bill->bill_units;
                                                                                                    $pcUnitTot += $bill->bill_units; 

                                                                                                    if($bill->master_unit_amount){
                                                                                                        $pcCharge = $bill->master_unit_amount;
                                                                                                    }
                                                                                                    else{
                                                                                                        if ($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->units) {
                                                                                                        $pcCharge = $bill->getMasterBillCPDCodeCharge->units; 
                                                                                                        }
                                                                                                        else{
                                                                                                            $pcCharge = $bill->master_unit_amount;
                                                                                                        }
                                                                                                    }
                                                                                                    if($bill->expected_fee_amt){
                                                                                                        $pcExCharge = $bill->expected_fee_amt;
                                                                                                    }
                                                                                                    else{
                                                                                                        if ($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit && $bill->getMasterBillCPDCodeCharge->units) {
                                                                                                            $pcExCharge = $bill->getMasterBillCPDCodeCharge->units - $bill->getMasterBillCPDCodeCharge->omfs_unit;
                                                                                                        }
                                                                                                        else{
                                                                                                            $pcExCharge = $bill->master_unit_amount;
                                                                                                        }
                                                                                                    }
                                                                                                    if($bill->calculated_br_amt){
                                                                                                        $pcCalBrCharge = $bill->calculated_br_amt;
                                                                                                    }
                                                                                                    if($bill->original_submission_amt){
                                                                                                        $pcOriginSubCharge = $bill->original_submission_amt;
                                                                                                    }
                                                                                                    if($bill->original_submission_amt){
                                                                                                        $pcBillPaymentCharge = $bill->original_submission_amt;
                                                                                                    }
                                                                                                    if($bill->due_balace_amt){
                                                                                                        $pcDueBalanceCharge = $bill->due_balace_amt;
                                                                                                    }
                                                                                                    if($bill->expected_fee_percent){
                                                                                                        $pcExFeePerCharge = $bill->expected_fee_percent;
                                                                                                    }
                                                                                                    $pcChargeTot                += $pcCharge;
                                                                                                    $pcExChargeTot              += $pcExCharge; 
                                                                                                    $pcCalBrTot                 += $pcCalBrCharge; 
                                                                                                    $pcOriginSubTot             += $pcOriginSubCharge;  
                                                                                                    $pcBillPaymentChargeTot     += $pcBillPaymentCharge; 
                                                                                                    $pcWriteOfAmtChargeTot      += $pcWriteOfAmtCharge;  
                                                                                                    $pcDueBalanceChargeTot      += $pcDueBalanceCharge;   
                                                                                                    $pcExFeePerChargeTot        += $pcExFeePerCharge;  
                                                                                                @endphp
                                                                                                <tr>
                                                                                                    <td> {{ $bill->bill_procedure_code }}</td>
                                                                                                    <td id="pcUnit_{{$i}}" class="pcUnit">{{ $pcUnit  }}</td>
                                                                                                    <td id="pcCharge_{{$i}}" class="pcCharge">{{ $pcCharge}}</td>
                                                                                                    <td id="expected_fee_shedule_{{$i}}" class="exFeeShedule">{{$pcExCharge}}</td>
                                                                                                    <td id="calculated_br_reduction_{{$i}}" class="calBrReduction">{{ $pcCalBrCharge}}</td>
                                                                                                    <td>
                                                                                                    <input type="hidden" name="procedure_code_master_id[]" id="bill_procedue_master_id_{{$i}}" value="{{ $bill->master_procedure_code_charge_id}}">
                                                                                                    <input type="hidden" name="bill_service_id[]" id="bill_service_id{{$i}}" value="{{ $bill->id}}">
                                                                                                    <input type="hidden" name="procedure_code[]" id="bill_procedue_code_id_{{$i}}" value="{{$bill->bill_procedure_code}}">
                                                                                                    <input type="hidden" name="procedure_unit[]" id="bill_procedue_unit_id{{$i}}" value="{{ $pcUnit}}">
                                                                                                    <input type="hidden" name="procedure_charge[]" id="pcCharge_input_id_{{$i}}">
                                                                                                    <input type="hidden" name="expected_fee_amt[]" id="expected_fee_shedule_input_id_{{$i}}">
                                                                                                    <input type="hidden" name="calculated_br_amt[]" id="calculated_br_reduction_input_id_{{$i}}">
                                                                                                    <input value="{{$pcBillPaymentCharge}}" class="form-control originalSubmiPayement" id="single_original_submission_payment_{{$i}}" autocomplete="off"  type="text" 
                                                                                                    name="original_submission_amt[]"  onkeyup="setOriginalPayment(this.value, {{$i}}, {{($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit) ? $bill->getMasterBillCPDCodeCharge->omfs_unit : 0 }}, {{ $pcCharge}})"  data-validation-event="change" data-validation="required, number" maxlength="10">
                                                                                                    <input type="hidden" name="procedure_payment_total[]" id="bill_payment_total_input_id_{{$i}}">
                                                                                                    <input type="hidden" name="due_balace_amt[]" id="bill_due_balance_id_{{$i}}">
                                                                                                    <input type="hidden" name="expected_fee_percent[]" id="bill_expected_fee_shedule_percent_id_{{$i}}">
                                                                                                    </td>
                                                                                                    <td id="bill_payment_total_{{$i}}" class="totalPayment">{{$pcBillPaymentCharge}}</td>
                                                                                                    <td id="bill_due_balance_{{$i}}" class="duesPayment">{{$pcDueBalanceCharge}}</td>
                                                                                                    <td id="bill_expected_fee_shedule_percent_{{$i}}" class="billExpectedFeeShedulePercent">{{$pcExFeePerCharge}}</td> 
                                                                                                    
                                                                                                </tr> 
                                                                                                @php $i++; @endphp
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <td scope="row"><b>Bill Totals</b></td>
                                                                                            <td id="pcCodeThUnitId"></td>
                                                                                            <td id="pcCodeTotalAmount"></td>
                                                                                            <td id="pcCodeExpectedFeeShedule"></td>
                                                                                            <td id="pcCodeCalculatedAmountId"></td>
                                                                                            <td id="pcCodeOriginAmountId"></td>
                                                                                            <td id="pcCodeBillPaymentId"></td> 
                                                                                            <td id="pcCodeDueAmountId"></td>
                                                                                            <td id="pcCodeDExpectedFeetPercentId"></td> 
                                                                                        </tr> 
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td><span id="showPaymentError"></span></td>
                                                                                            <td></td> 
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                    </tfoot>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                          
                                                        <div class="row pt-0 pl-0 ml-1 mt-1" style="margin-left:19px!important">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                                                <button onClick="showConfirmBoxBeforeSend()" data-toggle="modal" data-target="#showConfirmOrRevieButtonBox" type="button" class="btn btn-primary ladda-button"><span class="ladda-label">Add Bill Payment</span></button>
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
    <div class="modal fade" id="showConfirmOrRevieButtonBox" role="dialog"
        aria-labelledby="showConfirmOrRevieButtonBoxLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> 
                <div class="modal-content"> 
                    <div class="modal-body confirmShowbox">
                        <div class="row title">
                             <div class="col-lg-12"><span id="showTotalpaymentForThisBillDiv" class="pr-2"></span> <span>Bill Submission payment added </span></div>
                        </div> 
                    </div>
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="addBillPaymentInfoForMultiple('/search/bill/eor/multiple/',{{$paymentInId}});">Search for next</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="addBillPaymentInfoForMultiple('/review/multiple/bill/payment/',{{$paymentInId}});">Review it</button>
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
function showConfirmBoxBeforeSend(){
    let _url = '/get/total/payment/for/this/bill/';
    $.ajax({
        url: _url,
        type: 'POST',
        data: {_token:token, billId:<?php echo $injuryBillInfo->id;?>, paymentId:<?php echo $paymentInId;?>},
        success: function(response) {
            console.log('response', response);
            if(response){ 
                $("#showTotalpaymentForThisBillDiv").text(response);
            } 
        },
        error: function(response) {
            swal.fire(response.responseJSON.message, '', 'error');
        }
    });
} 
function addBillPaymentInfoForMultiple(newUrl, paymentId){
    let _url = '/save/multiple/bill/payment/post/';
    var obj = {};
    $('#multipleBillPaymentFrm').find('input').each(function() {

        var value = $(this).val().trim();
        var inputName = $(this).attr('name');

        if(value.length != 0) {
            obj[inputName] = value;
        }
    }); 
    console.log('#obj#', obj);
    $.ajax({
        url: _url,
        type: 'POST',
        data:$('#multipleBillPaymentFrm').serialize() + "&_token=" + token,
        success: function(result) {
            if(result == 1){
                //let newUrl = "/search/bill/eor/multiple/"+ <?php echo $paymentInId;?>;
                let fullUrl = newUrl + paymentId
                console.log('#newUrl#', newUrl);
                window.location.href=fullUrl;
            }
        },
        error: function(response) {
            swal.fire(response.responseJSON.message, '', 'error');
        }
    });
}
</script>
