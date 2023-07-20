<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Status;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = $this->getAllData(new Status(), 'display_order');
        
        $i =  (request()->input('page', 1) - 1) * 5;
        return view('masters.statuses.index', compact('statuses', 'i'));
    }

    public function store(Request $request)
    {
        request()->validate(['status_name' => 'required', 'display_order' => 'required']);

        $statuses = $this->storeStatus($request);
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data inserted successfully',
            'records'  =>$statuses
          ]
        );
    }

    public function update(Request $request, Status $status)
    {
        request()->validate(['status_name' => 'required', 'display_order' => 'required']);

        $this->storeStatus($request, $status->id);
        Session::flash('success', 'Data updated successfully!');
        //session()->now('message', 'Success! message.');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data updated successfully',
            'records'  =>$status
          ]
        );
    }

    public function destroy(Status $status)
    {
        $this->deleteRow(Status::class, $status->id);
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
        $this->restoreRow(Status::class, $request->id);
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }
}
