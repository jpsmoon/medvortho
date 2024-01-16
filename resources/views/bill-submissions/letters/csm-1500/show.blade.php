<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
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
    html,
    body {
      page-break-before: avoid;
      page-break-after: avoid;
      box-sizing: border-box;
      margin: 0px;
      padding: 0px;
      font-weight: 400!important;
      font-family: 'Figtree', sans-serif !important;
      font-size:16px;
    }
     .claimForm {
      padding: 0;
      width: 100%;
      background: #fff;
    }

    table.picu tr td {
      border: 1px solid #EA1D22 !important;
      width: 15px;
      height: 15px;
      padding: 0.3rem;
    }
    .red{color:#EA1D22;}

    .d-flex {
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .rowcol {
      display: flex;
      border: 0px solid #333;
      width: 100%;
    }

    .rowcol label {
      padding: 0;
      color: #EA1D22;
      margin-bottom: 0rem;
    }

    .colum-8 {
      flex: 66.66% 0 0;
      width: 66.66%;
    }

    .colum-4 {
      flex: 33.33% 0 0;
      width: 33.33%;
    }

    .colum-12 {
      flex: 100% 0 0;
      width: 100%;
    }

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    .text-right {
      text-align: right;
    }
    .redhr {
      width: 100%;
      height: 2px;
      background: #EA1D22;
    }

    .box-left {
      display: flex;
      justify-content: flex-start;
    }

    .box-right {
      display: flex;
      justify-content: flex-end;
    }

    table,
    table td {
      border-collapse: collapse !important;
    }

    table.redborder {
      width: 100%;
    }

    .border-2top {
      border-top: 2px solid #EA1D22!important
    }

    .border-2bottom {
      border-bottom: 2px solid #EA1D22 !important
    }
    .border-2xbottom {
      border-bottom:1px solid #EA1D22 !important
    }

    .border-1top {
      border-top: 1px solid #EA1D22 !important
    }
    .border-bottom{
         border-bottom: 1px solid #EA1D22!important
    }

    .border-1bottom {
      border-bottom: 1px solid #EA1D22 !important
    }

    table.redborder tr td {
      border: 1px solid #EA1D22;
      padding: 0rem;
      vertical-align: top;
      color:#EA1D22;
    }

    table.redborder tr td:last-child {
      border-left: 1.5px solid #EA1D22;
    }

    table.simpleborder {
      width: 100%;
      border-top: 0px solid #EA1D22;
      border-bottom: 0px solid #EA1D22;
      border: 1px solid #EA1D22 !important;
      padding: 0px;
    }

    table.simpleborder tr td {
      border: 1px solid #EA1D22 !important;
      vertical-align: top;
      padding: 0.3rem !important
    }

    .bgpink {
      background: #fee8dd;
    }
    
    .bottomtxt {
      color: #EA1D22;
      font-style: normal;
      font-weight:500 !important;
      font-size: 9px;
      font-family: 'Figtree', sans-serif!important
    }
    .h4 {
      color:#EA1D22;
      font-style: italic;
      font-weight: 700!important;
      font-size:9px;
    }

    .font-4 {
      color: #EA1D22;
      font-style: normal;
      font-weight: 500 !important;
      text-align: right !important;
      font-size:0.75rem;
      padding-bottom:1.05rem!important;
    }
table tr:nth-child(1) .font-4 {
    padding-bottom:1.05rem!important;
}
table tr:nth-child(2) .font-4 {
    padding-bottom:1.05rem!important;
}
table tr:nth-child(3) .font-4 {
    padding-bottom:1.05rem!important;
}
table tr:nth-child(4) .font-4 {
    padding-bottom:1.05rem!important;
}
table tr:nth-child(5) .font-4 {
    padding-bottom:1.05rem!important;
}

    table.borderRgt {
      width: 100%;
      border: 0px solid #EA1D22 !important;
    }

    table.borderRgt tr td {
      border: 0px solid #EA1D22;
      padding: 0.1rem;
    }

    table tr.border-top {
      border-top: 1px solid #EA1D22 !important;
      padding-top:0px!important;
      padding-bottom:0px!important;
    }

    table .border-top-dashed {
      border-top: 1px dashed #EA1D22 !important;
    }

    table.borderRgt tr td:last-child {
      border-left: 1px solid #EA1D22;
    }

    table.rightdashedborder {
      width: 100%;
      border: 0px dashed #EA1D22 !important;
    }

    table.rightdashedborder tr td {
      border: 0px solid #EA1D22;
      border-right: 1px dashed #EA1D22;
      padding: 0.2rem;
      text-align: center;
    }
     table.rightdashedborder tr td label{
         color:#EA1D22;
     }

    table.rightdashedborder tr td.solid {
      border-right: 1px solid #EA1D22;
    }

    table.rightdashedborder tr td.dashed {
      border-right: 1px dashed #EA1D22;
    }

    table.rightdashedborder tr td.solid-right {
      border-left: 1px solid #EA1D22;
    }

    table.rightdashedborder tr td.noborder {
      border-right: 0px solid #EA1D22;
    }

    table.rightdashedborder tr td:last-child {
      border-left: 0px dashed #EA1D22;
    }

    table.borderless tr td:last-child {
      border-left: 0px solid #EA1D22;
    }
    table.borderless {
      padding: 0rem;
      font-size: 7px;
    }

    table.borderless tr td {
      padding: 0rem 3px;
      font-weight:400;
      color: #EA1D22;
      border: 0px solid #000;
    }
    table.borderright tr td {
      border-right: 1px dashed #EA1D22;
      text-align: center;
      vertical-align: top;
    }
    table.borderright tr td:nth-child(3) {
      border-right: 0px dashed #EA1D22!important;
    }
    .p-nil {
      padding: 0px !important;
    }
    .p-0 {
      padding: 4px !important;
    }

    .pb-0 {
      padding-bottom: 0px !important;
    }

    .pb-1 {
      padding-bottom: 0.65rem !important;
    }

    .pb-1s {
      padding-bottom: 0rem !important;
    }

    .pt-0 {
      padding-top: 0px !important;
    }

    .pt-1 {
      padding-top: 0rem !important;
    }

    .pt-3 {
      padding-top: 0.1rem !important;
    }
    .pe-5 {
      padding-right: 5px !important;
    }

    .p-1 {
      padding: 8px !important;
    }
    
    .ps-5 {
      padding-left: 5px !important;
    }

    .ps-10 {
      padding-left: 10px !important;
    }

    .ps-25 {
      padding-left: 25px !important;
    }

    .ms-26 {
      margin-left: 26px !important;
    }

    .me-26 {
      margin-right: 26px !important;
    }

    .mt-5 {
      margin-top: 0.5rem !important;
    }
    .pos-2 {
      position: relative;
      bottom: -5px;
    }
    .pt-66{
        padding-top:50px!important;
    }
    .text-dark {
      color: #000000 !important;
      padding-left:3px !important;
    }

    .text-dark2 {
      color: #000000 !important;
      font-weight: 500 !important;
      padding-left:3px !important;
      line-height:6px;
    }

    .text-dark-xx {
      /*font-size:9px;*/
      font-size:0.5625rem;
      color: #000000 !important;
      font-weight:700 !important;
    }

    .rowcol .box-left label,
    .rowcol .box-right label {
      padding: 0 5px;
    }

    .red_text {
      border: 0px solid red;
      width: 100px;
    }

    table.borderless.tpBm tr td {
      padding: 0.0rem 2px;
    }

    small {
      font-size:100%;
    }

    .half-box {
      width: 100px;
      height: 15px;
      border-bottom: 1px solid #EA1D22;
      border-left: 1px solid #EA1D22;
      border-right: 1px solid #EA1D22;
      padding: 0px 25px;
      margin: 5px;
      margin-left: 12px;
      position: relative;
      top: 7px;
    }

    .custom_value {
      border-bottom:0.031rem solid #EA1D22;
      color: #000 !important;
      margin:0px 0 0px 0px;
      display:inline-block;
    }

    .custom_value33 {
      border-bottom: 0px solid #EA1D22;
      color: #000 !important;
      margin: 0px 0 0px 0px;
    }

    .custom_value2 {
      border-left: 1px solid #EA1D22;
      border-bottom: 1px solid #EA1D22;
      color: #000 !important;
      margin:0px 0 0px 10px;
      padding-left:7px!important;
      width:85%;
    }
.text-npi-bg{
    position: relative;
      left:-20px;
}

    .text-npi-bg .bgtxt {
      position: relative;
      color: #EA1D2230;
      z-index:0;
      left:40%;
      font-size:13px;
    }

    .bottom-table {
      position: relative;
      bottom: -5px;
    }

    .bottom-table2 {
      position: relative;
      bottom: -5px;
    }

    

    .logo {
      width: 40px;
      height: auto;
    }

    /*.h-66 {*/
    /*  height: 66px !important*/
    /*}*/

    .Lpos {
      position: relative;
      left: 5px;
    }

    .Rpos {
      position: relative;
      right: 7px;
    }

   

    .text-left {
      text-align: left !important;
    }

    label,
    output {
      display: inline-block;
    }

    .w-25 {
      width: 15px !important;
    }

    .w-30 {
      width: 30px;
    }

    table.borderRgt tr td {
      border: 0px solid #EA1D22;
      padding: 0 3px !important;
    }

    .container,
    .container-fluid {
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;

    }

    img {
      overflow-clip-margin: content-box;
      overflow: clip;
    }

    table {
      border-collapse: separate;
      text-indent: initial;
      white-space-collapse: collapse;
      text-wrap: wrap;
      line-height: normal;
      font-weight: normal;
      font-size: medium;
      font-style: normal;
      color: -internal-quirk-inherit;
      text-align: start;
      border-spacing:0px;
      font-variant: normal;
    }

    .Letter h5,
    .Letter b,
    .Letter .label {
      font-weight: 700 !important;
    }

    .row {
      display: -webkit-box;
      display: -webkit-flex;
      display: -moz-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-wrap: wrap;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
    }

    .card {
      margin-bottom: 1.875rem;
      word-wrap: break-word;
    }

    .Letter table tr td {
      padding: 0.5em 1em;
    }

    .row-background {
      background-color: #fff;
    }

    .Letter table tr td label.w90 {
      width: 70% !important;
    }

    .Letter table tr td span.title {
      width: 23% !important;
    }

    .Letter table tr td input[type="text"] {
      width: 77% !important;
    }

    .pos-1 {
      bottom: -7px;
    }

    .pos-2 {
      bottom: -2px;
    }

    table.valTab tr td {
      height:6px;
      font-weight:500!important;
      font-family: 'Figtree', sans-serif!important;
    }
  
  .signPOS {
      position:relative;
     bottom:-12px;
    }
    
    .w10 {
      width: 14% !important;
    }
    
    .w15 {
      width: 18% !important;
    }

    .w80 {
      width: 76% !important;
    }

    .w70 {
      width: 71% !important;
    }
    
    .w80 {
      width: 80% !important;
    }

    .Lpos {
      left: -4px;
    }

    .w-30 {
      width: 20px;
    }

    .fom1 {
      right: -4px;
    }

    .Rpos {
      right: -4px;
    }

    table td {
      /*font-size:7px;*/
      font-size:0.48rem;
      font-weight: 300;
    }
    
    .fontxxx {
      font-size:0.50rem;
      font-weight: 300;
    }
    .claimForm {
      margin: 0;
      padding: 0;
      margin-top:5px;
    }

    .Letter table tr td {
      padding: 0em 1em;
    }

    .rowcol label {
      padding: 0;
      margin: 0;
    }

    .mainSec {
      padding: 0 0px !important;
      width: 100% !important;
      flex: 0 0 100%;
      max-width: 100%;
    }

    .print-none,
    footer {
      display: none !important;
    }

    table.picu tr td {
      padding: 0.1rem;
    }
    table.simpleborder tr td {
      padding: 0.1rem !important
    }



    .row-background {
      background-color: #fff;
    }

    .card {
      -webkit-box-shadow: 0 3px 6px rgba(0, 0, 0, .0) !important;
      box-shadow: 0 3px 6px rgba(0, 0, 0, .0) !important;
    }

    .bottom-table {
      bottom: -2px;
    }

 

    .p-0 {
      padding:0px !important;
    }

    .p-1 {
      padding: 2px !important;
    }

    .pt-20 {
      padding-top: 0.95rem !important;
    }

    .ps-25 {
      padding-left: 25px !important;
    }

    .pt-8 {
      padding-top:4px !important;
    }

    table.redborder tr td {
      padding: 0rem;
    }

    .text-dark {
      line-height:6px;
      /*font-size:9px;*/
      font-size:0.5625rem;
      font-weight: 500 !important;
    }
    .tabBox td{
        padding:0px!important;
     }
   .tabBox .text-dark {
      line-height:2px;
      /*font-size:9px;*/
      font-size:0.5rem;
      font-weight: 400 !important;
    }
   
    .valTab .text-dark {
      line-height:10px;
      /*font-size:9px;*/
      font-size:0.70rem;
      font-weight: 500 !important;
    }

    .pos-1 {
      bottom: -6px;
    }

    .w15 {
      width: 18% !important;
    }

    .w85 {
      width: 85% !important;
    }

    .pos-2 {
      position: relative;
      bottom: -2px;
    }

    table.minheight tr td {
      height:10px;
    }

    .pt-20 {
      padding-top: 0.2rem !important;
    }

    .h-66 {
      height:22px !important;
    }

    .Lpos {
      position: relative;
      left: -6px;
    }

    .Rpos {
      position: relative;
      right: -22px;
    }

    .fom1 {
      position: relative;
      right: -6px;
    }

    .fom2 {
      position: relative;
      right: -2px;
    }

    .fom3 {
      position: relative;
      right: -3px;
    }

    .red_check {
      position: relative;
      padding: 0rem;
      top:3px;
      border: 1px solid #EA1D22;
      width:10px;
      height:10px;
      color: #000;
      font-weight: 500;
      display: inline-block;
      font-size:9px;
      line-height:8px;
      text-align: center;
      margin-left: 3px;
      margin-right: 3px;
      margin-bottom:2px;
    }

    label,
    output {
      display: inline-block;
    }

    .text-left {
      text-align: left !important;
    }

    table,
    table td {
      border-collapse: collapse !important;
    }

    .pt-3 {
      padding-top: 0rem !important;
    }

    .Lpos tr td span {
      line-height: 22px;
    }

    .logotitle {
      font-size: 14px;
      line-height:12px;
      font-family: Arial, Helvetica, sans-serif;
      font-weight: bold
    }

    .Lpos {
      left: -8px;
    }

    .w-30 {
      width: 25px;
    }

    .fom1 {
      right: -4px;
    }

    .Rpos {
      right: -10px;
    }


    table.borderless.tpBm .pb-1 {
      padding-bottom: 0.15rem !important;
    }

    .full-view {
      width: 100%;
    }

    .label,
    label {
      font-weight:500 !important;
      font-family: 'Figtree', sans-serif !important;
    }

    table {
      border-collapse: collapse;
    }

    .Letter table tr td {
      padding: 0.5em;
    }

    .p-2 {
      padding: 1.25rem;
    }

    .table-borderless {
      width: 100%;
    }

    .margin-auto {
      margin: 0 auto !important;
    }

    .float-right {
      text-align: -webkit-right;
    }

    table {
      page-break-inside: avoid;
    }
    .mainTittle {
       margin-top: 10px!important;
     }
    .mainTittle .text-dark-xx{
        /*font-size:12px;*/
        font-size:0.68rem;
        line-height:0.6rem;
        font-weight:600!important;
        text-transform:uppercase
        
    }   
     .Bfont .text-dark-xx{
        /*font-size:12px;*/
        font-size:0.77rem;
        line-height:0.62rem;
        font-weight:500!important;
        text-transform:uppercase;
    }   
    
    
    .text-dark2{
        font-size:0.70rem;
        line-height:0.55rem;
    }
    .B-bold{
        font-size:0.6rem;
    }
 .v1 tr td label{
     width:6px;
 }
 .v1 tr td .custom_value2{
     display:inline-block;
 }
 .valTab b.block{
     display:block;
 }
.fom1{
     position:relative;
 }
 .img1{
     background:url('https://www.pretentious.me/public/new_assets/images/form-1txt.jpg') 0 0 no-repeat;
     background-size:cover;
     position:absolute;
     left:10px;
     top:0px;
     width:8px;
     height:80px;
     display:block;
 }
 .fom2{
     position:relative;
 }
 .img2{
     background:url('https://www.pretentious.me/public/new_assets/images/form-2txt.jpg') 0 0 no-repeat;
     background-size:contain;
     position:absolute;
     left:5px;
     top:10px;
     width:11px;
     height:290px;
     display:block;
 }
  .fom3{
     position:relative;
 }
 .img3{
     background:url('https://www.pretentious.me/public/new_assets/images/form-3txt.jpg') 0 0 no-repeat;
     background-size:contain;
     position:absolute;
     left:5px;
     top:10px;
     width:9px;
     height:450px;
     display:block;
 }
   .noBtop {
      border-top: 0px solid #EA1D22 !important;
    }

    .noBbottom {
      border-bottom: 0px solid #EA1D22 !important;
    }

    .noBleft {
      border-left: 0px solid #EA1D22 !important;
    }

    .noBright {
      border-right: 0px solid #EA1D22 !important;
    }
  </style>
</head>
<body>
      <!--Main form section start here-->
  <div class="claimForm p-1 px-2">
  @if ($injuryBillInfo)
   @php 
    $totalCharge = 0;
   if($injuryBillInfo->getBillServices && count($injuryBillInfo->getBillServices) > 0){
       foreach($injuryBillInfo->getBillServices as $cnt){
            $totalCharge += $cnt['total_bill_amount'];
       }
    }
   @endphp
  @php 
  if(count($injuryBillInfo->getBillServices) > 0){
  $existing_array = [...$injuryBillInfo->getBillServices];
  }
  else{
  $existing_array = [1];
  }
  $ff =0; @endphp
  @php
    $mm = null;
    $dd = null;
    $yy = null;
    $stateCode = null;
    $inj_mm = null;
    $inj_dd = null;
    $inj_yy = null;
    $bDOSMM = null;
    $bDOSDD = null;
    $bDOSYYS = null; 
    $bEDOSMM = null;
    $bEDOSDD = null;
    $bEDOSYYS = null; 
    $bInjuryMM = null; 
    $bInjuryDD  = null; 
    $bInjuryYYS = null; 
  @endphp
  @php
 
  @endphp
  @for ($ii = 0; $ii < count($existing_array); $ii += 6)
  @php
  $new_array = [];
  $start = $ii;
  $end = min($ii + 6, count($existing_array));
  $slice = array_slice($existing_array, $start, $end - $start);
  $new_array = (count($injuryBillInfo->getBillServices) > 0) ? array_merge($new_array, $slice) : []; 
  $ff++;
  @endphp 
  
      
  <table width="100%" class="p-0 m-0" id="pdfContentDiv_{{$ff}}">
      <tr>
        <td>
          <table class="redborder">
            <tr>
              <td colspan="5" class="noBleft noBtop noBright noBbottom">
                <table width="100%" class="noBleft noBright noBbottom">
                  <tr>
                    <td class="p-nil w-25" style="border:0px solid #333;">&nbsp;</td>
                    <td style="padding-left:5px; border:0px solid #333; ">
                      <table class="borderless p-nil" width="100%" >
                        <tr>
                          <td><img src="../public/new_assets/images/scaner.jpg" alt="logo Scan" class="logo"></td>
                          <td rowspan="3">
                            <table class="borderless p-nil mainTittle" width="100%">
                              <tr>
                                <td class="text-dark-xx">{{ ($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : 'Sedgwick Claims Management Services'}}</td>
                              </tr>
                              <tr>
                                <td class="text-dark-xx">{{ ($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->admin_address) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->admin_address : '-'}}</td>
                              </tr>
                              <tr>
                                 @if($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->payer_id)
                                <td class="text-dark-xx"> 'Payer ID: ( {{  $injuryBillInfo->getInjury->getInjuryClaim->payer_id }} ) </td>
                                @else
                                <td class="text-dark-xx">&nbsp;</td>
                                @endif
                              </tr>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td style="padding-top:2px;"><span class="logotitle">HEALTH INSURANCE CLAIM FORM </span></td>
                        </tr>
                        <tr style="padding-bottom:15px;">
                          <td><label>APPROVED BY NATIONAL UNIFORM CLAIM COMMITTEE (NUCC) 02/12</label></td>
                        </tr>
                      </table>
                    </td>
                    <td rowspan="2" class="noBright noBtop noBbottom p-nil text-center pe-5 fom1 w-30" style="border:0px solid #333;">
                        <span class="img1"></span>
                    </td>
                  </tr>
                  <tr>
                    <td class="p-nil w-25" style="border:0px solid #333; height:12px;">&nbsp;</td>
                    <td style="border:0px solid #333;">
                      <table class="borderless" width="100%" valign="middle">
                        <tr>
                          <td style="width:20%; border:0px solid #333;">
                            <table class="borderless " width="60%" style="position:relative; bottom:0px; left:4px;">
                              <tr>
                                <td style="border:0px solid #333;">
                                  <table class="table-bordered picu">
                                    <tr>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                  </table>
                                </td>
                                <td><label>PICA</label></td>
                              </tr>
                            </table>
                          </td>
                          <td style="width:45%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td style="width:35%; text-align:right; text-align:-webkit-right;">
                            <table class="borderless text-right Bfont" valign="top"
                              style="position:relative; bottom:0px; right:-42px;">
                              <tr>
                                <td>
                                  <span class="text-dark-xx">CMS1500 Page {{$ff}} of {{count($existing_array)}}</span>
                                </td>
                                <td> <label>PICA</label></td>
                                <td>
                                  <table class="table-bordered picu">
                                    <tr>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td rowspan="6" class="noBleft noBtop noBbottom w-30">&nbsp;</td>
              <td colspan="2" class="p-0 border-2top">
                <table class="borderless" width="100%">
                  <tr>
                    <td class="label2"><b>1.</b> MEDICARE</td>
                    <td>MEDICAID</td>
                    <td>TRICARE</td>
                    <td>CHAMPVA</td>
                    <td>GROUP HEALTH PLAN</td>
                    <td>FECA BLACKLUNG</td>
                    <td>OTHER</td>
                  </tr>
                  <tr>
                    <td><span class="red_check">&nbsp;</span> (Medicare#)</td>
                    <td><span class="red_check">&nbsp;</span> (Medicaid#)</td>
                    <td><span class="red_check">&nbsp;</span> (ID#/DoD#)</td>
                    <td><span class="red_check">&nbsp;</span> (Member ID#)</td>
                    <td><span class="red_check">&nbsp;</span> (ID#)</td>
                    <td><span class="red_check">&nbsp;</span> (ID#)</td>
                    <td><span class="red_check">X</span> (ID#)</td>
                  </tr>
                </table>
              </td>
              <td width="33%" class="border-2top">
                <table class="borderless Bfont" width="100%" valign="top">
                  <tr>
                    <td><b>1.a</b> INSURED'S I.D. NUMBER</td>
                    <td>(For Program in item 1)</td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx">{{ ($injuryBillInfo->getInjury->patient->ssn_no) ?
                      $injuryBillInfo->getInjury->patient->ssn_no : '999-99-9999' }}</td>
                    <td class="text-dark"></td>
                  </tr>
                </table>
              </td>
              <td rowspan="6" class="noBright border-1bottom fom2 w-30 ">
                  <span class="img2"></span>
              </td>
            </tr>
            <tr>
              <td width="32%">
                <table class="borderless Bfont" width="100%" valign="top">
                  <tr>
                    <td class="pt-1 fontxxx"><label><b>2.</b> PATIENT'S NAME(Last Name, First Name, Middle Initial)</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx pt-1">
                      {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ?
                      $injuryBillInfo->getInjury->patient->last_name : '' }},
                      {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ?
                      $injuryBillInfo->getInjury->patient->first_name : '' }}
                      {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->mi)? ', ' .
                      $injuryBillInfo->getInjury->patient->mi : '' }}

                    </td>
                  </tr>
                </table>
              </td>
              <td width="22%">
                <table class="borderless " width="100%" valign="top">
                  <tr>
                    <td class="fontxxx"><span><b>3.</b> PATIENT'S BIRTH DATE</span></td>
                    <td class="fontxxx"><span>SEX</span></td>
                  </tr>
                  <tr>
                    <td class="p-nil">
                      <table width="100%" class="borderright Bfont">
                        <tr>
                          <td><span>MM</span></td>
                          <td><span>DD</span></td>
                          <td><span>YY</span></td>
                        </tr>
                        <tr>
                          <td class="text-dark">04</td>
                          <td class="text-dark">01</td>
                          <td class="text-dark">24</td>
                        </tr>
                      </table>
                    </td>
                    <td>
                      <table width="100%" class="Bfont">
                        <tr>
                          <td><label for="male">M</label><span class="red_check">{{ ($injuryBillInfo->getInjury &&
                              $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->gender &&
                              $injuryBillInfo->getInjury->patient->gender == 'Male') ? 'X' : '' }}</span></label>
                          </td>
                          <td><label for="female">F</label><span class="red_check">{{ ($injuryBillInfo->getInjury &&
                              $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->gender &&
                              $injuryBillInfo->getInjury->patient->gender == 'Female') ? 'X' : ''
                              }}&nbsp;</span></label></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
              <td width="42%">
                <table class="borderless Bfont" width="100%" valign="top">
                  <tr>
                    <td class="fontxxx"><label><b>4.</b> INSURED'S NAME(Last Name, First Name, Middle Initial)</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim
                      && $injuryBillInfo->getInjury->getInjuryClaim->employer_name) ?
                      $injuryBillInfo->getInjury->getInjuryClaim->employer_name : '' }}

                    </td>
                  </tr>
                </table>
              </td>

            </tr>
            <tr>
              <td width="32%">
                <table class="borderless Bfont" width="100%" valign="top">
                  <tr>
                    <td class="fontxxx"><label><b>5.</b> PATIENT'S ADDRESS (NO.,Street)</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx">
                        {{ ($injuryBillInfo->getInjury->patient->address_line2) ? ", ".$injuryBillInfo->getInjury->patient->address_line2 : ''}}
                        {{ ($injuryBillInfo->getInjury->patient->address_line1) ? $injuryBillInfo->getInjury->patient->address_line1 : ''}}
                       
                      </td>
                  </tr>
                </table>
              </td>
              <td width="22%">
                <table class="borderless Bfont" width="100%">
                  <tr>
                    <td class="fontxxx"><label><b>6.</b> PATIENT RELATIONSHIP TO INSURED</label></td>
                  </tr>
                  <tr>
                    <td>
                      <table width="100%" class="Bfont">
                        <tr>
                          <td><label>Self</label><span class="red_check">&nbsp;</span></td>
                          <td><label>Spouse</label><span class="red_check">&nbsp;</span></td>
                          <td><label>Child</label><span class="red_check">&nbsp;</span></td>
                          <td><label>Other</label><span class="red_check">X</span></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
              <td width="42%">
                <table class="borderless Bfont" width="100%">
                  <tr>
                    <td class="fontxxx"><label><b>7.</b> INSURED'S ADDRESS (NO.,Street)</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx">
                        {{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim  && $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line1) ? $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line1 : '' }}
                            {{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line2) ? ','.$injuryBillInfo->getInjury->getInjuryClaim->emp_address_line2 : '' }}
                            
                     </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="32%" class="p-nil">
                <table class="borderRgt Bfont" width="100%" valign="top">
                  <tr>
                    <td colspan="2" class="p-0 fontxxx"><label> CITY</label></td>
                    <td width="30%" class="p-0 fontxxx"><label> STATE</label></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-dark-xx p-0">{{$injuryBillInfo->getInjury->patient->city_id }}</td>
                    <td class="text-dark-xx p-0"> {{($injuryBillInfo->getInjury->patient->state_id) ? substr($injuryBillInfo->getInjury->patient->state_id, 0, -8)  : '' }}
                    </td>
                  </tr>
                  <tr class="border-top">
                    <td class="fontxxx"><label> ZIPCODE</label></td>
                    <td colspan="2" class="fontxxx"><label> TELEPHONE(Include Area Code)</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx p-0">
                        {{ ($injuryBillInfo->getInjury->patient &&
                      $injuryBillInfo->getInjury->patient->zipcode) ? $injuryBillInfo->getInjury->patient->zipcode : '' }}</td>
                    <td class="text-dark-xx p-0" colspan="2">{{ ($injuryBillInfo->getInjury->patient->landline_no) ? ", ".$injuryBillInfo->getInjury->patient->landline_no : ''}}</td>
                  </tr>
                </table>
              </td>
              <td width="22%" valign="top">
                <table class="borderless Bfont" width="100%">
                  <tr>
                    <td class="fontxxx"><label><b>8.</b> RESERVED FOR NUCC USE</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx"></td>
                  </tr>
                </table>
              </td>
              <td width="42%" class="p-nil">
                <table class="borderRgt Bfont" width="100%" valign="top">
                  <tr>
                    <td colspan="2" class="p-0 fontxxx"><label> CITY</label></td>
                    <td width="30%" class="p-0 fontxxx"><label> STATE</label></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-dark-xx p-0">{{($injuryBillInfo->getInjury &&
                      $injuryBillInfo->getInjury->getInjuryClaim &&
                      $injuryBillInfo->getInjury->getInjuryClaim->emp_city_id) ?
                      $injuryBillInfo->getInjury->getInjuryClaim->emp_city_id : '' }}</td>
                    <td class="text-dark-xx p-0">{{($injuryBillInfo->getInjury &&
                      $injuryBillInfo->getInjury->getInjuryClaim &&
                      $injuryBillInfo->getInjury->getInjuryClaim->emp_state_id) ?
                      substr($injuryBillInfo->getInjury->getInjuryClaim->emp_state_id, 0, -8)  : '' }}</td>
                  </tr>
                  <tr class="border-top">
                    <td class="fontxxx"><label> ZIPCODE</label></td>
                    <td colspan="2" class="fontxxx"><label> TELEPHONE(Include Area Code)</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->emp_zipcode) ? $injuryBillInfo->getInjury->getInjuryClaim->emp_zipcode : '' }}</td>
                    <td class="text-dark-xx" colspan="2">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->emp_telephone) ? $injuryBillInfo->getInjury->getInjuryClaim->emp_telephone : '' }}</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td width="32%" class="p-nil">
                <table class="borderless tpBm Bfont" width="100%">
                  <tr>
                    <td class="pt-3 fontxxx"><label><b>9.</b> OTHER INSURED'S NAME(Last Name, First Name, Middle
                        Initial)</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark pb-1 pt-3">&nbsp;</td>
                  </tr>
                  <tr class="border-top ">
                    <td class="pt-3 fontxxx"><label><b>a.</b> OTHER INSURED'S POLICY OR GROUP NUMBER</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark pb-1">&nbsp;</td>
                  </tr>
                  <tr class="border-top">
                    <td class="pt-3 fontxxx"><label><b>b.</b> RESERVED FOR NUCC USE</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark pb-1">&nbsp; </td>
                  </tr>
                  <tr class="border-top">
                    <td class="pt-3 fontxxx"><label><b>c.</b> RESERVED FOR NUCC USE</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark pb-1">&nbsp; </td>
                  </tr>
                  <tr class="border-top">
                    <td class="pt-3 fontxxx"><label><b>d.</b> INSURANCE PLAN NAME OR PROGRAM NAME</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark pb-1">&nbsp;</td>
                  </tr>
                </table>
              </td>
              <td width="22%" class="p-nil">
                <table class="borderless tpBm Bfont" width="100%">
                  <tr>
                    <td colspan="3" class="pt-3 fontxxx"><label><b>10.</b> IS PATIENT'S CONDITION RELATED TO:</label></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="text-dark pb-1">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="fontxxx"><label><b>a.</b> EMPLOYMENT?(Current or Previous)</label></td>
                  </tr>
                  <tr>
                    <td class="text-right pb-1s"><span class="red_check">{{($injuryBillInfo->getInjury &&
                        $injuryBillInfo->getInjury->financial_class == '1')? 'X' : ''}} </span><label>YES</label></td>
                    <td class="text-center pb-1s"><span class="red_check">&nbsp;</span><label>NO</label></td>
                    <td class="text-center pb-1s">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-left"><label><b>b.</b> AUTO ACCIDENT?</label></td>
                    <td class="center"><label>PLACE (State)</label></td>
                  </tr>
                  <tr class="pb-1">
                    <td class="text-right pb-1s"><span class="red_check">{{($injuryBillInfo->getInjury &&
                        $injuryBillInfo->getInjury->financial_class == '3')? 'X' : ''}}</span><label>YES</label></td>
                    <td class="text-center pb-1s"><span class="red_check">&nbsp;</span><label>NO</label></td>
                    <td class="text-left pb-1s"><span class="half-box"></span></td>
                  </tr>
                  <tr>
                    <td colspan="3"><label><b>c.</b> OTHER ACCIDENT?</label></td>
                  </tr>
                  <tr>
                    <td class="text-right pb-1s"><span class="red_check">{{($injuryBillInfo->getInjury &&
                        $injuryBillInfo->getInjury->financial_class == '2')? 'X' : ''}}</span><label>YES</label></td>
                    <td class="text-center pb-1s"><span class="red_check">&nbsp;</span><label>NO</label></td>
                    <td class="text-center pb-1s">&nbsp;</td>
                  </tr>
                  <tr class="border-top">
                    <td colspan="3" class="pt-3"><label><b>10d.</b> CLAIM CODES (Designated by NUCC)</label></td>
                  </tr>
                </table>
              </td>
              <td width="42%" class="p-nil">
                <table class="borderless tpBm Bfont" width="100%">
                  <tr>
                    <td colspan="2" class="pt-3 fontxxx"><label><b>11.</b> INSURED'S POLICY GROUP OR FECA NUMBER</label></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-dark text-left">&nbsp;
                        @if($injuryBillInfo->getSendBillDate && $injuryBillInfo->getSendBillDate->bill_type && $injuryBillInfo->getSendBillDate->bill_type == 1)
                            {{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->claim_no) ? $injuryBillInfo->getInjury->claim_no : 'Unknown'}}
                        @endif
                    </td>
                  </tr>
                  <tr class="border-top">
                    <td colspan="2" class="p-nil pt-3">
                      <table class="borderless " width="100%" valign="top">
                        <tr>
                          <td class="fontxxx"><label><b>a.</b> INSURED'S DATE OF BIRTH</label></td>
                          <td><label>SEX</label></td>
                        </tr>
                        <tr>
                          <td class="p-nil">
                            <table width="100%" class="borderright Bfont">
                              <tr>
                                <td><span>MM</span></td>
                                <td><span>DD</span></td>
                                <td><span>YY</span></td>
                              </tr>
                              <tr>
                                <td class="text-dark">&nbsp;</td>
                                <td class="text-dark">&nbsp;</td>
                                <td class="text-dark">&nbsp;</td>
                              </tr>
                            </table>
                          </td>
                          <td>
                            <table width="100%">
                              <tr>
                                <td><span>M</span><span class="red_check">&nbsp;</span></td>
                                <td><span>F</span><span class="red_check">&nbsp;</span></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr class="border-top ">
                    <td colspan="2" class="pt-3 class="fontxxx""><span><b>b.</b> OTHER CLAIM ID (Designated by NUCC)</span></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-dark p-nil">
                      <table class="borderless Bfont" width="100%" valign="top">
                        <tr>
                          <td class="p-nil">
                            <table width="100%" class="borderright">
                              <tr>
                                <td width="30%" class="text-dark-xx">
                                  {{$injuryBillInfo->getInjury->getInjuryClaim->claim_no }}</td>
                                <td class="text-dark-xx">Value</td>

                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                  <tr class="border-top">
                    <td colspan="2" class="pt-3"><label><b>c.</b> INSURANCE PLAN NAME OR PROGRAM NAME</label></td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-dark-xx pt-3">Value</td>
                  </tr>

                  <tr class="border-top">
                    <td colspan="2" class="p-nil pt-3">
                      <table class="borderless " width="100%" valign="top">
                        <tr>
                          <td colspan="2"><label><b>d.</b> IS THERE ANOTHER HEALTH BENIFIT PLAN?</label></td>
                        </tr>
                        <tr>
                          <td>
                            <table width="100%">
                              <tr>
                                <td><span class="red_check">X</span><label>Yes</label></td>
                                <td><span class="red_check">&nbsp;</span><label>No</label></td>
                              </tr>
                            </table>
                          </td>
                          <td class="p-nil" style="position:relative; top:5px;">
                            <b>If yes,</b> complete items 9,9a, and 9d.
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <table class="borderless Bfont" width="100%">
                  <tr>
                    <td class="text-center" colspan="2"><label><b> READ BACK OF FORM BEFORE COMPLETEING & SIGNING THIS
                          FORM</b></label></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="line-height:7px; padding-bottom:5px;  font-size:0.55rem"><label><b>12.</b> PATIENT'S OR AUTHORIZED PERSON'S SIGNATURE <small>I authorize the
                          release of any medical or other information necessary to process this claim. I also request
                          payment of government benifits either to myself or to government benifits either to myself or
                          to the party who accepts assignment below.</small></label></td>
                  </tr>
                  <tr>
                    <td class="p-0 pb-0"><label class="w10 red ps-10" style="width:16%">SIGNED</label> 
                    <span class="custom_value w70 ps-10  text-dark-xx" >SIGNATURE ON FILE</span></td>
                    <td class="p-0 pb-0 text-right"><label class="w20 red">DATE1</label> 
                    <span class="custom_value w70 text-left ps-10  text-dark-xx">{{($injuryBillInfo->getSendBillDate && $injuryBillInfo->getSendBillDate->sent_date && $injuryBillInfo->getSendBillDate->sent_date != '1970-01-01') ? date('m/d/Y', strtotime($injuryBillInfo->getSendBillDate->sent_date)) : '' }} </span></td>
                  </tr>
                </table>
              </td>
              <td>
                <table class="borderless Bfont" width="100%">
                  <tr>
                    <td style="line-height:7px; padding-top:5px; font-size:0.55rem"><label><b>13.</b> INSURED'S OR AUTHORIZED PERSON'S SIGNATURE <small> I authorize payment of
                          medical benifits to the undersigned physician or supplier for service described
                          below.</small></label></td>
                  </tr>
                  <tr>
                    <td class="p-0 pb-0 pos-12 text-right">
                    <span class="signPOS"><label class="w10 red text-right" style="width:16%">SIGNED</label>
                      <span class="custom_value w85  text-dark-xx">&nbsp;</span></span></td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
               <td class="noBleft noBtop noBbottom">&nbsp;</td> 
               <td width="24%" class="p-nil">
                  <table class="borderless tpBm" width="100%">
                    <tr class="border-top">
                    <td width="100%" class="text-left solid"><span><b>14.</b>DATE OF CURRENT ILLNESS, INJURY,or PREGNANCY (LMP)</span></td>
                  </tr>
                  <tr>
                    <td class="text-dark text-left solid p-nil">
                      <table class="borderless Bfont" width="100%" valign="top">
                        <tbody>
                          <tr>
                            <td class="p-nil">
                              <table width="100%" class="borderright p-nil">
                                <tbody>
                                  <tr class="p-nil">
                                    <td>
                                      <span>MM</span>
                                    </td>
                                    <td>
                                      <span>DD</span>
                                    </td>
                                    <td>
                                      <span>YY</span>
                                    </td>
                                  </tr>
                                  @php
                                  if($injuryBillInfo->getInjury->getInjuryClaim->start_date){
                                        $bInjuryMM = date('m', strtotime($injuryBillInfo->getInjury->getInjuryClaim->start_date));
                                        $bInjuryDD = date('d', strtotime($injuryBillInfo->getInjury->getInjuryClaim->start_date));
                                        $bInjuryYYS =  date('y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->start_date));
                                }
                                  @endphp
                                  <tr class="p-nil">
                                    <td class="text-dark-xx">{{$bInjuryMM}}</td>
                                    <td class="text-dark-xx">{{$bInjuryDD}}</td>
                                    <td class="text-dark-xx">{{$bInjuryYYS}}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                            <td>
                              <table width="100%" class="rightdashedborder p-nil">
                                <tbody>
                                  <tr class="p-nil">
                                    <td width="25%" class="dashed">QUAL.</td>
                                    <td class="text-dark noborder">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                   
                  </tr>
                  </table>
                   </td>
                <td width="28%" class="p-nil">
                    <table class="borderless tpBm" width="100%">
                         <tr>
                             <td width="100%" class="text-left solid noborder"><span><b>15. </b>OTHER DATE</span></td>
                         </tr>
                         <tr>
                              <td class="text-dark text-left noborder p-nil">
                      <table class="borderless " width="100%" valign="top">
                        <tbody>
                          <tr>
                            <td class="p-nil">
                              <table width="100%" class="rightdashedborder p-nil">
                                <tbody>
                                  <tr>
                                    <td width="25%" class="dashed">QUAL.</td>
                                    <td class="text-dark-xx dashed">&nbsp;</td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                            <td class="p-nil">
                              <table width="100%" class="borderright p-nil Bfont">
                                <tbody>
                                  <tr>
                                    <td>
                                      <label>MM</label>
                                    </td>
                                    <td>
                                      <label>DD</label>
                                    </td>
                                    <td>
                                      <label>YY</label>
                                    </td>
                                  </tr>
                                  <tr class="p-nil">
                                    <td class="text-dark-xx"> </td>
                                    <td class="text-dark-xx"> </td>
                                    <td class="text-dark-xx"> </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                         </tr>
                         </table>
                    </td>
                <td width="42%" class="p-nil ">
                   <table class="borderless tpBm" width="100%">
                    <tr class="border-top">
                      <td class="pt-3"><span><b>16.</b> DATES PATIENT UNABLE TO WORK IN CURRENT OCCUPATION</span></td>
                    </tr>
                    <tr>
                      <td class="text-dark p-nil pt-3">
                        <table class="rightdashedborder" width="100%">
                          <tr>
                            <td class="p-nil"></td>
                            <td class="p-nil">MM</td>
                            <td class="p-nil">DD</td>
                            <td class="p-nil">YY</td>
                            <td class="p-nil"></td>
                            <td class="p-nil">MM</td>
                            <td class="p-nil">DD</td>
                            <td class="p-nil">YY</td>
                          </tr>
                          <tr>
                            <td class="text-dark p-0 dashed"><label><b>FROM</b></label></td>
                            <td class="text-dark p-0 dashed">&nbsp;</td>
                            <td class="text-dark p-0 dashed">&nbsp;</td>
                            <td class="text-dark p-0 noborder">&nbsp;</td>
                            <td class="text-dark p-0 dashed"><label><b>TO</b></label></td>
                            <td class="text-dark p-0 dashed">&nbsp;</td>
                            <td class="text-dark p-0 dashed">&nbsp;</td>
                            <td class="text-dark p-0 noborder">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                 </table>
                </td>
                <td rowspan="5" class="noBtop noBbottom fom3">
                  <span class="img3"></span>
              </td>
            </tr>
            <tr>
                <td class="noBleft noBtop noBbottom">&nbsp;</td>
                <td width="24%" class="p-nil">
                   <label>
                        <b>17.</b> NAME OF REFERRING PROVIDER OR OTHER SOURCE
                      </label>    
                </td>
                <td width="28%" class="p-nil border-top">
                  <table class="rightdashedborder p-nil border-top" width="100%" valign="top">
                        <tr class="bgpink ">
                          <td class="solid" width="15%">
                            <label>17.a</label>
                          </td>
                          <td class="text-dark solid"  width="15%"></td>
                          <td class="text-dark noborder text-left"  width="70%">&nbsp;</td>
                        </tr>
                        <tr>
                          <td class="solid">
                            <label>17.b</label>
                          </td>
                          <td class="solid border-top-dashed">
                            <label>NPI</label>
                          </td>
                          <td class="text-dark noborder border-top-dashed text-left">&nbsp;</td>
                        </tr>
                      </table>    
                </td>
                <td width="42%" class="p-nil">
                <table class="borderless tpBm" width="100%">
                  <tbody>
                    <tr>
                      <td class="pt-3"><label><b>18.</b> HOSPITALIZATION DATES RELATED TO CURRENT SERVICES</label></td>
                    </tr>
                    <tr>
                      <td class="text-dark p-nil pt-3">
                        <table class="rightdashedborder" width="100%">
                          <tr>
                            <td class="p-nil"></td>
                            <td class="p-nil">MM</td>
                            <td class="p-nil">DD</td>
                            <td class="p-nil">YY</td>
                            <td class="p-nil"></td>
                            <td class="p-nil">MM</td>
                            <td class="p-nil">DD</td>
                            <td class="p-nil">YY</td>
                          </tr>
                          <tr>
                            <td class="text-dark p-0 dashed"><label><b>FROM</b></label></td>
                            <td class="text-dark p-0 dashed">&nbsp;</td>
                            <td class="text-dark p-0 dashed">&nbsp;</td>
                            <td class="text-dark p-0 noborder">&nbsp;</td>
                            <td class="text-dark p-0 dashed"><label><b>TO</b></label></td>
                            <td class="text-dark p-0 dashed">&nbsp;</td>
                            <td class="text-dark p-0 dashed">&nbsp;</td>
                            <td class="text-dark p-0 noborder">&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>    
                    </tbody>
                    </table>
                </td>
            </tr>
            
            <tr>
                <td class="noBleft noBtop noBbottom">&nbsp;</td>
                 <td colspan="2"  class="p-nil borderless">
                    <table class="borderless Bfont" width="100%">
                    <tr>
                      <td class="pt-3 text-left"><span><b>19.</b> DATES PATIENT UNABLE TO WORK IN CURRENT OCCUPATION</span></td>
                  </tr>
                   <tr>
                    <td class="text-dark text-left">&nbsp;</td>
                  </tr>
                  </table> 
                </td>
                 <td width="42%" class="p-nil">
                        <table class="rightdashedborder borderless tpBm" width="100%" valign="top">
                            <tr  class="p-nil">
                              <td class="text-left"><span><b>20.</b> OUTSIDE LAB?</span></td>
                              <td class="text-center noborder" colspan="2"><span>$CHARGES</span></td>
                            </tr>
                            <tr  class="p-nil">
                              <td width="33%" class="solid">
                                  <table width="100%">
                              <tr>
                                <td><span class="red_check">&nbsp;</span><span>Yes</span></td>
                                <td><span class="red_check">&nbsp;</span><span>No</span></td>
                              </tr>
                            </table>
                              </td>
                              <td class="p-nil text-dark solid" width="33%">
                                &nbsp;
                              </td>
                              <td class="p-nil text-dark noborder" width="33%">
                                &nbsp;
                              </td>
                            </tr>
                        </table>
                </td>
            </tr>
            
            <tr>
              <td class="noBleft noBtop noBbottom">&nbsp;</td>
              <td  colspan="2" class="p-nil solid">
                <table class="rightdashedborder Bfont" width="100%">
               
                  <tr>
                    <td colspan="2" class="text-left noborder p-nil">
                      <table class="rightdashedborder" width="100%" valign="top">
                        <td class="text-left noborder">
                          <label><b>21.</b> DIAGNOSIS OR NATURE OF ILLNESS OR INJURY Relate A-L to service line below(24E) </label>
                        </td>
                        <td class="text-left noborder p-nil">
                            @php $digType = ''; $newArray = array();  $dcArray = array();  $finalArray  = array();
                            foreach ($injuryBillInfo->getBillDiagnosis as $code) {
                            //dd($code);
                            $digType = ($code->getBillDiagnosisName && $code->getBillDiagnosisName->code_type != null) ? $code->getBillDiagnosisName->code_type : 10;
                                $dcArray[]  = [ 'id' => $code->diagnose_code_id, 'dc' => $code->getBillDiagnosisName->diagnosis_code];
                            }
                            $finalArray  = $dcArray;
                            //print_r($finalArray);exit;
                            @endphp
                          <table class="rightdashedborder p-nil" width="100%" valign="top">
                            <tr>
                              <td width="50%" class="dashed">
                                <label>ICD Ind.</label>
                              </td>
                              <td class="text-dark-xx dashed">{{$digType}}</td>
                              <td width="40%" class="text-dark noborder">&nbsp;</td>
                            </tr>
                          </table>
                        </td>
                      </table>
                    </td>
                  </tr>
                  
                  <tr class="border-top">
                  @inject('patientClass', 'App\Http\Controllers\PatientController')

                    <td colspan="2" class="text-dark text-left noborder p-0">
                      <table class="rightdashedborder p-0" width="100%" valign="top">
                        <td class="text-left noborder">
                          <table class="rightdashedborder p-nil p-0" width="100%" valign="top">  
                               <tr>
                                    @php $character = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l']; @endphp
                                    @for ($i = 0; $i < 4; $i++)
                                        <td class="noborder p-0 text-left">
                                            @foreach ($character as $key => $char)
                                                @if ($key % 4 == $i)
                                                    <table class="rightdashedborder p-nil text-left v1" width="100%" valign="top">
                                                        <tr>
                                                            <td width="100%" class="noborder p-0 text-left">
                                                                <label>{{ strtoupper($char) }}.</label>
                                                                <span class="custom_value2 w70 text-left text-dark-xx">
                                                                    @if (isset($finalArray[$key]) && is_array($finalArray[$key]))
                                                                        @if (array_key_exists('dc', $finalArray[$key]))
                                                                            {{ $finalArray[$key]['dc'] }}
                                                                        @else
                                                                             
                                                                        @endif
                                                                    @else 
                                                                    @endif
                                                                </span>
                                                            </td>
                                                        </tr>  
                                                    </table>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endfor
                                </tr>
                          </table>
                        </td>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
              <td class="p-nil" width="42%">
                <table class="borderless tpBm" width="100%">
                  <tbody>
                    <tr>
                      <td colspan="2" class="p-nil pt-3">
                        <table class="rightdashedborder " width="100%" valign="top">
                          <tbody>
                            <tr>
                              <td class="text-left"><label><b>22.</b> RESUBMISSION</label></td>
                            </tr>
                            <tr>
                              <td class="p-0">
                                <table width="100%" class="borderright">
                                  <tbody>
                                    <tr>
                                      <td class="solid noborder text-left" width="90px"><label>CODE</label></td>
                                      <td class="noborder text-left"><label>&nbsp;&nbsp;ORIGINAL REF. NO.</label></td>
                                    </tr>
                                    <tr>
                                      <td class="text-dark solid">&nbsp;</td>
                                      <td class="text-dark noborder">&nbsp;</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>

                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr class="border-top">
                      <td colspan="2" class="pt-3"><label><b>23.</b> PRIOR AUTHORIZATION NUMBER</label></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="text-dark">{{ ($injuryBillInfo->bill_authorization_number) ? $injuryBillInfo->bill_authorization_number : ''}}</td>
                    </tr>

                  </tbody>
                </table>
              </td>
            </tr>
            
            <tr>
              <td class="noBleft noBtop noBbottom pt-66 p-nil">
                <table class="rightdashedborder" width="100%" valign="top">
                  <tr>
                    <td class="text-right font-4 noborder"><label><b>1</b></label></td>
                  </tr>
                  <tr>
                    <td class="text-right font-4 noborder"><label><b>2</b></label></td>
                  </tr>
                  <tr>
                    <td class="text-right font-4 noborder"><label><b>3</b></label></td>
                  </tr>
                  <tr>
                    <td class="text-right font-4 noborder"><label><b>4</b></label></td>
                  </tr>
                  <tr>
                    <td class="text-right font-4 noborder"><label><b>5</b></label></td>
                  </tr>
                  <tr>
                    <td class="text-right font-4 noborder"><label><b>6</b></label></td>
                  </tr>
                </table>
              </td>
              <td class="p-nil" colspan="3">
                 
         <table class="rightdashedborder valTab Bfont" width="100%" valign="top">
         <!--valTab row start here-->
            <tr class="p-nil tabBox">
              <td colspan="6" class="text-left solid"><span style="margin-left:5px"><b>&nbsp; 24.</b> <b>A.</b> DATE(S) OF SERVICE</span></td>
              <td rowspan="3" class="text-center solid solid-right" width="40px"><span><b class="block">B.</b> PLACE OF SERVICE</span></td>
              <td rowspan="3" class="text-center solid" width="40px"><span><b class="block">C.</b> AMG</span></td>
              <td colspan="6" class="text-left solid"><span><b>&nbsp; D.</b> PROCEDURES, SERVICES, OR SUPPLIES</span></td>
              <td colspan="2" rowspan="3" class="text-center solid solid-right" width="47px"><span><b class="block">E.</b> DIAGNOSIS POINTER</span></td>
              <td colspan="3" rowspan="3" class="text-center solid p-1 h-66" width="62px"><span><b class="block">F.</b> $ CHARGES</span></td>
              <td rowspan="3" class="text-center solid p-1 h-66" width="43px"><span><b class="block">G.</b> <small>DAYS OR UNITS</small></span></td>
              <td rowspan="3" class="text-center solid p-1 h-66" width="43px"><span><b class="block">H.</b><small> EPSDT Family Plan</small></span></td>
              <td rowspan="3" class="text-center solid p-1 h-66"  width="28px"><span><b class="block">I.</b><small> ID<br> QUAL.</small></span></td>
              <td rowspan="3" colspan="3" class="text-center solid noborder p-1 h-66" width="50px"><span><b class="block">J.</b>RENDERING PROVIDER ID.#</span></td>
            </tr>
            <tr class="p-nil tabBox">
              <td class="text-center noborder p-nil" colspan="3"><span><small>From</small></span></td>
              <td class="text-center noborder p-nil" colspan="3"><span><small>To</small></span></td>
              <td class="text-center solid p-0 " colspan="6"><span><small>(Explain Unusual Circumstances)</small></span></td>
            </tr>
            <tr class="p-nil tabBox">
              <td class="text-dark-xx noborder">MM</td>
              <td class="text-dark-xx noborder">DD</td>
              <td class="text-dark-xx noborder">YY</td>
              <td class="text-dark-xx noborder">MM</td>
              <td class="text-dark-xx noborder">DD</td>
              <td class="text-dark-xx noborder">YY</td>
              <td class="text-center solid p-0" colspan="2"><span>CPT/HCPCS</span></td>
              <td class="text-center solid p-0" colspan="4"><span>MODIFIER</span></td>
            </tr>
             <!--valTab row start here-->
           @php $maxRow = 6; $leftTd = 0; @endphp
            @if(count($new_array) > 0)
            @php  $leftTd = count($new_array) < 6 ? $maxRow - count($new_array) : 0;
            
            @endphp
            @for ($j = 0; $j < count($new_array); $j++)
            @php //$totalCharge += $new_array[$j]['total_bill_amount']; 
            $alphabet = array(); 
            $dcodes = "";
            $serDCNT= array();
            
            //$diagnosisCodeNumbers = implode(',',$alphabet);
             @endphp 
                    <!--Value feed row start here-->
                        <tr class="p-nil bgpink border-top">
                          <td class="text-dark-xx noborder">{{ $inj_mm }}</td>
                          <td class="text-dark noborder"></td>
                          <td class="text-dark solid"></td>
                          <td class="text-dark noborder"></td>
                          <td class="text-dark noborder"></td>
                          <td class="text-dark solid"></td>
                          <td class="text-dark solid"></td>
                          <td class="text-dark solid"></td>
                          
                          <td class="text-dark noborder"></td>
                          <td class="text-dark noborder"></td>
                          <td class="text-dark noborder"></td>
                          <td class="text-dark noborder"></td>
                          <td class="text-dark noborder"></td>
                          <td class="text-dark solid"></td>
                          <td colspan="2" class="text-dark solid">&nbsp;</td>
                          <td colspan="3" class="text-dark solid"></td>
                          <td class="text-dark solid"></td>
                          <td class="text-dark solid"></td>
                          <td class="text-dark-xx solid">ZZ</td>
                          <td colspan="3" class="text-dark-xx noborder border-top-dashed text-left">
                                {{($injuryBillInfo->getRenderinProvider && $injuryBillInfo->getRenderinProvider->taxonomyCode && $injuryBillInfo->getRenderinProvider->taxonomyCode->taxonomy_code) ? $injuryBillInfo->getRenderinProvider->taxonomyCode->taxonomy_code : '1215628623'}}
                            </td> 
                        </tr>
                        <tr class="text-dark-xx p-nil">
                            @php 
                            $bAmt1=0; $bAmt2=0;
                            if($new_array[$j]['total_bill_amount']){
                            list($bAmt1, $bAmt2) = explode('.', $new_array[$j]['total_bill_amount']);
                            }
                            if($injuryBillInfo->dos){
                                $bDOSMM = date('m', strtotime($injuryBillInfo->dos));
                                $bDOSDD = date('d', strtotime($injuryBillInfo->dos));
                                $bDOSYYS =  date('y', strtotime($injuryBillInfo->dos));
                            }
                            if($injuryBillInfo->dos_end){
                                $bEDOSMM = date('m', strtotime($injuryBillInfo->dos_end));
                                $bEDOSDD = date('d', strtotime($injuryBillInfo->dos_end));
                                $bEDOSYYS =  date('y', strtotime($injuryBillInfo->dos_end));
                            }
                            @endphp
                          <td class="text-dark-xx">{{ $bDOSMM }}</td>
                          <td class="text-dark-xx">{{ $bDOSDD }}</td>
                          <td class="text-dark-xx solid">{{ $bDOSYYS }}</td>
                          <td class="text-dark-xx">{{ $bEDOSMM }}</td>
                          <td class="text-dark-xx">{{ $bEDOSDD }}</td>
                          <td class="text-dark-xx solid">{{ $bEDOSYYS }}</td>
                          <td class="text-dark-xx solid">{{ ($injuryBillInfo->getBillPlaceOfService &&
                            $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode) ?
                            $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->service_code : 'code' }}</td>
                          <td class="text-dark-xx solid">&nbsp;</td>
                          <td class="text-dark-xx solid" colspan="2">
                              {{ ($new_array[$j] && $new_array[$j]['bill_procedure_code'] != null ) ? $new_array[$j]['bill_procedure_code'] : 'NA' }}
                          </td>
                          <td class="text-dark-xx">&nbsp;</td>
                          <td class="text-dark-xx">&nbsp;</td>
                          <td class="text-dark-xx">&nbsp;</td>
                          <td class="text-dark-xx solid">
                                {{($new_array[$j]->getModifierInfo) ? $new_array[$j]->getModifierInfo['name'] : ''}}
                          </td>
                          <td colspan="2" class="text-dark-xx solid"> 
                         <?php 
                         $valArray = array($new_array[$j]['bill_diag_codes1'],$new_array[$j]['bill_diag_codes2'],$new_array[$j]['bill_diag_codes3'], $new_array[$j]['bill_diag_code4']);
                         $dcCodes =  $patientClass->getDignosisCOdeCharacterInBillViewPage($valArray, $finalArray, $character);
                          echo $dcCodes; 
                          
                        //   if($new_array[$j]['bill_diag_codes1'] ){
                        //       if($patientClass->getDignosisCOdeCharacterInBillViewPage($new_array[$j]['bill_diag_codes1'], $finalArray, $character) != null){
                        //        
                         echo $patientClass->getDignosisCOdeCharacterInBillViewPage($new_array[$j]['bill_diag_codes1'], $finalArray, $character);
                         
                        //       }
                        //   }
                        //   if($new_array[$j]['bill_diag_codes2'] ){
                        //       if($patientClass->getDignosisCOdeCharacterInBillViewPage($new_array[$j]['bill_diag_codes2'], $finalArray, $character) != null){
                        //       echo  $patientClass->getDignosisCOdeCharacterInBillViewPage($new_array[$j]['bill_diag_codes2'], $finalArray, $character). ', ';
                        //       }
                        //   }
                        //   if($new_array[$j]['bill_diag_codes3'] ){
                        //       if($patientClass->getDignosisCOdeCharacterInBillViewPage($new_array[$j]['bill_diag_codes3'], $finalArray, $character) != null){
                        //       echo  $patientClass->getDignosisCOdeCharacterInBillViewPage($new_array[$j]['bill_diag_codes3'], $finalArray, $character). ', ';
                        //       }
                        //   }
                        //   if($new_array[$j]['bill_diag_code4'] ){
                        //       if($patientClass->getDignosisCOdeCharacterInBillViewPage($new_array[$j]['bill_diag_code4'], $finalArray, $character) != null){
                        //       echo  $patientClass->getDignosisCOdeCharacterInBillViewPage($new_array[$j]['bill_diag_code4'], $finalArray, $character);
                        //       }
                        //   }
                         ?>
                          
                          </td>
                          <td colspan="2" class="text-dark-xx text-right" style="text-align:right; padding-right:2px;">{{$bAmt1}}</td>
                          <td class="text-dark-xx text-left solid" style="padding-left:0px!important;"><span style="position:relative; right:2px; font-size:0.75rem; font-weight:600;"><b>.</b></span>{{$bAmt2}}</td>
                          <td class="text-dark-xx solid">{{($new_array[$j]['bill_units']) ? $new_array[$j]['bill_units'] : ''}}</td>
                          <td class="text-dark-xx solid">004</td>
                          <td class=" solid border-top-dashed"><span>NPI</span></td>
                          <td colspan="3" class="text-dark-xx noborder border-top-dashed text-left">
                          {{($injuryBillInfo->getRenderinProvider && $injuryBillInfo->getRenderinProvider->referring_provider_npi) ? $injuryBillInfo->getRenderinProvider->referring_provider_npi : '1215628623'}}
                          </td> 
                        </tr>
                    <!--Value feed row end here-->  
         @endfor
            @if ($leftTd != 0)
                    @for ($jj = 0; $jj < $leftTd; $jj++)
                         <!--Value feed row start here-->
                         <tr class="p-nil bgpink border-top">
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark noborder">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td colspan="2" class="text-dark solid">&nbsp;</td>
                          <td colspan="3" class="text-dark solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td colspan="3" class="text-dark noborder border-top-dashed">&nbsp;</td>
                        </tr>
                        <tr class="p-nil">
                          <td class="text-dark">&nbsp;</td>
                          <td class="text-dark">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark">&nbsp;</td>
                          <td class="text-dark">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                           <td class="text-dark solid" colspan="2">&nbsp;</td>
                          <td class="text-dark">&nbsp;</td>
                          <td class="text-dark">&nbsp;</td>
                          <td class="text-dark">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td colspan="2" class="text-dark solid">&nbsp;</td>
                          <td colspan="2" class="text-dark ">&nbsp;</td>
                          <td class="text-dark text-center solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class=" solid border-top-dashed"><label>&nbsp;</label></td>
                          <td colspan="3" class="text-dark noborder border-top-dashed text-left">&nbsp;</td>
                          
                        </tr>
                            <!--Value feed row end here-->  
                    @endfor
                    @endIf   
    @endIf
        </table>
         
              </td>
            </tr>
            <tr>
              <td class="noBleft noBright noBtop noBbottom">&nbsp;</td>
              <td colspan="2" class="p-nil">
                <table class="rightdashedborder" width="100%">
                  <tr>
                    <td class="solid p-nil" width="50%">
                      <table class="borderless Bfont" width="100%">
                        <tr>
                          <td class="text-left p-nil">
                          <label><b>&nbsp;25.</b> FEDERAL TAX I.D NUMBER</label></td>
                          <td><label>SSN</label></td>
                          <td><label>EIN</label></td>
                        </tr>
                        <tr>
                          <td class="p-0 ps-10 pt-20 text-dark-xx text-left">{{
                            $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id ?
                            $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id : '' }}</td>
                          <td class="p-0"><span class="red_check">{{ ($injuryBillInfo->getInjury->patient->getBillingProvider->tax_id_type &&  $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id_type == 'SSN') ? "X" : ' ' }}</span></td>
                          <td class="p-0"><span class="red_check">{{ ($injuryBillInfo->getInjury->patient->getBillingProvider->tax_id_type &&  $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id_type == 'EIN') ? "X" : ' ' }}</span></td>
                        </tr>
                      </table>
                    </td>
                    <td class="solid p-nil noborder pt-1" width="50%">
                      <table class="borderless Bfont" width="100%">
                        <tr class="p-nil">
                          <td class="text-left solid p-nil" width="50%"><label><b>&nbsp;26.</b> PATIENT'S ACCOUNT NO.</label></td>
                          <td colspan="2" class="p-nil text-left"><span><b>&nbsp;27.</b> ACCEPT ASSIGNMENT?<br><small style="padding-left:12px; line-height:4px">(For govt. claims, see back)</small></span></td>
                        </tr>
                        <tr class="p-nil">
                          <td class="p-nil ps-10 solid text-dark-xx text-left">
                              @php $accountNumber = ''; $fnAccountNumber = '';
                              if($injuryBillInfo->bill_number != ''){
                              $accountNumber =  $injuryBillInfo->bill_number;
                              $lastDigitId = ($injuryBillInfo->getSendBillDate && $injuryBillInfo->getSendBillDate->bill_type && $injuryBillInfo->getSendBillDate->bill_type == 1) ? 1 : 2;
                               $fnAccountNumber = $accountNumber."-".$lastDigitId;
                               }
                               echo ($fnAccountNumber != '') ? $fnAccountNumber : '477db9122800-1';
                              @endphp 
                            </td>
                          <td class="p-nil"><span class="red_check">&nbsp;</span><span>YES</span></td>
                          <td class="p-nil noborder"><span class="red_check">&nbsp;</span><span>NO</span></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
              <td class="p-nil" width="36%">
                <table class="rightdashedborder valTab Bfont" width="100%" valign="top">
                  <tr class="p-nil">
                    <td class="solid text-left p-0" colspan="3"><label><b>&nbsp;28.</b> TOTAL CHARGE</label></td>
                    <td class="solid text-left p-0" colspan="3"><label><b>&nbsp;29.</b> AMOUNT PAID</label></td>
                    <td class="noborder text-left p-0" colspan="3"><label><b>&nbsp;30.</b> Rsvd for NUCC Use</label></td>
                  </tr>
                  <tr class="p-nil">
                    <td class="text-dark text-left noborder p-nil pt-8"><label>$</label></td>
                    <td class="text-dark-xx text-right p-nil pt-8">
                    @php $tot1 =0; $tot2=0; @endphp
                       @php list($tot1, $tot2) = explode('.',  $totalCharge); 
                       @endphp
                    {{$tot1}}
                    </td>
                    <td class="text-dark-xx solid p-nil text-left pt-8" style="padding-left:0px!important;"><span style="position:relative; right:2px; top:-5px; font-size:0.75rem; font-weight:600;"><b>.</b></span>{{$tot2}}</td>
                    <td class="text-dark-xx text-left p-nil noborder pt-8"><label>&nbsp;$</label></td>
                    <td class="text-dark text-right p-nil pt-8"></td>
                    <td class="text-dark solid  p-nil pt-8 text-left" style="padding-left:0px!important;"><!--<span style="position:relative; right:2px; font-size:0.75rem; font-weight:600;"><b>.</b></span>00--></td>

                    <td class="text-dark text-left noborder p-nil pt-8"><label></label></td>
                    <td class="text-dark text-right p-nil pt-8"></td>
                    <td class="text-dark noborder  p-nil pt-8 text-left" style="padding-left:0px!important;"><!--<span style="position:relative; right:2px; font-size:0.75rem; font-weight:600;"><b>.</b></span>00--></td>
                  </tr>
                </table>
              </td>
              <td class="noBleft noBright noBtop noBbottom">&nbsp;</td>
            </tr>
            
            <tr>
                <td class="noBleft noBright noBtop noBbottom">&nbsp;</td>
                <td colspan="2" class="p-nil pt-0 border-2bottom ">
                <table class="rightdashedborder B-bold" width="100%">
                  <tr>
                    <td class="solid p-nil border-2xbottom" width="55%">
                      <table class="borderless text-left minheight pos-2-old Bfont" width="100%">
                        <tr>
                          <td colspan="2" class="text-left" style="padding-right:25px;"><label style="font-size:0.55rem; line-height:6px; padding-top:3px;"><b>31.</b> SIGNATURE OF PHYSICIAN OR SUPPLIER
                              INCLUDING &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DEGRESS OR CREDENTIALS <small>(I certify that the &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;statements on the reverse apply to this bill and are &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;made a part thereof.)</small></label></td>
                        </tr>
                        <tr>
                          <td colspan="2" class="text-dark2 p-0 text-left">{{
                            ($injuryBillInfo->getBillRenderingOrderingProvider &&
                            $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_first_name) ?
                            $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_first_name : '' }}
                            {{ ($injuryBillInfo->getBillRenderingOrderingProvider &&
                            $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_last_name) ?
                            $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_last_name : '' }}
                            {{ ($injuryBillInfo->getBillRenderingOrderingProvider &&
                            $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_middle_name) ?
                            $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_middle_name : '' }}
                          </td>
                        </tr>
                        <tr>
                          <td class="p-nill text-left"> <label class="custom_value33 text-dark-xx" style="text-transform:capitalize;">Signature On File</label></td>
                          <td class="p-nill text-center text-dark-xx"><label class="custom_value33">{{($injuryBillInfo->getSendBillDate && $injuryBillInfo->getSendBillDate->sent_date && $injuryBillInfo->getSendBillDate->sent_date != '1970-01-01') ? date('m/d/Y', strtotime($injuryBillInfo->getSendBillDate->sent_date)) : '-' }}</label></td>
                        </tr>
                        <tr>
                          <td class="p-nill text-left"><label> SIGNED </label></td>
                          
                          <td class="p-nill text-center"><label>DATE</label></td>
                        </tr>
                      </table>
                    </td>
                    <td class="noborder p-nil" width="45%">
                      <table class="borderless text-left minheight Bfont" width="100%">
                        <tr>
                          <td class="p-0 text-left"><label style="font-size:0.55rem;"><b>&nbsp;32.</b> SERVICE FACILITY LOCATION INFORMATION </label>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-dark2 text-left">{{ $injuryBillInfo->getBillPlaceOfService->nick_name }}</td>
                        </tr>
                        
                         @if($injuryBillInfo->getBillPlaceOfService->address_line1)
                          <tr>
                            <td class="text-dark2 text-left">{{ $injuryBillInfo->getBillPlaceOfService->address_line1 }}</td>
                          </tr>
                          @endif
                          @if($injuryBillInfo->getBillPlaceOfService->address_line2)
                          <tr>
                            <td class="text-dark2 text-left">{{  $injuryBillInfo->getBillPlaceOfService->address_line2 }}</td>
                          </tr>
                           @endif
                   
                        <tr>
                          <td class="text-dark2 text-left">{{ $injuryBillInfo->getBillPlaceOfService->city_id }}
                            <span style="position:relative; right:-50px;">
                              {{ $injuryBillInfo->getBillPlaceOfService->state_id }}
                            </span>
                          </td>
                        </tr>
                         @if($injuryBillInfo->getBillPlaceOfService->address_line2 == null)
                          <tr>
                                <td class="text-dark2 text-left">   &nbsp;  </td>
                        </tr>
                          @endif
                        <tr>
                          <td class="p-nil bottom-table">
                            <table width="100%" class="simpleborder p-0">
                              <tr>
                                <td width="55%" class="text-left p-nil noBbottom">a.<span class="text-npi-bg text-dark-xx" style="text-align:left;">
                                    <span class="bgtxt">NPI</span>
                                     {{$injuryBillInfo->getInjury->patient->getBillingProvider->professional_npi }}
                                     </span>
                                </td>
                                <td class="bgpink noborder text-left noBbottom">b.</td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
                <td class="p-nil border-2bottom" width="42%">
                <table class="borderless minheight Bfont" width="100%">
                  <tr>
                    <td class="p-0"><label style="font-size:0.55rem;"><b>&nbsp;33.</b> BILLING PROVIDER INFO & PH # &nbsp;(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark2">{{
                      $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name ?
                      $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name : '' }}</td>
                  </tr>
                  @if($injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres1)
                  <tr>
                    <td class="text-dark2">{{
                      $injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres1 }}</td>
                  </tr>
                  @endif
                  @if($injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres2)
                  <tr>
                    <td class="text-dark2">{{
                      $injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres2 }}</td>
                  </tr>
                   @endif
                  <tr>
                    <td class="text-dark2">{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_city
                      }}
                      &nbsp;{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_state }}

                      <span style="position:relative; right:-50px;">
                        {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_zip }}
                      </span>
                    </td>
                  </tr>
                  @if($injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres2 == null)
                  <tr>
                    <td class="text-dark2">   &nbsp;  </td>
                  </tr>
                  @endif
                  <tr>
                    <td class="p-nil bottom-table2 noBbottom">
                      <table width="100%" class="simpleborder Bfont noBbottom">
                        <tr>
                          <td width="45%" class="text-left p-nil noBbottom">a.<span class="text-npi-bg text-dark-xx">
                              <span class="bgtxt">NPI</span>
                              {{$injuryBillInfo->getInjury->patient->getBillingProvider->professional_npi}}
                              </span>
                             </td>
                          <td class="bgpink text-left noBbottom">b.</td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
                <td class="noBleft noBright noBtop">&nbsp;</td>
            </tr>
            <tr>
              <td class="noBleft noBright noBbottom">&nbsp;</td>
              <td colspan="3" class="noBleft noBtop noBright noBbottom" style="border:0px;">
                <table class="borderless" width="100%">
                  <tr>
                    <td class="text-left">
                      <span class="bottomtxt">NUCC Instruction Manual available at: www.nucc.org</span>
                    </td>
                    <td>
                      <h4 class="h4">PLEASE PRINT OR TYPE</h4>
                    </td>
                    <td class="text-right">
                      <span class="bottomtxt">APPROVED OMB-0938-1197 form 1500 (02-12)</span>
                    </td>
                 </tr>
                </table>
              </td>
              <td class="noBleft noBright noBbottom">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
        @endfor
      @endif         
  </div>
  <!--Main form section End here-->
</body>
</html>