 @extends('layouts.home-app-form')
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css" media = "all">
body{
    height: 100%;
    width: 100% !important;
    background-color: #fff;
    direction: ltr;
    margin:0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.45;
}
.row {
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin:1.25rem auto;
    justify-content: center;
    align-items: center;
}
.row-background {
    border: 1px solid rgba(33,40,50,.125)!important;
    background-color: #fff;
    height:calc(100vh - 20px);
}
.card {
    margin-bottom: 1.875rem;
    border: none;
    -webkit-box-shadow: 0 2px 1px rgba(0,0,0,.05);
    box-shadow: 0 2px 1px rgba(0,0,0,.05);
}
.full-view {
    width:100%;
}
 .label, label{
    font-weight:400!important;
    font-family: Arial, Helvetica, sans-serif!important;
 } 
 table {
    border-collapse: collapse;
    font-family: Arial, Helvetica, sans-serif!important;
}
.Letter table tr td {
    padding: 0.5em;
} 
.p-2{
    padding: 1.25rem;
}
.table-borderless{
    width:100%;
}
</style>
</head>

<body id="content">
@php  $injuryBillInfo = $isExistBill; @endphp
@if ($injuryBillInfo)
@inject('pdfClass', 'App\Http\Controllers\PdfMergerController')

    <div class="row" >
        <div class="full-view">
            <div class="card row-background">
                <div class="demand Letter p-2" align="center">
                    <div align="center" width="100%">
                        <img src="https://www.pretentious.me/public/new_assets/app-assets/images/logo.png" width="250px" alt="logo">
                    </div>
                            <table class="table-borderless" style="font-family: Arial, Helvetica, sans-serif;">
                                <tr>
                                    <td>
                                        <table  class="table-borderless" >
                                            <tr>
                                                <td><label class="label">From</label>
                                            </td>
                                                <td>{{ ucwords(Auth::user()['name']) }}</td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Telephone</label>
                                            </td>
                                                <td>{{ ucwords(Auth::user()['phone_no']) }}</td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Fax</label>
                                            </td>
                                                <td>----------</td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Email</label>
                                            </td>
                                                <td>{{ ucwords(Auth::user()['email']) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table  class="table-borderless" style="font-family: Arial, Helvetica, sans-serif;">
                                            <tr>
                                                <td><label class="label">To</label>
                                            </td>
                                                <td>{{ ($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : 'Zurich Insurance North America'}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Clearinghouse</label>
                                            </td>
                                                <td>Jopari</td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Payer ID</label>
                                            </td>
                                                <td>16535</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            
                            
                                <tr style="border-bottom: 2px solid #000;">
                                <td style=" padding-left:5px; font-size:24px; font-weight:400; text-align: left; font-family: Arial, Helvetica, sans-serif">Original Bill</td>
                                <td style=" padding-right:5px; font-size:24px; font-weight:400; text-align: right; font-family: Arial, Helvetica, sans-serif">Medical Treatment</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table  width="70%"  class="table-borderless">
                                            <tr>
                                                <td><label class="label">Patient Name </label>
                                            </td>
                                                <td>{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : '' }}
                                                    {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Claim Number</label>
                                            </td>
                                                <td>{{$injuryBillInfo->getInjury->getInjuryClaim->claim_no }}</td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Patient Control No</label>
                                            </td>
                                                <td>{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->contact_no)  ? $injuryBillInfo->getInjury->patient->contact_no : '' }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                           
                                            
                                        </table>
                                    </td>
                                    <td>
                                        <table  width="70%"  class="table-borderless">
                                            <tr>
                                                <td><label class="label">Billing Provider</label>
                                            </td>
                                                <td>{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">DOS </label>
                                            </td>
                                                <td>{{($injuryBillInfo && $injuryBillInfo->dos) ? date('m-d-Y', strtotime($injuryBillInfo->dos)) : ''}}</td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Charge Amount </label>
                                            </td>
                                                <td>
                                                @php   $totalCharge = 0;   @endphp
                                                @if(count($injuryBillInfo->getBillServices) > 0)
                                                 @foreach($injuryBillInfo->getBillServices as $service)
                                                    @php $totalCharge += $service->total_bill_amount;  @endphp
                                                 @endforeach
                                                 @endif
                                                 {{ (is_float($totalCharge)) ? $totalCharge : $totalCharge.".00" }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><label class="label">Rendering Provider </label>
                                            </td>
                                                <td>{{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_first_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_first_name : '' }}
                                                                    {{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_last_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_last_name : '' }}
                                                                    {{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_middle_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_middle_name : '' }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>  
                              <tr style="border-bottom: 2px solid #000;">
                                <td style=" padding-left:5px; font-size:20px; font-weight:400; text-align: left; font-family: Arial, Helvetica, sans-serif">Payment Compliance Dates</td>
                                <td style=" padding-right:5px; font-size:20px; font-weight:400; text-align: right; font-family: Arial, Helvetica, sans-serif">e-Bill Transmission </td>
                             </tr>
                             @if($injuryBillInfo->getSendBillDate && $injuryBillInfo->getSendBillDate->sent_date)
                             <tr style="border-bottom: 2px solid #000;">
                                <td style="padding-top:25px;">
                                   <table  width="90%"  class="table-borderless" style="border-radius:15px; background-color: #F7F7F9; padding-top: 20px; padding-bottom: 20px;">
                                    <tr>
                                        <td> &nbsp;</td>
                                        <td><small>
                                        @php $numberOfDay = $pdfClass->getDayAndDate(date('Y-m-d', strtotime($injuryBillInfo->created_at)), 15); @endphp

                                        {{ ($numberOfDay) ? $numberOfDay['days'] : '' }}  WORKING DAYS</small></td>
                                    </tr>
                                    <tr>
                                        <td>{{ ($injuryBillInfo->getSendBillDate && $injuryBillInfo->getSendBillDate->sent_date) ? date('m/d/Y', strtotime($injuryBillInfo->getSendBillDate->sent_date)) : '' }}</td>
                                        <td>{{ ($numberOfDay) ? $numberOfDay['bDate'] : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><small>Original Bill 837 (e-Bill) Sent</small></td>
                                        <td><small>EOR and Payment</small></td>
                                    </tr>
                                </table>
                                </td>
                                
                                <td style="padding-top:25px;">
                                    <table  width="90%"  class="table-borderless">
                                            <tr>
                                                <td style="border-right:1px dashed #333">
                                                    <table  width="100%"  class="table-borderless">
                                                        <tr>
                                                            <td>
                                                            @php $numberOfDay = $pdfClass->getDayAndDate(date('Y-m-d', strtotime($injuryBillInfo->created_at)), 45); @endphp
                                                            {{ ($numberOfDay) ? $numberOfDay['days'] : '' }}  CALENDAR DAYS</td>
                                                        </tr>
                                                        <tr>
                                                            <td>{{ ($numberOfDay) ? $numberOfDay['bDate'] : '' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><small> Private Entity Employer<br>
                                                                Penalty and interest due for<br>
                                                                unpaid portion of bill</small></td>
                                                        </tr>
                                                    </table>   
                                                </td>
                                                <td>
                                                        <table  width="100%"  class="table-borderless">
                                                            <tr>
                                                                <td>
                                                                @php $numberOfDay = $pdfClass->getDayAndDate(date('Y-m-d', strtotime($injuryBillInfo->created_at)), 60); @endphp
                                                                {{ ($numberOfDay) ? $numberOfDay['days'] : '' }}
                                                                CALENDAR DAYS</td>
                                                            </tr>
                                                            <tr>
                                                                <td>{{ ($numberOfDay) ? $numberOfDay['bDate'] : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><small>Government Entity Employer<br>
                                                                    Penalty and interest due for<br>
                                                                    unpaid portion of bill</small></td>
                                                            </tr>
                                                        </table>  
                                                    </td>
                                            </tr> 
                                    </table>
                                </td> 
                            </tr> 
                            @endif
                    </table>
                    </div>   
                </div> 
            </div>
        </div> 
 @endif
 </body>
</html>
