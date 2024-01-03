<!-- @extends('layouts.home-app')-->
@section('content')
<style>
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
        margin:1cm 0.5cm;
        size: letter landscape;
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



<div class="row mt-2 mb-2">
        <div class="col-10 mx-auto" id="full-view">
                <!-- START: Breadcrumbs-->
                <div class="row">
                   <div class="col-12  align-self-center print-none">
                        <div class="sub-header py-3 px-2 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> SBR Letter</h2>
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
        <div class="demand Letter p-2" align="justify" id="exportContent">
             <div align="center"><span style="font-size:18px; font-family:Arial, Helvetica, sans-serif; font-weight:600; "> State of {{($state) ? $state->state_name : ''}} </span><br>
                <span style="font-size:18px; font-family:Arial, Helvetica, sans-serif; font-weight:600;">Division of Workers' Compensation </span><br>
                <span style="font-size:22px; font-family:Arial, Helvetica, sans-serif; font-weight:600;"> Provider's Request for Second Bill Review </span><br>
                <span style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:500;"> {{($injuryBillInfo && $injuryBillInfo->getInjury->patient) ?  $injuryBillInfo->getInjury->patient->state_id  : ''}} Code of Regulations, title 8, section 9792.5.6 </span><br><br></div> 					
					<div align="center" class="table-responsive">
                    	<div class="Section12">
                        <table class="table-bordered" id="full-view" >
                         <tr>
                         <td colspan="2" style="font-weight:bold; text-align:center; padding:10px;">The Medical Provider signing below seeks reconsideration of the denial and/or adjustment 
                        of the billed charges for the medical services or goods, or medical-legal services, provided to the injured employee.</td>
                                                
                         </tr> 
                         
                         <tr style=" background-color:#C6D9F1; font-size:16px; font-weight:600;">
                         <td colspan="2" style="padding-left:5px;"><h5>Employee Information</h5></td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px;">Employee Name (Last, First, Middle):<label class="label" name="patientname">
                             {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->first_name) ? $injuryBillInfo->getInjury->patient->first_name : ''}}
                             {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->last_name) ? $injuryBillInfo->getInjury->patient->last_name : ''}}
                         </label>
                         </td>
                         
                        </tr> 
                        
                        <tr style="background-color:#DDE4FF;">
                         <td width="450px" style="padding-left:5px;">Date of Birth (MM/DD/YYYY): <label class="label" name="dob">
                         {{ ($injuryBillInfo &&  $injuryBillInfo->getInjury &&  $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->dob) ? date('m-d-Y', strtotime($injuryBillInfo->getInjury->patient->dob)) : ''}}
                         </label></td>
                         <td width="450px" style="padding-left:5px;">Claim Number: <label class="label" name="claim_no">
                             {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->claim_no) ?  $injuryBillInfo->getInjury->getInjuryClaim->claim_no : 'NA' }}
                             </label></td>
                         </tr> 
                         
                          <tr style="background-color:#DDE4FF;">
                         <td width="450px" style="padding-left:5px">Date of Injury (MM/DD/YYYY): <label class="label" name="start_date">
                             {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim &&  $injuryBillInfo->getInjury->getInjuryClaim->start_date) ? date('m-d-Y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->start_date)) : 'NA' }}
                             </label></td>
                        <td width="450px" style="padding-left:5px">Employer Name: 
                            <label class="label" name="employer_name">
                            {{ ($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->employer_name) ? $injuryBillInfo->getInjury->getInjuryClaim->employer_name : 'NA' }}
                            </label>
                        </td>
                         </tr>
                         
                         
                         <tr style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                         <td colspan="2" style="padding-left:5px"><b>Provider Information</b></td>
                         
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Provider Name : <label class="label" name="patientname">
                             {{($injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider) ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_provider_name : 'NA' }}
                             </label></td>
                        <td width="450px" style="padding-left:5px">Contact Name: <label class="label" name="patientname">
                            {{($injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider && $injuryBillInfo->getInjury->patient->getBillingProvider->professional_telephone) ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_telephone : 'NA' }}
                        </label></td>
                         </tr>
                         
                         <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Address: <label class="label" name="patientname">
                             {{$injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres1 : 'NA' }}-
                         {{$injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_addres2 : 'NA' }}
                         </label></td>
                         <td width="45px" style="padding-left:5px">City : <label class="label" name="patientname">
                             {{ ($injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider && $injuryBillInfo->getInjury->patient->getBillingProvider->professional_city)  ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_city : 'NA' }}
                             </label></td>
                         </tr>
                         
                         <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">State: <label class="label" name="patientname">
                             {{$injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_state : 'NA' }}
                         </label></td>
                        <td width="450px" style="padding-left:5px">Zip Code : <label class="label" name="patientname">
                            {{$injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_zip : 'NA' }}
                        </label></td>
                         </tr>
                         
                         <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Phone : <label class="label" name="patientname">
                             {{ ($injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider) ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_telephone : 'NA' }}
                         </label></td>
                         <td width="450px" style="padding-left:5px">Fax Number: <label class="label" name="patientname">
                             {{ ($injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider) ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_fax_number : 'NA' }}
                         </label></td>
                         </tr>
                         
                          <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">E-mail Address : <label class="label" name="patientname">
                             
                         </label></td>
                        <td width="450px" style="padding-left:5px">NPI Number: <label class="label" name="patientname">
                            {{ ($injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider) ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_npi : 'NA' }}
                        </label></td>
                         </tr>
                         
                         
                         <tr style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                         <td colspan="2" style="padding-left:5px"><b>Claims Administrator Information</b></td>
                         
                         </tr> 
                         
                          <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Claims Administrator Name : <label class="label" name="patientname"> 
                         {{ ($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin &&  $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin ) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : 'NA' }}
                         </label></td>
                        <td width="450px" style="padding-left:5px">Contact Name: 
                            <label class="label" name="claimReviewContactNumber">
                            {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->contact_no) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->contact_no : 'NA' }}
                            </label>
                            </td>
                         </tr>
                         
                        <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">Address: <label class="label" name="patientname">
                              {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->address_line1) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->address_line1 : 'NA' }}
                              {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->address_line2) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->address_line2 : 'NA' }}
                             </label></td>
                        
                         </tr> 
                         <tr style="background-color:#DDE4FF">
                              <td width="500px" style="padding-left:5px">Phone : 
                                 <label class="label" name="phoneNumber">
                                     {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->contact_no) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->contact_no : 'NA' }}
                                 </label>
                             </td>
                             <td width="450px" style="padding-left:5px"></td>
                         </tr>
                         
                         <tr style="background-color:#DDE4FF">
                          <td width="450px" style="padding-left:5px">Fax Number: <label class="label" name="faxNumber">
                              {{($injuryBillInfo && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin  && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->fax_no) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->claimReview->fax_no : 'NA' }}
                              </label></td>
                          <td width="450px" style="padding-left:5px"></td>
                        </tr>
                         
                         <tr colspan="2" style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                         <td colspan="2" style="padding-left:5px"><b>Bill Information</b></td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">Provider's or Claims Administrator's Bill Identification Number (if any):
                         {{($injuryBillInfo && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider && $injuryBillInfo->getInjury->patient->getBillingProvider->professional_telephone) ? $injuryBillInfo->getInjury->patient->getBillingProvider->professional_telephone : 'NA' }}
                         </td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">Date Explanation of Review Received by Provider :Testing
                         </td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">List of disputed services or goods (attach additional pages if necessary):</td>
                         </tr> 
                         
                         <tr>
                         <td colspan="2" style="padding-left:5px">Reason for Requesting Second Bill Review and Description of Supporting Documentation:</td>
                         </tr> 
                         
                         <tr>
                           <td colspan="2" style="padding:0px;">
                           <table width="100%" border="0" class="no-bordered">
                           <form id="myform" action="#"  method="post">
                         <input type="hidden" name="redirectId" value="Testing">
                           <input type="hidden" name="item_id[]" value="Testing">
                    
                         <tr>
                         <td align="center">Date of Service</td>
                         <td align="center">Service/Good in Dispute (include modifier, if any)</td>
                         <td align="center">Service/Good Authorized?</td>
                         <td align="center">Amount Billed</td>
                         <td align="center">Amount Paid</td>
                         <td align="center">Amount in Dispute</td>
                         <td align="center">Supporting Documentation Attached?</td>
                         </tr>
                         
                         <tr height="40px" style="background-color:#DDE4FF">   
                         <td align="center">Testing</td>
                         <td align="center">Testing</td>
                         <td align="center"><input type="checkbox" class="product-list" name="yes" placeholder="yes" style="width:17px;height:17px;"> Yes 
                         <input type="checkbox" class="product-list" name="no" placeholder="no" style="width:17px;height:17px;"> No</td>
                         <td align="center">Testing</td>
                         
                         <td><input type="text" name="paid_amount[]" placeholder="Testing" id="t_one_Testing" style="width:100px;height: 40px; text-align:center"></td>
                         <td align="center"><input type="text" name="dispute_amount[]" placeholder="Testing" id="t_one_Testing" style="width:100px;height: 40px; text-align:center"></td>
                         <td align="center"><input type="checkbox" class="product-list" name="skill" placeholder="yes"  style="width:17px;height:17px;"> Yes 
                         <input type="checkbox" class="product-list" name="skill" placeholder="no"  style="width:17px;height:17px;"> No</td>
                         </tr>
                         
                         <tr>
                         <td align="center" colspan="7">Reason for Requesting Second Bill Review and Description of Supporting Documentation:s</td>
                         </tr>
                         <tr height="80px" style="background-color:#DDE4FF">
                         <td colspan="7" style="width:100%; padding:0.5em"><input type="text" name="bill_reason[]" placeholder="Testing" id="t_one_Testing" style="width:100%; height:80px;"> </td>
                         </tr>
                                                 
                         <tr style="background-color:#C6D9F1;">
                             <td colspan="7" style="padding:0; border:0px solid #2a3f54">
                                 <table height="50px" border="0" width="100%" cellpadding="0" cellspacing="0">
                                     <tr>
                                         <td align="center" style="border-right:1px solid #2a3f54; width:50%;"><b>Provider Signature:</b></td>
                                         <td align="center" style="width:50%;"><b>Date:</b></td>
                                     </tr>
                                 </table>
                             </td>
                         
                         </tr>
                         </table>
                         </tr>
                         </table>
                         <div class="mt-2 mb-2 text-center"><input type="submit" name="sendDatafrm" class="btn btn-primary" value="Submit"></div>
                         </div>
                         
                        
                        </form>
                           </td>
                        </tr>
					</div>
					</div> 
					</div>
					</div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script type="application/javascript">
    function demo2HtmlPdf()
    {
    
    var doc = new jsPDF();
    var specialElementHandlers = {
       /* '#editor': function (element, renderer) {
            return true;
        }*/
    };
    
    //$('#htmlToPdf').click(function () {   
        doc.fromHTML($('#exportContent').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
    	var f1= Date.now();
    	var fileName='meraky_'+f1+".pdf"
        doc.save(fileName);
    //});
    }
    
    function genratePrint()
    {
    	var divContents = $("#exportContent").html();
                var printWindow = window.open('', '', 'height=400,width=800');
                printWindow.document.write('<html><head><title>Print Div</title>');
                printWindow.document.write('</head><body >');
                printWindow.document.write(divContents);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
    }

</script>
<script>
	
function saveDoc(filename = '') {
  if (!window.Blob) {
    alert('Your legacy browser does not support this action.');
    return;
  }

  var html, link, blob, url, css;

  // EU A4 use: size: 841.95pt 595.35pt;
  // US Letter use: size:11.0in 8.5in;

  
var preHtml = "";
	preHtml="<html " + "xmlns:o='urn:schemas-microsoft-com:office:office' " +
                       "xmlns:w='urn:schemas-microsoft-com:office:word'" +
                       "xmlns='http://www.w3.org/TR/REC-html40'>" +
                       "<head><title><?php //echo $patientlist['patient_name'];?></title>";

       preHtml+= "<!--[if gte mso 9]>" +
                                        "<xml>" +
                                        "<w:WordDocument>" +
                                        "<w:View>Print</w:View>" +
                                        "<w:Zoom>100</w:Zoom>" +
                                        "<w:DoNotOptimizeForBrowser/>" +
                                        "</w:WordDocument>" +
                                        "</xml>" +
                                        "<![endif]-->";
	 preHtml+="<style>" +
										 
                                     "<!-- /* Style Definitions */" +
                                     "p.MsoFooter, li.MsoFooter, div.MsoFooter" +
                                     "{margin:0in;" +
                                     "margin-bottom:.0001pt;" +
                                     "mso-pagination:widow-orphan;" +
                                     "tab-stops:center 3.0in right 6.0in;" +
                                     "font-size:12.0pt;}" +
                                     "p.MsoHeader, li.MsoHeader, div.MsoHeader" +
                                     "{margin:0in;" +
                                     "margin-bottom:.0001pt;" +
                                     "mso-pagination:widow-orphan;" +
                                     "tab-stops:center 3.0in right 6.0in;" +
                                     "font-size:10.0pt;}";


      								 preHtml+="@page Section1" +
                                       "   {size:8.7in 12.9in; " +
                                       "   margin:0.3in 0.3in 0.3in 0.3in ; " +
                                       "   mso-header: h1;" +
                                       "   mso-header-margin:0.0in; " +
                                       "   mso-footer: f1;" +
                                       "   mso-footer-margin:0.0in; mso-paper-source:0;}" +
                                       " div.Section1" +
                                       "   {page:Section1;" +
       "font-size:12.0pt;font-family:Times New Roman;mso-fareast-font-family:Times New Roman" +
                                        " }" +
										
										" div.Section12" +
                                       "   {page:Section12;" +
       "background-color: #C6D9F1 ;" +
                                        " }" +
										
										" div.table-responsive" +
                                       "   {page:table-responsive;" +
       									"background-color: #C6D9F1;" +
                                        " }" +
										" table" + "   {table" +"background-color: #C6D9F1 ; " +
                                        " }" +
										" table td" + "  {page:Section1;" +"height:25px; border:1px  #000  solid !important;" +
                                        " }" +
										"td, th " + "   { padding: 0px !important; margin: 0px !important;"+" }"+
										
										
                                       "-->" +
                                      "</style></head>";
									  
  var rightAligned = document.getElementsByClassName("sm-align-right");
  for (var i=0, max=rightAligned.length; i < max; i++) {
    rightAligned[i].style = "text-align: right;"
  }

  var centerAligned = document.getElementsByClassName("sm-align-center");
  for (var i=0, max=centerAligned.length; i < max; i++) {
    centerAligned[i].style = "text-align: center;"
  }

  html = document.getElementById('exportContent').innerHTML;
 
									
  html = '\
  <body lang=RU-ru style="tab-interval:.5in">\
    <div class="Section1">' + html + '</div>\
  </body>\
  </html>'

  blob = new Blob(['\ufeff', preHtml + html], {
    type: 'application/msword'
  });
  
  url = URL.createObjectURL(blob);
  link = document.createElement('A');
  link.href = url;
  
	// Specify file name
	var f1= Date.now();
    //filename = filename?filename+"_"+f1+'.doc':'document.doc';
	filename = "sbr_demand_letter"+f1+'.doc';
	
  //filename = 'filename';
  
  // Set default file name.
  // Word will append file extension - do not add an extension here.
  link.download = filename;   
  
  document.body.appendChild(link);
  
  if (navigator.msSaveOrOpenBlob) {
    navigator.msSaveOrOpenBlob( blob, filename); // IE10-11
  } else {
    link.click(); // other browsers
  }

  document.body.removeChild(link);
};

function sendData()
{
	//$("#myform").submit();
}
 
$( document ).ready(function() {
    $('.product-list').click(function() {
        $(this).siblings('input:checkbox').prop('checked', false);
    });
});
</script>
