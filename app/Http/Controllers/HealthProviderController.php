<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\{Taxonomy_code,State, Health_provider_license};
use App\Models\Health_provider;
use Illuminate\Http\Request;
// USE Illuminate\Contracts\Support\Jsonable;
use Symfony\Component\HttpFoundation\Response;

class HealthProviderController extends Controller
{
    public function index()
    {
        $taxonomy_codes = Taxonomy_code::where('is_active', 1)->orderBy('name')->orderBy('code')->get();
        $states = State::where('is_active', 1)->orderBy('state_name')->get();

        $health_providers = Health_provider::join('taxonomy_codes as t', 't.id', '=', 'health_providers.taxonomy_code_id')
                        ->select('health_providers.*', 't.name', 't.code')
                        ->withTrashed()->paginate(15);      //

        $i =  (request()->input('page', 1) - 1) * 5;
        //var_dump($health_providers); die();
        return view('masters.healthproviders.index', compact('taxonomy_codes', 'states', 'health_providers', 'i'));
    }

    public function create()
    {
        $states = State::where('is_active', 1)->orderBy('state_name')->get(); 
        $taxonomy_codes = Taxonomy_code::where('is_active', 1)->orderBy('name')->orderBy('code')->get();  
       
        return view('masters.healthproviders.create', compact('states', 'taxonomy_codes'));
    }

    public function store(Request $request)
    {
        /*var_dump($_REQUEST); 
        echo "<br/>";
        var_dump($request->details);
        echo "<br/>";
        echo "<br/>";
         for($i = 0; $i < $arrlen; $i++ ){
            if(isset($request->details['licenseno'][$i]) && isset($request->details['state_id'][$i])){
                echo $request->details['licenseno'][$i].' >> '.$request->details['state_id'][$i]; echo "<br/>";
            }
        }
        die();*/


        request()->validate(['npi' => 'required', 'entity_type' => 'required', 'taxonomy_code_id' => 'required', 'provider_type' => 'required']);
        if($request->entity_type == 'Person'){
            request()->validate([ 'first_name' => 'required']);
        }else{
            request()->validate([ 'entity_name' => 'required']);
        }
        $arrlen = count($request->details['licenseno']);
        $signature_path = '';
        if($request->file('signature')){
            $request->validate([
                'signature' => 'required|image|mimes:jpg,png|max:1024', 
            ]);
     
            //$name = $request->file('signature')->getClientOriginalName(); 
            $signature_path = $request->file('signature')->store('public/signatures');
        }
 

        
        $health_providers = new Health_provider();
        $health_providers->npi = $request->npi;
        $health_providers->entity_type = $request->entity_type;
        $health_providers->entity_name = $request->entity_name;
        $health_providers->first_name = $request->first_name;
        $health_providers->last_name = $request->last_name;
        $health_providers->mi = $request->mi;
        $health_providers->suffix = $request->suffix;
        $health_providers->taxonomy_code_id = $request->taxonomy_code_id;
        $health_providers->provider_type = $request->provider_type;
        $health_providers->signature = $signature_path;
        $health_providers->save();
    
        $health_provider_id = $health_providers->id;

        for($i = 0; $i < $arrlen; $i++ ){

            if(isset($request->details['licenseno'][$i]) && isset($request->details['state_id'][$i])){
                $licenseno = $request->details['licenseno'][$i];
                $state_id = $request->details['state_id'][$i];
                //echo $licenseno.' >> '.$state_id; echo "<br/>";
                
                $health_provider_license = new Health_provider_license();
                $health_provider_license->health_provider_id = $health_provider_id;
                $health_provider_license->licenseno = $licenseno;
                $health_provider_license->state_id = $state_id;
                $health_provider_license->save();
            }
        }

        return redirect()->route('healthproviders.index')
                        ->with('success','Render Provider created successfully.');
        // return response()->json(
        //   [
        //     'success' => 1,
        //     'message' => 'Data inserted successfully',
        //     'records'  =>$diagnosis_codes
        //   ]
        // );
    }

