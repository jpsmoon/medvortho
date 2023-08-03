<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Status;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Toastr;

class StatusController extends Controller
{
    protected $statusModel;

    public function __construct(Status $statusMod )
      {
          $this->statusModel = $statusMod;
      }

    public function index()
    {
        $statuses = $this->getAllData(new Status(), 'id');
        
        $i =  (request()->input('page', 1) - 1) * 5;
        return view('masters.statuses.index', compact('statuses', 'i'));
    }

    public function store(Request $request)
    {
        request()->validate(['status_name' => 'required', 'status_type' => 'required', 'display_order' => 'required']);
         try {
          if(isset($request->editstatus_id)){
            $this->storeStatus($request, $request->editstatus_id);
            return $this->redirectToRoute('/statuses', 'Status updated successfully', 'success', ["positionClass" => "toast-top-center"]);
          }
          else{
            $checkStatus = Status::where('status_name', $request->status_name)->where('status_type', $request->status_type)->first();
            if( $checkStatus){
              return $this->redirectToRoute('/statuses', 'This status already exist!', 'error', ["positionClass" => "toast-top-center"]);
            }
            else{
                $statuses = $this->storeStatus($request);
                return $this->redirectToRoute('/statuses', 'Status added successfully', 'success', ["positionClass" => "toast-top-center"]);
            } 
          } 
        } catch (\Exception $e) {
          return $this->redirectToRoute('/statuses',  $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
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
    public function returnStatusName($status){
      if($status == 1){
        return 'Patient';
      }elseif($status == 2){
        return 'Injury';
      }
      elseif($status == 3){
        return 'Bill';
      }
      elseif($status == 4){
        return 'Appointment';
      }
      elseif($status == 5){
        return 'Other';
      } 
      elseif($status == 6){
        return 'Appointment Bill Status';
      } 
      elseif($status == 7){
        return 'Appointment Visit Status';
      } 
      elseif($status == 8){
        return 'Task';
      } 
    }
    public function getBillStatuss(){
      $billStatus = Status::where("is_active", 1)->where("status_type", 3)->orderBy('display_order', 'ASC')->get(); 
      return $billStatus; 
    }
    public function getFilteredAlias(Request $request){
      $type = $request->statusType;
      $new = array_filter($this->statusModel->getAliaseNames(), function ($var) use ($type) {
        return ($var['type'] == $type);
    });
    //return $this->getValFromArray($new);
    return $new;
    }
    
}
