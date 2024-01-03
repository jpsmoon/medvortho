<?php

namespace App\Http\Controllers;

use App\Models\{BillTempDocForSendPacket, SentBill, ProviderBillingTemplateServiceItem, ProviderBillingTemplate, Status, AllDocument, State, InjuryContact, MasterDataLog, Service_code, ReportType, BillingProviderCharge, BillingProviderChargeProcedureCode,
    BillingProvider,BillModifier,ClaimAdministrator,ClaimStatus,Country,Health_provider,InjuryBill,InjuryBillService,InjuryDiagnosis,
    MasterPlaceOfService,MedicalProvider,ModifierCode,Patient,PatientAppointment,Patient_injury,ProcedureCode, RenderinProvider, BillReferingOrderProvider, Diagnosis_code,BillCoverSheetCmsForm
    };
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session; 
    use Toastr;
    use DB;
    use Illuminate\Support\Facades\Auth;
    use PDF;
    use Maatwebsite\Excel\Facades\Excel;
    use App\Exports\BillSendDownloadPDFExport;
    use App\Exports\BillCMSExport;
    //use PDFMerger;
    use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
    use Illuminate\Support\Facades\File;
    use setasign\Fpdi\Fpdi;
    use Redirect; 
    use Illuminate\Support\Facades\Response;
    


class PdfMergerController extends Controller
{
    //
    

     
   
      public function showCover(Request $request){
         $isExistBill = InjuryBill::where('id', $request->bill_id)->first();
         $coversheetNAme = 'cover_sheet_'.time().'.'. 'pdf';
        $path_to_file_CMS = public_path('bills/tempBillPacket/'.$coversheetNAme);
        $customPaper = array(10, 0,1200,1300);
        $pdfCMS = PDF::loadView('patients.injury.bills.exports.index',  compact('isExistBill'))->setPaper($customPaper, 'landscape');
       // return $pdfCMS->download('coversheet.pdf');
        return view('patients.injury.bills.exports.index', compact(['isExistBill'])); 
    }
    public function generateCMSForPacket(Request $request){
        if($request->bill_id){
            $isExistBill = InjuryBill::where('id', $request->bill_id)->first();
            if($isExistBill){
                $tempPacketPath = public_path('bills/tempBillPacket');
                $cms1500NAme = 'cms_1500_'.time().'.'. 'pdf'; 
                $coversheetNAme = 'cover_sheet_'.time().'.'. 'pdf';
                $customPaper = array(10, 0,1200,1000);
                $path_to_file = public_path('bills/tempBillPacket/'.$coversheetNAme);
                $path_to_file_CMS = public_path('bills/tempBillPacket/'.$cms1500NAme);
                
                 if (!is_dir($tempPacketPath)) {
                     mkdir($tempPacketPath, 0755, true);
                 }
                 $pdf = PDF::loadView('patients.injury.bills.exports.index',  compact('isExistBill'))->setPaper($customPaper, 'landscape');
                 $checkCoverSheet = BillTempDocForSendPacket::where('temp_document_name', $coversheetNAme)->where('doc_type', 1)->where('bill_id', $isExistBill->id)->first();
                 if($checkCoverSheet){
                     if (File::exists($path_to_file)) { 
                         File::delete($path_to_file); 
                         $checkCoverSheet->delete(); 
                     } 
                 }
                 else{ 
                     if($pdf->save($path_to_file)){
                         $tempFIles = new BillTempDocForSendPacket();
                         $tempFIles->bill_id                 = $isExistBill->id;
                         $tempFIles->temp_document_name	    = $coversheetNAme;
                         $tempFIles->doc_type                 = 1;
                         $tempFIles->save();
                     }
                 }

                 $checkCMS = BillTempDocForSendPacket::where('temp_document_name', $cms1500NAme)->where('doc_type', 2)->where('bill_id', $isExistBill->id)->first();
                 if($checkCMS){
                     if (File::exists($path_to_file_CMS)) { 
                         File::delete($path_to_file_CMS); 
                         $checkCMS->delete(); 
                     } 
                 }
                 else{ 
                        if($request->file('pdf')){
                            $file                = $request->file('pdf');
                            $file->move($tempPacketPath, $cms1500NAme);
                            $tempFIles = new BillTempDocForSendPacket();
                            $tempFIles->bill_id                 = $isExistBill->id;
                            $tempFIles->temp_document_name	    = $cms1500NAme;
                            $tempFIles->doc_type                 = 2;
                            $tempFIles->save();
                        } 
                     }
            }
        }
    }
    
