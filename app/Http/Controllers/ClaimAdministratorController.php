<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\{Company_type, BillTreatmentType, BillSubmissionType, City,State};
use App\Models\{ClaimAdministrator, ClaimBillReview, ClaimAuthContact, ClaimMailAddress, ClaimMailBillSubmissionType, ClaimMailBillTreatmentType};
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Toastr;
use DB;

class ClaimAdministratorController extends Controller
{
    public function index()
    {
        $states = State::where('is_active', 1)->orderBy('state_name')->get();
        $claims = ClaimAdministrator::leftjoin('company_types as comp', 'claim_administrators.company_type_id', '=', 'comp.id')
                            ->select('claim_administrators.*', 'comp.name as company_type')->orderBy('claim_administrators.id', 'desc')->get();
                            //->paginate(15);

        $i =  (request()->input('page', 1) - 1) * 5;
        //var_dump($claimadministrators); die();
        return view('claimadministrators.index', compact('states', 'claims', 'i'));
    }

    public function create()
    {
        //$states = State::where('is_active', 1)->orderBy('state_name')->get(); 
        $company_types = Company_type::where('is_active', 1)->orderBy('name')->get(); 
        $bill_treatment_types = BillTreatmentType::where('is_active', 1)->orderBy('bill_treatment_type')->get();
        $bill_submission_types = BillSubmissionType::where('is_active', 1)->orderBy('bill_submission_type')->get();
             
        return view('claimadministrators.create', compact('company_types', 'bill_treatment_types', 'bill_submission_types'));
    }

    public function store(Request $request)
    {
        if($request->step == 'step1'){
            
             $validator = Validator::make($request->all(),[
                'company_type_id' => 'required', 'name' => 'required', 'payer_id'=>'required', 'payer_name' => 'required', 'website' => 'required', 'description' => 'required'
            ]);
            if ($validator->fails()) {
                return $this->redirectToRoute(redirect()->back(), $validator->errors()->first(), 'error', ["positionClass" => "toast-top-center"]); 
            } 
            try
            {
            DB::beginTransaction(); 
                $checkAdmin = ClaimAdministrator::where('name', $request->name)->get(); 
                if($checkAdmin)
                {
                    return $this->redirectToRoute('/claimadministrators', 'This claim admin already exist', 'error', ["positionClass" => "toast-top-center"]);
                }
                else{
                    $claims = new ClaimAdministrator();
                    $claims->company_type_id = $request->company_type_id;
                    $claims->name = $request->name;
                    $claims->alias = $request->alias;
                    $claims->payer_id = $request->payer_id;
                    $claims->website = $request->website;
                    $claims->email = $request->email;
                    $claims->start_time = $request->start_time;
                    $claims->end_time = $request->end_time;
                    $claims->description = $request->description  ;
                    $claims->bill_process_flow_note = $request->bill_process_flow_note;
                    $claims->save();
        
                    $claim_admin_id = $claims->id;
                    // return response()->json(
                    // [
                    //     'success' => 1,
                    //     'message' => 'Claim Data inserted successfully',
                    //     'claim_admin_id'  =>$claim_admin_id
                    // ]
                    // );
                }
                DB::commit();
                return $this->redirectToRoute('/claimadministrators', 'Claim admin added successfully', 'success', ["positionClass" => "toast-top-center"]);
            }catch(\Exception $e){     
                DB::rollback();
                return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]); 
            }

            //request()->validate(['company_type_id' => 'required', 'name' => 'required', 'payer_id'=>'required', 'payer_name' => 'required', 'website' => 'required', 'description' => 'required' ]);

