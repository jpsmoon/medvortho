@extends('layouts.home-app-form')
<style>
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
        background-image: url('/new_assets/app-assets/images/1150-1488.jpg');
        background-size: auto 100%;
        background-repeat: no-repeat;
        background-position: left top;
    }

    #loadingForm {
        height: 1488px;
        width: 1150px;
    }

    
    
    ul#menu li {
    display:inline;
    }
    .row {
        display: flex;
    }

    .column {
      flex: 50%;
    }
    .column {
       float: left;
      width: 50%;
    }
    .column span {
    width: 50%; 
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
.pdfContentDiv{ text-transform: uppercase !important}
</style>

@section('content')
    <div style="background-color: 484C4E;"><button type="button" id="cmdPdfBtn">Print Pdf </button></div>
    <div class="row" style="background-color: 484C4E;">
        <div class="col-10 mt-4" id="pageContent">
            <div class="card row-background">
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
                        <div class="card-body pdfContentDiv" style="display: flex; padding-left:10%; padding-right:10%" id="pdfContentDiv_{{$ff}}">
                            <div id="loadingForm" class="showImgaeInBack"><br><br><br><br>
                                <table width="1150px" id="tdcontent">
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td width="700px" style="padding-top:25px"></td>
                                                    <td>{{ ($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : 'Sedgwick Claims Management Services'}}</td>
                                                </tr>
                                                <tr>
                                                    <td width="700px"></td>
                                                    <td>Submitted Electronically via Data Dimensions</td>
                                                </tr>
                                                <tr>
                                                    <td width="700px"></td>
                                                    @if($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->payer_id)
                                                    <td> 'Payer ID: ( {{  $injuryBillInfo->getInjury->getInjuryClaim->payer_id }} ) </td>
                                                    @else
                                                    <td>&nbsp;</td>
                                                    @endif
                                                    
                                                </tr>
                                                <tr>
                                                    <td width="660px"></td>
                                                    <td style="padding-left:160px">CMS1500 Page {{$ff}} of {{count($existing_array)}}</td>
                                                </tr>
                                                <tr>
                                                    <td width="660px"></td>
                                                    <td style="padding-top:32px; padding-left:6px">
                                                        {{ $injuryBillInfo->getInjury->patient->ssn_no }}</td>
                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="430px"><table><tr><td style="padding-top:15px; padding-left:48px">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : '' }}
                                                    {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : '' }}
                                                    </td></tr></table></td>
                                                    
                                                    @if ($injuryBillInfo->getInjury->patient->gender == 'Male')
                                                    <td valign="top" width="270px"><table><tr>
                                                        <td style="padding-top:19px; padding-left:21px">{{ $mm }}</td> <td style="padding-top:19px; padding-left:23px">{{ $dd }}</td><td style="padding-top:19px; padding-left:33px">{{ $yy }}</td><td style="padding-top:19px; padding-left:30px">X</td></tr></table></td>
                                                    @else
                                                    <td valign="top" width="270px"><table><tr>
                                                        <td style="padding-top:19px; padding-left:21px">{{ $mm }}</td> <td style="padding-top:19px; padding-left:23px">{{ $dd }}</td><td style="padding-top:19px; padding-left:33px">{{ $yy }}</td><td style="padding-top:17px; padding-left:99px">X</td></tr></table></td>
                                                    @endif
                                                    <td valign="top" width="405px" ><table><tr><td style="padding-top:15px; ">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : '' }}
                                                    {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : '' }}</td></tr></table></td>
                                                    
                                                </tr> 
                                                
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="430px"><table><tr><td style="padding-top:15px; padding-left:48px">{{ $injuryBillInfo->getInjury->patient->address_line1 && $injuryBillInfo->getInjury->patient->address_line2 ? $injuryBillInfo->getInjury->patient->address_line1 . ', ' . $injuryBillInfo->getInjury->patient->address_line2 : $injuryBillInfo->getInjury->patient->address_line1 }}</td></tr></table></td>
                                                    
                                                    
                                                    <td valign="top" width="270px"><table><tr>
                                                        <td style="padding-top:19px; padding-left:21px"></td> <td style="padding-top:19px; padding-left:23px"></td><td style="padding-top:19px; padding-left:33px"></td><td style="padding-top:13px; padding-left:146px">X</td></tr></table></td>
                                                
                                                    <td valign="top" width="405px" ><table><tr><td valign="top" width="430px"><table><tr><td style="padding-top:15px;">{{ $injuryBillInfo->getInjury->patient->address_line1 && $injuryBillInfo->getInjury->patient->address_line2 ? $injuryBillInfo->getInjury->patient->address_line1 . ', ' . $injuryBillInfo->getInjury->patient->address_line2 : $injuryBillInfo->getInjury->patient->address_line1 }}</td></tr></table></td></tr></table></td>
                                                    
                                                </tr> 
                                                
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="430px">
                                                        <table>
                                                            <tr>
                                                                <td style="padding-top:10px; padding-left:48px; width: 329px;">{{$injuryBillInfo->getInjury->patient->city_id }}</td>
                                                                <td style="padding-top:10px; padding-left:5px;">{{ $stateCode }} </td>
                                                             </tr>
                                                        </table>
                                                    </td>
                                                    
                                                    
                                                    <td valign="top" width="270px">
                                                        <table>
                                                            <tr>
                                                                <td style="padding-top:19px; padding-left:21px"></td> 
                                                                <td style="padding-top:19px; padding-left:23px"></td>
                                                                <td style="padding-top:19px; padding-left:33px"></td>
                                                                <td style="padding-top:14px; padding-left:148px"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                
                                                    <td valign="top" width="405px" ><table>
                                                        <tr>
                                                            <td style="padding-top:10px;">{{$injuryBillInfo->getInjury->patient->city_id }}</td>
                                                            <td style="padding-top:10px; padding-left:261px;">{{ $stateCode }} </td>
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
                                                    <td valign="top" width="430px">
                                                        <table>
                                                            <tr>
                                                                <td style="padding-top:15px; padding-left:48px; width:165px;">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->zipcode)  ? $injuryBillInfo->getInjury->patient->zipcode : '' }}</td>
                                                                <td style="padding-top:10px; padding-left:5px;">
                                                                    {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->contact_no)  ? $injuryBillInfo->getInjury->patient->contact_no : '' }}
                                                                </td>
                                                             </tr>
                                                        </table>
                                                    </td>
                                                    
                                                    
                                                    <td valign="top" width="270px"><table><tr>
                                                    <td style="padding-top:19px; padding-left:21px"></td> <td style="padding-top:19px; padding-left:23px"></td><td style="padding-top:19px; padding-left:33px"></td><td style="padding-top:14px; padding-left:148px"></td></tr></table></td>
                                                
                                                    <td valign="top" width="405px" ><table><tr>
                                                        <td style="padding-top:15px;  width:165px">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->zipcode)  ? $injuryBillInfo->getInjury->patient->zipcode : '' }}</td>
                                                        
                                                        <td valign="top" style="width:200px; padding-top:15px;">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->contact_no)  ? $injuryBillInfo->getInjury->patient->contact_no : '' }}</td>
                                                        </tr></table></td>
                                                    
                                                </tr> 
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td style="height:39px;" valign="top">
                                            <table style="height:39px;">
                                                <tr>
                                                    <td valign="top" width="430px">
                                                        <table>
                                                            <tr>
                                                                <td style="padding-top:15px; padding-left:48px; width:329px;"></td>
                                                                <td style="padding-top:10px; padding-left:5px;"></td>
                                                             </tr>
                                                        </table>
                                                    </td>
                                                    
                                                    
                                                    <td valign="top" width="270px"><table><tr>
                                                        <td style="padding-top:19px; padding-left:21px"></td> <td style="padding-top:19px; padding-left:23px"></td><td style="padding-top:19px; padding-left:33px"></td><td style="padding-top:14px; padding-left:148px"></td></tr></table></td>
                                                
                                                    <td valign="top" width="405px" ><table><tr><td></td></tr></table></td>
                                                    
                                                </tr> 
                                                
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td width="425px" style="padding-top:20px; padding-left:41px"></td>
                                                    <td width="275px" style="padding-top:17px; padding-left:11.23%">X</td>
                                                    <td width="425px"  style="padding-top:13px">
                                                        <span style="width:17px; padding-left:47%">{{ $mm }}</span>
                                                        <span style="width:17px; padding-left:25px">{{ $dd }}</span>
                                                        <span style="width:17px; padding-left:25px">{{ $yy }}</span>
                                                    </td>
                                                     @if ($injuryBillInfo->getInjury->patient->gender == 'Male')
                                                    <td width="260px" style="padding-left: 1%;padding-top:14px"><span>X</span> </td>
                                                     @else
                                                     <td width="270px" style="padding-left: 9.56%;padding-top:14px"><span style="padding-left:140px">X</span> </td>
                                                     @endif
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td width="425px" style="padding-top:22px"></td>
                                                   <td width="275px" style="padding-top:14px"><span style="padding-left:157px">X</span> </td>
                                                    <td style="padding-top:22px; padding-left:50px" for="claim_no">{{$injuryBillInfo->getInjury->getInjuryClaim->claim_no }}</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td width="425px" style="padding-top:20px"></td>
                                                    <td width="275px" style="padding-top:14px"><span style="padding-left:157px">X</span></td>
                                                    <td width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top"><br><br><br>
                                            <table>
                                                <tr>
                                                    <td width="425px" style="padding-top:46px"> <span style="padding-left:140px">SIGNATURE ON FILE </span></td>
                                                    <td width="275px" style="padding-top:48px"> <span style="padding-left:96px">11/11/2022</span></td>
                                                    <td width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td width="425px" style="padding-top:26px"><span style="padding-left:63px">{{ $inj_mm }}</span><span style="padding-left:26px">{{ $inj_dd }}</span><span style="padding-left:35px">{{ $inj_yy }}</span></td>
                                                    <td width="275px"></td>
                                                    <td width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top" style="height:40px">
                                            <table style="height:40px">
                                                <tr>
                                                    <td width="425px"></td>
                                                    <td width="275px"></td>
                                                    <td width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top" style="height:40px">
                                            <table style="height:40px">
                                                <tr>
                                                    <td width="425px">
                                                        <span style="padding-left:15%;">{{($injuryBillInfo && $injuryBillInfo->bill_additiona_information_box) ?  $injuryBillInfo->bill_additiona_information_box : '' }}</span></td>
                                                    <td width="275px"></td>
                                                    <td width="420px"> </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <span style="padding-left: 45%;">&nbsp;</span>
                                            <span style="padding-left:78px;">01</span>
                                        </td>
                                        
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top" style="height:65px">
                                        <table style=" width: 857px; ">
                                            <td valign="top">
                                                <table  style=" width:700px; ">
                                                     @if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0)
                                                        @foreach ($injuryBillInfo->getBillDiagnosis as $key => $billDiagnos)
                                                         @if ($key % 4 == 0)
                                                        @if ($key != 0)
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                        @endif
                                                            <td style="{{($key ==0) ? 'width:30%;padding-left:9%;' : 'width:31%;padding-left: 21%;'}}">{{($billDiagnos && $billDiagnos->getBillDiagnosisName) ? $billDiagnos->getBillDiagnosisName->diagnosis_code : '' }}</td>
                                                        @if (($key+1) % 4 == 0 || $key == 4)
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </table>
                                            </td>
                                            <td style="width: 213px;padding-top: 4%; padding-left:15px;">
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
                                                    echo 'padding-top: 4.2%;';
                                                    }else if ($j == 1) {
                                                        echo 'padding-top: 0.5%;';} 
                                                    else if ($j == 2) {
                                                        echo 'padding-top: 0.5%;';} 
                                                    else if ($j == 3) {
                                                        echo 'padding-top: 0.5%;';} 
                                                    else if ($j == 4) {
                                                        echo 'padding-top: 0.5%;';} 
                                                    else if ($j == 5) {
                                                        echo 'padding-top: 0.5%;';} 
                                                } 
                                                
                                                ?> padding-left: 4%;" colspan="6">
                                                    <div class="row"> 
                                                        <div class="column">&nbsp;</div>
                                                        <div class="column" style="text-align: right;padding-right: 10%;"> <span style="padding-right:13px"> ZZ </span>1063480192
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="column">
                                                            <span style="padding-left:8px">{{ $inj_mm }}</span> 
                                                            <span style="padding-left:19px">{{ $inj_dd }}</span>
                                                            <span style="padding-left:21px">{{ $inj_yy }} </span>
                                                            <span style="padding-left:20px">{{ $inj_mm }}</span>
                                                            <span style="padding-left:18px">{{ $inj_dd }}</span> 
                                                            <span style="padding-left:22px">{{ $inj_yy }}</span>
                                                            <span style="padding-left:22px">{{ ($injuryBillInfo->getBillPlaceOfService && $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode) ? $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->service_code : 'code' }}</span>
                                                    </div>
                                                    <div class="column">
                                                            <span> {{ ($new_array[$j] && $new_array[$j]['bill_procedure_code'] != null ) ? $new_array[$j]['bill_procedure_code'] : 'NA' }}</span>
                                                            <span style="padding-left: 5%;">{{($new_array[$j]->getModifierInfo) ? $new_array[$j]->getModifierInfo['name'] : ''}}</span>
                                                            <span style="padding-left: {{($new_array[$j]->getModifierInfo) ? '39' : '43' }}%; "> 
                                                           
                                                            {{ ($new_array[$j]['bill_diag_codes1']  && $new_array[$j]['bill_diag_codes1'] != null) ? strtoupper(chr(0 + 97)) : '' }}
                                                            {{ ($new_array[$j]['bill_diag_codes2'] && $new_array[$j]['bill_diag_codes2'] != null) ? ",". strtoupper(chr(1 + 97)): '' }}
                                                            {{ ($new_array[$j]['bill_diag_codes3'] && $new_array[$j]['bill_diag_codes3'] != null) ? ",". strtoupper(chr(2 + 97)) : '' }}
                                                            {{ ($new_array[$j]['bill_diag_code4'] && $new_array[$j]['bill_diag_code4'] != null) ? ",". strtoupper(chr(3 + 97)) : '' }}
                                                            
                                            </span>
                                                    </div>
                                                    <div class="column">
                                                        <span style="padding-left: 5%;">{{($new_array[$j]['total_bill_amount']) ? $new_array[$j]['total_bill_amount'] : ''}}</span>
                                                            <span style="padding-left: 5%;">{{($new_array[$j]['bill_units']) ? $new_array[$j]['bill_units'] : ''}}</span>
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
                                    <tr valign="top"> <td colspan="6" style=" height: 315px; ">&nbsp; </td> </tr>
                                    @endif
                                    <tr>
                                        <td valign="top">
                                            <table height="40px">
                                                <tr>
                                                    <td width="335px" valign="top"style="padding-top:17px">
                                                     <span style="padding-left: 50px;">{{ $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id ? $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id : '' }}</span>   
                                                    </td>

                                                    <td width="360px" valign="top" style="padding-top:17px"> <span style="padding-left: 10px;">477db9122800-1</span></td>

                                                    <td width="420px" valign="top" style="padding-top:17px;"> <span style="padding-left:53%">{{ (is_float($totalCharge))? $totalCharge : $totalCharge.".00" }}</span></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <table id="con_12">
                                                <tr>
                                                    <td width="335px" valign="top">
                                                        <table style="padding-top:0px; heigth:100px;">

                                                            <tr>
                                                                <td style="padding-top:55px; font-size:14px !important;">
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
                                                    <td width="360px" valign="top">
                                                        <table style="padding-top:0px; heigth:100px;">
                                                            <tr>
                                                                <td
                                                                    style="padding-top:15px; font-size:14px !important; padding-left:8px; ">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->nick_name }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size:14px !important; padding-left:8px;">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->address_line1 }}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->address_line2 }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size:14px !important; padding-left:8px;">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->city_id }}
                                                                    &nbsp;&nbsp;&nbsp;&nbsp;{{ $injuryBillInfo->getBillPlaceOfService->state_id }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td
                                                                    style="padding-top:11px; font-size:14px !important; padding-left:10px;">
                                                                    {{ $injuryBillInfo->getBillPlaceOfService->zipcode }}
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="420px" valign="top">
                                                        <table style="padding-top:0px; heigth:100px;">
                                                            @if ($injuryBillInfo->getInjury->patient->getBillingProvider)
                                                                <tr>
                                                                    <td style="padding-top:1px; padding-left:228px;">
                                                                        @php $phone1 = '';  $phone2 = '';
                                                                            if ($injuryBillInfo->getInjury->patient->getBillingProvider->professional_telephone) {
                                                                                $ex = explode(' ', $injuryBillInfo->getInjury->patient->getBillingProvider->professional_telephone);
                                                                                
                                                                                if ($ex) {
                                                                                    $phone1 = $ex[0];
                                                                                    $phone2 = $ex[1];
                                                                                }
                                                                            }
                                                                        @endphp
                                                                        &nbsp;{{ $phone1 }}&nbsp;&nbsp;
                                                                        {{ $phone2 }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size:14px !important; padding-left:6px;">
                                                                        {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size:14px !important; padding-left:6px;">
                                                                        {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres1 }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="font-size:14px !important; padding-left:6px;">
                                                                        {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_city }}
                                                                        &nbsp;{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_state }}
                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_zip }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td
                                                                        style="padding-top:2px; font-size:14px !important; padding-left:10px;">
                                                                        {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_npi }}
                                                                    </td>
                                                                </tr>
                                                            @endIf
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="background-color:484C4E;">.</div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js">
</script>
<script type="text/javascript">
    $(document).ready(function() {
         $('#cmdPdfBtn').click(function() { 
            generatePDFPage(1 );
        });
    });
