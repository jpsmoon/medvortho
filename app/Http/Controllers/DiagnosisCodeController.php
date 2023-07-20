<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Diagnosis_code;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiagnosisCodeController extends Controller
{
    
    public function index()
    {
        $diagnosis_codes = Diagnosis_code::withTrashed()->paginate(15);
        //var_dump($diagnosis_codess); die();
        return view('masters.diagnosiscodes.index', compact('diagnosis_codes'))->with('i', (request()->input('page', 1) - 1) * 15);
    }
        
    public function store(Request $request)
    {
        request()->validate(['diagnosis_name' => 'required', 'diagnosis_code' => 'required']);

        $diagnosis_codes = new Diagnosis_code();
        $diagnosis_codes->diagnosis_name = $request->diagnosis_name;
        $diagnosis_codes->diagnosis_code = $request->diagnosis_code;
        $diagnosis_codes->save();
    
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data inserted successfully',
            'records'  =>$diagnosis_codes
          ]
        );
    }
        
    public function edit(Diagnosis_code $diagnosis_code){ }
    
    public function update(Request $request, Diagnosis_code $diagnosiscode)
    {
        request()->validate(['diagnosis_name' => 'required', 'diagnosis_code' => 'required']); 

        $diagnosiscode->diagnosis_name = $request->diagnosis_name;
        $diagnosiscode->diagnosis_code = $request->diagnosis_code;
        $diagnosiscode->save();
        Session::flash('success', 'Data updated successfully!');
        //session()->now('message', 'Success! message.');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data updated successfully',
            'records'  =>$diagnosiscode
          ]
        );
    }

    
    public function destroy(Diagnosis_code $diagnosiscode)
    {
        Diagnosis_code::where("id", $diagnosiscode->id)->update(['is_active' => '0']);        
        $diagnosiscode->delete();
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
        Diagnosis_code::withTrashed()->find($request->id)->restore(); 
        Diagnosis_code::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
}
