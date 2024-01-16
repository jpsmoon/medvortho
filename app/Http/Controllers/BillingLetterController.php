<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\{Patient, BillingProvider, InjuryBill};

class BillingLetterController extends Controller
{
    public function viewDemandLetter(Request $request)
    {
        
        $patientId = $request->providerId;
        $id =  $request->id; $bReferrings='';
        $pInjuries = [];
        
        //$providerInfo = BillingProvider::with('getPatientsByProviderId')->where('id',$providerId )->first();
        $patientInfo = Patient::with('getBillingProvider')->where('id',$patientId )->first();
        
        //dd($patientInfo->getBillingProvider);
        
        return view('bill-submissions.letters.demand.show', compact('id', 'bReferrings', 'patientInfo', 'pInjuries'));
    }
    
    public function viewSbrLetter(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        $state = null;
        $pInjuries = [];
        $getInjuryClaim = [];
        //echo $providerId = $request->providerId;exit;
        $id =  NULL; $providerId = NULL;
        $bReferrings='';
        
        //$billId = $request->billId;
        $billId = $request->providerId; 
        $mm=NULL;  $dd=NULL; $yy=NULL;
        $inj_mm=NULL;  $inj_dd=NULL; $inj_yy=NULL; $stateCode = ''; $billCharge = null;
        $isOtherForm = false; $otherServiceForForm = [];  $serviceForForm = []; $billAllServices = array();
        $injuryBillInfo = InjuryBill::with('getInjury','getBillDiagnosis','getBillPlaceOfService','getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider')->where('id', $billId)->first();
        $diagnosisCodeNumbers = null;
        //dd($injuryBillInfo);
        if($injuryBillInfo)
        { 
             // $billDetail = $this->getBillServicesInfoByBillId($injuryBillInfo);
            $totForm = 0;
            for ($i = 0; $i < count($injuryBillInfo->getBillServices); $i += 6) {
                $totForm++;
            }
            if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0){
                // create an empty array to hold the alphabet
                $alphabet = array();
              }
            
            if($injuryBillInfo->getInjury){
                if($injuryBillInfo->getInjury->patient){
                    if($injuryBillInfo->getInjury->patient->dob != ""){
                        $mm= date('m', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $dd = date('d', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $yy =  date('y', strtotime($injuryBillInfo->getInjury->patient->dob));
                    }
                }
                if($injuryBillInfo->getInjury->getInjuryClaim)
                {
                     if($injuryBillInfo->dos){
                        $inj_mm = date('m', strtotime($injuryBillInfo->dos));
                        $inj_dd = date('d', strtotime($injuryBillInfo->dos));
                        $inj_yy =  date('y', strtotime($injuryBillInfo->dos));
                    }
                    
                }
               
                if($injuryBillInfo->getInjury->patient->state_id){
                    $state = $this->getStateCodeByName($injuryBillInfo->getInjury->patient->state_id);
                    // dd($state);
                    // if($state){
                    //     $stateCode = $state->state_code;
                    // }
                
                }
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges){
                    $billCharge = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges->physician_services;  
                  }
            }
                          
        }
        return view('bill-submissions.letters.sbr.show', compact('id','providerId','bReferrings', 'pInjuries', 'getInjuryClaim','injuryBillInfo', 'state'));
    }
    
    public function viewRFALetter(Request $request)
    {
        $state = null;
        $pInjuries = [];
        $getInjuryClaim = [];
        $id =  NULL; $providerId = NULL;
        $bReferrings='';
        $billId = $request->providerId; 
        $mm=NULL;  $dd=NULL; $yy=NULL;
        $inj_mm=NULL;  $inj_dd=NULL; $inj_yy=NULL; $stateCode = ''; $billCharge = null;
        $isOtherForm = false; $otherServiceForForm = [];  $serviceForForm = []; $billAllServices = array();
        $injuryBillInfo = InjuryBill::with('getInjury','getBillDiagnosis','getBillPlaceOfService','getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider')->where('id', $billId)->first();
        $diagnosisCodeNumbers = null;
        //dd($injuryBillInfo);
        if($injuryBillInfo)
        { 
             // $billDetail = $this->getBillServicesInfoByBillId($injuryBillInfo);
            $totForm = 0;
            for ($i = 0; $i < count($injuryBillInfo->getBillServices); $i += 6) {
                $totForm++;
            }
            if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0){
                // create an empty array to hold the alphabet
                $alphabet = array();
              }
            
            if($injuryBillInfo->getInjury){
                if($injuryBillInfo->getInjury->patient){
                    if($injuryBillInfo->getInjury->patient->dob != ""){
                        $mm= date('m', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $dd = date('d', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $yy =  date('y', strtotime($injuryBillInfo->getInjury->patient->dob));
                    }
                } 
                if($injuryBillInfo->getInjury->patient->state_id){
                    $state = $this->getStateCodeByName($injuryBillInfo->getInjury->patient->state_id); 
                }
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges){
                    $billCharge = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges->physician_services;  
                  }
            }
                          
        }
        return view('bill-submissions.letters.rfa.show', compact('id','providerId','bReferrings', 'pInjuries', 'getInjuryClaim','injuryBillInfo', 'state'));
    }
    
    public function viewResubmissionLetter(Request $request)
    {
        $pInjuries = [];
        $providerId = $request->providerId;
        $id =  $request->id;$bReferrings='';
        return view('bill-submissions.letters.resubmission.show', compact('id','providerId','bReferrings', 'pInjuries'));
    }
    
