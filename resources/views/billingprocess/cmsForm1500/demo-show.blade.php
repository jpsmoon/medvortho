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
</style>

@section('content')
    <div style="background-color: 484C4E;"><button type="button" id="cmdPdfBtn">Print Pdf </button></div>
    <div class="row" style="background-color: 484C4E;">
        <div class="col-10 mt-4" id="pageContent">
            <div class="card row-background">
                
                        <div class="card-body pdfContentDiv" style="display: flex; padding-left:10%; padding-right:10%" id="pdfContentDiv_1">
                            <div id="loadingForm" class="showImgaeInBack"><br><br><br><br>
                                <table width="1150px" id="tdcontent">
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td width="700px" style="padding-top:25px"></td>
                                                    <td>Sedgwick Claims Management Services</td>
                                                </tr>
                                                <tr>
                                                    <td width="700px"></td>
                                                    <td>Submitted Electronically via Data Dimensions</td>
                                                </tr>
                                                <tr>
                                                    <td width="700px"></td>
                                                    <td>(Payer ID: CB280)</td>
                                                </tr>
                                                <tr>
                                                    <td width="660px"></td>
                                                    <td style="padding-left:160px">CMS1500 Page 1 of 1</td>
                                                </tr>
                                                <tr>
                                                    <td width="660px"></td>
                                                    <td style="padding-top:32px; padding-left:6px">
                                                        Dummy S S no</td>
                                                </tr>
                                            </table>
                                        </td>

                                    </tr>
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="430px"><table><tr><td style="padding-top:15px; padding-left:48px">Dummy Patient Name
                                                    </td></tr></table></td>
                                                    
                                                    <td valign="top" width="270px"><table><tr>
                                                    <td style="padding-top:19px; padding-left:21px">01</td> <td style="padding-top:19px; padding-left:23px">01</td><td style="padding-top:19px; padding-left:33px">{{date('Y')}}</td><td style="padding-top:19px; padding-left:30px">X</td></tr></table></td>
                                                    
                                                    <td valign="top" width="405px" ><table><tr><td></td></tr></table></td>
                                                    
                                                </tr>  
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    
                                    
                                    <tr>
                                        <td valign="top">
                                            <table>
                                                <tr>
                                                    <td valign="top" width="430px"><table><tr><td style="padding-top:15px; padding-left:48px">Patient Address</td></tr></table></td>
                                                    
                                                    
                                                    <td valign="top" width="270px"><table><tr>
                                                        <td style="padding-top:19px; padding-left:21px"></td> <td style="padding-top:19px; padding-left:23px"></td><td style="padding-top:19px; padding-left:33px"></td><td style="padding-top:13px; padding-left:146px">X</td></tr></table></td>
                                                
                                                    <td valign="top" width="405px" ><table><tr><td></td></tr></table></td>
                                                    
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
                                                                <td style="padding-top:10px; padding-left:48px; width: 329px;">Patient City</td>
                                                                <td style="padding-top:10px; padding-left:5px;">Patient State </td>
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
                                                    <td valign="top" width="430px">
                                                        <table>
                                                            <tr>
                                                                <td style="padding-top:15px; padding-left:48px; width:329px;">Patient Zipcode</td>
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
                                                    <td width="275px" style="padding-top:21px; padding-left:76px">X</td>
                                                    <td width="420px"></td>
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
                                                    <td width="420px" style="padding-top:22px; padding-left:7px">Y4  Claim No</td>
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
                                                    <td width="425px" style="padding-top:26px"><span style="padding-left:63px">Injury Month</span><span style="padding-left:26px">Injury Date</span><span style="padding-left:35px">{{ date('Y') }}</span></td>
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
                                                    <td width="425px"></td>
                                                    <td width="275px"></td>
                                                    <td width="420px"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>
                                            <span style="padding-left: 45%;">&nbsp;</span>
                                            <span style="padding-left:78px;">0</span>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td valign="top" style="height:65px">
                                        <table>
                                           Bill Diagnosis Code Numbers
                                        </table>
                                        </td>
                                    </tr>
                                    
                                            <tr valign="top">
                                                <td style="padding-left: 4%;" colspan="6">
                                                    <div class="row"> 
                                                        <div class="column">&nbsp;</div>
                                                        <div class="column" style="text-align: right;padding-right: 10%;"> <span style="padding-right:13px"> ZZ </span>1063480192
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                    <div class="column">
                                                            <span style="padding-left:8px">{{ '03' }}</span> 
                                                            <span style="padding-left:19px">{{ '20' }}</span>
                                                            <span style="padding-left:21px">{{ date('Y') }} </span>
                                                            <span style="padding-left:20px">{{ '03' }}</span>
                                                            <span style="padding-left:18px">{{ '20' }}</span> 
                                                            <span style="padding-left:22px">{{ date('Y') }}</span>
                                                            <span style="padding-left:22px">{{ $placeOfService }}</span>
                                                    </div>
                                                    <div class="column">
                                                            <span> Bill Procedure Code</span>
                                                            <span style="padding-left: 5%;">Modifier</span>
                                                            <span style="padding-left: 43">  </span>
                                                    </div>
                                                    <div class="column">
                                                        <span style="padding-left: 5%;">Bill Amount</span>
                                                            <span style="padding-left: 5%;">Bill Units</span>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                   <tr valign="top"> <td colspan="6" style=" height: 315px; ">&nbsp; </td> </tr>
                                    <tr>
                                        <td valign="top">
                                            <table height="40px">
                                                <tr>
                                                    <td width="335px" valign="top"style="padding-top:17px">
                                                     <span style="padding-left: 50px;">Tax Id</span>   
                                                    </td>

                                                    <td width="360px" valign="top" style="padding-top:17px"> <span style="padding-left: 10px;">477db9122800-1</span></td>

                                                    <td width="420px" valign="top" style="padding-top:17px;"> <span style="padding-left:53%">Total Charge</span></td>
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
                                                                    <span style="padding-left:50px"> Billing Provider Name</span>
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
                                                                    {{ $placeOfService }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size:14px !important; padding-left:8px;">
                                                                   Address Line1 
                                                                   Address Line2
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="font-size:14px !important; padding-left:8px;">
                                                                    {{ $stateId }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="padding-top:11px; font-size:14px !important; padding-left:10px;">  </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="420px" valign="top">
                                                        <table style="padding-top:0px; heigth:100px;">
                                                           
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
       generatePDFPage(1 );
        setTimeout(function(){ history.back(1); }, 2000); 
    });
function getPdfInfo(){
    var pdf = new jsPDF('p', 'px', [800, 800],true);
    var pdfArray = 1;
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