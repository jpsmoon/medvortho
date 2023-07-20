<?php

namespace App\Http\Controllers;

use App\Models\{AppointmentReason, ProviderBillingTemplateServiceItem, ProviderBillingTemplate, Status, AllDocument, State, InjuryContact, MasterDataLog, Service_code, ReportType, BillingProviderCharge, BillingProviderChargeProcedureCode,
BillingProvider,BillModifier,ClaimAdministrator,ClaimStatus,Country,Health_provider,InjuryBill,InjuryBillService,InjuryDiagnosis,
MasterPlaceOfService,MedicalProvider,ModifierCode,Patient,PatientAppointment,Patient_injury,ProcedureCode, RenderinProvider, BillReferingOrderProvider, Diagnosis_code
};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Toastr;
use DB;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PatientController extends Controller
{
    protected $patientModel;
    public function __construct(Patient $patientMod )
    {
        $this->middleware('permission:Patient-list|Patient-create|Patient-edit|Patient-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:Patient-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Patient-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Patient-delete', ['only' => ['destroy']]);
        $this->patientModel = $patientMod;
    }
    public function index(Request $request)
    {
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
            
                $checkApoint = PatientAppointment::where('patient_id', $request->patientId)->where('appointment_date', $newAppoint)->first();
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
                    $checkApoint->status = $request->appointment_status; 
                    $checkApoint->case_id= $request->appointment_case;
                    $checkApoint->authorised= $request->appointment_authorization;
                    $checkApoint->appointment_addition_info = $request->appointment_additionInfo;
    
                    $checkApoint->update();
                    return  $this->redirectToRoute('/patient/create/schedular', "Patient appointment updated successfully", 'success', ["positionClass" => "toast-top-center"]);
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
                    $pAppoint->status = $request->appointment_status; 
                    $pAppoint->case_id= $request->appointment_case;
                    $pAppoint->authorised= $request->appointment_authorization;
                    $pAppoint->appointment_addition_info = $request->appointment_additionInfo;
    
                    // $pAppoint->arrival_time  = $request->patientId;
                    // $pAppoint->notes  = $request->patientId;
                    $pAppoint->save();
                    //return redirect('/patient/create/schedular/' . $request->patientId);
                    return  $this->redirectToRoute('/patient/create/schedular', "Patient appointment added successfully", 'success', ["positionClass" => "toast-top-center"]);
                }  
            } 
            else{
                return $this->redirectToRoute(redirect()->back(), 'something went wrong', 'error', ["positionClass" => "toast-top-center"]);
            }
            
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
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
                $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
            } 
        }
        else{
            Toastr::error('This record does not exist', '', ["positionClass" => "toast-top-center"]);
            $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
        } 
        return view('patients.edit', compact('injury', 'patient', 'states', 'billingproviders', 'patientId'));
    }

    

    public function viewPatientInjuryBillInfomation(Request $request)
    {
        $billId = $request->route()->parameter('id');
        $injuryBillInfo = InjuryBill::with('getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider','getBillDocuments','getBillDiagnosis')->where('id', $billId)->first();
        if($injuryBillInfo){
            $patientId = $injuryBillInfo->patient_id;
            $injuryId = $injuryBillInfo->injury_id;
        }
        $patient = $this->setSidebarPatient($patientId);
        $injury = $this->setSidebarInjury($injuryId);
        $diagnos = null; $prefix ='';
        if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0){ 
            foreach($injuryBillInfo->getBillDiagnosis as $dg){
                $diagnos .= $prefix . $dg->getBillDiagnosisName->diagnosis_code;
                $prefix = ', ';
    
                // if($diagnos){
                //   $diagnos =  $diagnos->getBillDiagnosisName->diagnosis_code.","; 
                // } 
            }
        }
        $billLogs = MasterDataLog::where('data_id', $billId)->get();
        //$billLogs = $injuryBillInfo->getBillHistory;
        return view('patients.injury.bills.show-info', compact('billLogs','diagnos','patientId', 'injuryId', 'patient', 'injury','billId','injuryBillInfo'));
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
        $patient = Patient::with('getBillingProvider', 'getInjuries')->Where('id', $patientId);
        $patient = $patient->orderBy('created_at', 'desc')->first();
        $claimStatus = $this->getActiveData(new ClaimStatus(), 'claim_status');

        $pInjuries = [];

        return view('patients.injury.sbr.create', compact('reportType', 'injuryId', 'pInjuries', 'injury', 'patientId', 'title', 'patient', 'claimsAdministers',
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
    public function getSearchDiagnosis(Request $request){
        $str =  $request->q; 
       $type =  $request->type;
       return  $diagnoses = $this->diagnosisCodeForDropDown($str, $type);
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
            return $this->redirectToRoute('/patients', 'Patient updated successfully', 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    
    public function createInjury(Request $request, Patient $patient)
    {
        $injuryContact = new InjuryContact();
        $dCodeLoop = 4; $contact_roles = $injuryContact->contactRoles; $dCode = []; $title = 'Add Injury';
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
    public function savePatienInjurytBill(Request $request)
    {
         //try {
            DB::beginTransaction();
            $bill_Id = $this->storeInjuryBillInfo($request); 
            DB::commit();
            $message = 'Bill created successfully';
            //$url =  'injury/view/' . $request->injuryId;
            if(isset($request->billId)){
                $message = 'Bill updated successfully';
                
            }
            $url =  'view/patient/injury/bill/' .  $request->injuryId; 
            return $this->redirectToRoute($url, $message, 'success', ["positionClass" => "toast-top-center"]);
           
        // } catch (\Exception $e) {
        //     DB::rollback();   
        //     return $this->redirectToRoute(redirect()->back(), 'Bill created successfully', 'error', ["positionClass" => "toast-top-center"]);
        // }
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
    
    public static function changeUnderScoreToSpace($str){
        $changedStr =  ucfirst(strtolower(str_replace('_', ' ', $str)));
         return $changedStr;
    } 
    public function getDiagnosisCodeInfo(Request $request){
        $str =  $request->dc;
        $diagnosCode = Diagnosis_code ::where('is_active',1)->where('id',$str)->first();
        if($diagnosCode){
            return strtolower($diagnosCode['diagnosis_code']);
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
                return  $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
            }
        }
        return view('patients.schedular.index', compact('meetingTypes','locations','appointMents','patientInfo', 'patients', 'pateintJsonData', 'patientId', 'states', 'billingproviders', 'status', 'patientAppointment'));
        
    }
    public function injuryStore(Request $request)
    {
        try {
            $patient_id = $this->storeBillInfo($request);
            return $this->redirectToRoute(redirect()->back(), 'Patient injury created successfully', 'success', ["positionClass" => "toast-top-center"]);
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
            return $this->redirectToRoute(redirect()->back(), 'Something went wrong', 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    
    public function saveInjuryBillDocuments(Request $request){
        //InjuryDocument
       //dd($request->all());exit;
       
       try {
        DB::beginTransaction();
        $this->storeInjuryDocuments($request);
        DB::commit();
        if($request){
            $url = '';
            if($request->docType == 'Bill'){
                $url =  '/view/patient/injury/bill/info/' . $request->injuryId;
            }
            else if($request->docType == 'Injury'){
                $url =  '/injury/view/' . $request->injuryId; 
            }
            else if($request->docType == 'Provider'){
                //$url =  '/billing/providers/setting/' . $request->providerId; 
                $url = 'patients/injury/documents/'.$request->providerId."/".$request->docType;
            }
            return $this->redirectToRoute($url, 'Document created successfully', 'success', ["positionClass" => "toast-top-center"]);
        }
       // 
        } catch (\Exception $e) {
           DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function patientInjuryContactDelete(Request $request){ 
    try {
        if($request->id){
            $url = '/injury/view/'.$request->injuryId;
            DB::beginTransaction();
            $result =  $this->deleteInjuryContact($request);
            DB::commit();
            if($result == 1){
                return $this->redirectToRoute($url, 'Injury contact deleted successfully', 'success', ["positionClass" => "toast-top-center"]);
            }
            else{
                return $this->redirectToRoute(redirect()->back(), 'Please provide proper contact id for delete', 'error', ["positionClass" => "toast-top-center"]);
            }
        }
        else{
            return $this->redirectToRoute(redirect()->back(), 'Please provide proper contact id for delete', 'error', ["positionClass" => "toast-top-center"]);
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
    public function createInjuryBill(Request $request, Patient $patient)
    {
        $injuryId = ($request->injuryId) ? $request->injuryId : null;
        $billId = ($request->id) ? $request->id : null;  $diagnosesType =  10; 
        $diagnosis_Codes = []; $pInjuries = []; $addedDiagnosis = 0;
        $diagnoses = [];  $injuryBillInfo = [];   $service_lineCnt = 2; $billServices = [];   $billServiceArray = [];    $dCode = [];    $patient = [];   $injury = [];  $patientId  = null;   
        $masterPlaceServices = []; $work_dg_code_id = [];  $billPlaceServices = []; $billRenderinProviders = [];
        $title = ($billId != null) ? 'Update Bill' : 'Add Bill';
        $addedProviderType = []; $refereingProviders = []; $referingOrderProviders = []; $providerTypeArr = [];
        $providers = []; $refProviderForEdit = []; 
        $providerid = null;
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
                                $dCode[] = $code['diagnosis_code_id'];
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
                }
            }
            else{
                $referingOrderProviders =  $this->patientModel->getReferingOrderProviders();
            } 
            $billingTemplate = ProviderBillingTemplate::where('provider_id', $providerid)->get();
            $referingOrderProviders =  array_unique($referingOrderProviders, SORT_REGULAR );
            $modifiersArray = BillModifier::where('status', 1)->get(); 
           // echo $diagnosesType."##";exit;
            return view('patients.injury.bills.create', compact('billingTemplate','refProviderForEdit','addedProviderType','addedDiagnosis','pInjuries','diagnoses','diagnosesType','refereingProviders','referingOrderProviders', 'service_lineCnt', 'work_dg_code_id', 'diagnosis_Codes', 'billServiceArray', 'title', 'diagnoses', 'injuryId', 'patientId', 'billId',
                'injuryBillInfo', 'billServices', 'billRenderinProviders', 'billPlaceServices', 'masterPlaceServices', 'modifiersArray', 'dCode', 'patient', 'injury'));
        }
        else{
            Toastr::error('This record does not exist', '', ["positionClass" => "toast-top-center"]);
            return redirect('/patients/view',$patient->id);
        }
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
                return $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
            }
       }
       else{
        return view('patients.create', compact('states', 'billingproviders','title','patient','patientId','injury'));
       }
    }
    public function store(Request $request)
    {
       try {
            if(isset($request->patient_id)){
                $patient =  $this->getPatientById($request->patient_id);
                if($patient){
                    $patient_id = $this->storePatientInfo($request);
                    $url = 'edit/patient/'.$patient_id;
                    return  $this->redirectToRoute($url, 'Patient updated successfully', 'success', ["positionClass" => "toast-top-center"]);
                }
                else{
                    return  $this->redirectToRoute('/patients', 'This patient does not exist', 'error', ["positionClass" => "toast-top-center"]);
                }
            }
            else{
                $patient_id = $this->storePatientInfo($request);
                $url = 'create/patients/injury/'.$patient_id;
                return  $this->redirectToRoute($url, 'Patient added successfully', 'success', ["positionClass" => "toast-top-center"]);
            }
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function viewPatient(Request $request)
    {
        $patientInjury = [];
        if(isset($request->id)){
            $patient =  $this->getPatientById($request->id);
            //dd($patient->getPatientHistory);
            if($patient){
                $patientId = $request->id;
                $injury = $this->getInjuryClaimDate($patientId, null);

                if($patient && $patient->getInjuries){
                    $pInjuries = $patient->getInjuries;
                }
                $this->setSidebarPatient($patientId);
               // dd($patient);
                return view('patients.show', compact('patient', 'pInjuries', 'patientId', 'injury'));
            }
            else{
                return $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
            }
        }else{
            return  $this->redirectToRoute('/patients', 'This record does not exist', 'error', ["positionClass" => "toast-top-center"]);
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
    public function addDocuments(Request $request, Patient $patient)
    {
        // echo  "<pre>";
        // print_r($request->id);exit;
        //echo "###".$request->pid."==".$request->id;exit; 
        
        try {
            $head = 'Add '; $documents = []; $id= null; $providerId = null;
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
            }
            if($request->type == 'Provider'){
                $providerId = $request->injuryId;
            }
             $uu = ($request->type == 'Provider')  ? '/billing/providers/setting/' :  (($request->type == 'Bill') ? '/view/patient/injury/bill/info/' : '/injury/view/');
            $url = $uu.$injuryId;
            
            
            $reportType = ReportType::orderBy('id', 'desc')->get();
            $allDocuments = AllDocument::where('doc_type', $request->type)->where('injury_id', $injuryId)->get();

             return view('patients.injury.documents.create', compact('allDocuments','url','providerId','documents','docType','id','injuryId','title','reportType' ,'patient', 'injury'));
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), 'Something went wrong', 'error', ["positionClass" => "toast-top-center"]);
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
            echo $date->format('H:i:s');
    }
    public function ajaxBillingProviderReasons(Request $request)
    {
        $reasons = AppointmentReason::where('provider_id',$request->providerid)->orderBy('id', 'desc')->get();
        return $reasons;
    }
    
    public function schedularList(Request $request)
    { 
        // echo "<pre>";
        // print_r($request->all());exit; 
        $newAppoint =  date('Y-m-d'); $patientAppointment = []; $searchKey =null; $durationDate =null; $meetingType =null; $srcProvider = null; 
        $appointMents =  AppointmentReason::where('is_active', 1)->get(); 
        $meetingTypes = $this->patientModel->getMeetingType();
        $billStatus = $this->patientModel->getBillStatus();
        $statuss = Status::where("is_active", '1')->get(); 
        $providerIds = [];
        foreach (Auth::user()->getUserBillingProviders as $usBilling){
        $providerIds[] = $usBilling->provider_id;
        }
        $providers = BillingProvider::whereIn('id', $providerIds)->get();
        
         $rules = array(
                'keyword' => 'required_without_all:duration_date,appointment_meeting_Type',
                'duration_date' => 'required_without_all:keyword,appointment_meeting_Type',
                'appointment_meeting_Type' => 'required_without_all:keyword,duration_date',
            ); 
        if(empty($request->keyword) && empty($request->providerId) && empty($request->duration_date) && empty($request->appointment_meeting_Type) ){
            $patientAppointment = PatientAppointment::with('getPatient','getBillingProvider', 'getResaons');
            $patientAppointment =  $patientAppointment->where('appointment_date', $newAppoint);
            $patientAppointment =  $patientAppointment->orderBy('appointment_date', 'desc')->get();
        }  
         elseif(!empty($request->keyword) || !empty($request->providerId) || !empty($request->duration_date) || !empty($request->appointment_meeting_Type) ){
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
            if(!empty($request->providerId)){
                 $srcProvider = $request->providerId;
                $patientAppointment =  $patientAppointment->where('billing_provider_id', $request->providerId);
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
            
        return view('patients.schedular.list', compact( ['srcProvider','providers', 'patientAppointment', 'appointMents', 'meetingTypes', 'billStatus', 'searchKey', 'durationDate', 'meetingType','statuss'])); 
    }
    function appointmentStatus(Request $request){
        $appointment = PatientAppointment::where('id', $request->appointMentId)->first();
        if($appointment){
            $appointment->status = $request->statusId;
            $appointment->update();
        } 
    }
    function appointmentBillStatus(Request $request){
         $appointment = PatientAppointment::where('id', $request->appointMentId)->first();
        if($appointment){
            $appointment->bill_status = $request->reasonId;
            $appointment->update();
        }  
    }
    function appointmentDelete(Request $request){
         $appointment = PatientAppointment::where('id', $request->id)->first();
        if($appointment){
            $this->addGlobalAllLog('APPOINTMENT_DELETE','App\PatientAppointment','Patient appointment deleted', $appointment->id); 
            $appointment->delete();
        }  
    }
    
}
