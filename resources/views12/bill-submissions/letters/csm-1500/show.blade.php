 @extends('layouts.home-app-form')
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"> 
@php
$mm = null;
    $dd = null;
    $yy = null;
    $stateCode = null;
    $inj_mm = null;
    $inj_dd = null;
    $inj_yy = null; 
@endphp
<style>
.page-break {
    page-break-after: always;
}
html {
    height: 100%;
    width: 100% !important;
    background-color: #F3F3F3;
    direction: ltr;
}
body {
    font-family: 'Figtree', sans-serif!important;
    margin: 0;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.45;
    background: var(--mainbg);
}
.mainSec {
    padding: 0 100px;
}
.container, .container-fluid {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    width: 100%;
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
    border-spacing: 2px;
    font-variant: normal;
}
.Letter h5, .Letter b, .Letter .label {
    font-weight: 700!important;
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

.p-2 {
    padding: 1.5rem!important;
}
.row-background {
    border: 1px solid rgba(33,40,50,.125)!important;
    background-color: #fff;
}
#full-view {
    width: 85%;
    margin: 0 auto;
}
*, *:before, *:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
.claimForm {
  color: #e02f37;
  font-family:Helvetica, sans-serif;
  font-weight:300;
   margin:0 auto;
}
table.picu tr td {
  border: 1px solid #e02f37!important;
  width: 15px;
  height:15px;
  padding: 0.3rem;
}
.d-flex{
    display: flex;
    justify-content:center;
    align-items:center;
}
table td {
    font-size: 12px;
    font-weight: 300;
}

table.valTab tr td{
    height:22px;
}
.rowcol {
  display: flex;
  border: 0px solid #333;
  width: 100%;
}
.rowcol label {
  padding: 0;
  color: #e02f37;
  margin-bottom:0rem;
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
  background: #e02f37;
}

