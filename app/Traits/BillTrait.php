<?php
namespace App\Traits; 
use App\Models\{AppointmentReason, UserBillingProvider, BillDocument,BillInfo, BillInfoProvider, BillProcedureCode, InjuryBill, Patient, Patient_injury, InjuryBillService, BillDiagnosis, AllDocument, Task, UserTask, BillingProviderChargeProcedureCode, BillingProviderCharge, City, State, BillReferingOrderProvider, BillingProvider, BillPlaceService,PlaceOfServices, MasterPlaceOfService, RequestingPhysician, MasterSpecility, PractceLocation, PracticeContact, MasterProviderCharge, MasterBillChargeSheet};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 ini_set('memory_limit', '1024M');


trait BillTrait
{
    public function getBillCount($injury_id)
    {
        return BillInfo::select(DB::raw("count(bill_infos.id) as totalBill"))->where('injury_id', $injury_id)->where('is_active', '1')->first();
    }

    public function getBillListForPayment($injury_id)
    {
        return BillInfo::join('health_providers as h', 'h.id', '=', 'bill_infos.health_provider_id')
            ->select('bill_infos.*', DB::raw("if(h.entity_type = 'Person', concat_ws(' ', h.first_name, h.last_name), h.entity_name) as render_provider_name"))
            ->where('bill_infos.injury_id', $injury_id)->where('bill_infos.is_active', '1')->get();
        //Add join, select and other option, while payment tables are joined
    }

    public function getBillListHTML($injury_id)
    {
        $all_bills = $this->getBillCount($injury_id);
        $bills = $this->getBillListForPayment($injury_id);

        $html = '<div class="row" style="width:100%">
            <table class="table">
            <tr>
                <th width="10%"><b>Bill ID</b></th>
                <th width="10%"><b>DOS</b></th>
                <th width="20%"><b>Rendering Provider</b></th>
                <th width="10%"><b>Charge</b></th>
                <th width="10%"><b>Bill Payment Total</b></th>
                <th width="10%"><b>Balance Due</b></th>
                <th width="10%"><b>Status</b></th>
                <th width="10%"><b>Submission Type</b></th>
                <th width="10%"><b>Task Count</b></th>
            </tr>';
        foreach ($bills as $bill) {
            $html .= '<tr>
                        <td><a href="/billinfos/' . $bill->id . '" >' . $bill->id . '</a></td>
                        <td>' . $bill->start_dos . '</td>
                        <td>' . $bill->render_provider_name . '</td>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td>Pending</td>
                        <td>N/A</td>
                        <td>0</td>
                    </tr>';
        }
        $html .= '</table> </div>';

        $options = '<span class="fa fa-refresh"></span>
            <span>Bill
            <a class=""  onclick="show_content(`add_patient_injury_bill`, ' . $injury_id . ')"> <b>+</b>Add </a> &nbsp;</span>';
        if ($all_bills->totalBill > 0) {
            $options .= '/ <a class=""  onclick="view_injury_bill(' . $injury_id . ')" >View <b>(' . $all_bills->totalBill . ')</b> </a> &nbsp;</span>';
        }
        return array($html, $options);
    }

    

    public function storeBillProvider($request, $bill_id)
    {
        $result = false;
        $countArr = count($request->bill_provider_type);
        for ($i = 0; $i < $countArr; $i++) {

            if (isset($request->bill_provider_type[$i]['key']) && $request->bill_provider_type[$i]['key']) { //update here
                $id = $request->bill_provider_type[$i]['key'];

                if (isset($request->bill_provider_type[$i]['type_id']) && isset($request->bill_provider_type[$i]['provider_name'])) {
                    $bill_provider_type = $request->bill_provider_type[$i]['type_id'];
                    $provider_name = $request->bill_provider_type[$i]['provider_name'];

                    $updateArr = array('bill_provider_type' => $bill_provider_type, 'provider_name' => $provider_name);
                    BillInfoProvider::where("id", $id)->update($updateArr);

                } else { //delete here
                    //$this->deleteRow(new BillInfoProvider(), $id);
                }
                $result = true;

            } else if (isset($request->bill_provider_type[$i]['type_id']) && isset($request->bill_provider_type[$i]['provider_name'])) { //add here
                $bill_provider_type = $request->bill_provider_type[$i]['type_id'];
                $provider_name = $request->bill_provider_type[$i]['provider_name'];

                $bill_info_provider = new BillInfoProvider();
                $bill_info_provider->bill_id = $bill_id;
                $bill_info_provider->bill_provider_type = $bill_provider_type;
                $bill_info_provider->provider_name = $provider_name;
                $bill_info_provider->save();
                $result = true;
            }
        }
        return $result;
    }

    public function storeBillDiagnoses($request, $bill_id)
    {
        $result = false;
        $countArr = count($request->diagnose_code_id);
        for ($i = 0; $i < $countArr; $i++) {

            if (isset($request->diagnose_code_id[$i]['key']) && $request->diagnose_code_id[$i]['key']) { //update here
                $id = $request->diagnose_code_id[$i]['key'];

                if (isset($request->diagnose_code_id[$i]['value'])) {
                    $diagnose_code_id = $request->diagnose_code_id[$i]['value'];

                    $updateArr = array('diagnose_code_id' => $diagnose_code_id);
                    BillDiagnosis::where("id", $id)->update($updateArr);
                } else { //delete here
                    //$this->deleteRow(new BillDiagnosis(), $id);
                }
                $result = true;

            } else if (isset($request->diagnose_code_id[$i]['value'])) { //add here
                $diagnose_code_id = $request->diagnose_code_id[$i]['value'];

                $bill_dignosis = new BillDiagnosis();
                $bill_dignosis->bill_id = $bill_id;
                $bill_dignosis->diagnose_code_id = $diagnose_code_id;
                $bill_dignosis->save();
                $result = true;
            }
        }
        return $result;
    }

    public function storeBillProcedureCode($request, $bill_id)
    {
        $result = false;
        $countArr = count($request->procedure);
        for ($i = 0; $i < $countArr; $i++) {

            if (isset($request->procedure[$i]['key']) && $request->procedure[$i]['key']) { //update here
                $id = $request->procedure[$i]['key'];

                if (isset($request->procedure[$i]['code_id']) && isset($request->procedure[$i]['unit'])) {
                    $procedure_code_id = $request->procedure[$i]['code_id'];
                    $modifier_id = $request->procedure[$i]['modifier_id'];
                    $unit = $request->procedure[$i]['unit'];

                    $updateArr = array('procedure_code_id' => $procedure_code_id, 'modifier_id' => $modifier_id, 'unit' => $unit);
                    BillProcedureCode::where("id", $id)->update($updateArr);

                } else { //delete here
                    //$this->deleteRow(new BillProcedureCode(), $id);
                }
                $result = true;

            } else if (isset($request->procedure[$i]['code_id']) && isset($request->procedure[$i]['unit'])) { //add here
                $procedure_code_id = $request->procedure[$i]['code_id'];
                $modifier_id = $request->procedure[$i]['modifier_id'];
                $unit = $request->procedure[$i]['unit'];

                $bill_prc_code = new BillProcedureCode();
                $bill_prc_code->bill_id = $bill_id;
                $bill_prc_code->procedure_code_id = $procedure_code_id;
                $bill_prc_code->modifier_id = $modifier_id;
                $bill_prc_code->unit = $unit;
                $bill_prc_code->save();
                $result = true;
            }
        }
        return $result;
    }

    public function storeBillDocument($request, $document_name, $document_path, $id = false)
    {
        $result = false;
        if (!$id) {
            $bill_docs = new BillDocument();
            $bill_docs->bill_id = $request->bill_id;
            $bill_docs->report_type_id = $request->report_type_id;
            $bill_docs->document_name = $document_name;
            $bill_docs->document_path = $document_path;
            $bill_docs->save();
            $result = $bill_docs->id;
        } else {
            $updateArr = array('report_type_id' => $request->report_type_id, 'document_name' => $document_name, 'document_path' => $document_path);
            BillDocument::where("id", $id)->update($updateArr);
            $result = true;
        }
        return $result;
    }

