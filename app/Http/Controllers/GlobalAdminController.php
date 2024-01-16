<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Toastr;
use DB;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \stdClass;
use App\Models\{PatientInjuryBillog, BillPaymentOther, Task, BillCoverSheetCmsForm, BillDiagnosis, TaskAssign, AppointmentReason, ProviderBillingTemplateServiceItem, ProviderBillingTemplate, Status, AllDocument, State, InjuryContact, MasterDataLog, Service_code, ReportType, BillingProviderCharge, BillingProviderChargeProcedureCode,
    BillingProvider,BillModifier,ClaimAdministrator,ClaimStatus,Country,Health_provider,InjuryBill,InjuryBillService,InjuryDiagnosis,
    MasterPlaceOfService,MedicalProvider,ModifierCode,Patient,PatientAppointment,Patient_injury,ProcedureCode, RenderinProvider, BillReferingOrderProvider, Diagnosis_code, BillPaymentInformation
    };

class GlobalAdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $patients = Patient::with('getBillingProvider')->orderBy('created_at', 'desc')->get();
        return view('globalAdmin.index', compact('patients'));
    }
}
