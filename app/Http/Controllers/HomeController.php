<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Status, TaskStep, Patient, User, Role, BillingProvider, Patient_injury, InjuryBill, AppointmentReason, PatientAppointment};
use Illuminate\Support\Facades\Auth;
use DB;


class HomeController extends Controller
{
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $patientModel;
    public function __construct(Patient $patientMod)
    {
        $this->middleware('auth');
        $this->patientModel = $patientMod;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->setSession();
         $statuses = Status::whereIn('slug_name', ['TASK_COMPLETE', 'TASK_INCOMPLETE', 'TASK_PROCESS'])->where('is_active', 1)->get();
        //$statuses = Status::where('slug_name', 'INACTICE_OTHER')->where('is_active', 1)->get();
        $mytasks = $this->getMyTaskCountList();
        $totalPatients = null; $totalBProviders = null;
         if(Auth::user()->roles && count (Auth::user()->roles) > 0 &&  Auth::user()->roles[0]['name'] =='SubAdmin'){
           $totalPatients = Patient::count(); 
            $totalBProviders = BillingProvider::where('is_active', 1)->count();
        } 
        else
        {
            $providersId =[];
            foreach(Auth::user()->getUserBillingProviders as $userProviderInfo){
                $providersId[] = $userProviderInfo['provider_id'];
            }
            
            if(count($providersId) > 0){
                $totalPatients = Patient::whereIn('billing_provider_id', $providersId)->count();
                 $totalBProviders = count(Auth::user()->getUserBillingProviders); 
            }
        }  
       
        $totalInjury =  Patient_injury::count();
        $totalBills = InjuryBill::count();
        $patients = Patient::with('getBillingProvider', 'getAppointments')->orderBy('created_at', 'desc')->get();
       
        
      //echo  $this->changeUnderScoreToSpace('PATIENT_FAILED_REVIEW');exit;
        return view('home', compact('totalBills','totalInjury','totalBProviders','statuses', 'mytasks','totalPatients','patients'));
    }

    public static function changeUnderScoreToSpace($str){
        $changedStr =  ucfirst(strtolower(str_replace('_', ' ', $str)));
         return $changedStr;
    } 

    public function editProfile(Request $request){
        $user = []; $id= null;  $roles = []; $userRole = []; $tasks = []; $isLoginUser = null;

        if(isset($request->id)){
            $id = $request->id;
            $isLoginUser = 'NO';
        }
        else{
            $id = Auth::user()->id;
            $isLoginUser = 'YES';
        }
        
        $user = User::where('id', $id)->first();
        $roles = Role::select('id','name')->get();
        $userRole = DB::table('model_has_roles')->where('model_id',$user->id);
        $billingProvidersArray = BillingProvider::where('is_active', 1)->get(); 
        return view('users.edit', compact('user', 'id','roles','userRole', 'tasks', 'billingProvidersArray', 'isLoginUser'));
    }
    public function getAppointReasonFromModel($rId){
        $resaon = '';
        $meetingReason = $this->patientModel->getAppointmentReason();
        $records = array_filter($meetingReason, function ($row) use($rId) {
            return $row['id']  == $rId;
        });
        if(count($records) > 0 ){
            foreach($records  as $res){
                $resaon = $res['name'];
            }
        }
        return $resaon;
    }
    public function convertToHoursMins($time, $format = '%02d:%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }
    
     public function index2()
    {
        $this->setSession(); 
        $todayDate = '2023-07-11';
        $todayDate2 = date('Y-m-d');
        $patients = Patient::with('getBillingProvider', 'getAppointments')->orderBy('created_at', 'desc')->get(); 
        $patientAppointment = PatientAppointment::with('getPatient','getBillingProvider', 'getResaons','getRenderingProvider')->where('appointment_date', $todayDate)->orderBy('appointment_date', 'desc')->get();
        $statuss = Status::where("is_active", 1)->where("status_type", 7)->orderBy('display_order', 'ASC')->get();
      //echo  $this->changeUnderScoreToSpace('PATIENT_FAILED_REVIEW');exit;
      $appointMents =  AppointmentReason::where('is_active', 1)->get(); 
        return view('home-new', compact(['patients', 'appointMents', 'patientAppointment','statuss']));
    }
    public function showTodayAppointmentList(Request $request){
        $datesArray = [];
        $todayDate = date('Y-m-d');
        if(isset($request->min) || isset($request->max)){
            $datesArray = [$request->min, $request->max];
        }
        else{
            $datesArray = [$todayDate];
        }
        // echo "<pre>";
        // print_r($datesArray);
        // exit;
        $patientAppointment = PatientAppointment::with('getPatient','getBillingProvider', 'getResaons','getRenderingProvider')->whereBetween('appointment_date', $datesArray)->orderBy('appointment_date', 'desc')->get();
        $result = [];
        foreach($patientAppointment as $appountment){
            $fullName = '';
            if($appountment->getPatient->first_name != ''){
                $fullName .= $appountment->getPatient->first_name;
            }
            if($appountment->getPatient->mi != ''){
                $fullName .= " ".$appountment->getPatient->mi;
            }
            if($appountment->getPatient->last_name != ''){
                $fullName .= " ".$appountment->getPatient->last_name;
            } 
            

            $newArray[] = array(
                'id'=>$appountment->id,  
                'appointmentNo'             =>  ($appountment->appointment_no && $appountment->appointment_no != "") ? $appountment->appointment_no : '',
                'appointmentDate'           =>  ($appountment->appointment_date) ? date('m-d-Y', strtotime($appountment->appointment_date)) : '',
                'appointmentTime'           =>  ($appountment->appointment_time) ? $appountment->appointment_time : '',
                'fullName'                  =>  $fullName,
                'contactNo'                 =>  ($appountment->getPatient && $appountment->getPatient->contact_no) ? $appountment->getPatient->contact_no : '',
                'providerName'              =>  ($appountment->getBillingProvider) ? $appountment->getBillingProvider->professional_provider_name : '',
                'meetingType'               =>  ($appountment->meeting_type) ? $this->getMeetingType($appountment->meeting_type) : '',
                'vistStatus'                =>  ($appountment && $appountment->getVisitStatus && $appountment->getVisitStatus->status_name) ? $appountment->getVisitStatus->status_name : '',
                'billStatus'                =>  ($appountment && $appountment->getBillStatus && $appountment->getBillStatus->status_name) ? $appountment->getBillStatus->status_name : '',

            );
            $result = $newArray;
        }
        return $result;
    }
    public function getMeetingType($id){
        $appointMents = $this->patientModel->getAppointmentReason();
          $new = array_filter($this->patientModel->getMeetingType(), function ($var) use ($id) {
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
    public function returnFormatedPhoneNumber($str){
        //(559) 909-7867
        $newPhone = ''; 
        $formattedNumber = preg_replace('/^(\d{3})(\d{3})(\d{4})$/', '($1) $2-$3', $str);
        return  $formattedNumber;
    }
    public function showPaymentFrom($val){
        if($val == "paper_check"){
            return  "Check";
        }
        else if($val == "eft"){
            return  "EFT";
        }
        else if($val == "virtual_credit_card"){
            return  "Credit Card";
        }
    }
}