    public function viewPr2Letter(Request $request)
    {
        $state = null;
        $pInjuries = [];
        $getInjuryClaim = [];
        $id =  NULL; $providerId = NULL;
        $bReferrings='';
        $billId = $request->providerId; 
        $mm=NULL;  $dd=NULL; $yy=NULL;
        $inj_mm=NULL;  $inj_dd=NULL; $inj_yy=NULL; $stateCode = ''; $billCharge = null;
        $isOtherForm = false; $otherServiceForForm = [];  $serviceForForm = []; $billAllServices = array();
        $injuryBillInfo = InjuryBill::with('getInjury','getBillDiagnosis','getBillPlaceOfService','getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider')->where('id', $billId)->first();
        $diagnosisCodeNumbers = null;
        //dd($injuryBillInfo);
        if($injuryBillInfo)
        { 
             // $billDetail = $this->getBillServicesInfoByBillId($injuryBillInfo);
            $totForm = 0;
            for ($i = 0; $i < count($injuryBillInfo->getBillServices); $i += 6) {
                $totForm++;
            }
            if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0){
                // create an empty array to hold the alphabet
                $alphabet = array();
              }
            
            if($injuryBillInfo->getInjury){
                if($injuryBillInfo->getInjury->patient){
                    if($injuryBillInfo->getInjury->patient->dob != ""){
                        $mm= date('m', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $dd = date('d', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $yy =  date('y', strtotime($injuryBillInfo->getInjury->patient->dob));
                    }
                } 
                if($injuryBillInfo->getInjury->patient->state_id){
                    $state = $this->getStateCodeByName($injuryBillInfo->getInjury->patient->state_id); 
                }
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges){
                    $billCharge = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges->physician_services;  
                  }
            }
                          
        }
        return view('bill-submissions.letters.pr2.show', compact('id','providerId','bReferrings', 'pInjuries', 'getInjuryClaim','injuryBillInfo', 'state'));
    }
    
    public function viewAuthorizationLetter(Request $request)
    {
        
        $pInjuries = [];
        $providerId = $request->providerId;
        $id =  $request->id;$bReferrings='';
        return view('bill-submissions.letters.authorization.show', compact('id','providerId','bReferrings', 'pInjuries'));
    }
    
    public function coversheet(Request $request)
    {
       $id =  $request->id;$bReferrings=''; $billId = $request->billId; $mm=NULL;  $dd=NULL; $yy=NULL;
        $inj_mm=NULL;  $inj_dd=NULL; $inj_yy=NULL; $stateCode = ''; $billCharge = null;
        $isOtherForm = false; $otherServiceForForm = [];  $serviceForForm = []; $billAllServices = array();
        $injuryBillInfo = InjuryBill::with('getInjury','getBillDiagnosis','getBillPlaceOfService','getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider')->where('id', $billId)->first();
        $diagnosisCodeNumbers = null; $totForm = 0;
        
        if($injuryBillInfo)
        {
           // $billDetail = $this->getBillServicesInfoByBillId($injuryBillInfo);
            
            for ($i = 0; $i < count($injuryBillInfo->getBillServices); $i += 6) {
                $totForm++;
            }
            if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0){
                // create an empty array to hold the alphabet
                $alphabet = array();
                // for ($i = 0; $i < count($injuryBillInfo->getBillDiagnosis); $i++) {
                //      $alphabet[$i] = chr($i + 97);
                // }
                // $diagnosisCodeNumbers = implode(',',$alphabet);
            }
            
            if($injuryBillInfo->getInjury){
                if($injuryBillInfo->getInjury->patient){
                    if($injuryBillInfo->getInjury->patient->dob != ""){
                        $mm= date('m', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $dd = date('d', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $yy =  date('y', strtotime($injuryBillInfo->getInjury->patient->dob));
                    }
                }
                if($injuryBillInfo->getInjury->getInjuryClaim)
                {
                    // if($injuryBillInfo->getInjury->getInjuryClaim->start_date != "" && $injuryBillInfo->getInjury->getInjuryClaim->end_date != "")
                    // {
                    //     $inj_mm = date('m', strtotime($injuryBillInfo->getInjury->getInjuryClaim->end_date));
                    //     $inj_dd = date('d', strtotime($injuryBillInfo->getInjury->getInjuryClaim->end_date));
                    //     $inj_yy =  date('y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->end_date));
                    // }    
                    // else
                    // {
                    // $inj_mm = date('m', strtotime($injuryBillInfo->getInjury->getInjuryClaim->dos));
                    // $inj_dd = date('d', strtotime($injuryBillInfo->getInjury->getInjuryClaim->dos));
                    // $inj_yy =  date('y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->dos));
                    // }
                    if($injuryBillInfo->dos){
                        $inj_mm = date('m', strtotime($injuryBillInfo->dos));
                        $inj_dd = date('d', strtotime($injuryBillInfo->dos));
                        $inj_yy =  date('y', strtotime($injuryBillInfo->dos));
                    }
                    
                }
                if($injuryBillInfo->getInjury->patient->state_id){
                    $state = $this->getStateCodeByName($injuryBillInfo->getInjury->patient->state_id);
                    if($state){
                        $stateCode = $state->state_code;
                    }
                
                }
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges){
                    $billCharge = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges->physician_services;  
                  }
            }
                          
        }
       
        // $getInjury = [];
        // $getInjuryClaim = [];
        // $injuryBillInfo = [];
        // $pInjuries = [];
        // $providerId = $request->providerId;
        // $id =  $request->id;$bReferrings='';
        return view('bill-submissions.letters.coversheet.show', compact('diagnosisCodeNumbers','injuryBillInfo','totForm','billCharge','mm', 'yy', 'dd','inj_mm', 'inj_dd', 'inj_yy','stateCode','isOtherForm','otherServiceForForm','serviceForForm'));
    }
    
    
}
