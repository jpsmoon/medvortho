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
        <div class="col-xl-12 col-lg-12 bg-white">
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
                                            <a class="btn btn-primary" href="{{ url('/view/patient/injury/bill') }}/{{$injuryBillInfo->id}}"> Back</a> 
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
                                                    <a class="nav-item nav-link {{ ($tabId == 'first') ? 'active' : ''}}" id="single-payment-tab" data-toggle="tab" href="#single-payment" role="tab" aria-controls="single-payment" aria-selected="true"><i
                                                            class="fa-solid fa-list-check"></i> Single Bill Payment</a>
                                                    <a class="nav-item nav-link {{ ($tabId == 'second') ? 'active' : ''}}" id="multiple-payment-tab" data-toggle="tab" href="#multiple-bill-payment"  role="tab" aria-controls="multiple-payment" aria-selected="false"><i
                                                            class="fa-solid fa-file-invoice-dollar"></i> Multiple Bill Payments</a>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent" style="border:0px solid #333">
                                                <div class="tab-pane fade {{ ($tabId == 'first') ? 'show active' : ''}} p-1" id="single-payment" role="tabpanel" aria-labelledby="single-payment-tab">
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
                                                                    <li class="form-stepper-unfinished text-center form-stepper-list" step="2" id="process_level_2">
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
                                                    <form  action="{{ url('/save/multiple/bill/payment') }}"  enctype="multipart/form-data" id=singleBillFrm" class="form-horizontal ladda-form'" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="single_bill_id" id="single_bill_id" value="{{$injuryBillInfo->id}}">
                                                        <input type="hidden" name="stepType" id="stepType" value="1">
                                                        <input type="hidden" name="paymentInId" id="paymentInId" value="{{$paymentInId}}">
                                                        
                                                         <fieldset>
                                                        <legend><i class="fa fa-credit-card"></i> Payment Information</legend>
                                                        <div class="form-row">  
                                                            <div class="form-group col-md-6">
                                                                <label for="bill_payment_amount">Amount   <span class="required">*</span></label>
                                                                <input type="text"  onkeyup="setProcessLevelStep();" id="bill_payment_amount_id"  data-validation-event="change" data-validation="required, number"  autocomplete="off"  name="bill_payment_amount" value="{{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_amount) ? $injuryBillInfo->getBillPaymentInfo->payment_amount : null}}" class="form-control" maxlength="10">
                                                                @if($errors->has('bill_payment_amount'))
                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                    <strong class="invalid-feedback" >{{ $errors->first('bill_payment_amount') }}</strong>
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="bill_payment_reference_number">Reference Number   <span class="required">*</span></label>
                                                                <input type="text" onkeyup="setProcessLevelStep();" id="bill_payment_reference_number_id"  data-validation-event="change" data-validation="required"  autocomplete="off" name="bill_payment_reference_number" value="{{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->refence_number) ? $injuryBillInfo->getBillPaymentInfo->refence_number : null}}" class="form-control" maxlength="10">
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
                                                                <input value="{{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_effective_date) ? $injuryBillInfo->getBillPaymentInfo->payment_effective_date : null}}" onkeyup="setProcessLevelStep();" autocomplete="off" value=""  type="text" id="bill_paymeny_effective_date_id"  name="bill_paymeny_effective_date"  data-validation-event="change" data-validation="required date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
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
                                                                    <option value="paper_check" {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_from && $injuryBillInfo->getBillPaymentInfo->payment_from == 'paper_check') ? 'selected' : '' }}>Check</option>
                                                                    <option value="eft" {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_from && $injuryBillInfo->getBillPaymentInfo->payment_from == 'eft') ? 'selected' : '' }}>EFT</option>
                                                                    <option value="virtual_credit_card" {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_from && $injuryBillInfo->getBillPaymentInfo->payment_from == 'virtual_credit_card') ? 'selected' : '' }}>Credit Card</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3 pt-2">
                                                                <label for="bill_single_payment_deposit">Payment Deposited</label>
                                                                <div class="controls">
                                                                    <label class="radio inline">
                                                                        <input type="radio" {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_deposite && $injuryBillInfo->getBillPaymentInfo->payment_deposite == 1) ? 'checked' : '' }} onClick="showDepositeDateDiv(this.value, 'showDepositDiv'); setProcessLevelStep();" name="bill_single_payment_deposit" id="bill_single_payment_deposit1" value="1"/>
                                                                        YES
                                                                    </label>
                                                                    <label class="radio inline">
                                                                        <input type="radio" {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_deposite && $injuryBillInfo->getBillPaymentInfo->payment_deposite == 2) ? 'checked' : '' }} onClick="showDepositeDateDiv(this.value, 'showDepositDiv'); setProcessLevelStep();" name="bill_single_payment_deposit" id="bill_single_payment_deposit2" value="2"/>
                                                                        NO
                                                                    </label>
                                                                </div> 
                                                            </div>
                                                            <div class="form-group col-md-3 input-icons {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_deposite && $injuryBillInfo->getBillPaymentInfo->payment_deposite == 1) ? ' ' : 'd-none' }}" id="showDepositDiv">
                                                                <label for="bill_paymeny_deposite_date"> Deposit Date </label>
                                                                <input value="{{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_deposit_date) ? $injuryBillInfo->getBillPaymentInfo->payment_deposit_date : null}}" onkeyup="setProcessLevelStep();" autocomplete="off" value=""  type="text" id="bill_paymeny_deposite_date_id"  name="bill_paymeny_deposite_date"  data-validation-event="change" data-validation="date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                                                                <i class="icon-calendar"></i>
                                                                @if($errors->has('bill_paymeny_deposite_date'))
                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                    <strong class="invalid-feedback" >{{ $errors->first('bill_paymeny_deposite_date') }}</strong>
                                                                </span>
                                                                @endif 
                                                            </div>
                                                        </div>
                                                        </fieldset>
                                                        <hr class="pb-2">
                                                         <fieldset>
                                                            <legend><i class="fa fa-credit-card"></i> Bill Submission Payment</legend>
                                                            <div class="form-row">  
                                                                <div class="form-group col-md-6">
                                                                    <label for="bill_payment_claim_control_number">Payer Claim Control Number <span class="required">*</span></label>
                                                                    <input value="{{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->refence_number) ? $injuryBillInfo->getBillPaymentInfo->refence_number : null}}" id="bill_payment_claim_control_number_id" onkeyup="setProcessLevelStep();" data-validation-event="change" data-validation="required"  autocomplete="off"  type="text" name="bill_payment_claim_control_number"   class="form-control" maxlength="10">
                                                                    @if($errors->has('bill_payment_claim_control_number'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_payment_claim_control_number') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div> 
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-5 control-group">
                                                                    <label for="bill_single_payment_panalty_interest_paid">Penalty or Interest Paid </label>
                                                                    <div class="controls">
                                                                    <label class="radio inline">
                                                                        <input {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->panality_or_interest_paid && $injuryBillInfo->getBillPaymentInfo->panality_or_interest_paid == 1) ? 'checked' : '' }} onClick="setProcessLevelStep();" type="radio" name="bill_single_payment_panalty_interest_paid" id="bill_single_payment_panalty_interest_paid1" value="1"/>
                                                                        YES
                                                                    </label>
                                                                    <label class="radio inline">
                                                                        <input {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->panality_or_interest_paid && $injuryBillInfo->getBillPaymentInfo->panality_or_interest_paid == 2) ? 'checked' : '' }} onClick="setProcessLevelStep();" type="radio" name="bill_single_payment_panalty_interest_paid" id="bill_single_payment_panalty_interest_paid2" value="2"/>
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
                                                                                                    <input type="hidden" name="bill_procedue_code_id[]" id="bill_procedue_code_id_{{$i}}" value="{{ $bill->id}}">
                                                                                                    <input value="{{$pcBillPaymentCharge}}" class="form-control originalSubmiPayement" id="single_original_submission_payment_{{$i}}" autocomplete="off"  type="text" 
                                                                                                    name="bill_payment_claim_original_submission_payment[]"  onkeyup="setOriginalPayment(this.value, {{$i}}, {{($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit) ? $bill->getMasterBillCPDCodeCharge->omfs_unit : 0 }}, {{ $pcCharge}})"  data-validation-event="change" data-validation="required, number" maxlength="10">
                                                                                                    <input type="hidden" name="pcCharge_input[]" id="pcCharge_input_id_{{$i}}">
                                                                                                    <input type="hidden" name="expected_shedule_input[]" id="expected_fee_shedule_input_id_{{$i}}">
                                                                                                    <input type="hidden" name="calculated_br_reduction_input[]" id="calculated_br_reduction_input_id_{{$i}}">
                                                                                                    <input type="hidden" name="bill_payment_total_input[]" id="bill_payment_total_input_id_{{$i}}">
                                                                                                    <input type="hidden" name="bill_due_balance_input[]" id="bill_due_balance_id_{{$i}}">
                                                                                                    <input type="hidden" name="bill_expected_fee_shedule_percent_input[]" id="bill_expected_fee_shedule_percent_id_{{$i}}">
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
                                                        <hr class="pt-2">
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="bill_payment_close_bill">Close Bill</label>
                                                                <div class="controls">
                                                                    <label class="radio inline">
                                                                        <input {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->bill_close && $injuryBillInfo->getBillPaymentInfo->bill_close == 1) ? 'checked' : '' }} type="radio" onClick="removeDisableFromSpan(this.value);setProcessLevelStep();" name="bill_payment_close_bill" id="bill_payment_close_bill1" value="1"/>
                                                                        YES
                                                                    </label>
                                                                    <label class="radio inline">
                                                                        <input {{($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->bill_close && $injuryBillInfo->getBillPaymentInfo->bill_close == 2) ? 'checked' : '' }} type="radio" onClick="removeDisableFromSpan(this.value);setProcessLevelStep();" name="bill_payment_close_bill" id="bill_payment_close_bill2" value="2"/>
                                                                        NO
                                                                    </label>
                                                                </div>  
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label> </label>
                                                                <span class="test-muted" disabled="" id="writeOffReasonDiv" data-toggle="modal" data-target="#addWriteOfLetterrForCloseBillModal" style="pointer-events: none;">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i> Write Off Reason
                                                                </span>
                                                            </div>
                                                        </div>
                                                         
                                                        <hr class="pt-2">
                                                        <fieldset class="pt-2">
                                                            <input type="hidden" name="injuryDocumentId" id="injuryDocumentId">
                                                            <legend><i class="fa fa-cloud-upload"></i>   Upload Paper EOR</legend>
                                                            @if ($injuryBillInfo && $injuryBillInfo->getBillInfo->getBillDocForPayment &&  $injuryBillInfo->getBillInfo->getBillDocForPayment && $injuryBillInfo->getBillInfo->getBillDocForPayment->injury_document)
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <a href="{{ asset('/injury_document/' . $injuryBillInfo->getBillInfo->getBillDocForPayment->injury_document) }}" target="_blank">
                                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="form-row">
                                                                <div class="form-group col-md-12">
                                                                    <div class="img-zone text-center" id="img-zone">
                                                                        <div class="img-drop">
                                                                            <h2><i class="fa-solid fa-cloud-arrow-up"></i></h2>
                                                                            <h2><small>Drag &amp; Drop File
                                                                                    Here</small></h2>
                                                                            <p><em>- or -</em></p>
                                                                            <span class="btn btn-success btn-file">
                                                                                Click to Open File Browser<input
                                                                                    type="file" name="myFile"
                                                                                    accept="application/pdf/*">
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="progress hidden">
                                                                        <div style="width: 0%" aria-valuemax="100"
                                                                            aria-valuemin="0" aria-valuenow="0"
                                                                            role="progressbar"
                                                                            class="progress-bar progress-bar-success progress-bar-striped active">
                                                                            <span class="sr-only">0% Complete</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset> 
                                                        <hr class="pt-4">
                                                         <div class="row pt-0 pl-0 ml-1 mt-1" style="margin-left:19px!important">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                                                <button  type="submit" class="btn btn-primary ladda-button"><span class="ladda-label">Post</span></button>
                                                            </div>
                                                        </div> 
                                                    </form>
                                                </div>
                                               <div class="tab-pane fade {{ ($tabId == 'second') ? 'show active' : ''}}  pr-0 pl-0" id="multiple-bill-payment" role="tabpanel" aria-labelledby="multiple-payment-tab">
                                                    <div class="form-row pb-5">
                                                        <div class="col-md-12">
                                                            <div id="multi-step-form-container">
                                                                <!-- Form Steps / Progress Bar --> 
                                                                <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0"> 
                                                                    <li class="form-stepper-active text-center form-stepper-list" step="1" id="multipleFirstStep1">
                                                                        <a class="mx-2">
                                                                            <span class="form-stepper-circle">
                                                                                <span>1</span>
                                                                            </span>
                                                                            <div  class="label"> Payment Information</div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="form-stepper-unfinished text-center form-stepper-list" step="2" id="multipleFirstStep2">
                                                                        <a class="mx-2">
                                                                            <span class="form-stepper-circle">
                                                                                <span>2</span>
                                                                            </span>
                                                                            <div  class="label text-muted">Bill Submission Payment </div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="form-stepper-unfinished text-center form-stepper-list" step="3" id="multipleFirstStep3">
                                                                        <a class="mx-2">
                                                                            <span class="form-stepper-circle">
                                                                                <span>3</span>
                                                                            </span>
                                                                            <div  class="label text-muted">Paper EOR </div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="form-stepper-unfinished text-center form-stepper-list" step="4" id="multipleFirstStep4">
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
                                                    <form  action="{{ url('/save/multiple/bill/payment') }}"  enctype="multipart/form-data" id="multiBillFrm" class="form-horizontal ladda-form'" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="multiple_bill_id" id="multiple_bill_id" value="{{$injuryBillInfo->id}}">
                                                        <input type="hidden" name="stepType" id="stepType" value="2">
                                                         <fieldset   id="showMultiplePaymentInforSubmissionRowId">
                                                            <legend><i class="fa fa-credit-card"></i> Payment Information</legend>
                                                            <div class="form-row">  
                                                                <div class="form-group col-md-3">
                                                                    <label for="bill_multiple_payment_amount">Amount   <span class="required">*</span></label>
                                                                    <input  data-validation-event="change" data-validation="required, number"  autocomplete="off"  type="text" id="bill_multiple_payment_amount_id" name="bill_multiple_payment_amount" value="" class="form-control" maxlength="10">
                                                                    @if($errors->has('bill_multiple_payment_amount'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_multiple_payment_amount') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label for="bill_multiple_payment_reference_number">Reference Number   <span class="required">*</span></label>
                                                                    <input id="bill_multiple_payment_reference_number_id" data-validation-event="change" data-validation="required"  autocomplete="off"  type="text" name="bill_multiple_payment_reference_number" value="" class="form-control" maxlength="10">
                                                                    @if($errors->has('bill_multiple_payment_reference_number'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_multiple_payment_reference_number') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-md-3 input-icons">
                                                                    <label for="bill_multiple_paymeny_effective_date"> Effective Date <span class="required">*</span></label>
                                                                    <input id="bill_multiple_paymeny_effective_date_id" autocomplete="off" value=""  type="text" id="bill_multiple_paymeny_effective_date_id"  name="bill_multiple_paymeny_effective_date"  data-validation-event="change" data-validation="required date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                                                                    <i class="icon-calendar"></i>
                                                                    @if($errors->has('bill_multiple_paymeny_effective_date'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_multiple_paymeny_effective_date') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                    <span class="invalid-feedback" style="display:none" role="alert" id="showInjuryDateError">
                                                                        <strong class="invalid-feedback" >DOS is before the injury's start date</strong>
                                                                    </span>
                                                                </div>
                                                                <div class="form-group col-md-3 input-icons">
                                                                    <label for="bill_multiple_paymeny_from"> Payment Form </label> 
                                                                    <select name="bill_multiple_paymeny_from" class="form-control" id="bill_multiple_paymeny_from" >
                                                                        <option value="">-Select-</option>
                                                                        <option value="paper_check">Check</option>
                                                                        <option value="eft">EFT</option>
                                                                        <option value="virtual_credit_card">Credit Card</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                             <div class="form-row">
                                                                <div class="form-group col-md-3 pt-2">
                                                                    <label for="bill_single_payment_deposit">Payment Deposited</label>
                                                                    <div class="controls">
                                                                        <label class="radio inline">
                                                                            <input type="radio" onClick="showDepositeDateDiv(this.value ,'showDepositMultiDiv');"   name="bill_multiple_payment_deposit" id="bill_multiple_payment_deposit1" value="1"/>
                                                                            YES
                                                                        </label>
                                                                        <label class="radio inline">
                                                                            <input type="radio" checked  onClick="showDepositeDateDiv(this.value ,'showDepositMultiDiv');" name="bill_multiple_payment_deposit" id="bill_multiple_payment_deposit2" value="2"/>
                                                                            NO
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                                <div class="form-group col-md-3 input-icons d-none" id="showDepositMultiDiv">
                                                                    <label for="bill_paymeny_deposite_date"> Deposit Date </label>
                                                                    <input value=""  autocomplete="off" value=""  type="text" id="bill_paymeny_multi_deposite_date_id"  name="bill_paymeny_multi_deposite_date"  data-validation-event="change" data-validation="date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                                                                    <i class="icon-calendar"></i>
                                                                    @if($errors->has('bill_paymeny_deposite_date'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_paymeny_deposite_date') }}</strong>
                                                                    </span>
                                                                    @endif 
                                                                </div>
                                                            </div> 
                                                        </fieldset>
                                                        <fieldset class="d-none" id="showOriginalBillSubmissionRowId">
                                                            <legend><i class="fa fa-credit-card"></i> Original Submission Payment</legend>
                                                            <div class="form-row">  
                                                                <div class="form-group col-md-4">
                                                                    <label for="billIdForMultiple">Bill ID </label>
                                                                    <input  autocomplete="off" disabled value="{{$injuryBillInfo->id}}"  type="text" name="bill_multiple_bill_id" value="" class="form-control" maxlength="10">
                                                                    @if($errors->has('bill_multiple_bill_id'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_multiple_bill_id') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="bill_payment_claim_control_number">Payer Claim Control Number <span class="required">*</span></label>
                                                                    <input value="" id="bill_multiple_payment_claim_control_number_id" data-validation-event="change" data-validation="required"  autocomplete="off"  type="text" name="bill_multiple_payment_claim_control_number"   class="form-control" maxlength="10">
                                                                    @if($errors->has('bill_multiple_payment_claim_control_number'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_multiple_payment_claim_control_number') }}</strong>
                                                                    </span>
                                                                    @endif
                                                                </div> 
                                                                <div class="form-group col-md-4">
                                                                    <label for="bill_multiple_payment_panalty_interest_paid">Penalty or Interest Paid </label>
                                                                    <div class="controls">
                                                                        <label class="radio inline">
                                                                            <input type="radio" name="bill_multiple_payment_panalty_interest_paid" id="bill_multiple_payment_panalty_interest_paid1" value="1"/>
                                                                            YES
                                                                        </label>
                                                                        <label class="radio inline">
                                                                            <input type="radio" name="bill_multiple_payment_panalty_interest_paid" id="bill_multiple_payment_panalty_interest_paid2" value="2"/>
                                                                            NO
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <div class="form-row">   
                                                                <div class="form-group col-md-12">
                                                                    <div class="card mb-1">
                                                                        <div class="card-header">
                                                                            <h5 class="card-title text-warning"><i class="fa-solid fa-network-wired"></i> Procedure Code Detail</h5>
                                                                        </div>
                                                                        <div class="card-body2">
                                                                            <div class="table-responsive2">
                                                                                <table id="procedureMultiCodeDetail"
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
                                                                                            $pcMultiUnitTot = 0;
                                                                                            $pcMultiChargeTot = 0;
                                                                                            $pcMultiExChargeTot = 0;
                                                                                            $pcMultiCalBrTot = 0;
                                                                                            $pcMultiOriginSubTot = 0;
                                                                                            $pcMultiBillPaymentChargeTot = 0;
                                                                                            $pcMultiWriteOfAmtChargeTot = 0; 
                                                                                            $pcMultiDueBalanceChargeTot = 0;
                                                                                            $pcMultiExFeePerChargeTot = 0;
                                                                                            $i = 1;
                                                                                        @endphp
                                                                                        @if ($injuryBillInfo && count($injuryBillInfo->getBillServices))
                                                                                            @foreach ($injuryBillInfo->getBillServices as $bill)
                                                                                                @php
                                                                                                    $pcMultiUnit =0;  $pcMultiCharge =0; $pcMultiExCharge =0;  $pcMultiCalBrCharge =0; $pcMultiOriginSubCharge =0; 
                                                                                                    $pcMultiBillPaymentCharge =0;
                                                                                                    $pcMultiWriteOfAmtCharge =0; $pcMultiDueBalanceCharge =0; $pcMultiExFeePerCharge =0; 
                                                                                                    $pcMultiUnit = $bill->bill_units;
                                                                                                    $pcMultiUnitTot += $bill->bill_units; 

                                                                                                    if($bill->master_unit_amount){
                                                                                                        $pcMultiCharge = $bill->master_unit_amount;
                                                                                                    }
                                                                                                    else{
                                                                                                        if ($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->units) {
                                                                                                        $pcMultiCharge = $bill->getMasterBillCPDCodeCharge->units; 
                                                                                                        }
                                                                                                        else{
                                                                                                            $pcMultiCharge = $bill->master_unit_amount;
                                                                                                        }
                                                                                                    }
                                                                                                    if($bill->expected_fee_amt){
                                                                                                        $pcMultiExCharge = $bill->expected_fee_amt;
                                                                                                    }
                                                                                                    else{
                                                                                                        if ($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit && $bill->getMasterBillCPDCodeCharge->units) {
                                                                                                            $pcMultiExCharge = $bill->getMasterBillCPDCodeCharge->units - $bill->getMasterBillCPDCodeCharge->omfs_unit;
                                                                                                        }
                                                                                                        else{
                                                                                                            $pcMultiExCharge = $bill->master_unit_amount;
                                                                                                        }
                                                                                                    }
                                                                                                    if($bill->calculated_br_amt){
                                                                                                        $pcMultiCalBrCharge = $bill->calculated_br_amt;
                                                                                                    }
                                                                                                    if($bill->original_submission_amt){
                                                                                                        $pcMultiOriginSubCharge = $bill->original_submission_amt;
                                                                                                    }
                                                                                                    if($bill->original_submission_amt){
                                                                                                        $pcMultiBillPaymentCharge = $bill->original_submission_amt;
                                                                                                    }
                                                                                                    if($bill->due_balace_amt){
                                                                                                        $pcMultiDueBalanceCharge = $bill->due_balace_amt;
                                                                                                    }
                                                                                                    if($bill->expected_fee_percent){
                                                                                                        $pcMultiExFeePerCharge = $bill->expected_fee_percent;
                                                                                                    }
                                                                                                    $pcMultiChargeTot                       += $pcMultiCharge;
                                                                                                    $pcMultiExChargeTot                     += $pcMultiExCharge; 
                                                                                                    $pcMultiCalBrTot                        += $pcMultiCalBrCharge; 
                                                                                                    $pcMultiOriginSubTot                    += $pcMultiOriginSubCharge;  
                                                                                                    $pcMultiBillPaymentChargeTot            += $pcMultiBillPaymentCharge; 
                                                                                                    $pcMultiWriteOfAmtChargeTot             += $pcMultiWriteOfAmtCharge;  
                                                                                                    $pcMultiDueBalanceChargeTot             += $pcMultiDueBalanceCharge;   
                                                                                                    $pcMultiExFeePerChargeTot               += $pcMultiExFeePerCharge;  
                                                                                                @endphp
                                                                                                <tr>
                                                                                                    <td> {{ $bill->bill_procedure_code }}</td>
                                                                                                    <td id="pcMultiUnit_{{$i}}" class="pcMultiUnit">{{ $pcMultiUnit  }}</td>
                                                                                                    <td id="pcMultiCharge_{{$i}}" class="pcMultiCharge">{{ $pcMultiCharge}}</td>
                                                                                                    <td id="expected_multi_fee_shedule_{{$i}}" class="exFeeMultiShedule">{{$pcMultiExCharge}}</td>
                                                                                                    <td id="calculated_multi_br_reduction_{{$i}}" class="calBrMultiReduction">{{ $pcMultiCalBrCharge}}</td>
                                                                                                    <td>
                                                                                                    <input id="bill_multi_procedue_code_id_{{$i}}" type="hidden" name="bill_multi_procedue_code[]" value="{{ $bill->id}}">
                                                                                                    <input id="multi_original_submission_payment_{{$i}}" value="{{$pcMultiBillPaymentCharge}}" class="form-control originalSubmiPayement"  autocomplete="off"  type="text" 
                                                                                                            name="bill_multi_payment_claim_original_submission_payment[]"  onkeyup="setEORPayment(this.value, {{$i}}, {{($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit) ? $bill->getMasterBillCPDCodeCharge->omfs_unit : 0 }}, {{ $pcMultiCharge}})"  data-validation-event="change" data-validation="required, number" maxlength="10">
                                                                                                    <input id="pc_Multi_Charge_input_id_{{$i}}" type="hidden" name="pcmulti_Charge_input[]">
                                                                                                    <input id="expected_multi_fee_shedule_input_id_{{$i}}" type="hidden" name="expected_multi_shedule_input[]">
                                                                                                    <input id="calculated_multi_br_reduction_input_id_{{$i}}" type="hidden" name="calculated_multi_br_reduction_input[]">
                                                                                                    <input id="bill_multi_payment_total_input_id_{{$i}}" type="hidden" name="bill_multi_payment_total_input[]">
                                                                                                    <input id="bill_multi_due_balance_id_{{$i}}" type="hidden" name="bill_multi_due_balance_input[]">
                                                                                                    <input id="bill_multi_expected_fee_shedule_percent_id_{{$i}}" type="hidden" name="bill_multi_expected_fee_shedule_percent_input[]">
                                                                                                    </td>
                                                                                                    <td id="bill_multi_payment_total_{{$i}}" class="totalMultiPayment">{{$pcMultiBillPaymentCharge}}</td>
                                                                                                    <td id="bill_multi_due_balance_{{$i}}" class="duesMultiPayment">{{$pcMultiDueBalanceCharge}}</td>
                                                                                                    <td id="bill_multi_expected_fee_shedule_percent_{{$i}}" class="billMultiExpectedFeeShedulePercent">{{$pcMultiExFeePerCharge}}</td> 
                                                                                                </tr> 
                                                                                                @php $i++; @endphp
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <td scope="row"><b>Bill Totals</b></td>
                                                                                            <td id="pcCodeMultiThUnitId"></td>
                                                                                            <td id="pcCodeMultiTotalAmount"></td>
                                                                                            <td id="pcCodeMultiExpectedFeeShedule"></td>
                                                                                            <td id="pcCodeMultiCalculatedAmountId"></td>
                                                                                            <td id="pcCodeMultiOriginAmountId"></td>
                                                                                            <td id="pcCodeMultiBillPaymentId"></td> 
                                                                                            <td id="pcCodeMultiDueAmountId"></td>
                                                                                            <td id="pcCodeMultiDExpectedFeetPercentId"></td> 
                                                                                        </tr> 
                                                                                        <tr>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td></td>
                                                                                            <td><span id="showMultiPaymentError"></span></td>
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
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="bill_multi_payment_close_bill">Close Bill</label>
                                                                    <div class="controls">
                                                                        <label class="radio inline">
                                                                            <input  type="radio"  name="bill_multi_payment_close_bill" id="bill_multi_payment_close_bill1" value="1"/>
                                                                            YES
                                                                        </label>
                                                                        <label class="radio inline">
                                                                            <input type="radio"  name="bill_multi_payment_close_bill" id="bill_multi_payment_close_bill2" value="2"/>
                                                                            NO
                                                                        </label>
                                                                    </div>  
                                                                </div>
                                                                <div class="form-group col-md-3">
                                                                    <label> </label>
                                                                    <span class="test-muted" disabled="" id="writeMultiOffReasonDiv" data-toggle="modal" data-target="#addMultiWriteOfLetterrForCloseBillModal" style="pointer-events: none;">
                                                                        <i class="fa fa-plus" aria-hidden="true"></i> Write Off Reason
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </fieldset>   

                                                        <hr class="pt-4">
                                                         <div class="row pt-0 pl-0 ml-1 mt-1" style="margin-left:19px!important">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                                                <button onClick="showOriginalBillSubmissionDiv();"  type="button" class="btn btn-primary ladda-button"><span class="ladda-label">Add Bill Payment</span></button>
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
    </div>
    </div>
     <!-- Modal content -->
    <div class="modal fade" id="addWriteOfLetterrForCloseBillModal" role="dialog"
        aria-labelledby="addWriteOfLetterrForCloseBillModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ route('addbillWriteOfReasonForCloseBill') }}"
                id="addbillWriteOfReasonForCloseBillId">
                @csrf
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
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
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
    console.log('#balanceDue#',balanceDue);
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
    $('#bill_multiple_paymeny_effective_date_id').datepicker({
        dateFormat: 'mm/dd/yy', 
        changeMonth: true,
        changeYear: true,
    });
    $('#bill_paymeny_multi_deposite_date_id').datepicker({
        dateFormat: 'mm/dd/yy', 
        changeMonth: true,
        changeYear: true,
    }); 
});
function setProcessLevelStep(){
    setTotalForEveryTr();
    var singlePaymentAmt = $("#bill_payment_amount_id").val();
    var singleReferenceNumber = $("#bill_payment_reference_number_id").val();
    var singleControlNumber = $("#bill_payment_claim_control_number_id").val();
    console.log('#singlePaymentAmt#', singlePaymentAmt);
    if(singlePaymentAmt && singlePaymentAmt != '' && singleReferenceNumber && singleReferenceNumber !=''){
        $("#process_level_2").addClass("form-stepper-active");
        $("#process_level_2").removeClass("form-stepper-unfinished");
    }
    if(singlePaymentAmt && singlePaymentAmt != '' && singleReferenceNumber && singleReferenceNumber !='' && singleControlNumber && singleControlNumber != ''){
        $("#process_level_3").addClass("form-stepper-active");
        $("#process_level_3").removeClass("form-stepper-unfinished");
    } 
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

    if(sumOriginalSubmisionAmt != 0 && (sumOriginalSubmisionAmt > paymAmt || sumOriginalSubmisionAmt < paymAmt)){
        $("#showPaymentError").text('Does not match payment amount'); 
        $("#showPaymentError").addClass('help-block');
    }
    else{
        $("#showPaymentError").text('');
        $("#showPaymentError").removeClass('help-block');
    } 
}
    function showOriginalBillSubmissionDiv(){
        console.log('#checkMultiStepNotBlank#', checkMultiStepNotBlank());
        console.log('#check#', !checkMultiStepNotBlank());
        if(!checkMultiStepNotBlank()){
            setMultiLevelStep();
            if($("#showOriginalBillSubmissionRowId").hasClass('d-none')){
                $("#showOriginalBillSubmissionRowId").removeClass('d-none');
                $("#showMultiplePaymentInforSubmissionRowId").addClass('d-none');
            }
            else{
                $("#showOriginalBillSubmissionRowId").addClass('d-none');
                $("#showMultiplePaymentInforSubmissionRowId").removeClass('d-none');
            }
        } 
        else{
            //$("#bill_multiple_payment_amount_id").trigger('keyup');
            //$("#bill_multiple_payment_reference_number_id").attr("data-validation","required");
            $("#bill_multiple_payment_amount_id").focus();
            $("#bill_multiple_payment_reference_number_id").focus();
            $("#bill_multiple_paymeny_effective_date_id").focus();
            $("#bill_multiple_paymeny_from").focus();
        }
    }
    function checkMultiStepNotBlank(){
        if($("#bill_multiple_payment_amount_id").val() == '' 
        && $("#bill_multiple_payment_reference_number_id").val() == '' 
        && $("#bill_multiple_paymeny_effective_date_id").val() == '' 
        && $("#bill_multiple_paymeny_from").val() == ''){
            return true;;
        }else{
            return false;
        } 
    }
    function setMultiLevelStep(){  
        if($("#bill_multiple_payment_amount_id").val() != '' && $("#bill_multiple_payment_reference_number_id").val() != '' && $("#bill_multiple_paymeny_effective_date_id").val() != '' && $("#bill_multiple_paymeny_from").val() != ''){
            $("#multipleFirstStep1").addClass("form-stepper-active");
            $("#multipleFirstStep1").removeClass("form-stepper-unfinished");
            $("#multipleFirstStep2").addClass("form-stepper-active");
            $("#multipleFirstStep2").removeClass("form-stepper-unfinished");
        } 
    }
</script>
