@extends('layouts.home-new-app')
@section('content')
    <style>
        .dataTables_length {
            padding-top: 2%;
        }
.mt-1, .my-1{
    margin-top:0.5rem!important;
}
</style>
 
    <div class="row mt-1">
        <div class="col-md-12 mt-0">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div class="w-sm-100 mr-auto margin05">
                                <h2 class="heading">{{str_replace('_', ' ', $billName)}} LIST</h2>
                            </div> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
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
                                            @if (count($injuryBills) > 0)
                                                <tbody>
                                                    @php
                                                        $totCharAmt = 0;
                                                        $totPaymentAmt = 0;
                                                        $blcDue = 0;
                                                    @endphp
                                                    @foreach ($injuryBills as $bill)
                                                        @php
                                                            $totCharAmt += $bill->totalCharge;
                                                            $totPaymentAmt += $bill->totalCharge;
                                                        @endphp
                                                        <tr>
                                                            <td><a
                                                                    href="{{ url('/view/patient/injury/bill/info') }}/{{ $bill->id }}">{{ 'Bill00' . $bill->id }}</a>
                                                            </td>
                                                            <td>{{ ($bill->dos) ? date('m-d-Y', strtotime($bill->dos)) : '-' }}</td>
                                                            <td>{{ $bill->getRenderinProvider ? $bill->getRenderinProvider->name : '-' }}
                                                            </td>
                                                            <!--<td></td>-->
                                                            <td>{{ $bill->totalCharge }}</td>
                                                            <td>{{ $bill->totalCharge }}</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>0</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                @if($totCharAmt > 0 && $totPaymentAmt > 0 && $blcDue > 0)
                                                <tfoot>
                                                    <tr>
                                                        <td scope="row"><b>Bill Totals</b></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>{{ $totCharAmt }}</td>
                                                        <td>{{ $totPaymentAmt }}</td>
                                                        <td>{{ $blcDue }}</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    </tr>
                                                </tfoot>
                                                @endif
                                            @else
                                                <tbody>
                                                    <tr>
                                                        <td colspan="10">No Records Found.</td>
                                                    </tr>
                                                </tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
@endsection
