<!-- @extends('layouts.home-app')-->
@section('content')
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
        font-size: 18px;
        font-weight: 600;
        line-height: normal;
        margin: 0;
        padding: 11px 0 9px;
    }
    .showImgaeInBack{  background-image: url('/new_assets/app-assets/images/form-1500.jpg');
    background-size: auto 100%;
    background-repeat: no-repeat;
    background-position: left top;
    }
    #full-view{
        width:85%;
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
        margin:0cm;
        size: letter landscape;
      }
      #full-view{
        width:100%!important;
        flex: 0 0 100%;
        max-width: 100%;
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
       .row-background{
         border: 0px solid rgba(33,40,50,.125)!important; 
      }
      .card {
       -webkit-box-shadow: none!important;
       -moz-box-shadow:none!important;
        box-shadow: none!importantg;
     }
}
</style>



<div class="row mt-2 mb-2" >
       <div class="col-10 mx-auto" id="full-view">
             <!-- START: Breadcrumbs-->
                <div class="row print-none">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-2 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> RFA Letter</h2>
                            </div>
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
                                    <a class="btn btn-primary" href="{{ url('/view/patient/injury/bill/info', $injuryBillInfo->id) }}"> Back</a>
                                </li>
                            </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
               
               <div class="card row-background">
               <div class="demand Letter p-2" align="center" id="exportContent">
               <div align="center"><span style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> State of {{($state) ? $state->state_name : ''}}, Division of Workers' Compensation </span><br><br>
                <span style="font-size:22px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> REQUEST FOR AUTHORIZATION </span><br><br>
                <span style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> DWC Form RFA</span><br><br>
                <span style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> Attach the Doctor's First Report of Occupational Injury or Illness, Form DLSR 5021, a Treating Physician's <br> Progress Report, DWC Form PR-2, or equivalent narrative report substantiating the requested treatment.</span><br><br>
 
				<table width="80%" align="center" border="1" bordercolor="#000000" class="table-bordered" id="full-view">
                    <tr style="font-weight:bold">
                    <td colspan="2" style="padding-left:5px">
                    <input type="checkbox" size="30px" name="yes" value="yes"> New Request
                    <span style="padding-left:50%"><input type="checkbox" name="yes" value="yes"> Resubmission – Change in Material Facts </span><br>
                    <input type="checkbox" name="yes" value="yes"> Expedited Review: Check box if employee faces an imminent and serious threat to his or her health<br>
                    <input type="checkbox" name="yes" value="yes"> Check box if request is a written confirmation of a prior oral request.<br>
                    </td>
                    </tr>
                    <tr>
                    <td colspan="2" style="background-color:#C6D9F1; padding-left:5px; font-size:16px; font-weight:600">Employee Information</td>
                     
                    </tr> 
                     
                     <tr>
                     <td colspan="2" style="padding-left:5px">
                         Employee Name (Last, First, Middle):
                         <label class="label" name="patientname">
					        {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : ''}}
                             {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : ''}}
					    </label>
                     </td>
                    
                    </tr> 
                    
                    <tr>
                    <td width="60%" style="padding-left:5px" >Date of Injury (MM/DD/YYYY): 
                        <label class="label" name="start_date">
                             {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->start_date) ? date('m-d-Y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->start_date)) : 'NA' }}
                        </label>
                    </td>
                    <td width="40%" style="padding-left:5px">Date of Birth (MM/DD/YYYY): 
                        <label class="label" name="dob">
                            {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->dob) ? date('m-d-Y', strtotime($injuryBillInfo->getInjury->patient->dob)) : ''}}
                        </label>
                    </td>
                     
                    </tr> 
                     
                     <tr>
                     <td width="60%" style="padding-left:5px">Claim Number: 
                         <label class="label" name="claim_no">
                            {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->claim_no) ?  $injuryBillInfo->getInjury->getInjuryClaim->claim_no : 'NA' }} 
                         </label>
                     </td>
                     <td width="40%" style="padding-left:5px">Employer Name: 
                         <label class="label" name="patientname">
                             {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->employer_name) ? $injuryBillInfo->getInjury->getInjuryClaim->employer_name : 'NA' }}
                         </label>
                     </td>
                     </tr>
                                          
                     <tr colspan="2" style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                     <td colspan="2" style="padding-left:5px; font-size:16px; font-weight:600">Requesting Physician Information</td>
                     </tr> 
                     
                     <tr>
                     <td colspan="2" style="padding-left:5px">Name:<label class="label" name="patientname">Testing</label></td>
                    
                     </tr>
                     
                     <tr>
                     <td width="60%" style="padding-left:5px">Practice Name : </td>
                    <td width="40%" style="padding-left:5px">Contact Name: </td>
                     </tr>
                     
                     <tr>
                     <td width="60%" style="padding-left:5px">Address: <label class="label" name="patientname">Testing</label></td>
                    <td width="40%" style="padding-left:5px">City: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                     <tr >
                     <td width="60%" style="padding-left:5px">State: <label class="label" name="patientname">Testing</label></td>
                    <td width="400px" style="padding-left:5px">Zip Code: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                      <tr >
                     <td width="60%" style="padding-left:5px">Phone : <label class="label" name="patientname">Testing</label></td>
                    <td width="40%" style="padding-left:5px">Fax Number: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                     
                     <tr>
                     <td width="60%" style="padding-left:5px">Specialty : <label class="label" name="patientname">Testing</label></td>
                    <td width="40%" style="padding-left:5px">NPI Number: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                     <tr >
                     <td colspan="2" style="padding-left:5px">E-mail Address :<label class="label" name="emailPhysicion">Testing</label></td>
                    
                     </tr>
                     
                     <tr colspan="2" style="background-color:#C6D9F1;">
                     <td colspan="2" style="padding-left:5px; font-size:16px; font-weight:600">Claims Administrator Information</td>
                    
                     </tr> 
                     
                      <tr>
                     <td width="60%" style="padding-left:5px; font-weight:600">Claims Administrator Name : 
                         <label class="label" name="claimAdminName">
                             {{ ($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin &&  $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin ) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : 'NA' }}
                         </label>
                     </td>
                    <td width="40%" style="padding-left:5px">Contact Name: 
                        <label class="label" name="patientname">
                            {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->contact_no) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->contact_no : 'NA' }}
                        </label>
                    </td>
                     </tr>
                     
                    <tr >
                    <td colspan="2" style="padding-left:5px">Address: 
                        <label class="label" name="patientname">
                            {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->address_line1) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->address_line1 : 'NA' }}
                              {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->address_line2) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->address_line2 : 'NA' }}
                        </label>
                    </td> 
                     </tr> 
                     
                     <tr>
                     <td width="60%" style="padding-left:5px">Phone : 
                         <label class="label" name="phoneNumber">
                             {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->contact_no) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->contact_no : 'NA' }}
                         </label>
                     </td>
                    <td width="40%" style="padding-left:5px">Fax Number: 
                        <label class="label" name="faxNumber">
                             {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->fax_no) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->fax_no : 'NA' }}
                         </label>
                    </td>
                     </tr>
                     
                     <tr>
                     <td colspan="2" style="padding-left:5px">E-mail Address : 
                         <label class="label" name="faxNumber">
                             {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->email) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->email : 'NA' }}
                         </label>
                     </td>
                     </tr>
                     
                     <tr style="background-color:#C6D9F1;">
                     <td colspan="2" style="padding-left:5px; font-size:16px; font-weight:600">Requested Treatment (see instructions for guidance; attached additional pages if necessary)</td>
                     </tr> 
                     
                     <tr>
                     <td colspan="2" style="padding-left:5px">List each specific requested medical services, goods, or items in the below space or indicate the specific page number(s) of the attached medical report on which the requested treatment can be found. Up to five (5) procedures may be entered; list additional requests on a separate sheet if the space below is insufficient.</td>
                    </tr>  
                    <tr>
                     <td colspan="2" style="padding-left:0px; padding-right:0px; padding:0 0;">
                    <table width="100%" border="0" bordercolor="#000000">
                    <tr align="center" style="font-weight:600;">
                    <td><b>Diagnosis (Required)</b></td>
                    <td><b>ICD-Code (Required)</b></td>
                    <td><b>Service/Good Requested (Required)</b></td>
                    <td><b>CPT/HCPCS Code(If known)</b></td>
                    <td><b>Other Information:(Frequency, Duration Quantity, etc.)</b></td>
                    </tr>
                    
                    <form id="myform"  method="post">
                    <input type="hidden" name="pt_id" placeholder="Testing">
                    
                    <tr height="25px;">
                    <input type="hidden" name="item_id[]" placeholder="Testing">
                    <td class="p-0"><input type="text" name="Testing" placeholder="Testing" style="width:100%; border:0px solid #333"> </td>
                    <td class="p-0"><input type="text" name="Testing" placeholder="Testing" id="Testing" style="width:100%; border:0px solid #333"></td>
                    <td class="p-0"><input type="text" name="Testing" placeholder="Testing" id="Testing"  style="width:100%; border:0px solid #333"></td>
                    <td class="p-0"><input type="text" name="Testing" placeholder="Testing" id="Testing" style="width:100%; border:0px solid #333"></td>
                    <td class="p-0"><input type="text"  name="Testing" placeholder="Testing" id="Testing" style="width:100%; border:0px solid #333"></td>                    
                    </tr>
                    </form>
                    <tr height="35px">
                    <td colspan="5"></td>
                    </tr>
                    <form id="myform13"  method="post"> 
                    <input type="hidden" name="pt_id1" value="Testing">
                    <tr style="font-weight:bold">
                    <td colspan="4" style="padding-left:5px; font-weight:600;">Requesting Physician Signature:</td>
                    
                    <td style="padding-left:5px">Date: <input type="text" placeholder="MM-DD-YYYY" align="left"  name="t_six" value="Testing" id="t_six" style="width:183px"> 
                    <input type="button" form="form1" value="Submit" onClick="store_t_one();"></button> </td>                                      
                    </tr>
                    </form>
                    
                    <tr style="background-color:#C6D9F1;">
                    <td colspan="5" style="padding-left:5px; font-size:16px; font-weight:600">Claims Administrator/Utilization Review Organization (URO) Response</td>
                                                        
                    </tr>
                    
                    <tr style="font-weight:bold">
                    <td colspan="5" style="padding-left:5px"> 
                    <input type="checkbox" size="30px" name="yes" value="yes"> Approved
                    <span style="padding-left:30px"><input type="checkbox" name="yes" value="yes"> Denied or Modified (See separate decision letter) </span>
                    <span style="padding-left:30px"><input type="checkbox" name="yes" value="yes"> Delay (See separate notification of delay)</span><br>
                    <input type="checkbox" name="yes" value="yes"> Requested treatment has been previously denied. 
                    <span style="padding-left:30px"><input type="checkbox" name="yes" value="yes"> Liability for treatment is disputed (See separate letter) . </span><br></td>
                                                    
                    </tr>
                    
                    <tr height="25px" style="font-weight:bold">
                    <td colspan="4" style="padding-left:5px">Authorization Number (if assigned):</td>
                    <td style="padding-left:5px">Date:</td>                                    
                    </tr>
                    
                    <tr height="25px" style="font-weight:bold">
                    <td colspan="4" style="padding-left:5px">Authorized Agent Name :</td>
                    <td style="padding-left:5px">Signature :</td>                                      
                    </tr>
                    
                    <tr height="25px" style="font-weight:bold">
                    <td colspan="2" style="padding-left:5px">Phone :</td>
                    <td colspan="2" style="padding-left:5px">Fax Number :</td>
                    <td style="padding-left:5px">E-mail Address :</td>                                      
                    </tr>
                    
                    <tr style="font-weight:bold">
                    <td colspan="5" style="padding-left:5px">Comments :</td>
                    </tr>
                    </table>
                    </td>
                    </tr>                   
                    </table>
					</div>   
					</div>
			   
    	</div>
    </div>
    </div>
@endsection
