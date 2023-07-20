<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\{Patient_injury, InjuryClaim};
use Illuminate\Http\Request;
use Toastr;
use Symfony\Component\HttpFoundation\Response;
use DB;

class PatientInjuryController extends Controller
{
    public function index()
    {
        //
    }

    public function create()  { }

    public function store(Request $request)
    {
       try {
        // echo "<pre>";
        // print_r($request->all());exit;
            //request()->validate(['patient_id' => 'required', 'financial_class' => 'required', 'injury_state_id' => 'required', 'description' => 'required']);

        if($request->financial_class == 1){
            request()->validate(['employer_name' => 'required', 'start_date' => 'required', 'claim_no' => 'required', "work_dg_code_id" => 'required|array|min:1'],
                [ 'employer_name.required' => 'The Employer Name can not be empty.',
                    'start_date.required' => 'The Start Date can not be empty.',
                    'claim_no.required' => 'The Claim No. can not be empty.'
                ]
            );
            $has_any_diagnosis = false;
            $countArr = count($request->work_dg_code_id);
            for($i = 0; $i< $countArr; $i++){
                if($request->work_dg_code_id[$i]['value']){
                    $has_any_diagnosis = true; break;
                }
            }
            if(!$has_any_diagnosis){
                return response()->json(
                  [
                    'success' => 0,
                    'errors' => 'The Diagnosis Detail can not be empty.',
                    'message' => 'The Diagnosis Detail can not be empty.',
                  ]
                );
            }

        }else if($request->financial_class == 2){
            request()->validate(['ins_payer' => 'required', 'ins_subscriber' => 'required', 'ins_group_no' => 'required', 'ins_deduct_amt' => 'required', 'ins_copay_amt' => 'required'],
                [ 'ins_payer.required' => 'The Insurance Payer can not be empty.',
                    'ins_subscriber.required' => 'The Subscriber ID can not be empty.',
                    'ins_group_no.required' => 'The Group No. can not be empty.',
                    'ins_deduct_amt.required' => 'The Deductible Amt. can not be empty.',
                    'ins_copay_amt.required' => 'The Co-payment Amt. can not be empty.'
                ]
            );
        }else if($request->financial_class == 3){
            request()->validate(['p_attorney_name' => 'required', 'p_payer_name' => 'required', 'p_law_officer_name' => 'required', 'p_injury_date' => 'required', 'p_claim_id' => 'required', 'p_ssn_no' => 'required', 'p_handle_attorn_individual' => 'required', 'p_address_line1' => 'required'],
                [ 'p_attorney_name.required' => 'The Attorney Name can not be empty.',
                    'p_payer_name.required' => 'The Payer Name can not be empty.',
                    'p_law_officer_name.required' => 'The Law Officer Name can not be empty.',
                    'p_injury_date.required' => 'The Date of Injury can not be empty.',
                    'p_claim_id.required' => 'The Claim ID can not be empty.',
                    'p_ssn_no.required' => 'The SSN can not be empty.',
                    'p_handle_attorn_individual.required' => 'The Handling Attorney Individual can not be empty.',
                    'p_address_line1.required' => 'The Address Line can not be empty.'
                ]
                );
        }

        //print_r($request);   die();
        $injury_id = $this->storePatientinjuryInfo($request);
        //$claim_id = $this->storeInjuryclaimInfo($request, $injury_id);
        //$this->storeInjurydiagnoses($request, $claim_id);

        // return response()->json(
        //   [
        //     'success' => 1,
        //     'message' => 'Injury Data inserted successfully',
        //     'patient_id'  =>$request->patient_id,
        //     'injury_id'  =>$injury_id,
        //     'claim_id'  =>$claim_id
        //   ]
        // );
        return redirect('create/patients/injury/'.$request->patient_id."/".$injury_id)->with('success','Patient Injury Data inserted successfully');

    }
    catch (\Exception $e) {
        $message= $e->getMessage();
        $toastr_title=trans('messages.toastr_error');
        Toastr::error($message,'',["positionClass" => "toast-top-center"]);
        return redirect()->back();
    }
    }

