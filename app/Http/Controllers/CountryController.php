<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Country;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:country-list|country-create|country-edit|country-delete', ['only' => ['index','show']]);
         $this->middleware('permission:country-create', ['only' => ['create','store']]);
         $this->middleware('permission:country-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:country-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $countries = Country::latest()->withTrashed()->paginate(5);
        $i =  (request()->input('page', 1) - 1) * 5;
        return view('masters.countries.index',compact('countries', 'i'));
    }

    public function create()
    {
        //
        return view('masters.countries.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'country_name' => 'required'
        ]);

        $country = new Country();
        $country->country_name = $request->country_name;
        $country->save();
        return redirect()->route('countries.index')
        ->with('success','Country added successfully');
    }

    public function show(Country $country)
    {
        //
    }

    public function edit(Country $country)
    {
       return view('masters.countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        request()->validate([
            'country_name' => 'required'
        ]);

        $country->country_name = $request->country_name;
        $country->save();
        // Session::flash('success', 'Data updated successfully!');
        // session()->now('message', 'Success! message.');
        // return response()->json(
        //   [
        //     'success' => 1,
        //     'message' => 'Data updated successfully',
        //     'records'  =>$country
        //   ]
        // );
        return redirect()->route('countries.index')
        ->with('success','Country updated successfully');
    }

    public function destroy(Country $country)
    {
        Country::where("id", $country->id)->update(['is_active' => '0']);
        $country->delete();
        return redirect()->route('countries.index')
        ->with('success','Country blocked successfully');
    }

    public function restore(Request $request)
    {
        Country::withTrashed()->find($request->id)->restore();
        $updateuser = Country::where("id", $request->id)->update(['is_active' => '1']);
        return redirect()->route('countries.index')
                         ->with('success','Country Restore successfully');

    }
}
