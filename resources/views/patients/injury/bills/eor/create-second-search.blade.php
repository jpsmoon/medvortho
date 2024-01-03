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
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">  
                                                                {!! Form::open(['class' => 'form-horizontal','id' => 'billPaymentInfoSearch','method'=>"get"]) !!} 
                                                                <input type="hidden" name="billId" id="billId" value="{{$injuryBillInfo->id}}">
                                                                <input type="hidden" name="billPaymentId" id="billPaymentId" value="{{$paymentInId}}">
                                                                <input type="text" name="paymentBillId" id="paymentBillId" value="{{$paymentBillId}}">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="">Patient Name</label>
                                                                            <input autocomplete="off" value=""  type="text" name="patientName" id="patientName" class="form-control"> 
                                                                            @if($errors->has('patientName'))
                                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                                <strong class="invalid-feedback" >{{ $errors->first('patientName') }}</strong>
                                                                            </span>
                                                                            @endif 
                                                                        </div> 
                                                                        <div class="form-group col-md-2 input-icons">
                                                                            <label for="bill_dos">DOS </label>
                                                                            <input value="" autocomplete="off" value=""  type="text" id="bill_dos_id"  name="bill_dos"  class="form-control" maxlength="100">
                                                                            <i class="icon-calendar"></i>
                                                                            @if($errors->has('bill_dos'))
                                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                                <strong class="invalid-feedback" >{{ $errors->first('bill_dos') }}</strong>
                                                                            </span>
                                                                            @endif 
                                                                        </div> 
                                                                        <div class="form-group col-md-1">OR</div>
                                                                        <div class="form-group col-md-2">
                                                                            <label for="searchBillId">Bill Id </label>
                                                                            <input value="" autocomplete="off" value=""  type="text" id="searchBillId"  name="searchBillId"  class="form-control" maxlength="100">
                                                                             @if($errors->has('searchBillId'))
                                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                                <strong class="invalid-feedback" >{{ $errors->first('searchBillId') }}</strong>
                                                                            </span>
                                                                            @endif 
                                                                        </div> 
                                                                         <div class="form-group col-md-2 text-right pt-2">
                                                                            <label for="">&nbsp;</label>
                                                                            <button  type="submit" class="btn btn-primary ladda-button"><span class="ladda-label">Search</span></button>
                                                                        </div>
                                                                    </div> 
                                                                {!! Form::close() !!}
                                                                <div class="table-responsive" style="margin:4px;">
                                                                     <table id="exampleBill" class="table layout-secondary dataTable table-striped table-bordered">
                                                                            <thead class="thead-dark">
                                                                                <tr>
                                                                                    <th scope="col">Bill ID</th>
                                                                                    <th scope="col">DOS</th>
                                                                                    <th scope="col">Status</th>
                                                                                    <th scope="col">Patient</th>
                                                                                    <th scope="col">Claims Administrator</th>
                                                                                    <th scope="col">Charge</th>
                                                                                    <th scope="col">Provider</th> 
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                    @if($searchBills && count($searchBills) > 0)
                                                                                @foreach ($searchBills as $bill)
                                                                                    <tr>
                                                                                          <td>{{$bill['billId']}}</td> 
                                                                                         <td>{{$bill['dos']}}</td>
                                                                                         <td>{{$bill['status']}}</td>
                                                                                         <td>{{$bill['patientFullName']}}</td>
                                                                                         <td>{{$bill['claimAdminName']}}</td>
                                                                                         <td>{{$bill['billCharge']}}</td>
                                                                                         <td>{{$bill['providerName']}}
                                                                                            <span>
                                                                                                 <a class="btn btn-primary" href="{{ url('/add/multiple/bill/payment/post/') }}/{{$bill['billDbId']}}/{{$paymentInId}}"><i class="fa fa-plus"></i>
                                                                                                    Post
                                                                                                </a>
                                                                                            </span>
                                                                                         </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                @endIf
                                                                            </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                            <h5 class="card-title text-warning"><i class="fa-solid fa-network-wired"></i> Bill Submission Payments Added ({{($injuryBillInfo) ? count($injuryBillInfo->getBillPaymentOthers) : 0}})</h5>
                                                                        </div>
                                                                         <div class="col-md-2">
                                                                            <a href="/review/multiple/bill/payment/{{$injuryBillInfo->id}}" class="btn btn-primary"> <span>Review This</span></a>
                                                                         </div>
                                                                    </div> 
                                                                </div> 
                                                                <div class="card-body">  
                                                                    <div class="table-responsive" style="margin:4px; width:99.6%">
                                                                        <table id="exampleEORBill" class="table layout-secondary dataTable table-striped table-bordered">
                                                                                <thead class="thead-dark">
                                                                                    <tr>
                                                                                        <th scope="col">Bill ID</th>
                                                                                        <th scope="col">Patient</th>
                                                                                        <th scope="col">DOS</th>
                                                                                        <th scope="col">Charge</th>
                                                                                        <th scope="col">Expected Fee Schedule</th>
                                                                                        <th scope="col">Bill Payment Total</th>
                                                                                        <th scope="col">Expected Fee Schedule %</th> 
                                                                                        <th scope="col">Payment Amount</th> 
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                 @if($injuryBillInfo && $injuryBillInfo->getBillPaymentOthers)
                                                                                    @foreach ($injuryBillInfo->getBillPaymentOthers as $paymentInfo)
                                                                                    <tr>
                                                                                        <td>{{ 'Bill00'.$paymentInfo->getBillInfoForOtherPayment->id}}</td>
                                                                                        <td>
                                                                                        @if($injuryBillInfo->getBillInfo->getInjury && $injuryBillInfo->getBillInfo->getInjury->patient)
                                                                                        {{ ($injuryBillInfo->getBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getBillInfo->getInjury->patient->first_name : ''}}
                                                                                        {{ ($injuryBillInfo->getBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getBillInfo->getInjury->patient->last_name : ''}} 
                                                                                        @endif
                                                                                        </td>
                                                                                        <td> {{ ($injuryBillInfo && $injuryBillInfo->getBillInfo->dos) ? date('m/d/Y', strtotime($injuryBillInfo->getBillInfo->dos)) : ''}} </td>
                                                                                        @if($paymentInfo)
                                                                                                <td>{{($paymentInfo->procedure_charge ) ? $paymentInfo->procedure_charge : '' }}</td>
                                                                                                <td>{{($paymentInfo->expected_fee_amt ) ? $paymentInfo->expected_fee_amt : '' }}</td>
                                                                                                <td>{{($paymentInfo->procedure_payment_total ) ? $paymentInfo->procedure_payment_total : '' }}</td>
                                                                                                <td>{{($paymentInfo->expected_fee_percent ) ? $paymentInfo->expected_fee_percent : '' }}</td>
                                                                                            @endif
                                                                                            <td>{{($injuryBillInfo->payment_amount) ? $injuryBillInfo->payment_amount : ''}}</td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                @endIf
                                                                                </tbody>
                                                                        </table>
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
                </div> 
            </div> 
        </div>
        <div class="col-xl-3 col-lg-4 mt-0 rightside sticky" style="padding-left:5px!important; padding-right:5px!important; top:70px">
             @include('patients.show-patient-info')
        </div>
    </div>
    </div>
   
@endsection
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script> 
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script>
$(document).ready(function() {  
     $('#bill_dos_id').datepicker({
        dateFormat: 'mm/dd/yy', 
        changeMonth: true,
        changeYear: true,
    }); 
});
</script>