    public function getBillInfo_with_patient_injury($bill_id)
    {
        return BillInfo::join('health_providers as h', 'h.id', '=', 'bill_infos.health_provider_id')
            ->join('service_codes as sc', 'sc.id', '=', 'bill_infos.service_code_id')
            ->join('patient_injuries as pi', 'pi.id', '=', 'bill_infos.injury_id')
            ->join('states as s', 's.id', '=', 'pi.injury_state_id')
            ->join('patients as p', 'p.id', '=', 'pi.patient_id')
            ->join('injury_claims as ic', 'ic.injury_id', '=', 'bill_infos.injury_id')
            ->leftjoin('claim_administrators as c', 'ic.claim_admin_id', '=', 'c.id')
            ->select('bill_infos.*', DB::raw("if(h.entity_type = 'Person', concat_ws(' ', h.first_name, h.last_name), h.entity_name) as render_provider_name, sc.place_of_service_name as place_of_service, sc.code as service_code, concat_ws(' ', p.first_name, p.last_name) as patient_name, pi.description as injury_name, s.state_name as injury_state, c.name as claim_admin"), 'p.dob', 'p.ssn_no', 'pi.patient_id', 'pi.financial_class', 'ic.claim_no', 'ic.start_date', 'ic.employer_name')
            ->where('bill_infos.id', $bill_id)->where('bill_infos.is_active', '1')->first();
    }

    public function getBillDiagnoses($bill_id)
    {
        return BillDiagnosis::join('diagnosis_codes as d', 'd.id', '=', 'bill_diagnoses.diagnose_code_id')
            ->select(Db::raw("GROUP_CONCAT(' ', d.diagnosis_name, '-', d.diagnosis_code) as diagnosis_name"))
            ->where('bill_diagnoses.bill_id', $bill_id)->where('bill_diagnoses.is_active', '1')->first();
    }

    public function getBillProvider($bill_id)
    {
        return BillInfoProvider::where('bill_info_providers.bill_id', $bill_id)->where('bill_info_providers.is_active', '1')->get();
    }

    public function getBillProcedure($bill_id)
    {
        return BillProcedureCode::join('procedure_codes as pc', 'bill_procedure_codes.procedure_code_id', '=', 'pc.id')
            ->Leftjoin('modifier_codes as m', 'bill_procedure_codes.modifier_id', '=', 'm.id')
            ->select('bill_procedure_codes.*', 'pc.procedure_code', 'pc.procedure_code_name', 'm.modifier_code', 'm.modifier_name')
            ->where('bill_procedure_codes.bill_id', $bill_id)->where('bill_procedure_codes.is_active', '1')->get();
    }

    public function getBillDocuments($bill_id)
    {
        return BillDocument::join('report_types as r', 'bill_documents.report_type_id', '=', 'r.id')
            ->select('bill_documents.*', 'r.report_code', 'r.report_name', DB::raw("date_format(bill_documents.created_at, '%d/%m/%Y' ) as uploaded_on"))
            ->where('bill_documents.bill_id', $bill_id)->where('bill_documents.is_active', '1')->get();
    }
    
    
    public function setSidebarPatient($pId){
        return Patient::with('getBillingProvider')->where('id', $pId)->first();
    }
    public function setSidebarInjury($injuryId){
        return Patient_injury::where('id', $injuryId)->first();
    }
    public function setSidebarInjuryBillsTotal($injuryBillId){
        return InjuryBill::where('id', $injuryBillId)->first();
    }
    public function setSidebarInjuryBillInfo($pId){

    }
    public function storeBillRenderingProvider($request, $id = false){
        // echo "<pre>";
        // print_r($request->all());exit;

        $fileTemp = $request->file('signature_img');
        // if($fileTemp->isValid()){
        // $fileExtension = $fileTemp->getClientOriginalExtension();
        // $fileName = Str::random(4). '.'. $fileExtension;
        // $path = $fileTemp->storeAs(
        // 'public/documents', $fileName
        // );
        $signature_path = null;
        if($request->file('signature_img')){
            $request->validate([
                'signature_img' => 'required|image|mimes:png|max:1024',
            ]);
            $signature_path = $request->file('signature_img')->store('public/signatures');
        }
        if(!$id){
            $billrefeningProvider = new BillReferingOrderProvider();
            $billrefeningProvider->referring_provider_npi = $request->rendering_provider_npi;
            if($request->person_type == 1){
                $billrefeningProvider->referring_provider_first_name = $request->fName;
                $billrefeningProvider->referring_provider_last_name = $request->lName;
                $billrefeningProvider->referring_provider_middle_name = $request->mName;
                $billrefeningProvider->referring_provider_suffix = $request->suffix;
            }
            else{
                $billrefeningProvider->entity_name = $request->entity_name;
            }

            $billrefeningProvider->referring_provider_state_id = $request->rendering_state_id;
            $billrefeningProvider->referring_provider_license_number = $request->license_no;
            $billrefeningProvider->billing_provider_id = $request->billingProviderId;
            $billrefeningProvider->taxonomy_code = $request->taxonomy_code;
            $billrefeningProvider->provider_type = $request->person_type;
            $billrefeningProvider->provider_name_type = $request->provider_name_type;

            $billrefeningProvider->referring_provider_image = $signature_path;
            $billrefeningProvider->type = $request->memberType;
            $billrefeningProvider->save();
        }
        else{
            $first_name = NULL;
            $last_name = NULL;
            $middle_name = NULL;
            $suffix = NULL;
            $entity_name = NULL;

            if($request->person_type == 1){
                $first_name = $request->fName;
                $last_name = $request->lName;
                $middle_name = $request->mName;
                $suffix = $request->suffix;
            }
            else{
                $entity_name = $request->entity_name;
            }
            $updateArr = array(
                'referring_provider_npi' => $request->rendering_provider_npi,
                'referring_provider_first_name' => $first_name,
                'referring_provider_last_name' => $last_name,
                'referring_provider_middle_name' => $middle_name,
                'referring_provider_suffix' => $suffix,
                'referring_provider_state_id' => $request->rendering_state_id,
                'referring_provider_license_number' => $request->license_no,
                'billing_provider_id' => $request->billingProviderId,
                //'referring_provider_npi' => $request->rendering_provider_npi,
                'taxonomy_code' => $request->taxonomy_code,
                'provider_type' => $request->person_type,
                'provider_name_type' => $request->provider_name_type,
                'entity_name' => $entity_name,
                'referring_provider_image' =>$signature_path,
                'type' => $request->memberType,
        );
        
            BillReferingOrderProvider::where("id", $id)->update($updateArr);
        }

    }
   
