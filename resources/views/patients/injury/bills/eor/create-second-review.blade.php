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
     @php $paymentTotal = 0;@endphp
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
                                            <a class="btn btn-primary" href="{{ url('/view/patient/injury/bill/info') }}/{{$billPaymentInfo->bill_id}}"> Back</a> 
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
                                                     <a onClick="changeUrl({{$billPaymentInfo->bill_id}}, 'first', {{($paymentInId) ? $paymentInId : null}});" class="nav-item nav-link {{ ($tabId == 'first') ? 'active' : ''}}" id="single-payment-tab" data-toggle="tab"  href="javascript:void(0);
                                                     role="tab" aria-controls="single-payment" aria-selected="true"><i
                                                            class="fa-solid fa-list-check"></i> Single Bill Payment</a> 
                                                    <a onClick="changeUrl({{$billPaymentInfo->bill_id}}, 'multiple', {{($paymentInId) ? $paymentInId : null}});" class="nav-item nav-link {{ ($tabId == 'multiple') ? 'active' : ''}}" id="multiple-payment-tab" data-toggle="tab"  href="javascript:void(0);
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
                                                                    <li class=" form-stepper-active text-center form-stepper-list 
                                                                      step="2" id="process_level_2">
                                                                        <a class="mx-2">
                                                                            <span class="form-stepper-circle">
                                                                                <span>2</span>
                                                                            </span>
                                                                            <div  class="label text-muted">Bill Submission Payment </div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="form-stepper-active text-center form-stepper-list" step="3" id="process_level_3">
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
                                                    <form  action="{{ url('add/bill/payment/post/document') }}"  enctype="multipart/form-data" id=multipleBillPaymentFrm" class="form-horizontal ladda-form'" method="POST">
                                                        @csrf
                                                        <input type="text" name="mainPaymentId" id="mainPaymentId" value="{{$billPaymentInfo->id}}"> 
                                                        <div class="row">
                                                           <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-body">  
                                                                        <fieldset>
                                                                            <legend><i class="fa fa-credit-card"></i> Payment Information</legend>
                                                                            <div class="form-row">  
                                                                                <div class="form-group col-md-2">
                                                                                    <label for="bill_payment_amount">Amount {{$paymentTotal}}##{{$billPaymentInfo->payment_amount}}</label>
                                                                                    <input disabled type="text" id="bill_payment_amount_id"  data-validation="{{($paymentTotal != $billPaymentInfo->payment_amount) ? "required, number" : ''}}"  autocomplete="off"  name="bill_payment_amount" 
                                                                                    value="{{$billPaymentInfo->payment_amount}}" class="form-control"  maxlength="10">
                                                                                        @if($errors->has('bill_payment_amount'))
                                                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                                                            <strong class="invalid-feedback" >{{ $errors->first('bill_payment_amount') }}</strong>
                                                                                        </span>
                                                                                        @endif
                                                                                </div>
                                                                                <div class="form-group col-md-2">
                                                                                    <label for="bill_payment_reference_number">Reference Number</label>
                                                                                    <input disabled type="text"  id="bill_payment_reference_number_id"  data-validation-event="change" data-validation="required"  autocomplete="off" name="bill_payment_reference_number" 
                                                                                    value="{{$billPaymentInfo->refence_number}}" class="form-control" maxlength="10">
                                                                                    @if($errors->has('bill_payment_reference_number'))
                                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_payment_reference_number') }}</strong>
                                                                                    </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="form-group col-md-2 input-icons">
                                                                                    <label for="bill_paymeny_effective_date"> Effective Date </label>
                                                                                    <input  disabled value="{{$billPaymentInfo->payment_effective_date}}" autocomplete="off"  type="text" id="bill_paymeny_effective_date_id"  name="bill_paymeny_effective_date"  data-validation-event="change" data-validation="required date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                                                                                    <i class="icon-calendar"></i>
                                                                                    @if($errors->has('bill_paymeny_effective_date'))
                                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                                        <strong class="invalid-feedback" >{{ $errors->first('bill_paymeny_effective_date') }}</strong>
                                                                                    </span>
                                                                                    @endif 
                                                                                </div>
                                                                                <div class="form-group col-md-2 input-icons">
                                                                                    <label for="bill_paymeny_from"> Payment Form </label> 
                                                                                    <select disabled onChange="setProcessLevelStep();" name="bill_paymeny_from" class="form-control" id="bill_paymeny_from" >
                                                                                        <option value="">-Select-</option>
                                                                                        <option value="paper_check" {{($billPaymentInfo->payment_from == 'paper_check') ? 'selected' : ''}}>Check</option>
                                                                                        <option value="eft" {{($billPaymentInfo->payment_from == 'eft') ? 'selected' : ''}}>EFT</option>
                                                                                        <option value="virtual_credit_card" {{($billPaymentInfo->payment_from == 'virtual_credit_card') ? 'selected' : ''}}>Credit Card</option>
                                                                                    </select>
                                                                                </div> 
                                                                                @if($billPaymentInfo->payment_deposite == 1)
                                                                                    <div class="form-group col-md-2 input-icons">
                                                                                        <label for="bill_paymeny_deposite_date"> Deposit Date </label>
                                                                                        <input disabled value="{{$billPaymentInfo->payment_deposit_date}}" autocomplete="off" value=""  type="text" id="bill_paymeny_deposite_date_id"  name="bill_paymeny_deposite_date"  data-validation-event="change" data-validation="date" data-validation-format="mm/dd/yyyy"  data-validation-error-msg="" autocomplete="off" class="form-control" maxlength="100">
                                                                                        <i class="icon-calendar"></i>
                                                                                        @if($errors->has('bill_paymeny_deposite_date'))
                                                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                                                            <strong class="invalid-feedback" >{{ $errors->first('bill_paymeny_deposite_date') }}</strong>
                                                                                        </span>
                                                                                        @endif 
                                                                                    </div>
                                                                                @endif 
                                                                                <div class="form-group col-md-2 pt-2">
                                                                                    <button class="btn btn-outline-success"><a href="{{ url('/bill/payment/postings/new/multiple') }}/{{$billPaymentInfo->bill_id}}/{{$billPaymentInfo->id}}/{{'update'}}"><i class="icon-pencil  showPointer"></i>Edit</a></button>
                                                                                </div>
                                                                            </div>  
                                                                        </fieldset> 
                                                                    </div> 
                                                                </div> 
                                                           </div>
                                                        </div>
                                                        <div class="row">
                                                           <div class="col-12">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <div class="row">
                                                                            <div class="col-md-10">
                                                                                <h5 class="card-title text-warning"><i class="fa-solid fa-network-wired"></i> Bill Submission Payments Added ({{($billPaymentInfo) ? count($billPaymentInfo->getBillPaymentOthers) : 0}})</h5>
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <a href="{{ url('/search/bill/eor/multiple') }}/{{$paymentInId}}" class="btn btn-primary"> <span>Add</span></a>
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
                                                                                            <th></th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                    @if($billPaymentInfo && $billPaymentInfo->getBillPaymentOthers) 
                                                                                        @foreach ($billPaymentInfo->getBillPaymentOthers as $paymentInfo)
                                                                                        @php $paymentTotal += $paymentInfo->procedure_payment_total;@endphp
                                                                                        <tr>
                                                                                            <td>{{ 'Bill00'.$paymentInfo->getBillInfoForOtherPayment->id}}</td>
                                                                                            <td>
                                                                                            @if($billPaymentInfo->getBillInfo->getInjury && $billPaymentInfo->getBillInfo->getInjury->patient)
                                                                                            {{ ($billPaymentInfo->getBillInfo->getInjury->patient->first_name) ? $billPaymentInfo->getBillInfo->getInjury->patient->first_name : ''}}
                                                                                            {{ ($billPaymentInfo->getBillInfo->getInjury->patient->last_name) ? $billPaymentInfo->getBillInfo->getInjury->patient->last_name : ''}} 
                                                                                            @endif
                                                                                            </td>
                                                                                            <td> {{ ($billPaymentInfo && $billPaymentInfo->getBillInfo->dos) ? date('m/d/Y', strtotime($billPaymentInfo->getBillInfo->dos)) : ''}} </td>
                                                                                            <td>{{($paymentInfo->procedure_charge ) ? $paymentInfo->procedure_charge : '' }}</td>
                                                                                            <td>{{($paymentInfo->expected_fee_amt ) ? $paymentInfo->expected_fee_amt : '' }}</td>
                                                                                            <td>{{($paymentInfo->procedure_payment_total ) ? $paymentInfo->procedure_payment_total : '' }}</td>
                                                                                            <td>{{($paymentInfo->expected_fee_percent ) ? $paymentInfo->expected_fee_percent : '' }}</td> 
                                                                                            <td>
                                                                                            {{($paymentInfo->procedure_payment_total ) ? $paymentInfo->procedure_payment_total : '' }}
                                                                                            </td>
                                                                                            <td> 
                                                                                                <a href="{{ url('/edit/multiple/bill/payment/post',$paymentInfo->id) }}"><i class="icon-pencil  showPointer btn btn-outline-success"></i></a>
                                                                                                <a href="javascript:void(0)" onClick="deletePaymenySumisionPost({{$paymentInfo->id}}, {{$billPaymentInfo->id}})"><i class="icon-trash  showPointer btn btn-outline-success"></i></a>
                                                                                            </td>
                                                                                        </tr>
                                                                                        @endforeach
                                                                                    @endIf
                                                                                    </tbody>
                                                                                    <tfoot>
                                                                                        <tr>
                                                                                            <td>Total</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td>&nbsp;</td>
                                                                                            <td class="showTal">{{$paymentTotal}}</td>
                                                                                        </tr>
                                                                                        @if($paymentTotal != $billPaymentInfo->payment_amount)
                                                                                            <tr>
                                                                                                <td colspan="7">&nbsp;</td> 
                                                                                                <td><span class="help-block form-error">Does not equal payment amount</span></td>
                                                                                                <td>&nbsp;</td>
                                                                                        </tr>
                                                                                        @endIf
                                                                                    </tfoot>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                           </div>
                                                        </div> 
                                                        <div class="row">
                                                           <div class="form-group col-md-2">
                                                                <label for="">&nbsp;</label>
                                                                <input type="file" name="myFile" id="myFile" class="form-control">
                                                                @if($errors->has('myFile'))
                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                        <strong class="invalid-feedback" >{{ $errors->first('myFile') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            @if ($billPaymentInfo && $billPaymentInfo->getBillInfo &&  $billPaymentInfo->getBillInfo->getBillDocForPayment && $billPaymentInfo->getBillInfo->getBillDocForPayment->injury_document)
                                                            <div class="form-group col-md-4">
                                                                <a href="{{ asset('/injury_document/'.$billPaymentInfo->getBillInfo->getBillDocForPayment->injury_document) }}" target="_blank">
                                                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                           <div class="col-6">
                                                                <button  type="submit" class="btn btn-primary ladda-button"><span class="ladda-label">Post</span></button>
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
    checkBillTotalAmt(); 
     $('#bill_dos_id').datepicker({
        dateFormat: 'mm/dd/yy', 
        changeMonth: true,
        changeYear: true,
    });  
}); 
function checkBillTotalAmt(){
    let sumCPDAmt = 0; let billTotalAmt = {{ ($billPaymentInfo->payment_amount) ? $billPaymentInfo->payment_amount : 0 }};
    $('tfoot tr').each(function () { 
        $(this).find('.showTal').each(function () {
            var pcTotalAmt = $(this).text();
            if (!isNaN(pcTotalAmt) && pcTotalAmt.length !== 0) {
                sumCPDAmt += parseFloat(pcTotalAmt);
            }
        });
    });
    console.log('#billTotalAmt#', billTotalAmt);
    console.log('#sumCPDAmt#', sumCPDAmt);
    if(billTotalAmt > 0 && billTotalAmt != sumCPDAmt){ 
        $("#bill_payment_amount_id").css("border", "1px solid rgb(185, 74, 72)");
    }
}
function deletePaymenySumisionPost(id, paymentId) { 
    swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger",
            popup: 'swal-wide',
        }
    }).then((result) => { // Use .then() to handle the user's response
        if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
            let _url     = `/delete/multiple/bill/payment/post/${id}/${paymentId}`;
            $.ajax({
                url: _url,
                type: 'GET',
                data: {
                    _token: token
                },
                success: function(response) { 
                    location.reload();
                },
                error: function(response) {
                    swal.fire(response.responseJSON.message, '', 'error');
                }
            });
        }
    });
}
</script>
