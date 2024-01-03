<?php

namespace App\Http\Controllers;

use App\Models\{ProviderBillingTemplateServiceItem, ProviderBillingTemplate, Status, AllDocument, State, InjuryContact, MasterDataLog, Service_code, ReportType, BillingProviderCharge, BillingProviderChargeProcedureCode,
  BillingProvider,BillModifier,ClaimAdministrator,ClaimStatus,Country,Health_provider,InjuryBill,InjuryBillService,InjuryDiagnosis,
  MasterPlaceOfService,MedicalProvider,ModifierCode,Patient,PatientAppointment,Patient_injury,ProcedureCode, RenderinProvider, BillReferingOrderProvider, Diagnosis_code
  };
  use Carbon\Carbon;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Session; 
  use Toastr;
  use DB;
  use Illuminate\Support\Facades\Auth;
  use PDF;

class BillInfoController extends Controller
{
    public function index(){}

    public function create() {}

    public function store(Request $request)
    {
        request()->validate(['service_code_id' => 'required', 'health_provider_id' => 'required', 'start_dos' => 'required', 'diagnosis_code_type' => 'required']);
        //print_r($request);   die();
        $bill_id = $this->storeBillInfo($request);
        $this->storeBillProvider($request, $bill_id);
        $this->storeBillDiagnoses($request, $bill_id);
        $this->storeBillProcedureCode($request, $bill_id);
        
        return response()->json(
          [
            'success' => 1,
            'message' => 'Bill Data inserted successfully',
            'patient_id'  =>$request->patient_id,
            'injury_id'  =>$request->injury_id,
            'bill_id'  =>$bill_id
          ]
        );
    }

    public function billList(Request $request){
        //echo 'come here '.$request->id; 
        if(!isset($request->id)){
            die('No Records Found.');
        }
        $injury_id = $request->id;        
        $result = $this->getBillListHTML($request->id);

        return response()->json(
          [
            'success' => 1,
            'message' => 'success',
            'injury_id'  =>$injury_id,
            'html'    =>$result[0],
            'options' =>$result[1]
          ]
        );
    }

    public function show(BillInfo $billinfo)
    {        
        $report_types = $this->getActiveData(new ReportType(), 'report_code');
        //echo 'aya '.$billinfo->id; //
        $bill_id = $billinfo->id;
        $bill_details = $this->getBillInfo_with_patient_injury($bill_id);
        //var_dump($bill_details); die();
        $bill_diagnoses = $this->getBillDiagnoses($bill_id);
        $bill_providers = $this->getBillProvider($bill_id);
        $bill_prc_codes = $this->getBillProcedure($bill_id);
        $bill_docs = $this->getBillDocuments( $bill_id);
        return view('bills.show', compact('report_types', 'bill_details', 'bill_diagnoses', 'bill_providers', 'bill_prc_codes', 'bill_docs'));
    }
    public function saveBillDocument(Request $request){
        request()->validate(['bill_id' => 'required', 'report_type_id' => 'required', 'document_name' => 'required|file|mimes:pdf|max:1024']);
        $html = '';
        $document_name = $request->file('document_name')->getClientOriginalName(); 
        $document_path = $request->file('document_name')->store('public/bills');
        $bill_doc_id = $this->storeBillDocument($request, $document_name, $document_path);
        if($bill_doc_id){
            $bill_docs = $this->getBillDocuments( $request->bill_id);
            foreach($bill_docs as $doc){
                $html .= '<tr><td>'.$doc->document_name.'</td><td>'.$doc->report_code.'-'. $doc->report_name.'</td><td>'.$doc->uploaded_on.'</td><td></td></tr>';
            }
        }
        return response()->json(
          [
            'success' => 1,
            'message' => 'Bill Document uploaded successfully',
            'html' => $html
          ]
        );
    }
    
    public function printpdf(Request $request){
        //echo 'come here '.$request->id; 
        if(!isset($request->id)){
            die('No Records Found.');
        }else{
           // die('it comes '.$request->id);
        
            $bill_id = $request->id;        
            //$result = $this->getBillListHTML($request->id);

            $data = [
                'title' => 'Welcome to PDF',
                'date' => date('m/d/Y')
            ];
            $pdf = PDF::loadView('mypdf', $data);

            $fileName =  time().'.'. 'pdf' ;
            $path_to_file = public_path('export/'.$fileName);
            $pdf->save($path_to_file);        
            return response()->file($path_to_file);
            //return $pdf->download($path_to_file);
        }
    }

    public function edit(BillInfo $billinfo) {}
    public function update(Request $request, BillInfo $billinfo) {}
    public function destroy(BillInfo $billinfo) {}

    public function sbrLetter(Request $request) {
      $patientId = null; $providerId = null;
      $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory','getInjuryContacts')->where('patient_id', $request->patientId)->first();
        if ($pInjuries) {
          $patientId = $pInjuries->patient_id;
        }
      return view('bill-submissions.letters.sbr.show', compact(['patientId','providerId','pInjuries'])); 
    }
    public function rfaLetter(Request $request) {
      $patientId = null; $providerId = null;
      $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory','getInjuryContacts')->where('patient_id', $request->patientId)->first();
        if ($pInjuries) {
          $patientId = $pInjuries->patient_id;
        }
      return view('bill-submissions.letters.rfa.show', compact(['patientId','providerId','pInjuries'])); 
    }
    public function resubmissionLetter(Request $request) {
      $patientId = null; $providerId = null;
      $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory','getInjuryContacts')->where('patient_id', $request->patientId)->first();
        if ($pInjuries) {
          $patientId = $pInjuries->patient_id;
        }
      return view('bill-submissions.letters.resubmission.show', compact(['patientId','providerId','pInjuries']));   
    }
    public function pr2Letter(Request $request) {
      $patientId = null; $providerId = null;
      $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory','getInjuryContacts')->where('patient_id', $request->patientId)->first();
        if ($pInjuries) {
          $patientId = $pInjuries->patient_id;
        }
      return view('bill-submissions.letters.pr2.show', compact(['patientId','providerId','pInjuries']));  
    }
    public function demandLetter(Request $request) {
      $patientId = null; $providerId = null;
      $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory','getInjuryContacts')->where('patient_id', $request->patientId)->first();
        if ($pInjuries) {
          $patientId = $pInjuries->patient_id;
        }
      return view('bill-submissions.letters.demand.show', compact(['patientId','providerId','pInjuries']));  
    }
    public function authorizationLetter(Request $request) {
      $patientId = null; $providerId = null;
      $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory','getInjuryContacts')->where('patient_id', $request->patientId)->first();
        if ($pInjuries) {
          $patientId = $pInjuries->patient_id;
        }
      return view('bill-submissions.letters.authorization.show', compact(['patientId','providerId','pInjuries']));  
    }
    public function billListStatusWise(Request $request) {
      $injuryBills = InjuryBill::where('bill_status' , $request->statusId)->get();
      $billServices = []; $billName = $request->statusType;
      return view('patients.injury.bills.index', compact(['injuryBills', 'billServices', 'billName']));
    }
}