    public function getDayAndDate($bDate, $days){
        return $this->getTotalDayAndDate($bDate, $days);
    }
    public function downloadCoverSheet($billId){
        $isExistBill = InjuryBill::where('id', $billId)->first();
        $coversheetName = 'cover_sheet_' . time() . '.' . 'pdf';
        $pathToPDF = public_path('bills/tempBillPacket/' . $coversheetName);
        $customPaper = array(10, 0, 1200, 1300);
        $pdf = PDF::loadView('patients.injury.bills.exports.index', compact('isExistBill'))->setPaper($customPaper, 'landscape');

        // Save the PDF to the specified path
        $pdf->save($pathToPDF);

        // Generate a response to open the PDF in a new tab
        return response()->file($pathToPDF, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="coversheet.pdf"',
        ]);
   }
   public function showCMSFOrm(Request $request){
    $isExistBill = InjuryBill::where('id', $request->bill_id)->first();
    $injuryBillInfo =  $isExistBill; 
    $cms1500NAme = 'cms_1500_'.time().'.'. 'pdf'; 
    $path_to_file_CMS = public_path('bills/tempBillPacket/'.$cms1500NAme); 
    $customPaperCMS = array(10, 0,1400,1000);  
    $html = view('bill-submissions.letters.csm-1500.show', compact('injuryBillInfo'))->render(); 
    //return $pdfCMS = PDF::loadHTML($html)->setPaper('a4')->download($cms1500NAme); 
    return view('bill-submissions.letters.csm-1500.show', compact(['injuryBillInfo'])); 
 }
 public function billPacketForSendBill(Request $request){
       //try { 
          //DB::beginTransaction();
          $isExistBill = InjuryBill::where('id', $request->bill_id)->first();
          if(!$isExistBill){
            return $this->redirectToRoute(redirect()->back(), 'Bill does not exist', 'error', ["positionClass" => "toast-top-center"]);
          }
          else{
                if($isExistBill){
                    $tempPacketPath = public_path('bills/tempBillPacket');
                    if (!is_dir($tempPacketPath)) {
                        mkdir($tempPacketPath, 0755, true);
                    } 
                    $this->addBillLogs(null, $isExistBill->id, 'Download Bill Packet For', 'BILL_INFO', null);

                    //$pdf = PDF::loadView('patients.injury.bills.exports.index',  compact('isExistBill'))->setPaper($customPaper1, 'portrait'); 
                    //$pdf = PDF::loadView('patients.injury.bills.exports.index',  compact('isExistBill'))->setPaper('a4', 'portrait')->setWarnings(false);
                    //$pdf = PDF::loadView('patients.injury.bills.exports.index',  compact('isExistBill'))->setPaper($customPaper1, 'portrait'); 
                    // $pdf = PDF::loadView('patients.injury.bills.exports.index', compact('isExistBill'))
                    // // ->setOptions([
                    // //     'isHtml5ParserEnabled' => true,
                    // //     'isPhpEnabled' => true,
                    // //     'margin-top' => 0,
                    // //     'margin-right' => 0,
                    // //     'margin-bottom' => 0,
                    // //     'margin-left' => 0,
                    // // ])
                    // ->setPaper($customPaper1, 'portrait');


                    $coversheetNAme = 'cover_sheet_'.time().'.'. 'pdf';
                    $cms1500NAme = 'cms_1500_'.time().'.'. 'pdf'; 
                    //$customPaper = array(10, 0,1200,1300);
                    //$customPaperCMS = array(10, 0,1400,1300);

                    $customPaper = array(10, 0,600,1000); 
                    //$customPaperCMS = array(10, 0,1400,1000);
                    $customPaperCMS = array(10, 0,600,1000);


                    $customPaper1 = array(0, 0, 600,700); 
                    //$customPaper1 = array(0, 0, 210, 297);
                    $customPaperCMS2 = array(0, 0, 800,1690);

                    $folderPath = chmod(public_path('injury_document'), 0775);  
                    $htmlCover = view('patients.injury.bills.exports.index', compact('isExistBill'))->render(); 
                    //$pdf = PDF::loadHTML($htmlCover)->setPaper('Letter', 'portrait');
                    $pdf = PDF::loadView('patients.injury.bills.exports.index', compact('isExistBill'))->setPaper('Letter', 'portrait'); 
                    $path_to_file = public_path('bills/tempBillPacket/'.$coversheetNAme);
                    $path_to_file_CMS = public_path('bills/tempBillPacket/'.$cms1500NAme);
                    $checkCoverSheet = BillTempDocForSendPacket::where('temp_document_name', $coversheetNAme)->where('doc_type', 1)->where('bill_id', $isExistBill->id)->first();
                    if($checkCoverSheet){
                        if (File::exists($path_to_file)) { 
                            File::delete($path_to_file); 
                            $checkCoverSheet->delete(); 
                        } 
                    }
                    //else{ 
                        if($pdf->save($path_to_file)){
                            $tempFIles = new BillTempDocForSendPacket();
                            $tempFIles->bill_id                 = $isExistBill->id;
                            $tempFIles->temp_document_name	    = $coversheetNAme;
                            $tempFIles->doc_type                 = 1;
                            $tempFIles->save();
                        }
                    //}
                    $checkCMS = BillTempDocForSendPacket::where('temp_document_name', $cms1500NAme)->where('doc_type', 2)->where('bill_id', $isExistBill->id)->first();
                    if($checkCMS){
                        if (File::exists($path_to_file_CMS)) { 
                            File::delete($path_to_file_CMS); 
                            $checkCMS->delete(); 
                        } 
                    }
                    //else{ 
                            //$pdfCMS = PDF::loadView('patients.injury.bills.exports.cms1500',  compact('isExistBill'))->setPaper($customPaperCMS, 'landscape');
                            $injuryBillInfo =  $isExistBill;
                            //$pdfCMS = PDF::loadView('bill-submissions.letters.csm-1500.show',  compact('injuryBillInfo'))->setPaper($customPaperCMS2, 'portrait');
                            $html = view('bill-submissions.letters.csm-1500.show', compact('injuryBillInfo'))->render();
                            // Add the CSS style to avoid page break inside table rows
                            $html = '<style> </style>' . $html;
                             $pdfCMS = PDF::loadHTML($html)->setPaper('Letter', 'portrait');
                            //$pdfCMS = PDF::loadHTML($html)->setPaper('Letter', 'portrait')->setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'isPhpEnabled' => true, 'isPhpEnabled' => true, 'zoom' => 1.5]);
                             //$pdfCMS = PDF::loadView('bill-submissions.letters.csm-1500.show', compact('injuryBillInfo'))->setPaper('Letter', 'portrait');
                             
                            if($pdfCMS->save($path_to_file_CMS)){
                                $tempFIles = new BillTempDocForSendPacket();
                                $tempFIles->bill_id                 = $isExistBill->id;
                                $tempFIles->temp_document_name	    = $cms1500NAme;
                                $tempFIles->doc_type                 = 2;
                                $tempFIles->save();
                            } 
                        //}
                     
                    foreach ($isExistBill->getBillDocuments as $document) {
                        $targetPath = public_path('injury_document')."/".$document->injury_document;
                        $sourcePath = public_path('bills/tempBillPacket')."/".$document->injury_document;
                        $checkDoc = BillTempDocForSendPacket::where('temp_document_name', $cms1500NAme)->where('doc_type', 0)->where('bill_id', $isExistBill->id)->first();
                            if($checkDoc){
                                if (File::exists($sourcePath)) { 
                                    File::delete($sourcePath); 
                                    $checkDoc->delete(); 
                                } 
                            }
                        //else{
                            if (file_exists($targetPath)) {
                                if(copy($targetPath, $sourcePath))
                                {
                                    $tempFIles = new BillTempDocForSendPacket();
                                    $tempFIles->bill_id                 = $isExistBill->id;
                                    $tempFIles->temp_document_name	    = $document->injury_document;
                                    $tempFIles->doc_type                 = 0;
                                    $tempFIles->save();
                                } 
                            } 
                        //} 
                    } 
                    $storeFileForDelete = [];
                    $checkTempFiles = BillTempDocForSendPacket::where('bill_id', $isExistBill->id)->get();
                    if ($checkTempFiles) {
                        $fpdi = new FPDI;
                        $maxWidth = 0;
                        $maxHeight = 0;
                    
                        foreach ($checkTempFiles as $document) { 
                            $storeFileForDelete[] = $document->temp_document_name;
                            $filename = $tempPacketPath . "/" . $document->temp_document_name;
                            $count = $fpdi->setSourceFile($filename);
                            for ($i = 1; $i <= $count; $i++) {
                                $template = $fpdi->importPage($i);
                                $size = $fpdi->getTemplateSize($template);
                    
                                // Update maximum width and height if necessary
                                $maxWidth = max($maxWidth, $size['width']);
                                $maxHeight = max($maxHeight, $size['height']);
                            }
                        }
                    
                    // Create a new PDF with the maximum page size
                     //$fpdi = new FPDI('P', 'mm', array($maxWidth, $maxHeight));
                     $fpdi = new FPDI('P', 'mm',  'Letter'); 
                     $fpdi->SetMargins(0, 0);
                    foreach ($checkTempFiles as $document) {
                            if($document->doc_type == 1){ 
                                $this->makeBillCMSANDCOVERSheet($document, $isExistBill);
                            } 
                            if($document->doc_type == 2){ 
                                $this->makeBillCMSANDCOVERSheet($document, $isExistBill);
                            } 
                        $filename = $tempPacketPath . "/" . $document->temp_document_name;
                        $downLoadPdfName = time() . ".pdf";
                        $storePath = public_path('bills/billPacket') . "/" . $downLoadPdfName;
                        
                        $count = $fpdi->setSourceFile($filename); 
                        for ($i = 1; $i <= $count; $i++) {
                            $template = $fpdi->importPage($i);
                            $size = $fpdi->getTemplateSize($template);
                
                            // Calculate the position to center the PDF on the page
                            $x = ($maxWidth - $size['width']) / 2;
                            // if($document->temp_document_name){
        
                            // }
                            $y = ($maxHeight - $size['height']) / 20; // Adjust the Y position to remove top space 
                            $fpdi->AddPage($size['orientation'], 'Letter'); 
                            //$fpdi->AddPage($size['orientation'], 'A4'); 
                            // $fpdi->SetAutoPageBreak(true);
                            $fpdi->useTemplate($template, $x, $y);
                        }
                        
                       
                    }
                    
                     //////////////////////////////////////////////////////////////////////////////////////////////////////
                    //     $fpdi->SetMargins(0, 0);
                        
                    //     foreach ($checkTempFiles as $document) {
                    //     if($document->doc_type == 1){ 
                    //         $this->makeBillCMSANDCOVERSheet($document, $isExistBill);
                    //     } 
                    //     if($document->doc_type == 2){ 
                    //         $this->makeBillCMSANDCOVERSheet($document, $isExistBill);
                    //     } 
                    //     $filename = $tempPacketPath . "/" . $document->temp_document_name;
                    //     $downLoadPdfName = time() . ".pdf";
                    //     $storePath = public_path('bills/billPacket') . "/" . $downLoadPdfName;
                    
                    //     $count = $fpdi->setSourceFile($filename);
                    
                    //     for ($i = 1; $i <= $count; $i++) {
                    //         $template = $fpdi->importPage($i);
                    //         $size = $fpdi->getTemplateSize($template);
                    
                    //         // Calculate the position to center the PDF on the page
                    //         $x = 0; // Set X position to zero for no margin
                    //         $y = 0; // Set Y position to zero for no margin
                    //         $fpdi->AddPage($size['orientation'], 'Letter');
                    //         $fpdi->useTemplate($template, $x, $y);
                    //     }
                    // }
                        //////////////////////////////////////////////////////////////////////////////////////////////////////
                
                    $fpdi->Output($storePath, 'F');
                    
                        $fileCnt = 0;
                        $checkTempAfterInserFiles = BillTempDocForSendPacket::where('bill_id', $isExistBill->id)->get();
                        if ($checkTempAfterInserFiles) {
                            $fileCnt = count($checkTempAfterInserFiles);
                            $cnt = 0;
                            foreach ($checkTempAfterInserFiles as $file) { 
                                if (File::exists(public_path('bills/tempBillPacket/' . $file->temp_document_name))) { 
                                    File::delete(public_path('bills/tempBillPacket/' . $file->temp_document_name)); 
                                    BillTempDocForSendPacket::where('id', $file->id)->delete(); 
                                    $cnt+=1;
                                }  
                            } 
                            if($fileCnt == $cnt){
                                $pdfPath = '/bills/billPacket/' . $downLoadPdfName;  // Relative path to the PDF file
                                $pdfFullPath = public_path($pdfPath);  // Full URL including the base URL
                                $pdfFullUrl = asset($pdfPath);
                                return $pdfFullUrl; 
                            } 
                            // else{
                            //     $pdfPath = '/bills/billPacket/' . $downLoadPdfName;  // Relative path to the PDF file
                            //     $pdfFullPath = public_path($pdfPath);  // Full URL including the base URL
                            //     $pdfFullUrl = asset($pdfPath);
                            //     return $pdfFullUrl; 
                            // }
                        }    
                } 
            } 
          }
         // DB::commit();
          $url =  'view/patient/injury/bill/info/' .  $request->bill_id; 
           return $this->redirectToRoute($url, 'Bill packet generated successfully', 'success', ["positionClass" => "toast-top-center"]);
        // } catch (\Exception $e) {
        //   DB::rollback();   
        //   return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        // }
      }
           public function makeBillCMSANDCOVERSheet($document, $isExistBill){
            $targetPath = public_path('bills/tempBillPacket')."/".$document->temp_document_name; 
            $folderName = ($document->doc_type == 1) ? 'coverSheet' : 'cms';
            $sourcePath = public_path('bills')."/".$folderName. "/".$document->temp_document_name;
            $isFoundCMS = BillCoverSheetCmsForm::where('bill_id', $isExistBill->id)->where('doc_type', $document->doc_type)->first();
            if(!$isFoundCMS){
                if (file_exists($targetPath)) {
                    copy($targetPath, $sourcePath); 
                    $billCoverSheetCms2 =  new BillCoverSheetCmsForm();
                    $billCoverSheetCms2->bill_id = $isExistBill->id;
                    $billCoverSheetCms2->temp_document_name = $document->temp_document_name;
                    $billCoverSheetCms2->doc_type = $document->doc_type; 
                    $billCoverSheetCms2->save();
                    return $billCoverSheetCms2;
                }  
            }  
      }
}
