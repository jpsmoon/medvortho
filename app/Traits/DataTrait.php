<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;
use App\Models\{ReportType, MasterHoliday, AllDocument, Patient, TaskAssign, Task, TaskStep, Status, Zipcode, Diagnosis_code,MasterDataLog, PatientInjuryBillog, Patient_injury, InjuryBill};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Toastr; 

trait DataTrait
{

    public function getActiveData($model, $sortcolumn, $filtercol = false, $filtercolvalue = false)
    {
        // Fetch all the data according to model
        return $model::where('is_active', 1)
                ->when( ($filtercol && $filtercolvalue), function ($query) use ($filtercol, $filtercolvalue){
                    return $query->where($filtercol, $filtercolvalue);
                } )
                ->orderBy($sortcolumn)->get();
    }

    public function getAllData($model, $sortcolumn = false)
    {
        // Fetch all the data according to model
        //return $model::all();
        return $model::withTrashed()
                        ->when($sortcolumn, function($query, $sortcolumn){
                            return $query->orderBy($sortcolumn);
                        })
                        ->when(!$sortcolumn, function($query){
                            return $query->orderBy('id', 'DESC');
                        })
                        ->get();
    }

    public function deleteRow($model, $id, $filtercol = false, $filtercolvalue = false)
    {
        if(!$filtercol && !$filtercolvalue && $id){
            $model::where("id", $id)->update(['is_active' => '0']);
            return $model::where("id", $id)->delete();
        }elseif($filtercol && $filtercolvalue){
            $model::where($filtercol, $filtercolvalue)->update(['is_active' => '0']);
            return $model::where($filtercol, $filtercolvalue)->delete();
        }else{
            return false;
        }
    }

    public function restoreRow($model, $id)
    {
        $model::withTrashed()->find($id)->restore();
        return $model::where("id", $id)->update(['is_active' => '1']);
    }

    public function getRenderProvdierDD($model)
    {
        return $model::where('is_active', 1)
            ->select('id', DB::raw("if(entity_type = 'Person', concat_ws(' ',first_name, last_name), entity_name) as name "))
            ->orderBy('id')->get();
    }
    //public function storeJobAssign($job_type, $statusArray,$task_step_id, $status_id, $status_alias = ''){
   



    public function getTaskId($job_type){
        $tasks = Task::select("id")->where('slug', 'LIKE', "%{$job_type}%")->where("is_active", '1')->first();
        if(!empty($tasks)){
            return $tasks->id;
        }else{
            return 0;
        }

        //$tasks=Session::get('tasks');       
        //$ssd = Session::all();  print_r($ssd);
        // if(!empty($tasks)){

        //     foreach($tasks as $task){
        //         if(stripos($task['slug'], $job_type) > -1){
        //             return $task['key'];    break;
        //         }
        //     }
        // }else{
        //     $tasks = Task::select("id")->where('slug', 'LIKE', "%{$job_type}%")
        //             ->where("is_active", '1')->first();
        //     if(!empty($tasks)){
        //         return $tasks->id;
        //     }else{
        //         return 0;
        //     }
        // }
    }
    public function getJobNo(){
        $maxid = ($this->getMaxJobNo()->maxid +1 );
        return 'J'.substr(date('Y'), 2,2).intval(date('m')).str_pad($maxid, 5, '0', STR_PAD_LEFT);
    }
    public function getMaxJobNo(){
        return TaskAssign::select( DB::raw("max(id) as maxid "))->first();
    }
    public function getStepId($step_name){
        $taskName = ($step_name == 'PATIENT_FAILED_REVIEW') ? 'Patient' : ( ($step_name == 'INJURY_FAILED_REVIEW') ? 'Injury' : 'Bill Info');
        $taskSteps = TaskStep::select("id")->where("step_name", $taskName)
                ->where("is_active", '1')->first();
        if(!empty($taskSteps)){
            return $taskSteps->id;
        }else{
            return 0;
        }
    }
    public function getStatusId($form_status){      //echo $form_status;
        $statuses = Status::select("id")->where("status_name", $form_status)
                ->where("is_active", '1')->first();
        if(!empty($statuses)){
            return $statuses->id;
        }else{
            return 0;
        }
    }
    public function setSession(){
        $user = Auth::user();
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_email', $user->email);

        $task_list = $this->getUserActiveTasks($user->id);
        //print_r($task_list);
        $tasks = array();
        foreach($task_list as $task){
            $tasks[]
            = array('key' => $task->task_id, 'taskname' => $task->task_name, 'slug' =>$task->slug);
        }
        Session::put('tasks', $tasks);
        //$ssd = Session::all();
        //echo $ssd['user_name'];
        //echo "<br/>";
        //echo $usd=Session::get('user_name');
        //Auth::user()->name
    }
    public function printSession(){
        print_r(Session::all());
    }

