<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\ClaimStatus;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClaimStatusController extends Controller
{
    public function index()
    {
        $claimstatuses = $this->getActiveData(new ClaimStatus(), 'claim_status');
        
        $i =  (request()->input('page', 1) - 1) * 5;
        return view('masters.claimstatuses.index', compact('claimstatuses', 'i'));
    }

    public function store(Request $request)
    {
        request()->validate(['claim_status' => 'required']);

        $claimstatuses = new ClaimStatus();
        $claimstatuses->claim_status = $request->claim_status;
        $claimstatuses->save();
    
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data inserted successfully',
            'records'  =>$claimstatuses
          ]
        );
    }

    public function update(Request $request, ClaimStatus $claimstatus)
    {
        request()->validate(['claim_status' => 'required']);

        $claimstatus->claim_status = $request->claim_status;
        $claimstatus->save();
        Session::flash('success', 'Data updated successfully!');
        //session()->now('message', 'Success! message.');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data updated successfully',
            'records'  =>$claimstatus
          ]
        );
    }

    public function destroy(ClaimStatus $claimstatus)
    {
        ClaimStatus::where("id", $claimstatus->id)->update(['is_active' => '0']);        
        $claimstatus->delete();
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
        ClaimStatus::withTrashed()->find($request->id)->restore(); 
        ClaimStatus::where("id", $request->id)->update(['is_active' => '1']); 
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
}