    public function storeBillPlaceOfService($request, $id = false){
        // echo "<pre>";
        // print_r($request->all());exit;
        if(!$request->placeOfServiceId){
            $billPlaceOfService = new MasterPlaceOfService();
            $billPlaceOfService->billing_provider_id = $request->billingProviderId;
            $billPlaceOfService->npi = $request->tax_id;
            $billPlaceOfService->location_name = $request->location_name;
            $billPlaceOfService->nick_name = $request->nick_name;
            $billPlaceOfService->city_id = $request->city_name;
            $billPlaceOfService->state_id = $request->state_id;
            $billPlaceOfService->zipcode = $request->zip_code;
            $billPlaceOfService->service_code_id = $request->place_of_service_code;
            $billPlaceOfService->address_line1 = $request->address_one;
            $billPlaceOfService->address_line2 = $request->address_two;
            $billPlaceOfService->save();

        }
        else{
            $updateArr = array(
             'billing_provider_id' => $request->billingProviderId,
            'npi' => $request->tax_id,
            'location_name' => $request->location_name,
            'nick_name' =>$request->nick_name,
           'city_id' => $request->city_name,
            'state_id' => $request->state_id,
            'zipcode' => $request->zip_code,
            'service_code_id' => $request->place_of_service_code,
            'address_line1' => $request->address_one,
            'address_line2' => $request->address_two,
            'is_active' => $request->place_status,
            );
            MasterPlaceOfService::where("id", $request->placeOfServiceId)->update($updateArr);
        }
    }
    public function storeBillReferringProvider($request, $id = false){
        // echo "<pre>";
        // print_r($request->all());exit;
        if(!$id){
            $billrefeningProvider = new BillReferingOrderProvider();

            $billrefeningProvider->referring_provider_npi = $request->rendering_provider_npi;
            $billrefeningProvider->billing_provider_id = $request->billingProviderId;
            $billrefeningProvider->type = ($request->pType) ? $request->pType : 1;
            $billrefeningProvider->referring_provider_first_name = $request->fName;
            $billrefeningProvider->referring_provider_last_name = $request->lName;
            $billrefeningProvider->referring_provider_middle_name = $request->mName;
            $billrefeningProvider->referring_provider_suffix = $request->suffix;
            $billrefeningProvider->referring_provider_license_number = $request->license_no;
            $billrefeningProvider->	taxonomy_code = $request->taxonomy_code;
            $billrefeningProvider->save();
        }
        else{
            
            $updateArr = array(
                'referring_provider_npi' => $request->rendering_provider_npi,
                'type' => ($request->pType) ? $request->pType : 1,
                'referring_provider_first_name' => $request->fName,
                'referring_provider_last_name' => $request->lName,
                'referring_provider_middle_name' => $request->mName,
                'referring_provider_suffix' => $request->suffix,
                'referring_provider_license_number' => $request->license_no,
                'taxonomy_code' => $request->taxonomy_code,
                'billing_provider_id' => $request->billingProviderId
        );
        BillReferingOrderProvider::where("id", $id)->update($updateArr);
        }
    }
    public function storeRequestingPhysician($request, $id = false){
        // echo "<pre>";
        // print_r($request->all());exit;
        $fileTemp = $request->file('physican_signature');
        $signature_path = null;
        if($request->file('physican_signature')){
            $request->validate([
                'physican_signature' => 'required|image|mimes:jpeg,jpg,png|max:1024',
            ]);
            $signature_path = $request->file('physican_signature')->store('public/signatures');
        }

        if(!$request->physicianId){
            $billrefeningProvider = new RequestingPhysician();
            $billrefeningProvider->billing_provider_id = $request->billingProviderId;
            $billrefeningProvider->npi = $request->rendering_provider_npi;
            $billrefeningProvider->first_name = $request->first_name;
            $billrefeningProvider->last_name = $request->last_name;
            $billrefeningProvider->middle_name = $request->middle_name;
            $billrefeningProvider->suffix_name = $request->suffix;
            $billrefeningProvider->specility_id = $request->specilityId;
            $billrefeningProvider->telephone = $request->telephone_no;
            if($request->dataUrlVal != ''){
                $billrefeningProvider->physican_signature_canvas = $request->dataUrlVal; 
            }
            $billrefeningProvider->physican_signature = $signature_path;
            $billrefeningProvider->save();
        }
        else{
            $canvasVal = null;
            if($request->dataUrlVal != ''){
                $canvasVal = $request->dataUrlVal; 
            }
            $updateArr = array(
                'billing_provider_id' => $request->billingProviderId,
                'npi' => $request->rendering_provider_npi,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'suffix_name' => $request->suffix,
                'specility_id' => $request->specilityId,
                'telephone' => $request->telephone_no,
                'physican_signature' => $signature_path,
                'physican_signature_canvas' => $canvasVal 
        );
        RequestingPhysician::where("id", $request->physicianId)->update($updateArr);
        }
    }
    public function savePracticeLocation($request, $id = false){
        // echo "<pre>";
        // print_r($request->all());exit;
        if(!$id){
            $practiceLocation = new PractceLocation();

            $practiceLocation->billing_provider_id = $request->billingProviderId;
            $practiceLocation->practice_name = $request->practice_name;
            $practiceLocation->practice_nick_name = $request->nick_name;
            $practiceLocation->address1 = $request->address1;
            $practiceLocation->address2 = $request->address2;
            $practiceLocation->city_id = $request->city_id;
            $practiceLocation->state_id = $request->state_id;
            $practiceLocation->zip_code = $request->zipCode;
            $practiceLocation->telephone_no = $request->telephone_num;
            $practiceLocation->save();
        }
        else{
            
            $updateArr = array(
                'billing_provider_id' => $request->billingProviderId,
                'telephone_no' => $request->telephone_num,
                'zip_code' => $request->zipCode,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'address2' => $request->address2,
                'address1' => $request->address1,
                'practice_nick_name' => $request->nick_name,
                'practice_name' => $request->practice_name
        );
        PractceLocation::where("id", $id)->update($updateArr);
        }
    }
    
    public function storePracticeContact($request, $id = false){
        // echo "<pre>";
        // print_r($request->all());exit;

        if(!$request->id)
        {
            PracticeContact::create($request->all());
        }
        
        else{
            $updateArr = array(
                 //'npi' => $request->rendering_provider_npi,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'suffix_name' => $request->suffix_name,
                //'specility_id' => $request->specilityId,
                'telephone' => $request->telephone, 
        );
        PracticeContact::where("id", $request->id)->update($updateArr);
        }
    }
    public function filter_array($array,$term){
        $matches = array();
        foreach($array as $a){
            if($a['state_name'] == $term)
                $matches[]=$a;
        }
        return $matches;
    }  
      
    
    
