<?php

namespace App\Http\Controllers;

use App\Models\{BillingProvider, Patient, BillingProviderHoliday,  MasterHoliday  };
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session; 
    use Toastr;
    use DB;
    use DateTime;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;

class MasterHolidayController extends Controller
{
    //
    protected $patientModel;
    public function __construct(Patient $patientMod )
    {
        $this->middleware('permission:patient-list|patient-create|patient-edit|patient-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:patient-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patient-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patient-delete', ['only' => ['destroy']]);
        $this->patientModel = $patientMod;
    }
    public function index(Request $request)
    {
        $holidays =  MasterHoliday::where('is_active', 1)->get();
       return view('masters.holidays.index', compact(['holidays']));
    }
    public function storeHoliday(Request $request)
    {
       //try {
            DB::beginTransaction();
                $this->saveMasterHoliday($request);
            DB::commit();
            $msg = 'Holiday added successfully';
            if(isset($request->holiday_id)){
                $msg = 'Holiday updated successfully';
            }
            return  $this->redirectToRoute('/master/holidays', $msg, 'success', ["positionClass" => "toast-top-center"]);
       // } 
        //catch (\Exception $e) 
        //{
        //      DB::rollback(); 
        //     return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        // }
    }
    public function deleteHoliday(Request $request)
    {
       try {
            DB::beginTransaction();
             $this->deleteRow(new MasterHoliday(), $request->id); 
            DB::commit();
           $msg = 'Holiday deleted successfully'; 
           return  $this->redirectToRoute('/master/holidays', $msg, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function checkHolidayForAppointment(Request $request){
        try {
            $newDateStatus = 0;
            $rDate = '';
            if(isset($request->rDate)){
                $rDate = date("Y-m-d", strtotime($request->rDate));
            }
            //$providerid = $request->providerid;
            $holiday =  MasterHoliday::where('holiday_date', $rDate)->where('is_active', 1)->first();
            if($holiday){ 
                return  array('status' => 2, 'holiday' => $holiday->holiday_name, 'hType' => ($holiday->holiday_type == 1) ?  'gazetted' : 'restricted' , 'locations' => []);
                // $providerHoliday = BillingProviderHoliday::where('holiday_id', $holiday->id)->where('billing_provider_id', $providerid)->first();
                // if($providerHoliday){
                //     $providerLocations = [];
                //     if($providerHoliday->getLocation){
                //         $providerLocations[] =  $providerHoliday->getLocation;
                //     }
                //     return  array('status' => 1, 'holiday' => $holiday->holiday_name, 'hType' => ($holiday->holiday_type == 1) ?  'gazetted' : 'restricted' , 'locations' => $providerLocations);
                // }
                // else{
                //     return  array('status' => 2, 'holiday' => $holiday->holiday_name, 'hType' => ($holiday->holiday_type == 1) ?  'gazetted' : 'restricted' , 'locations' => []);
                // }
            }
            else{
                    return  array('status' => 1, 'holiday' => null, 'hType' => null, 'locations' => []);
            }

        } catch (\Exception $e) {
           return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
       }
    }
}
