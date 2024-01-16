<?php

namespace App\Http\Controllers;

use App\Models\{PatientInjuryBillog, BillPaymentOther, Task, BillCoverSheetCmsForm, BillDiagnosis, TaskAssign, AppointmentReason, ProviderBillingTemplateServiceItem, ProviderBillingTemplate, Status, AllDocument, State, InjuryContact, MasterDataLog, Service_code, ReportType, BillingProviderCharge, BillingProviderChargeProcedureCode,
BillingProvider,BillModifier,ClaimAdministrator,ClaimStatus,Country,Health_provider,InjuryBill,InjuryBillService,InjuryDiagnosis,
MasterPlaceOfService,MedicalProvider,ModifierCode,Patient,PatientAppointment,Patient_injury,ProcedureCode, RenderinProvider, BillReferingOrderProvider, Diagnosis_code, BillPaymentInformation
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Toastr;
use DB;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \stdClass;

class PatientController extends Controller
{
    protected $patientModel;
    public function __construct(Patient $patientMod )
    {
        $this->middleware('permission:patient-list|patient-create|patient-edit|patient-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:patient-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patient-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patient-delete', ['only' => ['destroy']]);
        $this->patientModel = $patientMod;
    }
    public function index(Request $request)
    {
        $patients = [];
        if(Auth::user()->roles[0]['name'] =='SubAdmin'){
               $patients = Patient::with('getBillingProvider')->orderBy('created_at', 'desc')->get();  
        } 
        else
        {
            $providersId =[];
            foreach(Auth::user()->getUserBillingProviders as $userProviderInfo){
                $providersId[] = $userProviderInfo['provider_id'];
            }
            
            if(count($providersId) > 0){
                $patients = Patient::with('getBillingProvider')->whereIn('billing_provider_id', $providersId)->orderBy('created_at', 'desc')->get(); 
            }
        }
        
        return view('patients.index', compact('patients'));
    }

    

    public function show(Patient $patient)
    {
        $billingproviders = $this->getActiveData(new BillingProvider(), 'name');
        $countries = $this->getActiveData(new Country(), 'country_name');
        $states = $this->getActiveData(new State(), 'state_name');
        //dependent lists here
        $diagnoses = $diagnoses = $this->getDiagnosisCode();
        $service_codes = $this->getActiveData(new Service_code(), 'place_of_service_name');
        $render_providers = $this->getRenderProvdierDD(new Health_provider());
        $claim_admins = $this->getActiveData(new ClaimAdministrator(), 'name');
        $medical_providers = $this->getActiveData(new MedicalProvider(), 'applicant_name');
        $claimstatuses = $this->getActiveData(new ClaimStatus(), 'claim_status');
        //Bill dependent list here
        $bill_provider_types = config('global.bill_provider_types');
        $procedure_codes = $this->getActiveData(new ProcedureCode(), 'procedure_code');
        $modifiers = $this->getActiveData(new ModifierCode(), 'modifier_code');
        //Patient's details here
        $injuries = $this->getPatientinjuries($patient->id);

        //print_r($bill_provider_types);
        return view('patients.show', compact('patient', 'billingproviders', 'countries',
            'states', 'claim_admins', 'diagnoses', 'service_codes', 'render_providers', 'claimstatuses',
            'medical_providers', 'injuries', 'bill_provider_types', 'procedure_codes', 'modifiers'));
    }

    public function destroy(Patient $patient)
    {
        $this->deleteRow(new Patient(), $patient->id);
        $this->addGlobalAllLog('PATIENT_DELETED','App\Patient','Deleted Patient',$patient->id);
        Session::flash('success', 'Data blocked successfully!');
        return response()->json(
            [
                'success' => 1,
                'message' => 'Data blocked successfully',
            ]
        );
    }

    public function restore(Request $request)
    {
        $this->restoreRow(new Patient(), $request->id);
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
            [
                'success' => 1,
                'message' => 'Data restore successfully',
            ]
        );
    }

    public function createPatientBilling(Request $request)
    {
        $states = $this->getActiveData(new State(), 'state_name');
        $billingproviders = $this->getActiveData(new BillingProvider(), 'name');
        return view('patients.create-patient-info', compact('states', 'billingproviders'));
    }
    public function searchPatient(Request $request)
    {
        $patients = Patient::with('getBillingProvider');
        if (isset($request->name)) {
            $value = $request->name;
            $patients->where('first_name', 'like', "$value%");
            $patients->orWhere('last_name', 'like', "$value%");
            $patients->orWhere('patient_no', $value);
        }
        return $record = $patients->get();
    }

    public function searchClaimsAdministrator(Request $request)
    {
        $claims = ClaimAdministrator::select("*");
        if (isset($request->name)) {
            $claims->where('name', 'like', "$request->name%");
        }
        $claims->orderBy('id', 'desc');
        return $record = $claims->get();
    }
    public function getAllPatients()
    {
        $patients = Patient::orderBy('created_at', 'desc')->get();
        return $patients;
    }

    
    

    public function edit(Request $request)
    {
        if($request->id){
            $patient = $this->getPatientById($request->id);
            if($patient){
                $masterData = $this->showStateCityCountry();
                $states = $masterData['states'];
                $billingproviders = $this->getActiveData(new BillingProvider(), 'name');
                $patientId = $patient->id;
                $injury = $this->getInjuryClaimDate($patientId, null);
            }
            else{
                return $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
            } 
        }
        else{
            Toastr::error('This record does not exist', '', ["positionClass" => "toast-top-center"]);
            return $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
        } 
        return view('patients.edit', compact('injury', 'patient', 'states', 'billingproviders', 'patientId'));
    }

    

    
    public function ajaxViewEvents(Request $request)
    {
        //$patientId = $request->patientId;
        $cDate = $request->cDate;
        return $pateintJsonData = json_encode($this->getToolTipData(null, $cDate));
    }
    
    public function getAllBillinProviders()
    {
        $billingproviders = BillingProvider::orderBy('created_at', 'desc')->where('is_active', 1)->get();
        return $billingproviders;
    }
    public function getAllSearchBasedPatients(Request $request)
    {
        if (isset($request->searchString)) {
            $strVal = $request->searchString;
            $patientsInfo = Patient::with('getBillingProvider');
            $patientsInfo = $patientsInfo->where('first_name', 'LIKE', "{$strVal}%");
            //$patientsInfo =  $patientsInfo->orWhere('last_name', 'LIKE', "{$strVal}%");
            $patientsInfo = $patientsInfo->orWhere('patient_no', 'LIKE', "{$strVal}%");
            $patients = $patientsInfo->orderBy('created_at', 'desc')->get();
            return $patients;
        }
    }
    public function showDocuments(Request $request, Patient $patient)
    {
        $title = 'Add Injury';
        $injuryId = $request->injuryId;
        $patientId = $request->patientId;
        if (isset($request->id)) {
            $title = 'Update Injury';
        }
        $masterData = $this->showStateCityCountry();
        $claimsAdministers = ClaimAdministrator::orderBy('id', 'desc')->get();
        $medical_providers = MedicalProvider::orderBy('id', 'desc')->get();
        $diagnoses = $diagnoses = $this->getDiagnosisCode();
        $dCode = [];
        if (!empty($injuryId)) {
            $pateintInjury = Patient_injury::with('getInjuryClaim')->where('id', $injuryId);
            $pInjuries = $pateintInjury->first();
            if ($pInjuries) {
                $injuryDiagnos = InjuryDiagnosis::where('injury_claim_id', $pInjuries->getInjuryClaim->id)
                    ->orderBy('id', 'desc')->get();
                foreach ($injuryDiagnos as $code) {
                    $dCode[] = $code['diagnosis_code_id'];
                }
            }
        } else {
            $pInjuries = [];
            $injuryDiagnos = [];
        }
        $injury = $this->getInjuryClaimDate($patientId, $injuryId);
        $patient = Patient::with('getBillingProvider', 'getInjuries')->Where('id', $patientId);
        $patient = $patient->orderBy('created_at', 'desc')->first();
        $claimStatus = $this->getActiveData(new ClaimStatus(), 'claim_status');

        return view('patients.injury.documents.create', compact('injuryId', 'pInjuries', 'injury', 'patientId', 'title', 'patient', 'claimsAdministers',
            'medical_providers', 'diagnoses', 'patient', 'injuryDiagnos', 'dCode', 'claimStatus'));
    }

   

    public function addSbr(Request $request, Patient $patient)
    {
        $title = 'Add Injury';
        $injuryId = $request->injuryId;
        $patientId = $request->patientId;
        if (isset($request->id)) {
            $title = 'Update Injury';
        }
        $states = $this->getActiveData(new State(), 'state_name');
        $masterData = $this->showStateCityCountry();

        $claimsAdministers = ClaimAdministrator::orderBy('id', 'desc')->get();
        $reportType = ReportType::orderBy('id', 'desc')->get();
        $medical_providers = MedicalProvider::orderBy('id', 'desc')->get();
        $diagnoses = $diagnoses = $this->getDiagnosisCode();
        $dCode = [];

        $injury = $this->getInjuryClaimDate($patientId, $injuryId);
        $patient = Patient::with('getBillingProvider', 'getInjuries')->Where('id', $patientId)->orderBy('created_at', 'desc')->first();
        //$patient = $patient->orderBy('created_at', 'desc')->first();
        if($patient){
            $patientId = $patient->id;
            if($patient && $patient->getInjuries){
                    $pInjuries = $patient->getInjuries;
            }
            $this->setSidebarPatient($patientId);
        }
        $claimStatus = $this->getActiveData(new ClaimStatus(), 'claim_status');

        $pInjuries = [];
        //dd($patient);

        return view('patients.injury.sbr.create', compact('patient', 'reportType', 'injuryId', 'pInjuries', 'injury', 'patientId', 'title', 'patient', 'claimsAdministers',
            'medical_providers', 'diagnoses', 'patient', 'dCode', 'claimStatus', 'states'));
    }

    public function getBillingInfo(Request $request)
    {
        $billingProviderId = null;
        $array = [];
        if ($request->billingId != null) {
            $billingProviderId = $request->billingId;
        }
        if ($billingProviderId != null) {
            $billingproviders = BillingProvider::where('id', $billingProviderId)->first();
            return $billingproviders;
        } else {
            return $array;
        }

    } 
    public function searchPatientList(Request $request)
    {
        //
        // echo "<pre>";
        // print_r($request->all());exit;

        if ($request->isMethod('GET')) {
            $patients = [];
            if (isset($request->serachInput)) {
                $strVal = $request->serachInput;
                $patientsInfo = Patient::with('getBillingProvider');
                $patientsInfo = $patientsInfo->where('first_name', 'LIKE', "{$strVal}%");
                //$patientsInfo =  $patientsInfo->orWhere('last_name', 'LIKE', "{$strVal}%");
                $patientsInfo = $patientsInfo->orWhere('patient_no', 'LIKE', "{$strVal}%");
                $patients = $patientsInfo->orderBy('created_at', 'desc')->get();
            } else {
                if($request->patientName == null && $request->patientId == null && $request->dob == null && $request->practice_id == null &&
                $request->providerName == null){
                   // echo "###";exit;
                    $patients = [];
                }
                else{

                    $patientsInfo = Patient::with('getBillingProvider');
                    if (isset($request->patientName)) {
                        //echo "@@###";exit;
                       $strVal = strtolower($request->patientName);
                       // $patientsInfo = $patientsInfo->where(strtolower('first_name'),'like', '%' . $strVal . '%');
                        // $patientsInfo = $patientsInfo->orWhere(strtolower('last_name'),'like', '%' . $strVal . '%');
                        $patientsInfo = $patientsInfo->where(strtolower('full_name'),'like', '%' . $strVal . '%');

                    } elseif (isset($request->patientId)) {
                        $patientId = $request->patientId;
                        $patientsInfo = $patientsInfo->where('patient_no', 'LIKE', "$patientId%");
                    } elseif (isset($request->dob)) {
    
                        $patientsInfo = $patientsInfo->where('dob', date('Y-m-d', strtotime($request->dob)));
                    } elseif (isset($request->practice_id)) {
                        $patientsInfo = $patientsInfo->where('practice_id', $request->practice_internal_id);
                    } elseif (isset($request->providerName)) {
                        $providerSearch = $request->providerName;
                        $patientsInfo->orWhereHas('getBillingProvider', function ($r) use ($providerSearch) {
                            $r->where('id', $providerSearch);
                        });
                    }
                    $patients = $patientsInfo->orderBy('created_at', 'desc')->get();  
                }

            }
            return view('patients.index', compact('patients'));

        } else {
            $patients = Patient::with('getBillingProvider')->orderBy('created_at', 'desc')->get();
            return view('patients.index', compact('patients'));
        }
    }
    
    
    
    public function viewInjury(Request $request)
    {
        //echo "<pre>"; print_r($request->all());exit;
        $injuryId = $request->id;
        $patientId = null;
        $patient = [];
        $injury = []; $claim = null;
        $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory','getInjuryContacts')->where('id', $request->id)->first();
        if ($pInjuries) {
            $patientId = $pInjuries->patient_id;
            $patient = $this->setSidebarPatient($patientId);
            $injury = $this->setSidebarInjury($injuryId);
            $claim = $pInjuries->getInjuryClaim->getClaimAdmin;
        }
        $injuryContact = new InjuryContact();
        $contactRoles = $injuryContact->contactRoles;
        $masterData = $this->showStateCityCountry();
        $states = $masterData['states']; 
       //dd($claimAdminInfo);
        
       // getInjuryClaimAdministrator
        return view('patients.injury.show', compact('claim', 'states','contactRoles','injuryId', 'pInjuries', 'patientId', 'patient', 'injury'));
    }
    public function update(Request $request, Patient $patient)
    {
        try {
            $this->storePatientInfo($request, $request->id);
            return $this->redirectToRoute('/patients', trans('bill.patient_updated'),  'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    

    public static function changeUnderScoreToSpace($str){
        $changedStr =  ucfirst(strtolower(str_replace('_', ' ', $str)));
         return $changedStr;
    } 
    public function getDiagnosisCodeInfo(Request $request){
        $str =  $request->dc; $dcArray = array();
        $diagnosCode = Diagnosis_code ::where('is_active',1)->where('id',$str)->first();
        //dd($diagnosCode);
        if($diagnosCode){
            return $dcArray = array('diagnosis_code' => strtolower($diagnosCode['diagnosis_code']), 'dc_id' =>$diagnosCode['id']); 
        }
    }
    public function convertDateFormat($str){
        return $this->getDateStringMMDDYYFormat($str);
    }
    public function addPatientSchedular(Request $request)
    { 
        $patientInfo = null; $pateintJsonData = []; $patientAppointment = []; $patientId = null;
        $states = $this->getActiveData(new State(), 'state_name');
        $billingproviders = $this->getActiveData(new BillingProvider(), 'name');
        $status = Status::where("is_active", '1')->get();
        $appointMents =  AppointmentReason::where('is_active', 1)->get();
        $meetingTypes = $this->patientModel->getMeetingType();

        $patients = Patient::with('getBillingProvider', 'getInjuries')->orderBy('first_name', 'asc')->get();
        $locations = [];

        if(isset($request->id)){
            $patientInfo = $this->getPatientById($request->id);
            if($patientInfo){
                $patientId = $request->id;
                if($patientInfo->getBillingProvider){
                    $locations = MasterPlaceOfService::where('billing_provider_id', $patientInfo->getBillingProvider->id)->get();
                }
                $patientAppointment = PatientAppointment::with('getPatient')->where('patient_id', $patientId)->get();
                $pateintJsonData = json_encode($this->getToolTipData($patientId, null));
            }
            else{
                return  $this->redirectToRoute('/patients', trans('bill.record_not_found'), 'error', ["positionClass" => "toast-top-center"]);
            }
        }
        return view('patients.schedular.index', compact('meetingTypes','locations','appointMents','patientInfo', 'patients', 'pateintJsonData', 'patientId', 'states', 'billingproviders', 'status', 'patientAppointment'));
        
    }
    public function injuryStore(Request $request)
    {
        try {
            $patient_id = $this->storeBillInfo($request);
            return $this->redirectToRoute(redirect()->back(),trans('bill.patient_injury_created_successfully'),  'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
            return $this->redirectToRoute('create/patients/injury/' . $patient_id, $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    
    
   
    
    public function showInjuryNotes(Request $request, Patient $patient)
    {
        $injuryId = $request->injuryId;
        $patientId = null; $id = null;
        $masterData = $this->showStateCityCountry();
        $claimsAdministers = ClaimAdministrator::orderBy('id', 'desc')->get();
        $medical_providers = MedicalProvider::orderBy('id', 'desc')->get();
        $diagnoses = $diagnoses = $this->getDiagnosisCode();
        $dCode = []; $injury = []; $pInjuries = [];  $injuryDiagnos = [];
        $claimStatus = $this->getActiveData(new ClaimStatus(), 'claim_status');
        if (isset($request->injuryId)) {
            $pateintInjury = Patient_injury::with('getInjuryClaim','getInjuryNotes')->where('id', $injuryId);
            $pInjuries = $pateintInjury->first(); 
            if($pInjuries){
                $patient = $this->setSidebarPatient($pInjuries->patient_id);
                $injury = $this->setSidebarInjury($pInjuries->id);
            }
        } else {
            $pInjuries = [];
            $injuryDiagnos = [];
        }
        return view('patients.injury.notes.show', compact('injuryId', 'pInjuries',  'patientId',  'patient', 'id','injury'));
    }
    public function patientInjuryDiagnosisCodeAddUpdate(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->storePatientInjuryDignosisCodeAddUpdate($request);
            DB::commit();
            $message = 'Diagnosis created successfully';
            if(isset($request->dignosisId)){
                $message = 'Diagnosis updated successfully';
            }
            $url =  'injury/view/' . $request->injuryId;
            return $this->redirectToRoute($url, $message, 'success', ["positionClass" => "toast-top-center"]);
           
        } catch (\Exception $e) {
            //DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    
    public function saveInjuryBillDocuments(Request $request){
        //InjuryDocument
       //dd($request->all());exit;
       
       //try {
        DB::beginTransaction();
            $this->storeInjuryDocuments($request);
        DB::commit();
        if($request){
            $url = '';
            if($request->docType == 'Bill'){
                $url =  '/view/patient/injury/bill/info/' . $request->injuryId;
                $this->addBillLogs($request, $request->injuryId, 'Bill Document Added', 'BILL_INFO', null);
            }
            else if($request->docType == 'Injury'){
                $url =  '/injury/view/' . $request->injuryId; 
            }
            else if($request->docType == 'Provider'){
                //$url =  '/billing/providers/setting/' . $request->providerId; 
                $url = 'patients/injury/documents/'.$request->providerId."/".$request->docType;
            }
            return $this->redirectToRoute($url, trans('bill.document_created_successfully'), 'success', ["positionClass" => "toast-top-center"]);
        }
        // } catch (\Exception $e) {
        //    DB::rollback(); 
        //     return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        // }
    }
    public function patientInjuryContactDelete(Request $request){ 
    try {
        if($request->id){
            $url = '/injury/view/'.$request->injuryId;
            DB::beginTransaction();
            $result =  $this->deleteInjuryContact($request);
            DB::commit();
            if($result == 1){
                return $this->redirectToRoute($url, trans('bill.injury_contact_deleted_successfully'), 'success', ["positionClass" => "toast-top-center"]);
            }
            else{
                return $this->redirectToRoute(redirect()->back(), trans('bill.provide_id_for_delete'),  'error', ["positionClass" => "toast-top-center"]);
            }
        }
        else{
            return $this->redirectToRoute(redirect()->back(), trans('bill.provide_id_for_delete'), 'error', ["positionClass" => "toast-top-center"]);
        } 
        
        } catch (\Exception $e) {
           //DB::rollback(); 
           return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function ajaxBillingProviders(Request $request)
    {
        $patientId = null;  $billingProviders = [];
        // if(count(Auth::user()->getUserBillingProviders) > 0){
        //     $providrs = [];
        //     foreach(Auth::user()->getUserBillingProviders as $usBilling){
        //        $providrs[] = $usBilling->provider_id;
        //     }
        //     $bp = BillingProvider::where('is_active', 1)->whereIn('id', $providrs);
        //     $billingProviders =  $bp->get();
        // } 
        // else{
        //     $bp = BillingProvider::where('is_active', 1);
        //     if(isset($request->patientId)){
        //         $patientId = $request->patientId;
        //         $patient = Patient::where('id', $patientId)->first();
        //         if($patient){
        //             $bp->where('id', $patient->billing_provider_id);
        //         }
        //         $billingProviders[] =  $bp->first();
        //     } 
        //     else{
        //         $billingProviders =  $bp->get();
        //     }
        // }
        $bp = BillingProvider::where('is_active', 1);
            if(isset($request->patientId)){
                $patientId = $request->patientId;
                $patient = Patient::where('id', $patientId)->first();
                if($patient){
                    $bp->where('id', $patient->billing_provider_id);
                }
                $billingProviders[] =  $bp->first();
            } 
            else{
                $billingProviders =  $bp->get();
            }
        
        return $billingProviders;
    }
    public function ajaxBillingProviderLocations(Request $request)
    {
        $patientId = null;  $billingProviders = [];
        $bp = MasterPlaceOfService::where('is_active', 1)->where('billing_provider_id', $request->providerid);
        $billingPLocations =  $bp->get();
        return $billingPLocations;
    }
    
    public function getTemplateProcedureCode(Request $request)
    {
        $serviceItemsc = [];
        if(isset($request->templateId)){
            $serviceItemsc = ProviderBillingTemplateServiceItem::where('template_id', $request->templateId)->get();
        }
        return $serviceItemsc;
    }
    public function create(Request $request)
    {
        $title = "Add Patient"; $patient = []; $patientId = null; $injury = [];
        $masterData = $this->showStateCityCountry();
        $states = $masterData['states']; 
        $billingproviders = $this->getActiveData(new BillingProvider(), 'name');
       if($request->id){
            $title = "Edit Patient";
            $patient =  $this->getPatientById($request->id);
            if($patient){
                $patientId = $patient->id;
                $injury = $this->getInjuryClaimDate($patientId, null);
                return view('patients.create', compact('states', 'billingproviders','title','patient','patientId','injury'));
            }
            else{
                return $this->redirectToRoute('/patients', trans('bill.record_not_found'), 'error', ["positionClass" => "toast-top-center"]);
            }
       }
       else{
        return view('patients.create', compact('states', 'billingproviders','title','patient','patientId','injury'));
       }
    }
    public function store(Request $request)
    {

       try {
            DB::beginTransaction(); 
                $msg = ''; $msgType = '';
                $redirectRoute = '';
                if(isset($request->patient_id)){
                    $patient =  $this->getPatientById($request->patient_id);
                    if(!$patient){
                        $msg = trans('bill.patient_does_bot_exit'); 
                        $msgType = 'success';
                        $redirectRoute = '/patients/create';
                    }
                    else{ 
                        $patient_id = $this->storePatientInfo($request);
                         $msg = trans('bill.patient_updated'); 
                        $msgType = 'success';
                        $redirectRoute = 'patients/view/'.$patient_id;
                    }
                }
                else{
                    $isPatientExist = DB::table('patients')->where('billing_provider_id', $request->add_billing_provider_id)
                    ->where(DB::raw('LOWER(first_name)'), strtolower($request->first_name))->whereRaw('dob = STR_TO_DATE(?, "%m/%d/%Y")', [$request->dob])->first(); 
                    if($isPatientExist){
                        $msg = trans('bill.patient_already_exit'); //'This patient already exist'; 
                        $msgType = 'error';
                        $redirectRoute = '/patients/create';
                    }
                    else{
                        $patient_id = $this->storePatientInfo($request);
                        $msg = trans('bill.patient_added'); 
                        $msgType = 'success';
                        $redirectRoute = 'create/patients/injury/'.$patient_id;
                    }
                } 
            DB::commit();
            return  $this->redirectToRoute($redirectRoute, $msg, $msgType, ["positionClass" => "toast-top-center"]);
           
            
        } catch (\Exception $e) {
            DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    
    public function getInjuryClaimDate($patientId, $injuryId = null)
    {
        try {
              $injuryData = Patient_injury::with('getInjuryClaim')->where('patient_id', $patientId);
                if (!empty($injuryId)) {
                    $injuryData->where('id', $injuryId);
                }
                return $injuryData->first();
                
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }   
    
    
    public function saveTempDocumentForAllDocuments(Request $request){
        //InjuryDocument
       //dd($request->all());exit;
       
       try {
        DB::beginTransaction();
       $id=  $this->storeTepInjuryDocuments($request);
        DB::commit();
        if($request){
           return $id;
        }
       // 
        } catch (\Exception $e) {
           DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function ajaxBillingProviderRendering(Request $request)
    {
        $rendering = BillReferingOrderProvider::where('type',4)->where('billing_provider_id',$request->providerid)->orderBy('id', 'desc')->get();
        return $rendering;
    }
    
    
    public function getMeetingType($id){
        $appointMents = $this->patientModel->getAppointmentReason();
          $new = array_filter($this->patientModel->getMeetingType(), function ($var) use ($id) {
            return ($var['id'] == $id);
        });
         return $this->getValFromArray($new);
    }
    public function getResaon($id){
         $new = array_filter($this->patientModel->getAppointmentReason(), function ($var) use ($id) {
            return ($var['id'] == $id);
        });
        return $this->getValFromArray($new);
    }
    public function getValFromArray($array){
        $name ='';
        foreach($array as $val){
            return $name = $val['name'];
        }
    }
    public function catculateTotalHours($duration){
            $hours    = (int)($duration / 60);
            $minutes  = $duration - ($hours * 60);    
            date_default_timezone_set('UTC');
            $date = new DateTime($hours.":".$minutes);
            return $date->format('H:i:s');
    }
    public function ajaxBillingProviderReasons(Request $request)
    {
        $reasons = AppointmentReason::where('provider_id',$request->providerid)->orderBy('id', 'desc')->get();
        return $reasons;
    } 
    function appointmentDelete(Request $request){
         $appointment = PatientAppointment::where('id', $request->id)->first();
        if($appointment){
            $this->addGlobalAllLog('APPOINTMENT_DELETE','App\PatientAppointment','Patient appointment deleted', $appointment->id); 
            $appointment->delete();
        }  
    }
    function getApointmentInfoById(Request $request){
         $appountment = PatientAppointment::where('id', $request->eventId)->first();
        if($appountment){
            $fRenderingProvider = null;  $fpatientName = null; $durationData = null;
            $fRenderingProvider = ($appountment->getRenderingProvider && $appountment->getRenderingProvider->referring_provider_first_name) ? $appountment->getRenderingProvider->referring_provider_first_name : '';
            
            if($appountment->getRenderingProvider && $appountment->getRenderingProvider->referring_provider_middle_name){
                if ($fRenderingProvider !== '') {
                    $fRenderingProvider .= ' ';
                }
                $fRenderingProvider .=  $appountment->getRenderingProvider->referring_provider_middle_name;
            }
            if($appountment->getRenderingProvider && $appountment->getRenderingProvider->referring_provider_last_name){
                if ($fRenderingProvider !== '') {
                    $fRenderingProvider .= ' ';
                }
                $fRenderingProvider .=  $appountment->getRenderingProvider->referring_provider_last_name;
            }
            $fpatientName = ($appountment->getPatient && $appountment->getPatient->first_name) ? $appountment->getPatient->first_name : '';
            
            if($appountment->getPatient && $appountment->getPatient->mi){
                if ($fpatientName !== '') {
                    $fpatientName .= ' ';
                }
                $fRenderingProvider .=  $appountment->getPatient->mi;
            }
            if($appountment->getPatient && $appountment->getPatient->last_name){
                if ($fpatientName !== '') {
                    $fpatientName .= ' ';
                }
                $fpatientName .=  $appountment->getPatient->last_name;
            }
            $durationData = $this->catculateTotalHours($appountment->duration);
            $appountment->appointmentNo         = $appountment->appointment_no;
            $appountment->appointmentDate       = ($appountment->appointment_date) ? date('m-d-Y', strtotime($appountment->appointment_date)) : '';
            $appountment->meetingType           = $this->getMeetingType($appountment->meeting_type);
            $appountment->renderingProvider     = $fRenderingProvider;
            $appountment->resource              = ($appountment  && $appountment->resource ) ? $appountment->resource : '';
            $appountment->authorised            = ($appountment  && $appountment->authorised ) ? $appountment->authorised : '';
            $appountment->statusDivId           = ($appountment->getStatus && $appountment->getStatus->status_name) ? $appountment->getStatus->status_name : '';
            $appountment->recurreneId             = ($appountment->recurrene && $appountment->recurrene == 'on') ? 'Yes' : 'No';
            $appountment->patientNameId           =  $fpatientName;
            $appountment->appointmentTime       = ($appountment->appointment_time) ? $appountment->appointment_time : '';
            $appountment->billingProvider       = ($appountment->getBillingProvider && $appountment->getBillingProvider->professional_provider_name) ? $appountment->getBillingProvider->professional_provider_name : '';
            $appountment->locationID            = ($appountment->getLocation && $appountment->getLocation->nick_name) ? $appountment->getLocation->nick_name : '';
            $appountment->claimNo               = ($appountment->getInjury && $appountment->getInjury->getInjuryClaim && $appountment->getInjury->getInjuryClaim->claim_no) ? $appountment->getInjury->getInjuryClaim->claim_no : '';
            $appountment->resaonsId             =  ($appountment->getResaons && $appountment->getResaons->name) ? $appountment->getResaons->name : '';
            $appountment->durationId            =  $durationData;
            $appountment->isInterpreterId       =  ($appountment->is_interpreter && $appountment->is_interpreter == 'on') ? 'Yes' : 'No';
            $appountment->additionInformationId   =  ($appountment && $appountment->appointment_addition_info != "") ? $appountment->appointment_addition_info : '';
            return $appountment;
        } 
    }
    public function addDocuments(Request $request, Patient $patient)
    {
        // echo  "<pre>";
        // print_r($request->id);exit;
        //echo "###".$request->pid."==".$request->id;exit; 
        
        try {
            $head = 'Add '; $documents = []; $id= null; $providerId = null;
            $providerGallary = [];
            if(isset($request->id)){
                $head = 'Update ';
                $id= $request->id;
                $documents = AllDocument::where("id", $request->id)->where('is_active',1)->first();
            }
            $title = ($request->type) ? $head.$request->type.'  Document' : null;
            
            $injuryId = null; $patient = []; $pInjuries = [];  $injury  = []; $typdocTypee = "";
             
            $docType = ($request->type) ? $request->type : null;
            $injuryId = $request->injuryId;
            if (isset($request->injuryDocumentId)) {
                $title = 'Update Injury Document';
                $id = $request->injuryDocumentId;
            }
            if($request->type == 'Injury'){
                $injury  = Patient_injury::with('getInjuryClaim','getInjuryDocuments')->where('id', $injuryId)->first();
                if($injury ){
                    $patient = $this->setSidebarPatient($injury->patient_id);
                    $providerId = ($injury->patient && $injury->patient->billing_provider_id) ? $injury->patient->billing_provider_id : null;
                }
            }
            if($request->type == 'Bill'){
                 $providerId = null;
                //$providerGallary;
                 $billInfo = InjuryBill::with('getPatientForBill')->where('id', $injuryId)->first();
                
                 if($billInfo){
                    if($billInfo->getInjury){   
                        if($billInfo->getInjury->patient){ 
                            $patientId =   $billInfo->getInjury->patient->id;
                            $patient = $this->setSidebarPatient($patientId); 
                        } 
                        $injury = $this->setSidebarInjury($billInfo->getInjury->id);
                    } 
                    if($billInfo->getPatientForBill && $billInfo->getPatientForBill->billing_provider_id){
                        $providerGallary = AllDocument::where('doc_type', 'Provider')->where('injury_id', $billInfo->getPatientForBill->billing_provider_id)->get(); 
                    }
                 }
            }
            if($request->type == 'Provider'){
                $providerId = $request->injuryId;
            }
             $uu = ($request->type == 'Provider')  ? '/billing/providers/setting/' :  (($request->type == 'Bill') ? '/view/patient/injury/bill/info/' : '/injury/view/');
            $url = $uu.$injuryId;
            
            
            $reportType = ReportType::orderBy('id', 'desc')->get();
             $allDocuments = AllDocument::where('doc_type', $request->type)->where('injury_id', $request->injuryId)->get();
             return view('patients.injury.documents.create', compact('patient', 'injury', 'providerGallary','allDocuments','url','providerId','documents','docType','id','injuryId','title','reportType' ,'patient', 'injury'));
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function deleteDocument(Request $request)
    {
        // echo  "<pre>";
        // print_r($request->id);exit;  
        try {
            $allDocuments = AllDocument::where('id', $request->id)->withTrashed()->first();
            if($allDocuments){
                $allDocuments->delete();
                if($request->docType == 'Bill'){
                    $url =  '/view/patient/injury/bill/info/' . $allDocuments->injury_id;
                }
                else if($request->docType == 'Injury'){
                    $url =  '/injury/view/' . $allDocuments->injury_id; 
                }
                else if($request->docType == 'Provider'){
                    $url = 'patients/injury/documents/'.$allDocuments->injury_id."/".$request->docType;
                }
                return $this->redirectToRoute($url, trans('bill.document_created_successfully'), 'success', ["positionClass" => "toast-top-center"]);

            } 
            
         } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
     
    function appointmentBillStatus(Request $request){ 
        //echo "<pre>";
        //print_r($request->all());exit;
        if(isset($request->appointmentIds)){
            // echo "<pre>";
            // print_r($request->all());exit; 
            $checkStatus = Status::where('slug_name', $request->changeVal)->first();
            //echo $checkStatus->slug_name;exit;
            if($checkStatus){
                $billStatusInfo = Status::where('slug_name', 'INCOMPLETE_BILL')->first();
               // dd($billStatusInfo);
               if($billStatusInfo){
                    foreach($request->appointmentIds as $id){
                        $appointment = PatientAppointment::where('id', $id)->first(); 
                        $checkBill = InjuryBill::where('appointment_id', $appointment->id)->first(); 
                        if(!$checkBill){
                            $bill_info = new InjuryBill();
                            $bill_info->injury_id = $appointment->case_id;
                            $bill_info->patient_id = $appointment->patient_id;
                            $bill_info->bill_status = $billStatusInfo->id;
                            $bill_info->dos = $appointment->appointment_date;
                            $bill_info->appointment_id = $appointment->id;
                            $bill_info->save();
                            $this->addGlobalAllLog('INCOMPLETE','App\InjuryBill',$billStatusInfo['slug_name'], $bill_info->id);
                            $this->checkInsertUpdateTask($request, $appointment->patient_id);  
                        }
                        
                        // if($checkStatus['slug_name'] == 'APPOINTMENT_BILL_STATUS_BILLED'){
                        //     $checkBillUpdate = InjuryBill::where('appointment_id', $appointment->id)->first();
                        //     $billStatusInfo = Status::where('slug_name', 'SENT_BILL')->first();
                        //     if($billStatusInfo){
                        //         if($checkBillUpdate){
                        //             $checkBillUpdate->bill_status = $billStatusInfo->id;
                        //             $checkBillUpdate->update();
                        //             $this->addGlobalAllLog('SENT','App\InjuryBill',$billStatusInfo['slug_name'], $checkBillUpdate->id);
                        //             $this->checkInsertUpdateTask($request, $appointment->patient_id); 
                        //         }
                        //     } 
                        // }
                        $appointment->bill_status = $checkStatus->id; 
                        $appointment->update();
                    } 
                }
            }
        }
        // echo "<pre>";
        // print_r($request->appointmentIds);
        
        // $appointment = PatientAppointment::where('id', $request->appointMentId)->first();
        // if($appointment){
        //     $appointment->status = $request->statusId;
        //     $appointment->update();
        // } 
        // $appointment = PatientAppointment::where('id', $request->appointMentId)->first();
        // if($appointment){
        //     $appointment->bill_status = $request->reasonId;
        //     $appointment->update();
        // } 
    }
    public function savePatientAppointment(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
         try {
            if(isset($request->patientId)){
                $newAppoint =  date('Y-m-d');
                if(isset($request->appointment_date)){
                $reqDob =  $request->appointment_date;
                $exDate = explode('/', $reqDob);
                $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
                //$reverDate = implode('-', array_reverse($exDate));
                $newAppoint =  date('Y-m-d',strtotime($newBreakDate));
                }
                $statusId = 1;
                $billStatusInfo = Status::where('slug_name', 'INCOMPLETE_APPOINTMENT')->first();
                if($billStatusInfo){
                    $statusId =  $billStatusInfo->id;
                }
                $checkApoint = PatientAppointment::where('patient_id', $request->patientId)->where('appointment_date', $newAppoint)->first();
                if(isset($request->urlFrom) && $request->urlFrom == 1){
                    $redirectUrl = '/patients/view/'. $request->patientId;
                }
                else{
                    $redirectUrl = '/patient/create/schedular';
                }
                
                if ($checkApoint) {
                     $checkApoint->billing_provider_id = $request->appointment_provider;
                    $checkApoint->rendering_provider_id= $request->apt_rendering_id;
                    $checkApoint->appointment_date = $newAppoint;
                    $checkApoint->appointment_time = $request->appointment_time;
                    $checkApoint->location = $request->appointment_location;
                    $checkApoint->resource = $request->appointment_resource;
                    $checkApoint->recurrene = $request->appointment_recurrene;
                    $checkApoint->appointment_reason = $request->appointment_resason;
                    $checkApoint->meeting_type = $request->appointment_meeting_Type;
                    $checkApoint->duration = $request->appointment_duration;
                     $checkApoint->case_id= $request->appointment_case;
                    $checkApoint->authorised= $request->appointment_authorization;
                    $checkApoint->appointment_addition_info = $request->appointment_additionInfo;
                    $checkApoint->is_interpreter= $request->is_interpreter; 
                    $checkApoint->update();
                    return  $this->redirectToRoute( $redirectUrl, "Patient appointment updated successfully", 'success', ["positionClass" => "toast-top-center"]);
                } else { 
                    $pAppoint = new PatientAppointment();
                    $pAppoint->patient_id = $request->patientId;
                    $pAppoint->billing_provider_id = $request->appointment_provider;
                    $pAppoint->rendering_provider_id= $request->apt_rendering_id;
                    $pAppoint->appointment_date = $newAppoint;
                    $pAppoint->appointment_time = $request->appointment_time;
                    $pAppoint->location = $request->appointment_location;
                    $pAppoint->resource = $request->appointment_resource;
                    $pAppoint->recurrene = $request->appointment_recurrene;
                    $pAppoint->appointment_reason = $request->appointment_resason;
                    $pAppoint->meeting_type = $request->appointment_meeting_Type;
                    $pAppoint->duration = $request->appointment_duration;
                    $pAppoint->status = $statusId; 
                    $pAppoint->case_id= $request->appointment_case;
                    $pAppoint->authorised= $request->appointment_authorization;
                    $pAppoint->appointment_addition_info = $request->appointment_additionInfo;
                    $pAppoint->is_interpreter= $request->is_interpreter;
    
                    // $pAppoint->arrival_time  = $request->patientId;
                    // $pAppoint->notes  = $request->patientId;
                    $pAppoint->save();
                    //return redirect('/patient/create/schedular/' . $request->patientId);
                    return  $this->redirectToRoute( $redirectUrl, "Patient appointment added successfully", 'success', ["positionClass" => "toast-top-center"]);
                }  
            } 
            else{
                return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
            }
            
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    
    
    public function schedularList(Request $request)
    { 
        $newAppoint =  date('Y-m-d'); $patientAppointment = []; $searchKey =null; $durationDate =null; $meetingType =null; $srcProvider = null; 
        $appointMents =  AppointmentReason::where('is_active', 1)->get(); 
        $meetingTypes = $this->patientModel->getMeetingType();
        $billStatus = Status::where("is_active", 1)->where("slug_name", 'APPOINTMENT_BILL_STATUS_READY_TO_BILL')->where("status_type", 6)->orderBy('display_order', 'ASC')->get(); 
        $statuss = Status::where("is_active", 1)->where("status_type", 7)->orderBy('display_order', 'ASC')->get(); 
        $providerIds = []; $renderProviders = []; $locations = []; $srcRendering = ''; $srcLocation= '';
        foreach (Auth::user()->getUserBillingProviders as $usBilling){
            $providerIds[] = $usBilling->provider_id;
             
        } 
        $renderProviders = BillReferingOrderProvider::where('type',4)->whereIn('billing_provider_id',$providerIds)->orderBy('id', 'desc')->get(); 
        $locations = MasterPlaceOfService::whereIn('billing_provider_id', $providerIds)->orderBy('id', 'desc')->get();
        
         $rules = array(
                'keyword' => 'required_without_all:duration_date,appointment_meeting_Type',
                'duration_date' => 'required_without_all:keyword,appointment_meeting_Type',
                'appointment_meeting_Type' => 'required_without_all:keyword,duration_date',
            ); 
        if(empty($request->keyword)  && empty($request->locationId) && empty($request->renderingProviderId) && empty($request->duration_date) && empty($request->appointment_meeting_Type) ){
            $patientAppointment = PatientAppointment::with('getPatient','getBillingProvider', 'getResaons','getRenderingProvider');
            $patientAppointment =  $patientAppointment->where('appointment_date', $newAppoint);
            $patientAppointment =  $patientAppointment->orderBy('appointment_date', 'desc')->get();
        }  
         elseif(!empty($request->keyword) || !empty($request->locationId) || !empty($request->renderingProviderId) || !empty($request->duration_date) || !empty($request->appointment_meeting_Type) ){
             $patientAppointment = PatientAppointment::with('getPatient','getBillingProvider', 'getResaons');
             
             if(!empty($request->keyword)){
                $value = $request->keyword; 
                $searchKey = $value;
                $patientAppointment->orWhereHas('getPatient',function($r)use($value){
                    $r->where('patient_no',$value);
                    $r->orWhere('first_name','LIKE', "%$value%");
                    $r->orWhere('last_name','LIKE', "%$value%");
                }); 
            }
            if(!empty($request->locationId)){ 
                $srcLocation = $request->locationId;
                $patientAppointment =  $patientAppointment->where('location', $request->locationId);
            }
            if(!empty($request->renderingProviderId)){ 
                $srcRendering = $request->renderingProviderId;
                $patientAppointment =  $patientAppointment->where('rendering_provider_id', $request->renderingProviderId);
            }
            if(!empty($request->duration_date)){ 
                $durationDate =  $request->duration_date; 
                $reqDob =  $request->duration_date; 
                $exDate = explode('/', $reqDob); 
                $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
                $reverDate = implode('-', array_reverse($exDate));
                $newAppoint =  date('Y-m-d',strtotime($newBreakDate)); 
                $patientAppointment =  $patientAppointment->where('appointment_date', $newAppoint);
            } 
            if(!empty($request->appointment_meeting_Type)){
                $meetingType = $request->appointment_meeting_Type;
                $patientAppointment =  $patientAppointment->where('meeting_type', $meetingType);
            }
            $patientAppointment =  $patientAppointment->orderBy('appointment_date', 'desc')->get();
         }
            
        return view('patients.schedular.list', compact( ['srcLocation', 'srcRendering', 'locations', 'renderProviders', 'srcProvider',  'patientAppointment', 'appointMents', 'meetingTypes', 'billStatus', 'searchKey', 'durationDate', 'meetingType','statuss'])); 
    }
    function appointmentStatus(Request $request){
        $appointment = PatientAppointment::where('id', $request->appointMentId)->first();
       if($appointment){
            $appointment->status = $request->statusId;
            $appointment->update();
       }  
   }
   function testForm(Request $request){
        // Check if the request is a POST request (typical for webhooks)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if($request['data']['fields'] && count($request['data']['fields']) > 0){
                foreach($request['data']['fields'] as $data){
                DB::table('tally_data')->insert(
                        ['createdAt' => $request['createdAt'], 'eventId' => $request['eventId'], 'eventType' => $request['eventType'],
                        'responseId' => $request['data']['responseId'],'submissionId'=>$request['data']['submissionId'],'respondentId'=>$request['data']['respondentId'], 'formId'=>$request['data']['formId'],
                        'formName'=>$request['data']['formName'], 'fields_key'=>$data['key'], 'fields_label'=>$data['label'],'fields_type'=>$data['type'],'fields_value'=>$data['value'],
                        ]
                    ); 
                } 
            } 
            http_response_code(200);
            echo "Webhook received and processed successfully!";
        } else {
            // If the request is not a POST request, handle it accordingly
            http_response_code(405); // Method Not Allowed
            echo "Only POST requests are allowed for this endpoint.";
        }
    }
    
    public function saveBillServiceProcedureDoc(Request $request)
    {
        // echo  "<pre>";
       // print_r($request->all());exit;  
        try { 
               $this->storeBillServicePrecedureDocument($request); 
         } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function getAllDocuementsByBillId(Request $request)
    {   
        $docArray = ''; 
        $allDocuments = AllDocument::with('getReportType')->where('injury_id' , $request->billId)->get();
        //dd($allDocuments);
        if($allDocuments){
            $i = 1;
            foreach($allDocuments as $document){
                $reportingTypeName = '-';
                if($document->reporting_type != null){
                    $reportingTypeName =  ($document->reporting_type && $document->getReportType && $document->getReportType->report_name) ? $document->getReportType->report_code."-".$document->getReportType->report_name : '-';
                }
                $docArray .= "<tr>";
                    $docArray .= "<td>".$i."</td>";
                    $docArray .= "<td>".$document->description."</td>";
                    $docArray .= "<td><a href=".asset('/injury_document')."/".$document->injury_document.">".$document->injury_document."</a></td>";
                    $docArray .= "<td>".$reportingTypeName."</td>";
                    $docArray .= "<td><a href=".url('/patients/injury/documents')."/".$document->injury_id."/".$document->doc_type."/".$document->id."><i  class='icon-pencil  showPointer'/></i></a>
                    <i  class='icon-trash  showPointer'/></i></td>";
                     $docArray .= "</tr>";
                $i++;
            }
        } 
        return $docArray;
    }

    public function getICDTypeForBill(Request $request){
        $dateOfService = null;
        $icd10Date = date('Y-m-d', strtotime('10/1/2015'));
        $billDos = ($request->dos != null) ? date('Y-m-d', strtotime($request->dos)) : null;
        if($request->injuryId != null){
            $checkInjury = Patient_injury::with('getInjuryClaim')->where('id' , $request->injuryId)->first();
            if($checkInjury){
                if($checkInjury->getInjuryClaim && $checkInjury->getInjuryClaim){
                    //10/1/2015 
                    $injuryDiagnosis = InjuryDiagnosis::where('injury_claim_id', $checkInjury->getInjuryClaim->id)->first();
                    if($injuryDiagnosis){
                        if($injuryDiagnosis->getDianoses && $injuryDiagnosis->getDianoses->code_type){
                            $codeType = $injuryDiagnosis->getDianoses->code_type;
                            if($codeType == 10){
                                if($billDos && $billDos  <= $icd10Date){
                                    return array('errorStatus' =>'error 1', 'icdCode' => 10, 'successStatus' =>null);
                                }
                                else{
                                    return array('successStatus' =>'success 1', 'icdCode' => 10, 'errorStatus' =>null);
                                }
                            } 
                        } 
                    } 
                    else{
                        if($billDos != null){
                            if($billDos  <= $icd10Date){
                                return array('errorStatus' =>'error 2', 'icdCode' => 9, 'successStatus' =>null);
                            }
                            else{
                                return array('errorStatus' =>null, 'icdCode' => 9, 'successStatus' =>'success 2');
                            }
                        }
                    }
                }
                else{
                    if($billDos != null){
                        if($billDos  <= $icd10Date){
                            return array('errorStatus' =>'error 3', 'icdCode' => 9, 'successStatus' =>null);
                        }
                        else{
                            return array('errorStatus' =>null, 'icdCode' => 9, 'successStatus' =>'success 3');
                        }
                    }
                }
            }  
        }
    }
    
    public function getDiagnosisCodesForDC(Request $request){
        if(isset($request->list) && count($request->list) >  0){
            $allDiagnosis = [];
            $diagnosCode = Diagnosis_code ::where('is_active',1)->whereIn('id',$request->list)->get();
            if($diagnosCode){
                foreach($diagnosCode as $key=> $dcCode){
                    $allDiagnosis[] = array('diagnosis_code'=> strtolower($dcCode['diagnosis_code']), 'dc_index' => $key);
                } 
            }
            return $allDiagnosis;
        } 
    }
    
    
    public function storeBillDianosisCode(Request $request){
         if(isset($request->work_dg_code_id)){
            $this->addBillLogs($request, $request->billId, 'Add Diagnosis Codes','BILL_INFO', null);  
             for ( $j=0; $j < count($request->work_dg_code_id); $j++) { 
                if (!empty($request->work_dg_code_id[$j])) {
                    $isBillDignos = BillDiagnosis::where('bill_id', $request->billId)->where('diagnose_code_id', $request->work_dg_code_id[$j])->first();
                    if(!$isBillDignos){
                        $billDiagnos = new BillDiagnosis();
                        $billDiagnos->bill_id = $request->billId;
                        $billDiagnos->diagnose_code_id = $request->work_dg_code_id[$j];
                        $billDiagnos->is_active = 1;
                        $billDiagnos->save();
                    } 
                    else{
                        return redirect('/view/patient/injury/bill/info/'.$request->billId);
                    }
                }  
            } 
        }
        $this->redirectToRoute('/view/patient/injury/bill/info/'.$request->billId, 'Diagnosis code added succefully', 'success', ["positionClass" => "toast-top-center"]);  
    }
    public function storeBillProcedureCodeManual(Request $request){
        if(isset($request->bill_procedure_code) && count($request->bill_procedure_code) > 0){
            $this->addCPDCodesForBill($request, $request->billId);
            $this->addBillLogs($request, $request->billId, 'Add Procedure Code For Bill','BILL_INFO', null); 
            return redirect('/view/patient/injury/bill/info/'.$request->billId);
        }
    }
    
    public function downloadBillPdf(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        DB::beginTransaction();
            $this->storeSentBillDetail($request, null, null); 
            $this->addBillLogs($request, $request->bill_id, 'Add Write of reason Information','BILL_INFO', null); 
        DB::commit();
    }
    public function storeWitreOfReasonForBillClose(Request $request){  
        try {
            DB::beginTransaction();
            $statusId =  $this->getStatusId('CLOSED_BILL'); 
            $stageId =  $this->getStageId('CLOSE_BILL',9); 
            $checkBill = InjuryBill::where('id', $request->billId)->first(); 
            if($checkBill){ 
                $checkBill->bill_provider_write_of_reason   = $request->bill_provider_write_of_reason;
                $checkBill->write_of_reason_description     = $request->write_of_reason_description;
                $checkBill->bill_status                     = $statusId;
                $checkBill->bill_stage                      = $stageId;
                $checkBill->update();
                $this->addBillLogs($request, $request->billId, 'Add Write of reason Information','BILL_INFO', null); 
                if($request->taskId){
                    $taskInfo = TaskAssign::where('id', $request->taskId)->first();
                    if($taskInfo){
                        $taskInfo->delete();
                    } 
                }
            }
            DB::commit();
            return $this->redirectToRoute('/view/patient/injury/bill/info/'.$request->billId, 'Bill closed successfully', 'success', ["positionClass" => "toast-top-center"]); 
        } catch (\Exception $e) {
            DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        } 
    }
    public function patientInjuryDelete(Request $request){ 
        try {
            if($request->id){ 
                $message = '';
                $url = '';

                DB::beginTransaction();
                $pateintInjury = Patient_injury::with('getInjuryClaim')->where('id', $request->id)->first(); 
                if($pateintInjury){
                    
                    if($pateintInjury->getInjuryDocuments()){
                        foreach($pateintInjury->getInjuryDocuments() as $document){
                            $targetPath = public_path('injury_document')."/".$document->injury_document;
                            if (File::exists($targetPath)) { 
                                File::delete($targetPath); 
                                $document->delete(); 
                            }  
                        }
                    }
                    if($pateintInjury->getInjuryBills()){
                        foreach($pateintInjury->getInjuryBills() as $bill){  
                            if($bill->getBillDocuments){
                                foreach($bill->getBillDocuments() as $document2){
                                    $targetPath2 = public_path('injury_document')."/".$document2->injury_document;
                                    if (File::exists($targetPath2)) { 
                                        File::delete($targetPath2); 
                                        $document2->delete(); 
                                    }  
                                }
                            }
                            if($bill->getBillServices){
                                foreach($bill->getBillServices() as $service){
                                    $service->delete(); 
                                } 
                            }
                            if($bill->getBillDiagnosis){
                                foreach($bill->getBillServices() as $diagnos){
                                    $diagnos->delete(); 
                                } 
                            }   
                        }
                    }
                    if($pateintInjury->getInjuryNotes){
                        foreach($pateintInjury->getInjuryNotes() as $note){
                            $note->delete(); 
                        } 
                    }
                    if($pateintInjury->getInjuryContacts){
                        foreach($pateintInjury->getInjuryContacts() as $contact){
                            $contact->delete(); 
                        } 
                    } 
                    if($pateintInjury->getInjuryClaim){
                        foreach($pateintInjury->getInjuryClaim() as $claim){
                            $claim->delete(); 
                        } 
                    }   
                    $pateintInjury->delete();
                    $message = 'Injury deleted successfully';
                    $url = 'patients/view/'.$pateintInjury->patient_id; 
                    $mType = 'success';
                }
                else{
                    $message = 'Injury does not found';
                    $url = 'injury/view/'.$request->id; 
                    $mType = 'error'; 
                } 
                DB::commit();
                return $this->redirectToRoute($url, $message, $mType, ["positionClass" => "toast-top-center"]);
            }
            else{
                return $this->redirectToRoute(redirect()->back(),'Please provide proper id for delete', 'error', ["positionClass" => "toast-top-center"]);
            } 
            
            } catch (\Exception $e) {
               DB::rollback(); 
               return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
            }
    }
    public function patientBillDelete(Request $request){ 
        try {
            if($request->id){ 
                $message = '';
                $url = ''; 
                DB::beginTransaction();
                $bill =  InjuryBill::with('getBillServices','getRenderinPlaceServices','getRenderinProvider', 'getBillDiagnosis', 'getBillDocuments')->where('id', $request->id)->first();
                if($bill){
                    $injuryId = $bill->injury_id; 
                    if($bill->getBillServices){
                        foreach($bill->getBillServices() as $service){
                            $service->delete(); 
                        } 
                    }
                    if($bill->getBillDiagnosis){
                        foreach($bill->getBillServices() as $diagnos){
                            $diagnos->delete(); 
                        } 
                    } 
                    if($bill->getBillDocuments){
                        foreach($bill->getBillDocuments() as $document2){
                            $targetPath2 = public_path('injury_document')."/".$document2->injury_document;
                            if (File::exists($targetPath2)) { 
                                File::delete($targetPath2); 
                                $document2->delete(); 
                                $this->addBillLogs($request, $bill->id, 'Bill Document Deleted', 'BILL_INFO', null); 
                            }  
                        }
                    } 
                    $bill->delete();
                    $this->addBillLogs($request, $bill->id, 'Bill Deleted','BILL_INFO', 'BILL_INFO', null); 
                    $message = 'Bill deleted successfully';
                    $url = '/injury/view/'.$injuryId;
                    $mType = 'success';
                }
                else{
                    $message = 'Bill does not found';
                    $url = 'injury/view/'.$request->id; 
                    $mType = 'error'; 
                } 
                DB::commit();
                return $this->redirectToRoute($url, $message, $mType, ["positionClass" => "toast-top-center"]);
            }
            else{
                return $this->redirectToRoute(redirect()->back(),'Please provide proper id for delete', 'error', ["positionClass" => "toast-top-center"]);
            } 
            
            } catch (\Exception $e) {
               DB::rollback(); 
               return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
            }
    } 
    public function createInjury(Request $request, Patient $patient)
    {
        $injuryContact = new InjuryContact();
        $dCodeLoop = 4; $contact_roles = $injuryContact->contactRoles; $dCode = []; $title = 'Add Injury';
        $injuryId =  null;
        $injuryId = $request->id; $claimStatus = []; $patientId = null; $patient = [];  $injury = []; $pInjuries = [];  $injuryDiagnos = []; $injuryContacts =[];
        if (isset($request->id)) {
            $title = 'Update Injury';
        }
        if (isset($request->pid)) {
            $patientId = $request->pid;
            $patient = $this->setSidebarPatient($patientId);
        }
        $masterData = $this->showStateCityCountry();
        $states = $masterData['states'];

        $claimsAdministers = ClaimAdministrator::orderBy('id', 'desc')->get();
        $medical_providers = MedicalProvider::orderBy('id', 'desc')->get();
        //$diagnoses = $diagnoses = $this->getDiagnosisCode();
         $claimStatus = $this->getActiveData(new ClaimStatus(), 'claim_status');
         $selectedDianos = array();
        $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory')->where('id', $request->id)->first();
        if ($pInjuries) {
            $patientId = $pInjuries->patient_id;
            $patient = $this->setSidebarPatient($patientId);
            $injury = $this->setSidebarInjury($injuryId);
            $injuryDiagnos = InjuryDiagnosis::where('injury_claim_id', $pInjuries->id)->orderBy('id', 'desc')->get();
            if ($injuryDiagnos) {
                foreach ($injuryDiagnos as $code) {
                    $dCode[] = $code['diagnosis_code_id'];
                }
            }
            if($pInjuries->getInjuryClaim){
                if($pInjuries->getInjuryClaim->getInjuryDianoses){
                    foreach($pInjuries->getInjuryClaim->getInjuryDianoses as $dianos){
                            if($dianos->getDianoses){
                                //dd($dianos->getDianoses);
                                $selectedDianos[] = array( "id" => $dianos->getDianoses->id,  "code_type" => $dianos->getDianoses->code_type, "diagnosis_code" => $dianos->getDianoses->diagnosis_code, "diagnosis_name" => $dianos->getDianoses->diagnosis_name, "is_active" => $dianos->getDianoses->is_active, "deleted_at" => $dianos->getDianoses->deleted_at
                                );
                            }
                        }
                    // dd($selectedDianos); 
                }
            }
        }
        return view('patients.injury.create', compact('selectedDianos','contact_roles','injuryId', 'pInjuries', 'injury', 'states', 'patientId', 'title', 'patient', 'claimsAdministers',
            'medical_providers',  'patient', 'injuryDiagnos', 'dCode', 'dCodeLoop', 'claimStatus','injuryContacts'));
    } 
    
    
    public function viewPatientInjuryBill(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        $patientId = null; $patient = null; $injury = null; $patientInjury = []; $injuryBill = []; $totalServiceUnit = 0; $providerId = Null;
        $billServices = [];
        $injuryId = $request->route()->parameter('injuryId');
        $injuiryInfo =  Patient_injury ::where('id',$injuryId)->first(); 
        if($injuiryInfo){
            $patientId =   $injuiryInfo->patient_id;
            $patient = $this->setSidebarPatient($patientId);
            $injury = $this->setSidebarInjury($injuryId);
        }

        $bills = $this->getBillListByInjuryId($injuryId, $patientId);
        $billServices =  $bills['services'];
        $injuryBill = $bills['bills'];
        return view('patients.injury.bills.show', compact('injuryBill','patientId', 'injuryId','patient','injury','billServices'));
    } 

    public function viewPatientInjuryBillInfomationWithCMS(Request $request)
    {
        $billId = $request->route()->parameter('id');
        $providerReasonForCloseBill = [];
        $injuryBillInfo = InjuryBill::with('getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider','getBillDocuments','getBillDiagnosis')->where('id', $billId)->first();
        if($injuryBillInfo){ 
            $this->addBillLogs($request, $injuryBillInfo->id, 'Bill View For CMS','BILL_INFO', null); 
            $patientId = $injuryBillInfo->getInjury->patient->patient_id;
            $injuryId =   $injuryBillInfo->getInjury->injury_id;
            $patient = $this->setSidebarPatient($injuryBillInfo->patient_id);
            $injury = $this->setSidebarInjury($injuryBillInfo->injury_id);
            $diagnos = null; $prefix =''; $claimFaxNumber = null; $claimAddress = null; $secondReviews = [];
            $claimAdmin = null;
            $showSentButton = $this->checkForSenButtonInBillPage($request, $injuryBillInfo);
            //dd($showSentButton);
            
            if($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider && $injuryBillInfo->getInjury->patient->getBillingProvider){
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderSecondReviewReasons){
                    $secondReviews = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderSecondReviewReasons;  
                } 
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
                    $providerReasonForCloseBill = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
                } 
            }
            if($injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->admin_fax_no){
                $claimFaxNumber = $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->admin_fax_no;
            }
            if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0){ 
                foreach($injuryBillInfo->getBillDiagnosis as $dg){
                    $diagnos .= $prefix . $dg->getBillDiagnosisName->diagnosis_code;
                    $prefix = ', ';
                }
            }
            $billLogs = MasterDataLog::where('data_id', $billId)->get();
            //$billStatuss = Status::where('status_type', 9)->get();
            $billStatuss = Status::where('status_type', 9)->orderBy('display_order', 'ASC')->get(); 
            $daysNumber = $this->getTodatlDaysForBill(date('Y-m-d', strtotime($injuryBillInfo->created_at)));
            $txtColor = '';

            $totalDays =    ($daysNumber > 0 && $daysNumber <= 30) ? "1-30" : (($daysNumber > 30 && $daysNumber <= 60)  ? "31-60" : "61+ days"); 
            $txtColor =    ($daysNumber > 0 && $daysNumber <= 30) ? "bill_overdue_days_30" : (($daysNumber > 30 && $daysNumber <= 60)  ? "bill_overdue_days_60" : "bill_overdue_days_90"); 
            $isShowSentButton = false; 
            $taskAssignInfo = TaskAssign::where('task_step_id',$injuryBillInfo->id)->first();
            $modifiersArray = BillModifier::where('status', 1)->get();
            $isFoundCMS = BillCoverSheetCmsForm::where('bill_id', $injuryBillInfo->id)->where('doc_type', 2)->first(); 
            $isFoundCover = BillCoverSheetCmsForm::where('bill_id', $injuryBillInfo->id)->where('doc_type', 1)->first(); 
            //dd($providerReasonForCloseBill);
            return view('patients.injury.bills.show-info-with-cms', compact('providerReasonForCloseBill','isFoundCMS', 'isFoundCover', 'modifiersArray', 'taskAssignInfo','secondReviews','claimFaxNumber', 'claimAddress', 'txtColor', 'isShowSentButton', 'totalDays','billStatuss', 'showSentButton', 'billLogs','diagnos','patientId', 'injuryId', 'patient', 'injury','billId','injuryBillInfo'));
        }
        else{
            return $this->redirectToRoute('/home','This bill does not exist', 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    

    


    public function returnSearchData($billsData, $request){
        $providerName = null; $billObject = []; $getAllSearchBills = [];
       
        //dd($billPaymentOtherInfo);
        foreach($billsData as $searchedBillInfo){  
            if($searchedBillInfo){  
                if($searchedBillInfo->getRenderinProvider){
                    if($searchedBillInfo->getRenderinProvider->referring_provider_first_name){
                        $providerName =  $searchedBillInfo->getRenderinProvider->referring_provider_first_name;
                    }
                    if($searchedBillInfo->getRenderinProvider->referring_provider_last_name){
                        $providerName .=  " ".$searchedBillInfo->getRenderinProvider->referring_provider_last_name;
                    }
                    if($searchedBillInfo->getRenderinProvider->referring_provider_middle_name){
                        $providerName .=  " ".$searchedBillInfo->getRenderinProvider->referring_provider_middle_name;
                    }
                }
                $billPaymentOtherInfo = BillPaymentOther::with('getBillInfoForOtherPayment')->where('bill_payment_id',  $request->billPaymentId)->where('bill_id',  $searchedBillInfo->id)->first();
                if(!$billPaymentOtherInfo){
                    $i=1;
                    $getAllSearchBills[] = array(
                        'billDbId'           =>  $searchedBillInfo->id,
                        'billId'             =>  'Bill00'.$searchedBillInfo->id,
                        'patientFullName'    =>  ($searchedBillInfo->getInjury && $searchedBillInfo->getInjury->patient && $searchedBillInfo->getInjury->patient->full_name) ? $searchedBillInfo->getInjury->patient->full_name : null,
                        'dos'                =>  ($searchedBillInfo->dos) ? date('m-d-Y', strtotime($searchedBillInfo->dos)) : null,
                        'status'             =>  ($searchedBillInfo->getStatus && $searchedBillInfo->getStatus->status_name) ?  $searchedBillInfo->getStatus->status_name : null,
                        'claimAdminName'     =>  $searchedBillInfo->getInjury->getInjuryClaim && $searchedBillInfo->getInjury->getInjuryClaim->getClaimAdmin && $searchedBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name ? ucfirst($searchedBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name) : null,
                        'billCharge'         =>  0,
                        'providerName'       =>  ($providerName != null)  ?  $providerName : null,
                    );
                } 
            }  
        }   
        return  $getAllSearchBills;
    }
    
    public function saveMultiBillPayment(Request $request)
    {
        try {
            DB::beginTransaction(); 
            $billId = null; $step = null; $url = ''; $infoId = null;
            $billId = $request->multiple_bill_id;  
            
            $url = ''; $paymentInId = null;
            if(isset($request->paymentInId)){
                $paymentInId = $request->paymentInId;

                $billPaymentInfo = BillPaymentInformation::where('id', $paymentInId)->first();
                if($billPaymentInfo){
                    $this->storeBilServicesInfo($request, $billId);
                    $this->storeBilPaymentOtherInfo($request, $billPaymentInfo, $billId); 
                    $message = 'Bill payment eor for multiple added successfully';
                    $url =  'search/bill/eor/multiple/'.$paymentInId; 
                    $this->addBillLogs($request, $billId, 'Add Bill Payment First Step Information','DEPOSIT_PAYMENT', null); 
                }
            }
            else{
                $message = 'Bill payment information for multiple added successfully';
                $paymentInId =  $this->storeBilPaymentInformation($request, $billId);
                //$this->storeBillPaymentEORDocuments($request, $billId, 'BILLEOR'); 
                $url =  'bill/payment/postings/submission/multiple/'.$billId.'/'.$paymentInId; 
                $this->addBillLogs($request, $billId, 'Add Bill Payment First Second Information','DEPOSIT_PAYMENT', null);
            }           
            DB::commit(); 
            return $this->redirectToRoute($url, $message, 'success', ["positionClass" => "toast-top-center"]); 
        } catch (\Exception $e) {
            //DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function saveMultiEOBillPayment(Request $request){
        
    }
    
    
    
    public function returnTotalPaymentForThisBill(Request $request){
       return BillPaymentOther::where('bill_payment_id', $request->paymentId)->count();
    }
    public function searchBillForEORMultiple(Request $request)
    {
        $billId = $request->billId; 
        $isSubmission = false;
        $paymentInId = ($request->id ) ? $request->id : null; 
        $stepId = ($request->multiple ) ? $request->multiple : null;  
        $tabId = 'multiple'; $paymentBillId =  null;
        $title = ''; $providerReasonForCloseBill = [];
        $searchBills = [];   $billInfo = [];

        $paymentBillId = ($request->paymentBillId ) ? $request->paymentBillId : null; 

        if ($request->has('searchBillId') && isset($request->searchBillId)) {  
            $str = ltrim($request->searchBillId, 'Bill00');
            $billInfo = InjuryBill::where('id', $str)->first();
            array_push($searchBills, $billInfo); 
        }
        else{ 
            if (isset($request->patientName) &&  isset($request->bill_dos)) {  
                $dos = date('Y-m-d', strtotime($request->bill_dos)); 
                $query = InjuryBill::where('dos', $dos);  
                $query->whereHas('getInjury.patient', function ($subquery) use ($request) {
                    $subquery->where('full_name', 'like', '%' . $request->input('patientName') . '%');  
                }); 
                $billInfo = $query->get();  
            } 
            else if ($request->has('bill_dos') &&  isset($request->bill_dos)) { 
                $dos = date('Y-m-d', strtotime($request->bill_dos));
                $query = InjuryBill::where('dos', $dos); 
                $billInfo = $query->get();   
            }
            else if ($request->has('patientName') &&  isset($request->patientName)) {   
                $query = InjuryBill::query(); 
                $query->whereHas('getInjury.patient', function ($subquery) use ($request) {
                    $subquery->where('full_name', 'like', '%' . $request->input('patientName') . '%');  
                }); 
                $billInfo = $query->get();  
            }
            $this->addBillLogs($request, $billId, 'Search Bill For EOR','DEPOSIT_PAYMENT', null); 
        }
        $searchBills =  $this->returnSearchData($billInfo, $request);
        
        // $injuryBillInfo = InjuryBill::with('getBillPaymentInfo', 'getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider','getBillDocuments','getBillDiagnosis')->where('id', $billId)->first();
        // if($injuryBillInfo){  
        //     $title = 'Post Paper EOR';
        //     $patient = $this->setSidebarPatient($injuryBillInfo->patient_id);
        //     $injury = $this->setSidebarInjury($injuryBillInfo->injury_id);
        //     if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
        //         $providerReasonForCloseBill = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
        //     } 
        //     $billPaymentInfo = BillPaymentInformation::where('id',  $paymentInId)->first();
        //     if($billPaymentInfo){
        //         $paymentBillId = $billPaymentInfo->bill_id;
        //     } 
        //     else{
        //         return $this->redirectToRoute('/bill/payment/postings/new/multiple/'.$injuryBillInfo->id,'This payment id does not exist', 'error', ["positionClass" => "toast-top-center"]);   
        //     }
        //     return view('patients.injury.bills.eor.create-second-search', compact(['paymentBillId','paymentInId', 'injuryBillInfo', 'title','patient','providerReasonForCloseBill','tabId', 'isSubmission', 'searchBills']));
        // }
        $injuryBillInfo = BillPaymentInformation::with('getBillPaymentOtherInfo','getBillInfo')->where('id',  $paymentInId)->first();
        if($injuryBillInfo){
            if($injuryBillInfo->getBillInfo){
                if($injuryBillInfo->getBillInfo){
                    $patient = $this->setSidebarPatient($injuryBillInfo->getBillInfo->patient_id);
                    $injury = $this->setSidebarInjury($injuryBillInfo->getBillInfo->injury_id);
                    if($injuryBillInfo->getBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
                        $providerReasonForCloseBill = $injuryBillInfo->getBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
                    } 
                }
            }
            return view('patients.injury.bills.eor.create-second-search', compact(['paymentBillId','paymentInId', 'injuryBillInfo', 'title','patient','providerReasonForCloseBill','tabId', 'isSubmission', 'searchBills']));
        }
        else{
            return $this->redirectToRoute('/home','This bill does not exist', 'error', ["positionClass" => "toast-top-center"]); 
        }
    } 

    
    
    public function addBillEORSubmissionMultiple(Request $request)
    {
         $billId = $request->billId; 
        $isSubmission = true; $paymentSubmissionInfo = null;
        $paymentInId = ($request->id ) ? $request->id : null; 
        $stepId = ($request->multiple ) ? $request->multiple : null;  
        $tabId = 'multiple';
        $title = ''; $providerReasonForCloseBill = [];
        $injuryBillInfo = InjuryBill::with('getBillPaymentInfo', 'getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider','getBillDocuments','getBillDiagnosis')->where('id', $billId)->first();
        //dd($injuryBillInfo);
        if($injuryBillInfo){  
            $title = 'Post Paper EOR';
            $patient = $this->setSidebarPatient($injuryBillInfo->patient_id);
            $injury = $this->setSidebarInjury($injuryBillInfo->injury_id);
            if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
                $providerReasonForCloseBill = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
            } 
            $paymentSubmissionInfo = BillPaymentOther::where('bill_payment_id', $paymentInId)->where('bill_id', $billId)->first();
            $this->addBillLogs($request, $billId, 'View Multi Step Bill Submission Information','DEPOSIT_PAYMENT', null); 
             return view('patients.injury.bills.eor.create-second-payment', compact(['paymentSubmissionInfo' ,'paymentInId', 'injuryBillInfo', 'title','patient','providerReasonForCloseBill','tabId', 'isSubmission']));
        }
        else{
            return $this->redirectToRoute('/home','This bill does not exist', 'error', ["positionClass" => "toast-top-center"]); 
        }
    } 
    
    public function saveMultiFIrstStep(Request $request)
    {
        try {
            DB::beginTransaction(); 
            $billId = null; $step = null; $url = ''; $infoId = null;
            $billId = $request->multiple_bill_id;  
            $url = ''; $paymentInId = null;
            $message = 'Bill payment information for multiple added successfully'; 
            $this->addBillLogs($request, $billId, 'Add Multiple Payment First Step','DEPOSIT_PAYMENT', null); 
            $paymentInId =  $this->storeBilPaymentInformation($request, $billId); 
            $url =  'bill/payment/postings/submission/multiple/'.$billId.'/'.$paymentInId; 

            if($request->pType != null){
                $url =  'review/multiple/bill/payment/'.$paymentInId; 
            }
            
            // if($request->paymentInId){
            //     $url =  'review/multiple/bill/payment/'.$paymentInId;    
            // }
            // else{
            //     $url =  'bill/payment/postings/submission/multiple/'.$billId.'/'.$paymentInId; 
            // }    
            DB::commit(); 
            return $this->redirectToRoute($url, $message, 'success', ["positionClass" => "toast-top-center"]); 
        } catch (\Exception $e) {
            DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function deletePaymentPost(Request $request)
    {
        try {
            $postId = ($request->id) ? $request->id : null;
            $paymentId = ($request->paymentId) ? $request->paymentId : null;
            $checkBillOthrer = BillPaymentOther::where('id', $postId)->where('bill_payment_id', $paymentId)->first(); 
            if($checkBillOthrer){
                $checkBillService = InjuryBillService::where('id', $checkBillOthrer->bill_service_id)->where('bill_id', $checkBillOthrer->bill_id)->first(); 
                if($checkBillService){
                    $checkBillService->expected_fee_amt                =  0; 
                    $checkBillService->calculated_br_amt               =  0;
                    $checkBillService->original_submission_amt         =  0; 
                    $checkBillService->bill_payment_total_amt          =  0; 
                    $checkBillService->due_balace_amt                  =  0; 
                    $checkBillService->expected_fee_percent            =  0;
                    if($checkBillService->update()){
                        $checkBillOthrer->delete();
                    } 
                } 
                $this->addBillLogs($request, $billId, 'Delete Multiple Payment Second Step Information','DEPOSIT_PAYMENT' , null); 
            }
        } catch (\Exception $e) {
            //DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function editPaymentPosting(Request $request){ 
        $paymentInId  = $request->paymentId;
        $tabId = 'multiple'; 
        $title ='Update payment eor post';
        $injuryBillInfo  = BillPaymentOther::with('getBillInfoForOtherPayment','getPaymentInfo')->where('id', $request->paymentId)->first();  
        if($injuryBillInfo){
            if($injuryBillInfo->getBillInfoForOtherPayment){
                if($injuryBillInfo->getBillInfoForOtherPayment){
                    $patient = $this->setSidebarPatient($injuryBillInfo->getBillInfoForOtherPayment->patient_id);
                    $injury = $this->setSidebarInjury($injuryBillInfo->getBillInfoForOtherPayment->injury_id);
                }
            }
            $this->addBillLogs($request, $injuryBillInfo->bill_id, 'View Bill Multiple Payment Submission Posting' ,'DEPOSIT_PAYMENT' , null); 
        }
        return view('patients.injury.bills.eor.edit-second-payment', compact(['paymentInId', 'injuryBillInfo', 'title', 'tabId', 'patient', 'injury']));
    } 

    public function returnTotalPostPayment($otherPayment){
        //dd($otherPayment);
        $totAmt = 0;
        if($otherPayment && count($otherPayment) > 0){
            foreach($otherPayment as $payment){
                $totAmt += $payment->procedure_payment_total;
            }
        }
        return $totAmt;
    }
    
    public function addBillPaymentEORMultiple(Request $request)
    {
        $billId = $request->billId; 
        $isSubmission = false;
        $paymentInId = ($request->id ) ? $request->id : null; 
        $stepId = ($request->multiple ) ? $request->multiple : null; 
        $paymentBillId = null;
        $tabId = 'multiple';
        $title = ''; $providerReasonForCloseBill = [];
        $pType = ($request->pType ) ? $request->pType : null;  
        $injuryBillInfo = InjuryBill::with('getBillPaymentInfo', 'getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider','getBillDocuments','getBillDiagnosis')->where('id', $billId)->first();
        if($injuryBillInfo){  
            $title = 'Post Paper EOR';
            $patient = $this->setSidebarPatient($injuryBillInfo->patient_id);
            $injury = $this->setSidebarInjury($injuryBillInfo->injury_id);
            if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
                $providerReasonForCloseBill = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
            } 
             if($paymentInId == null){
                 $billPaymentInfo = BillPaymentInformation::where('bill_id',  $billId)->first();
                 if($billPaymentInfo){
                    $paymentInId = $billPaymentInfo->id;
                 } 
            }
            else{
                $billPaymentInfo = BillPaymentInformation::where('id',  $paymentInId)->first();
            } 
            if($billPaymentInfo){
                $paymentBillId = $billPaymentInfo->bill_id;
            } 
            return view('patients.injury.bills.eor.create-second', compact(['pType','billPaymentInfo', 'paymentInId', 'injuryBillInfo', 'title','patient','providerReasonForCloseBill','tabId', 'isSubmission', 'paymentBillId']));
        }
        else{
            return $this->redirectToRoute('/home','This bill does not exist', 'error', ["positionClass" => "toast-top-center"]); 
        }
    }
    
    public function deleteAllDataInTabChange(Request $request)
    {
        $paymentInId = $request->paymentId;
        $billId = $request->billId;
        $checkDoc = AllDocument::where('injury_id', $billId)->where('doc_type', 'BILLEOR')->first();
        if($checkDoc){
            $checkDoc->delete();
            $isAllDocDeleted = 1;
        }
        if($request->paymentId != null && $request->billId != null){
             $billPaymentInfo = BillPaymentInformation::where('id', $paymentInId)->where('bill_id', $billId)->first(); 
        }
        else{
            $billPaymentInfo = BillPaymentInformation::where('bill_id', $billId)->first();
        }  
        if($billPaymentInfo){
            $checkPayment = $this->deleteAllPostingInTabChange($billPaymentInfo);
            //dd($checkPayment);
            if($checkPayment ==1){
               $billPaymentInfo->delete();
            }
        }
        $this->addBillLogs($request, $billId, 'Delete Bill Payment Information When Tab Change' ,'DEPOSIT_PAYMENT' , null); 
       return 1;
    }
    public function addBillPaymentEORSingle(Request $request){  
        // echo "###";exit;
         $billId = $request->billId; 
         $paymentInId = ($request->id ) ? $request->id : null; 
         $tabId = 'first'; 
         $title = ''; $providerReasonForCloseBill = [];
         $injuryBillInfo = InjuryBill::with('getBillPaymentInfo', 'getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider','getBillDocuments','getBillDiagnosis')->where('id', $billId)->first();
         //dd($injuryBillInfo);
         if($injuryBillInfo){  
                $title = 'Post Paper EOR';
                $patient = $this->setSidebarPatient($injuryBillInfo->patient_id);
                $injury = $this->setSidebarInjury($injuryBillInfo->injury_id);
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
                    $providerReasonForCloseBill = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
                } 
                if($paymentInId != null && $request->billId){
                    $billPaymentInfo = BillPaymentInformation::where('id', $paymentInId)->where('bill_id', $billId)->first();
                }
                else{
                    $billPaymentInfo = BillPaymentInformation::where('bill_id', $billId)->first();
                    if($billPaymentInfo){
                        $paymentInId = $billPaymentInfo->id;
                    }
                } 
                $this->addBillLogs($request, $billId, 'View Single Bill Payment Information','DEPOSIT_PAYMENT', null); 

             return view('patients.injury.bills.eor.create-first', compact(['billPaymentInfo','paymentInId', 'injuryBillInfo', 'title','patient','providerReasonForCloseBill','tabId']));
         }
         else{
             return $this->redirectToRoute('/home','This bill does not exist', 'error', ["positionClass" => "toast-top-center"]); 
         }
     }
     public function addBillPaymentDocument(Request $request)
     {
         // echo "<pre>";
         // print_r($request->all());
         // exit;
         //try {
          DB::beginTransaction();  
             $url = ''; $msg = ''; $msgType = ''; $billId = null;
             //dd($request->mainPaymentId);
             if(isset($request->mainPaymentId)){
                 $paymentInId = $request->mainPaymentId; 
                 $billPaymentInfo = BillPaymentInformation::where('id', $paymentInId)->first();
                  if($billPaymentInfo){
                     $this->storeBillPaymentEORDocuments($request, $billPaymentInfo->bill_id, 'BILLEOR'); 
                     $typeMsg = 'Add Bill Payment Document For '.$billPaymentInfo->payment_tab_id;
                     $this->addBillLogs($request, $billPaymentInfo->bill_id, $typeMsg ,'DEPOSIT_PAYMENT'); 
                     $totalOthers = 0;
                     $billId = $billPaymentInfo->bill_id;
                     $checkOtherPayment =  BillPaymentOther::where('bill_payment_id', $billPaymentInfo->id)->get(); 
                     if($checkOtherPayment){
                         $totalOthers = $this->returnTotalPostPayment($checkOtherPayment);
                        //  echo $totalOthers."##"."<br>";
                        //  echo $billPaymentInfo->payment_amount."##"."<br>";
                        //  exit;
                         if($totalOthers != $billPaymentInfo->payment_amount){
                             $msg = 'Does not equal payment amount';
                             $msgType = 'error';
                             $url ='/review/multiple/bill/payment/'.$billPaymentInfo->id;
                         }
                         else{
                             $url ='/view/patient/injury/bill/info/'.$billId;
                             $msg = 'Bill eor payment post successfully';
                             $msgType = 'success';
                             $billPaymentInfo->payment_status = 1;
                             $billPaymentInfo->update();
                         }
                     } 
                 } 
             }   
              DB::commit(); 
             return $this->redirectToRoute($url, $msg , $msgType , ["positionClass" => "toast-top-center"]); 
         // } catch (\Exception $e) {
         //     //DB::rollback();   
         //     return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
         // }
     }
     public function reviewStoremultipleBillPayment(Request $request){ 
        $billId = $request->billId; 
        $isSubmission = false;
        $paymentInId = ($request->paymentId ) ? $request->paymentId : null; 
        $stepId = ($request->multiple ) ? $request->multiple : null;  
        $tabId = 'multiple'; $paymentBillId =  null;
        $title = ''; $providerReasonForCloseBill = [];
        $searchBills = [];   $billInfo = [];

        $billPaymentInfo = BillPaymentInformation::with('getBillPaymentOtherInfo','getBillInfo')->where('id',  $paymentInId)->first();
        if($billPaymentInfo){
            if($billPaymentInfo->getBillInfo){
                if($billPaymentInfo->getBillInfo){
                    $patient = $this->setSidebarPatient($billPaymentInfo->getBillInfo->patient_id);
                    $injury = $this->setSidebarInjury($billPaymentInfo->getBillInfo->injury_id);
                    if($billPaymentInfo->getBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
                        $providerReasonForCloseBill = $billPaymentInfo->getBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
                    } 
                }
            }
            $this->addBillLogs($request, $billPaymentInfo->bill_id, 'View Review Multiple Bill Payment Information Before Save' , 'BILL_INFO', null); 
            return view('patients.injury.bills.eor.create-second-review', compact(['paymentBillId','paymentInId', 'billPaymentInfo', 'title','patient','providerReasonForCloseBill','tabId', 'isSubmission', 'searchBills']));
        }
        else{
            return $this->redirectToRoute('/home','This bill does not exist', 'error', ["positionClass" => "toast-top-center"]); 
        } 
    }
    public function saveSingleBillPayment(Request $request)
    {
        try {
            DB::beginTransaction();
            $message = 'Bill payment information added successfully';
            $billId = null; $step = null; $url = ''; $infoId = null;
            if($request->stepType == 1){
                $billId = $request->single_bill_id;
                if(isset($request->paymentInId)){
                     $url =  'bill/payment/postings/update/first/'.$billId.'/'.$request->paymentInId;
                     $message = 'Bill payment information updated successfully';
                }
                else{
                    $url =  'bill/payment/postings/new/first/'.$billId;
                } 
            } 
            $this->storeBilPaymentInformation($request, $billId);
            $this->addBillLogs($request, $billId, 'Add Single Payment For Bill', 'BILL_INFO' , null); 
            $this->storeBillPaymentEORDocuments($request, $billId, 'BILLEOR');
            $this->addBillLogs($request, $billId, 'Add Document For Single Bill Payment', 'BILL_INFO' , null);  
            DB::commit();

            return $this->redirectToRoute($url, $message, 'success', ["positionClass" => "toast-top-center"]); 
        } catch (\Exception $e) {
            //DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    } 
    public function storeBillPaymentPCDAMount(Request $request)
    {
        $isSubmission = false; $tabId = 'multiple';
        $billId = $request->billId;  
        $stepId = null; $isSubmission = false;
        $paymentInId = ($request->paymentId ) ? $request->paymentId : null;  
        $providerReasonForCloseBill = [];
        if($paymentInId != ''){
            $billPaymentInfo = BillPaymentInformation::where('id', $paymentInId)->first(); 
        }
        $injuryBillInfo = InjuryBill::with('getBillPaymentInfo', 'getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider','getBillDocuments','getBillDiagnosis')->where('id', $billId)->first();
        if($injuryBillInfo){  
            $title = 'Post Paper EOR';
            $patient = $this->setSidebarPatient($injuryBillInfo->patient_id);
            $injury = $this->setSidebarInjury($injuryBillInfo->injury_id);
            if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
                $providerReasonForCloseBill = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
            } 
            $paymentSubmissionInfo = BillPaymentOther::where('bill_payment_id', $paymentInId)->where('bill_id', $billId)->first(); 
            return view('patients.injury.bills.eor.create-second-payment', compact(['paymentSubmissionInfo', 'billId','providerReasonForCloseBill','patient','paymentInId', 'injuryBillInfo', 'title', 'tabId', 'billPaymentInfo','isSubmission']));
        }
        else{
            return $this->redirectToRoute('/home','This bill does not exist', 'error', ["positionClass" => "toast-top-center"]); 
        }
    }
    public function saveMultiBillPaymentPost(Request $request)
    {
        //try {
           //DB::beginTransaction(); 
        //    echo "<pre>";
        //    print_r($request->all());exit;
            $billId = null; $step = null; $url = ''; $infoId = null;
            $billId = $request->multiple_bill_id; 
            
            $url = ''; $paymentInId = null;
            if(isset($request->paymentInId)){
                $paymentInId = $request->paymentInId;

                $billPaymentInfo = BillPaymentInformation::where('id', $paymentInId)->first();
                if($billPaymentInfo){
                    $this->storeBilServicesInfo($request, $billId);
                    $this->storeBilPaymentOtherInfo($request, $billPaymentInfo, $billId); 
                    $this->addBillLogs($request, $billId, 'Add Bill EOR Submission' , 'BILL_INFO' , null); 
                    return 1;
                }
            }       
            //DB::commit(); 
        return $this->redirectToRoute($url, $message, 'success', ["positionClass" => "toast-top-center"]); 
        // } catch (\Exception $e) {
        //     //DB::rollback();   
        //     return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        // }
    }
    public function editMultiBillPaymentPost(Request $request)
    {
        try {
            //DB::beginTransaction(); 
            //    echo "<pre>";
            //    print_r($request->all());exit; 
                $url = '';
                if(isset($request->paymentInId)){
                    $paymentInId = $request->paymentInId; 
                    $billPaymentOtherInfo = BillPaymentOther::where('id', $paymentInId)->first();
                    //dd($billPaymentOtherInfo);
                    if($billPaymentOtherInfo){
                        $billPaymentInfo = BillPaymentInformation::where('id', $billPaymentOtherInfo->bill_payment_id)->first();
                        $this->storeBilServicesInfo($request, $billPaymentOtherInfo->bill_id);
                        $this->storeBilPaymentOtherInfo($request, $billPaymentInfo, $billPaymentOtherInfo->bill_id); 
                        $this->addBillLogs($request, $billId, 'Update Bill EOR Submission' , 'BILL_INFO', null);   
                        $url ='review/multiple/bill/payment/'.$billPaymentOtherInfo->bill_payment_id;
                    }
                }       
             DB::commit(); 
            return $this->redirectToRoute($url, 'Bill eor payment post successfully', 'success', ["positionClass" => "toast-top-center"]); 
        } catch (\Exception $e) {
            //DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    } 
    public function createInjuryBill(Request $request, Patient $patient)
    {
        $injuryId = ($request->injuryId) ? $request->injuryId : null;
        $billId = ($request->id) ? $request->id : null;  $diagnosesType =  10; 
        $diagnosis_Codes = []; $pInjuries = []; $addedDiagnosis = 0; $diagnoses = [];  $injuryBillInfo = [];   $service_lineCnt = 2; $billServices = [];   $billServiceArray = [];    $dCode = [];    $patient = [];   $injury = [];  $patientId  = null;   
        $masterPlaceServices = []; $work_dg_code_id = [];  $billPlaceServices = []; $billRenderinProviders = [];
        $title = ($billId != null) ? 'Update Bill' : 'Add Bill'; $addedProviderType = []; $refereingProviders = []; $referingOrderProviders = []; $providerTypeArr = [];
        $providers = []; $refProviderForEdit = []; $providerid = null; $diegonisCodeIDS = []; $diegonisCodeIDS = [];
        $diCodeForEdit = [];
        if(isset($request->injuryId)){
            if($injuryId != null){
                $pInjuries = Patient_injury::with('getInjuryClaim','getInjuryNotes','getInjuryDocuments','getInjuryHistory','getInjuryContacts')->where('id', $injuryId)->first();
                if($pInjuries){
                    $patientId  = $pInjuries->patient_id;
                    $providerid = ($pInjuries->patient) ? $pInjuries->patient->billing_provider_id : null;
                    if ($pInjuries->getInjuryClaim) {
                        if($pInjuries->getInjuryClaim->getInjuryDianoses){
                            foreach ($pInjuries->getInjuryClaim->getInjuryDianoses as $code) {
                                $diagnoses[] =  $code->getDianoses ;
                                //$diagnosesType = ($code->getDianoses && $code->getDianoses->code_type != null) ? $code->getDianoses->code_type : 10;
                                if($code['diagnosis_code_id'] != null){
                                    $dCode[] = $code['diagnosis_code_id']; 
                                    $diCodeForEdit[] = $code->getDianoses;
                                }
                            }
                        }
                    }
                }
                $injury = $this->getInjuryClaimDate($patientId, $injuryId);
                $patient = Patient::with('getBillingProvider', 'getInjuries')->Where('id', $patientId)->orderBy('created_at', 'desc')->first();
                if($patient){
                    $masterPlaceServices = MasterPlaceOfService::where('billing_provider_id', $patient->billing_provider_id)->where('is_active', 1)->get();
                    $billRenderinProviders = BillReferingOrderProvider::where('billing_provider_id', $patient->billing_provider_id)->where('type', 4)->where('is_active', 1)->get();
                }
                if (count($dCode) > 0) {
                    $cnt = 4;
                    if(count($dCode) >= 4){
                        $diagnosis_Codes = 1;
                    } 
                    else{
                        $leftCnt = $cnt - count($dCode);
                        $diagnosis_Codes = $leftCnt;
                    }
                } else {
                    $diagnosis_Codes = 4;
                }
            }
            
            if($billId != null){
                $injuryBillInfo =  InjuryBill::with('getBillServices','getRenderinPlaceServices','getRenderinProvider')->where('id', $billId)->first();
                //dd($injuryBillInfo);
                if ($injuryBillInfo) {
                    $service_lineCnt = (count($injuryBillInfo->getBillServices)  + 1);
                    $diagnosesType = ($injuryBillInfo->diagnosis_code_type != null) ? $injuryBillInfo->diagnosis_code_type : 10;     
                    if($injuryBillInfo->bill_provider_type != null){ 
                        if( strpos($injuryBillInfo->bill_provider_type, ',') !== false ) {
                            $addedProviderType = explode(',',$injuryBillInfo->bill_provider_type);
                            if(count($addedProviderType) > 0 ){
                                foreach($this->patientModel->getReferingOrderProviders() as $ref){
                                    foreach($addedProviderType as $aded){
                                        if($aded == $ref['id']){
                                            $providers[] = $ref;
                                        }
                                        elseif($aded != $ref['id']){
                                            $referingOrderProviders [] = $ref;
                                        }
                                    }
                                }
                                $refProviderForEdit =  array_map("unserialize", array_unique(array_map("serialize", $providers)));
                            }
                        }
                        else{
                            foreach($this->patientModel->getReferingOrderProviders() as $ref){
                                if($injuryBillInfo->bill_provider_type == $ref['id']){
                                    $providers[] = $ref;
                                }
                                elseif($injuryBillInfo->bill_provider_type != $ref['id']){
                                    $referingOrderProviders [] = $ref;
                                }
                            }
                            $refProviderForEdit =  array_map("unserialize", array_unique(array_map("serialize", $providers)));
                        }
                    }
                    else{
                        $referingOrderProviders =  $this->patientModel->getReferingOrderProviders();
                    }
                    if($injuryBillInfo && $injuryBillInfo->getBillDiagnosis ){
                        //dd($injuryBillInfo->getBillDiagnosis);
                        $diCodeForEdit = [];
                        foreach ($injuryBillInfo->getBillDiagnosis as $code) {
                            $diagnoses[] =  $code->getBillDiagnosisName;
                             if($code['diagnose_code_id'] != ''){
                                $dCode[] = $code['diagnose_code_id'];
                                $diegonisCodeIDS[] = $code['diagnose_code_id']; 
                                $diCodeForEdit[] = $code->getBillDiagnosisName;
                            } 
                        } 
                    }
                }
            }
            else{
                $referingOrderProviders =  $this->patientModel->getReferingOrderProviders();
            }  
            $billingTemplate = ProviderBillingTemplate::where('provider_id', $providerid)->get();
            $referingOrderProviders =  array_unique($referingOrderProviders, SORT_REGULAR );
            $modifiersArray = BillModifier::where('status', 1)->get(); 
           // echo $diagnosesType."##";exit;
           
            return view('patients.injury.bills.create', compact('diCodeForEdit','diegonisCodeIDS','billingTemplate','refProviderForEdit','addedProviderType','addedDiagnosis','pInjuries','diagnoses','diagnosesType','refereingProviders','referingOrderProviders', 'service_lineCnt', 'work_dg_code_id', 'diagnosis_Codes', 'billServiceArray', 'title', 'diagnoses', 'injuryId', 'patientId', 'billId',
                'injuryBillInfo', 'billServices', 'billRenderinProviders', 'billPlaceServices', 'masterPlaceServices', 'modifiersArray', 'dCode', 'patient', 'injury'));
        }
        else{
            Toastr::error('This record does not exist', '', ["positionClass" => "toast-top-center"]);
            return redirect('/patients/view',$patient->id);
        }
    }
    public function getSearchDiagnosis(Request $request){
        $str =  $request->q; 
       $type =  $request->type;
       $dcCodeID =  $request->dcCodeID;
       return  $this->diagnosisCodeForDropDown($str, $type, $dcCodeID);
    }
    public function deleteBillDiagnosis(Request $request){
        $billId =  $request->billId; 
        $checkDignosis = BillDiagnosis::where('id', $billId)->first();
        if($checkDignosis){
            $checkDignosis->delete();
        }
        return 1;
    }

    public function getDignosisCOdeCharacterInBillViewPage($dcValues, $finalArray, $character)
    {
        //   echo "<pre>";
        //   print_r($dcValues);
        //   print_r($finalArray);
        //   print_r($character);exit;
        // $charDC = '';
        // if (is_array($dcValues) || is_object($dcValues)) {
        //     foreach($dcValues as $val){
        //          foreach ($character as $key => $char){ 
        //             if (isset($finalArray[$key]) && is_array($finalArray[$key])){
        //                 if (array_key_exists('dc', $finalArray[$key])){ 
        //                     if($finalArray[$key]['dc'] == $val){
        //                           $charDC .= strtoupper($char).","; 
        //                     } 
        //                 }
        //             }
        //         }  
        //     }
        // }exit;
        // return $charDC;  
        // echo "<pre>";
        // print_r($dcValues);
        // echo "<br>";
        // echo "matching values";
        // echo "<pre>";
        // print_r($finalArray);
        // echo "<br>";
        // echo "final array values";
        // echo "<pre>";
        // print_r($character);
        // echo "<br>";
        // echo "character array values";exit; 
         

         $charDC = ''; // Initialize the variable to store the result

        // Create a mapping of 'dc' values to characters
        $dcCharacterMapping = [];
        foreach ($finalArray as $charArray) {
            if (isset($charArray['dc'])) {
                $dcCharacterMapping[trim(strtoupper($charArray['dc']))] = true;
            }
        }
        
        if (is_array($dcValues) || is_object($dcValues)) {
            foreach ($dcValues as $val) {
                // Check if the 'dc' value exists in the mapping
                $val = trim(strtoupper($val)); // Trim and convert to uppercase for consistency
                if (isset($dcCharacterMapping[$val])) {
                    // Find the corresponding character in $character
                    $index = array_search($val, array_map('trim', array_map('strtoupper', $dcValues)));
                    if ($index !== false && isset($character[$index])) {
                        $charDC .= strtoupper($character[$index]) . ",";
                    }  
                }  
            } 
            // Remove the trailing comma if any
            $charDC = rtrim($charDC, ',');
        }
        
        // Output the final result
        echo $charDC;
    }
    public function viewPatient(Request $request)
    {
        $patientInjury = [];
        if(isset($request->id)){
            $patient =  $this->getPatientById($request->id);
            if($patient){
                $patientId = $request->id;
                $injury = $this->getInjuryClaimDate($patientId, null);
                $meetingTypes = $this->patientModel->getMeetingType();
                $patientAppointment = PatientAppointment::where('patient_id', $patientId )->take(5)->orderBy('appointment_date', 'desc')->get();

                if($patient && $patient->getInjuries){
                    $pInjuries = $patient->getInjuries;
                }
                $this->setSidebarPatient($patientId);
                //dd($patientAppointment);
                return view('patients.show', compact('patientAppointment','patient', 'pInjuries', 'patientId', 'injury', 'meetingTypes', 'patientAppointment'));
            }
            else{
                return $this->redirectToRoute('/patients', trans('bill.record_not_found'), 'error', ["positionClass" => "toast-top-center"]);
            }
        }else{
            return  $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function savePatienInjurytBill(Request $request)
    {
        try {
            DB::beginTransaction();
            $bill_Id = $this->storeInjuryBillInfo($request); 
            $bDescription = ($request->billId) ? 'Update Bill' : 'Add Bill'; 
            $this->addBillLogs($request, $request->billId, $bDescription, 'BILL_INFO', null); 
            DB::commit();
            $message =  trans('bill.bill_added');
            //$url =  'injury/view/' . $request->injuryId;
            if(isset($request->billId)){
                $message = trans('bill.bill_updated');
                
            }
            $url =  'view/patient/injury/bill/info/' .$bill_Id; 
            return $this->redirectToRoute($url, $message, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
            DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.bill_created_successfully'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function viewPatientInjuryBillInfomation(Request $request)
    {
        $billId = $request->route()->parameter('id');
        $providerReasonForCloseBill = [];
        $injuryBillInfo = InjuryBill::with('getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider','getBillDocuments','getBillDiagnosis')->where('id', $billId)->first();
        if($injuryBillInfo){ 
            $this->addBillLogs($request, $injuryBillInfo->id, 'Bill View','BILL_INFO', null); 
            $patientId = $injuryBillInfo->getInjury->patient->patient_id;
            $injuryId =   $injuryBillInfo->getInjury->injury_id;
            $patient = $this->setSidebarPatient($injuryBillInfo->patient_id);
            $injury = $this->setSidebarInjury($injuryBillInfo->injury_id);
            $diagnos = null; $prefix =''; $claimFaxNumber = null; $claimAddress = null; $secondReviews = [];
            $claimAdmin = null;
            $showSentButton = $this->checkForSenButtonInBillPage($request, $injuryBillInfo);
            //dd($showSentButton);
            
            if($injuryBillInfo && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->patient && $injuryBillInfo->getInjury->patient->getBillingProvider && $injuryBillInfo->getInjury->patient->getBillingProvider){
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderSecondReviewReasons){
                    $secondReviews = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderSecondReviewReasons;  
                } 
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons){ 
                    $providerReasonForCloseBill = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderWriteOfReasons; 
                } 
            }
            if($injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->admin_fax_no){
                $claimFaxNumber = $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->admin_fax_no;
            }
            if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0){ 
                foreach($injuryBillInfo->getBillDiagnosis as $dg){
                    $diagnos .= $prefix . $dg->getBillDiagnosisName->diagnosis_code;
                    $prefix = ', ';
                }
            }
            $billLogs = PatientInjuryBillog::where('bill_id', $billId)->get();

            //$billStatuss = Status::where('status_type', 9)->get();
            $billStatuss = Status::where('status_type', 9)->orderBy('display_order', 'ASC')->get(); 
            $daysNumber = $this->getTodatlDaysForBill(date('Y-m-d', strtotime($injuryBillInfo->created_at)));
            $txtColor = '';

            $totalDays =    ($daysNumber > 0 && $daysNumber <= 30) ? "1-30" : (($daysNumber > 30 && $daysNumber <= 60)  ? "31-60" : "61+ days"); 
            $txtColor =    ($daysNumber > 0 && $daysNumber <= 30) ? "bill_overdue_days_30" : (($daysNumber > 30 && $daysNumber <= 60)  ? "bill_overdue_days_60" : "bill_overdue_days_90"); 
            $isShowSentButton = false; 
            $taskAssignInfo = TaskAssign::where('task_step_id',$injuryBillInfo->id)->first();
            $modifiersArray = BillModifier::where('status', 1)->get();
            $isFoundCMS = BillCoverSheetCmsForm::where('bill_id', $injuryBillInfo->id)->where('doc_type', 2)->first(); 
            $isFoundCover = BillCoverSheetCmsForm::where('bill_id', $injuryBillInfo->id)->where('doc_type', 1)->first(); 
            //dd($providerReasonForCloseBill);
            return view('patients.injury.bills.show-info', compact('providerReasonForCloseBill','isFoundCMS', 'isFoundCover', 'modifiersArray', 'taskAssignInfo','secondReviews','claimFaxNumber', 'claimAddress', 'txtColor', 'isShowSentButton', 'totalDays','billStatuss', 'showSentButton', 'billLogs','diagnos','patientId', 'injuryId', 'patient', 'injury','billId','injuryBillInfo'));
        }
        else{
            return $this->redirectToRoute('/home','This bill does not exist', 'error', ["positionClass" => "toast-top-center"]);
        }
    }
}