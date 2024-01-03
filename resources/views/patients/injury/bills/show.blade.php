@extends('layouts.home-app')
@section('content')
<style>
    
nav > .nav.nav-tabs{

  border: none;
    color:#fff;
    background:#ccc;
    border-radius:0;
    width: 30%; font-size:14px;

}
nav > div a.nav-item.nav-link
{
  border: none;
    padding: 18px 25px;
    color:#fff;
    background:#ccc;
    border-radius:0;
    border-right: 1px solid #fff;
    font-size: 14px;
}
nav > div a.nav-item.nav-link.active
{
  border: none;
    padding: 18px 25px;
    color:#fff;
    background:#2A3F54;
    border-radius:0;
    border-right: 1px solid #ccc;
    font-size: 14px;
    font-weight: 800;
}

nav > div a.nav-item.nav-link.active:after
 {
  content: "";
  position: relative;
  bottom: -47px;
  left: -16%;
  border: 15px solid transparent;
  border-top-color: #2A3F54 ;
  
}
.tab-content{
  background: #fdfdfd;
    line-height: 25px;
    border: 1px solid #2A3F54;
    border-top:1 solid #b6efe7;
    /*border-bottom:3px solid #fff;*/
    padding:11px 0px;
    min-height:350px;
}

nav > div a.nav-item.nav-link:hover,
nav > div a.nav-item.nav-link:focus
{
  border: none;
    background: #2A3F54;
    color:#fff !important;
    border-radius:0;
    transition:background 0.20s linear;
}
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

.card {
    margin-bottom: 0.5rem;
    border: none;
    -webkit-box-shadow: 0 2px 1px rgb(0 0 0 / 5%);
    box-shadow: 0 2px 1pxrgba(0,0,0,.05);
}
.tabContentDiv{

}


</style>
 <!-- START: Breadcrumbs-->
 <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto col-10">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">
                        <h2><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 34 34" class="left"><title>icon_patient</title><path d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z" fill="#3A3A3A" fill-rule="evenodd"></path></svg>
                        Bill List</h2>
                        </li>
                    </ol>

                    <div class="box_title">

                    </div>
                </div>
                <div class="w-sm-100 mr-auto col-2">
                    <ul class="list-inline">
                        <!-- <li class="list-inline-item">
                            <i class=""></i>
                            <a class="link-primary" href="{{url('/add/injury/bill')}}/{{$injuryId}}/{{$patientId}}">
                            <i class="fas fa-edit"></i> Edit</a>
                        </li> -->
                        <li class="list-inline-item">
                            <a class="btn btn-primary" href="{{url('/injury/view')}}/{{$injuryId}}"> Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    <div class="row">
            <div class="col-9 mt-4" style="padding-right:0px; important">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                             <div class="col-12  col-md-12 mt-3">
                                  <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                      <a class="nav-item nav-link active" id="nav-task-tab" data-toggle="tab" href="#nav-task" role="tab" aria-controls="nav-task" aria-selected="true">Bills</a>
                                      <a class="nav-item nav-link" id="nav-stats-tab" data-toggle="tab" href="#nav-stats" role="tab" aria-controls="nav-stats" aria-selected="false">Procedure Codes</a>
                                    </div>
                                  </nav>
                                  <div class="tab-content  " id="nav-tabContent">
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
                                                            <td>{{($bill->getRenderinProvider) ? $bill->getRenderinProvider->name : 'NA' }}</td>
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
                                    <div class="tab-pane fade p-1" id="nav-stats" role="tabpanel" aria-labelledby="nav-stats-tab">
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
            <div class="col-3 mt-4" style="padding-right:0px; important">
                <div class="card">
                @include('patients.show-patient-info')
                </div>
            </div>
        </div>

@endsection