.box-left {
  display: flex;
  justify-content: flex-start;
}
.box-right {
  display: flex;
  justify-content: flex-end;
}
table, table td {
  border-collapse: collapse!important;
}
table.redborder {
  width: 100%;
}
.border-2top{border-top:2px solid #e02f37!important}
.border-2bottom{border-bottom:2px solid #e02f37!important}
.border-1top{border-top:1px solid #e02f37!important}
.border-1bottom{border-bottom:1px solid #e02f37!important}

table.redborder tr td {
  border: 1px solid #e02f37;
  padding: 0.2rem;
  vertical-align: top;
}
table.redborder tr td:last-child {
  border-left:1.5px solid #e02f37;
}

table.simpleborder {
  width: 100%;
  border-top: 0px solid #e02f37;
  border-bottom: 0px solid #e02f37;
  border: 1px solid #e02f37!important;
  padding:0px;
}
table.simpleborder tr td {
  border: 1px solid #e02f37!important;
  vertical-align: top;
  padding:0.3rem!important
}
.bgpink{
    background:#fee8dd;
}
.h4{
    color:#e02f37;
    font-style:italic;
    font-weight:700!important;
    line-height:20px;
}
.bottomtxt{
    color:#e02f37;
    font-style:normal;
    font-weight:300!important;
    line-height:16px;
    font-size:14px;
}
.font-4 {
    color: #e02f37;
    font-style: normal;
    font-weight: 500!important;
    line-height: 35px;
    text-align: right!important;
    font-size: 23px;
}
table.borderRgt {
  width: 100%;
  border: 0px solid #e02f37 !important;
}
table.borderRgt tr td {
  border: 0px solid #e02f37;
  padding: 0.1rem;
}
table tr.border-top {
  border-top: 1px solid #e02f37 !important;
  padding-top: 3px;
  padding-bottom: 3px;
}
table .border-top-dashed{
     border-top: 1px dashed #e02f37 !important;
}

table.borderRgt tr td:last-child {
  border-left: 1px solid #e02f37;
}
table.rightdashedborder {
  width: 100%;
  border: 0px dashed #e02f37 !important;
}
table.rightdashedborder tr td {
  border: 0px solid #e02f37;
  border-right:1px dashed #e02f37;
  padding: 0.2rem;
  text-align:center;
}
table.rightdashedborder tr td.solid{
  border-right:1px solid #e02f37;
}
table.rightdashedborder tr td.dashed{
  border-right:1px dashed #e02f37;
}
table.rightdashedborder tr td.solid-right{
  border-left:1px solid #e02f37;
}
table.rightdashedborder tr td.noborder{
  border-right:0px solid #e02f37;
}
table.rightdashedborder tr td:last-child {
  border-left:0px dashed #e02f37;
}
table.borderless tr td:last-child {
  border-left: 0px solid #e02f37;
}
table.borderless {
  padding: 0rem;
  font-size: 10px;
}
table.borderless tr td {
  padding:0rem 3px;
  font-weight: 500;
  color: #e02f37;
  border: 0px solid #000;
}
table.borderright tr td {
  border-right: 1px dashed #e02f37;
  text-align: center;
  vertical-align: top;
}
table.borderright tr td:nth-child(3) {
  border-right: 0px dashed #e02f37 !important;
}
.red_check {
    position: relative;
    padding: 0rem;
    top:2px;
    border: 1px solid #e02f37;
    width: 17px;
    height: 18px;
    color: #000;
    font-weight:600;
    display: inline-block;
    font-size: 15px;
    text-align: center;
    margin-left:3px;
     margin-right:3px;
    margin-bottom:3px;
}
.p-nil {
  padding: 0px !important;
}
.p-0 {
  padding:4px!important;
}
.pb-0{
   padding-bottom:0px!important; 
}
.pb-1{
   padding-bottom:0.65rem!important; 
}
.pb-1s{
    padding-bottom:0.2rem!important; 
}
.pt-0{
   padding-top:0px!important; 
}
.pt-1{
   padding-top:0.1rem!important; 
}
.pt-3{
    padding-top:0.3rem!important;
}
.pt-8{
   padding-top:10px!important; 
}
.pt-20{
   padding-top:0.95rem!important; 
}
.pe-5{
   padding-right:5px!important; 
}
.p-1{
     padding:8px !important;
}
.ps-10{padding-left:10px!important;}
.ps-25{
    padding-left:25px!important;
}
.pt-66{
    padding-top:66px!important;
}
.ms-26{
    margin-left:26px!important;
}
.me-26{
    margin-right:26px!important;
}
.mt-5{
    margin-top:0.5rem!important;
}
.pos-1{
    position:relative;
    bottom:-14px;
}
.pos-2{
    position:relative;
    bottom:-5px; 
}
.text-dark {
  color: #000000 !important;
  font-weight: 600 !important;
  padding-left:5px !important;
  line-height:15px;
}
.text-dark2 {
  color: #000000 !important;
  font-weight:500 !important;
  padding-left:5px !important;
  line-height:15px;
}
.text-dark-xx{
    font-size:15px;
    color: #000000 !important;
    font-weight: 600 !important;
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
  padding: 0.0rem 3px;
}
small{
    font-size:82%;
}
.half-box{
    width:100px;
    height:15px;
    border-bottom:1px solid #e02f37 ;
    border-left:1px solid #e02f37 ;
    border-right:1px solid #e02f37 ;
    padding:0px 25px;
    margin:5px;
    margin-left:12px;
    position:relative;
    top:7px;
}
.custom_value{
    border-bottom:1px solid #e02f37 ;
    color:#000!important;
    margin:5px 0 0px 0px;
}
.custom_value33{
    border-bottom:0px solid #e02f37 ;
    color:#000!important;
    margin:5px 0 0px 0px;
}
.custom_value2{
    border-left:1px solid #e02f37 ;
    border-bottom:1px solid #e02f37 ;
    color:#000!important;
    margin:5px 0 0px 10px;
    padding-left:7px!important;
}
#full-view {
  width:85%;
}
.text-npi-bg{
    position:relative;
}
.text-npi-bg:before {
    content: "NPI";
    position: absolute;
    top: -9px;
    left:-33%;
    color: #e02f3730;
    font-size:25px;
    font-weight: 900;
    transform: translateX(50px);
}
.minheight{
    min-height:100px;
}
table.minheight tr td{
   height:15px;
}
.bottom-table{
    position:relative;
    bottom:-1px;
}
.bottom-table2{
    position:relative;
    bottom:-2px;
}

.w10{
    width:10%!important;
}
.w15{
    width:15%!important;
}
.w20{
    width:20%!important;
}
.w30{
    width:30%!important;
}
.w40{
    width:40%!important;
}
.w50{
    width:50%!important;
}
.w60{
    width:60%!important;
}
.w70{
    width:68%!important;
}
.w75{
    width:75%!important;
}
.w80{
    width:80%!important;
}
.w85{
    width:85%!important;
}

.noBtop{
    border-top:0px solid #e02f37!important;
}
.noBbottom{
    border-bottom:0px solid #e02f37!important;
}
.noBleft{
    border-left:0px solid #e02f37!important;
}
.noBright{
    border-right:0px solid #e02f37!important;
}
.p-img{
    width:11px;
    height:auto;
}
.logo{
    width:60px;
    height:auto;
}
.h-66{
    height:66px!important
}
.Lpos {
    position: relative;
    left: 5px;
}
.Rpos {
    position: relative;
    right:7px;
}
.fom1{
     position: relative;
    right:7px;
}
.fom2{
     position: relative;
     right:0px;
}
.fom3{
     position: relative;
     right:-1px;
}
.text-left {
    text-align: left!important;
}
label, output {
    display: inline-block;
}
.logotitle{
    font-size:22px;
    font-family:Arial;
    font-weight:bold
}
.w-25{
    width:15px!important;
}
.w-30{
    width:30px;
}
table.borderRgt tr td {
    border: 0px solid #e02f37;
    padding: 0 3px!important;
}

@media screen and (max-width: 1620px) {
  .Letter table tr td label.w90 {
    width: 70% !important;
  }
  .Letter table tr td span.title {
    width: 23% !important;
  }
  .Letter table tr td input[type="text"] {
    width: 77% !important;
  }
  .pos-1{
      bottom:-7px;
  }
  .pos-2{
    bottom:-2px; 
  }
  .bottom-table {
    position: relative;
    bottom: -2px;
}
table.valTab tr td{
    height:22px;
}
table td {
    font-size: 11px;
}
.w15 {
    width:18%!important;
}
.w80 {
    width: 75%!important;
}
.w70 {
    width:65%!important;
}
.text-dark-xx {
    font-size: 13px;
    font-weight:500 !important;
}
}
@media screen and (max-width: 1024px) {
.logo {
    width: 50px;
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
    font-size: 8px;
}
.text-dark-xx {
    font-size: 12px;
    font-weight: 500 !important;
}
.font-4 {
    font-size: 18px;
}
.border-2top {
    border-top:1px solid #e02f37!important;
}
    
}

@media print{
    *, *:before, *:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
      html, body {
        page-break-before:avoid;
        page-break-after:avoid;
        background-color:#fff!important;
       display:flex;
       justify-content: center;
        box-sizing: border-box;
       margin:0px;
       padding:0px;
       zoom:0.94;
      }
      
      .claimForm {
         margin:0;
         padding:0;
      }
        .Letter table tr td {
         padding: 0.4em 1em;
        }
      #full-view{
        width:100%!important;
        flex: 0 0 100%;
        max-width: 100%;
       }
       .p-2{
           padding:0.2rem!important;
       }
       .rowcol label{
           padding:0;
           margin:0;
       }
        .mainSec {
            padding: 0 0px!important;
            width:100%!important;
            flex: 0 0 100%;
            max-width: 100%;
        }
        .print-none, footer{
          display:none!important;
        }
        table.picu tr td {
        padding: 0.1rem;
        }
    table td {
    font-size: 9px;
    }
    .text-dark-xx{
    font-size:11px;
    font-weight:500!important;
    line-height:16px;
}
.red_check {
    width: 14px;
    height: 14px;
  }
    table.simpleborder tr td {
     padding:0.1rem!important
   }
   .h4{
    line-height:16px;
}
   .row-background {
    border:0px solid rgba(33,40,50,0)!important;
    background-color: #fff;
}
.card{
    -webkit-box-shadow: 0 3px 6px rgba(0,0,0,.0)!important;
    box-shadow: 0 3px 6px rgba(0,0,0,.0)!important;
}
.bottom-table{
    bottom:-2px;
}
.bottom-table2{
    bottom:-4px;
}
.p-0 {
  padding:2px!important;
}
.p-1{
     padding:2px !important;
}
.pt-20{
   padding-top:0.95rem!important; 
}
.ps-25{
    padding-left:25px!important;
}
.pt-8{
   padding-top:14px!important; 
}

table.redborder tr td {
  padding: 0.1rem;
}
.text-dark {
  line-height:12px;
  font-size: 9px;
  font-weight:500!important;
}
.pos-1{
    bottom:-6px;
}
.w15{
    width:18%!important;
}
.w85{
    width:80%!important;
}
.pos-2 {
    position: relative;
    bottom: -2px;
}
.p-img{
    width:10px;
    height:auto;
}
.font-4 {
    font-size: 22px;
    line-height:25px;
    padding-top:10px;
}
.pt-66{
    padding-top:35px!important;
}
.logo{
    width:40px;
    height:auto;
}
table.minheight tr td {
    height: 12px;
}
table.valTab tr td{
    height:16px;
}
.bottom-table2 {
   bottom: -8px;
}
.pt-20 {
    padding-top: 0.8rem!important;
}
.h-66 {
    height: 50px!important;
}
.Lpos {
    position: relative;
    left:-6px;
}
.Rpos {
    position: relative;
    right:-22px;
}
.fom1 {
    position: relative;
    right: -6px;
}
.fom2{
     position: relative;
     right:-2px;
}
.fom3{
     position: relative;
     right:-3px;
}

.red_check {
    position: relative;
    padding: 0rem;
    top:2px;
    border: 1px solid #e02f37;
    width: 16px;
    height: 16px;
    color: #000;
    font-weight:500;
    display: inline-block;
    font-size: 11px;
    text-align: center;
    margin-left:3px;
     margin-right:3px;
    margin-bottom:3px;
}
label, output {
    display: inline-block;
}
.text-left {
    text-align: left!important;
}
table, table td {
    border-collapse: collapse!important;
}
.pt-3 {
    padding-top: 0rem!important;
}
.Lpos tr td span{
     line-height: 22px;
    }
    table td {
    font-size: 11px;
    font-weight: 300;
}
.text-dark-xx {
    font-size: 11px;
     line-height: 15px;
}
.bottomtxt {
    line-height: 14px;
    font-size: 11px;
}
.logotitle{
    font-size:16px;
    font-family:Arial;
    font-weight:bold
}
.logo {
    width: 50px;
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
table td {
    font-size: 8px;
}
.text-dark-xx {
    font-size: 12px;
    font-weight: 500 !important;
}
.font-4 {
    font-size: 18px;
}
.border-2top {
    border-top:1px solid #e02f37!important;
}

table.borderless.tpBm .pb-1 {
    padding-bottom: 0.15rem!important;
}


}
@page { margin:0px; }
*{
 margin:0;
padding: 0;
}
</style>
</head>

<body id="content">
@if($injuryBillInfo)
<!--Main form section start here-->

<div class="row mx-auto mt-2 mb-2">
<div class="col-12 mx-auto" id="full-view">
<div class="card row-background">
@php     
$totalCharge = 0;
@endphp
<div class="claimForm Letter p-2" align="justify" id="exportContent">
<div align="left">
    <table width="100%">
        <tr>
            <td class="p-nil w-25">&nbsp;</td>
            <td class="p-nil Lpos">
                <table class="borderless p-nil" width="100%">
                    <tr>
                        <td><img src="../public/new_assets/images/scaner.jpg" alt="logo Scan" class="logo"></td>
                        <td rowspan="3">
                            <table class="borderless p-nil" width="100%">
                               <tr>
                                   <td class="text-dark-xx">Tristar Risk Management</td>
                               </tr> 
                               <tr>
                                   <td class="text-dark-xx">Submitted Electronically via Jopari</td>
                               </tr>
                               <tr>
                                   <td class="text-dark-xx">(Payer ID: 41556)</td>
                               </tr>
                            </table>    
                        </td>
                    </tr>
                    <tr>
                        <td><span class="logotitle">HEALTH INSURANCE CLAIM FORM </span></td>
                        
                    </tr>
                    <tr style="padding-bottom:15px;">
                        <td><label>APPROVED BY NATIONAL UNIFORM CLAIM COMMITTEE (NUCC) 02/12</label></td>
                        
                    </tr>
                </table>        
            </td>
            <td rowspan="2" class="noBright noBtop noBbottom p-nil text-center pe-5 fom1 w-30">
               <img src="../public/new_assets/images/form-1txt.jpg" class="p-img" alt="form">
           </td>
        </tr>
        <tr>
            <td class="p-nil w-25">&nbsp;</td>
            <td class="p-nil Lpos">
          <div class="rowcol">
            <div class="colum-8 box-left" style="padding-left:11px;">
              <table class="table-bordered picu">
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
              <label>PICA</label>
            </div>
            <div class="colum-4 box-right Rpos">
                <span class="text-dark-xx">CMS1500 Page 1 of 1</span>
              <label>PICA</label>
              <table class="table-bordered picu">
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>
          </div>
            </td>
        </tr>
    </table>
</div>
<div class="rowcol">
  <div class="colum-12">
    <table class="redborder">
      <tr>
        <td rowspan="6" class="noBleft noBtop noBbottom w-30">&nbsp;</td>
        <td colspan="2" class="p-0 border-2top">
          <table class="borderless" width="100%">
            <tr>
              <td><label><b>1.</b> MEDICARE</label></td>
              <td><label>MEDICAID</label></td>
              <td><label>TRICARE</label></td>
              <td><label>CHAMPVA</label></td>
              <td><label>GROUP HEALTH PLAN</label></td>
              <td><label>FECA BLACKLUNG</label></td>
              <td><label>OTHER</label></td>
            </tr>
            <tr>
              <td><span class="red_check">&nbsp;</span><label> (Medicare#)</label> </td>
              <td><span class="red_check">&nbsp;</span><label> (Medicaid#)</label></td>
              <td><span class="red_check">&nbsp;</span><label> (ID#/DoD#)</label> </td>
              <td><span class="red_check">&nbsp;</span><label> (Member ID#)</label> </td>
              <td><span class="red_check">&nbsp;</span><label> (ID#)</label> </td>
              <td><span class="red_check">&nbsp;</span><label> (ID#)</label></td>
              <td><span class="red_check">X</span><label> (ID#)</label></td>
            </tr>
          </table>
        </td>
        <td width="33%" class="border-2top">
          <table class="borderless" width="100%" valign="top">
            <tr>
              <td><label><b>1.a</b> INSURED'S I.D. NUMBER</label></td>
              <td><label>(For Program in item 1)</label></td>
            </tr>
            <tr>
              <td class="text-dark-xx">{{ ($injuryBillInfo->getInjury->patient->ssn_no) ? $injuryBillInfo->getInjury->patient->ssn_no : '999-99-9999' }}</td>
              <td class="text-dark"></td>
            </tr>
          </table>
        </td>
        <td rowspan="6" class="noBright border-1bottom fom2 w-30">
               <img src="../public/new_assets/images/form-2txt.jpg" class="p-img" alt="form">
           </td>
      </tr>
      <tr>
        <td width="33%">
          <table class="borderless" width="100%" valign="top">
            <tr>
              <td class="pt-1"><label><b>2.</b> PATIENT'S NAME(Last Name, First Name, Middle Initial)</label></td>
            </tr>
            <tr>
              <td class="text-dark-xx pt-1">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : '' }},
                                            {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : '' }}
                                            {{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->mi)? ', ' . $injuryBillInfo->getInjury->patient->mi : '' }}
                                                    
              </td>
            </tr>
          </table>
        </td>
        <td width="30%">
          <table class="borderless " width="100%" valign="top">
            <tr>
              <td><label><b>3.</b> PATIENT'S BIRTH DATE</label></td>
              <td><label>SEX</label></td>
            </tr>
            <tr>
              <td class="p-nil">
                <table width="100%" class="borderright">
                  <tr>
                    <td><label>MM</label></td>
                    <td><label>DD</label></td>
                    <td><label>YY</label></td>
                  </tr>
                  <tr>
                    <td class="text-dark-xx">{{ $mm }}</td>
                    <td class="text-dark-xx">{{ $dd }}</td>
                    <td class="text-dark-xx">{{ $yy }}</td>
                  </tr>
                </table>
              </td>
              <td>
                <table width="100%">
                  <tr>
                    <td><label for="male">M</label><span class="red_check">{{ ($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->gender &&  $injuryBillInfo->getInjury->patient->gender == 'Male') ? 'X' : '' }}&nbsp;</span></label></td>
                    <td><label for="female">F</label><span class="red_check">{{ ($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->gender &&  $injuryBillInfo->getInjury->patient->gender == 'Female') ? 'X' : '' }}&nbsp;</span></label></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="33%">
          <table class="borderless" width="100%" valign="top">
            <tr>
              <td><label><b>4.</b> INSURED'S NAME(Last Name, First Name, Middle Initial)</label></td>
            </tr>
            <tr>
              <td class="text-dark-xx">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->employer_name) ? $injuryBillInfo->getInjury->getInjuryClaim->employer_name : '' }}
              
              </td>
            </tr>
          </table>
        </td>
        
      </tr>
      <tr>
        <td width="33%">
          <table class="borderless" width="100%" valign="top">
            <tr>
              <td><label><b>5.</b> PATIENT'S ADDRESS (NO.,Street)</label></td>
            </tr>
            <tr>
              <td class="text-dark-xx">{{ $injuryBillInfo->getInjury->patient->address_line1 && $injuryBillInfo->getInjury->patient->address_line2 ? $injuryBillInfo->getInjury->patient->address_line1 . ', ' . $injuryBillInfo->getInjury->patient->address_line2 : $injuryBillInfo->getInjury->patient->address_line1 }}</td>
            </tr>
          </table>
        </td>
        <td width="30%">
          <table class="borderless " width="100%">
            <tr>
              <td><label><b>6.</b> PATIENT RELATIONSHIP TO INSURED</label></td>
            </tr>
            <tr>
              <td>
                <table width="100%">
                  <tr>
                    <td><label>Self</label><span class="red_check">X</span><label></td>
                    <td><label>Spouse</label><span class="red_check">&nbsp;</span><label></td>
                    <td><label>Child</label><span class="red_check">&nbsp;</span><label></td>
                    <td><label>Other</label><span class="red_check">&nbsp;</span><label></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
        <td width="33%">
          <table class="borderless" width="100%">
            <tr>
              <td><label><b>7.</b> INSURED'S ADDRESS (NO.,Street)</label></td>
            </tr>
            <tr>
              <td class="text-dark-xx">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line1) ? $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line1 : '' }}{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line2) ? ', '.$injuryBillInfo->getInjury->getInjuryClaim->emp_address_line2 : '' }}
                  
              </td>
              
            </tr>
          </table>
        </td>
        
      </tr>
      <tr>
        <td width="33%" class="p-nil">
          <table class="borderRgt" width="100%" valign="top">
            <tr>
              <td colspan="2" class="p-0"><label> CITY</label></td>
              <td width="30%" class="p-0"><label> STATE</label></td>
            </tr>
            <tr>
              <td colspan="2" class="text-dark-xx p-0">{{$injuryBillInfo->getInjury->patient->city_id }}</td>
              <td class="text-dark-xx p-0">{{ $stateCode }}</td>
            </tr>
            <tr class="border-top">
              <td><label> ZIPCODE</label></td>
              <td colspan="2"><label> TELEPHONE(Include Area Code)</label></td>
            </tr>
            <tr>
              <td class="text-dark-xx p-0">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->contact_no)  ? $injuryBillInfo->getInjury->patient->contact_no : '' }} &nbsp;</td>
              <td class="text-dark-xx p-0" colspan="2">{{ ($injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->contact_no)  ? $injuryBillInfo->getInjury->patient->contact_no : '' }}&nbsp;</td>
            </tr>
          </table>
        </td>
        <td width="30%" valign="top">
          <table class="borderless " width="100%">
            <tr>
              <td><label><b>8.</b> RESERVED FOR NUCC USE</label></td>
            </tr>
            <!--<tr>-->
            <!--  <td class="text-dark-xx"></td>-->
            <!--</tr>-->
          </table>
        </td>
        <td width="33%" class="p-nil">
          <table class="borderRgt" width="100%" valign="top">
            <tr>
              <td colspan="2" class="p-0"><label> CITY</label></td>
              <td width="30%" class="p-0"><label> STATE</label></td>
            </tr>
            <tr>
              <td colspan="2" class="text-dark-xx p-0">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->emp_city_id) ? $injuryBillInfo->getInjury->getInjuryClaim->emp_city_id : '' }}</td>
              <td class="text-dark-xx p-0">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->emp_state_id) ? $injuryBillInfo->getInjury->getInjuryClaim->emp_state_id : '' }}</td>
            </tr>
            <tr class="border-top">
              <td><label> ZIPCODE</label></td>
              <td colspan="2"><label> TELEPHONE(Include Area Code)</label></td>
            </tr>
            <tr>
              <td class="text-dark-xx">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->emp_zipcode) ? $injuryBillInfo->getInjury->getInjuryClaim->emp_zipcode : '' }}</td>
              <td class="text-dark-xx" colspan="2">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->emp_telephone) ? $injuryBillInfo->getInjury->getInjuryClaim->emp_telephone : '' }}</td>
            </tr>
          </table>
        </td>
       
      </tr>
      <tr>
        <td width="33%" class="p-nil">
          <table class="borderless tpBm" width="100%">
            <tr>
              <td class="pt-3"><label><b>9.</b> OTHER INSURED'S NAME(Last Name, First Name, Middle Initial)</label></td>
            </tr>
            <tr>
              <td class="text-dark pb-1 pt-3">&nbsp;</td>
            </tr>
            <tr class="border-top ">
              <td class="pt-3"><label><b>a.</b> OTHER INSURED'S POLICY OR GROUP NUMBER</label></td>
            </tr>
            <tr>
              <td class="text-dark pb-1">&nbsp;</td>
            </tr>
            <tr class="border-top">
              <td class="pt-3"><label><b>b.</b> RESERVED FOR NUCC USE</label></td>
            </tr>
            <tr>
              <td class="text-dark pb-1">&nbsp; </td>
            </tr>
            <tr class="border-top">
              <td class="pt-3"><label><b>c.</b> RESERVED FOR NUCC USE</label></td>
            </tr>
            <tr>
              <td class="text-dark pb-1">&nbsp; </td>
            </tr>
            <tr class="border-top">
              <td class="pt-3"><label><b>d.</b> INSURANCE PLAN NAME OR PROGRAM NAME</label></td>
            </tr>
            <tr>
              <td class="text-dark pb-1">&nbsp;</td>
            </tr>
          </table>
        </td>
        <td width="30%" class="p-nil">
          <table class="borderless tpBm " width="100%">
            <tr>
              <td colspan="3" class="pt-3"><label><b>10.</b> IS PATIENT'S CONDITION RELATED TO:</label></td>
            </tr>
            <tr>
              <td colspan="3" class="text-dark pb-1">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3"><label><b>a.</b> EMPLOYMENT?(Current or Previous)</label></td>
            </tr>
            <tr>
              <td class="text-right pb-1s"><span class="red_check">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->financial_class == '1')? 'X' : ''}} </span><label>YES</label></td>
              <td class="text-center pb-1s"><span class="red_check">&nbsp;</span><label>NO</label></td>
              <td class="text-center pb-1s">&nbsp;</td>
            </tr>
           <tr>
                          <td colspan="2" class="text-left"><label><b>b.</b> AUTO ACCIDENT?</label></td>
                          <td class="center"><label>PLACE (State)</label></td>
                      </tr>
                      <tr  class="pb-1">
                        <td class="text-right pb-1s"><span class="red_check">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->financial_class == '3')? 'X' : ''}}</span><label>YES</label></td>
                        <td class="text-center pb-1s"><span class="red_check">&nbsp;</span><label>NO</label></td>
                        <td class="text-left pb-1s"><span class="half-box"></span></td>
                      </tr>
            <tr>
              <td colspan="3"><label><b>c.</b> OTHER ACCIDENT?</label></td>
            </tr>
            <tr>
              <td class="text-right pb-1s"><span class="red_check">{{($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->financial_class == '2')? 'X' : ''}}</span><label>YES</label></td>
              <td class="text-center pb-1s"><span class="red_check">&nbsp;</span><label>NO</label></td>
              <td class="text-center pb-1s">&nbsp;</td>
            </tr>
            <tr class="border-top">
              <td colspan="3" class="pt-3"><label><b>10d.</b> CLAIM CODES (Designated by NUCC)</label></td>
            </tr>
           
            
          </table>
        </td>
        <td width="33%" class="p-nil">
          <table class="borderless tpBm" width="100%">
            <tr>
              <td colspan="2" class="pt-3"><label><b>11.</b> INSURED'S POLICY GROUP OR FECA NUMBER</label></td>
            </tr>
            <tr>
              <td colspan="2" class="text-dark">Value</td>
            </tr>
            <tr  class="border-top">
              <td colspan="2" class="p-nil pt-3">
                <table class="borderless " width="100%" valign="top">
                  <tr>
                    <td><label><b>a.</b> INSURED'S DATE OF BIRTH</label></td>
                    <td><label>SEX</label></td>
                  </tr>
                  <tr>
                    <td class="p-nil">
                      <table width="100%" class="borderright">
                        <tr>
                          <td><label>MM</label></td>
                          <td><label>DD</label></td>
                          <td><label>YY</label></td>
                        </tr>
                        <tr>
                          <td class="text-dark-xx">&nbsp;</td>
                          <td class="text-dark-xx">&nbsp;</td>
                          <td class="text-dark-xx">&nbsp;</td>
                        </tr>
                      </table>
                    </td>
                    <td>
                      <table width="100%">
                        <tr>
                          <td><label>M</label><span class="red_check">&nbsp;</span></td>
                          <td><label>F</label><span class="red_check">&nbsp;</span></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr class="border-top ">
              <td colspan="2" class="pt-3"><label><b>b.</b> OTHER CLAIM ID (Designated by NUCC)</label></td>
            </tr>
            <tr>
              <td colspan="2" class="text-dark p-nil">
                <table class="borderless" width="100%" valign="top">
                  <tr>
                    <td class="p-nil">
                      <table width="100%" class="borderright">
                        <tr>
                          <td width="25%" class="text-dark-xx">{{$injuryBillInfo->getInjury->getInjuryClaim->claim_no }}</td>
                          <td class="text-dark">Value</td>
                          
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
              <td colspan="2" class="text-dark pt-3">Value</td>
            </tr>
            
            <tr  class="border-top">
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
            <table class="borderless " width="100%">
            <tr>
              <td class="text-center" colspan="2"><label><b> READ BACK OF FORM BEFORE COMPLETEING & SIGNING THIS FORM</b></label></td>
            </tr>
            <tr>
              <td colspan="2"><label><b>12.</b> PATIENT'S OR AUTHORIZED PERSON'S SIGNATURE <small>I authorize the release of any medical or other information necessary to process this claim. I also request payment of government benifits either to myself or to government benifits either to myself or to the party who accepts assignment below.</small></label></td>
            </tr>
            <tr>
              <td class="p-0 pb-0 text-dark-xx"><label class="w15">SIGNED</label> <label class="custom_value w70">SIGNATURE ON FILE</label></td>
              <td class="p-0 pb-0 text-dark-xx"><label class="w20">DATE</label> <label class="custom_value w75">10/10/2023</label></td>
            </tr>
          </table>     
        </td> 
         <td >
           <table class="borderless" width="100%" style="padding-top:20px;">
            <tr>
              <td><label><b>13.</b> INSURED'S OR AUTHORIZED PERSON'S SIGNATURE <small> I authorize payment of medical benifits to the undersigned physician or supplier for service described below.</small></label></td>
            </tr>
            <tr>
              <td class="p-0 pb-0 pos-1 text-dark-xx text-right"><label class="w15 text-left">SIGNED</label> <label class="custom_value w80">&nbsp;</label></td>
            </tr>
          </table>          
        </td>  
      </tr>
        <tr>
            <td width="30px" class="noBleft noBtop noBbottom">&nbsp;</td>
             <td class="p-nil" colspan="2">
            <table class="rightdashedborder" width="100%">
                 <tr class="border-top">
                   <td width="50%" class="text-left solid"><label><b>14.</b>DATE OF CURRENT ILLNESS, INJURY,or PREGNANCY (LMP)</label></td>
                   <td width="50%" class="text-left noborder"><label><b>15. </b>OTHER DATE</label></td>
                 </tr>
   <tr>
   <td class="text-dark text-left solid p-nil">
     <table class="borderless " width="100%" valign="top">
       <tbody>
         <tr>
           <td class="p-nil">
             <table width="100%" class="borderright p-nil">
               <tbody>
                 <tr class="p-nil">
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
                 <tr>
                   <td class="text-dark">Value</td>
                   <td class="text-dark">Value</td>
                   <td class="text-dark">Value</td>
                 </tr>
               </tbody>
             </table>
           </td>
           <td>
             <table width="100%" class="rightdashedborder">
               <tbody>
                 <tr height="40">
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
   <td class="text-dark text-left noborder p-nil">
     <table class="borderless " width="100%" valign="top">
       <tbody>
         <tr>
           <td class="p-nil">
             <table width="100%" class="rightdashedborder p-nil">
               <tbody>
                 <tr height="40">
                   <td width="25%" class="dashed">QUAL.</td>
                   <td class="text-dark dashed">&nbsp;</td>
                 </tr>
               </tbody>
             </table>
           </td>
           <td class="p-nil">
             <table width="100%" class="borderright p-nil">
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
                 <tr>
                   <td class="text-dark">&nbsp;</td>
                   <td class="text-dark">&nbsp;</td>
                   <td class="text-dark">&nbsp;</td>
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
   <td width="50%" class="text-left solid">
     <label>
       <b>17.</b> NAME OF REFERRING PROVIDER OR OTHER SOURCE
       </label>
   </td>
   <td width="50%" class="text-left noborder p-nil">
     <table class="rightdashedborder p-nil" width="100%" valign="top">
       <!--Repeate row start here-->
       <tr class="bgpink border-top">
         <td class=" solid" width="60">
           <label>17.a</label>
         </td>
         <td class="text-dark solid" width="60"></td>
         <td class="text-dark noborder text-left">&nbsp;</td>
       </tr>
       <tr>
         <td class="solid">
           <label>17.b</label>
         </td>
         <td class=" solid border-top-dashed">
           <label>NPI</label>
         </td>
         <td class="text-dark noborder border-top-dashed text-left">&nbsp;</td>
       </tr>
       <!--Repeate row end here-->
     </table>
   </td>
 </tr>
 <tr class="border-top">
   <td colspan="2" class="text-left noborder p-nil">
     <table class="rightdashedborder" width="100%" valign="top">
       <td class="text-left noborder">
         <label>
           <b>19.</b>ADDITIONAL CLAIM INFORMATION <small>(Designated by NUCC)</small>
         </label>
       </td>
     </table>
   </td>
 </tr>
