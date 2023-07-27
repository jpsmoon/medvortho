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

class MasterCrudController extends Controller
{
    //
    protected $patientModel;
    public function __construct(Patient $patientMod )
    {
        $this->middleware('permission:patient-list|patient-create|patient-edit|patient-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:patient-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patient-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patient-delete', ['only' => ['destroy']]);
        $this->patientModel = $patientMod;
    }
    public function reprtTypeList(Request $request)
    {
        $reportTypes = ReportType::where('is_active',1)->orderBy('id', 'desc')->get();
        return view('masters.reportType.index', compact('reportTypes'));
    }
    public function storeReportType(Request $request)
    {
      try {
            DB::beginTransaction();
                $this->saveReportType($request);
            DB::commit();
            $msg = 'Report type added successfully';
            if(isset($request->holiday_id)){
                $msg = 'Report type updated successfully';
            }
            return  $this->redirectToRoute('/document/reprt/type', $msg, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function deleteReportType(Request $request)
    {
       try {
            DB::beginTransaction();
             $this->deleteRow(new ReportType(), $request->id); 
            DB::commit();
           $msg = 'Report type deleted successfully'; 
           return  $this->redirectToRoute('/document/reprt/type', $msg, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
}
