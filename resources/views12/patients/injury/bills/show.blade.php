@extends('layouts.home-app')
@section('content')
<style>

.sowAccordianSelect {
    padding-left: 10px;
    padding-top: 10px;
    background: #b6efe7;
    color: #2A3F54;
}
.sowAccordianSelectBorder {
    border: 1px solid #2A3F54;
}
.setMinheight {
    min-height:250px !important;
}


</style>

    <div class="row">
        <div class="col-xl-12 col-lg-12 bg-white">
    <div class="row">
            <div class="col-9 col-9 mt-0 mb-0 row-background2">
                 <!-- START: Breadcrumbs-->
 <div class="row mt-0">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-1 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto margin05">
                   <h2><i class="fa-solid fa-rectangle-list"></i> Bill List</h2>
                </div>
                <div align="right" class="w-sm-100 ">
                    <ol class="list-inline breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="list-inline-item">
                            <a class="btn btn-primary" href="{{url('/injury/view')}}/{{$injuryId}}"> Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
                
                <div class="card myh">
                    <div class="card-body2">
                        <div class="row">
                             <div class="col-12  col-md-12 mt-1">
                                  <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                      <a class="nav-item nav-link active" id="nav-task-tab" data-toggle="tab" href="#nav-task" role="tab" aria-controls="nav-task" aria-selected="true"><i class="fa-solid fa-list-check"></i> Bills</a>
                                      <a class="nav-item nav-link" id="nav-stats-tab" data-toggle="tab" href="#nav-stats" role="tab" aria-controls="nav-stats" aria-selected="false"><i class="fa-solid fa-timeline"></i> Procedure Codes</a>
                                    </div>
                                  </nav>
                                  <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active p-1" id="nav-task" role="tabpanel" aria-labelledby="nav-task-tab">
                                        <div class="table-responsive">
                                            <table id="billInfo" class="table layout-secondary dataTable table-striped table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Bill ID</th>
                                                        <th scope="col">DOS</th>
                                                        <th scope="col">Rendering Provider</th>
                                                        <!--<th scope="col">Tot Qty</th>-->
                                                        <th scope="col">Tot Charge</th>
                                                        <th scope="col">Bill Payment Total</th>
                                                        <th scope="col">Balance Due</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Submission Type</th>
                                                        <th scope="col">Task Count</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 @php
                                                    $totCharAmt = 0; $totPaymentAmt = 0; $blcDue = 0;
                                                    @endphp
                                                    @if(count($injuryBill))
                                                    @foreach ($injuryBill as $bill)
                                                    @php
                                                    $totCharAmt += $bill->totalCharge;
                                                    $totPaymentAmt += $bill->totalCharge;
                                                    @endphp
                                                        <tr>
                                                            <td><a href="{{url('/view/patient/injury/bill/info')}}/{{$bill->id}}">{{'Bill00'.$bill->id}}</a></td>
                                                            <td>{{date('m-d-Y',strtotime($bill->dos))}}</td>
                                                            <td>  
                                                            {{ ($bill->getRenderinProvider && $bill->getRenderinProvider->referring_provider_first_name) ? $bill->getRenderinProvider->referring_provider_first_name : ''}} 
                                                            {{($bill->getRenderinProvider && $bill->getRenderinProvider->referring_provider_last_name) ? $bill->getRenderinProvider->referring_provider_last_name : '' }}
                                                            </td>
                                                            <!--<td></td>-->
                                                            <td>{{$bill->totalCharge}}</td>
                                                            <td>{{$bill->totalCharge}}</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>0</td>
                                                        </tr>
                                                    @endforeach
                                                    @else
                                                    <tr><td colspan="10">No Records Found.</td></tr>
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td scope="row"><b>Bill Totals</b></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>{{$totCharAmt}}</td>
                                                        <td>{{$totPaymentAmt}}</td>
                                                        <td>{{$blcDue}}</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade p-1" id="nav-stats" role="tabpanel" aria-labelledby="nav-stats-tab" style="background:#fff; margin:0 0px">
                                        <div class="table-responsive">
                                            <table id="procedureCode" class="table layout-secondary dataTable table-striped table-bordered">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Bill ID</th>
                                                    <th scope="col">Procedure Code</th>
                                                    <th scope="col">Units</th>
                                                    <th scope="col">DOS</th>
                                                    <th scope="col">Rendering Provider</th>
                                                    <th scope="col">Charge</th>
                                                    <th scope="col">Payment Total</th>
                                                    <th scope="col">Balance Due</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($billServices))
                                                     @php $totCharAmt = 0; $totPaymentAmt = 0; $blcDue = 0; @endphp
                                                    @foreach ($billServices as $bill)
                                                    @php
                                                    $totCharAmt += $bill->master_unit_amount;
                                                    $totPaymentAmt += $bill->total_bill_amount;
                                                    @endphp
                                                        <tr>
                                                            <td><a href="{{url('/view/patient/injury/bill/info')}}/{{$bill->billId}}">{{$bill->billNumber}}</a></td>
                                                            <td>{{$bill->bill_procedure_code}}</td>
                                                            <td>{{$bill->bill_units}}</td>
                                                            <td>{{$bill->dos}}</td>
                                                            <td>{{$bill->renderinProvider}}</td>
                                                            <td>{{$bill->master_unit_amount}}</td>
                                                            <td>{{$bill->total_bill_amount}}</td>
                                                            <td>0</td>
                                                        </tr>
                                                    @endforeach
                                                    @else
                                                    <tr><td colspan="10">No Records Found.</td></tr>
                                                    @endif
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
            <div class="col-3 mt-0 rightside sticky">
                <div class="card">
                @include('patients.show-patient-info')
                </div>
            </div>
            
        </div>
      </div>
      </div>
@endsection
