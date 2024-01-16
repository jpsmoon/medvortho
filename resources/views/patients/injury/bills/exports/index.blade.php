 @extends('layouts.home-app-form')
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css" media="all">
@import url('https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;600;700&display=swap');
*,
    *:before,
    *:after {
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
body{
    height: 100%;
    width: 100%;
    background-color: #fff;
    direction: ltr;
    margin:0;
    padding: 0;
    font-family: 'Figtree', sans-serif !important;
    font-size:16px;
    font-weight: 400;
    line-height:0.75rem;
}
h1{
    font-size:1.50rem;
    line-height:1.0rem;
}
h2{
    font-size:1.45rem;
    line-height:1.0rem;
}
.row {
    display: flex;
    -webkit-flex-wrap: wrap;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin:0rem auto;
    justify-content: center;
    align-items: center;
}
.row-background {
    border: 0px solid rgba(33,40,50,1)!important;
    background-color: #fff;
}
.full-view {
    width:100%;
    max-width:1200px;
}
 .label, label{
    font-weight:600!important;
     font-family: 'Figtree', sans-serif !important;
 } 
 table {
     border-collapse: collapse;
     font-family: 'Figtree', sans-serif !important;
     font-size:0.75rem;
}
table p{
    font-family: 'Figtree', sans-serif !important;
     font-size:0.7rem;
     line-height:0.55rem;
}
.table-border tr td {
   padding: 0.3rem;
    border:1px solid #000;
} 

.table-borderless{
    width:100%;
    border:0px solid #000;
}
.table-borderless tr td{
    padding-top:0.2rem;
    padding-bottom:0.2rem;
}
 .black_Check {
      position: relative;
      padding: 0rem;
      top:0px;
      border: 1px solid #000;
      width:8px;
      height:8px;
      color: #000;
      font-weight: 500;
      display: inline-block;
      font-size:9px;
      line-height:18px;
      text-align: center;
      margin-left: 3px;
      margin-right: 3px;
      margin-bottom:0px;
    }
</style>
</head>
@php  $injuryBillInfo = $isExistBill; @endphp
@if ($injuryBillInfo)
@inject('pdfClass', 'App\Http\Controllers\PdfMergerController')
@php 
    $totalCharge = 0;
   if($injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0){
       foreach($injuryBillInfo->getBillServices as $cnt){
            $totalCharge += $cnt['total_bill_amount'];
       }
    }
   @endphp

<body id="content">
    <div class="row" >
        <div class="full-view">
            <div class="row-background">
                <div class="demand Letter p-0" align="center">
                    <div align="center" width="100%">
                        <img src="https://www.pretentious.me/public/new_assets/app-assets/images/logo.png" width="150px" alt="logo" >
                        <h1>Bill Submission </h1>
                        <h2>Proof of Service</h2>
                      </div>
                            <table class="table-borderless" >
                                <tr>
                                    <td>
                                        <table width="100%" class="table-border">
                                            <tr>
                                             <td><strong>Injured Worker</strong></td>
                                             <td width=30%""> 
                                             {{ ($injuryBillInfo->getInjury->financial_class && $injuryBillInfo->getInjury->financial_class == 1) ? 'Worker Comp' : (($injuryBillInfo->getInjury->financial_class && $injuryBillInfo->getInjury->financial_class == 2) ? "Private / Government" : 'Personal Injury') }}
                                             </td>
                                             <td><strong>Patient Control No.</strong></td>
                                             <td width=30%"">&nbsp;</td>
                                            </tr>
                                            <tr>
                                             <td><strong>Claims Administrator</strong></td>
                                             <td width=30%"">{{ ($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : ''}}</td>
                                             <td><strong>Date of Service</strong></td>
                                             <td width=30%"">{{ ($injuryBillInfo->dos && $injuryBillInfo->dos != '' && $injuryBillInfo->dos != '1970-01-01' ) ? date('m/d/Y', strtotime($injuryBillInfo->dos)) : '' }}</td>
                                            </tr>
                                            <tr>
                                             <td><strong>Claim Number</strong></td>
                                             <td width=30%"">{{$injuryBillInfo->getInjury->getInjuryClaim->claim_no }}</td>
                                             <td><strong>Charge Amount</strong></td>
                                             <td width=30%"">{{$totalCharge}}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>  
                                <tr>
                                    <td>
                                       <span><input {{ ($sendingType == 1) ? 'checked' : '' }}  type="radio" name="sendtingType" id="sendtingType1" class="black_Check"></span> <strong>E-BILL:</strong> In this action I have submitted the enclosed along with the listed records Electronically sent via Data Dimensions Payer ID WF091
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       <span><input {{ ($sendingType == 2) ? 'checked' : '' }}  type="radio" name="sendtingType" id="sendtingType2" class="black_Check"></span> <strong>BY FACSIMILE TRANSMISSION:</strong> From Fax (877) 318-9686 to the fax number (859)-264 4063 Claims the facsimile machine I used complied with Rule 2003 (3) and no error was reported by the machine. I caused the machine to print a record of the transaction.
                                    </td>
                                </tr>
                                 <tr>
                                    <td>
                                       <span><input {{ ($sendingType == 3) ? 'checked' : '' }} type="radio" name="sendtingType" id="sendtingType3" class="black_Check"></span> <strong>BY MAIL:</strong> In this action I have placed a true copy enclosed in an envelope with postage thereon fully prepaid in the United States and mailed to Addressed: Amtrust North America at P.O. Box 269120, Sacramento, CA 95826.
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       I am readily familiar with the practice of collection and processing correspondence for mailing. Under that practice, it would be deposited with the United States Postal Service on the same day with postage thereon fully prepaid at 01 September 2015 in the ordinary course of business. I am aware that on motion of the party served, service is presumed invalid if postage cancellation date or postage meter date on the envelope is more than one day after the date for mailing contained in this affidavit.
                                    </td>
                                </tr>
                                @php $numberOfDay15 = $pdfClass->getDayAndDate(date('Y-m-d', strtotime($todayDate)), 15); @endphp
                                @php $numberOfDay45 = $pdfClass->getDayAndDate(date('Y-m-d', strtotime($todayDate)), 45); @endphp
                                @php $numberOfDay60 = $pdfClass->getDayAndDate(date('Y-m-d', strtotime($todayDate)), 60); @endphp
                                <tr>
                                    <td>
                                        <h4 class="text-left" style="line-height:0.5rem">Timeline:</h4>
                                      <table width="100%" class="table-border">
                                            <tr>
                                             <td width="20%">&nbsp;</td>
                                             <td>Original Bill {{ ($sendingType == 3) ? 'MAIL'  : ( ($sendingType == 2) ? 'FACSIMILE TRANSMISSION'  : 'E-BILL')}}</td>
                                            </tr>
                                            <tr>
                                             <td width="20%">{{ ($numberOfDay15) ? $numberOfDay15['bDate'] : '' }}</td>
                                             <td>Electronic EOR and payment due (15 working days)</td>
                                            </tr>
                                            <tr>
                                             <td width="20%">{{ ($numberOfDay45) ? $numberOfDay45['bDate'] : '' }}</td>
                                             <td>Private entity employer: penalty and interest due for unpaid portion of bill (45 calendar days)</td>
                                            </tr>
                                            <tr>
                                             <td width="20%">{{ ($numberOfDay60) ? $numberOfDay60['bDate'] : '' }}</td>
                                             <td>Government entity employer: penalty and interest due for unpaid portion of bill (60 calendar days)</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="text-left" style="line-height:0.5rem">Documents submitted along with this Bill:</h4>
                                        <table width="100%" class="table-border">
                                            <tr>
                                             <td width="20%"><strong>S. No.</strong></td>
                                             <td width="20%"><strong>Doc. Type</strong></td>
                                             <td><strong>File Name</strong></td>
                                            </tr>
                                            <tr>
                                             <td width="20%">1.</td>
                                             <td width="20%">OZ</td>
                                             <td>Submission Cover Sheet</td>
                                            </tr>
                                            <tr>
                                             <td width="20%">2.</td>
                                             <td width="20%">837 (E-bill)</td>
                                             <td>CMS-1500</td>
                                            </tr>
                                            @php $i = 3; @endphp
                                            @if($injuryBillInfo->getBillDocuments && count($injuryBillInfo->getBillDocuments) > 0) 
                                                @foreach ($injuryBillInfo->getBillDocuments as $document)
                                                @php 
                                                $reportingTypeName = '-';
                                                if($document->reporting_type != null){
                                                    $reportingTypeName =  ($document->reporting_type && $document->getReportType && $document->getReportType->report_name) ? $document->getReportType->report_code : '-';
                                                }
                                                @endphp
                                                    <tr>
                                                        <td width="20%">{{$i++}}.</td>
                                                        <td width="20%">{{$reportingTypeName}}</td>
                                                        <td>{{$document->description) ? $document->description : ''}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                             
                                            
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Biller/User name: {{ ($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : ''}}</p>
                                         <p>Billing Provider Name: {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name : '' }}</p>
                                         <p>User Contact Email:{{ ($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->email : ''}}</p>
                                         <p>Practice Phone:</p>
                                         <p>Practice Fax:</p>
                                    </td>
                                </tr>
                                
                                
                              
                          
                    </table>
                    </div>   
                </div> 
            </div>
        </div> 
 </body>
 @endif
</html>
