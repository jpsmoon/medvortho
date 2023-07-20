<?php
namespace App\Traits;
use App\Models\{Patient_injury,  InjuryDiagnosis, InjuryClaim, AllDocument, WriteOffReason, InjuryContact, InjuryNote, InjuryBill, MasterDataLog};
use Illuminate\Support\Str;
use Config;
use File;

use Illuminate\Support\Facades\Auth;

trait PatientinjuryTrait
{
    public function getPatientinjuries($patient_id)
    {
        return Patient_injury::join('injury_claims as c', 'patient_injuries.id', '=', 'c.injury_id' )
                        ->select('patient_injuries.*', 'c.*')
                        ->where('patient_injuries.patient_id', $patient_id)
                        ->orderBy('patient_injuries.id')->get();
    }



    public function getFinClassFormStatusId($patient_injury){
        $formStatus = config('global.formStatus');
        $form_status = $formStatus['complete']; $status_alias = '';

        if($patient_injury->financial_class && $patient_injury->injury_state_id && $patient_injury->description){
            //Do nothing
        }else{
            $form_status = $formStatus['incomplete'];
        }
        if($form_status != $formStatus['complete']){
            $status_alias = 'Failed Review';
        }
        return array($this->getStatusId($form_status), $status_alias);
    }

   
   
    public function saveBillWriteOfReasonInfo($request) {
        $reasonInfo = WriteOffReason::where('id', $request->reasonId)->first();
        $provider_id = ($request->providerId) ? $request->providerId : null;
        if($reasonInfo){
            $reasonInfo->provider_id            = $provider_id;
            $reasonInfo->description       = $request->description;
            $reasonInfo->reason_text          = $request->reason;
            $reasonInfo->update();
        }
        else{
            $reason = new WriteOffReason();
            $reason->provider_id    = $provider_id;
            $reason->description    = $request->description;
            $reason->reason_text    = $request->reason;
            $reason->type           = $request->reasonType;
            $reason->save();
        }
    }

    public function saveSecondReviewReason($request) {
        $reasonInfo = WriteOffReason::where('id', $request->reasonId)->first();
        $provider_id = ($request->providerId) ? $request->providerId : null;
        if($reasonInfo){
             $reasonInfo->provider_id            = $provider_id;
            $reasonInfo->description       = $request->description;
            $reasonInfo->reason_text          = $request->reason;
            $reasonInfo->update();
        }
        else{
            $reason = new WriteOffReason();
            $reason->provider_id    = $provider_id;
            $reason->description    = $request->description;
            $reason->reason_text    = $request->reason;
            $reason->type           = 2;
            $reason->save();
        }
    }

