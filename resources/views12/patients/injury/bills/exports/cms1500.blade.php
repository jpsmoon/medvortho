<style type="text/css" media="all">
    body {
        font-family: 'Figtree', sans-serif !important;
        font-size: 0.75rem !important;
        font-weight: 600;
        margin: 0 auto;
        padding: 0;
        width: 100%;
        height: 100%;
        background-color: #484C4E;
        position: relative;
    }

    .content-body {
        width: 1275px;
        max-height: 1650px;
        margin: 0 auto;
    }

    .buton-part {
        background-color: #484C4E;
        position: absolute;
        left: 10px;
        top: 10px;
    }

    .buton-part button {
        cursor: pointer;
    }

    #tdcontent {
        border: 3px solid #484C4E00;
    }

    .provider_heading_type {
        color: #858585;
        font-size: 14px;
        font-weight: 300;
        margin: -9px 0 10px;
    }

    .provider_heading {
        align-items: center;
        color: #3a3a3a;
        display: flex;
        font-size: 16px;
        font-weight: 600;
        line-height: normal;
        margin: 0;
        padding: 11px 0 9px;
    }

    .showImgaeInBack {
        background-image: url('https://www.pretentious.me/public/new_assets/app-assets/images/cms-form.jpg');
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: center center;
    }

    #loadingForm {
        width: 1275px;
        height: 1650px;
        position: relative;
        margin: 0 auto;
    }

    ul#menu li {
        display: inline;
    }

    .column {
        flex: 45%;
    }

    .column {
        float: left;
        width: 45%;
        font-weight: 600;
    }

    .cpt-value {
        width: 31% !important;
    }

    .column span {
        width: 50%;
    }

    #loadingForm #tdcontent {
        position: absolute;
        top: 95px;
    }

    #loadingForm #tdcontent td {
        padding: 0px;
        border: 1px solid #484C4E00;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
        }

        .column span {
            width: 50%;
        }

        #con_12 tbody {
            margin: 0 !important;
            padding: 0 !important;
        }
    }

    .pdfContentDiv {
        text-transform: uppercase !important;
    }

    @media print {
        body {
            page-break-before: avoid;
        }

        @page {
            margin: 1.5cm 1cm;
            size: A4 landscape;
        }
    }
</style>
@php
$mm = null;
    $dd = null;
    $yy = null;
    $stateCode = null;
    $inj_mm = null;
    $inj_dd = null;
    $inj_yy = null;
    $injuryBillInfo = $isExistBill;
@endphp
@extends('layouts.home-app-form')
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type = "text/css" media = "all">
body{
    font-family: 'Figtree', sans-serif!important;
    font-size: 0.75rem!important;
    font-weight: 600;
    margin: 0 auto;
    padding:0;
    width:100%;
    height:100%;
    background-color:#484C4E;
    position:relative;
}
.content-body{
     width:1275px;
     max-height:1650px;
     margin: 0 auto;

     
}
.buton-part{
    background-color:#484C4E;
    position:absolute;
    left:10px;
    top:10px;
   
}
.buton-part button{
    cursor:pointer; 
}
#tdcontent{
    border:3px solid #484C4E00;
}
 .provider_heading_type {
        color: #858585;
        font-size: 14px;
        font-weight: 300;
        margin: -9px 0 10px;
 }
 .provider_heading {
        align-items: center;
        color: #3a3a3a;
        display: flex;
        font-size: 16px;
        font-weight: 600;
        line-height: normal;
        margin: 0;
        padding: 11px 0 9px;
    }

    .showImgaeInBack {
        background-image: url('https://www.pretentious.me/public/new_assets/app-assets/images/cms-form.jpg');
        background-size:100% 100%;
        background-repeat: no-repeat;
        background-position:center center;
    }

    #loadingForm {
         width: 1275px;
        height:1650px;
        position: relative;
        margin:0 auto;
    }
    
    ul#menu li {
    display:inline;
    }


    .column {
      flex:45%;
    }
    .column {
       float: left;
      width: 45%;
      font-weight:600;
    }
    .cpt-value{
        width:31%!important;
    }
    .column span {
    width: 50%; 
    }
     #loadingForm #tdcontent{
         position:absolute;
         top:95px;
     }
   #loadingForm #tdcontent td{
       padding:0px;
       border:1px solid #484C4E00;
   }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
    @media screen and (max-width: 600px) {
      .column {
        width: 100%;
      }
      .column span {
        width: 50%;
    }
    
  #con_12 tbody {
  margin: 0 !important;
  padding: 0!important;
  }

}
.pdfContentDiv{text-transform: uppercase!important;}