    public function getCountris()
    {
        $countris = [];
        $states = [];
        $citis = [];
        $allData = [];
        $countris = Zipcode::select('country_name')->distinct()->get();
        $states = Zipcode::select('state_code','state_name')->distinct()->get();
        $citis = Zipcode::select('city_name','state_code')->distinct()->get();
        return  json_encode(array('countris' => $countris, 'states' => $states, 'citis'  => $citis));
    }
    public function showStateCityCountry(){
        return json_decode($this->getCountris(), true);
    }
    public function getDiagnosisCode(){
        $diagnosis = [];
        //return Diagnosis_code :: where('is_active',1)->take(50)->get();
        //dd('hello');
        $diagnosis =  Diagnosis_code ::where('code_type','10')->where('is_active',1)->take(100)->get(['code_type','diagnosis_code','id','diagnosis_name'])
       ->toArray();
        return  $diagnosis;
    }
    public function diagnosisCodeForDropDown($type, $str = null){
        $diagnosis = [];
        // $diagnosis =  Diagnosis_code ::where(strtoupper('diagnosis_name'),'like', "%$newStr%")
        // ->orWhere(strtoupper('diagnosis_code'),'like', "%$newStr%")
        // ->where('code_type', $type)->where('is_active',1)->get(['code_type','diagnosis_code','id','diagnosis_name'])
        // ->toArray();

        $dg =  Diagnosis_code ::where('is_active',1);
        if($type != null){
            $dg = $dg->where('code_type',$type);
        }

        if($str == null){
            $dg = $dg->take(10);
        }
        else{
            $newStr = strtoupper($str);
            //$dg = $dg->where('code_type',$type);
            $dg = $dg->where(strtoupper('diagnosis_name'),'like', "%$newStr%")->orWhere(strtoupper('diagnosis_code'),'like', "%$newStr%");
        }
        $diagnosis = $dg->get(['code_type','diagnosis_code','id','diagnosis_name'])->toArray();
        return  $diagnosis;
    }
    public function addGlobalAllLog($type,$model,$description,$id){
        $history = new MasterDataLog();
        $history->type = $type;
        $history->created_by = Auth::user()->id;
        $history->data_id = $id;
        $history->model_name = $model;
        $history->description = $description;
        $history->save();
    }
    public function removeUnderScoreToSpace($str){
        $changedStr =  ucfirst(strtolower(str_replace('_', ' ', $str)));
         return $changedStr;
    }
        /*
    ** @Param $conditionArr for matched rows, column must be included
    ['user_id', 'task_id', 'step_id', 'task_step_id']
    ** @Param $insertArr for insert column should be as below
    [start_date, assign_user_id, assign_by_user_id, assign_by_date,  patient_id, ** injury_id = 0, bill_id = 0, payment_id = 0, close_date, close_status, close_by]
    * Note: Columns must not be matched in both array. Array column should be unique
    *
    */
    
    
    public function checkPatientForBillTask($patient){
        $isBillFail = 0;  $billSlug  = [];  $statusId  = null;
        $formStatus = config('global.formStatus'); 
        $form_status = $formStatus['complete']; 
       //dd($patient);
        switch (true) {
            case $patient->billing_provider_id == null:
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'PATIENT_FAILED_REVIEW','description'=>'Billing provider is blank','statusId'=>$statusId,'itemId'=>$patient->id];
                break;
            case $patient->first_name == null:
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'PATIENT_FAILED_REVIEW','description'=>'First name is blank','statusId'=>$statusId,'itemId'=>$patient->id];
                break;
            case $patient->dob == "" || $patient->dob == '0000-00-00':
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'PATIENT_FAILED_REVIEW','description'=>'Date Of birth is blank','statusId'=>$statusId,'itemId'=>$patient->id];
                break;
            case $patient->gender == null:
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'PATIENT_FAILED_REVIEW','description'=>'Gender is blank','statusId'=>$statusId,'itemId'=>$patient->id];
                break;
            case $patient->ssn_no == null:
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'PATIENT_FAILED_REVIEW','description'=>'ssn number is blank','statusId'=>$statusId,'itemId'=>$patient->id];
                break;
            case $patient->address_line1 == null:
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'PATIENT_FAILED_REVIEW','description'=>'address is blank','statusId'=>$statusId,'itemId'=>$patient->id];
                break;
            default: $billSlug  = ['status'=>0, 'slug'=>null,'description'=>null,'statusId'=>null,'itemId'=>$patient->id];
                    
        }
        return $billSlug;
    }
    public function checkInjuryForBillTask($injury){
        $isBillFail = 0;  $billSlug  = [];  $statusId  = null;
        $formStatus = config('global.formStatus'); 
        $form_status = $formStatus['complete']; 
       //dd($injury->getInjuryClaim);
       if($injury->getInjuryClaim){
        switch (true) {
            case $injury->getInjuryClaim->employer_name == null:
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'INJURY_FAILED_REVIEW','description'=>'Employee is blank','statusId'=>$statusId,'itemId'=>$injury->id];
            break;
            case $injury->getInjuryClaim->is_employer_address_optional == 1 && $injury->getInjuryClaim->emp_address_line1 == null:
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'INJURY_FAILED_REVIEW','description'=>'Employeer address id is blank','statusId'=>$statusId,'itemId'=>$injury->id];
            break;
            default: $billSlug  = ['status'=>0, 'slug'=>null,'description'=>null,'statusId'=>null,'itemId'=>$injury->id];
            break;
        }
       }
        //  echo "<pre>";
        // print_r($billSlug);exit; 
        return $billSlug;
    }
    public function checkFiledsForBillTask($bill){
        $isBillFail = 0;  $billSlug  = [];  $statusId  = null;
        $formStatus = config('global.formStatus'); 
        $form_status = $formStatus['complete']; 
        switch (true) {
            case $bill->dos == "" || $bill->dos == '0000-00-00':
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'BILL_FAILED_REVIEW','description'=>'DOS is blank','statusId'=>$statusId,'itemId'=>$bill->id];
                break;
            // case $bill->bill_place_of_service == "" :
            //     $form_status = $formStatus['incomplete'];
            //     $statusId =  $this->getStatusId($form_status);
            //     $billSlug  = ['status'=>1, 'slug'=>'BILL_FAILED_REVIEW','description'=>'Bill Place of servicr is blank','statusId'=>$statusId,'itemId'=>$bill->id];
            //     break;
            case $bill->bill_rendering_provider == "" :
                $form_status = $formStatus['incomplete'];
                $statusId =  $this->getStatusId($form_status);
                $billSlug  = ['status'=>1, 'slug'=>'BILL_FAILED_REVIEW','description'=>'Rendering provider is blank','statusId'=>$statusId,'itemId'=>$bill->id];
                break;
            // case $bill->getBillDiagnosis  &&  count($bill->getBillDiagnosis) == 0:
            //     $form_status = $formStatus['incomplete'];
            //     $statusId =  $this->getStatusId($form_status);
            //     $billSlug  = ['status'=>1, 'slug'=>'BILL_FAILED_REVIEW','description'=>'Bill diagnosis are null','statusId'=>$statusId,'itemId'=>$bill->id];
            //     break;
            // case $bill->getBillServices  &&  count($bill->getBillServices) == 0:
            //     $form_status = $formStatus['incomplete'];
            //     $statusId =  $this->getStatusId($form_status);
            //     $billSlug  = ['status'=>1, 'slug'=>'BILL_FAILED_REVIEW','description'=>'Bill procedure code is null','statusId'=>$statusId,'itemId'=>$bill->id];
            //     break;
            default: $billSlug  = ['status'=>0, 'slug'=>null,'description'=>null,'statusId'=>null,'itemId'=>$bill->id];
        }
         //  echo "<pre>";
        // print_r($billSlug);exit; 
        return $billSlug;
    }
    
    public function saveAndUpdatePatientInjuryBillLog($checkTaskAssign){
        $checkLog = PatientInjuryBillog::where('assign_task_id',$checkTaskAssign->id)->first();
        if(!$checkLog){
            $logInfo = new PatientInjuryBillog();
            $logInfo->assign_task_id        = $checkTaskAssign->id;
            $logInfo->type                  = $checkTaskAssign->status_alias;
            $logInfo->created_by            = $checkTaskAssign->assign_by_user_id;
            $logInfo->description           = $checkTaskAssign->status_alias;
            $logInfo->due_date              = $checkTaskAssign->assign_by_date;
            $logInfo->complete_date          = $checkTaskAssign->close_date;
            if($logInfo->save()){
                $this->addGlobalAllLog('TASK','App\PatientInjuryBillog',$checkTaskAssign->status_alias, $checkTaskAssign->task_step_id );
                TaskAssign::where('id',$checkTaskAssign->id)->delete();
            }
        }       
    }
    public function checkInsertUpdateTask($request, $patientId){
        $patient = Patient::with('getInjuries','getBillingProvider')->Where('id', $patientId)->first();
        if($patient){
            $statusForPatient =  $this->checkPatientForBillTask($patient);
            if($statusForPatient){
                if($statusForPatient['status'] == 0){
                   $this->removeJobAssign($request, $statusForPatient);
                    if($patient->getInjuries){
                        foreach($patient->getInjuries as $injury){
                            $statusForInjury = $this->checkInjuryForBillTask($injury);
                            if($statusForInjury){
                                if($statusForInjury['status'] == 0){
                                    $this->removeJobAssign($request, $statusForInjury);
                                    if($injury->getInjuryBills){
                                        foreach($injury->getInjuryBills as $bill){
                                            $statusForBill = $this->checkFiledsForBillTask($bill);
                                            if($statusForBill['status'] == 0){
                                                $this->removeJobAssign($request, $statusForBill);
                                                if(count($bill->getBillDocuments)== 0){
                                                    $statusForBillDoc = $this->checkBillForDocumentRequiredTask($bill, $patient);
                                                    //dd($statusForBillDoc);
                                                    if($statusForBillDoc['status'] == 0){
                                                        $this->removeJobAssign($request, $statusForBillDoc);
                                                    }
                                                    else{
                                                        $this->inserUpdateTask($request, $statusForBillDoc);
                                                    }
                                                }
                                            }
                                            else{
                                                $this->inserUpdateTask($request, $statusForBill);
                                            }
                                        }
                                    }
                                }
                            }
                            else{
                                $this->inserUpdateTask($request, $statusForInjury);
                            }
                        }
                    }
                }
                else{
                    $this->inserUpdateTask($request, $statusForPatient);
                }
            }  
        }
    }
    public function removeJobAssign($request, $statusForBill){
        if(!empty($statusForBill['itemId'])){
            $checkTaskAssign = TaskAssign::where('task_step_id',$statusForBill['itemId'])->first();
            if($checkTaskAssign){
                $this->saveAndUpdatePatientInjuryBillLog($checkTaskAssign);
            }
        }
    } 
    public function checkBillForDocumentRequiredTask($bill){
         $isBillFail = 0; $billSlug  = ['status'=>0, 'slug'=>null,'description'=>null,'statusId'=>null,'itemId'=>$bill->id];
         $formStatus = config('global.formStatus');
         $form_status = $formStatus['complete']; $statusId  = null;
         $checkDocument = AllDocument::where('injury_id', $bill->id)->where('doc_type', 'Bill')->get();
         //dd($checkDocument);
             if(!$checkDocument){
                 $form_status = $formStatus['incomplete'];
                 $statusId =  $this->getStatusId($form_status);
                 $billSlug  = ['status'=>1, 'slug'=>'DOCUMENT_REQUIRED','description'=>'Document Required','statusId'=>$statusId,'itemId'=>$bill->id];
             }
         return $billSlug;    
     }
     public function storeJobAssign($job_type, $statusArray){
        // echo "<pre>";
        // dd($statusArray);exit;
        if($job_type != null && count($statusArray) > 0){
            $task_step_id = $statusArray['itemId'];
            $status_id = $statusArray['statusId'];
            $status_alias = $statusArray['slug'];
    
            $job_no = $this->getJobNo();
            $task_id = $this->getTaskId($job_type);
            $step_id = $this->getStepId($job_type);
            if($task_id && $step_id && $job_no && $status_id){
                    $conditionArr = ['user_id', 'task_id', 'step_id', 'task_step_id'];
                    $insertArr = array();
                    $insertArr['job_no'] = $job_no;
                    $insertArr['user_id'] = Auth::user()->id;
                    $insertArr['task_id'] = $task_id;
                    $insertArr['step_id'] = $step_id;
                    $insertArr['task_step_id'] = $task_step_id;
                    $insertArr['status_id'] = $status_id;
                    $insertArr['status_alias'] = $status_alias;
                    $insertArr['description'] = $statusArray['description'];
    
                    $updateArr = ['status_id', 'status_alias'];
                    return $this->saveJobAssign($conditionArr, $insertArr, $updateArr);
                    //TaskAssign::upsert($insertArr, $conditionArr, $updateArr);
    
            }
            else{
                return response()->json(
                [
                    'success' => 0,
                    'message' => 'Something went wrong, Please Try again.'
                ]
                );
            }
        }
        else{
            return response()->json(
            [
                'success' => 0,
                'message' => 'Something went wrong, Please Try again.'
            ]
            );
        }
    }
    public function saveJobAssign($conditionArr, $insertArr, $updateArr) {
        $now = Carbon::now();
        // echo "<pre>";
        // print_r($insertArr);exit;
        if(!empty($conditionArr) && !empty($insertArr)){
            // $checkTaskAssign = TaskAssign::where('user_id',$insertArr['user_id'])
            // ->where('task_id',$insertArr['task_id'])
            // ->where('step_id',$insertArr['step_id'])
            // ->where('task_step_id',$insertArr['task_step_id'])
            // ->first(); 
           $checkTaskAssign = TaskAssign::where('task_id',$insertArr['task_id'])->where('step_id',$insertArr['step_id'])->where('task_step_id',$insertArr['task_step_id'])->first();
            if($checkTaskAssign){
                $checkTaskAssign->status_id     = $insertArr['status_id'];
                $checkTaskAssign->status_alias  = $insertArr['status_alias'];
                $checkTaskAssign->update();
                $this->addGlobalAllLog('TASK','App\TaskAssign',$checkTaskAssign->status_alias, $insertArr['task_step_id']);
            }
            else{
               $taskAssign =  new TaskAssign();
               $taskAssign->job_no        = $insertArr['job_no'];
               $taskAssign->user_id         = $insertArr['user_id'];
               $taskAssign->task_id         = $insertArr['task_id'];
               $taskAssign->step_id         = $insertArr['step_id'];
               $taskAssign->task_step_id    = $insertArr['task_step_id'];
               $taskAssign->status_id       = $insertArr['status_id'];
               $taskAssign->status_alias    = $insertArr['status_alias'];
               $taskAssign->assign_user_id  = $insertArr['user_id'];
               $taskAssign->description     = $insertArr['description'];
               $taskAssign->assign_by_date  =  $now;
               $taskAssign->save();  
               $this->addGlobalAllLog('TASK','App\TaskAssign',$taskAssign->status_alias, $insertArr['task_step_id']);

            }
            return response()->json( [ 'success' => 1, 'message' => 'Task saved!!!' ] );
        }else{
            return response()->json( [ 'success' => 0, 'message' => 'Something went wrong, Please Try again.' ] );
        }
    }
    public function getDateStringMMDDYYFormat($dateStr){
        if($dateStr != null && $dateStr != "0000:00:00"){
            return date('m/d/Y',strtotime($dateStr));
        }
    }
    public function getPatientById($id){
        $patient = Patient::with('getBillingProvider', 'getInjuries', 'getPatientInjuries')->where('id',$id)->first();
        return $patient;
    }
    public function redirectToRoute($route, $message = null, $errorType = 'error', $options = [])
    {
        if ($message) {
            Toastr::$errorType($message, '', $options);
        }
        return redirect($route);
    }
    public function saveMasterHoliday($request){ 
        $month = 0; $year = 0;
        if(isset($request->holiday_date)){
            $reqDob =  $request->holiday_date;
            $exDate = explode('/', $reqDob);
            $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
            $newDob =  date('Y-m-d',strtotime($newBreakDate)); 
            $month =  $exDate[0]; $year =  $exDate[2];
        } 
        $checkHoliday = MasterHoliday::where('id', $request->holiday_id)->first();
        if($checkHoliday){
            $checkHoliday->holiday_date   = $newDob;
            $checkHoliday->holiday_name   = $request->name;
            $checkHoliday->holiday_month  = $month;
            $checkHoliday->description    = $request->description;
            $checkHoliday->holiday_year   = $year;
            $checkHoliday->created_by     = Auth::user()->id; 
            $checkHoliday->holiday_type   = $request->holiday_type;
            $checkHoliday->update();
        }
        else{
            $newHoliday = new MasterHoliday();
            $newHoliday->holiday_date   = $newDob;
            $newHoliday->holiday_name   = $request->name;
            $newHoliday->holiday_month  = $month;
            $newHoliday->description    = $request->description;
            $newHoliday->holiday_year   = $year;
            $newHoliday->created_by     = Auth::user()->id; 
            $newHoliday->holiday_type   = $request->holiday_type;
            $newHoliday->save(); 
        } 
    }

    public function saveReportType($request){  
        $checkReportType = ReportType::where('id', $request->report_type_id)->first();
        if($checkReportType){
             $checkReportType->report_name      = $request->name;
            $checkReportType->report_code       = strtoupper($request->report_code);
            $checkReportType->description       = $request->description; 
            $checkReportType->update();
        }
        else{
            $newReportType = new ReportType();
             $newReportType->report_name    = $request->name;
            $newReportType->report_code     = strtoupper($request->report_code);
            $newReportType->description     = $request->description; 
            $newReportType->save(); 
        } 
    }
}