    public function saveBox19Reason($request) {
        $reasonInfo = WriteOffReason::where('id', $request->reasonId)->first();
        $provider_id = ($request->providerId) ? $request->providerId : null;
        if($reasonInfo){
             $reasonInfo->provider_id            = $provider_id;
            $reasonInfo->description       = $request->description;
            $reasonInfo->reason_text          = $request->reason;
            $reasonInfo->update();
        }
        else{
            $reason = new WriteOffReason();
            $reason->provider_id    = $provider_id;
            $reason->description    = $request->description;
            $reason->reason_text    = $request->reason;
            $reason->type           = 3;
            $reason->save();
        }
    }
    
    
    public function storeInjuryNote($request) {
        // echo "<pre>";
        // print_r($request->all());exit;
        
            $patientInjuryNote = InjuryNote::where('id', $request->injuryNoteId)->first();
            if($patientInjuryNote){
                $patientInjuryNote->injury_id = $request->injuryId;
                $patientInjuryNote->adjuster_name = $request->address;
                $patientInjuryNote->bill_history = $request->billHistory;
                $patientInjuryNote->added_by = Auth::user()->id;
                $patientInjuryNote->update();
            }
            else{
                $newInjuryNote = new InjuryNote();
                $newInjuryNote->injury_id = $request->injuryId;
                $newInjuryNote->adjuster_name = $request->address;
                $newInjuryNote->bill_history = $request->billHistory;
                $newInjuryNote->added_by = Auth::user()->id;
                $newInjuryNote->save();
            }
    }
    public function checkTaskForBillDocuments($request){
        if($request->docType == 'Bill'){
            $getBillInfo = InjuryBill::where('id',$request->injuryId)->first();
            if($getBillInfo){
                $this->checkInsertUpdateTask($request, $getBillInfo->patient_id);
            }
        }
    }
    
    
    public function storeInjuryClaims($injuryId, $request){
        try {
            $isEmployerAdderesssOption = ($request->employer_name_address == 1) ? 1 : 0;
            $findInjuryClaim = InjuryClaim::where('injury_id', $injuryId)->first();
            $newStartDate =  Null;
            if(isset($request->start_date)){
                $reqDob =  $request->start_date;
                $exDate = explode('/', $reqDob);
                $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
                $newStartDate =  date('Y-m-d',strtotime($newBreakDate));
            }
            $newEndDate =  Null;
            if(isset($request->injury_end_date)){
                $reqDob =  $request->injury_end_date;
                $exDate = explode('/',$reqDob);
                $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
                $newEndDate =  date('Y-m-d',strtotime($newBreakDate));
            }
            $newClaimStatusDate =  NULL;
            if(isset($request->claim_status_date)){
                $reqDob =  $request->claim_status_date;
                $exDate = explode('/',$reqDob);
                $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
                $newClaimStatusDate =  date('Y-m-d',strtotime($newBreakDate));
            }

            if($findInjuryClaim){
                if($request->financial_class == 1){
                    $findInjuryClaim->is_employer_address_optional = $isEmployerAdderesssOption;
                    $findInjuryClaim->employer_name = $request->employer_name;
                    $findInjuryClaim->is_cumulative = ($request->cumulative_trauma == 1) ? 'Yes' : 'No';
                    $findInjuryClaim->start_date = $newStartDate;
                    $findInjuryClaim->end_date = $newEndDate;
                    $findInjuryClaim->claim_admin_id = $request->claim_admin_id;
                    $findInjuryClaim->no_any_claim = ($request->no_any_claim1) ? 0 : 1;
                    $findInjuryClaim->claim_no = $request->claim_no;
                    $findInjuryClaim->claim_status_id = $request->claim_status;
                    $findInjuryClaim->claim_status_date = $newClaimStatusDate;
                    $findInjuryClaim->medical_provider_id = $request->medical_provider_network;
                    $findInjuryClaim->practice_internal_id = $request->practiceInternalId;
                    $findInjuryClaim->adj_no = $request->adj_number;
                    if($isEmployerAdderesssOption == 1){
                        $findInjuryClaim->emp_address_line1 = $request->address_line1;
                        $findInjuryClaim->emp_address_line2 = $request->address_line2;
                        $findInjuryClaim->emp_city_id = $request->city_id;
                        $findInjuryClaim->emp_state_id = $request->state_id;
                        $findInjuryClaim->emp_zipcode = $request->zipcode;
                    }
                }
                if($request->financial_class == 2){
                    $findInjuryClaim->ins_payer = $request->ins_payer;
                    $findInjuryClaim->ins_subscriber = $request->ins_subscriber;
                    $findInjuryClaim->ins_group_no = $request->ins_group_no;
                    $findInjuryClaim->ins_deduct_amt = $request->ins_deduct_amt;
                    $findInjuryClaim->ins_copay_amt = $request->ins_copay_amt;
                    $findInjuryClaim->ins_coins_amt = $request->ins_coins_amt;
                    $findInjuryClaim->ins_authinfo = $request->ins_authinfo;
                    $findInjuryClaim->ins_no_of_visit = $request->ins_no_of_visit;
                }
                if($request->financial_class == 3){
                    $findInjuryClaim->p_attorney_name = $request->p_attorney_name;
                    $findInjuryClaim->p_payer_name = $request->p_payer_name;
                    $findInjuryClaim->p_law_officer_name = $request->p_law_officer_name;
                    $findInjuryClaim->p_injury_date = $request->p_injury_date;
                    $findInjuryClaim->p_claim_id = $request->p_claim_id;
                    $findInjuryClaim->p_ssn_no = $request->p_ssn_no;
                    $findInjuryClaim->p_handle_attorn_individual = $request->p_handle_attorn_individual;
                    $findInjuryClaim->p_contact_no = $request->p_contact_no;
                    $findInjuryClaim->p_others = $request->p_others;
                    $findInjuryClaim->p_address_line1 = $request->p_address_line1;
                    $findInjuryClaim->p_address_line2 = $request->p_address_line2;
                    $findInjuryClaim->p_city_id = $request->p_city_id;
                    $findInjuryClaim->p_state_id = $request->p_state_id;
                    $findInjuryClaim->p_zipcode = $request->p_zipcode;
                }
                $findInjuryClaim->update();
                $injuryId = $findInjuryClaim->id;
                //InjuryDiagnosis::all()->where('injury_claim_id', $injuryId)->delete();
                $this->storeInjuryDianosesContact($injuryId, $request);
                if($findInjuryClaim->injury_id){
                    $injuryInfo =  Patient_injury::where('id',$findInjuryClaim->injury_id)->first();
                    if($injuryInfo){
                        $isBillFail = 0;
                        $this->checkInsertUpdateTask($request, $injuryInfo->patient_id);
                    }
                }  
            }
            else{
                $newInjuryClaim = new InjuryClaim ();
                $newInjuryClaim->injury_id =  $injuryId;
                if($request->financial_class == 1){
                    $newInjuryClaim->is_employer_address_optional = $isEmployerAdderesssOption;
                    $newInjuryClaim->employer_name = $request->employer_name;
                    $newInjuryClaim->is_cumulative = ($request->cumulative_trauma == 1) ? 'Yes' : 'No';
                    $newInjuryClaim->start_date = $newStartDate;
                    $newInjuryClaim->end_date = $newEndDate;
                    $newInjuryClaim->claim_admin_id = $request->claim_admin_id;
                    $newInjuryClaim->no_any_claim = ($request->no_any_claim1) ? 0 : 1;
                    //$findInjuryClaim->payer_id = $request->employer_name;
                    $newInjuryClaim->claim_no = $request->claim_no;
                    $newInjuryClaim->claim_status_id = $request->claim_status;
                    $newInjuryClaim->claim_status_date = $newClaimStatusDate;
                    $newInjuryClaim->medical_provider_id = $request->medical_provider_network;
                    // $newInjuryClaim->no_any_medical_provider = ($request->no_any_network != null) ? $request->no_any_network : 0;
                    $newInjuryClaim->no_any_medical_provider =  0;
                    $newInjuryClaim->adj_no = $request->adj_number;
                    $newInjuryClaim->practice_internal_id = $request->practiceInternalId;

                    if($isEmployerAdderesssOption == 1){
                        $newInjuryClaim->emp_address_line1 = $request->address_line1;
                        $newInjuryClaim->emp_address_line2 = $request->address_line2;
                        $newInjuryClaim->emp_city_id = $request->city_id;
                        $newInjuryClaim->emp_state_id = $request->state_id;
                        $newInjuryClaim->emp_zipcode = $request->zipcode;
                    }
                }
                if($request->financial_class == 2){
                    $newInjuryClaim->ins_payer = $request->ins_payer;
                    $newInjuryClaim->ins_subscriber = $request->ins_subscriber;
                    $newInjuryClaim->ins_group_no = $request->ins_group_no;
                    $newInjuryClaim->ins_deduct_amt = $request->ins_deduct_amt;
                    $newInjuryClaim->ins_copay_amt = $request->ins_copay_amt;
                    $newInjuryClaim->ins_coins_amt = $request->ins_coins_amt;
                    $newInjuryClaim->ins_authinfo = $request->ins_authinfo;
                    $newInjuryClaim->ins_no_of_visit = $request->ins_no_of_visit;
                }
                if($request->financial_class == 3){
                    $newInjuryClaim->p_attorney_name = $request->p_attorney_name;
                    $newInjuryClaim->p_payer_name = $request->p_payer_name;
                    $newInjuryClaim->p_law_officer_name = $request->p_law_officer_name;
                    $newInjuryClaim->p_injury_date = $request->p_injury_date;
                    $newInjuryClaim->p_claim_id = $request->p_claim_id;
                    $newInjuryClaim->p_ssn_no = $request->p_ssn_no;
                    $newInjuryClaim->p_handle_attorn_individual = $request->p_handle_attorn_individual;
                    $newInjuryClaim->p_contact_no = $request->p_contact_no;
                    $newInjuryClaim->p_others = $request->p_others;
                    $newInjuryClaim->p_address_line1 = $request->p_address_line1;
                    $newInjuryClaim->p_address_line2 = $request->p_address_line2;
                    $newInjuryClaim->p_city_id = $request->p_city_id;
                    $newInjuryClaim->p_state_id = $request->p_state_id;
                    $newInjuryClaim->p_zipcode = $request->p_zipcode;
                }
                $newInjuryClaim->save();
                $injuryId = $newInjuryClaim->id;
                $injuryInfo =  Patient_injury::where('id',$newInjuryClaim->injury_id)->first();
                if($injuryInfo){
                    $this->checkInsertUpdateTask($request, $injuryInfo->patient_id);
                }
                $this->storeInjuryDianosesContact($injuryId, $request);
                
            }
        }
        catch (\Exception $e) {
            $message= $e->getMessage();
            $toastr_title=trans('messages.toastr_error');
            Toastr::error($message,'',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
    
    public function storePatientinjuryInfo($request) {
        // echo "<pre>";
        // print_r($request->all());exit;
        try {
            $desData = ""; $injury_state_id = "";
            if($request->financial_class == 1){
                $desData = $request->description;
                $injury_state_id = $request->injury_state_id;
            }
            if($request->financial_class == 2){
                $desData = $request->description2;
                $injury_state_id = $request->injury_state_id2;
            }
            if($request->financial_class == 3){
                $desData = $request->description3;
                $injury_state_id = $request->injury_state_id3;
            }
            
            $patient_injury = Patient_injury::where('id', $request->injuryId)->first();
            if($patient_injury){
                $patient_injury->financial_class = $request->financial_class;
                $patient_injury->description = $desData;
                $patient_injury->injury_state_id =  $injury_state_id;
                $patient_injury->update();
                $injury_id = $patient_injury->id;
                $ifCorrect = $this->storeInjuryClaims($injury_id,$request);
                $this->addGlobalAllLog('INJURY_UPDATED','App\Patient_injury','Updated Injury',$injury_id);
                $this->checkInsertUpdateTask($request, $patient_injury->patient_id);
                if($ifCorrect == 1){
                    return   array('injuryId'=>$injury_id, 'status' =>1);
                }
                else {
                    return   array('injuryId'=>$injury_id, 'status' =>0);
                }
            }
            else{
                $patient_injury = new Patient_injury();
                $patient_injury->patient_id = $request->patient_id;
                $patient_injury->financial_class = $request->financial_class;

                $patient_injury->description = $desData;
                $patient_injury->injury_state_id =  $injury_state_id;
                $patient_injury->save();
                $injury_id = $patient_injury->id;
               $ifCorrect = $this->storeInjuryClaims($injury_id,$request);
                $this->addGlobalAllLog('INJURY_CREATED','App\Patient_injury','Created Injury',$injury_id);
                $this->checkInsertUpdateTask($request, $patient_injury->patient_id);
                if($ifCorrect == 1){
                    return   array('injuryId'=>$injury_id, 'status' =>1);
                }
                else {
                    return   array('injuryId'=>$injury_id, 'status' =>0);
                }

                 
                //Assign task details here
                //$status_id = $this->getFinClassFormStatusId($patient_injury);
                //$this->storeJobAssign('financial class', $injury_id, $status_id);
                return $injury_id;
            }
        }
        catch (\Exception $e) {
            $message= $e->getMessage();
            $toastr_title=trans('messages.toastr_error');
            Toastr::error($message,'',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
    public function storeInjuryDianosesContact($injuryId, $request){
        // echo "<pre>";
        // print_r($request->contact_role);exit;
        // echo $countContactArr."CNT";exit;
        // echo "<pre>";
        $countContactArr = 0; $countArr = 0;
         if(isset($request->contact_role)) {
            $countContactArr = count($request->contact_role);
         }
         if(isset($request->work_dg_code_id)) {
            $countArr =  count($request->work_dg_code_id) ;  
         }
       // $countContactArr = ($request->contact_role) ?  count($request->contact_role) : 0;
        //$countArr = ($request->work_dg_code_id) ?  count($request->work_dg_code_id) : 0;
        if($countArr > 0){
            $checkDiagnos=InjuryDiagnosis::where('injury_claim_id', $injuryId)->get();
            if ($checkDiagnos){
                foreach($checkDiagnos as $dig){
                    $checkDiagnos=InjuryDiagnosis::where('id', $dig->id)->delete();
                }
                for($i = 0; $i< $countArr; $i++){
                    if($request->work_dg_code_id[$i] != '-Select-'){
                        $newDianosis = new InjuryDiagnosis ();
                        $newDianosis->injury_claim_id = $injuryId;
                        $newDianosis->diagnosis_code_id = $request->work_dg_code_id[$i];
                        $newDianosis->save();
                    }
                } 
            }
        }
       
        if($countContactArr > 0){
            for($i = 0; $i< $countContactArr; $i++){
                    if($request->contact_role[$i] != ""){
                        $injuryContacts = new InjuryContact ();
                        $injuryContacts->injury_id          = $injuryId;
                        $injuryContacts->contact_role_id    = $request->contact_role[$i];
                        $injuryContacts->contact_role_name  = ($request->contactRoleName[$i]) ? $request->contactRoleName[$i] : null;
                        $injuryContacts->first_name         = $request->contact_first_name[$i];
                        //$injuryContacts->last_name          = $request->contact_last_name[$i];
                        $injuryContacts->company            = $request->contact_company_name[$i];
                        $injuryContacts->email              = $request->contact_email_name[$i];
                        $injuryContacts->phone_number       = $request->contact_phone_name[$i];
                        $injuryContacts->fax_number         = $request->contact_fax_name[$i];
                        $injuryContacts->address_line1      = $request->contact_address1_name[$i];
                        $injuryContacts->address_line2      = $request->contact_address2_name[$i];
                        $injuryContacts->zip_code           = $request->contact_zip_name[$i];
                        $injuryContacts->city               = $request->contact_city_name[$i];
                        $injuryContacts->state              = $request->contact_state_name[$i];
                        $injuryContacts->created_by         = Auth::user()->id;
                        $injuryContacts->save();
                    }
                }
        }
        // print_r($request->all());
        // exit;
    }
    public function storeInjuryContact($request) {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        if(isset($request->contact_role)) {
            $countContactArr = count($request->contact_role);
            if($countContactArr > 0){
                for($i = 0; $i< $countContactArr; $i++){
                    if($request->contact_role[$i] != ""){
                        if(isset($request->injuryContactId)){
                            $injuryContact = InjuryContact::where('id', $request->injuryContactId)->first();
                            if($injuryContact){
                                $injuryContact->contact_role_id    = $request->contact_role[$i];
                                $injuryContact->contact_role_name  = ($request->contactRoleName[$i]) ? $request->contactRoleName[$i] : null;
                                $injuryContact->first_name         = $request->contact_first_name[$i];
                                $injuryContact->last_name          = $request->contact_last_name[$i];
                                $injuryContact->company            = $request->contact_company_name[$i];
                                $injuryContact->email              = $request->contact_email_name[$i];
                                $injuryContact->phone_number       = $request->contact_phone_name[$i];
                                $injuryContact->fax_number         = $request->contact_fax_name[$i];
                                $injuryContact->address_line1      = $request->contact_address1_name[$i];
                                $injuryContact->address_line2      = $request->contact_address2_name[$i];
                                $injuryContact->zip_code           = $request->contact_zip_name[$i];
                                $injuryContact->city               = $request->contact_city_name[$i];
                                $injuryContact->state              = $request->contact_state_name[$i];
                                $injuryContact->created_by         = Auth::user()->id;
                                $injuryContact->update();
                            }

                        }
                        else{
                            $injuryContacts = new InjuryContact();
                            $injuryContacts->injury_id          = $request->injuryId;
                            $injuryContacts->contact_role_id    = $request->contact_role[$i];
                            $injuryContacts->contact_role_name  = ($request->contactRoleName[$i]) ? $request->contactRoleName[$i] : null;
                            $injuryContacts->first_name         = $request->contact_first_name[$i];
                            $injuryContacts->last_name          = $request->contact_last_name[$i];
                            $injuryContacts->company            = $request->contact_company_name[$i];
                            $injuryContacts->email              = $request->contact_email_name[$i];
                            $injuryContacts->phone_number       = $request->contact_phone_name[$i];
                            $injuryContacts->fax_number         = $request->contact_fax_name[$i];
                            $injuryContacts->address_line1      = $request->contact_address1_name[$i];
                            $injuryContacts->address_line2      = $request->contact_address2_name[$i];
                            $injuryContacts->zip_code           = $request->contact_zip_name[$i];
                            $injuryContacts->city               = $request->contact_city_name[$i];
                            $injuryContacts->state              = $request->contact_state_name[$i];
                            $injuryContacts->created_by         = Auth::user()->id;
                            $injuryContacts->save();
                        }
                    }
                }
            }
        } 
    }
    public function storePatientInjuryDignosisCodeAddUpdate($request) {        
            $patientInjuryDC = InjuryDiagnosis::where('id', $request->dignosisId)->first();
            if($patientInjuryDC){
                $patientInjuryDC->injury_claim_id = $request->injury_claim_id;
                $patientInjuryDC->diagnosis_code_id = $request->work_dg_code_id; 
                $patientInjuryDC->update();
            }
            else{
                $newInjuryDC = new InjuryDiagnosis();
                $newInjuryDC->injury_claim_id = $request->injury_claim_id;
                $newInjuryDC->diagnosis_code_id = $request->work_dg_code_id;
                $newInjuryDC->is_active = 1; 
                $newInjuryDC->save();
            }
    }
    public function deleteInjuryContact($request) {
       if($request->id){
            $modalName = null;
            $itemType = 'INJURY_'.$request->type.'_DELETED';
            if($request->type == 'CONTACT'){
                $modalName = 'App\InjuryContact';
            }elseif($request->type == 'DOCUMENT'){
                $modalName = 'App\AllDocument';
            }elseif($request->type == 'NOTE'){
                $modalName = 'App\NOTE';
            }
            $descriptions = "Injury ". strtolower($request->type)." deleted injury id is-".$request->injuryId." ".strtolower($request->type)." id is-". $request->id;
            $masterdataLog = new MasterDataLog();
            $masterdataLog->type = $itemType;
            $masterdataLog->data_id = $request->id;
            $masterdataLog->model_name = $modalName;
            $masterdataLog->created_by = Auth::user()->id;
            $masterdataLog->description = $descriptions;
            $masterdataLog->save();
            if($masterdataLog){
                //echo "id=:".$request->id;exit;
                if($request->type == 'CONTACT'){
                    $injuryContact = InjuryContact::where("id", $request->id)->first(); 
                    if($injuryContact){
                        $injuryContact->delete();
                        if($injuryContact) {
                           return 1;
                        }
                        else{
                            return 2;
                        }
                    } 
                }
                else if($request->type == 'DOCUMENT'){
                    $injuryDocument = AllDocument::where("id", $request->id)->first(); 
                    if($injuryDocument){
                        $destinationPath    = public_path('injury_document');
                        $isDeleted = 0;
                        if(isset($injuryDocument->injury_document)){
                            $filePathName = $destinationPath."/".$injuryDocument->injury_document;
                            if (File::exists($filePathName)) {
                                File::delete($filePathName);
                                $isDeleted = 1;
                            }
                        }
                        if($isDeleted == 1){
                            $injuryDocument->delete();
                            if($injuryDocument) {
                               return 1;
                            }
                            else{
                                return 2;
                            }
                        }
                    } 
                }
                else if($request->type == 'NOTE'){
                    $injuryNote = InjuryNote::where("id", $request->id)->first(); 
                    if($injuryNote){
                        $injuryNote->delete();
                        if($injuryNote) {
                           return 1;
                        }
                        else{
                            return 2;
                        }
                    } 
                }
            }
        }
    }
    public function storeInjuryDocuments($request) {
        
        // echo "<pre>";
        // print_r($request->all());exit; 

        $injuryDocument = AllDocument::where('id', $request->injuryDocumentId)->first();
        $provider_id = ($request->providerId) ? $request->providerId : null; 
        if($injuryDocument){
            $injuryDocument->injury_id              = $request->injuryId;
            $injuryDocument->provider_id            = $provider_id;
            if($request->docType != 'Bill'){
              $injuryDocument->reporting_type         = $request->injury_reporting_type;
              $injuryDocument->description            = $request->description3;  
            } 
           // $injuryDocument->injury_document	    = $document_path;
            $injuryDocument->is_active	            =  1;
            $injuryDocument->added_by               = Auth::user()->id;
            $injuryDocument->update();
            $this->checkTaskForBillDocuments($request);
            $injury_id = $request->injury_id;
            $this->addGlobalAllLog('INJURY_DOCUMENT_UPDATED','App\AllDocument','Updated Injury Document',$injuryDocument->injury_id);
            return $injury_id;
        }
        else{
            $injuryDocumentId1 = AllDocument::where('id', $request->tempInjuryDocumentId)->first();

            //$injuryDocumentId1 = new AllDocument();
            $injuryDocumentId1->injury_id               = $request->injuryId;
            $injuryDocumentId1->doc_type                = $request->docType;
            $injuryDocumentId1->provider_id             = $provider_id;
            if($request->docType != 'Bill'){ 
                $injuryDocumentId1->reporting_type          = $request->injury_reporting_type;
                $injuryDocumentId1->description             = $request->description3;
            }
           // $injuryDocumentId1->injury_document	        = $document_path;
            $injuryDocumentId1->is_active	            =  1;
            $injuryDocumentId1->added_by                = Auth::user()->id;
            $injuryDocumentId1->save();
            $this->checkTaskForBillDocuments($request);
            $this->addGlobalAllLog('INJURY_DOCUMENT_CREATED','App\AllDocument','Created Injury Document',$injuryDocumentId1->injury_id);
            return $injuryDocumentId1->injury_id;
        }
    }
    public function storeTepInjuryDocuments($request) {
        
        // echo "<pre>";
        // print_r($request->all());exit;
        if($request->file('myFile')){
           // $document_path = $request->file('myFile')->store('public/document');
           $file                = $request->file('myFile');
           $filename2           = Str::random(12);
           $fileExt             = $file->getClientOriginalExtension();
           $injury_document     = Config::get('global_variables');
           $destinationPath     = public_path('injury_document');
           $filename2           = $filename2 . '.' . $fileExt;
           $document_path       = $filename2;
           $file->move($destinationPath, $filename2);
        }
        if(isset($request->fileName)){
            $filePathName = $destinationPath."/".$request->fileName;
            if (File::exists($filePathName)) {
                File::delete($filePathName);
            }
        }

        $injuryDocument = AllDocument::where('id', $request->injuryDocumentId)->first();
        $provider_id = ($request->providerId) ? $request->providerId : null;
       if($injuryDocument){
           //$injuryDocument->provider_id            = $provider_id; 
            $injuryDocument->injury_document	    = $document_path;
            $injuryDocument->is_active	            =  1;
            $injuryDocument->added_by               = Auth::user()->id;
            $injuryDocument->update(); 
            return $injuryDocument->id;
        }
        else{
            $injuryDocumentId1 = new AllDocument();
            $injuryDocumentId1->injury_document	        = $document_path;
            $injuryDocumentId1->is_active	            =  1;
            $injuryDocumentId1->added_by                = Auth::user()->id;
            $injuryDocumentId1->save();
            return $injuryDocumentId1->id;
        }
    }
}