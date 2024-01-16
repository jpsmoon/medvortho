<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Country;
use Illuminate\Http\Request;
//use Symfony\Component\HttpFoundation\Response;
use Toastr;
use DB;
use DateTime;

class StateController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:state-list|state-create|state-edit|state-delete', ['only' => ['index','show']]);
         $this->middleware('permission:state-create', ['only' => ['create','store']]);
         $this->middleware('permission:state-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:state-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $states = State::join('countries', 'states.country_id', '=', 'countries.id' )
                    ->where('countries.is_active', '1')
                    ->select("states.*", "countries.country_name")->withTrashed()
                    ->get();
        $countries = Country::where('is_active', 1)->orderBy('country_name')->get();
        return view('masters.states.index',compact('states', 'countries'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $countries = Country::where('is_active', 1)->orderBy('country_name')->get();
        return view('masters.states.create', compact('countries'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'country_id' => 'required',
            'state_name' => 'required'
        ]);
        $isStateExist = DB::table('states')->where('country_id', $request->country_id)->where(DB::raw('LOWER(state_name)'), strtolower($request->state_name))->first(); 
        if($isStateExist){
            return  $this->redirectToRoute('/states', 'This state already exist', 'error', ["positionClass" => "toast-top-center"]);
        }
        else{
             $state = new State();
            $state->country_id = $request->country_id;
            $state->state_name = $request->state_name; 
            $state->save();
        }
       
    /// State::create($request->all());
        //$success = $addresses->save() ? $request->session()->flash('success', '¡Registro exitoso!') : $request->session()->flash('success', 'Ooops! Algo salio mal :(');
        //return redirect('addresses/'.$request->session()->get('customer_code'));
        return redirect()->route('states.index')
                        ->with('success','State created successfully.');
    }

    public function show(State $state)
    {
        $state = State::join('countries', 'states.country_id', '=', 'countries.id' )
                    ->where('countries.is_active', '1')
                    ->where('states.id', $state->id)
                    ->select("states.*", "countries.country_name")->first();

        return view('masters.states.show', compact('state'));
    }

    public function edit(State $state)
    {
        $countries = Country::where('is_active', 1)->orderBy('country_name')->get();
        return view('masters.states.edit', compact('state', 'countries'));
    }

    public function update(Request $request, State $state)
    {
        request()->validate([
            'country_id' => 'required',
            'state_name' => 'required'
        ]);

        $User_Update = State::where("id", $state->id)->update(['country_id' =>$request->country_id, 'state_name' =>$request->state_name]);
        //$state->update($request->all());

        return redirect()->route('states.index')
                        ->with('success','State updated successfully');
    }

    public function destroy(State $state)
    {
        //var_dump($state); die();
        State::where("id", $state->id)->update(['is_active' => '0']);
        $state->delete();

        return redirect()->route('states.index')
                        ->with('success','State deleted successfully');
    }

    public function restore(Request $request)
    {
        //$id = $request->id;

        State::withTrashed()->find($request->id)->restore();
        $updateuser = State::where("id", $request->id)->update(['is_active' => '1']);
        return redirect()->route('states.index')
                         ->with('success','State Restore successfully');
    }

    public function getStatesByCountry(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->orderBy('state_name')->get(["state_name","id"]);
        return response()->json($data);
    }
    public function destroyState(State $state, Request $request)
    {
        //var_dump($state); die();
        State::where("id", $request->id)->update(['is_active' => '0']);
        $state->delete();

        return redirect()->route('states.index')
                        ->with('success','State deleted successfully');
    }
}