            // $validator = Validator::make($request->all(), [
            //     'company_type_id' => 'required', 'name' => 'required', 'payer_id'=>'required', 'payer_name' => 'required', 'website' => 'required', 'description' => 'required'
            // ]);
            // return response()->json($validator->errors());

            
            
        }else if($request->step == 'step2'){
            request()->validate(['claim_admin_id' => 'required']);
            $claim_admin_id = intval($request->claim_admin_id);
            $arrlen = count($request->name);     $msg = 'No Data Found.';       
            for($i = 0; $i < $arrlen; $i++ ){
                if(isset($request->name[$i]) && trim($request->name[$i]) != '' ){
                    $name = $request->name[$i];
                    $contact_no = isset($request->contact_no[$i]) ? $request->contact_no[$i] : '';
                    $website = isset($request->website[$i]) ? $request->website[$i] : '';
                    $email = isset($request->email[$i]) ? $request->email[$i] : '';
                    $fax_no = isset($request->fax_no[$i]) ? $request->fax_no[$i] : '';
                    $address_line1 = isset($request->address_line1[$i]) ? $request->address_line1[$i] : '';
                    //echo $licenseno.' >> '.$state_id; echo "<br/>";                    

                    $claim_bills = new ClaimBillReview();
                    $claim_bills->claim_admin_id = $claim_admin_id;
                    $claim_bills->name = $name;
                    $claim_bills->contact_no = $contact_no;
                    $claim_bills->website = $website;
                    $claim_bills->email = $email;
                    $claim_bills->fax_no = $fax_no;
                    $claim_bills->address_line1 = $address_line1;
                    $claim_bills->save();
                    $msg = 'Bill Review Data inserted successfully';
                }
            }
            return response()->json(
              [
                'success' => 1,
                'message' => $msg,
                'claim_admin_id'  =>$claim_admin_id
              ]
            );
        }else if($request->step == 'step3'){
            request()->validate(['claim_admin_step3' => 'required']);
            $claim_admin_id = intval($request->claim_admin_step3);
            $arrlen = count($request->rfa_contact_no);     $msg = 'No Data Found.';       
            for($i = 0; $i < $arrlen; $i++ ){
                if(isset($request->rfa_contact_no[$i]) && trim($request->rfa_contact_no[$i]) != '' ){
                    $rfa_contact_no = $request->rfa_contact_no[$i];
                    $rfa_fax_no = $request->rfa_fax_no[$i];
                    
                    $claim_rfa = new ClaimAuthContact();
                    $claim_rfa->claim_admin_id = $claim_admin_id;
                    $claim_rfa->rfa_contact_no = $rfa_contact_no;
                    $claim_rfa->rfa_fax_no = $rfa_fax_no;
                    $claim_rfa->save();
                    $msg = 'Authorize Info Data inserted successfully';
                }
            }
            return response()->json(
              [
                'success' => 1,
                'message' => $msg,
                'claim_admin_id'  =>$claim_admin_id
              ]
            );
        }else if($request->step == 'step4'){
            
            request()->validate(['claim_admin_step4' => 'required']);
            $claim_admin_id = intval($request->claim_admin_step4);

            $arrlen = count($request->mail_address_line1);     $msg = 'No Data Found.';       
            for($i = 0; $i < $arrlen; $i++ ){
                if(isset($request->mail_address_line1[$i]) && trim($request->mail_address_line1[$i]) != '' ){
                    $company_name = isset($request->company_name[$i]) ? $request->company_name[$i] : '';
                    $address_line1 = $request->mail_address_line1[$i];
                    $notes = isset($request->notes[$i]) ? $request->notes[$i] : '';
                    $bill_treatment_type_id = isset($request->bill_treatment_type_id[$i]) ? $request->bill_treatment_type_id[$i] : 0;
                    $bill_submission_type_idArr = isset($request->bill_submission_type_id[$i]) ? $request->bill_submission_type_id[$i] : 0;
                    
                    $claim_mail_adr = new ClaimMailAddress();
                    $claim_mail_adr->claim_admin_id = $claim_admin_id;
                    $claim_mail_adr->company_name = $company_name;
                    $claim_mail_adr->address_line1 = $address_line1;
                    $claim_mail_adr->notes = $notes;
                    $claim_mail_adr->save();

                    $claim_mail_id = $claim_mail_adr->id;
                    if($bill_treatment_type_id){
                        $claim_bill_treatment = new ClaimMailBillTreatmentType();
                        $claim_bill_treatment->claim_mail_id = $claim_mail_id;
                        $claim_bill_treatment->bill_treatment_type_id = $bill_treatment_type_id;
                        $claim_bill_treatment->save();                    
                    }
                    if($bill_submission_type_idArr && !empty($bill_submission_type_idArr)){
                        foreach($bill_submission_type_idArr as $bill_submission_type_id){
                            $claim_bill_sub = new ClaimMailBillSubmissionType();
                            $claim_bill_sub->claim_mail_id = $claim_mail_id;
                            $claim_bill_sub->bill_submission_type_id = $bill_submission_type_id;
                            $claim_bill_sub->save();
                        }
                    }
                    $msg = 'Claim Mail Address Data inserted successfully';
                }
            }
            $msg = 'Claim Administrator created successfully.';
            return response()->json(
              [
                'success' => 1,
                'message' => $msg
              ]
            );
        }        
    }

    public function show(ClaimAdministrator $claimadministrator)  { }

    public function edit(ClaimAdministrator $claimadministrator)
    {
        $company_types = Company_type::where('is_active', 1)->orderBy('name')->get(); 
        $bill_treatment_types = BillTreatmentType::where('is_active', 1)->orderBy('bill_treatment_type')->get();
        $bill_submission_types = BillSubmissionType::where('is_active', 1)->orderBy('bill_submission_type')->get();

        $claim_bills = $claim_auths = $claim_mails = array();

        $claim_bills = ClaimBillReview::where('claim_admin_id', $claimadministrator->id)->get();            
        $claim_auths = ClaimAuthContact::where('claim_admin_id', $claimadministrator->id)->get();
        $claim_mails = ClaimMailAddress::where('claim_admin_id', $claimadministrator->id)->get();
        if(!empty($claim_mails)){
            foreach($claim_mails as $claim_mail){                
                $claim_mail_bills = ClaimMailBillTreatmentType::where('claim_mail_id', $claim_mail->id)->get();
                $claim_subs = ClaimMailBillSubmissionType::where('claim_mail_id', $claim_mail->id)->get();

                $claim_mail->bill_treatment_type_id = $claim_mail->bill_submission_type_id = array();
                if($claim_mail_bills){
                    $tmp = array();
                    foreach($claim_mail_bills as $subtype){                     
                        array_push($tmp, $subtype->bill_treatment_type_id);
                    }
                    $claim_mail->bill_treatment_type_id = $tmp;                  
                }
                if($claim_subs){
                    $tmp = array();
                    foreach($claim_subs as $subtype){                     
                        array_push($tmp, $subtype->bill_submission_type_id);
                    }
                    $claim_mail->bill_submission_type_id = $tmp;
                }
            }
        }   

        return view('claimadministrators.edit', compact('claimadministrator', 'claim_bills', 'claim_auths', 'claim_mails', 'company_types', 'bill_treatment_types', 'bill_submission_types'));
    }

    public function update(Request $request, ClaimAdministrator $claimadministrator)
    {        
        if($request->step == 'step1'){
            request()->validate(['company_type_id' => 'required', 'name' => 'required']);

            $updateArr = array(
                'company_type_id' => $request->company_type_id,
                'name' => $request->name,
                'alias' => $request->alias,
                'payer_id' => $request->payer_id,
                'website' => $request->website,
                'email' => $request->email,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'description' => $request->description,
                'bill_process_flow_note' => $request->bill_process_flow_note
            );        
            ClaimAdministrator::where("id", $claimadministrator->id)->update($updateArr);            
            return response()->json(
              [
                'success' => 1,
                'message' => 'Claim Data updated successfully',
                'claim_admin_id'  =>$claimadministrator->id
              ]
            );
        }else if($request->step == 'step2'){
            request()->validate(['claim_admin_id' => 'required']);
            $claim_admin_id = intval($request->claim_admin_id);
            $msg = 'No Data Found.';       

            //print_r($request->billrvws); die();
           
            foreach($request->billrvws as $idx =>$values){                
                $name = $values['name'];
                if(trim($name) != ''){
                    if($values['key']){ //update here
                        $claim_bill_id = trim($values['key']);
                        $updateArr = array(
                            'name' => trim($values['name']),
                            'contact_no' => trim($values['contact_no']),
                            'website' => trim($values['website']),
                            'email' => trim($values['email']),
                            'fax_no' => trim($values['fax_no']),
                            'address_line1' => trim($values['address_line1'])
                        );
                        ClaimBillReview::where("id", $claim_bill_id)->update($updateArr);
                    }else{ //add here
                        $claim_bills = new ClaimBillReview();
                        $claim_bills->claim_admin_id = $claim_admin_id;
                        $claim_bills->name = trim($values['name']);
                        $claim_bills->contact_no = trim($values['contact_no']);
                        $claim_bills->website = trim($values['website']);
                        $claim_bills->email = trim($values['email']);
                        $claim_bills->fax_no = trim($values['fax_no']);
                        $claim_bills->address_line1 = trim($values['address_line1']);
                        $claim_bills->save();
                    } 
                    $msg = 'Claim Bill Review updated successfully';                 
                }
            }
            return response()->json(
              [
                'success' => 1,
                'message' => $msg,
                'claim_admin_id'  =>$claim_admin_id
              ]
            );
        }else if($request->step == 'step3'){
            request()->validate(['claim_admin_step3' => 'required']);
            $claim_admin_id = intval($request->claim_admin_step3);
            $msg = 'No Data Found.'; 
            foreach($request->rfaauths as $idx =>$values){                
                $rfa_contact_no = $values['rfa_contact_no'];
                if(trim($rfa_contact_no) != ''){
                    if($values['key']){ //update here
                        $claim_auth_id = trim($values['key']);
                        $updateArr = array(
                            'rfa_contact_no' => trim($values['rfa_contact_no']),
                            'rfa_fax_no' => trim($values['rfa_fax_no'])
                        );
                        ClaimAuthContact::where("id", $claim_auth_id)->update($updateArr);
                    }else{ //add here
                        $claim_rfa = new ClaimAuthContact();
                        $claim_rfa->claim_admin_id = $claim_admin_id;
                        $claim_rfa->rfa_contact_no = trim($values['rfa_contact_no']);
                        $claim_rfa->rfa_fax_no = trim($values['rfa_fax_no']);
                        $claim_rfa->save();
                    } 
                    $msg = 'Claim RFA Auth updated successfully';                   
                }
            }
            return response()->json(
              [
                'success' => 1,
                'message' => $msg,
                'claim_admin_id'  =>$claim_admin_id
              ]
            );
        }else if($request->step == 'step4'){
            
            request()->validate(['claim_admin_step4' => 'required']);
            $claim_admin_id = intval($request->claim_admin_step4);

            $msg = 'No Data Found.';
            ////////
            foreach($request->mailadr as $idx =>$values){                
                $mail_address_line1 = $values['mail_address_line1'];
                if(trim($mail_address_line1) != ''){
                    if($values['key']){ //update here
                        $claim_mail_id = trim($values['key']);
                        $updateArr = array(
                            'company_name' => trim($values['company_name']),
                            'notes' => trim($values['notes']),
                            'address_line1' => trim($values['mail_address_line1'])
                        );
                        ClaimMailAddress::where("id", $claim_mail_id)->update($updateArr);

                        $bill_treatment_type_id = ($values['bill_treatment_type_id'])  ? ($values['bill_treatment_type_id']) : 0;
                        $bill_submission_type_idArr = ($values['bill_submission_type_id']) ? ($values['bill_submission_type_id']) : 0;
                        //Delete previous records here
                        ClaimMailBillTreatmentType::where("claim_mail_id", $claim_mail_id)->update(['is_active' => '0']);
                        ClaimMailBillTreatmentType::where("claim_mail_id", $claim_mail_id)->delete();
                        ClaimMailBillSubmissionType::where("claim_mail_id", $claim_mail_id)->update(['is_active' => '0']);
                        ClaimMailBillSubmissionType::where("claim_mail_id", $claim_mail_id)->delete();
                        //End here
                        if($bill_treatment_type_id){
                            $claim_bill_treatment = new ClaimMailBillTreatmentType();
                            $claim_bill_treatment->claim_mail_id = $claim_mail_id;
                            $claim_bill_treatment->bill_treatment_type_id = $bill_treatment_type_id;
                            $claim_bill_treatment->save();                    
                        }
                        if($bill_submission_type_idArr && !empty($bill_submission_type_idArr)){
                            foreach($bill_submission_type_idArr as $bill_submission_type_id){
                                $claim_bill_sub = new ClaimMailBillSubmissionType();
                                $claim_bill_sub->claim_mail_id = $claim_mail_id;
                                $claim_bill_sub->bill_submission_type_id = $bill_submission_type_id;
                                $claim_bill_sub->save();
                            }
                        }

                    }else{ //add here
                        $claim_mail_adr = new ClaimMailAddress();
                        $claim_mail_adr->claim_admin_id = $claim_admin_id;
                        $claim_mail_adr->company_name = trim($values['company_name']);
                        $claim_mail_adr->notes = trim($values['notes']);
                        $claim_mail_adr->address_line1 = trim($values['mail_address_line1']);
                        $claim_mail_adr->save();

                        $bill_treatment_type_id = ($values['bill_treatment_type_id']) ? ($values['bill_treatment_type_id']) : 0;
                        $bill_submission_type_idArr = ($values['bill_submission_type_id']) ? ($values['bill_submission_type_id']) : 0;
                        
                        if($bill_treatment_type_id){
                            $claim_bill_treatment = new ClaimMailBillTreatmentType();
                            $claim_bill_treatment->claim_mail_id = $claim_mail_id;
                            $claim_bill_treatment->bill_treatment_type_id = $bill_treatment_type_id;
                            $claim_bill_treatment->save();                    
                        }
                        if($bill_submission_type_idArr && !empty($bill_submission_type_idArr)){
                            foreach($bill_submission_type_idArr as $bill_submission_type_id){
                                $claim_bill_sub = new ClaimMailBillSubmissionType();
                                $claim_bill_sub->claim_mail_id = $claim_mail_id;
                                $claim_bill_sub->bill_submission_type_id = $bill_submission_type_id;
                                $claim_bill_sub->save();
                            }
                        }
                    } 
                    $msg = 'Claim Mail Address updated successfully';                   
                }
            }
            $msg = 'Claim Administrator created successfully.';
            return response()->json(
              [
                'success' => 1,
                'message' => $msg
              ]
            );
        }
    }

    public function destroy(ClaimAdministrator $claimadministrator)
    {
        ClaimAdministrator::where("id", $claimadministrator->id)->update(['is_active' => '0']);        
        $claimadministrator->delete();
        Session::flash('success', 'Data blocked successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data blocked successfully'
          ]
        );
    }

    public function restore(Request $request)
    {
        ClaimAdministrator::withTrashed()->find($request->id)->restore(); 
        ClaimAdministrator::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
    public function viewCompanyList()
    {
        $company_types = Company_type::where('is_active', 1)->orderBy('name')->get(); 
        return view('masters.companytypes.index', compact('company_types'));
    }
}
