<?php
namespace App\Traits;

use App\Models\Patient;
use DateTime;
use App\Models\{AllDocument, BillingProviderHoliday, BillingProviderRecurrence, AppointmentReason, PatientAppointment, ZipCityState, ProviderBillingTemplateServiceItem, ProviderBillingTemplate }; 
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Str;
use Config;
use File;

trait PatientTrait
{
    public function getPatientList($pagination = 15)
    {
        // Fetch all the data according to model
        return Patient::join('billing_providers as b', 'b.id', '=', 'patients.billing_provider_id')
            ->select(DB::raw('concat("P", lpad(patients.id,5,0)) as patient_no'), 'patients.*', 'b.name')->withTrashed()->paginate($pagination);
    }

    public function storePatientInfo($request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;
        $id = ($request->patient_id) ? $request->patient_id : null;
        $newDob =  date('Y-m-d'); $isBillFail = 0;
        if(isset($request->dob)){
            $reqDob =  $request->dob;
            $exDate = explode('/', $reqDob);
            $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
            //$reverDate = implode('-', array_reverse($exDate));
            $newDob =  date('Y-m-d',strtotime($newBreakDate));
        }
        
        if (!$id) {
             //Add here
            $patients = new Patient();
            $patients->billing_provider_id = $request->add_billing_provider_id;
            $patients->first_name = $request->first_name;
            $patients->last_name = $request->last_name;
            $patients->mi = $request->mi;
            $patients->suffix = $request->suffix;
            $patients->full_name = $request->first_name. " " .$request->last_name;

            //$patients->dob = $request->dob;
            //$patients->dob =  Carbon::parse($request->dob)->format('Y-m-d');
            $patients->dob = $newDob;
            $patients->gender = $request->gender;
            $patients->ssn_no = $request->ssn_no;
            $patients->contact_no = $request->mobile_no;
            $patients->landline_no = $request->landline_no;
            $patients->practice_id = $request->practice_id;
            $patients->address_line1 = $request->address_line1;
            $patients->address_line2 = $request->address_line2;
            $patients->state_id = $request->state_id;
            $patients->city_id = $request->city_id;
            $patients->zipcode = $request->zipcode;
            //$patients->billing_provider_id = $request->billing_provider_id;
            $patients->save();
            $patient_id = $patients->id;
            $this->checkInsertUpdateTask($request, $patient_id);
            return $patient_id;

        } else { 
                //Update here
                $patientInfo = Patient::where("id", $id)->first();
                //dd($patientInfo);
                $patientInfo->billing_provider_id = $request->add_billing_provider_id;
                $patientInfo->first_name = $request->first_name;
                $patientInfo->last_name = $request->last_name;
                $patientInfo->mi = $request->mi;
                $patientInfo->suffix = $request->suffix;
                $patientInfo->full_name = $request->first_name. " " .$request->last_name;

                //$patients->dob = $request->dob;
                //$patients->dob =  Carbon::parse($request->dob)->format('Y-m-d');
                //$patientInfo->dob = date('Y-m-d',strtotime($request->dob));
                $patientInfo->dob = $newDob;
                $patientInfo->gender = $request->gender;
                $patientInfo->ssn_no = $request->ssn_no;
                $patientInfo->contact_no = $request->mobile_no;
                $patientInfo->landline_no = $request->landline_no;
                $patientInfo->practice_id = $request->practice_id;
                $patientInfo->address_line1 = $request->address_line1;
                $patientInfo->address_line2 = $request->address_line2;
                $patientInfo->state_id = $request->state_id;
                $patientInfo->city_id = $request->city_id;
                $patientInfo->zipcode = $request->zipcode;
            $patientInfo->update();
            $this->checkInsertUpdateTask($request, $patientInfo->id);
            return $patientInfo->id;
        }
    }

