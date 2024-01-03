<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Status, TaskStep, Patient, User, Role, BillingProvider, Patient_injury, InjuryBill};
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
        if(Auth::user()->roles[0]['name'] =='SubAdmin'){
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
    
}
