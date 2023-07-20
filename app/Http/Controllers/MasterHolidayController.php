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
        $this->middleware('permission:Patient-list|Patient-create|Patient-edit|Patient-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:Patient-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Patient-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Patient-delete', ['only' => ['destroy']]);
        $this->patientModel = $patientMod;
    }
    public function index(Request $request)
    {
        $holidays =  MasterHoliday::where('is_active', 1)->get();
       return view('masters.holidays.index', compact(['holidays']));
    }
    public function storeHoliday(Request $request)
    {
       try {
            DB::beginTransaction();
                $this->saveMasterHoliday($request);
            DB::commit();
            $msg = 'Holiday added successfully';
            if(isset($request->holiday_id)){
                $msg = 'Holiday updated successfully';
            }
            return  $this->redirectToRoute('/master/holidays', $msg, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
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
}