<tr>
  <td colspan="2" class="text-dark text-left noborder">&nbsp;</td>
</tr>
<tr class="border-top">
     <td colspan="2" class="text-left noborder p-nil">
     <table class="rightdashedborder" width="100%" valign="top">
       <td class="text-left noborder">
         <label><b>21.</b> DIAGNOSIS OR NATURE OF ILLNESS OR INJURY Relate A-L to service line below(24E) </label>
       </td>
       <td class="text-left noborder p-nil">
         <table class="rightdashedborder p-nil" width="100%" valign="top">
           <tr>
             <td width="35%" class="dashed">
               <label>ICD Ind.</label>
             </td>
             <td width="60" class="text-dark dashed">Value</td>
             <td width="45%" class="text-dark noborder">Value</td>
           </tr>
         </table>
       </td>
     </table>
   </td>
 </tr>
<tr>
<td colspan="2" class="text-dark text-left noborder">
  <table class="rightdashedborder" width="100%" valign="top">
    <td class="text-left noborder">
       <table class="rightdashedborder p-nil" width="100%" valign="top">
           <tr>
           <td class="noborder">
             <table class="rightdashedborder p-nil" width="100%" valign="top">
           <tr>
             <td width="100%" class="noborder">
               <label>A.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
           <tr>
             <td width="100%" class="noborder">
               <label>E.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
           <tr>
             <td width="100%" class="noborder">
               <label>I.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
         </table>
           </td>
           <td class="noborder">
             <table class="rightdashedborder p-nil" width="100%" valign="top">
           <tr>
             <td width="100%" class="noborder">
               <label>B.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
           <tr>
             <td width="100%" class="noborder">
               <label>F.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
           <tr>
             <td width="100%" class="noborder">
               <label>J.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
         </table>
           </td>
           <td class="noborder">
              <table class="rightdashedborder p-nil" width="100%" valign="top">
           <tr>
             <td width="100%" class="noborder">
               <label>C.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
           <tr>
             <td width="100%" class="noborder">
               <label>G.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
           <tr>
             <td width="100%" class="noborder">
               <label>K.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
         </table>
           </td>
          <td class="noborder">
            <table class="rightdashedborder" width="100%" valign="top">
           <tr>
             <td width="100%" class="noborder">
               <label>D.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
           <tr>
             <td width="100%" class="noborder">
               <label>H.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
           <tr>
             <td width="100%" class="noborder">
               <label>L.</label><label class="custom_value2 w70 text-left">Value</label>
             </td>
           </tr>
         </table>
           </td>
          </tr>
        </table>
   </td>
 </table>
