<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\{Country,State,City};
use App\Models\Service_code;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceCodeController extends Controller
{
    public function index()
    {
        $countries = Country::where('is_active', 1)->orderBy('country_name')->get();
        $service_codes = Service_code::withTrashed()->paginate(15);
        $i =  (request()->input('page', 1) - 1) * 5;
        //var_dump($service_codes); die();
        return view('masters.servicecodes.index', compact('countries', 'service_codes', 'i')); //->with('i', (request()->input('page', 1) - 1) * 15);
    }

    public function store(Request $request)
    {
        request()->validate(['code' => 'required', 'place_of_service_name' => 'required', 'npi' => 'required']);
        //'title' => 'required|unique:posts|max:255',
        //'title' => ['required', 'unique:posts', 'max:255'],

        $servicecode = new Service_code();
        $servicecode->code = $request->code;
        $servicecode->place_of_service_name = $request->place_of_service_name;
        $servicecode->npi = $request->npi;
        $servicecode->nick_name = $request->nick_name;
        $servicecode->address_line1 = $request->address_line1;
        $servicecode->address_line2 = $request->address_line2;
        $servicecode->country_id = $request->country_id;
        $servicecode->state_id = $request->state_id;
        $servicecode->city_id = $request->city_id;
        $servicecode->zipcode = $request->zipcode;
        $servicecode->save();
    
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data inserted successfully',
            'records'  =>$servicecode
          ]
        );
    }

    public function show(Service_code $servicecode)  { 

        $states = $cities = array();
        if($servicecode->country_id) $states = State::where("country_id",$servicecode->country_id)->orderBy('state_name')->get(["state_name","id"]);
        if($servicecode->state_id) $cities = City::where("state_id",$servicecode->state_id)->orderBy('city_name')->get(["city_name","id"]);
           return response()->json(
          [
            'success' => 1,
            'records'  =>$servicecode,
            'states'  =>$states,
            'cities'  =>$cities
          ]
        ); 
    }

    public function update(Request $request, Service_code $servicecode)
    {
        request()->validate(['code' => 'required', 'place_of_service_name' => 'required', 'npi' => 'required']);

        $servicecode->code = $request->code;
        $servicecode->place_of_service_name = $request->place_of_service_name;
        $servicecode->npi = $request->npi;
        $servicecode->nick_name = $request->nick_name;
        $servicecode->address_line1 = $request->address_line1;
        $servicecode->address_line2 = $request->address_line2;
        $servicecode->country_id = $request->country_id;
        $servicecode->state_id = $request->state_id;
        $servicecode->city_id = $request->city_id;
        $servicecode->zipcode = $request->zipcode;
        $servicecode->save();
        Session::flash('success', 'Data updated successfully!');
        //session()->now('message', 'Success! message.');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data updated successfully',
            'records'  =>$servicecode
          ]
        );
    }

    public function destroy(Service_code $servicecode)
    {
        Service_code::where("id", $servicecode->id)->update(['is_active' => '0']);        
        $servicecode->delete();
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
        Service_code::withTrashed()->find($request->id)->restore(); 
        Service_code::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
}