    public function saveBillingProviderCharge($request, $id = false){
        // echo "<pre>";
        // print_r($request->all());
        $checkMasterCharge = MasterProviderCharge::where('provider_id',$request->billingProviderId)->first();
        $requestArray = []; $stateName =null;
        if($request->stateId){
            if (strpos($request->stateId, ',') !== false) {
                $stateName  = implode(',',$request->stateId);
            }else{
                $stateName  = $request->stateId;
            }
        }
        $requestArray = array(
            'provider_id' => $request->billingProviderId,
            'type' => 1,
            'state_id' => $stateName,
            'physician_services' => $request->physician_service,
            'med_legal' => $request->med_legal,
            'dmepos' => $request->dmepos,
            'dispensed_pharmaceuticals' => $request->dispensed_pharmaceuticals,
            'copy_service' => $request->copy_service,
            'pathology_charge' => $request->pathology,
        );
        // echo "<pre>";
        // print_r($requestArray);exit;

        if($checkMasterCharge){
            MasterProviderCharge::where('provider_id',$request->billingProviderId)->update($requestArray);
        }
        else{
            MasterProviderCharge::insert($requestArray);
        }
    }
    function addPracticeChargeProcedureCode($request){
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        if(isset($request->chargeId) && $request->chargeId != null){
            $checkPracticeName = BillingProviderCharge::where('id', $request->chargeId)->first();
            if($checkPracticeName){
                $checkPracticeName->charge_id           = $request->practiceChargeId;
                $checkPracticeName->practice_name       = $request->practice_charge_name;
                $checkPracticeName->states_code         = (is_array($request->states_code)) ? implode(',',$request->states_code) : $request->states_code;
                $checkPracticeName->effective_dos       = $request->effective_dos;
                $checkPracticeName->expiration_dos      = $request->expiration_dos;
                $checkPracticeName->created_by          = Auth::user()->id;
                $checkPracticeName->status              = $request->p_charge_status;
                $checkPracticeName->ctype               = $request->ctype;
                $checkPracticeName->update();
                if($checkPracticeName->id){
                    if(isset($request->procedure_code)){
                        for ( $i=0; $i < count($request->procedure_code); $i++) {
                            $checkModify = BillingProviderChargeProcedureCode::where('billing_provider_charge_id', $checkPracticeName->id)->
                            where('procedure_code', $request->procedure_code[$i])->first();
                            if($checkModify){
                             $checkModify->procedure_code             =   $request->procedure_code[$i];
                             $checkModify->modifiers                  =   $request->bill_modifiers[$i];
                             $checkModify->units                      =   $request->bill_units[$i];
                             $checkModify->status                     =   1;
                             $checkModify->ndc_number                 =   $request->ndc_number[$i];
                             $checkModify->update();
                             }
                             else{
                                 $chargeCode = new BillingProviderChargeProcedureCode();
                                 $chargeCode->billing_provider_charge_id =   $checkPracticeName->id;
                                 $chargeCode->procedure_code             =   $request->procedure_code[$i];
                                 $chargeCode->modifiers                  =   $request->bill_modifiers[$i];
                                 $chargeCode->units                      =   $request->bill_units[$i];
                                 $chargeCode->status                     =   1;
                                 $chargeCode->ndc_number                 =   $request->ndc_number[$i];
                                 $chargeCode->save();
                             }
                        }
                    } 
                }
            }
        } 
        else{
            $billingPracticeCharge =  new BillingProviderCharge();
            $billingPracticeCharge->provider_id         = $request->billingProviderId;
            $billingPracticeCharge->charge_id           = $request->practiceChargeId;
            $billingPracticeCharge->ctype               = $request->ctype;
            $billingPracticeCharge->practice_name       = $request->practice_charge_name;
            $billingPracticeCharge->states_code         = (is_array($request->states_code)) ? implode(',',$request->states_code) : $request->states_code;
            $billingPracticeCharge->effective_dos       = $request->effective_dos;
            $billingPracticeCharge->expiration_dos      = $request->expiration_dos;
            $billingPracticeCharge->created_by          = Auth::user()->id;
            $billingPracticeCharge->status          = 1;
            $billingPracticeCharge->save();
            if($billingPracticeCharge->id){
                if(isset($request->procedure_code)){
                    for ( $i=0; $i < count($request->procedure_code); $i++) {
                        $checkModify = BillingProviderChargeProcedureCode::where('billing_provider_charge_id', $billingPracticeCharge->id)->
                        where('procedure_code', $request->procedure_code[$i])->first();
                        if($checkModify){
                         $checkModify->procedure_code             =   $request->procedure_code[$i];
                         $checkModify->modifiers                  =   $request->bill_modifiers[$i];
                         $checkModify->units                      =   $request->bill_units[$i];
                         $checkModify->status                     =   1;
                         $checkModify->update();
                         }
                         else{
                             $chargeCode = new BillingProviderChargeProcedureCode();
                             $chargeCode->billing_provider_charge_id =   $billingPracticeCharge->id;
                             $chargeCode->procedure_code             =   $request->procedure_code[$i];
                             $chargeCode->modifiers                  =   $request->bill_modifiers[$i];
                             $chargeCode->units                      =   $request->bill_units[$i];
                             $chargeCode->status                     =   1;
                             $chargeCode->save();
                         }
                    }   
                }
            }
        }
    }
   
    public function getBillFormStatusId($bill)
    {
        $formStatus = config('global.formStatus');
        $form_status = $formStatus['complete']; $status_alias = '';
        $status_alias = '';
        if (!$bill->bill_dos && $bill->bill_place_of_service && !$bill->bill_place_of_service && !$bill->bill_provider_name 
        && !$bill->bill_provider_name && !$bill->work_dg_code_id && !$bill->bill_procedure_code && !$bill->bill_units) {
            $form_status = $formStatus['incomplete'];
        } 
        if ($form_status != $formStatus['complete']) {
            $status_alias = 'Failed Review';
        }
        return array($this->getStatusId($form_status), $status_alias);
    }
    public function checkSomeConditions(){
        $res = $this->getPatientFormStatusId($injuryBillInfo->getInjury->patient);
        if($res){
            $this->storeJobAssign('patient', $patient_id, $res[0], $res[1]);
        }
        if($injuryBillInfo->getInjury){
            $res = $this->getInjuryFormStatusId($injury_claim, $injuryBillInfo->getInjury->financial_class);
            if($res){
                $this->storeJobAssign('injury', $injury_claim_id, $res[0], $res[1]);
            }
        }
        if($injuryBillInfo){
            $res = $this->getBillFormStatusId($injuryBillInfo);
            if($res){
                $this->storeJobAssign('bill', $injury_claim_id, $res[0], $res[1]);
            }
        }
    }
    public function inserUpdateTask($request, $statusForBill)
    {
        $job_type = null;
        $job_type = ($statusForBill) ? ($statusForBill['slug'] == 'PATIENT_FAILED_REVIEW') ? 'patient'  : (($statusForBill['slug'] == 'INJURY_FAILED_REVIEW') ? 'injury' : 'bill') : null;
        $this->storeJobAssign($job_type,$statusForBill);
    }
    public function removeTaskForBill($request, $statusForBill)
    {
        $this->removeJobAssign($request,$statusForBill);
    }
  
   
    // public function  getTotalCharges($billingProviderId, $totalQty, $billServices){
    //     $totalCharegs = 0;
    //     if($billServices){
    //         foreach($billServices as $service){
    //             $checkProviderCharge = BillingProviderCharge::where('provider_id', $billingProviderId)->first();
    //             if($checkProviderCharge){
    //                 $checkModify = BillingProviderChargeProcedureCode::where('billing_provider_charge_id',$checkProviderCharge->id)
    //                 ->where('procedure_code', $service->bill_procedure_code)->first();
    //                 //->orWhere('modifiers',$service->bill_modifiers)->first();
    //                 if($checkModify){
    //                     $totalCharegs =  ($totalQty > 0) ? ($totalQty  * $checkModify->units) : 'NA'; 
    //                 }
    //             }
    //         }
    //         return $totalCharegs;
    //     }
    // }
    // public function getMasterCpdCharge($billingProviderId, $service, $isModifyer){
    //     $checkProviderCharge = BillingProviderCharge::where('provider_id', $billingProviderId)->first();
    //     if($checkProviderCharge){
    //         $checkModify = BillingProviderChargeProcedureCode::where('billing_provider_charge_id',$checkProviderCharge->id)
    //         ->where('procedure_code', $service->bill_procedure_code);
    //         if($isModifyer != null){
    //             $checkModify = $checkModify->where('modifiers',$service->bill_modifiers);
    //         }
    //         $checkModify = $checkModify->first();
    //         if($checkModify){
    //             $checkModify['cpdCharge'] = ($checkModify->units) ? $checkModify->units : null;
    //             $checkModify['totCpdCharge'] =  ($service->bill_units > 0) ? ($service->bill_units  * $checkModify->units) : null; 
    //         }
    //         return $checkModify;
    //     }
    // }
    
   
    // public function getBillServicesInfoByBillId($bill){
    //     $billServices = [];
    //     $billingProviderId = 0;
    //     if($bill){
    //         $billingProviderId = ($bill->getInjury->patient && $bill->getInjury->patient->billing_provider_id) ? $bill->getInjury->patient->billing_provider_id : null;
    //         if($bill->getBillServices){
    //             $bill['totalQty']  = ($this->getTotalUnits($bill->getBillServices) > 0 ) ? $this->getTotalUnits($bill->getBillServices) : 0; 
    //             $bill['totalCharge'] = ($bill['totalQty'] > 0) ? $this->getTotalCharges($billingProviderId, $bill['totalQty'],$bill->getBillServices) : 0;
    //             foreach($bill->getBillServices as $service){
    //               $masterChargeInfo =   $this->getMasterCpdCharge($billingProviderId, $service, ($service->bill_modifiers) ? $service->bill_modifiers : null);
    //               if($masterChargeInfo){
    //                 $service['billNumber']          =  'Bill00'.$bill->id;
    //                 $service['billId']              =   $bill->id;
    //                 $service['billId']              =   $bill->id;
    //                 $service['dos']                 =  date('Y-m-d',strtotime($bill->dos));
    //                 $service['renderinProvider']    =  ($bill->getRenderinProvider) ? $bill->getRenderinProvider->name : 'NA';
    //                 $service['cpdCharge']           = ($masterChargeInfo['cpdCharge']) ? $masterChargeInfo['cpdCharge'] : null;
    //                 $service['totCpdCharge']        = ($masterChargeInfo['totCpdCharge']) ? $masterChargeInfo['totCpdCharge'] : null;
    //                 $billServices[]                 = $service; 
    //               }
                 