</td>
</tr>                
<!--left Section end here-->
  </table>      
           </td>   
            <td class="p-nil"  width="33%">
             <table class="borderless tpBm" width="100%">
            <tbody>
            <tr class="border-top">
              <td class="pt-3"><label><b>16.</b> DATES PATIENT UNABLE TO WORK IN CURRENT OCCUPATION</label></td>
            </tr>
            <tr>
              <td class="text-dark p-nil pt-3">
                <table class="rightdashedborder" width="100%">
                  <tr>
                    <td class="p-nil" width="80"></td>
                    <td class="p-nil">MM</td>
                    <td class="p-nil">DD</td>
                    <td class="p-nil">YY</td>
                    <td class="p-nil" width="80"></td>
                    <td class="p-nil">MM</td>
                    <td class="p-nil">DD</td>
                    <td class="p-nil">YY</td>
                  </tr>
                  <tr>
                    <td class="text-dark p-0 dashed" width="80"><label><b>FROM</b></label></td>
                    <td class="text-dark p-0 dashed">&nbsp;</td>
                    <td class="text-dark p-0 dashed">&nbsp;</td>
                    <td class="text-dark p-0 noborder">&nbsp;</td>
                    <td class="text-dark p-0 dashed" width="80"><label><b>TO</b></label></td>
                    <td class="text-dark p-0 dashed">&nbsp;</td>
                    <td class="text-dark p-0 dashed">&nbsp;</td>
                    <td class="text-dark p-0 noborder">&nbsp;</td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr class="border-top">
              <td class="pt-3"><label><b>18.</b> HOSPITALIZATION DATES RELATED TO CURRENT SERVICES</label></td>
            </tr>
            <tr>
              <td class="text-dark p-nil pt-3">
                <table class="rightdashedborder" width="100%">
                  <tr>
                    <td class="p-nil" width="80"></td>
                    <td class="p-nil">MM</td>
                    <td class="p-nil">DD</td>
                    <td class="p-nil">YY</td>
                    <td class="p-nil" width="80"></td>
                    <td class="p-nil">MM</td>
                    <td class="p-nil">DD</td>
                    <td class="p-nil">YY</td>
                  </tr>
                  <tr>
                    <td class="text-dark p-0 dashed" width="80"><label><b>FROM</b></label></td>
                    <td class="text-dark p-0 dashed">&nbsp;</td>
                    <td class="text-dark p-0 dashed">&nbsp;</td>
                    <td class="text-dark p-0 noborder">&nbsp;</td>
                    <td class="text-dark p-0 dashed" width="80"><label><b>TO</b></label></td>
                    <td class="text-dark p-0 dashed">&nbsp;</td>
                    <td class="text-dark p-0 dashed">&nbsp;</td>
                    <td class="text-dark p-0 noborder">&nbsp;</td>
                  </tr>
                </table>
              </td>
            </tr>
             <tr class="border-top">
              <td colspan="2" class="p-nil pt-3">
                <table class="rightdashedborder " width="100%" valign="top">
                  <tbody><tr>
                    <td class="text-left"><label><b>20.</b> OUTSIDE LAB?</label></td>
                     <td class="text-left" colspan="2"><label>$CHARGES</label></td>
                  </tr>
                  <tr>
                    <td width="33%" class="solid pb-1s">
                      <table width="100%">
                         <tr>
                          <td><span class="red_check">&nbsp;</span><label>Yes</label></td>
                          <td><span class="red_check">&nbsp;</span><label>No</label></td>
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
                </tbody></table>
              </td>
            </tr>   
            <tr class="border-top">
              <td colspan="2" class="p-nil pt-3">
                <table class="rightdashedborder " width="100%" valign="top">
                  <tbody><tr>
                    <td class="text-left"><label><b>22.</b> RESUBMISSION</label></td>
                  </tr>
                  <tr>
                    <td class="p-0">
                      <table width="100%" class="borderright">
                        <tbody><tr>
                          <td class="solid noborder text-left"><label>CODE</label></td>
                          <td class="noborder text-left"><label>ORIGINAL REF. NO.</label></td>
                        </tr>
                        <tr>
                          <td class="text-dark solid">&nbsp;</td>
                          <td class="text-dark noborder">&nbsp;</td>
                        </tr>
                      </tbody></table>
                    </td>
                    
                  </tr>
                </tbody></table>
              </td>
            </tr>    
            <tr class="border-top">
              <td colspan="2" class="pt-3"><label><b>23.</b> PRIOR AUTHORIZATION NUMBER</label></td>
            </tr>
            <tr>
              <td colspan="2" class="text-dark">&nbsp;</td>
            </tr>
           
          </tbody></table>    
          </td>
           <td width="30px" rowspan="4" class="noBright noBtop border-1bottom fom3">
               <img src="../public/new_assets/images/form-3txt.jpg" class="p-img" alt="form">
           </td>
        </tr>
        
        
        <tr>
            <td width="30px" rowspan="5" class="noBleft noBtop noBbottom pt-66 p-nil">
             <table class="rightdashedborder" width="100%" valign="top">
                <tr>
                   <td  class="text-right font-4 noborder"><label><b>1</b></label></td>
                </tr> 
                <tr>
                   <td  class="text-right font-4 noborder"><label><b>2</b></label></td>
                </tr>
                <tr>
                   <td  class="text-right font-4 noborder"><label><b>3</b></label></td>
                </tr>
                <tr>
                   <td  class="text-right font-4 noborder"><label><b>4</b></label></td>
                </tr>
                <tr>
                   <td  class="text-right font-4 noborder"><label><b>5</b></label></td>
                </tr>
                <tr>
                   <td  class="text-right font-4 noborder"><label><b>6</b></label></td>
                </tr>
            </table>         
            </td>
            <td class="p-nil"  width="33%">
              <table class="rightdashedborder valTab"  width="100%" valign="top">
                 <tr>
                  <td colspan="6" class="text-left solid"><label><b>24.</b> <b>A.</b> DATE(S) OF SERVICE</label></td>
                  <td rowspan="3" class="text-center solid solid-right" width="60"><label><b>B.</b><br> PLACE OF SERVICE</label></td>
                  <td rowspan="3" class="text-center noborder"  width="60"><label><b>C.</b><br> AMG</label></td>
                </tr>
                <tr>
                  <td class="text-center noborder p-nil" colspan="3"><label><small>From</small></label></td>
                  <td class="text-center noborder p-nil" colspan="3"><label><small>To</small></label></td>
                </tr>
                <tr class="p-nil">
                  <td class="text-dark noborder">MM</td>
                  <td class="text-dark noborder">DD</td>
                  <td class="text-dark noborder">YY</td>
                  <td class="text-dark noborder">MM</td>
                  <td class="text-dark noborder">DD</td>
                  <td class="text-dark noborder">YY</td>
                </tr>
                <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark noborder"></td>
                </tr>
                 <tr>
                  <td class="text-dark">{{ $inj_mm }}</td>
                  <td class="text-dark">{{ $inj_dd }}</td>
                  <td class="text-dark solid">{{ $inj_yy }}</td>
                  <td class="text-dark">{{ $inj_mm }}</td>
                  <td class="text-dark">{{ $inj_dd }}</td>
                  <td class="text-dark solid">{{ $inj_yy }}</td>
                  <td class="text-dark solid">{{ ($injuryBillInfo->getBillPlaceOfService && $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode) ? $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->service_code : 'code' }}</td>
                  <td class="text-dark noborder">value</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                </tr>
                 <tr>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">value</td>
                  <td class="text-dark noborder">value</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                </tr>
                 <tr>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">value</td>
                  <td class="text-dark noborder">value</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                </tr>
                 <tr>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">value</td>
                  <td class="text-dark noborder">value</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                </tr>
                 <tr>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">value</td>
                  <td class="text-dark noborder">value</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                </tr>
                 <tr>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">value</td>
                  <td class="text-dark noborder">value</td>
                </tr>
                 <!--Repeate row start here-->
              </table> 
            </td>
            <td class="p-nil"  width="30%">
              <table class="rightdashedborder valTab"  width="100%" valign="top">
                <tr>
                  <td colspan="6" class="text-left solid"><label><b>D.</b> PROCEDURES, SERVICES, OR SUPPLIES</label></td>
                  <td colspan="2" rowspan="3" class="text-center solid noborder" width="60"><label><b>E.</b><br> DIAGNOSIS POINTER</label></td>
                </tr>
                <tr>
                  <td class="text-center solid p-0 " colspan="6"><label><small>(Explain Unusual Circumstances)</small></label></td>
                </tr>
                 <tr class="p-nil">
                  <td class="text-center solid p-0" colspan="2"><label>CPT/HCPCS</label></td>
                  <td class="text-center solid p-0" colspan="4"><label>MODIFIER</label></td>
                </tr>
                <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="2" class="text-dark noborder">&nbsp;</td>
                  
                </tr>
                 <tr>
                  <td class="text-dark solid" colspan="2">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                   <td colspan="2" class="text-dark noborder">&nbsp;</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="2" class="text-dark noborder">&nbsp;</td>
                  
                </tr>
                 <tr>
                  <td class="text-dark solid" colspan="2">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                   <td colspan="2" class="text-dark noborder">&nbsp;</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="2" class="text-dark noborder">&nbsp;</td>
                  
                </tr>
                 <tr>
                  <td class="text-dark solid" colspan="2">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                   <td colspan="2" class="text-dark noborder">&nbsp;</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="2" class="text-dark noborder">&nbsp;</td>
                  
                </tr>
                 <tr>
                  <td class="text-dark solid" colspan="2">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                   <td colspan="2" class="text-dark noborder">&nbsp;</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="2" class="text-dark noborder">&nbsp;</td>
                  
                </tr>
                 <tr>
                  <td class="text-dark solid" colspan="2">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                   <td colspan="2" class="text-dark noborder">&nbsp;</td>
                </tr>
                 <!--Repeate row start here-->
                 <!--Repeate row start here-->
                <tr class="bgpink border-top">
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="2" class="text-dark noborder">&nbsp;</td>
                  
                </tr>
                 <tr>
                  <td class="text-dark solid" colspan="2">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark">00</td>
                  <td class="text-dark solid">00</td>
                   <td colspan="2" class="text-dark noborder">&nbsp;</td>
                </tr>
                 <!--Repeate row start here-->
               </table>
            </td>
            <td  class="p-nil" width="33%">
              <table class="rightdashedborder valTab"  width="100%" valign="top">
                 <tr class="p-0">
                  <td colspan="3" class="text-center solid p-1 h-66"><label><b>F.</b><br> $ CHARGES</label></td>
                  <td class="text-center solid p-1 h-66" width="60"><label><b>G.</b><br> <small>DAYS OR UNITS</small></label></td>
                  <td class="text-center solid p-1 h-66" width="50"><label><b>H.</b><br><small> EPSDT Family Plan</small></label></td>
                  <td class="text-center solid p-1 h-66" width="40"><label><b>I.</b><br><small> ID QUAL.</small></label></td>
                  <td colspan="3" class="text-center solid noborder p-1 h-66" width="120"><label><b>J.</b><br> RENDERING PROVIDER ID.#</label></td>
                </tr>
                <!--Repeate row start here-->
                <tr class="p-nil bgpink border-top">
                  <td colspan="3" class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark solid">ZZ</td>
                  <td colspan="3" class="text-dark noborder border-top-dashed">&nbsp;</td>
                </tr>
                 <tr class="p-nil">
                  <td colspan="2" class="text-dark " width="100">00</td>
                  <td class="text-dark text-center solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class=" solid border-top-dashed"><label>NPI</label></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed text-left">1215628623</td>
                </tr>
                 <!--Repeate row end here-->
                  <!--Repeate row start here-->
                <tr class="p-nil bgpink border-top">
                  <td colspan="3" class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed">&nbsp;</td>
                </tr>
                 <tr class="p-nil">
                  <td colspan="2" class="text-dark" width="100">00</td>
                  <td class="text-dark text-center solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class=" solid border-top-dashed"><label>NPI</label></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed text-left">1215628623</td>
                </tr>
                 <!--Repeate row end here-->
                  <!--Repeate row start here-->
                <tr class="p-nil bgpink border-top">
                  <td colspan="3" class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed">&nbsp;</td>
                </tr>
                 <tr class="p-nil">
                  <td colspan="2" class="text-dark " width="100">00</td>
                  <td class="text-dark text-center solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="solid border-top-dashed"><label>NPI</label></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed text-left">1215628623</td>
                </tr>
                 <!--Repeate row end here--> <!--Repeate row start here-->
                <tr class="p-nil bgpink border-top">
                  <td colspan="3" class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed">&nbsp;</td>
                </tr>
                 <tr class="p-nil">
                  <td colspan="2" class="text-dark " width="100">00</td>
                  <td class="text-dark text-center solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="solid border-top-dashed"><label>NPI</label></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed text-left">1215628623</td>
                </tr>
                 <!--Repeate row end here-->
                  <!--Repeate row start here-->
                <tr class="p-nil bgpink border-top">
                  <td colspan="3" class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed">&nbsp;</td>
                </tr>
                 <tr class="p-nil">
                  <td colspan="2" class="text-dark" width="100">00</td>
                  <td class="text-dark text-center solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="solid border-top-dashed"><label>NPI</label></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed text-left">1215628623</td>
                </tr>
                 <!--Repeate row end here-->
                  <!--Repeate row start here-->
                <tr class="p-nil bgpink border-top">
                  <td colspan="3" class="text-dark noborder"></td>
                  <td class="text-dark noborder"></td>
                  <td class="text-dark solid"></td>
                  <td class="text-dark solid"></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed">&nbsp;</td>
                </tr>
                 <tr class="p-nil">
                  <td colspan="2" class="text-dark " width="100">00</td>
                  <td class="text-dark text-center solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="text-dark solid">00</td>
                  <td class="solid border-top-dashed"><label>NPI</label></td>
                  <td colspan="3" class="text-dark noborder border-top-dashed text-left">1215628623</td>
                </tr>
                 <!--Repeate row end here-->
               </table>
            </td>
        </tr>
        <tr>
         <td colspan="2" class="p-nil">
             <table class="rightdashedborder" width="100%">
               <tr>
                 <td class="solid p-nil" width="45%">
                     <table class="borderless" width="100%">
            <tr>
              <td class="text-left pt-1"><label><b>25.</b> FEDERAL TAX I.D NUMBER</label></td>
               <td><label>SSN</label></td>
               <td><label>EIN</label></td>
            </tr>
            <tr>
              <td class="p-0 ps-10 pt-20 text-dark-xx text-left">{{ $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id ? $injuryBillInfo->getInjury->patient->getBillingProvider->tax_id : '' }}</td>
              <td class="p-0"><span class="red_check">&nbsp;</span></td>
              <td class="p-0"><span class="red_check">&nbsp;</span></td>
            </tr>
          </table>
                 </td> 
           <td class="solid p-nil noborder pt-1" width="55%">
           <table class="borderless" width="100%">
            <tr>
              <td class="text-left solid "><label><b>26.</b> PATIENT'S ACCOUNT NO.</label></td>
              <td colspan="2" class="pt-1"><label><b>27.</b> ACCEPT ASSIGNMENT?<br><small style="padding-left:20px"> (For govt. claims, see back)</small></label></td>
            </tr>
            <tr>
              <td class="p-nil ps-10 solid text-dark-xx text-left">477db9122800-1</td>
              <td class="p-nil"><span class="red_check">&nbsp;</span><label>YES</label></td>
              <td class="p-nil noborder"><span class="red_check">&nbsp;</span><label>NO</label></td>
            </tr>
          </table> 
                 </td>
                 </tr>
              </table>
        </td> 
         <td class="p-nil" width="33%">
           <table class="rightdashedborder"  width="100%" valign="top">
            <tr>
              <td class="solid text-left p-0" colspan="3"><label><b>28.</b> TOTAL CHARGE</label></td>
              <td class="solid text-left p-0" colspan="3"><label><b>29.</b> AMOUNT PAID</label></td>
              <td class="noborder text-left p-0" colspan="3"><label><b>30.</b> Rsvd for NUCC Use</label></td>
            </tr>
            <tr>
              <td class="text-dark noborder p-nil pt-8"><label>$</label></td>
              <td class="text-dark-xx text-right  p-nil pt-8">{{ (is_float($totalCharge))? $totalCharge : $totalCharge.".00" }}</td>
              <td class="text-dark-xx solid p-nil pt-8 text-left" width="30">.00</td>
              
              <td class="text-dark p-nil noborder pt-8"><label>$</label></td>
              <td class="text-dark-xx text-right p-nil pt-8">0</td>
               <td class="text-dark-xx solid  p-nil pt-8 text-left" width="30">.00</td>
               
              <td class="text-dark noborder p-nil pt-8"><label>-</label></td>
              <td class="text-dark-xx text-right p-nil pt-8">0</td>
               <td class="text-dark-xx noborder  p-nil pt-8 text-left" width="30">.00</td>
            </tr>
          </table>      
        </td> 
      </tr>
      <tr>
         <td colspan="2" class="p-nil pt-1 border-2bottom">
             <table class="rightdashedborder" width="100%">
                 <tr>
                 <td class="solid p-nil" width="45%">
                     <table class="borderless text-left minheight pos-2" width="100%">
            <tr>
              <td colspan="2" class="text-left"><label><b>31.</b> SIGNATURE OF PHYSICIAN OR SUPPLIER INCLUDING DEGRESS OR CREDENTIALS <small>
                  (I certify that the statements on the reverse apply to this bill and are made a part thereof.)
               </small></label></td>
            </tr>
            <tr>
              <td colspan="2" class="text-dark2 p-0 text-left">{{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_first_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_first_name : '' }}
                                                                    {{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_last_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_last_name : '' }}
                                                                    {{ ($injuryBillInfo->getBillRenderingOrderingProvider &&  $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_middle_name) ? $injuryBillInfo->getBillRenderingOrderingProvider->referring_provider_middle_name : '' }}</td>  
            </tr>
            <tr>
              <td class="p-nill text-left"> <label class="custom_value33 text-dark-xx">SIGNATURE ON FILE</label></td>
              <td class="p-nill text-center text-dark-xx"> <label class="custom_value33">10/10/2023</label></td>
            </tr>
            <tr>
              <td class="p-nill text-left"><label>SIGNED</label></td>
              <td class="p-nill text-center"><label>DATE</label></td>
            </tr>
          </table> 
                 </td>
                 <td  class="noborder p-nil" width="55%">
                     <table class="borderless text-left minheight" width="100%">
            <tr>
              <td class="p-0 text-left"><label><b>32.</b> SERVICE FACILITY LOCATION INFORMATION </label></td>
            </tr>
            <tr>
              <td class="text-dark2 text-left">{{ $injuryBillInfo->getBillPlaceOfService->nick_name }}</td>
            </tr>
            <tr>
              <td class="text-dark2 text-left">{{ $injuryBillInfo->getBillPlaceOfService->address_line1 }}</td>
            </tr>
            <tr>
              <td class="text-dark2 text-left">{{ $injuryBillInfo->getBillPlaceOfService->address_line1 }}</td>
            </tr>
            <tr>
              <td class="text-dark2 text-left">{{ $injuryBillInfo->getBillPlaceOfService->city_id }}
                                                                      <span style="position:relative; right:-50px;">
                                                                        {{ $injuryBillInfo->getBillPlaceOfService->state_id }}
                                                                    </span></td>
            </tr>
            <tr>
              <td class="p-nil bottom-table">
                  <table width="100%" class="simpleborder p-0" >
                      <tr>
                          <td width="40%" class="text-left p-nil ">a.<span class="text-npi-bg text-dark-xx"> {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_npi }}</span></td>
                          <td class="bgpink noborder text-left">b.</td>
                      </tr>
                  </table>
              </td>
            </tr>
          </table> 
                 </td>
                 </tr>
             </table>
        </td> 
         <td class="p-nil border-2bottom"  width="33%">
           <table class="borderless minheight" width="100%">
            <tr>
              <td class="p-0"><label><b>33.</b> BILLING PROVIDER INFO & PH # (&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</label></td>
            </tr>
            <tr>
              <td class="text-dark2">{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name : '' }}</td>
            </tr>
            <tr>
              <td class="text-dark2">{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres1 }}</td>
            </tr>
            <tr>
              <td class="text-dark2">{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres2 }}</td>
            </tr>
            <tr>
              <td class="text-dark2">{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_city }}
                                     &nbsp;{{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_state }}
                                     
                                     <span style="position:relative; right:-50px;">
                                                                        {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_zip }}
                                                                        </span>
            </td>
            </tr>
            <tr>
              <td class="p-nil bottom-table2">
                  <table width="100%" class="simpleborder">
                      <tr>
                          <td width="40%">a.<span class="text-npi-bg text-dark-xx"> {{ $injuryBillInfo->getInjury->patient->getBillingProvider->professional_npi }}</span></td>
                          <td class="bgpink text-left">b.</td>
                      </tr>
                  </table>
              </td>
            </tr>
          </table>          
        </td>   
      </tr>
     
    </table>
    <table class="borderless" width="100%">
         <tr>
             <td width="30px" class="noBleft noBtop noBbottom">&nbsp;</td>
          <td class="text-left">
             <span class="bottomtxt">NUCC Instruction Manual available at: www.nucc.org</span>
          </td>
          <td>
              <h4 class="h4">PLEASE PRINT OR TYPE</h4>
          </td>
          <td class="text-right">
             <span class="bottomtxt">APPROVED OMB-0938-1197 form 1500 (02-12)</span>
          </td>
          <td width="30px" class="noBleft noBtop noBbottom">&nbsp;</td>
          
      </tr>
    </table>
  </div>
</div>
                </div>
            </div>
        </div>
    </div> 
    <!--Main form section End here-->
@endIf
</body>
</html>