    public function show(Patient_injury $patientinjury)
    {
        //echo 'aaa '.$patientinjury->id;
        $injury_claims = $this->getInjuryclaim($patientinjury->id);
        $diagnoses = $this->getInjurydiagnoses($patientinjury->id);
        $bills = $this->getBillCount($patientinjury->id);

        $html = '<div class="row" style="width:100%">
            <table class="table">';

        if(isset($injury_claims->financial_class)){
            $html .= '<tr>
                        <td width="10%"><b>Financial Class</b></td>
                        <td width="40%">'.(($injury_claims->financial_class == 1) ? 'Worker Comp.' : (($injury_claims->financial_class == 2) ? 'Private / Government' : 'Personal Injury')).' </td>
                    </tr>
                    <tr>
                        <td><b>Injury</b></td>
                        <td>'.$injury_claims->description.'</td>
                    </tr>
                    <tr>
                        <td><b>State</b></td>
                        <td>'.$injury_claims->state_name.'</td>
                    </tr>';

            if($injury_claims->financial_class == 1){
                $diagnos_codes = '';
                foreach($diagnoses as $d){
                    if($diagnos_codes != '') $diagnos_codes .= ', ';
                    $diagnos_codes .= $d->diagnosis_name.'('. $d->diagnosis_code.')' ;
                }
                if($diagnos_codes == '') $diagnos_codes = 'NA';
                $html .= '<tr>
                            <td><b>Employer</b></td>
                            <td>'.$injury_claims->employer_name.'</td>
                        </tr>
                        <tr>
                            <td><b>Employer Address</b></td>
                            <td>'.$injury_claims->emp_address_line1.' '.$injury_claims->emp_address_line2.' '.$injury_claims->emp_zipcode .'</td>
                        </tr>
                        <tr>
                            <td><b>DOI</b></td>
                            <td>'.$injury_claims->start_date.'    '.$injury_claims->end_date.'</td>
                        </tr>
                        <tr>
                            <td><b>Claim Administrator</b></td>
                            <td>'.$injury_claims->claimadmin.'</td>
                        </tr>
                        <tr>
                            <td><b>Claim No.</b></td>
                            <td>'.$injury_claims->claim_no.'</td>
                        </tr>
                        <tr>
                            <td><b>Payer</b></td>
                            <td>'.$injury_claims->payer_id.'</td>
                        </tr>
                        <tr>
                            <td><b>Claim Status</b></td>
                            <td>'.$injury_claims->claim_status.'</td>
                        </tr>
                        <tr>
                            <td><b>Claim Status Date</b></td>
                            <td>'.$injury_claims->claim_status_date.'</td>
                        </tr>
                        <tr>
                            <td><b>ADJ No.</b></td>
                            <td>'.$injury_claims->adj_no.'</td>
                        </tr>
                        <tr>
                            <td><b>Medical Provider</b></td>
                            <td>'.$injury_claims->medicalprovider.'</td>
                        </tr>
                        <tr>
                            <td><b>Diagnosis Code</b></td>
                            <td>'.$diagnos_codes.'</td>
                        </tr>';

            }else if($injury_claims->financial_class == 2){
                $html .= '<tr>
                            <td><b>Insurance Payer</b></td>
                            <td>'.$injury_claims->ins_payer.'</td>
                        </tr>
                        <tr>
                            <td><b>Subscriber ID</b></td>
                            <td>'.$injury_claims->ins_subscriber .'</td>
                        </tr>
                        <tr>
                            <td><b>Group No.</b></td>
                            <td>'.$injury_claims->ins_group_no.'</td>
                        </tr>
                        <tr>
                            <td><b>Deductible Amt.</b></td>
                            <td>'.$injury_claims->ins_deduct_amt.'</td>
                        </tr>
                        <tr>
                            <td><b>Co-payment Amt.</b></td>
                            <td>'.$injury_claims->ins_copay_amt.'</td>
                        </tr>
                        <tr>
                            <td><b>Co-Insurance Amt.</b></td>
                            <td>'.$injury_claims->ins_coins_amt.'</td>
                        </tr>
                        <tr>
                            <td><b>Authorization Info.</b></td>
                            <td>'.$injury_claims->ins_authinfo.'</td>
                        </tr>
                        <tr>
                            <td><b>No. of visit authorized</b></td>
                            <td>'.$injury_claims->ins_no_of_visit.'</td>
                        </tr>';
            }else if($injury_claims->financial_class == 3){
                $html .= '<tr>
                            <td><b>Date of Injury</b></td>
                            <td>'.$injury_claims->p_injury_date.'</td>
                        </tr>
                        <tr>
                            <td><b>Attorney Name</b></td>
                            <td>'.$injury_claims->p_attorney_name.'</td>
                        </tr>
                        <tr>
                            <td><b>Payer Name</b></td>
                            <td>'.$injury_claims->p_payer_name.'</td>
                        </tr>
                        <tr>
                            <td><b>Law Officer Name</b></td>
                            <td>'.$injury_claims->p_law_officer_name.'</td>
                        </tr>
                        <tr>
                            <td><b>Claim ID</b></td>
                            <td>'.$injury_claims->p_claim_id.'</td>
                        </tr>
                        <tr>
                            <td><b>SSN</b></td>
                            <td>'.$injury_claims->p_ssn_no.'</td>
                        </tr>
                        <tr>
                            <td><b>Address</b></td>
                            <td>'.$injury_claims->p_address_line1.' '.$injury_claims->p_address_line2.' '.$injury_claims->p_zipcode .'</td>
                        </tr>
                        <tr>
                            <td><b>Handling Attorney Individual</b></td>
                            <td>'.$injury_claims->p_handle_attorn_individual.'</td>
                        </tr>
                        <tr>
                            <td><b>Contact No.</b></td>
                            <td>'.$injury_claims->p_contact_no.'</td>
                        </tr>
                        <tr>
                            <td><b>Others</b></td>
                            <td>'.$injury_claims->p_others.'</td>
                        </tr>';

            }

        }
        $html .= '</table></div>';

        $options = '<span class="fa fa-refresh"></span>
            <span>Bill
            <a class=""  onclick="show_content(`add_patient_injury_bill`, '.$patientinjury->id.')"> <b>+</b>Add </a> &nbsp;</span>';
        if($bills->totalBill > 0){
            $options .= '/ <a class=""  onclick="view_injury_bill('.$patientinjury->id.')" >View <b>('. $bills->totalBill.')</b> </a> &nbsp;</span>';

            //$options .= '/ <a class=""  href="/billinfos/bills/'.$patientinjury->id.'" >View <b>('. $bills->totalBill.')</b> </a> &nbsp;</span>';
        }

        return response()->json(
          [
            'success' => 1,
            'message' => 'success',
            'patient_id'  =>$injury_claims->patient_id,
            'injury_id'  =>$patientinjury->id,
            'html'    =>$html,
            'options' =>$options,
            'diagnoses' =>$diagnoses
          ]
        );
    }