.pt-5{
    padding-top:5px!important;
}
.pt-10{
    padding-top:10px!important;
}
.pt-15{
    padding-top:15px!important;
}
.pt-20{
    padding-top:20px!important;
}
.pt-25{
    padding-top:25px!important;
}
.pt-30{
    padding-top:30px!important;
}
.pt-35{
    padding-top:35px!important;
}
.pt-50{
    padding-top:50px!important;
}
.pt-60{
    padding-top:60px!important;
}
.pt-70{
    padding-top:70px!important;
}


@media print {
   body {
        page-break-before: avoid;
        page-break-after: avoid;
         zoom:0.65;
         background:#fff;
      }

      @page {
        margin:1cm 1cm;
        size:A4 portrait;
        page-break-inside :auto;
      }
      
      .content-body{
          padding-top:1.5cm;
      }
      
      #cmdPdfBtn{
          display:none;
      }
}
body {
        page-break-before: avoid;
        page-break-after: avoid;
         zoom:0.65 !important;
         background:#fff;
      }
</style>
</head>
<body id="content" >
<div class="content-body" >
    <div class="row">
        <div class="col-md-12" id="pageContent">
            <div class="card row-background2">
                @if ($injuryBillInfo)
                    @php 
                    if(count($injuryBillInfo->getBillServices) > 0){
                        $existing_array = [...$injuryBillInfo->getBillServices];
                    }
                    else{
                    $existing_array = [1];
                    }
                     $ff =0; @endphp
                    @for ($ii = 0; $ii < count($existing_array); $ii += 6)
                        @php
                            $totalCharge = 0;
                            $new_array = [];
                            $start = $ii;
                            $end = min($ii + 6, count($existing_array));
                            $slice = array_slice($existing_array, $start, $end - $start);
                            $new_array = (count($injuryBillInfo->getBillServices) > 0) ? array_merge($new_array, $slice) : [];
                            $ff++;
                        @endphp
                        <div class="pdfContentDiv" id="pdfContentDiv_{{$ff}}">
                            <div id="loadingForm" class="showImgaeInBack">
                                <table width="100%" id="tdcontent">
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td width="800px" class="pt-25"></td>
                                                    <td style="font-weight:600">{{ ($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : 'Sedgwick Claims Management Services'}}</td>
                                                </tr>
                                                <tr >
                                                    <td width="800px"></td>
                                                    <td style="font-weight:600">Submitted Electronically via Data Dimensions</td>
                                                </tr>
                                                <tr>
                                                    <td width="800px"></td>
                                                    @if($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->payer_id)
                                                    <td  style="font-weight:600"> 'Payer ID: ( {{  $injuryBillInfo->getInjury->getInjuryClaim->payer_id }} ) </td>
                                                    @else
                                                    <td>&nbsp;</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td width="760px"></td>
                                                    <td class="pt-5" style="padding-left:160px; font-weight:600">CMS1500 Page {{$ff}} of {{count($existing_array)}}</td>
                                                </tr>
                                                <tr>
                                                    <td width="760px"></td>
                                                    <td class="pt-25" style="padding-left:6px; font-weight:600">
                                                        {{ $injuryBillInfo->getInjury->patient->ssn_no }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="485px"><table><tr><td class="pt-20" style=" padding-left:60px; font-weight:600;">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : '' }}
                                                    {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : '' }}
                                                    </td></tr></table></td>
                                                    
                                                    @if ($injuryBillInfo->getInjury->patient->gender == 'Male')
                                                    <td valign="top" width="290px"><table style="font-weight:600"><tr>
                                                        <td class="pt-20" style="padding-left:21px">{{ $mm }}</td> 
                                                        <td class="pt-20" style="padding-left:23px">{{ $dd }}</td>
                                                        <td class="pt-20" style="padding-left:33px">{{ $yy }}</td>
                                                        <td class="pt-20" style="padding-left:30px">X</td>
                                                        </tr>
                                                        </table></td>
                                                    @else
                                                    <td valign="top" width="300px"><table style="font-weight:600"><tr>
                                                        <td class="pt-20" style=" padding-left:21px">{{ $mm }}</td>
                                                        <td class="pt-20" style=" padding-left:23px">{{ $dd }}</td>
                                                        <td class="pt-20" style=" padding-left:33px">{{ $yy }}</td>
                                                        <td class="pt-20" style="padding-left:30px">X</td></tr>
                                                        </table>
                                                        </td>
                                                    @endif
                                                    <td valign="top" width="405px" ><table><tr>
                                                        <td class="pt-20" style="padding-left:10px; font-weight:600; ">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : '' }}
                                                    {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : '' }}</td></tr></table></td>
                                                    
                                                </tr> 
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="485px"><table style="font-weight:600"><tr><td class="pt-25" style="padding-left:60px">{{ $injuryBillInfo->getInjury->patient->address_line1 && $injuryBillInfo->getInjury->patient->address_line2 ? $injuryBillInfo->getInjury->patient->address_line1 . ', ' . $injuryBillInfo->getInjury->patient->address_line2 : $injuryBillInfo->getInjury->patient->address_line1 }}</td></tr></table></td>
                                                    
                                                    
                                                    <td valign="top" width="300px">
                                                        <table style="font-weight:600;">
                                                            <tr>
                                                        <td class="pt-25" style="padding-left:21px"></td> 
                                                        <td class="pt-25" style="padding-left:23px"></td>
                                                        <td class="pt-25" style="padding-left:33px"></td>
                                                        <td class="pt-25" style="padding-left:155px">X</td></tr>
                                                        </table>
                                                        </td>
                                                
                                                    <td valign="top" width="405px" ><table style="font-weight:600;">
                                                        <tr>
                                                            <td valign="top" width="430px">
                                                                <table style="font-weight:600;">
                                                                    <tr>
                                                                     <td class="pt-20">{{ $injuryBillInfo->getInjury->patient->address_line1 && $injuryBillInfo->getInjury->patient->address_line2 ? $injuryBillInfo->getInjury->patient->address_line1 . ', ' . $injuryBillInfo->getInjury->patient->address_line2 : $injuryBillInfo->getInjury->patient->address_line1 }}</td></tr></table></td></tr></table>
                                                            </td>
                                                        </tr> 
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="485px">
                                                        <table style="font-weight:600;">
                                                            <tr>
                                                                <td class="pt-10" style=" padding-left:48px; width: 370px;">{{$injuryBillInfo->getInjury->patient->city_id }}</td>
                                                                <td class="pt-10" style=" padding-left:5px;">{{ $stateCode }} </td>
                                                             </tr>
                                                        </table>
                                                    </td>
                                                    
                                                    
                                                    <td valign="top" width="300px">
                                                        <table style="font-weight:600;">
                                                            <tr>
                                                                <td class="pt-20" style="padding-left:21px"></td> 
                                                                <td class="pt-20" style="padding-left:23px"></td>
                                                                <td class="pt-20" style="padding-left:33px"></td>
                                                                <td class="pt-20" style="padding-left:148px"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                
                                                    <td valign="top" width="405px" ><table style="font-weight:600;">
                                                        <tr>
                                                            <td class="pt-10" style=" font-weight:600; width: 370px;">{{$injuryBillInfo->getInjury->patient->city_id }}</td>
                                                            <td class="pt-10" style=" padding-left:240px; font-weight:600;">{{ $stateCode }} </td>
                                                        </tr>
                                                    </table>
                                                    </td>
                                                    
                                                </tr> 
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="485px">
                                                        <table>
                                                            <tr>
                                                                <td class="pt-25" style="padding-left:48px; width:210px; font-weight:600;">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->zipcode)  ? $injuryBillInfo->getInjury->patient->zipcode : '' }}</td>
                                                                <td  class="pt-25"  style="padding-left:5px; font-weight:600;">
                                                                    {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->contact_no)  ? $injuryBillInfo->getInjury->patient->contact_no : '' }}
                                                                </td>
                                                             </tr>
                                                        </table>
                                                    </td>
                                                    
                                                    
                                                    <td  class="pt-25"  valign="top" width="300px"><table><tr>
                                                    <td  class="pt-25"  style=" padding-left:21px; font-weight:600;"></td>
                                                    <td class="pt-25" style="padding-left:23px"></td><td style="padding-top:19px; padding-left:33px"></td><td style="padding-top:14px; padding-left:148px"></td></tr></table></td>
                                                
                                                    <td valign="top" width="405px" >
                                                        <table>
                                                      <tr>
                                                        <td  class="pt-25"  style="padding-top:12px;  width:205px; font-weight:600;">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->zipcode)  ? $injuryBillInfo->getInjury->patient->zipcode : '' }}</td>
                                                        <td class="pt-25"  valign="top" style="width:200px; padding-left:36px; font-weight:600;">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->contact_no)  ? $injuryBillInfo->getInjury->patient->contact_no : '' }}</td>
                                                        </tr>
                                                        </table>
                                                      </td>
                                                </tr> 
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr >
                                        <td style="height:39px;" valign="top">
                                            <table style="height:39px;">
                                                <tr>
                                                    <td valign="top" width="485px">
                                                        <table>
                                                            <tr>
                                                                <td class="pt-25" style=" padding-left:48px; width:329px; font-weight:600;"></td>
                                                                <td class="pt-25" style=" padding-left:5px; font-weight:600;"></td>
                                                             </tr>
                                                        </table>
                                                    </td>
                                                    
                                                    
                                                    <td valign="top" width="300px"><table><tr>
                                                        <td class="pt-25" style="padding-left:21px; font-weight:600;"></td> <td style="padding-top:19px; padding-left:23px; font-weight:600;"></td><td style="padding-top:19px; padding-left:33px; font-weight:600;"></td><td style="padding-top:14px; padding-left:148px"></td></tr></table></td>
                                                
                                                    <td valign="top" width="405px" ><table><tr><td></td></tr></table></td>
                                                    
                                                </tr> 
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td class="pt-25" width="485px" style="padding-left:41px"></td>
                                                    <td class="pt-25" width="310px" style=" padding-right:150px; text-align:right; font-weight:600;">X</td>
                                                    <td class="pt-25" width="300px"  style="font-weight:600;">
                                                        <span style="width:17px; padding-left:25px">{{ $mm }}</span>
                                                        <span style="width:17px; padding-left:25px">{{ $dd }}</span>
                                                        <span style="width:17px; padding-left:25px">{{ $yy }}</span>
                                                    </td>
                                                     @if ($injuryBillInfo->getInjury->patient->gender == 'Male')
                                                    <td width="270px" class="pt-25" style="padding-left:0px; font-weight:600;"><span>X</span> </td>
                                                     @else
                                                     <td width="270px" class="pt-25" style="padding-left:0px;"><span style="padding-left:140px; font-weight:600;">X</span> </td>
                                                     @endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr >
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td class="pt-25" width="485px"></td>
                                                   <td class="pt-20" width="275px"><span style="padding-left:157px; font-weight:600;">X</span> </td>
                                                    <td class="pt-25" style="padding-top:22px; padding-left:50px; font-weight:600;" for="claim_no">{{$injuryBillInfo->getInjury->getInjuryClaim->claim_no }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td class="pt-20" width="485px"></td>
                                                    <td class="pt-20" width="275px" ><span style="padding-left:157px; font-weight:600;">X</span></td>
                                                    <td class="pt-20" width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr >
                                    <td valign="top">
                                            <table class="pt-70">
                                                <tr>
                                                    <td class="pt-50" width="485px" style="padding-top:46px"> <span style="padding-left:140px; font-weight:600;">SIGNATURE ON FILE </span></td>
                                                    <td class="pt-50" width="275px" style="padding-top:48px"> <span style="padding-left:96px; font-weight:600;">11/11/2022</span></td>
                                                    <td class="pt-50" width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td>
                                            <table>
                                                <tr>
                                                    <td class="pt-25" width="485px" style=" font-weight:600;"><span style="padding-left:63px">{{ $inj_mm }}</span><span style="padding-left:26px">{{ $inj_dd }}</span><span style="padding-left:35px">{{ $inj_yy }}</span></td>
                                                    <td width="300px"></td>
                                                    <td width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top" style="height:40px">
                                            <table style="height:40px">
                                                <tr>
                                                    <td width="485px"></td>
                                                    <td width="300px"></td>
                                                    <td width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pt-15" valign="top" style="height:40px">
                                            <table style="height:40px; font-weight:600;">
                                                <tr>
                                                    <td width="485px">
                                                        <span style="padding-left:65px; font-weight:600;">{{($injuryBillInfo && $injuryBillInfo->bill_additiona_information_box) ?  $injuryBillInfo->bill_additiona_information_box : '' }}</span>
                                                     </td>
                                                    <td width="300px"></td>
                                                    <td width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pt-10" style="font-weight:600;">
                                            <span style="padding-left: 45%;">&nbsp;</span>
                                            <span style="padding-left:85px;">01</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="height:65px">
                                        <table style="width: 857px; font-weight:600;">
                                            <td valign="top">
                                                <table  style="width:700px; ">
                                                     @if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0)
                                                        @foreach ($injuryBillInfo->getBillDiagnosis as $key => $billDiagnos)
                                                         @if ($key % 4 == 0)
                                                        @if ($key != 0)
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                        @endif
                                                            <td style="{{($key ==0) ? 'width:30%; padding-left:10%; font-weight:600;' : 'width:31%; padding-left: 22%; font-weight:600;'}}">{{($billDiagnos && $billDiagnos->getBillDiagnosisName) ? $billDiagnos->getBillDiagnosisName->diagnosis_code : '' }}</td>
                                                        @if (($key+1) % 4 == 0 || $key == 4)
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </td>
                                            <td class="pt-5" style="width: 213px; padding-left:5px;">
                                                <span>{{($injuryBillInfo && $injuryBillInfo->bill_authorization_number) ?  $injuryBillInfo->bill_authorization_number : '' }}</span>
                                            </td>
                                        </table>
                                        </td>
                                    </tr>
                                    @php $maxRow = 6; $leftTd = 0;
                                    @endphp
                                     @if(count($new_array) > 0)
                                        @php  $leftTd = count($new_array) < 6 ? $maxRow - count($new_array) : 0;
                                        
                                     @endphp
                                        @for ($j = 0; $j < count($new_array); $j++)
                                            @php $totalCharge += $new_array[$j]['total_bill_amount']; 
                                            $alphabet = array(); 
                                            $dcodes = "";
                                            $serDCNT= array();
                                            
                                             //$diagnosisCodeNumbers = implode(',',$alphabet);
                                             @endphp
                                            <tr valign="top">
                                                <td style="<?php
                                                if(count($new_array) === 0){
                                                echo 'padding-top: 0.15%;';
                                                }else{
                                                    if ($j == 0) {
                                                    echo 'padding-top:62px;';
                                                    }else if ($j == 1) {
                                                        echo 'padding-top:2px;';} 
                                                    else if ($j == 2) {
                                                        echo 'padding-top: 2px;';} 
                                                    else if ($j == 3) {
                                                        echo 'padding-top:2px;';} 
                                                    else if ($j == 4) {
                                                        echo 'padding-top:2px;';} 
                                                    else if ($j == 5) {
                                                        echo 'padding-top:2px;';} 
                                                } 
                                                
                                                ?> padding-left: 4%;" colspan="6">
                                                    <div class="row"> 
                                                        <div class="column">&nbsp;</div>
                                                        <div class="column" style="text-align:right;padding-right:10px;"> <span style="padding-right:13px"> ZZ </span>1063480192
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="column cpt-value">
                                                            <span style="padding-left:8px">{{ $inj_mm }}</span> 
                                                            <span style="padding-left:19px">{{ $inj_dd }}</span>
                                                            <span style="padding-left:21px">{{ $inj_yy }} </span>
                                                            <span style="padding-left:20px">{{ $inj_mm }}</span>
                                                            <span style="padding-left:18px">{{ $inj_dd }}</span> 
                                                            <span style="padding-left:22px">{{ $inj_yy }}</span>
                                                            <span style="padding-left:22px">{{ ($injuryBillInfo->getBillPlaceOfService && $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode) ? $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->service_code : 'code' }}</span>
                                                    </div>
                                                    <div class="column cpt-value">
                                                            <span> {{ ($new_array[$j] && $new_array[$j]['bill_procedure_code'] != null ) ? $new_array[$j]['bill_procedure_code'] : 'NA' }}</span>
                                                            <span style="padding-left: 5%;">{{($new_array[$j]->getModifierInfo) ? $new_array[$j]->getModifierInfo['name'] : ''}}</span>
                                                            <span style="padding-left: {{($new_array[$j]->getModifierInfo) ? '39' : '43' }}%; "> 
                                                           
                                                            {{ ($new_array[$j]['bill_diag_codes1']  && $new_array[$j]['bill_diag_codes1'] != null) ? strtoupper(chr(0 + 97)) : '' }}
                                                            {{ ($new_array[$j]['bill_diag_codes2'] && $new_array[$j]['bill_diag_codes2'] != null) ? ",". strtoupper(chr(1 + 97)): '' }}
                                                            {{ ($new_array[$j]['bill_diag_codes3'] && $new_array[$j]['bill_diag_codes3'] != null) ? ",". strtoupper(chr(2 + 97)) : '' }}
                                                            {{ ($new_array[$j]['bill_diag_code4'] && $new_array[$j]['bill_diag_code4'] != null) ? ",". strtoupper(chr(3 + 97)) : '' }}
                                                            
                                            </span>
                                                    </div>
                                                    <div class="column cpt-value">
                                                        <span style="padding-left:12%;">{{($new_array[$j]['total_bill_amount']) ? $new_array[$j]['total_bill_amount'] : ''}}</span>
                                                            <span style="padding-left:17%;">{{($new_array[$j]['bill_units']) ? $new_array[$j]['bill_units'] : ''}}</span>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    @endIf
                                    @if ($leftTd != 0)
                                        @for ($jj = 0; $jj < $leftTd; $jj++)
                                            <tr valign="top">
                                                <td colspan="6" style=" height: 45px; ">&nbsp;
                                                    
                                                </td>
                                            </tr>
                                        @endfor
                                    @else
                                    <tr  valign="top"> <td colspan="6" style=" height: 315px; ">&nbsp; </td> </tr>
                                    @endif
                                    <tr  >
                                        <td valign="top">
                                            <table class="pt30" height="40px" style="font-weight:600;">
                                                <tr>
                                                    <td width="335px" class="pt-25"  valign="top" style="position:relative;">
                                                     <span style="padding-left:50px;">{{ $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id ? $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id : '' }}</span>  
                                                     <span style="position:absolute; right:5px; top:30px;">X</span>
                                                    </td>

                                                    <td width="360px" class="pt-25" valign="top"> <span style="padding-left: 40px;">477db9122800-1</span></td>

                                                    <td width="420px" class="pt-25" valign="top"> <span style="padding-left:40%">{{ (is_float($totalCharge))? $totalCharge : $totalCharge.".00" }}</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <table id="con_12" style="margin-top:10px; ">
                                                <tr>
                                                    <td width="370px" valign="top">
                                                        <table style="padding-top:0px; font-weight:600;">

                                                            <tr>
                                                                <td class="pt-60" style="font-size:14px !important;">
                                                                    <span style="padding-left:50px">{{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_first_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_first_name : '' }}
                                                                    {{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_last_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_last_name : '' }}
                                                                    {{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_middle_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_middle_name : '' }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-left:42px; font-size:14px !important;">
                                                                    <span style="padding-left:8px;">Signature on File</span>
                                                                    <span style="padding-left:79px;">12/06/2022</span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="400px" valign="top">
                                                        <table style="font-weight:600; ">
                                                            <tr>
                                                                <td class="pt-25" style="font-size:14px !important; padding-left:15px; ">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->nick_name }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size:14px !important; padding-left:15px;">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->address_line1 }}
                                                                   <span style="position:relative; right:-50px;">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->address_line2 }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size:14px!important; padding-left:15px;">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->city_id }}
                                                                      <span style="position:relative; right:-50px;">
                                                                        {{ $injuryBillInfo->getBillPlaceOfService->state_id }}
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pt-10"
                                                                    style="font-size:14px!important; padding-left:15px;">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->zipcode }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="420px" valign="top">
                                                        
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div> 
</body>
</html>