function getPdfInfo(){
    var pdf = new jsPDF('p', 'px', [800, 800],true);
    var pdfArray = <?php echo $totForm ?>;
    var idNum = 1;
    let pdfDownloadName = 'patientpdf' + idNum + new Date().getTime() + '.pdf';
    var numPages = pdfArray // Get the total number of pages to be generated
    console.log('check numPages',numPages);
    let newArr = [];
    newArr.push({'pdf' : pdf, 'pdfDownloadName' : pdfDownloadName, 'numPages' : numPages });
    return newArr

}
function generatePDFPage(pageNum) {
    let pdftechInfo =  getPdfInfo();
    var pdf = pdftechInfo[0]['pdf'];
    let pdfDownloadName = pdftechInfo[0]['pdfDownloadName'];
    var numPages = pdftechInfo[0]['numPages'];
     
    var divId = 'pdfContentDiv_' + pageNum;
    console.log('check divId',divId);
    html2canvas(document.getElementById(divId), {
        onrendered: function(canvasObj) {
        const pageWidth = pdf.internal.pageSize.getWidth();
        const pageHeight = pdf.internal.pageSize.getHeight();

        const widthRatio = pageWidth / canvasObj.width;
        const heightRatio = pageHeight / canvasObj.height;
        const ratio = widthRatio > heightRatio ? heightRatio : widthRatio;

        const canvasWidth = canvasObj.width * ratio;
        const canvasHeight = canvasObj.height * ratio;
        
        //pdf.addImage(canvasObj.toDataURL(), 'JPEG', 10, 0, 1200, 1300, '', 'FAST');
        pdf.addImage(canvasObj.toDataURL(), 'JPEG', 0, 0, canvasWidth, canvasHeight,'', 'FAST');
            if (pageNum < numPages) {
                pdf.addPage();
                setTimeout(function() {
                    generatePDFPage(pageNum+1);
                }, 300);
            } 
            else {
                pdf.save(pdfDownloadName); // Save the PDF file when all pages have been added
                //pdf.output('pdfDownloadName');
            }
            console.log('check pageNum',pageNum);
        }
    });
}
</script>