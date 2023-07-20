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
                                <h2 class="heading"> Demand Letter</h2>
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

                <div class="card-body" style="padding-left: 50px;">
                  
                 <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    
                    	<div class="demand" align="justify" id="exportContent">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                            	<div align="center">
                    			<font face="Times New Roman, Times, serif"; !important; size="+3">Edwin Haronian, M.D. Inc. </font> 
                    			</div>
                          </div>
                    	</div>   
                        <div class="row" align="center">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                         
                       <font face="Times New Roman, Times, serif"; !important; size="+0">PO Box 261130, Encino CA, 91426 </font><br> 
                      <font face="Times New Roman, Times, serif"; !important; size="+0">Tax ID# 95-4858916 </font><br></div>
                     </div><br>               	
                 
                 
                    <table style="font-family:Calibri; font-size:13px">
                        <tr><?php echo date('m/d/Y')?></tr><br><br>
                        <tr>
                        <td>Patient</td><td style="padding-left:10px">:</td>
                        <td style="padding-left:10px">{{($pInjuries && $pInjuries->patient) ? $pInjuries->patient->first_name : 'NA'}}</td>
                        </tr>
                        
                        <tr>
                        <td>Our File #</td><td style="padding-left:10px">:</td>
                        <td style="padding-left:10px">{{($pInjuries && $pInjuries->patient) ? $pInjuries->patient_no : 'NA'}}</td>
                        </tr>
                        
                        <tr>
                        <td>DOI</td><td style="padding-left:10px">:</td>
                        <td style="padding-left:10px">{{($pInjuries && $pInjuries->getInjuryClaim && $pInjuries->getInjuryClaim->start_date) ? date('m-d-Y', strtotime($pInjuries->getInjuryClaim->start_date)) : 'NA'}}</td>
                        </tr>
                        
                        <tr>
                        <td>Insurance</td><td style="padding-left:10px">:</td>
                        <td style="padding-left:10px">Testing</td>
                        </tr>
                        
                        <tr>
                        <td>Claim No #</td><td style="padding-left:10px">:</td>
                        <td style="padding-left:10px">{{($pInjuries && $pInjuries->getInjuryClaim && $pInjuries->getInjuryClaim->claim_no) ?  $pInjuries->getInjuryClaim->claim_no : 'NA'}}</td>
                        </tr>
                        
                        <tr>
                        <td>WCAB #</td><td style="padding-left:10px">:</td>
                        <td style="padding-left:10px">Testing</td>
                        </tr>
          
                </table><br>
           
                            
           <table style="font-family:Calibri; font-size:13px">     
            <tr>
            <td>Date of Services (Range)</td><td style="padding-left:10px">:</td>
            <td style="padding-left:10px">Testing</td>
            </tr>     
                           
               
             <tr>
            <td>Total Bill Amount</td><td style="padding-left:10px">:</td>
            <td style="padding-left:10px"> Testing</td>
            </tr>      
                    
            <tr>
            <td>Total Payment Received </td><td style="padding-left:10px">:</td>
            <td style="padding-left:10px"> Testing</td>
            </tr>    
                    
            <tr>
            <td>Outstanding Balance </td><td style="padding-left:10px">:</td>
            <td style="padding-left:10px"> Testing</td>
            </tr>    
            
            <tr>
            <td>Settlement Demand </td><td style="padding-left:10px">:</td>
            <td style="padding-left:10px"> Testing</td>
            </tr>      
            
           </table><br>   
             
					<div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div> Dear Sir/Madam, :</div><br>
Pursuant to SB863 we would like to come to terms and resolve the outstanding balance for the above settlement demand within the next 10 days. <b> Enclosed please find a detailed account statement. </b><br><br>
<p style="color:#33F;"> <b>•</b> &nbsp;&nbsp; Lien settlement amount includes the lien filing fee and encompasses all dates of service known or <br>&nbsp;&nbsp;&nbsp;&nbsp; should be known through date of settlement execution. Settlement is for "new money" and in <br> &nbsp;&nbsp;&nbsp;&nbsp; addition to  any payments previously paid on this account.<br>
<b>•</b> &nbsp;&nbsp; This settlement agreement is in full and final satisfaction of all outstanding dates of service. </span><br>
<b>•</b> &nbsp;&nbsp; Payment shall be received within 30 days of settlement agreement waiving penalties and interest. </span><br>
<b>•</b> &nbsp;&nbsp;<i><b> When serving documents upon Lien Claimant our office is requesting to be served by way of <br> &nbsp;&nbsp;&nbsp;&nbsp; 
paper since CD-Rom and USB have the potentional to contain viruses.</b></i> </span></p>

Please make checks payable and mail to:<br>
<h4 align="center">EDWIN HARONIAN M.D.<br>
PO Box 261130<br>
Encino, CA 91426<br>
Tax ID # 95-4858916<br></h4>

Please sign, and return to <b>Fax (818) 252-7802.</b><br>
Thank you for your time and consideration,<br><br>

<i><b> SYNAPSE ORTHOPEDIC GROUP / SYNAPSE LIEN UNIT </b></i><br>
Billing & Collections Team<br>
(818) 788-2400 option 6<br><br><br>


---------------------------------------------------- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-------------------------------------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -------------------------------------------<br>
&nbsp;&nbsp; &nbsp;&nbsp;Law Firm / Claims Examiner name	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Signature	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			       Date <br><br><br>

** <font size="-1"> Edwin Haronian MD asserts the right to rescind this settlement offer if the matter proceeds to any lien hearing.</font>
</div>
                    </div>
                    </div> 
                    
					</div>
                    </div>
                  
                </div>
            </div>
        </div>
        <div class="col-1 mt-4"></div>
    </div>
@endsection
