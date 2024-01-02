<!-- @extends('layouts.home-new-app')-->
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
                                    <a class="btn btn-primary" href="#" target="_blank"> PDF</a>
                                </li>
                                <li class="breadcrumb-item" onclick="saveDoc();">
                                   <a class="btn btn-primary" href="#" target="_blank"> DOC</a>
                                </li>
                                <li class="breadcrumb-item" onClick="genratePrint();">
                                   <a class="btn btn-primary" href="#" target="_blank"> PRINT</a>
                                </li> 
                                <li class="breadcrumb-item">
                                    @if($pInjuries && $pInjuries->id)
                                    <a class="btn btn-primary" href="{{ url('/injury/view', $pInjuries->id) }}"> Back</a>
                                    @else
                                    <a class="btn btn-primary" href="javascript:void(0)"> Back</a>
                                    @endif
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs--> 
        <div class="demand" align="justify" id="exportContent">
             <div align="center"><span style="font-size:18px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> State of {{($pInjuries && $pInjuries->patient) ? strtoupper( substr( $pInjuries->patient->state_id, 0, 2 ) ) : ''}} </span><br>
                <span style="font-size:18px; font-family:Arial, Helvetica, sans-serif; font-weight:600";>Division of Workers' Compensation </span><br>
                <span style="font-size:22px; font-family:Arial, Helvetica, sans-serif; font-weight:600";> Provider's Request for Second Bill Review </span><br>
                <span style="font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:500";> {{($pInjuries && $pInjuries->patient) ?  $pInjuries->patient->state_id  : ''}} Code of Regulations, title 8, section 9792.5.6 </span><br><br></div> 					
					<div align="center" class="table-responsive">
                    	<div class="Section12">
                        <table class="table-bordered">
                         <tr>
                         <td colspan="2" style="font-weight:bold; text-align:center;">The Medical Provider signing below seeks reconsideration of the denial and/or adjustment 
                        of the billed charges for the medical services or goods, or medical-legal services, provided to the injured employee.</td>
                                                
                         </tr> 
                         
                         <tr style=" background-color:#C6D9F1; font-size:16px; font-weight:600;">
                         <td colspan="2" style="padding-left:5px">Employee Information</td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">Employee Name (Last, First, Middle):<label class="label" name="patientname">Testing</label>
                         </td>
                         
                        </tr> 
                        
                        <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Date of Birth (MM/DD/YYYY): <label class="label" name="patientname">Testing</label></td>
                         <td width="450px" style="padding-left:5px">Claim Number: <label class="label" name="patientname">Testing</label></td>
                         </tr> 
                         
                          <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Date of Injury (MM/DD/YYYY): <label class="label" name="patientname">Testing</label></td>
                        <td width="450px" style="padding-left:5px">Employer Name: <label class="label" name="patientname">{{ $pInjuries->getInjuryClaim->employer_name ? $pInjuries->getInjuryClaim->employer_name : 'NA' }}</label></td>
                         </tr>
                         
                         
                         <tr style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                         <td colspan="2" style="padding-left:5px">Provider Information</td>
                         
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Provider Name : <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_provider_name : 'NA' }}</label></td>
                        <td width="450px" style="padding-left:5px">Contact Name: <label class="label" name="patientname">Testing</label></td>
                         </tr>
                         
                         <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Address: <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_addres1 : 'NA' }}-
                         {{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_addres2 : 'NA' }}</label></td>
                         <td width="45px" style="padding-left:5px">City : <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_city : 'NA' }}</label></td>
                         </tr>
                         
                         <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">State: <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_state : 'NA' }}</label></td>
                        <td width="450px" style="padding-left:5px">Zip Code : <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_zip : 'NA' }}</label></td>
                         </tr>
                         
                         <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Phone : <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_telephone : 'NA' }}</label></td>
                         <td width="450px" style="padding-left:5px">Fax Number: <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_fax_number : 'NA' }}</label></td>
                         </tr>
                         
                          <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">E-mail Address : <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_fax_number : 'NA' }}</label></td>
                        <td width="450px" style="padding-left:5px">NPI Number: <label class="label" name="patientname">{{$pInjuries->patient && $pInjuries->patient->getBillingProvider ? $pInjuries->patient->getBillingProvider->professional_npi : 'NA' }}</label></td>
                         </tr>
                         
                         
                         <tr style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                         <td colspan="2" style="padding-left:5px">Claims Administrator Information</td>
                         
                         </tr> 
                         
                          <tr style="background-color:#DDE4FF">
                         <td width="450px" style="padding-left:5px">Claims Administrator Name : <label class="label" name="patientname"> {{ $pInjuries->getInjuryClaim->getClaimAdmin ? $pInjuries->getInjuryClaim->getClaimAdmin->name : 'NA' }}</label></td>
                        <td width="450px" style="padding-left:5px">Contact Name: <label class="label" name="patientname">{{$pInjuries && $pInjuries->getInjuryClaim->getClaimAdmin &&  $pInjuries->getInjuryClaim->getClaimAdmin->claimReview ? $pInjuries->getInjuryClaim->getClaimAdmin->claimReview->contact_no : 'NA' }}</label></td>
                         </tr>
                         
                        <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">Address: <label class="label" name="patientname">{{$pInjuries && $pInjuries->getInjuryClaim->getClaimAdmin &&  $pInjuries->getInjuryClaim->getClaimAdmin->claimReview ? $pInjuries->getInjuryClaim->getClaimAdmin->claimReview->address_line1 : 'NA' }}</label></td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                          <td width="450px" style="padding-left:5px">Fax Number: <label class="label" name="patientname">{{$pInjuries && $pInjuries->getInjuryClaim->getClaimAdmin &&  $pInjuries->getInjuryClaim->getClaimAdmin->claimReview ? $pInjuries->getInjuryClaim->getClaimAdmin->claimReview->fax_no : 'NA' }}</label></td>
                          <td width="450px" style="padding-left:5px"></td>
                        </tr>
                         
                         <tr colspan="2" style="background-color:#C6D9F1; font-size:16px; font-weight:600">
                         <td colspan="2" style="padding-left:5px">Bill Information</td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">Provider's or Claims Administrator's Bill Identification Number (if any):</td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">Date Explanation of Review Received by Provider :</td>
                        
                         </tr> 
                         
                         <tr style="background-color:#DDE4FF">
                         <td colspan="2" style="padding-left:5px">List of disputed services or goods (attach additional pages if necessary):</td>
                         </tr> 
                         
                         <tr>
                         <td colspan="2" style="padding-left:5px">Reason for Requesting Second Bill Review and Description of Supporting Documentation:</td>
                         </tr> 
                         
                         <tr >
                         <table width="910px" border="1" bordercolor="#000000" style="border-bottom-style:outset">
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
                         <td align="center"><input type="checkbox" class="product-list" name="yes" value="yes" style="width:17px;height:17px;"> Yes 
                         <input type="checkbox" class="product-list" name="no" value="no" style="width:17px;height:17px;"> No</td>
                         <td align="center">Testing</td>
                         
                         <td><input type="text" name="paid_amount[]" value="Testing" id="t_one_Testing" style="width:100px;height: 40px; text-align:center"></td>
                         <td align="center"><input type="text" name="dispute_amount[]" value="Testing" id="t_one_Testing" style="width:100px;height: 40px; text-align:center"></td>
                         <td align="center"><input type="checkbox" class="product-list" name="skill" value="yes"  style="width:17px;height:17px;"> Yes 
                         <input type="checkbox" class="product-list" name="skill" value="no"  style="width:17px;height:17px;"> No</td>
                         </tr>
                         
                         <tr>
                         <td align="center" colspan="7">Reason for Requesting Second Bill Review and Description of Supporting Documentation:s</td>
                         </tr>
                         
                         <tr height="80px" style="background-color:#DDE4FF">
                         <td colspan="7" style="width:100%"><input type="text" name="bill_reason[]" value="Testing" id="t_one_Testing" style="width:100%;height:80px;"> </td>
                         </tr>
                                                 
                         <tr height="50px">
                         <td align="center" colspan="3.5">Provider Signature:</td>
                         <td align="center" colspan="4">Date:</td>
                         </tr>
                         
                         </table>
                                                 
                         </tr>
                                                  
                         </table>
                         <div align="center"><input type="submit" name="sendDatafrm" value="Submit" style="background-color:#00F; color:#FF0"></div>
                         </div>
                        
                        </form>
					</div>
					</div> 
					</div>
					</div>
        <div class="col-1 mt-4"></div>
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