    public function show(Health_provider $healthprovider) { }

    public function edit(Health_provider $healthprovider)
    {
        $states = State::where('is_active', 1)->orderBy('state_name')->get(); 
        $taxonomy_codes = Taxonomy_code::where('is_active', 1)->orderBy('name')->orderBy('code')->get();  
        $healthprovider = Health_provider::join('taxonomy_codes as t', 't.id', '=', 'health_providers.taxonomy_code_id')
                        ->where('health_providers.id', $healthprovider->id)
                        ->select('health_providers.*', 't.name', 't.code')->first();

        $health_provider_licenses = Health_provider_license::where('health_provider_id', $healthprovider->id)
                        ->select('health_provider_licenses.*')->orderBy('health_provider_licenses.id')->get();
                

        $displayPerson = $displayNonperson = 'style="display:none;"';
        if($healthprovider->entity_type == 'Person'){
            $displayPerson = 'style="display:flex;"';
        }
        else{
            $displayNonperson = 'style="display:flex;"';
        }

        return view('masters.healthproviders.edit', compact('healthprovider', 'states', 'taxonomy_codes', 'displayPerson', 'displayNonperson', 'health_provider_licenses'));
    }

    public function update(Request $request, Health_provider $healthprovider)
    {
        
        // var_dump($request->details);
        // echo "<br/>";
        // foreach($request->details as $idx =>$values){
        //     var_dump($values);           
        //     echo $idx.' >> '.$values['key'].' >> '.$values['licenseno'].' >> '.$values['state_id'];     echo "<br/>";
        // }
        // die();

        request()->validate(['npi' => 'required', 'entity_type' => 'required', 'taxonomy_code_id' => 'required', 'provider_type' => 'required']);
        if($request->entity_type == 'Person'){
            request()->validate([ 'first_name' => 'required']);
        }else{
            request()->validate([ 'entity_name' => 'required']);
        }        

        $updateArr = array(
            'npi' => $request->npi,
            'entity_type' => $request->entity_type,
            'entity_name' => $request->entity_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mi' => $request->mi,
            'suffix' => $request->suffix,
            'taxonomy_code_id' => $request->taxonomy_code_id,
            'provider_type' => $request->provider_type
        );        
        if($request->file('signature')){
            $request->validate([
                'signature' => 'required|image|mimes:jpg,png|max:1024', 
            ]); 
            $signature_path = $request->file('signature')->store('public/signatures');
            $updateArr['signature'] = $signature_path;
        }
        Health_provider::where("id", $healthprovider->id)->update($updateArr);

        foreach($request->details as $idx =>$values){
            //echo $idx.' >> '.$values['key'].' >> '.$values['licenseno'].' >> '.$values['state_id'];       echo "<br/>";
            $licenseno = $values['licenseno'];
            $state_id = $values['state_id'];
            if(trim($licenseno) != '' && $state_id){
                if($values['key']){ //update here
                    $health_provider_license_id = trim($values['key']);
                    Health_provider_license::where("id", $health_provider_license_id)->update(['state_id' =>$state_id, 'licenseno' =>$licenseno]);    

                }else{ //add here
                    $health_provider_license = new Health_provider_license();
                    $health_provider_license->health_provider_id = $healthprovider->id;
                    $health_provider_license->licenseno = $licenseno;
                    $health_provider_license->state_id = $state_id;
                    $health_provider_license->save();
                }                    
            }
        }

        return redirect()->route('healthproviders.index')
                        ->with('success','Render Provider updated successfully');
    }

    public function destroy(Health_provider $healthprovider)
    {
        Health_provider::where("id", $healthprovider->id)->update(['is_active' => '0']);        
        $healthprovider->delete();
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
        Health_provider::withTrashed()->find($request->id)->restore(); 
        Health_provider::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
}
