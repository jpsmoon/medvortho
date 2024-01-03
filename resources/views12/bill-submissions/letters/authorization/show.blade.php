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
                                <h2 class="heading"> Show Referring and Ordering Providers</h2>
                            </div>
                            @if($pInjuries)
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/injury/view', $pInjuries['id']) }}"> Back</a>
                                </li>
                            </ol>
                           @endIf 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    	<div class="demand" style="padding-left:25px; padding-right:25px;" id="exportContent"><br>
                        	<table width="900px">
                            <tr>
                            <td width="500px" align="left" >Progressive Orthopedic Solutions</td>
                            <td width="400" align="center" style="font-weight:bold">PROOF OF SERVICE</td>
                            </tr>
                            <tr>
                            <td width="500px" align="left" >Dept of Authorization/Case Management</td>
                            <td width="400" align="center" style="font-weight:bold">AUTHORIZATION REQUEST</td>
                            </tr>
                            
                            <tr>
                            <td colspan="2" >O: 562-777-9010, F: 562-777-9017</td>
                            </tr>
                            
                            <tr>
                            <td colspan="2"> <u>denise.zepeda@progressiveorthopedic.net</u></td>
                            </tr>                                                 
                            </table> 
                            
                            <div class="row">
                             <div class="col-md-12 col-sm-12 col-xs-12" id="exportContent">
                            <table width="900px">
                            <tr>
                            <td>
                            I, <b><u> Denise Zepeda,</u></b> am employed in the County of Los Angeles, State of California. I am over the age of 18, and not a party to the within action.  My business address is P.O. BOX 2906, Santa Fe Springs, California 90670. <td><br><br><br>
                            </tr>
                            
                            <tr>
                            <td>
                            On, <b> <u> <?php echo date('m/d/Y')?>,</u></b> I served the foregoing AUTHORIZATION REQUEST on the interested parties in this action by placing a true copy thereof, to be transmitted via facsimile, and addressed as follows: <td><br><br><br><br>
                            </tr>
                            
                            
                            <tr>
                            <td> # BY FAX: <td><br><br>
                            </tr>
                                                       
                           <tr>
                           <table width="900px">
                           <tr>
                           <td width="500px" align="left">
                           To:	<b>Testing</b>
                           </td>
                           <td width="400px" align="center">Fax: <b> Testing</b></td>
                           </tr>                       
                           </table> <br>                   
                           </tr>
                           
                           <tr>
                            <td>I am "readily familiar" with the firms practice of processing correspondence via fax.  Under that practice is it placed in the fax machine on the same day of the request and transmitted.  Confirmation receipt is printed and saved with the file.<td><br><br>
                            </tr>
                           
                           <tr>
                            <td>I declare under penalty of perjury under the laws of California that the foregoing is true and correct.<td><br><br>
                            </tr>
                            
                            <tr>
                            <td><font face="Kunstler Script" size="+3"><b><i><u> Denise Zepeda.</u></i></b></font><td>
                            </tr><br>
                            <tr>
                            <td>Signature<td>
                            </tr>                        
                            </table>                        
                            </div>         	
                            </div>
                            <hr>
                             
                            <table width="700px" align="center">
                            <tr>
                            <td> <b>To :</b><span style="padding-left:28px">Testing </span> </td>
                            <td> <b>From :</b> <span style="padding-left:23px">	Denise Zepeda </span></td>
                            </tr>
                            <tr>
                                <td colspan="2"><hr></td>
                            </tr>
                            
                            <tr>
                            <td><b>Fax :</b> <span style="padding-left:20px">Testing	</span> </td>
                            <td> <b>Pages :</b>	<span style="padding-left:32px">Testing</span> </td>
                            </tr>
                             <tr>
                                <td colspan="2"><hr></td>
                            </tr>
                            <tr>
                            <td><b>Phone :</b> <span style="padding-left:6px">	Testing </span> </td>
                            <td> <b>Date :</b> <span style="padding-left:32px">	Testing	</span> </td>
                            </tr>
                             <tr>
                            <td colspan="2"><hr></td>
                            </tr>
                            <tr>
                            <td><b>Name :</b> 	<span style="padding-left:9px"> Testing </span> </td>
                            <td><b> Claim #:</b> <span style="padding-left:14px">Testing </span></td>
                            </tr>
                            <tr>
                            <td colspan="2"><hr></td>
                            </tr>
                            <tr>
                            <td><b>DOI :</b> <span style="padding-left:20px"> Testing </span> </td>
                            <td><b>SX :</b>	<span style="padding-left:46px">Testing</span></td>
                            </tr>
                             <tr>
                             <td colspan="2"><hr></td>
                            </tr>
                             </table>
                             
                            <div>
                            I, <b> Denise Zepeda</b> am submitting for approval the following device(s) prescribed by <b> Testing </b> for home use to rehabilitate the above mentioned patient following a work related injury.  A prompt response regarding authorization is greatly appreciated.  Per California Labor Code 4610.g.1: <i>"Prospective or current decisions shall be made in a timely fashion that is appropriate for the nature of the employee's condition, not to exceed 5 working days from the receipt of the information reasonably necessary to make the determination, but in no event more than 14 days from the date of medical treatment recommendation by the physician. In cases where the review is retroactive, the decision shall be communicated to the individual who received services, or to the individual's designee, within 30 days of receipt of information that is reasonably necessary to make this determination."</i>  Progressive Orthopedic Solutions considers 5 working days to be sufficient time to make a decision regarding the approval or denial of stated DME. After 5 working days, if no decision has been communicated to Progressive Orthopedic Solutions, Progressive Orthopedic Solutions has the legal right and medical obligation to dispense the prescribed DME and not be denied for "self procured treatment" as the prescribed DME will be deemed approved.</div>
                           
                            <table width="900px" align="center">                            
                            <tr>
                            <td>
                           <input type="checkbox" class="largerCheckbox" name="checkBox"> <span style="vertical-align:top"> SURGICAL CASE- ACOEM DOES NOT APPLY.                         
                            </td>
                            
                            <td>
                            <input type="checkbox" class="largerCheckbox" name="checkBox"> <span style="vertical-align:top"> SURGICAL DME- Recommended per ODG.                         
                            </td>
                            </tr>
                                                    
                            <tr>
                            <td>
                            <input type="checkbox" class="largerCheckbox" name="checkBox"> <span style="vertical-align:top"> NON-SURGICAL DME- Recommended per ACOEM.                         
                            </td>
                            
                            <td>
                           <input type="checkbox" class="largerCheckbox" name="checkBox"> <span style="vertical-align:top"> NON-SURGICAL DME- Recommended per ODG.                         
                            </td>
                            </tr><br>                           
                            </table><br> 
                            <div><b>DME BEINGREQUESTED…</b></div><br> 
                            <div><b>TLSO-MED (L0464) PURCHASE </b></div><br> 
                            <div align="center"><img src="{{asset('new_assets/images/ear.jpg')}}">Progressive Orthopedic Solutions P.O BOX 2906 Santa Fe Springs, CA 90670</div><br> 
                        </div>
             		</div>
                  </div>
        
					</div>
					</div>
        <div class="col-1 mt-4"></div>
    </div>
@endsection
