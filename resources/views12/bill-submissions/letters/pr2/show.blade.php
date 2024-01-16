<!-- @extends('layouts.home-app')-->
@section('content')
<style>
.Letter table tr td label {
    border-bottom: 1px solid #1d1b1b;
    width:78%;
    padding: 4px 6px;
}

.Letter table tr td label.w80{
    width:80%!important;
}
.Letter table tr td label.w90{
    width:90%!important;
}
.Letter table tr td label.w30{
    width:30%!important;
}
.Letter table tr td input[type="text"]{
     border: 1px solid #1d1b1b;
     padding:5px 6px;
     width:85%;
}
.Letter table tr td span.title{
    width:15%;
    float:left;
    font-family: 'Figtree', sans-serif!important;
}
.Letter table tr td label.bordernone{
    border-bottom: 0px solid #1d1b1b;
}
 #full-view{
        width:85%;
    }
    
 @media screen and (max-width:1620px) {
    .Letter table tr td label.w90 {
    width: 70%!important;
}
.Letter table tr td span.title {
    width: 23%!important;
}
.Letter table tr td input[type="text"] {
    width:77%!important;
}  
 }
 @media print {
      html, body {
        page-break-before: avoid;
        page-break-after: avoid;
        background-color: #fff!important;
       display: flex;
       justify-content: center;
       margin:0px;
       padding:0px;
      }
      @page {
        margin:0.5cm 0cm;
        size: letter landscape;
      }
      .breakdown{
          margin-top:100px;
          page-break-before: always ;
      }
      #full-view{
        width:100%!important;
        flex: 0 0 100%;
        max-width: 100%;
       }
       .p-2{
           padding:0rem!important;
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
       .row-background {
    border:0px solid rgba(33,40,50,0)!important;
    background-color: #fff;
}
.card {
    -webkit-box-shadow: 0 3px 6px rgba(0,0,0,.0)!important;
    box-shadow: 0 3px 6px rgba(0,0,0,.0)!important;
}
}
</style>



    <div class="row mx-auto mt-2 mb-2">
         <div class="col-10 mx-auto" id="full-view">
            <div class="card row-background">
                <!-- START: Breadcrumbs-->
                <div class="row">
                     <div class="col-12  align-self-center print-none">
                        <div class="sub-header py-3 px-2 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> Show Referring and Ordering Providers</h2>
                            </div>
                            @if($pInjuries)
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">
                                    <a class="btn btn-primary" href="#" target="_blank"> PDF</a>
                                </li>
                                <li class="breadcrumb-item" onclick="saveDoc();">
                                   <a class="btn btn-primary" href="#" target="_blank"> DOC</a>
                                </li>
                                <li class="breadcrumb-item" onClick="genratePrint();">
                                   <a class="btn btn-primary" href="#" target="_blank"> PRINT</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/injury/view', $pInjuries->id) }}"> Back</a>
                                </li>
                            </ol>
                            @endIf
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                 <div class="demand Letter p-2" align="justify" id="exportContent">
                    <div align="center">
                        <span style="font-size:16px; font-family:Arial Black; font-weight:bold";> PRIMARY TREATING
                            PHYSICIAN'S PROGRESS REPORT ADDENDUM </span><br>
                        <span style="font-size:12px; font-family:Times New Roman";><i> Any Information not provided in this
                                report, please refer to the last report submitted </i></span><br><br>
                    </div>
                    <form action="#" method="post" name="frm">
                        <table class="table-bordered" id="full-view" align="center" >
                            <input type="hidden" name="pt_id" id="pt_id" value="Testing" />
                            <tr>
                                <td colspan="2" class="p-1">
                                    <input type="checkbox" class="cus_check" name="yes" value="yes">
                                    Prescription/Authorization Request for DME
                                    <span style="padding-left:50px">
                                        <input type="checkbox" class="cus_check" name="yes" value="yes"> 
                                        Prescription/Authorization Request for Treatment
                                    </span><br><br>
                                    <input type="checkbox" class="cus_check" name="yes" value="yes">
                                    Other:
                                </td>
                            </tr>
                        </table>

                       <table class="table-borderless mt-2" align="center" id="full-view">
                            <tr>
                                <td width="40%" style="padding-left:5px"> Patient :
                                    <label class="label" name="patientName" style="margin-left:12px">
                                          {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : ''}}
                                          {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : ''}}
                                    </label>
                            

                                </td>

                                <td width="23%" style="padding-left:5px">Sex :
                                    <label class="label" name="gendar" style="margin-left:8px">
                                       {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->gender) ? $injuryBillInfo->getInjury->patient->gender : ''}}  
                                    </label>
                                    
                                </td>

                                <td width="23%" style="padding-left:5px">DOB :
                                    <label class="label" name="dob" style="margin-left:5px">
                                        {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->dob) ? date('m-d-Y', strtotime($injuryBillInfo->getInjury->patient->dob)) : ''}} 
                                    </label>
                                   
                                </td>

                            </tr>

                            <tr>
                                <td width="40%" style="padding-left:5px">Address :
                                    <label class="label" name="patientAddress" style="margin-left:5px">
                                        {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->address_line1) ? $injuryBillInfo->getInjury->patient->address_line1 : ''}}
                                          {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->address_line2) ? $injuryBillInfo->getInjury->patient->address_line2 : ''}}
                                    </label>
                                  
                                </td>

                                <td colspan="2" width="40%" style="padding-left:5px">SSN :
                                    <label class="label w90"  name="claim_no" style="margin-left:5px">
                                             {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->ssn_no) ? $injuryBillInfo->getInjury->patient->ssn_no : ''}}
                                    </label>
                                    
                                </td>

                            </tr>

                            <tr>
                                <td width="40%" style="padding-left:5px">City :
                                    <label class="label w90" name="cityId">
                                         {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->city_id) ? $injuryBillInfo->getInjury->patient->city_id : ''}} 
                                    </label>
                                    
                                </td>

                                <td width="23%" style="padding-left:5px">State :
                                    <label class="label w80" name="stateId" style="margin-left:5px">
                                        {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->state_id) ? $injuryBillInfo->getInjury->patient->state_id : ''}} 
                                    </label>
                                    
                                </td>

                                <td width="23%" style="padding-left:5px">Zip :
                                    <label class="label w80"  name="zipCode" style="margin-left:5px">
                                            {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->zipcode) ? $injuryBillInfo->getInjury->patient->zipcode : ''}} 
                                    </label>
                                    
                                </td>

                            </tr>

                            <tr>
                                <td width="40%" style="padding-left:5px">HM :<label class="label" name="patientname"
                                        style="margin-left:5px">
                                        Testing </label>
                                    
                                </td>

                                <td colspan="2" width="40%" style="padding-left:5px"> WK # :<label class="label w90"
                                        name="patientname" style="margin-left:5px">
                                    &nbsp;
                                    </label>
                                   
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border:outset; border-color:#CCC !important";
                                        width="100%">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" width="100%" style="padding-left:5px"> Primary Ins. Co. 
                                    <label class="label w90" name="financialClass" style="margin-left:5px">
                                         {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->financial_class && $injuryBillInfo->getInjury->financial_class == 1) ? 'Worker Comp' :
                                         (($injuryBillInfo->getInjury->financial_class == 2) ? 'Private / Government' : 'Personal Injury' )}} 
                                    </label>
                                   
                                </td>
                            </tr>

                            <tr>
                                <td width="40%" style="padding-left:5px">Address :
                                    <label class="label" name="patientname" style="margin-left:2px">
                                        {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line1) ?  $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line1 : 'NA' }}
                                        {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line2) ?  $injuryBillInfo->getInjury->getInjuryClaim->emp_address_line2 : 'NA' }}
                                        </label>
                                    
                                </td>

                                <td width="23%" style="padding-left:5px">DOI :
                                    <label class="label w80" name="startDate" style="margin-left:8px">
                                        {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->start_date) ? date('m-d-Y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->start_date)) : 'NA' }}
                                    </label>
                                    
                                </td>

                                <td width="23%" style="padding-left:5px">
                                    <label class="label  w90" name="patientname"
                                        style="margin-left:5px">&nbsp;
                                    </label>
                                    
                                </td>

                            </tr>

                            <tr>
                                <td width="40%" style="padding-left:5px">City :
                                    <label class="label" name="empCityId" style="margin-left:25px">
                                        {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->emp_city_id) ?  $injuryBillInfo->getInjury->getInjuryClaim->emp_city_id : 'NA' }}
                                    </label>
                                   
                                </td>

                                <td width="23%" style="padding-left:5px">State :
                                    <label class="label"  name="stateId" style="margin-left:5px">
                                        {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->emp_state_id) ?  $injuryBillInfo->getInjury->getInjuryClaim->emp_state_id : 'NA' }} 
                                    </label>
                                   
                                </td>

                                <td width="230px" style="padding-left:5px">Zip :
                                    <label class="label" name="zipCode" style="margin-left:5px">
                                        {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->emp_zipcode) ?  $injuryBillInfo->getInjury->getInjuryClaim->emp_zipcode : 'NA' }} 
                                    </label>
                                    
                                </td>

                            </tr>

                            <tr>
                                <td width="40%" style="padding-left:5px">Adjuster :
                                    <label class="label" name="adjuster" style="margin-left:0px">
                                        Testing 
                                    </label>
                                    
                                </td>

                                <td colspan="2" width="40%" style="padding-left:5px">Phone #<label class="label w90"
                                        name="patientname" style="margin-left:0px">
                                        Testing</label>
                                    
                                </td>

                            </tr>

                            <tr>
                                <td width="40%" style="padding-left:5px">Claim # : 
                                    <label class="label" name="claimNumber" style="margin-left:5px">
                                          {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->claim_no) ?  $injuryBillInfo->getInjury->getInjuryClaim->claim_no : 'NA' }} 
                                    </label>
                                   
                                </td>

                                <td colspan="2" width="40%" style="padding-left:5px">Fax # : 
                                    <label class="label w90" name="faxNumber" style="margin-left:5px">
                                            Testing
                                     </label>
                                    
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border:outset; border-color:#CCC !important";
                                        width="100%">
                                </td>
                            </tr>

                            <tr>
                                <td width="50%" style="padding-left:5px"><span class="title">Employer :</span>
                                    <input type="text" name="employer" placeholder="{{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->employer_name) ?  $injuryBillInfo->getInjury->getInjuryClaim->employer_name : NULL }} " > </td>

                                <td colspan="2" width="50%" style="padding-left:5px"><span class="title">Phone #:</span><input
                                            type="text" name="emp_phone" placeholder="Testing">

                                </td>

                            </tr>

                            <tr>
                                <td width="50%" style="padding-left:5px"><span class="title">Address :</span>
                                    <input type="text" name="emp_address" placeholder="Testing">
                                </td>
                            </tr>

                            <tr>
                                <td width="50%" style="padding-left:5px"><span class="title">City :</span><input type="text"
                                            name="emp_city" placeholder="Testing">

                                </td>

                                <td width="30%" style="padding-left:5px"><span class="title">State : </span><input type="text"
                                            name="emp_state" placeholder="Testing" >

                                </td>

                                <td width="20%" style="padding-left:5px"><span class="title">Zip : </span><input type="text"
                                            name="emp_zip" placeholder="Testing">

                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border:outset; border-color:#CCC !important";
                                        width="100%">
                                </td>
                            </tr>
                            @if($injuryBillInfo->getInjury->financial_class && $injuryBillInfo->getInjury->financial_class == 1)
                            <tr>
                                <td width="40%" style="padding-left:5px"><span class="title">Attorney : </span>
                                <input type="text" name="attorney" placeholder="{{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->p_attorney_name) ?  $injuryBillInfo->getInjury->getInjuryClaim->p_attorney_name : null }} 
                                ">

                                </td>

                                <td colspan="2" width="40%" style="padding-left:5px"><span class="title">Phone #: </span><input
                                            type="text" name="phone" value="Testing" >

                                </td>

                            </tr>
                            @endif

                            <tr>
                                <td width="40%" style="padding-left:5px"><span class="title">Address :</span><input type="text"
                                            name="address" value="Testing">

                                </td>
                            </tr>

                            <tr>
                                <td width="40%" style="padding-left:5px"><span class="title">City :</span><input type="text"
                                            name="city" value="Testing">

                                </td>

                                <td width="23%" style="padding-left:5px"><span class="title">State : </span><input type="text"
                                            name="state" value="Testing">

                                </td>

                                <td width="23%" style="padding-left:5px">Zip : <b><input type="text"
                                            name="zip" value="Testing"></b>

                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border-top-width:4px; border-color:#000 !important";
                                        width="100%">
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-family:Times New Roman; font-weight:bold; font-size:18px">
                                    DIAGNOSIS</td>
                            </tr>
                            @if($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getInjuryDianoses)
                                @foreach($injuryBillInfo->getInjury->getInjuryClaim->getInjuryDianoses as $diagnos)
                                <tr>
                                    <td width="50%" style="padding-left:5px">1. <b>
                                        <input type="text" name="diagnosis[]" placeholder="{{$diagnos && $diagnos->getDianoses &&  $diagnos->getDianoses->diagnosis_name}}">
                                        
                                    </td>
    
                                    <td colspan="2" width="25%" style="padding-left:5px">ICD-{{$diagnos && $diagnos->getDianoses &&  $diagnos->getDianoses->code_type}} :<label class="label w80"
                                            name="icdType" style="margin-left:8px">
                                        </label>
                                        
                                </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td width="50%" style="padding-left:5px">2. <input type="text"
                                            name="diagnosis2" placeholder="Testing">
                                </td>

                                <td colspan="2" width="23%" style="padding-left:5px">ICD-10 :<label class="label w80"
                                        name="patientname" style="margin-left:8px">
                                    </label>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border-top-width:4px; border-color:#000 !important";
                                        width="100%">
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" align="left"
                                    style="font-family:Times New Roman; font-weight:bold; font-size:18px">SUBJECTIVE
                                    COMPLAINTS/ OBJECTIVE FINDINGS</td>
                            </tr>

                            <tr>
                                <td colspan="3" style="padding-left:5px">
                                    <table class="table-borderless" width="100%">
                                        <tr>
                                            <td width="30%"><input type="checkbox" class="cus_check" name="1"
                                        value="yes"> Patient is scheduled for surgery</td>
                                            <td width="30%"> <input type="checkbox" class="cus_check" name="2"
                                        value="yes"> Patient exhibits signs of swelling</td>
                                            <td width="30%"><input type="checkbox" class="cus_check" name="3"
                                        value="yes"> Patient exhibits impaired Range of Motion</td>
                                        </tr>
                                    </table>
 
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3" style="padding-left:5px">
                                    
                                     <table class="table-borderless" width="100%">
                                        <tr>
                                            <td width="30%"><input type="checkbox" class="cus_check" name="1"
                                        value="yes"> Patient exhibits loss of Strength  </td>
                                        
                                            <td width="30%"><input type="checkbox" class="cus_check"  name="2"
                                        value="yes"> Patient complains of Pain</td>
                                        
                                            <td width="30%"><input type="checkbox" class="cus_check" name="3"
                                        value="yes"><label class="label w80" name="patientname">&nbsp;</label>
                                    </td>
                                        </tr>
                                    </table>
                                    
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3">
                                    <hr style="margin-top:10px; margin-bottom:10px; border-top-width:4px; border-color:#000 !important";
                                        width="100%">
                                </td>
                            </tr>

                            <tr class="breakdown">
                                <td colspan="3" align="left"
                                    style="font-family:Times New Roman; font-weight:bold; font-size:18px">TREATMENT PLAN
                                    AND AUTHORIZATION REQUEST (in addition to current treatment plan)</td>
                            </tr>

                            <tr>
                                <td><input type="checkbox" class="cus_check" name="3"
                                        value="yes"> DO NOT SUBSTITUTE</td>
                            </tr>

                            <table align="center" id="full-view">

                                <tr>
                                    <td colspan="2" valign="top">
                                        <textarea name="dme_des" class="p-1" rows="15" cols="111" style="width:100%; min-height:200px;" placeholder="Testing"></textarea>
                                    </td>
                                </tr>
                            </table>

                            <table align="center" id="full-view">
                                <tr>
                                    <td align="left"
                                        style="font-family:'Times New Roman', Times, serif; font-size:18px; font-weight:bold">
                                        TREATMENT GOALS :</td>
                                </tr>
                                <tr>
                                    <td width="40%"> 1. To reduce or eliminate pain </td>
                                    <td width="40%"> 4. Improve range of motion </td>

                                </tr>
                                <tr>
                                    <td width="40%"> 2. To reduce or eliminate edema </td>
                                    <td width="40%"> 5. Protect the surgical repair </td>

                                </tr>
                                <tr>
                                    <td width="40%"> 3. Improve activities of daily living </td>
                                    <td width="40%"> 6. <label class="label w90" name="patientname">&nbsp;</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="pt-2 text-justify" style="line-height:1.5rem">
                                        <p> The treatment plan as described above is both reasonable and medically
                                            necessary. Not using these devices can have traumatic results and diminish the
                                            likelihood of recovery. ACOEM and ODG support the use of medical devices at the
                                            home and state so in several chapters of both guidelines. ACOEM also
                                            specifically states, "ACOEM develops and publishes these guidelines to promote
                                            health of injured workers. ACOEM does not publish the Practice Guidelines in
                                            order to rigidly mandate treatments and, in fact, the guidelines fully
                                            acknowledge that in some cases alternative treatments outside the recommended
                                            course of action may be warranted. It is important to re-emphasize that the
                                            ACOEM Practice Guidelines are not intended to be used to deny patients care or
                                            reimbursement. Each patient is unique and cases must be handled on an individual
                                            basis." (Hegmann, Editor-in-Chief 2008) Therefore, it is my opinion that these
                                            devices are medically necessary and should be provided. Furthermore, in order to
                                            obtain maximum results, the patient should be instructed on the proper use of
                                            these devices in a one on one setting by a manufacturers approved representative
                                            that speaks and understands the patient's primary language. It is also necessary
                                            to provide follow up with the patient to ensure compliance. </p>
                                    </td>

                                </tr><br>
                                <tr>
                                    <td colspan="2">
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; font-weight:bold; font-size:18px"><b>
                                                WORK STATUS </b></span>
                                        <span style="padding-left:100px"> Remain off work </span>
                                        <span style="padding-left:100px"> Return to modified work </span>
                                        <span style="padding-left:100px"> Return to full duty </span>

                                </tr>
                                <tr>
                                    <td align="left"
                                        style="font-family:'Times New Roman', Times, serif; font-size:15px; font-weight:bold">
                                        PRIMARY TREATING PHYSICIAN :</td>
                                </tr>
                                <tr>
                                    <table align="center" id="full-view" width="100%;">
                                        <tr>
                                            <td width="40%">Address
                                                <label class="label">&nbsp;</label>
                                            </td>

                                            <td width="20%">City
                                                <label class="label">&nbsp;</label>
                                            </td>
                                            <td width="20%">State
                                                <label class="label">&nbsp;</label>
                                            </td>
                                            <td width="20%">Zip
                                                <label class="label">&nbsp;</label>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>Phone
                                                <label class="label">&nbsp;</label>
                                            </td>

                                            <td>Fax
                                                <label class="label w80">&nbsp;</label>
                                            </td>
                                            <td colspan="2">&nbsp;</td>

                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                        <table align="center" class="table my-1">
                                            <tr>
                                                <td style="width:30%;">Name: <label class="label bordernone">Testing</label>
                                                </td>
                                                <td style="width:40%;"> Specialty: <label class="label bordernone">Testing</label> 
                                                 </td>
                                                <td style="width:30%;">Lic. # <label class="label bordernone">Testing</label>
                                                </td>
                                            </tr>
                                        </table>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="p-0">
                                        <table align="center" width="100%">
                                            <tr>
                                                <td style="width:60%;">
                                                    Signature
                                                    <label class="label">&nbsp;</label>
                                                </td>
                                                <td style="width:40%;"> 
                                                Date
                                                <label class="label">&nbsp;</label>
                                                </td>
                                            </tr>

                                            <tr class="py-2">
                                                <td colspan="2" align="center" >
                                                    <input type="submit" name="btnSend" value="submit" class="btn btn-primary mt-2">
                                                </td>

                                            </tr>
                                        </table>
                                        </td>
                                        </tr>

                                    </table>

                                </tr>
                            </table>
                        </table>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
