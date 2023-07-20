<!-- @extends('layouts.home-app')-->
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
    #loadingForm{height:1492px; width: 1153px;}
    
    #tdcontent td {
     font:Arial, Helvetica, sans-serif; 
     font-size:18px   
    }
</style>


@section('content')
<div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">
            
            <div class="card row-background">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> RFA Letter</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">
                                     <a class="btn btn-primary" href="{{ url('/injury/view', $pInjuries->id) }}"> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                
        <div>
                    
               </div>
               
               <div class="demand" align="center" id="exportContent">
               <div align="center"><span style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> State of {{($pInjuries && $pInjuries->patient) ? strtoupper( substr( $pInjuries->patient->state_id, 0, 2 ) ) : ''}}, Division of Workers' Compensation </span><br>
                <span style="font-size:22px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> REQUEST FOR AUTHORIZATION </span><br>
                <span style="font-size:14px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> DWC Form RFA</span><br><br>
                
                <span style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> Attach the Doctor's First Report of Occupational Injury or Illness, Form DLSR 5021, a Treating Physician's <br> Progress Report, DWC Form PR-2, or equivalent narrative report substantiating the requested treatment.</span><br><br>
                </div> 
					
                    <table width="900px" align="center" border="1" bordercolor="#000000" style="border-bottom-style:outset">
                    
                    <tr style="font-weight:bold">
                    <td colspan="2" style="padding-left:5px">
                    <input type="checkbox" size="30px" name="yes" value="yes"> New Request
                    <span style="padding-left:450px"><input type="checkbox" name="yes" value="yes"> Resubmission – Change in Material Facts </span><br>
                    <input type="checkbox" name="yes" value="yes"> Expedited Review: Check box if employee faces an imminent and serious threat to his or her health<br>
                    <input type="checkbox" name="yes" value="yes"> Check box if request is a written confirmation of a prior oral request.<br>
                    </td>
                    
                    </tr>
                    
                    <tr>
                    <td colspan="2" style="background-color:#C6D9F1; padding-left:5px; font-size:16px; font-weight:600">Employee Information</td>
                     
                    </tr> 
                     
                     <tr>
                     <td colspan="2" style="padding-left:5px">Employee Name (Last, First, Middle):<label class="label" name="patientname">
					 Testing </label>
                     </td>
                    
                    </tr> 
                    
                    <tr>
                    <td width="500px" style="padding-left:5px" >Date of Injury (MM/DD/YYYY): <label class="label" name="patientname">Testing</label></td>
                    <td width="400px" style="padding-left:5px">Date of Birth (MM/DD/YYYY): <label class="label" name="patientname">Testing</label></td>
                     
                    </tr> 
                     
                     <tr>
                     <td width="500px" style="padding-left:5px">Claim Number: <label class="label" name="patientname">Testing</label></td>
                     <td width="400px" style="padding-left:5px">Employer Name: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                                          
                     <tr colspan="2" style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                     <td colspan="2" style="padding-left:5px">Requesting Physician Information</td>
                     </tr> 
                     
                     <tr>
                     <td colspan="2" style="padding-left:5px">Name:<label class="label" name="patientname">Testing</label></td>
                    
                     </tr>
                     
                     <tr>
                     <td width="500px" style="padding-left:5px">Practice Name : </td>
                    <td width="400px" style="padding-left:5px">Contact Name: </td>
                     </tr>
                     
                     <tr>
                     <td width="500px" style="padding-left:5px">Address: <label class="label" name="patientname">Testing</label></td>
                    <td width="400px" style="padding-left:5px">City: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                     <tr >
                     <td width="500px" style="padding-left:5px">State: <label class="label" name="patientname">Testing</label></td>
                    <td width="400px" style="padding-left:5px">Zip Code: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                      <tr >
                     <td width="500px" style="padding-left:5px">Phone : <label class="label" name="patientname">Testing</label></td>
                    <td width="400px" style="padding-left:5px">Fax Number: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                     
                     <tr>
                     <td width="500px" style="padding-left:5px">Specialty : <label class="label" name="patientname">Testing</label></td>
                    <td width="400px" style="padding-left:5px">NPI Number: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                     <tr >
                     <td colspan="2" style="padding-left:5px">E-mail Address :<label class="label" name="patientname">Testing</label></td>
                    
                     </tr>
                     
                     <tr colspan="2" style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                     <td colspan="2" style="padding-left:5px">Claims Administrator Information</td>
                    
                     </tr> 
                     
                      <tr>
                     <td width="500px" style="padding-left:5px">Claims Administrator Name : <label class="label" name="patientname">Testing</label></td>
                    <td width="400px" style="padding-left:5px">Contact Name: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                    <tr >
                    <td colspan="2" style="padding-left:5px">Address: <label class="label" name="patientname">Testing</label></td>
                    
                     </tr> 
                     
                     <tr>
                     <td width="500px" style="padding-left:5px">Phone : <label class="label" name="patientname">Testing</label></td>
                    <td width="400px" style="padding-left:5px">Fax Number: <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                     <tr>
                     <td colspan="2" style="padding-left:5px">E-mail Address : <label class="label" name="patientname">Testing</label></td>
                     </tr>
                     
                     <tr style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                     <td colspan="2" style="padding-left:5px">Requested Treatment (see instructions for guidance; attached additional pages if necessary)</td>
                    
                     </tr> 
                     
                     <tr>
                     <td colspan="2" style="padding-left:5px">List each specific requested medical services, goods, or items in the below space or indicate the specific page number(s) of the attached medical report on which the requested treatment can be found. Up to five (5) procedures may be entered; list additional requests on a separate sheet if the space below is insufficient.</td>
                    
                    </tr>  
                    <tr>
                    <table width="900px" border="1" bordercolor="#000000" style="border-bottom-style:outset">
                    <tr align="center" style="font-weight:bold">
                    <td>Diagnosis (Required)</td>
                    <td>ICD-Code (Required)</td>
                    <td>Service/Good Requested (Required)</td>
                    <td>CPT/HCPCS Code(If known)</td>
                    <td>Other Information:(Frequency, Duration Quantity, etc.)</td>
                    </tr>
                    
                    <form id="myform"  method="post">
                    <input type="hidden" name="pt_id" value="Testing">
                    
                    <tr height="25px">
                    <input type="hidden" name="item_id[]" value="Testing">
                    <td><input type="text" name="Testing" value="Testing" style="width:120px"> </td>
                    <td><input type="text" name="Testing" value="Testing" id="Testing" style="width:120px"></td>
                    <td><input type="text" name="Testing" value="Testing" id="Testing"  style="width:200px"></td>
                    <td><input type="text" name="Testing" value="Testing" id="Testing" style="width:160px"></td>
                    <td><input type="text"  name="Testing" value="Testing" id="Testing" style="width:295px"></td>                    
                    </tr>
                    </form>
                    <tr height="35px">
                    <td colspan="5"></td>
                                      
                    </tr>
                    <form id="myform13"  method="post"> 
                    <input type="hidden" name="pt_id1" value="Testing">
                    <tr style="font-weight:bold">
                    <td colspan="4" style="padding-left:5px">Requesting Physician Signature:</td>
                    
                    <td style="padding-left:5px">Date: <input type="text" placeholder="MM-DD-YYYY" align="left"  name="t_six" value="Testing" id="t_six" style="width:183px"> 
                    <input type="button" form="form1" value="Submit" onClick="store_t_one();"></button> </td>                                      
                    </tr>
                    </form>
                    
                    <tr style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                    <td colspan="5" style="padding-left:5px">Claims Administrator/Utilization Review Organization (URO) Response</td>
                                                        
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
                    </tr>                   
                                        
                    </table>
                             

					</div>    
					</div>
					</div>
        <div class="col-1 mt-4"></div>
    </div>
@endsection
