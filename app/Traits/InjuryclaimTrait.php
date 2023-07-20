<?php
namespace App\Traits;
use App\Models\{InjuryClaim, InjuryDiagnosis};

trait InjuryclaimTrait
{
    public function getInjuryclaim($injury_id)
    {
        return InjuryClaim::join('patient_injuries as i', 'injury_claims.injury_id', '=', 'i.id')
                        ->join('states as st', 'i.injury_state_id', '=', 'st.id')
                        ->Leftjoin('claim_administrators as c', 'injury_claims.claim_admin_id', '=', 'c.id')
                        ->Leftjoin('medical_providers as m', 'injury_claims.medical_provider_id', '=', 'm.id')
                        ->Leftjoin('claim_statuses as cs', 'injury_claims.claim_status_id', '=', 'cs.id')

                        ->select('st.state_name','i.description', 'i.patient_id', 'i.financial_class', 'i.injury_state_id', 'injury_claims.*', 'c.name as claimadmin', 'm.applicant_name as medicalprovider', 'cs.claim_status')
                        ->where('injury_claims.injury_id', $injury_id)->first();
    }

    public function getInjurydiagnoses($injury_id)
    {
        return InjuryClaim::Leftjoin('injury_diagnoses as id', 'injury_claims.id', '=', 'id.injury_claim_id')
                        ->join('diagnosis_codes as d', 'id.diagnosis_code_id', '=', 'd.id')
                        ->select('d.diagnosis_name', 'd.diagnosis_code', 'id.id', 'id.injury_claim_id', 'id.diagnosis_code_id')
                        ->where('injury_claims.injury_id', $injury_id)
                        ->orderBy('id.id')->get();
    }
    //Add here
    public function storeInjuryclaimInfo($request, $injury_id) {
        $injury_claim = new InjuryClaim();
        $injury_claim->injury_id = $injury_id;
        if($request->financial_class == 1){
            $no_any_claim = isset($request->no_any_claim) ? $request->no_any_claim : '0';
            $no_any_medical_provider = isset($request->no_any_medical_provider) ? $request->no_any_medical_provider : '0';

            $injury_claim->employer_name = $request->employer_name;
            $injury_claim->is_cumulative = $request->is_cumulative;
            $injury_claim->start_date = $request->start_date;
            $injury_claim->end_date = $request->end_date;
            $injury_claim->claim_admin_id = $request->claim_admin_id;
            $injury_claim->no_any_claim = $no_any_claim;
            $injury_claim->payer_id = $request->payer_id;
            $injury_claim->claim_no = $request->claim_no;
            $injury_claim->claim_status_id = $request->claim_status_id;
            $injury_claim->claim_status_date = $request->claim_status_date;
            $injury_claim->medical_provider_id = $request->medical_provider_id;
            //$injury_claim->no_any_medical_provider = $no_any_medical_provider;
            $injury_claim->adj_no = $request->adj_no;
            $injury_claim->emp_address_line1 = $request->emp_address_line1;
            $injury_claim->emp_address_line2 = $request->emp_address_line2;
            $injury_claim->emp_state_id = $request->emp_state_id;
            $injury_claim->emp_city_id = $request->emp_city_id;
            $injury_claim->emp_zipcode = $request->emp_zipcode;

        }else if($request->financial_class == 2){

            $injury_claim->ins_payer = $request->ins_payer;
            $injury_claim->ins_subscriber = $request->ins_subscriber;
            $injury_claim->ins_group_no = $request->ins_group_no;
            $injury_claim->ins_deduct_amt = $request->ins_deduct_amt;
            $injury_claim->ins_copay_amt = $request->ins_copay_amt;
            $injury_claim->ins_coins_amt = $request->ins_coins_amt;
            $injury_claim->ins_authinfo = $request->ins_authinfo;
            $injury_claim->ins_no_of_visit = $request->ins_no_of_visit;
        }else if($request->financial_class == 3){

            $injury_claim->p_attorney_name = $request->p_attorney_name;
            $injury_claim->p_payer_name = $request->p_payer_name;
            $injury_claim->p_law_officer_name = $request->p_law_officer_name;
            $injury_claim->p_injury_date = $request->p_injury_date;
            $injury_claim->p_claim_id = $request->p_claim_id;
            $injury_claim->p_ssn_no = $request->p_ssn_no;
            $injury_claim->p_handle_attorn_individual = $request->p_handle_attorn_individual;
            $injury_claim->p_contact_no = $request->p_contact_no;
            $injury_claim->p_others = $request->p_others;
            $injury_claim->p_address_line1 = $request->p_address_line1;
            $injury_claim->p_address_line2 = $request->p_address_line2;
            $injury_claim->p_state_id = $request->p_state_id;
            $injury_claim->p_city_id = $request->p_city_id;
            $injury_claim->p_zipcode = $request->p_zipcode;
        }
        $injury_claim->save();
        $injury_claim_id =  $injury_claim->id;

        //Assign task details here
        $res = $this->getInjuryFormStatusId($injury_claim, $request->financial_class);
        $this->storeJobAssign('injury', $injury_claim_id, $res[0], $res[1]);
        return $injury_claim_id;
    }

