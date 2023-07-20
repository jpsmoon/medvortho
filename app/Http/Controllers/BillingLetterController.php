<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BillingProvider;
use App\Models\Patient;


class BillingLetterController extends Controller
{
    public function viewDemandLetter(Request $request)
    {
        
        $patientId = $request->providerId;
        $id =  $request->id; $bReferrings='';
        
        //$providerInfo = BillingProvider::with('getPatientsByProviderId')->where('id',$providerId )->first();
        $patientInfo = Patient::with('getBillingProvider')->where('id',$patientId )->first();
        
        //dd($patientInfo->getBillingProvider);
        
        return view('bill-submissions.letters.demand.show', compact('id', 'bReferrings', 'patientInfo'));
    }
    
    public function viewSbrLetter(Request $request)
    {
        
        $providerId = $request->providerId;
        $id =  $request->id;$bReferrings='';
        return view('bill-submissions.letters.sbr.show', compact('id','providerId','bReferrings'));
    }
    
    public function viewRFALetter(Request $request)
    {
        
        $providerId = $request->providerId;
        $id =  $request->id;$bReferrings='';
        return view('bill-submissions.letters.rfa.show', compact('id','providerId','bReferrings'));
    }
    
    public function viewResubmissionLetter(Request $request)
    {
        
        $providerId = $request->providerId;
        $id =  $request->id;$bReferrings='';
        return view('bill-submissions.letters.resubmission.show', compact('id','providerId','bReferrings'));
    }
    
    public function viewPr2Letter(Request $request)
    {
        
        $providerId = $request->providerId;
        $id =  $request->id;$bReferrings='';
        return view('bill-submissions.letters.pr2.show', compact('id','providerId','bReferrings'));
    }
    
    public function viewAuthorizationLetter(Request $request)
    {
        
        $providerId = $request->providerId;
        $id =  $request->id;$bReferrings='';
        return view('bill-submissions.letters.authorization.show', compact('id','providerId','bReferrings'));
    }
    
    
}