    public function edit(Patient_injury $patientinjury)  {  }

    public function update(Request $request, Patient_injury $patientinjury)  { }

    public function destroy(Patient_injury $patientinjury)
    {
        //
    }
    public function storeInjury(Request $request)
    {
        echo '<pre>';exit;
        print_r($request->all());exit;

        // request()->validate(['patient_id' => 'required', 'financial_class' => 'required', 'injury_state_id' => 'required', 'description' => 'required']);

        // if($request->financial_class == 1){
        //     request()->validate(['employer_name' => 'required', 'start_date' => 'required', 'claim_no' => 'required', "work_dg_code_id" => 'required|array|min:1'],
        //         [ 'employer_name.required' => 'The Employer Name can not be empty.',
        //             'start_date.required' => 'The Start Date can not be empty.',
        //             'claim_no.required' => 'The Claim No. can not be empty.'
        //         ]
        //     );
        //     $has_any_diagnosis = false;
        //     $countArr = count($request->work_dg_code_id);
        //     for($i = 0; $i< $countArr; $i++){
        //         if($request->work_dg_code_id[$i]['value']){
        //             $has_any_diagnosis = true; break;
        //         }
        //     }
        //     if(!$has_any_diagnosis){
        //         return response()->json(
        //           [
        //             'success' => 0,
        //             'errors' => 'The Diagnosis Detail can not be empty.',
        //             'message' => 'The Diagnosis Detail can not be empty.',
        //           ]
        //         );
        //     }

        // }else if($request->financial_class == 2){
        //     request()->validate(['ins_payer' => 'required', 'ins_subscriber' => 'required', 'ins_group_no' => 'required', 'ins_deduct_amt' => 'required', 'ins_copay_amt' => 'required'],
        //         [ 'ins_payer.required' => 'The Insurance Payer can not be empty.',
        //             'ins_subscriber.required' => 'The Subscriber ID can not be empty.',
        //             'ins_group_no.required' => 'The Group No. can not be empty.',
        //             'ins_deduct_amt.required' => 'The Deductible Amt. can not be empty.',
        //             'ins_copay_amt.required' => 'The Co-payment Amt. can not be empty.'
        //         ]
        //     );
        // }else if($request->financial_class == 3){
        //     request()->validate(['p_attorney_name' => 'required', 'p_payer_name' => 'required', 'p_law_officer_name' => 'required', 'p_injury_date' => 'required', 'p_claim_id' => 'required', 'p_ssn_no' => 'required', 'p_handle_attorn_individual' => 'required', 'p_address_line1' => 'required'],
        //         [ 'p_attorney_name.required' => 'The Attorney Name can not be empty.',
        //             'p_payer_name.required' => 'The Payer Name can not be empty.',
        //             'p_law_officer_name.required' => 'The Law Officer Name can not be empty.',
        //             'p_injury_date.required' => 'The Date of Injury can not be empty.',
        //             'p_claim_id.required' => 'The Claim ID can not be empty.',
        //             'p_ssn_no.required' => 'The SSN can not be empty.',
        //             'p_handle_attorn_individual.required' => 'The Handling Attorney Individual can not be empty.',
        //             'p_address_line1.required' => 'The Address Line can not be empty.'
        //         ]
        //         );
        // }

        // //print_r($request);   die();
        // $injury_id = $this->storePatientinjuryInfo($request);
        // $claim_id = $this->storeInjuryclaimInfo($request, $injury_id);
        // $this->storeInjurydiagnoses($request, $claim_id);

        // return response()->json(
        //   [
        //     'success' => 1,
        //     'message' => 'Injury Data inserted successfully',
        //     'patient_id'  =>$request->patient_id,
        //     'injury_id'  =>$injury_id,
        //     'claim_id'  =>$claim_id
        //   ]

        // );
        // return redirect('create/patients/injury/'.$request->patient_id);
    }
    

