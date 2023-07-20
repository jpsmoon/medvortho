<?php

namespace App\Http\Controllers;

use App\Models\{Country,State,City,ZipCityState,Zipcode, BillReferingOrderProvider};
use Illuminate\Http\Request;

class CityController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:city-list|city-create|city-edit|city-delete', ['only' => ['index','show']]);
         $this->middleware('permission:city-create', ['only' => ['create','store']]);
         $this->middleware('permission:city-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:city-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
       $cities = Zipcode::where('is_active',1)->take(500)->get();
       // $cities = Zipcode::where('is_active',1)->get();

        //var_dump($cities);
        return view('masters.cities.index',compact('cities'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        //$countries = Country::where('is_active', 1)->orderBy('country_name')->get();

        $masterData = $this->showStateCityCountry();
        $states = $masterData['states'];
        $countries = $masterData['countris'];
        return view('masters.cities.create', compact('countries'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city_name' => 'required'
        ]);
       $stateInfo =  Zipcode ::where('state_code',$request->state_id)->first();
        $stateName = null;
        if($stateInfo){
            $stateName = $stateInfo['state_name'];
        }
        $city = new Zipcode();
        $city->country_name = $request->country_id;
        $city->state_code = $request->state_id;
        $city->state_name = $stateName;
        $city->city_name = $request->city_name;
        $city->zip_code = $request->zip_code;
        $city->save();
        return redirect()->route('cities.index')
                        ->with('success','City created successfully.');
    }

    public function show(City $city)
    {
        //
    }

    public function edit(Zipcode $city)
    {
        $masterData = $this->showStateCityCountry();
        $states = $masterData['states'];
        $countries = $masterData['countris'];

        $city = Zipcode::where('id', $city->id)->first();

        return view('masters.cities.edit', compact('city', 'states', 'countries'));
    }

    public function update(Request $request, Zipcode $city)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        request()->validate([
            'country_id' => 'required',
            'state_id' => 'required',
            'city_name' => 'required'
        ]);

        //City::where("id", $city->id)->update(['state_id' =>$request->state_id, 'city_name' =>$request->city_name]);
        $stateInfo =  Zipcode ::where('state_code',$request->state_id)->first();
        $stateName = null;
        if($stateInfo){
            $stateName = $stateInfo['state_name'];
        }
        $city = Zipcode::where('id', $city->id)->first();
        $city->state_code = $request->state_id;
        $city->state_name = $stateName;
        $city->city_name = $request->city_name;
        $city->zip_code = $request->zip_code;
        $city->update();
        return redirect()->route('cities.index')
                        ->with('success','City updated successfully');
    }

    public function destroy(City $city)
    {
        City::where("id", $city->id)->update(['is_active' => '0']);
        $city->delete();

        return redirect()->route('cities.index')
                        ->with('success','City deleted successfully');
    }

    public function restore(Request $request)
    {
        City::withTrashed()->find($request->id)->restore();
        City::where("id", $request->id)->update(['is_active' => '1']);
        return redirect()->route('cities.index')
                         ->with('success','City Restore successfully');
    }

    public function getCitiesByState(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->orderBy('city_name')->get(["city_name","id"]);
        return response()->json($data);
    }
    public function getCitiesStateByZipCode(Request $request){
        $zipCode = $request->zipCode;
        $zipInfo = ZipCityState::where('zip_code',$zipCode)->first();
        return response()->json($zipInfo);

    }
    public function getStateByCountry(Request $request)
    {
        $countryName = $request->country_id;
        $data['states'] =  Zipcode::select('state_code','state_name')
        ->where('country_name',$countryName)->distinct()->get();
        return response()->json($data);
    }
    public function getCityByStateCode(Request $request)
    {
        $state_name = $request->state_name;
        $data['cities'] =  Zipcode::select('city_name','state_code')->where('state_name',$state_name)->distinct()->get();
        return response()->json($data);
    }

}
