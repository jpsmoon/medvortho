<?php

namespace App\Http\Controllers;

use App\Models\{Country,State,City,ZipCityState,Zipcode, BillReferingOrderProvider};
use Illuminate\Http\Request;
use Toastr;
use DB;
use DateTime;

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
       $cities = Zipcode::where('state_code','CA')->take(1000)->get();
       //$cities = Zipcode::where('is_active',1)->where('state_code','CA')->take(500)->get();

       $masterData = $this->showStateCityCountry();
       //$states = $masterData['states'];
       $countries = $masterData['countris'];

       $states =  Zipcode::select('state_code','state_name')
        ->where('country_name','United States')->distinct()->get();


        return view('masters.cities.index',compact(['cities', 'states' , 'countries']))
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
        $isCityExist = DB::table('zipcodes')->where('country_name', $request->country_id)->where('state_code', $request->state_id)
        ->where(DB::raw('LOWER(city_name)'), strtolower($request->city_name))->where('zip_code', $request->zip_code)->first(); 
        if($isCityExist){
            return  $this->redirectToRoute('/cities', 'This city already exist', 'error', ["positionClass" => "toast-top-center"]);
        }
        else{
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
            
        }
       
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
    public function getCities(Request $request){
       
            ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Zipcode::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Zipcode::select('count(*) as allcount')->where('city_name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Zipcode::orderBy($columnName,$columnSortOrder)
        ->where('city_name', 'like', '%' .$searchValue . '%')
        ->select('*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($records as $record){
            $id                     = $record->id;
            $country_name           = $record->country_name; 
            $state_name             = $record->state_name; 
            $name                   = $record->city_name;
            $zip_code               = $record->zip_code;
            $status               = $record->is_active ? 'Active' : 'Block';

            // Update Button
     $updateButton = "<i class='icon-pencil showPointer' data-id='".$record['id']."' data-toggle='modal' data-target='#editModalCity' onclick='getCityById($record->id)'></i>";

     // Delete Button
     $deleteButton = "<i class='icon-trash showPointer' data-id='".$record['id']."' onclick='deleteCity($record->id)'></i>";

     $action = $updateButton." ".$deleteButton;

            $data_arr[] = array(
            "id" => $id,
            "country_name" => $country_name,
            "state_name" => $state_name,
            "city_name" => $name,
            "zip_code" => $zip_code,
            "status" => $status,
            "action" => ($record->is_active == 1) ? $action :''
            ); 
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
    }
    public function deleteCity(Zipcode $zipCode, Request $request)
    {
        Zipcode::where("id", $request->id)->update(['is_active' => '0']);
        $zipCode->delete();

        return redirect()->route('cities.index')
                        ->with('success','City deleted successfully');
    }
    public function getCityById(Request $request){
         $zipInfo = Zipcode::where('id',$request->id)->first();
        return response()->json($zipInfo); 
    }
    public function updateCity(Request $request, Zipcode $city)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        // request()->validate([
        //     'country_id' => 'required',
        //     'state_id' => 'required',
        //     'city_name' => 'required'
        // ]);

        //City::where("id", $city->id)->update(['state_id' =>$request->state_id, 'city_name' =>$request->city_name]);
        $stateInfo =  Zipcode ::where('state_code',$request->state_id)->first();
        $stateName = null; $stateCode = null;
        if($stateInfo){
            $stateName = $stateInfo['state_name']; 
            $stateCode = $stateInfo['state_code']; 
        }
        $city = Zipcode::where('id', $request->id)->first();
        $city->state_code = $stateCode;
        $city->state_name = $stateName;
        $city->city_name = $request->city_name;
        $city->zip_code = $request->zip_code;
        $city->update();

        return redirect()->route('cities.index')
                        ->with('success','City updated successfully');
    }
    public function getCitiesStateByZipCode(Request $request){
        $zipCode = $request->zipCode;
        $zipInfo = Zipcode::where('zip_code',$zipCode)->where('is_active', 1)->first();
        return response()->json($zipInfo); 
    }
    public function getCityListByState(Request $request)
    {
        $stateName = $request->country_id;
        $data['states'] =  Zipcode::where('country_name',$countryName)->distinct()->get();
        return response()->json($data);
    }
}