    public function getPatientFormStatusId($patient)
    {
        $formStatus = config('global.formStatus');
        $form_status = $formStatus['complete'];
        $status_alias = '';
        if ($patient->billing_provider_id && $patient->first_name && $patient->dob && $patient->ssn_no && $patient->gender && $patient->address_line1 && $patient->city_id && $patient->state_id && $patient->zipcode) {

            if (!$this->isValidDate($patient->dob)) {
                $form_status = $formStatus['incomplete'];
            }
            if (!$this->isValidZipcode($patient->zipcode)) {
                $form_status = $formStatus['incomplete'];
            }
            if (!$this->isValidSSN($patient->ssn_no)) {
                $form_status = $formStatus['incomplete'];
            }
        } else {
            $form_status = $formStatus['incomplete'];
        }
        if ($form_status != $formStatus['complete']) {
            $status_alias = 'Failed Review';
        }
        return array($this->getStatusId($form_status), $status_alias);
    }
    public function calculateAge($date)
    {
        // $dob = new DateTime($date);

        // $now = new DateTime();

        // $difference = $now->diff($dob);

        // $age = $difference->y;
        $age = 0;
        if($date != ""){
            $age = (date('Y') - date('Y',strtotime($date)));
        }
        return $age;
    }
    public function plainText($text)
    {
        $text = strip_tags($text, '<br><p><li>');
        $text = preg_replace('/<[^>]*>/', PHP_EOL, $text);
        return $text;
    }
    public function getToolTipData($patientId,$cDate){


        //appointment_date
        $pAppointment = PatientAppointment::with('getPatient');
        if($patientId != null){
            $pAppointment = $pAppointment->where('patient_id',$patientId);
        }
        if($cDate != null){
            $date = Carbon::createFromFormat('Y-m-d', $cDate);
            $pAppointment = $pAppointment->whereMonth('appointment_date', $date->month);
        }
        $patientAppointment =  $pAppointment->get();
        $appointData = array();
        foreach ($patientAppointment as $apoint){
            $eTime = $apoint->appointment_date." ".$apoint->appointment_time;
            //$finalEndTime =  Carbon::createFromFormat('Y-m-d', $apoint->eTime)->addMinutes($apoint->duration);


            $finalEndTime = Carbon::parse($eTime)
            ->addMinutes($apoint->duration)
            ->format('Y-m-d H:i:s'); 
            $totalAge = ($apoint->getPatient && $apoint->getPatient->dob != "") ? $this->calculateAge($apoint->getPatient->dob) : 0;
            $contactNumber  = ($apoint->getPatient && $apoint->getPatient->contact_no) ? $this->calculateAge($apoint->getPatient->contact_no) : 0;
            $toolTipData = '<div class="row"><div class="col-md-6">Age:-</div><div class="col-md-6">'.$totalAge.'</div></div><br><div class="row"><div class="col-md-6">Telephone:-</div><div class="col-md-6">'.$contactNumber.'</div></div>';
            $appointData[] = array('start' => $eTime, 'end' => $finalEndTime,'textColor'=>'black', 'color' =>"#257e4a",'title' => ($apoint->getPatient) ? $apoint->getPatient->first_name." ".$apoint->getPatient->last_name : 'NA',
            'description' => $this->plainText($toolTipData), 'id' => $apoint->id);
        }
        return $appointData;
    }
    public function getStateCodeByName($stateName)
    {
        // Fetch all the data according to model
        return  ZipCityState::where('state_name',$stateName)->first();
    }
    public function storePatientAppointment($request){
        
        try {
            DB::beginTransaction();
            $checkApoint = PatientAppointment::where('patient_id', $request->patientId)->where('appointment_date', $request->appointment_date)->first();
            if ($checkApoint) {
                $checkApoint->billing_provider_id = $request->appointment_provider;
                $checkApoint->appointment_date = $request->appointment_date;
                $checkApoint->appointment_time = $request->appointment_time;
                $checkApoint->location = $request->appointment_location;
                $checkApoint->resource = $request->appointment_resource;
                $checkApoint->recurrene = $request->appointment_recurrene;
                $checkApoint->appointment_reason = $request->appointment_resason;
                $checkApoint->meeting_type = $request->appointment_meeting_Type;
                $checkApoint->duration = $request->appointment_duration;
                $checkApoint->status = $request->appointment_status;
                $checkApoint->update();
                return $checkApoint;
                
            } else {
                $pAppoint = new PatientAppointment();
                $pAppoint->patient_id = $request->patientId;
                $pAppoint->billing_provider_id = $request->appointment_provider;
                $pAppoint->appointment_date = $request->appointment_date;
                $pAppoint->appointment_time = $request->appointment_time;
                $pAppoint->location = $request->appointment_location;
                $pAppoint->resource = $request->appointment_resource;
                $pAppoint->recurrene = $request->appointment_recurrene;
                $pAppoint->appointment_reason = $request->appointment_resason;
                $pAppoint->meeting_type = $request->appointment_meeting_Type;
                $pAppoint->duration = $request->appointment_duration;
                $pAppoint->status = $request->appointment_status;
                $pAppoint->save();
                return $pAppoint;
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
    public function saveProviderBillingTemplate($request){ 
        $checkTemplate = ProviderBillingTemplate::where('id', $request->billingTemplateId)->first();
        if ($checkTemplate) {
            $checkTemplate->provider_id = $request->billingProviderId; 
            $checkTemplate->template_name = $request->template_name; 
            $checkTemplate->description = $request->template_description; 
            $checkTemplate->created_by = Auth::user()->id;
            $checkTemplate->update();
            $rest = $this->storeProviderBillingTemplateServiceItem($request, $checkTemplate->id);
            //return redirect()->back();               
        } else {
            $pBillingTemplate = new ProviderBillingTemplate();
            $pBillingTemplate->provider_id = $request->billingProviderId; 
            $pBillingTemplate->template_name = $request->template_name; 
            $pBillingTemplate->description = $request->template_description; 
            $pBillingTemplate->created_by = Auth::user()->id;
            $pBillingTemplate->save();
            $this->storeProviderBillingTemplateServiceItem($request, $pBillingTemplate->id);
            //return redirect()->back();
        } 
    }
    public function storeProviderBillingTemplateServiceItem($request, $templateId){  
        $checkTemplate = ProviderBillingTemplateServiceItem::where('template_id', $templateId)->delete(); 
        $pcCnt = count($request->bill_procedure_code);
        if(count($request->bill_procedure_code) > 0){
            for ( $i=0; $i < count($request->bill_procedure_code); $i++) {
                if($request->bill_procedure_code[$i] != null){
                    $pBillingTemplate = new ProviderBillingTemplateServiceItem();
                    $pBillingTemplate->provider_id      = $request->billingProviderId;
                    $pBillingTemplate->template_id      = $templateId;
                    $pBillingTemplate->procedure_code   = $request->bill_procedure_code[$i];
                    $pBillingTemplate->modifiers_id     = $request->bill_modifiers[$i];
                    $pBillingTemplate->units            = $request->bill_units[$i]; 
                    $pBillingTemplate->save();
                } 
            } 
        } 
    }
    public function saveAppointmentReason($request){ 
        $checkReason = AppointmentReason::where('id', $request->resaon_id)->first();
        if($checkReason){
            $checkReason->name = $request->name;
            $checkReason->description = $request->description;
            $checkReason->update();
        }
        else{
            $newReason = new AppointmentReason();
            $newReason->name = $request->name;
            $newReason->provider_id = $request->provider_id;
            $newReason->description = $request->description;
            $newReason->save();
           
        } 
    }
     public function saveAppointmentRecurrecne($request){ 
        //   if(isset($request->recurrence_date)){
        //         $reqDob =  $request->recurrence_date;
        //         $exDate = explode('/', $reqDob);
        //         $newBreakDate = $exDate[2]."-".$exDate[0]."-".$exDate[1];
        //         //$reverDate = implode('-', array_reverse($exDate));
        //         $newAppoint =  date('Y-m-d',strtotime($newBreakDate));
        //     }
                
        $checkbillinRecurrence = BillingProviderRecurrence::where('id', $request->resaon_id)->first();
        if($checkbillinRecurrence){
            $checkbillinRecurrence->recurrence_date = $request->recurrence_date;
            $checkbillinRecurrence->description = $request->description;
            $checkbillinRecurrence->update();
        }
        else{
            $recurrence = new BillingProviderRecurrence();
            $recurrence->recurrence_date = $request->recurrence_date;
            $recurrence->provider_id = $request->provider_id;
            $recurrence->description = $request->description;
            $recurrence->save();
           
        } 
    }
    public function saveBillingProviderHoliday($request){ 
        $checkHoliday = BillingProviderHoliday::where('id', $request->bp_holiday_id)->first();
        if($checkHoliday){
            $checkHoliday->holiday_id = $request->holiday_id;
            $checkHoliday->billing_provider_id = $request->provider_id;
            $checkHoliday->location_id = $request->holiday_location_id;
            $checkHoliday->created_by = Auth::user()->id; 
            $checkHoliday->holiday_end_time = $request->holiday_end_time;
            $checkHoliday->holiday_start_time	 = $request->holiday_start_time; 
            $checkHoliday->description = $request->description;
            $checkHoliday->update();
        }
        else{
                $newHoliday = new BillingProviderHoliday();
                $newHoliday->holiday_id = $request->holiday_id;
                $newHoliday->billing_provider_id = $request->provider_id;
                $newHoliday->location_id = $request->holiday_location_id;
                $newHoliday->created_by = Auth::user()->id; 
                $newHoliday->holiday_end_time = $request->holiday_end_time;
                $newHoliday->holiday_start_time	 = $request->holiday_start_time; 
                $newHoliday->description = $request->description;
                $newHoliday->save();  
        } 
    }
    public function storeBillServicePrecedureDocument($request) {
        
        // echo "<pre>";
        // print_r($request->all());exit;
        if($request->file('billDoc')){
            $file                = $request->file('billDoc');
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
        $injuryDocumentId1 = new AllDocument();
        $injuryDocumentId1->injury_document	                = $document_path;
        $injuryDocumentId1->doc_type	                    =  'Bill';
        $injuryDocumentId1->injury_id	                    = $request->billId;
        $injuryDocumentId1->bill_service_procedure_id	    = $request->billServiceProcedure;
        $injuryDocumentId1->is_new_document	                = 1;
        $injuryDocumentId1->is_sbr_document	                = 1; 
        $injuryDocumentId1->is_active	                    =  1;
        $injuryDocumentId1->added_by                        = Auth::user()->id;
        $injuryDocumentId1->save(); 
        
    }
}