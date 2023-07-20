<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Payer_type;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PayerTypeController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:payertype-list|payertype-create|payertype-edit|payertype-delete', ['only' => ['index','show']]);
         $this->middleware('permission:payertype-create', ['only' => ['create','store']]);
         $this->middleware('permission:payertype-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payertype-delete', ['only' => ['destroy']]);
    }
    public function index()    {
        $payer_types = Payer_type::withTrashed()->paginate(5);
        $i =  (request()->input('page', 1) - 1) * 5;
        return view('masters.payertypes.index',compact('payer_types', 'i'));
    }
    
    public function get_payer_type_data(Request $request)
    {
        $payer_type = Payer_type::latest()->paginate(5);  
        return Request::ajax() ? 
                     response()->json($payer_type,Response::HTTP_OK) 
                     : abort(404);
    }
    public function create()
    {
        return view('masters.payertypes.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'payer_type_name' => 'required'
        ]);
        
        $payer_type = new Payer_type();
        $payer_type->payer_type_name = $request->payer_type_name;
        $payer_type->save();
   
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data inserted successfully',
            'records'  =>$payer_type
          ]
        );
    }

    public function show(Payer_type $payertype)
    {
        //
    }
    public function edit(Payer_type $payertype)
    {
        //
    }

    public function update(Request $request, Payer_type $payertype)
    {
        request()->validate([
            'payer_type_name' => 'required'
        ]);    
   
        $payertype->payer_type_name = $request->payer_type_name;
        $payertype->save();
        Session::flash('success', 'Data updated successfully!');
        session()->now('message', 'Success! message.');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data updated successfully',
            'records'  =>$payertype
          ]
        );

    }

    public function destroy(Payer_type $payertype)
    {
        Payer_type::where("id", $payertype->id)->update(['is_active' => '0']);        
        $payertype->delete();
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
        Payer_type::withTrashed()->find($request->id)->restore(); 
        Payer_type::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }



}