    public function storeInjurydiagnoses($request, $claim_id){
        $result = false;
        $countArr = count($request->work_dg_code_id);
        for($i = 0; $i< $countArr; $i++){
            $diagnosis_code_id = $request->work_dg_code_id[$i]['value'];

            if(isset($request->work_dg_code_id[$i]['key']) && $request->work_dg_code_id[$i]['key'] ){   //update here
                $id =   $request->work_dg_code_id[$i]['key'];

                if(isset($request->work_dg_code_id[$i]['value'])){
                    $updateArr = array('diagnosis_code_id' => $diagnosis_code_id   );
                    InjuryDiagnosis::where("id", $id)->update($updateArr);
                }else{ //delete here
                    //$this->deleteRow(new InjuryDiagnosis(), $id);

                }
                $result = true;
            }else if(isset($request->work_dg_code_id[$i]['value'])){ //add here
                $injury_diagnosis = new InjuryDiagnosis();
                $injury_diagnosis->injury_claim_id = $claim_id;
                $injury_diagnosis->diagnosis_code_id = $diagnosis_code_id;
                $injury_diagnosis->save();
                $result = true;
            }
        }
        return $result;
    }

    //Update here
    public function updateInjuryclaimInfo($request, $id) {
    /*   $updateArr = array(
            'financial_class' => $request->financial_class,
            'description' => $request->description,
            'injury_state_id' => $request->injury_state_id
        );
        return InjuryClaim::where("id", $id)->update($updateArr);
    */
    }

    public function getInjuryFormStatusId($injury_claim, $financial_class){
        $formStatus = config('global.formStatus');
        $form_status = $formStatus['complete']; $status_alias = '';

        if($financial_class == 1){
            if($injury_claim->employer_name && $injury_claim->start_date && $injury_claim->claim_no){
                if($injury_claim->no_any_claim != '1'){
                    if(!$injury_claim->claim_admin_id){ $form_status = $formStatus['incomplete']; }
                }
                if(trim($injury_claim->claim_no) == ''){
                    $form_status = $formStatus['incomplete'];
                }elseif(!$this->isValidClaimNo($injury_claim->claim_no)){
                    $form_status = $formStatus['incomplete'];
                }
                if(!$this->isValidDate($injury_claim->claim_status_date)){
                    $form_status = $formStatus['incomplete'];
                }
                if(!$this->isValidZipcode($injury_claim->emp_zipcode)){
                    $form_status = $formStatus['incomplete'];
                }
            }
        }else if($financial_class == 2){
            if(!$injury_claim->ins_payer || !$injury_claim->ins_subscriber || !$injury_claim->ins_group_no || !$injury_claim->ins_deduct_amt || !$injury_claim->ins_copay_amt){
                $form_status = $formStatus['incomplete'];
            }
        }else if($financial_class == 3){
            if($injury_claim->p_attorney_name && $injury_claim->p_payer_name && $injury_claim->p_law_officer_name && $injury_claim->p_injury_date && $injury_claim->p_claim_id && $injury_claim->p_ssn_no && $injury_claim->p_handle_attorn_individual && $injury_claim->p_address_line1 && $injury_claim->p_zipcode){

                if(!$this->isValidSSN($injury_claim->p_ssn_no)){
                    $form_status = $formStatus['incomplete'];
                }
                if(!$this->isValidDate($injury_claim->p_injury_date)){
                    $form_status = $formStatus['incomplete'];
                }
                if(!$this->isValidZipcode($injury_claim->p_zipcode)){
                    $form_status = $formStatus['incomplete'];
                }
            }
        }else{
            $form_status = $formStatus['incomplete'];
        }
        if($injury_claim->work_dg_code_id){
            if(count($injury_claim->work_dg_code_id)){
                if(!$injury_claim->work_dg_code_id[0]['value']){
                    $form_status = $formStatus['incomplete'];
                }
            }
        }
        if($form_status != $formStatus['complete']){
            $status_alias = 'Failed Review';
        }
        return array($this->getStatusId($form_status), $status_alias);
    }
}
