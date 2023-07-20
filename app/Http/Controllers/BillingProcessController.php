<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\{Patient, ClaimAdministrator, BillingProvider, MedicalProvider, ClaimStatus, Diagnosis_code, Service_code, Health_provider, Country, City,State};
use App\Models\BillingProcess;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BillingProcessController extends Controller
{

    public function index()
    {
        $billingproviders = $this->getActiveData(new BillingProvider(), 'name');
        $countries = $this->getActiveData(new Country(), 'country_name');
        $states = $this->getActiveData(new State(), 'state_name');

        $diagnoses =  $diagnoses = $this->getDiagnosisCode();
        $service_codes = $this->getActiveData(new Service_code(), 'place_of_service_name');
        $render_providers = $this->getRenderProvdierDD(new Health_provider());
        $claim_admins = $this->getActiveData(new ClaimAdministrator(), 'name');
        $medical_providers = $this->getActiveData(new MedicalProvider(), 'applicant_name');
        $claimstatuses = $this->getActiveData(new ClaimStatus(), 'claim_status');

        return view('billingprocess.index', compact('billingproviders', 'countries', 'states', 'claim_admins', 'diagnoses', 'service_codes', 'render_providers', 'claimstatuses', 'medical_providers'));
    }

    public function stepForm()
    {
        return view('billingprocess.stepform');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show(BillingProcess $billingProcess)
    {
        //
    }

    public function edit(BillingProcess $billingProcess)
    {
        //
    }

    public function update(Request $request, BillingProcess $billingProcess)
    {
        //
    }

    public function destroy(BillingProcess $billingProcess)
    {
        //
    }
}