    public function saveInjuryNotes(Request $request)
    {
        //echo "<pre>";
       // print_r($request->all());exit;
       
        try {
            DB::beginTransaction();
            $this->storeInjuryNote($request);
            DB::commit();
            return redirect('injury/view/'.$request->injuryId)->with('success','Patient Injury Note Data inserted successfully');
        }
        catch(\Exception $e)
        {
            DB::rollback(); 
            return redirect()->back()->withErrors('error','Something went wrong!!');
        }
    }
    public function saveInjuryContact(Request $request)
    {
       // 
        try {
            DB::beginTransaction();
            $this->storeInjuryContact($request);
            DB::commit();
            return redirect('injury/view/'.$request->injuryId)->with('success','Patient Injury Contact Data inserted successfully');
        }
        catch(\Exception $e)
        {
            DB::rollback(); 
            return redirect()->back()->withErrors('error','Something went wrong!!');
        }
    }
    public function savePatientInjury(Request $request)
    {
       try {
            DB::beginTransaction();
            $this->storePatientinjuryInfo($request);
            // echo "<pre>";
            // print_r($result);exit;
            DB::commit();
            $toastr_title = trans('messages.toastr_success');            
            if(isset($request->injuryId)){
                Toastr::success("Injury Updated succesffully", '', ["positionClass" => "toast-top-center"]);
                return redirect('/injury/view/'.$request->injuryId)->with('success','Patient Injury Data updated successfully');
            }
            else{
                Toastr::success("Injury Added succesffully", '', ["positionClass" => "toast-top-center"]);
                return redirect('patients/view/'.$request->patient_id)->with('success','Patient Injury Data inserted successfully');
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            $message= $e->getMessage();
            $toastr_title=trans('messages.toastr_error');
            Toastr::error($message,'',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
}