    //             }
    //         }
    //     }  
    //     return array('bills'=>$bills, 'services'=>$billServices);
    // }
  
    function addProcedureCode($request){
        if($request->practiceProcedureCodeId){
        $checkModify = BillingProviderChargeProcedureCode::where('id', $request->practiceProcedureCodeId)->first();
        if($checkModify){
            $checkModify->units                      =   $request->bill_units;
            $checkModify->status                      =  $request->charge_status;
            $checkModify->update();
            } 
        }
        else{
            for ( $i=0; $i < count($request->procedure_code); $i++) { 
                $chargeCode = new BillingProviderChargeProcedureCode();
                $chargeCode->billing_provider_charge_id =   $request->practiceChargeId;
                $chargeCode->procedure_code             =   $request->procedure_code[$i];
                $chargeCode->modifiers                  =   $request->bill_modifiers[$i];
                $chargeCode->units                      =   $request->bill_units[$i];
                $chargeCode->status                     =   1;
                $chargeCode->save();
            }
        }
    }
    public function storeInjuryBillInfo($request, $id = false)
    {
        //InjuryBill,
        //InjuryBillService
        // echo "<pre>";
        // print_r($request->all());exit;

        $dosYear = null; $billAdmissionYear = null;  $dosEnd = null;
        if(isset($request->work_dg_code_id)){
            $diagnosisCode = implode(',', $request->work_dg_code_id);
        }
        else
        {
            $diagnosisCode = null;
        }
        
        $bill_dos = '0000-00-00'; $bill_adminssion_date = null; $dos_end = null;
        if(isset($request->bill_dos)){
            $reqDob =  $request->bill_dos;
            $exDate = explode('/', $reqDob);
            if(count($exDate) > 0){
                $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
                $bill_dos =  date('Y-m-d',strtotime($newBreakDate));
                $dosYear = $exDate[2];
            }
        };
        
        if(isset($request->bill_adminssion_date)){
            $reqDob =  $request->bill_adminssion_date;
            $exDate = explode('/', $reqDob);
            $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
            $bill_adminssion_date =  date('Y-m-d',strtotime($newBreakDate));
            $billAdmissionYear = $exDate[2];
        }
        if(isset($request->dos_end)){
            $reqDob =  $request->dos_end;
            $exDate = explode('/', $reqDob);
            $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
            $dos_end =  date('Y-m-d',strtotime($newBreakDate));
            $dosEnd = $exDate[2];
        }

        if(isset($request->billId)){
            $injuryBillInfo = InjuryBill::where('id', $request->billId)->first();
            $injuryBillInfo->dos = $bill_dos;
            $injuryBillInfo->bill_practice_bill_id = $request->bill_practice_bill_id;
            $injuryBillInfo->bill_place_of_service = $request->bill_place_of_service;
            $injuryBillInfo->bill_authorization_number = $request->bill_authorization_number;
            $injuryBillInfo->bill_rendering_provider = $request->bill_rendering_provider;
            $injuryBillInfo->bill_practice_bill_id = $request->bill_practice_bill_id;
            $injuryBillInfo->bill_adminssion_date = $bill_adminssion_date;
            $injuryBillInfo->bill_provider_type =  ($request->bill_provider_type) ? implode(',', array_filter($request->bill_provider_type)) : null;
            $injuryBillInfo->bill_additiona_information_box = $request->bill_additiona_information_box;
            $injuryBillInfo->diagnosis_code_type = $request->diagnosis_code_type;
            $injuryBillInfo->work_dg_code_id = $diagnosisCode;
            $injuryBillInfo->dos_end = $dos_end;
            $injuryBillInfo->bill_provider_name = ($request->bill_provider_name) ? implode(',', array_filter($request->bill_provider_name)) : null; 
            $injuryBillInfo->template_id = $request->bill_template;

            $injuryBillInfo->update();
            $this->storeInjuryBillServices($request, $injuryBillInfo->id, null,$dosYear); 
            $this->addGlobalAllLog('INCOMPLETE','App\InjuryBill',"BILL_UPDATED", $injuryBillInfo->id);
            $this->checkInsertUpdateTask($request, $injuryBillInfo->patient_id);
            $injuryBillInfo->id;
        }
        else{
            $bill_info = new InjuryBill();
            $bill_info->injury_id = $request->injuryId;
            $bill_info->patient_id = $request->patientId;
            $bill_info->dos = $bill_dos;
            $bill_info->bill_practice_bill_id = $request->bill_practice_bill_id;
            $bill_info->bill_place_of_service = $request->bill_place_of_service;
            $bill_info->bill_authorization_number = $request->bill_authorization_number;
            $bill_info->bill_rendering_provider = $request->bill_rendering_provider;
            $bill_info->bill_practice_bill_id = $request->bill_practice_bill_id;
            $bill_info->bill_adminssion_date = $bill_adminssion_date;
            $bill_info->bill_provider_type =  ($request->bill_provider_type) ? implode(',', array_filter($request->bill_provider_type)) : null;
            $bill_info->bill_additiona_information_box = $request->bill_additiona_information_box;
            $bill_info->diagnosis_code_type = $request->diagnosis_code_type;
            $bill_info->work_dg_code_id = $diagnosisCode;
            $bill_info->dos_end = $dos_end;
            $bill_info->bill_provider_name = ($request->bill_provider_name) ? implode(',', array_filter($request->bill_provider_name)) : null; 
            $bill_info->template_id = $request->bill_template;
            $bill_info->save();
            $this->storeInjuryBillServices($request, $bill_info->id, null,$dosYear);
            $this->addGlobalAllLog('INCOMPLETE','App\InjuryBill',"BILL_CREATED", $bill_info->id);
            $this->checkInsertUpdateTask($request, $request->patientId);
            $bill_info->id;
        }
        }
    public function storeInjuryBillServices($request, $bId = false, $id = false, $dosYear)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $masterColumnName =  ($dosYear) ? 'procedure_year_'.$dosYear : null;
       // echo $masterColumnName."===";exit;
            if(count($request->bill_procedure_code) > 0){
                $billServicesInfo = InjuryBillService::where('bill_id', $bId)->get();
                if ($billServicesInfo->isNotEmpty()) {
                    $checkForDelete =  InjuryBillService::where('bill_id', $bId)->delete();
                    if($checkForDelete){
                        $this->addCPDCodesForBill($request, $bId);
                    }
                }
                else{
                     $this->addCPDCodesForBill($request, $bId);
                }
            }
        if(isset($request->work_dg_code_id) && count($request->work_dg_code_id) > 0){
            $billDignos = BillDiagnosis::where('bill_id', $bId)->get();
            if ($billDignos) {
               BillDiagnosis::where('bill_id', $bId)->delete();
            }
            for ( $j=0; $j < count($request->work_dg_code_id); $j++) {
                $billDiagnos = new BillDiagnosis();
                $billDiagnos->bill_id = $bId;
                $billDiagnos->diagnose_code_id = $request->work_dg_code_id[$j];
                $billDiagnos->is_active = 1;
                $billDiagnos->save();
            }
        }
    }

    public function addCPDCodesForBill($request, $bId){
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        if(isset($request->bill_procedure_code)){
            for ( $i=0; $i < count($request->bill_procedure_code); $i++) {
                if($request->bill_procedure_code[$i] != null){
                    $masterBillChargeId = null;  $taskId = null; $providerChargeId = null; $chargeVal = null; $expectedFeeSchedule = null; $calculatedBrReduction = null;
                    $bServices = new InjuryBillService();
                    $bServices->bill_id = $bId;
                    $bServices->bill_procedure_code                     = $request->bill_procedure_code[$i];
                    $bServices->bill_modifiers                          = $request->bill_modifiers[$i];
                    $bServices->bill_units                              = $request->bill_units[$i];
                    $bServices->bill_diag_codes1                        = $request->bill_diag_codes1[$i];
                    $bServices->bill_diag_codes2                        = $request->bill_diag_codes2[$i];
                    $bServices->bill_diag_codes3                        = $request->bill_diag_codes3[$i];
                    $bServices->bill_diag_code4                         = $request->bill_diag_codes4[$i];
                    $bServices->additional_information                  = $request->additional_information[$i];
                    $bServices->master_unit_amount                      = $request->master_charge[$i];
                    $bServices->master_procedure_code_charge_id         = $request->master_charge_id[$i];
                    $bServices->total_bill_amount                       = ($request->bill_units[$i] * $request->master_charge[$i]);
                    $bServices->is_master_found                         = $request->isMasterChargeFound[$i];
                    $bServices->save();

                    // $checkModify = BillingProviderChargeProcedureCode::where('procedure_code', $request->bill_procedure_code[$i])->orWhere('modifiers',$request->bill_modifiers[$i])->first();
                    // if($checkModify){
                    //     $bServices = new InjuryBillService();
                    //     $bServices->bill_id = $bId;
                    //     $bServices->bill_procedure_code     = $request->bill_procedure_code[$i];
                    //     $bServices->bill_modifiers          = $request->bill_modifiers[$i];
                    //     $bServices->bill_units              = $request->bill_units[$i];
                    //     $bServices->bill_diag_codes1        = $request->bill_diag_codes1[$i];
                    //     $bServices->bill_diag_codes2        = $request->bill_diag_codes2[$i];
                    //     $bServices->bill_diag_codes3        = $request->bill_diag_codes3[$i];
                    //     $bServices->bill_diag_code4         = $request->bill_diag_codes4[$i];
                    //     //$bServices->master_bill_charge_id   = $checkModify->billing_provider_charge_id;
                    //     $bServices->save();
                    // }
                    // else{
                    //     $this->addGlobalAllLog('BILL_FAILED_REVIEW','App\InjuryBillService','Bill Failed Review', $bId);
                    // }
                }
            }
        }
    }
    public function  getTotalUnits($billServices){
        $totalServiceUnit = 0; $totAmt = 0; $chargeAmt = 0;
        foreach($billServices as $service){
            if(is_numeric($service->bill_units)) {
                $totalServiceUnit += $service->bill_units;
            }
            if(is_numeric($service->bill_units)  && is_numeric($service->master_unit_amount)) {
                $totAmt += $service->bill_units * $service->master_unit_amount;
            }
        }
        return array('totalUnit'=>$totalServiceUnit, 'totAmt'=>$totAmt);
    }
    public function getBillListByInjuryId($injuryId, $patientId){
        $billServices = []; $billsInfo = [];
        $bills =  InjuryBill::with('getBillServices','getRenderinPlaceServices','getRenderinProvider')->where('injury_id',  $injuryId)->where('patient_id',  $patientId)->get();
        foreach($bills as $bill){
            $billingProviderId = 0;
            $billingProviderId = ($bill->getInjury->patient && $bill->getInjury->patient->billing_provider_id) ? $bill->getInjury->patient->billing_provider_id : null;
            if($bill->getBillServices){
                $totaUnitInfo = [];
                $totaUnitInfo = $this->getTotalUnits($bill->getBillServices);
                $bill['totalQty']  = $totaUnitInfo['totalUnit'];
                $bill['totalCharge'] = $totaUnitInfo['totAmt'];
                foreach($bill->getBillServices as $service){
                    $service['billNumber']          =  'Bill00'.$bill->id;
                    $service['billId']              =   $bill->id;
                    $service['dos']                 =  date('Y-m-d',strtotime($bill->dos));
                    $service['renderinProvider']    =  ($bill->getRenderinProvider) ? $bill->getRenderinProvider->name : 'NA';
                    $service['master_unit_amount']  = $service['master_unit_amount'];
                    $service['total_bill_amount']   = $service['total_bill_amount'];
                    $billServices[]                 = $service; 
                }
            }
            $billsInfo[] = $bill; 
        }
        return array('bills'=>$billsInfo, 'services'=>$billServices);
    }
    public function storeBillInfo($request, $id = false)
    {
        try {
             DB::beginTransaction();
            if (!$id) { 
                //Add here
                $bill_info = new BillInfo();
                $bill_info->injury_id = $request->injury_id;
                $bill_info->service_code_id = $request->service_code_id;
                $bill_info->health_provider_id = $request->health_provider_id;
                $bill_info->authorization_no = $request->authorization_no;
                $bill_info->practice_bill_id = $request->practice_bill_id;
                $bill_info->start_dos = $request->start_dos;
                $bill_info->admission_date = $request->admission_date;
                $bill_info->end_dos = $request->end_dos;
                $bill_info->description = $request->description;
                $bill_info->diagnosis_code_type = $request->diagnosis_code_type;
                // $bill_info->write_off_amt = $request->write_off_amt;
                // $bill_info->write_off_reason = $request->write_off_reason;
                $bill_info->save();
                return $bill_info->id;
            } else { 
                //Update here
                $updateArr = array(
                    'service_code_id' => $request->service_code_id,
                    'health_provider_id' => $request->health_provider_id,
                    'authorization_no' => $request->authorization_no,
                    'practice_bill_id' => $request->practice_bill_id,
                    'start_dos' => $request->start_dos,
                    'admission_date' => $request->admission_date,
                    'end_dos' => $request->end_dos,
                    'description' => $request->description,
                    'diagnosis_code_type' => $request->diagnosis_code_type,
                );
                return BillInfo::where("id", $id)->update($updateArr);
            }
            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            $message = $e->getMessage();
            $toastr_title = trans('messages.toastr_error');
            Toastr::error($message, '', ["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
     public function storeBillProviderProvider($request, $masterReasons){
        // echo "<pre>";
        // print_r($request->all());exit;
        ini_set('max_input_vars', 3000);
       // echo "<>".$id;exit;
       
       $id =  ($request->providerId != '') ? $request->providerId : null;
       
        $personalFIle = null; $signature = null; $pharmacyFile = null; $institutionFIle = null; $institutionFile2= null;
        if($request['professional_file']){
            $personalFIle = null;
        }

        if($request['pharmacy_signature']){
            $signature = null;
        }

        if($request['pharmacy_billing_file']){
            $pharmacyFile = null;
        }
        if($request['institution_file']){
            $institutionFIle = null;
        }
        if($request['institution_file2']){
            $institutionFile2 = null;
        }

            if($id == null){
                $checkProvider = BillingProvider::where('is_active',1);
                if($request->bill_type == 'Professional'){
                    if($request->provider_type == 'Organization'){
                        $isFoundProvider = $checkProvider->where('professional_provider_name',$request->professional_provider_name);
                    }else{
                        $isFoundProvider = $checkProvider->where('billProvider_namebox_33_first_name',$request->billProvider_namebox_33_first_name);
                        $isFoundProvider = $checkProvider->where('billProvider_namebox_33_last_name',$request->billProvider_namebox_33_last_name);
                    }
                }
                if($request->bill_type == 'Pharmacy'){
                    $isFoundProvider = $checkProvider->where('professional_provider_name',$request->pharmacy_billing_provider_name);

                }
                if($request->bill_type == 'Institutional'){
                    $isFoundProvider = $checkProvider->where('professional_provider_name',$request->institution_provider_name);

                }
                $isFoundProvider = $checkProvider->first();
                //dd($isFoundProvider);
                if($isFoundProvider){
                    return 0;
                }
                else{
                        $billrefeningProvider = new BillingProvider();
                        $users = null;
                        $billrefeningProvider->injury_state_id = $request->injury_state_id;
                        $billrefeningProvider->bill_type = $request->bill_type;
                        if($request->professional_user_with_access != null){
                            $users = implode(',',$request->professional_user_with_access);
                        }
                        if($request->bill_type == 'Professional'){
                            $billrefeningProvider->provider_type = $request->provider_type;
                            if($request->provider_type == 'Organization'){
                                $billrefeningProvider->tax_id = $request->professional_tax_id;
                                $billrefeningProvider->professional_provider_name = $request->professional_provider_name;
                                $billrefeningProvider->professional_nick_name = $request->professional_nick_name;
                                $billrefeningProvider->professional_telephone = $request->professional_telephone;
                                $billrefeningProvider->professional_addres1 = $request->professional_addres1;
                                $billrefeningProvider->professional_addres2 = $request->professional_addres2;
                                $billrefeningProvider->professional_city = $request->professional_city;
                                $billrefeningProvider->professional_state = $request->professional_state;
                                $billrefeningProvider->professional_zip = $request->professional_zip;
                                $billrefeningProvider->professional_npi = $request->professional_npi;
                                $billrefeningProvider->professional_address1 = $request->professional_address1;
                                $billrefeningProvider->professional_address2 = $request->professional_address2;
                                $billrefeningProvider->professional_city1 = $request->professional_city1;
                                $billrefeningProvider->professional_state1 = $request->professional_state1;
                                $billrefeningProvider->professional_zipcode1 = $request->professional_zipcode1;
        
                            }
                            else{
                                $billrefeningProvider->tax_id = $request->billProvider_box_25_tax_id; 
                                $billrefeningProvider->billProvider_namebox_33_first_name = $request->billProvider_namebox_33_first_name;
                                $billrefeningProvider->billProvider_namebox_33_last_name = $request->billProvider_namebox_33_last_name; 
                                $billrefeningProvider->billProvider_namebox_33_mi = $request->billProvider_namebox_33_mi;
                                $billrefeningProvider->billProvider_namebox_33_suffix = $request->billProvider_namebox_33_suffix;
                                $billrefeningProvider->billProvider_namebox_33_telephone = $request->billProvider_namebox_33_telephone;
                                $billrefeningProvider->billProvider_namebox_33_address1 = $request->billProvider_namebox_33_address1;
                                $billrefeningProvider->billProvider_namebox_33_address2 = $request->billProvider_namebox_33_address2; 
                                $billrefeningProvider->billProvider_namebox_33_city = $request->billProvider_namebox_33_city;
                                $billrefeningProvider->billProvider_namebox_33_state = $request->billProvider_namebox_33_state;
                                $billrefeningProvider->billProvider_namebox_33_zipCode = $request->billProvider_namebox_33_zipCode; 
                                $billrefeningProvider->billProvider_namebox_33_npi = $request->billProvider_namebox_33_npi;
                                $billrefeningProvider->professional_address1 = $request->billProvider_namebox_33_a_address1;
                                $billrefeningProvider->professional_address2 = $request->billProvider_namebox_33_a_address2;
                                $billrefeningProvider->professional_city1 = $request->billProvider_namebox_33_a_city;
                                $billrefeningProvider->professional_state1 = $request->professional_state1;
                                $billrefeningProvider->professional_zipcode1 = $request->billProvider_namebox_33_a_zipcode;
                            }
                            
                            $billrefeningProvider->dol_provider_name = $request->dol_provider_name;
                            $billrefeningProvider->professional_file = $personalFIle;
                            $billrefeningProvider->professional_user_with_access = $users;
                            $billrefeningProvider->professional_fax_number = $request->professional_fax_number;
        
                        }
                        if($request->bill_type == 'Pharmacy'){
                            $billrefeningProvider->pharmacy_tax_id = $request->pharmacy_tax_id;
                            $billrefeningProvider->tax_id = $request->pharmacy_tax_id;
                            $billrefeningProvider->professional_provider_name = $request->pharmacy_billing_provider_name;
                            $billrefeningProvider->professional_nick_name = $request->pharmacy_billing_nick_name;
                            $billrefeningProvider->professional_addres1 = $request->pharmacy_address1;
                            $billrefeningProvider->professional_addres2 = $request->pharmacy_address2;
                            $billrefeningProvider->professional_city = $request->pharmacy_city;
                            $billrefeningProvider->professional_state = $request->pharmacy_state;
                            $billrefeningProvider->professional_zip = $request->pharmacy_zipcode;
                            $billrefeningProvider->professional_telephone = $request->pharmacy_telephone;
                            $billrefeningProvider->professional_file = $signature;
                            $billrefeningProvider->pharmacy_npi = $request->pharmacy_npi;
                            $billrefeningProvider->professional_address1 =  $request->pharmacy_billing_address1;
                            $billrefeningProvider->professional_address2 = $request->pharmacy_billing_address2;
                            $billrefeningProvider->professional_city1 = $request->pharmacy_billing_city;
                            $billrefeningProvider->professional_state1 = $request->pharmacy_billing_state;
                            $billrefeningProvider->professional_zipcode1 = $request->pharmacy_billing_zipcode;
                            $billrefeningProvider->pharmacy_billing_file = $pharmacyFile;
                            $billrefeningProvider->professional_user_with_access = $users;
                            $billrefeningProvider->professional_fax_number = $request->pharmacy_billing_fax_number;
                        }
                        if($request->bill_type == 'Institutional'){
                            $billrefeningProvider->tax_id = $request->institution_tax_id;
                            $billrefeningProvider->professional_provider_name = $request->institution_provider_name;
                            $billrefeningProvider->professional_nick_name = $request->institution_nick_name;
                            $billrefeningProvider->professional_telephone = $request->institution_telephone;
                            $billrefeningProvider->professional_addres1 = $request->institution_address1;
                            $billrefeningProvider->professional_addres2 = $request->institution_address2;
                            $billrefeningProvider->professional_city = $request->institution_city;
                            $billrefeningProvider->professional_state = $request->institution_state;
                            $billrefeningProvider->professional_zip = $request->institution_zipCode;
                            $billrefeningProvider->professional_address1 =  $request->institution_address11;
                            $billrefeningProvider->professional_address2 = $request->institution_address22;
                            $billrefeningProvider->professional_city1 = $request->institution_city1;
                            $billrefeningProvider->professional_state1 = $request->institution_state1;
                            $billrefeningProvider->professional_zipcode1 = $request->institution_zipCode1;
                            $billrefeningProvider->professional_file = $institutionFIle;
                            $billrefeningProvider->pharmacy_npi = $request->institution_npi;
                            $billrefeningProvider->institution_taxonomy = $request->institution_taxonomy;
                            $billrefeningProvider->institution_county_name = $request->institution_county_name;
                            $billrefeningProvider->institution_facility_type = $request->institution_facility_type;
                            $billrefeningProvider->pharmacy_billing_file = $institutionFile2;
                            $billrefeningProvider->professional_user_with_access = $users;
                            $billrefeningProvider->professional_fax_number = $request->institution_fax_number;
                        }
                        $billrefeningProvider->save();
                        if($billrefeningProvider){
                            DB::table('user_billing_providers')->where('user_id', Auth::user()->id)->where('provider_id', $billrefeningProvider->id)->delete(); 
                            UserBillingProvider::create([  'provider_id' => $billrefeningProvider->id,  'user_id' => Auth::user()->id ]); 
                            if(count($masterReasons) > 0){ 
                                $checkpReason = AppointmentReason::where('provider_id', $billrefeningProvider->id)->first(); 
                                 if(!$checkpReason){
                                    foreach($masterReasons as $reason){
                                        $pReasons =  new AppointmentReason();
                                        $pReasons->provider_id = $billrefeningProvider->id;
                                        $pReasons->name = $reason['name'];
                                        $pReasons->description = $reason['name'];
                                        $pReasons->save();
                                    } 
                                }
                            }
                        }
                    return 1;
                }
        }
        else{
            $billrefeningProviderUpdate =  BillingProvider::where('id',$id)->first();
            //dd($billrefeningProviderUpdate);exit;
            $users = null;
            if($billrefeningProviderUpdate){
                $billrefeningProviderUpdate->injury_state_id = $request->injury_state_id;
                    $billrefeningProviderUpdate->bill_type = $request->bill_type;
                    if($request->professional_user_with_access != null){
                        $users = implode(',',$request->professional_user_with_access);
                    }
                    if($request->bill_type == 'Professional'){
                        $billrefeningProviderUpdate->provider_type = $request->provider_type;
                        if($request->provider_type == 'Organization'){
                        $billrefeningProviderUpdate->tax_id = $request->professional_tax_id;
                        $billrefeningProviderUpdate->professional_provider_name = $request->professional_provider_name;
                        $billrefeningProviderUpdate->professional_nick_name = $request->professional_nick_name;
                        $billrefeningProviderUpdate->professional_telephone = $request->professional_telephone;
                        $billrefeningProviderUpdate->professional_addres1 = $request->professional_addres1;
                        $billrefeningProviderUpdate->professional_addres2 = $request->professional_addres2;
                        $billrefeningProviderUpdate->professional_city = $request->professional_city;
                        $billrefeningProviderUpdate->professional_state = $request->professional_state;
                        $billrefeningProviderUpdate->professional_zip = $request->professional_zip;
                        $billrefeningProviderUpdate->professional_npi = $request->professional_npi;
                        $billrefeningProviderUpdate->professional_address1 = $request->professional_address1;
                        $billrefeningProviderUpdate->professional_address2 = $request->professional_address2;
                        $billrefeningProviderUpdate->professional_city1 = $request->professional_city1;
                        $billrefeningProviderUpdate->professional_state1 = $request->professional_state1;
                        $billrefeningProviderUpdate->professional_zipcode1 = $request->professional_zipcode1;

                        }
                        else{
                            $billrefeningProviderUpdate->tax_id = $request->billProvider_box_25_tax_id; 
                            $billrefeningProviderUpdate->professional_provider_name = $request->billProvider_namebox_33_first_name;
                            $billrefeningProviderUpdate->professional_nick_name = $request->billProvider_namebox_33_last_name; 
                            $billrefeningProviderUpdate->billProvider_namebox_33_mi = $request->billProvider_namebox_33_mi;
                            $billrefeningProviderUpdate->billProvider_namebox_33_suffix = $request->billProvider_namebox_33_suffix;
                            $billrefeningProviderUpdate->professional_telephone = $request->billProvider_namebox_33_telephone;
                            $billrefeningProviderUpdate->professional_addres1 = $request->billProvider_namebox_33_address1;
                            $billrefeningProviderUpdate->professional_addres2 = $request->billProvider_namebox_33_address2; 
                            $billrefeningProviderUpdate->professional_city = $request->billProvider_namebox_33_city;
                            $billrefeningProviderUpdate->professional_state = $request->billProvider_namebox_33_state;
                            $billrefeningProviderUpdate->professional_zip = $request->billProvider_namebox_33_zipCode; 
                            $billrefeningProviderUpdate->professional_npi = $request->billProvider_namebox_33_npi;
                            $billrefeningProviderUpdate->professional_address1 = $request->billProvider_namebox_33_a_address1;
                            $billrefeningProviderUpdate->professional_address2 = $request->billProvider_namebox_33_a_address2;
                            $billrefeningProviderUpdate->professional_city1 = $request->billProvider_namebox_33_a_city;
                            $billrefeningProviderUpdate->professional_state1 = $request->professional_state1;
                            $billrefeningProviderUpdate->professional_zipcode1 = $request->billProvider_namebox_33_a_zipcode;
                        }
                        $billrefeningProviderUpdate->dol_provider_name = $request->dol_provider_name;
                        $billrefeningProviderUpdate->professional_user_with_access = $users;
                        $billrefeningProviderUpdate->professional_fax_number = $request->professional_fax_number;

                    }
                    if($request->bill_type == 'Pharmacy'){
                        $billrefeningProviderUpdate->pharmacy_tax_id = $request->pharmacy_tax_id;
                        $billrefeningProviderUpdate->tax_id = $request->pharmacy_tax_id;
                        $billrefeningProviderUpdate->professional_provider_name = $request->pharmacy_billing_provider_name;
                        $billrefeningProviderUpdate->professional_nick_name = $request->pharmacy_billing_nick_name;
                        $billrefeningProviderUpdate->professional_addres1 = $request->pharmacy_address1;
                        $billrefeningProviderUpdate->professional_addres2 = $request->pharmacy_address2;
                        $billrefeningProviderUpdate->professional_city = $request->pharmacy_city;
                        $billrefeningProviderUpdate->professional_state = $request->pharmacy_state;
                        $billrefeningProviderUpdate->professional_zip = $request->pharmacy_zipcode;
                        $billrefeningProviderUpdate->professional_telephone = $request->pharmacy_telephone;
                        $billrefeningProviderUpdate->professional_file = $signature;
                        $billrefeningProviderUpdate->pharmacy_npi = $request->pharmacy_npi;
                        $billrefeningProviderUpdate->professional_address1 =  $request->pharmacy_billing_address1;
                        $billrefeningProviderUpdate->professional_address2 = $request->pharmacy_billing_address2;
                        $billrefeningProviderUpdate->professional_city1 = $request->pharmacy_billing_city;
                        $billrefeningProviderUpdate->professional_state1 = $request->pharmacy_billing_state;
                        $billrefeningProviderUpdate->professional_zipcode1 = $request->pharmacy_billing_zipcode;
                        $billrefeningProviderUpdate->pharmacy_billing_file = $pharmacyFile;
                        $billrefeningProviderUpdate->professional_user_with_access = $users;
                        $billrefeningProviderUpdate->professional_fax_number = $request->pharmacy_billing_fax_number;
                    }
                    if($request->bill_type == 'Institutional'){
                       $billrefeningProviderUpdate->tax_id = $request->institution_tax_id;
                        $billrefeningProviderUpdate->professional_provider_name = $request->institution_provider_name;
                        $billrefeningProviderUpdate->professional_nick_name = $request->institution_nick_name;
                        $billrefeningProviderUpdate->professional_telephone = $request->institution_telephone;
                        $billrefeningProviderUpdate->professional_addres1 = $request->institution_address1;
                        $billrefeningProviderUpdate->professional_addres2 = $request->institution_address2;
                        $billrefeningProviderUpdate->professional_city = $request->institution_city;
                        $billrefeningProviderUpdate->professional_state = $request->institution_state;
                        $billrefeningProviderUpdate->professional_zip = $request->institution_zipCode;
                        $billrefeningProviderUpdate->professional_address1 =  $request->institution_address11;
                        $billrefeningProviderUpdate->professional_address2 = $request->institution_address22;
                        $billrefeningProviderUpdate->professional_city1 = $request->institution_city1;
                        $billrefeningProviderUpdate->professional_state1 = $request->institution_state1;
                        $billrefeningProviderUpdate->professional_zipcode1 = $request->institution_zipCode1;
                        $billrefeningProviderUpdate->professional_file = $institutionFIle;
                        $billrefeningProviderUpdate->pharmacy_npi = $request->institution_npi;
                        $billrefeningProviderUpdate->institution_taxonomy = $request->institution_taxonomy;
                        $billrefeningProviderUpdate->institution_county_name = $request->institution_county_name;
                        $billrefeningProviderUpdate->institution_facility_type = $request->institution_facility_type;
                        $billrefeningProviderUpdate->pharmacy_billing_file = $institutionFile2;
                        $billrefeningProviderUpdate->professional_user_with_access = $users;
                        $billrefeningProviderUpdate->professional_fax_number = $request->institution_fax_number;
                    }
                $billrefeningProviderUpdate->is_active = $request->provider_status;

                $billrefeningProviderUpdate->update();
                if($billrefeningProviderUpdate){
                    DB::table('user_billing_providers')->where('user_id', Auth::user()->id)->where('provider_id', $billrefeningProviderUpdate->id)->delete(); 
                    UserBillingProvider::create([  'provider_id' => $billrefeningProviderUpdate->id,  'user_id' => Auth::user()->id ]); 
                }
                return 1;
            } 
        }
    }
}