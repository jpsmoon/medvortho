<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\{Country,State,City};
use App\Models\MedicalProvider;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedicalProviderController extends Controller
{
    public function index()
    {
        $medicalproviders = $this->getAllData(new MedicalProvider(), 'applicant_name');
        $mdcl_provider_types = config('global.mdcl_provider_types');
        //print_r($mdcl_provider_types);die();
        $i =  (request()->input('page', 1) - 1) * 5;
        return view('masters.medicalproviders.index', compact('medicalproviders', 'i', 'mdcl_provider_types'));
    }

    public function store(Request $request)
    {
        request()->validate(['mpn_no' => 'required|unique:medical_providers', 'applicant_name' => 'required', 'applicant_type' => 'required']);

        $medicalprovider = new MedicalProvider();
        $medicalprovider->mpn_no = $request->mpn_no;
        $medicalprovider->applicant_name = $request->applicant_name;
        $medicalprovider->applicant_type = $request->applicant_type;
        $medicalprovider->mpn_name = $request->mpn_name;
        $medicalprovider->approval_date = $request->approval_date;
        $medicalprovider->mpn_status = $request->mpn_status;
        $medicalprovider->website_url = $request->website_url;
        $medicalprovider->save();
    
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data inserted successfully',
            'records'  =>$medicalprovider
          ]
        );
    }

    public function show(MedicalProvider $medicalprovider) 
    {
        return response()->json(
          [
            'success' => 1,
            'records'  =>$medicalprovider
          ]
        ); 
    }
    public function edit(MedicalProvider $medicalprovider) {}

    public function update(Request $request, MedicalProvider $medicalprovider)
    {
        request()->validate(['mpn_no' => 'required', 'applicant_name' => 'required', 'applicant_type' => 'required']);

        $medicalprovider->mpn_no = $request->mpn_no;
        $medicalprovider->applicant_name = $request->applicant_name;
        $medicalprovider->applicant_type = $request->applicant_type;
        $medicalprovider->mpn_name = $request->mpn_name;
        $medicalprovider->approval_date = $request->approval_date;
        $medicalprovider->mpn_status = $request->mpn_status;
        $medicalprovider->website_url = $request->website_url;
        $medicalprovider->save();
        Session::flash('success', 'Data updated successfully!');

        $mdcl_provider_types = config('global.mdcl_provider_types');
        $applicant_type = '';
        for($i = 0; $i< count($mdcl_provider_types); $i++){
            if ($mdcl_provider_types[$i]['id'] == $medicalprovider->applicant_type) {
                $applicant_type = $mdcl_provider_types[$i]['value'];
                $i= count($mdcl_provider_types);
            }
        }

        return response()->json(
          [
            'success' => 1,
            'message' => 'Data updated successfully',
            'records'  =>$medicalprovider,
            'applicant_type'  =>$applicant_type
          ]
        );
    }

    public function destroy(MedicalProvider $medicalprovider)
    {
        MedicalProvider::where("id", $medicalprovider->id)->update(['is_active' => '0']);        
        $medicalprovider->delete();
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
        MedicalProvider::withTrashed()->find($request->id)->restore(); 
        MedicalProvider::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
}
