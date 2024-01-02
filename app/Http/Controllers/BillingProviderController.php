<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\LOWER;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BillingPracticeChargeImport;

use App\Models\{BillSecondSbr, WriteOffReason, Role, Task, Status, BillingProviderHoliday, MasterHoliday, BillingProviderRecurrence, AppointmentReason, BillingProviderChargeProcedureCode, BillingProviderCharge,City,State, BillReferingOrderProvider,BillingProvider, Taxonomy_code, User,BillPlaceService, 
    PlaceOfServiceCode,PlaceOfServices, MasterPlaceOfService, RequestingPhysician,MasterSpecility, PractceLocation, PracticeContact,
    MasterProviderCharge, BillModifier, InjuryBill, Patient_injury};

class BillingProviderController extends Controller
{
    protected $bPModel;
    public function __construct(BillingProvider $billProviderMod )
    {
        $this->middleware('permission:billing-provider-list|billing-provider-create|billing-provider-edit|billing-provider-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:billing-provider-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:billing-provider-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:billing-provider-delete', ['only' => ['destroy']]);
        $this->bPModel = $billProviderMod;
    }
    
    public function index()
    {
        $states = State::where('is_active', 1)->orderBy('state_name')->get();
        $billingproviders = BillingProvider::withTrashed()->paginate(15);      //
        $i =  (request()->input('page', 1) - 1) * 5;
        //var_dump($billingproviders); die();
        return view('masters.billingproviders.index', compact('states', 'billingproviders', 'i'));
    }

    public function create()
    {
        $masterData = $this->showStateCityCountry();
        $states = $masterData['states'];
        $id = Auth::user()->id;
         $users = User::where('created_by', $id)->orderBy('name')->get();
        if ($users && count($users) == 0){
             $users = User::where('id', $id)->orderBy('name')->get();
        } 
        //dd($users);
        return view('masters.billingproviders.create', compact('states','users'));
    }

    public function store(Request $request)
    {
        request()->validate(['injury_state_id' => 'required', 'bill_type' => 'required', 'provider_type' => 'required', 'tax_id' => 'required', 'npi' => 'required', 'name' => 'required', 'contact_no' => 'required', 'address_line1' => 'required', 'city_id' => 'required', 'state_id' => 'required', 'zipcode' => 'required']);

        $billing_providers = new BillingProvider();
        $billing_providers->injury_state_id = $request->injury_state_id;
        $billing_providers->bill_type = $request->bill_type;
        $billing_providers->provider_type = $request->provider_type;
        $billing_providers->npi = $request->npi;
        $billing_providers->tax_id = $request->tax_id;
        $billing_providers->npi = $request->npi;
        $billing_providers->name = $request->name;
        $billing_providers->nick_name = $request->nick_name;
        $billing_providers->contact_no = $request->contact_no;
        $billing_providers->fax_no = $request->fax_no;
        $billing_providers->address_line1 = $request->address_line1;
        $billing_providers->address_line2 = $request->address_line2;
        $billing_providers->state_id = $request->state_id;
        $billing_providers->city_id = $request->city_id;
        $billing_providers->zipcode = $request->zipcode;
        $billing_providers->dol_no = $request->dol_no;
        $billing_providers->payto_address_line1 = $request->payto_address_line1;
        $billing_providers->payto_address_line2 = $request->payto_address_line2;
        $billing_providers->payto_state_id = $request->payto_state_id;
        $billing_providers->payto_city_id = $request->payto_city_id;
        $billing_providers->payto_zipcode = $request->payto_zipcode;
        $billing_providers->save();

        // return redirect()->route('billingproviders.index')->with('success','Billing Provider created successfully.');

        $message= 'Billing Provider created successfully.';
        $toastr_title=trans('messages.toastr_success');
        Toastr::success($message,'',["positionClass" => "toast-top-center"]);
        return redirect('billingproviders.index');
    }

    public function show(BillingProvider $billingprovider) { }

    public function edit(BillingProvider $billingprovider)
    {
        $masterData = $this->showStateCityCountry();

        $states = $masterData['states'];

        $cities = $payto_cities = array();
        // if($billingprovider->state_id){
        //     $cities = City::where('is_active', 1)->where('state_id', $billingprovider->state_id)->orderBy('city_name')->get();
        // }
        // if($billingprovider->payto_state_id){
        //     $payto_cities = City::where('is_active', 1)->where('state_id', $billingprovider->payto_state_id)->orderBy('city_name')->get();
        // }
        return view('masters.billingproviders.edit', compact('billingprovider', 'states', 'cities', 'payto_cities'));
    }

    public function update(Request $request, BillingProvider $billingprovider)
    {
        request()->validate(['injury_state_id' => 'required', 'bill_type' => 'required', 'provider_type' => 'required', 'tax_id' => 'required', 'npi' => 'required', 'name' => 'required', 'contact_no' => 'required', 'address_line1' => 'required', 'city_id' => 'required', 'state_id' => 'required', 'zipcode' => 'required']);

        $updateArr = array(
            'injury_state_id' => $request->injury_state_id,
            'bill_type' => $request->bill_type,
            'provider_type' => $request->provider_type,
            'npi' => $request->npi,
            'tax_id' => $request->tax_id,
            'name' => $request->name,
            'nick_name' => $request->nick_name,
            'contact_no' => $request->contact_no,
            'fax_no' => $request->fax_no,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'zipcode' => $request->zipcode,
            'dol_no' => $request->dol_no,
            'payto_address_line1' => $request->payto_address_line1,
            'payto_address_line2' => $request->payto_address_line2,
            'payto_state_id' => $request->payto_state_id,
            'payto_city_id' => $request->payto_city_id,
            'payto_zipcode' => $request->payto_zipcode
        );

        BillingProvider::where("id", $billingprovider->id)->update($updateArr);
        return redirect()->route('billingproviders.index')
                        ->with('success','Billing Provider updated successfully');
    }

    public function destroy(BillingProvider $billingprovider)
    {
        BillingProvider::where("id", $billingprovider->id)->update(['is_active' => '0']);
        $billingprovider->delete();
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
        BillingProvider::withTrashed()->find($request->id)->restore();
        BillingProvider::where("id", $request->id)->update(['is_active' => '1']);
        Session::flash('success', 'Data restore successfully!');
        return response()->json(
          [
            'success' => 1,
            'message' => 'Data restore successfully'
          ]
        );
    }

    public function getReferingOrderProvider(Request $request)
    {
        $type = $request->type;
        $billingProvider = null;
        $injury = Patient_injury:: where('id',$request->injuryId)->first();
        if($injury){
            if($injury->patient){
                $billingProvider  = $injury->patient->billing_provider_id;
            }
        }
    $billRef  = BillReferingOrderProvider::with('state','taxonomyCode')->where('is_active',1);
        if($billingProvider != null){
            $billRef =  $billRef->where('billing_provider_id',$billingProvider);
        }
        $billRef = $billRef->where('type',$type);
        $data =  $billRef->get();
        return response()->json($data);
    }
    public function billingRendering(Request $request)
    {
        $id = $request->id;
        $rendering = BillReferingOrderProvider::with('state','taxonomyCode')->where('type',4)->where('billing_provider_id',$id)->orderBy('id', 'desc')->get();
        
        $bRenderings = (count($rendering) > 0 ) ? $rendering : [];
        return view('billingprocess.billRendering.index',compact('bRenderings','id'));
    }
    
    
    
    public function viewBillingRendering(Request $request)
    {
        $id = $request->id;

        $bRenderings = BillReferingOrderProvider::with('state','taxonomyCode')->where('id',$id)->orderBy('id', 'desc')->first();
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];

        return view('billingprocess.billRendering.show',compact('bRenderings','id','states'));
    }
    
    public function viewBillingReferring(Request $request)
    {
        $id = $request->id;
        //echo $id; exit;
        $bReferrings = BillReferingOrderProvider::where('type', "!=", null)->where('billing_provider_id',$id)->orderBy('id', 'desc')->first();
       
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];

        return view('billingprocess.billReffering.show',compact('bReferrings','id','states'));
    }
    
    public function viewBillingProvider(Request $request){
        $id = $request->id;
        $billingProviders = BillingProvider::where('id',$id)->orderBy('id', 'desc')->first();
        return view('billingprocess.setting.show',compact('billingProviders'));
    }
    public function editBillingProvider(Request $request){
        $id = $request->id;
        $billingprovider = BillingProvider::where('id',$id)->first();
        $masterData = $this->showStateCityCountry();
        $states = $masterData['states'];
        $userId = Auth::user()->id;
       $users = User::where('created_by', $userId)->orderBy('name')->get();
        if ($users && count($users) == 0){
             $users = User::where('id', $userId)->orderBy('name')->get();
        }
       //dd($users);exit;
       $editUsers = [];
       if(strpos($billingprovider->professional_user_with_access, ',') !== FALSE) {
        $editUsers = explode(',',$billingprovider->professional_user_with_access);
       }
        return view('masters.billingproviders.edit',compact('billingprovider','id','states','users','editUsers'));
    }

public function placesOfServices(Request $request)
    {
        $providerId = $request->providerId;
        $id = null;
        $placeOfService = MasterPlaceOfService::where('billing_provider_id',$providerId)->orderBy('id', 'desc')->get();
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];

        return view('billingprocess.placesService.index',compact('placeOfService','id','states','providerId'));
    }

    public function storeBillOfServices(Request $request)
    {
        try {
                $id = ($request->placeOfServiceId) ? $request->placeOfServiceId : null;
                $this->storeBillPlaceOfService($request,$id);
                if($id != null){
                    $message= 'Bill place of services updated successfully';
                }
                else{
                    $message= 'Bill place of services created successfully';
                }
                
                $toastr_title=trans('messages.toastr_success');
                Toastr::success($message,'',["positionClass" => "toast-top-center"]);

                return redirect('places-of-service/' . $request->billingProviderId);
            } catch (\Exception $e) {
                $message= $e->getMessage();
                $toastr_title=trans('messages.toastr_error');
                Toastr::error($message,'',["positionClass" => "toast-top-center"]);
                return redirect()->back();
            }
    }

    public function viewPlacesOfServices(Request $request)
    {
        $id = $request->serviceId;
        $placeOfService = MasterPlaceOfService::with('placeOfServiceCode')->where('id',$id)->orderBy('id', 'desc')->first();
       // dd($placeOfService);
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];

        return view('billingprocess.placesService.show',compact('placeOfService','id','states'));
    }
    
    public function addPlacesOfServices(Request $request)
    {
        $providerId = $request->providerId;
        $bPlaceService = [];
        $id = $request->id;
        $title = 'Add Place of Service';
        
        if($id != null){
            $title = 'Edit Place of Service'; 
            $placeService = MasterPlaceOfService::with('placeOfServiceCode')->where('id',$id)->where('billing_provider_id',$providerId)->orderBy('id', 'desc');
            $bPlaceService =  $placeService->first();
        }
       
        //dd($bPlaceService);
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        $placeOfServiceCOde = PlaceOfServiceCode::where('status',1)->get();
        return view('billingprocess.placesService.create',compact('title','bPlaceService','providerId','id','states','placeOfServiceCOde'));
    } 
    
     
    
     public function addRfaTemplate(Request $request)
    {
        $providerId = $request->providerId;
        $id = $request->id;
        $title = 'Add Place of Service';
        if($id != null){
            $title = 'Edit Place of Service'; 
        }
        $placeService = MasterPlaceOfService::with('placeOfServiceCode')->where('billing_provider_id',$providerId);
        if($id != null){
            $placeService = $placeService->where('id',$id);
        }
        $placeService = $placeService->orderBy('id', 'desc');
        $bPlaceService =  $placeService->first();

        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        $placeOfServiceCOde = PlaceOfServiceCode::where('status',1)->get();
        return view('billingprocess.rfaSettings.rfaTemplates.create',compact('title','bPlaceService','providerId','id','states','placeOfServiceCOde'));
    } 
    
    public function billingReferring(Request $request)
    {
        $id = $request->id;
        $rendering = BillReferingOrderProvider::with('state','taxonomyCode')->where('billing_provider_id',$id)->where('type',"!=", 1)->orderBy('id', 'desc')->get();
        $bRenderings = (count($rendering) > 0 ) ? $rendering : [];
        return view('billingprocess.billReffering.index',compact('bRenderings','id'));
    }
    public function createBillingReferring(Request $request)
    {
        $providerId = $request->providerId; 
        $bRenderings = [];
        $id = $request->id;
        $taxonomy_codes = Taxonomy_code::where('is_active', 1)->orderBy('name')->orderBy('code')->get();
        if($id != null){
            $bRenderings = BillReferingOrderProvider::with('state','taxonomyCode')->where('id',$id)->where('billing_provider_id',$providerId)->first();
        }
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        return view('billingprocess.billReffering.create',compact('bRenderings','providerId','id','states','taxonomy_codes'));
    }
    public function viewBillingCharge(Request $request)
    {
        $providerId = $request->providerId; 
        $id = $request->id;
        $bRenderings = [];
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        return view('billingprocess.charges.index',compact('id','states','bRenderings','providerId'));
    } 
    
    public function requestingPhysicians(Request $request)
    {
        $bRenderings = [];
        $providerId = $request->providerId;
        $id =  $request->id;
        $bRenderings = RequestingPhysician::with('getSpecility')->where('billing_provider_id',$providerId)->get();
        //dd($bRenderings);
        return view('billingprocess.rfaSettings.requestingPhysicians.index', compact('id','bRenderings','providerId'));
    }
    public function addRfaRequestingPhysicians(Request $request)
    {
        $providerId = $request->providerId;
        $id = null;
        $title = 'Add Requesting Physician Information';
        if($id != null){
            $title = 'Edit Requesting Physician Information'; 
        }
        $masterSpecility = MasterSpecility::where('is_active',1)->orderBy('id', 'desc')->get();
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        $placeOfServiceCOde = PlaceOfServiceCode::where('status',1)->get();
        return view('billingprocess.rfaSettings/requestingPhysicians.create',compact('masterSpecility','title','providerId','id','states','placeOfServiceCOde'));
    }
    public function savePhysicianSetting(Request $request)
    {
       try {
            $id = ($request->physicianId) ? $request->physicianId : null;
            $billingProviderId = ($request->billingProviderId) ? $request->billingProviderId : null;

                $this->storeRequestingPhysician($request,$id);
                if($request->physicianId != null){
                    $message= 'Requesting Physician updated successfully';
                }
                else{
                    $message= 'Requesting Physician created successfully';
                }
                
                $toastr_title=trans('messages.toastr_success');
                Toastr::success($message,'',["positionClass" => "toast-top-center"]);

            return redirect('list/rfa/requesting/physicians/' . $request->billingProviderId);
        } catch (\Exception $e) {
                $message= $e->getMessage();
                $toastr_title=trans('messages.toastr_error');
                Toastr::error($message,'',["positionClass" => "toast-top-center"]);
                return redirect()->back();
        }
    }
    public function practiceLocation(Request $request)
    {
        $bRenderings = [];
        $providerId = $request->providerId;
        $id =  $request->id;
        $bRenderings = PractceLocation::with('getBillingProvider')->where('billing_provider_id',$providerId)->get();
        //dd($bRenderings);
        return view('billingprocess.rfaSettings/practiceLocations.index', compact('id','bRenderings','providerId'));
    }
    public function addRfaPracticeLocations(Request $request)
    {
        $providerId = $request->providerId;
        $id = null;
        $billingProvider = BillingProvider::where('id',$providerId)->first();
        $practiceLocation = PractceLocation::with('getBillingProvider')->where('billing_provider_id',$providerId)->first();
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        $placeOfServiceCOde = PlaceOfServiceCode::where('status',1)->get();
        return view('billingprocess.rfaSettings/practiceLocations.create',compact('billingProvider','practiceLocation','providerId','id','states','placeOfServiceCOde'));
    }
    public function storePracticeLocation(Request $request)
    {
        //try {
            $id = ($request->practiceLocationId) ? $request->practiceLocationId : null;
                $this->savePracticeLocation($request,$id);
                if($id != null){
                    $message= 'Practice location updated successfully';
                }
                else{
                    $message= 'Practice location created successfully';
                }
                
                $toastr_title=trans('messages.toastr_success');
                Toastr::success($message,'',["positionClass" => "toast-top-center"]);

            return redirect('/list/rfa/practice/locations/' . $request->billingProviderId);
        // } catch (\Exception $e) {
        //         $message= $e->getMessage();
        //         $toastr_title=trans('messages.toastr_error');
        //         Toastr::error($message,'',["positionClass" => "toast-top-center"]);
        //         return redirect()->back();
        // }
    } 
    public function practiceContactList(Request $request)
    {
        $practicecontacts = [];
        $providerId = $request->providerId;
        $id =  $request->id;
        $practicecontacts = PracticeContact::with('getBillingProvider')->where('billing_provider_id',$providerId)->get();
       // dd($practicecontacts);
        return view('billingprocess.rfaSettings/practiceContacts.index', compact('id','practicecontacts','providerId'));
    }
    
    public function viewPracticeContact(Request $request)
    {
        $practicecontacts = [];
        $providerId = $request->providerId;
        $id =  $request->id;
        $practicecontacts = PracticeContact::with('getBillingProvider')->where('billing_provider_id',$providerId)->get();
       // dd($practicecontacts);
        return view('billingprocess.rfaSettings/practiceContacts.show', compact('id','practicecontacts','providerId'));
    }
    
    public function storeBillingProviderCharge(Request $request){
        try {
                $id = ($request->chargeId) ? $request->chargeId : null;
                $billingProviderId = ($request->billingProviderId) ? $request->billingProviderId : null;
                $this->saveBillingProviderCharge($request,$id);
                $toastr_title=trans('messages.toastr_success');
                Toastr::success('Billing Provider charge Add Successfully','',["positionClass" => "toast-top-center"]);

            return redirect('setting/billing/provider/charge/add/' . $billingProviderId);
        } catch (\Exception $e) {
                $message= $e->getMessage();
                $toastr_title=trans('messages.toastr_error');
                Toastr::error($message,'',["positionClass" => "toast-top-center"]);
                return redirect()->back();
        }
    }
 
    
    
    
    public function deleteProcedureCode(Request $request, $id)
    {
        try {
            $checkModify = BillingProviderChargeProcedureCode::where('id', $id)->first();
            if($checkModify){
                $checkModify->status = '0';
                $checkModify->update();
            }
            $message= 'Practice charge deleted Successfully';
            $toastr_title=trans('messages.toastr_success');
            Toastr::success($message,'',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        } catch (\Exception $e) {
            $message= $e->getMessage();
            $toastr_title=trans('messages.toastr_error');
            Toastr::error($message,'',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    } 
    
    public function createCmsForm(Request $request)
    {
        
        $providerId = $request->providerId;
         $id =  $request->id; $renderings = []; $bRenderings = [];
        $rProvider = BillReferingOrderProvider::with('state','taxonomyCode')->where('billing_provider_id',$providerId)->orderBy('id', 'desc')->get();
        foreach($rProvider as $refering){
            if($refering->type == 4){
                $renderings[] = $refering;
            }
            if($refering->type == 1){
                $bRenderings[] = $refering;
            }
        }
        $placeOfServices = MasterPlaceOfService::where('billing_provider_id',$providerId)->orderBy('id', 'desc')->get();
        $cmsform = PracticeContact::with('getBillingProvider')->where('billing_provider_id',$providerId)->get();
        $masterData = $this->showStateCityCountry();
        $states = $masterData['states'];
        return view('billingprocess/cmsForm1500.index', compact('bRenderings','id','cmsform','providerId','renderings', 'placeOfServices', 'states'));
    } 
    
    public function settingCharge(Request $request)
    {
        $chargeId = $request->chargeId; 
        $providerId = $request->providerId; 
        $checkMasterCharge = BillingProviderCharge::with('getChargesProcedureCode')->where('id',$chargeId)->where('provider_id',$providerId)->first();
        $modifiersArray = BillModifier::where('status', 1)->get();
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        return view('billingprocess.charges.show',compact('providerId','states','chargeId','checkMasterCharge', 'modifiersArray'));
    } 
    public function saveProcedureCode(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        $id = ($request->chargeId) ? $request->chargeId : null;
        try {
            $this->addProcedureCode($request);
            if($id != null){
                $message= 'Practice charge Updated Successfully';
            }
            else{
                $message= 'Practice Provider charge Add Successfully';
            }
            $toastr_title=trans('messages.toastr_success');
            Toastr::success($message,'',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        } catch (\Exception $e) {
            $message= $e->getMessage();
            $toastr_title=trans('messages.toastr_error');
            Toastr::error($message,'',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }  
    public function addPracticeContact(Request $request)
    {
        $providerId = $request->providerId; $bPracticeContact = null;
        $id = $request->id;
        $title = 'Add Practice Contact';
         
        if($id != null){
        $title = 'Edit Practice Contact'; 
        $bPracticeContact = PracticeContact::where('billing_provider_id',$providerId)->where('id',$id)->first(); 
        } 

        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        $placeOfServiceCOde = PlaceOfServiceCode::where('status',1)->get();
        return view('billingprocess.rfaSettings.practiceContacts.create',compact('title','bPracticeContact','providerId','id','states','placeOfServiceCOde'));
    } 
    public function savePracticeContact(Request $request)
    {
        try {
            $id = ($request->id) ? $request->id : null;
            $billingProviderId = ($request->billing_provider_id) ? $request->billing_provider_id : null;

                $this->storePracticeContact($request,$id);
                if($request->id != null){
                    $message= 'Practice Contact Record Updated Successfully';
                }
                else{
                    $message= 'Practice Contact Record Add Successfully';
                }
                
                $toastr_title=trans('messages.toastr_success');
                Toastr::success($message,'',["positionClass" => "toast-top-center"]);

            return redirect('list/practice/contact/' . $request->billing_provider_id);
        } catch (\Exception $e) {
                $message= $e->getMessage();
                $toastr_title=trans('messages.toastr_error');
                Toastr::error($message,'',["positionClass" => "toast-top-center"]);
                return redirect()->back();
        }
    }
    public function showPracticeContact(Request $request)
    {
         $id = $request->id;
         $bPracticeContact = PracticeContact::where('id',$id)->first();  
        return view('billingprocess.rfaSettings.practiceContacts.show',compact('bPracticeContact'));
    } 
    public function previewViewCmsFormForBillingProvider(Request $request)
    {
        $providerId = $request->providerId;
         $renderingProvider = $request->rendering_Id;
         $placeOfService = $request->place_of_services_Id;
         $referingProvider = $request->refering_provider;
         $stateId = $request->state_id;
         $totForm =1;
        return view('billingprocess/cmsForm1500.demo-show', compact('totForm','renderingProvider','placeOfService','referingProvider','stateId'));
    }
    public function viewCmsForm(Request $request)
    {
        $id =  $request->id;$bReferrings=''; $billId = $request->billId; $mm=NULL;  $dd=NULL; $yy=NULL;
        $inj_mm=NULL;  $inj_dd=NULL; $inj_yy=NULL; $stateCode = ''; $billCharge = null;
        $isOtherForm = false; $otherServiceForForm = [];  $serviceForForm = []; $billAllServices = array();
        $injuryBillInfo = InjuryBill::with('getInjury','getBillDiagnosis','getBillPlaceOfService','getBillServices', 'getRenderinPlaceServices', 'getRenderinProvider')->where('id', $billId)->first();
        $diagnosisCodeNumbers = null;
        
        if($injuryBillInfo)
        {
           // $billDetail = $this->getBillServicesInfoByBillId($injuryBillInfo);
            $totForm = 0;
            for ($i = 0; $i < count($injuryBillInfo->getBillServices); $i += 6) {
                $totForm++;
            }
            if($injuryBillInfo->getBillDiagnosis && count($injuryBillInfo->getBillDiagnosis) > 0){
                // create an empty array to hold the alphabet
                $alphabet = array();
                // for ($i = 0; $i < count($injuryBillInfo->getBillDiagnosis); $i++) {
                //      $alphabet[$i] = chr($i + 97);
                // }
                // $diagnosisCodeNumbers = implode(',',$alphabet);
            }
            
            if($injuryBillInfo->getInjury){
                if($injuryBillInfo->getInjury->patient){
                    if($injuryBillInfo->getInjury->patient->dob != ""){
                        $mm= date('m', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $dd = date('d', strtotime($injuryBillInfo->getInjury->patient->dob));
                        $yy =  date('y', strtotime($injuryBillInfo->getInjury->patient->dob));
                    }
                }
                if($injuryBillInfo->getInjury->getInjuryClaim)
                {
                    // if($injuryBillInfo->getInjury->getInjuryClaim->start_date != "" && $injuryBillInfo->getInjury->getInjuryClaim->end_date != "")
                    // {
                    //     $inj_mm = date('m', strtotime($injuryBillInfo->getInjury->getInjuryClaim->end_date));
                    //     $inj_dd = date('d', strtotime($injuryBillInfo->getInjury->getInjuryClaim->end_date));
                    //     $inj_yy =  date('y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->end_date));
                    // }    
                    // else
                    // {
                    // $inj_mm = date('m', strtotime($injuryBillInfo->getInjury->getInjuryClaim->dos));
                    // $inj_dd = date('d', strtotime($injuryBillInfo->getInjury->getInjuryClaim->dos));
                    // $inj_yy =  date('y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->dos));
                    // }
                    if($injuryBillInfo->dos){
                        $inj_mm = date('m', strtotime($injuryBillInfo->dos));
                        $inj_dd = date('d', strtotime($injuryBillInfo->dos));
                        $inj_yy =  date('y', strtotime($injuryBillInfo->dos));
                    }
                    
                }
                if($injuryBillInfo->getInjury->patient->state_id){
                    $state = $this->getStateCodeByName($injuryBillInfo->getInjury->patient->state_id);
                    if($state){
                        $stateCode = $state->state_code;
                    }
                
                }
                if($injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges){
                    $billCharge = $injuryBillInfo->getInjury->patient->getBillingProvider->getProviderCharges->physician_services;  
                  }
            }
                          
        }
        return view('billingprocess.cmsForm1500.show', compact('diagnosisCodeNumbers','injuryBillInfo','totForm','billCharge','mm', 'yy', 'dd','inj_mm', 'inj_dd', 'inj_yy','stateCode','isOtherForm','otherServiceForForm','serviceForForm'));
    }
    public function createBillingCharge(Request $request)
    {
        $providerId = $request->providerId;  $chargeType = NULL;
        $chargeType = $request->ctype;
        $id = null;
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        $stateCode = null;
        
        $providerInfo = BillingProvider::where('id',$providerId)->first();
        if($providerInfo){
            $new_array = $this->filter_array($states,$providerInfo->injury_state_id);
            if($new_array){
                $stateCode = $new_array[0]['state_code'];
            }
        }
         $pc  = BillingProviderCharge::with('getChargesProcedureCode')->where('provider_id',$providerId);
        $pc->where('ctype',$chargeType);
        $providerCharges  =  $pc->get();
        $chargeVal  = MasterProviderCharge::where('provider_id',$providerId)->first();
       // dd($chargeVal);
        // if($masterCharge){
        //     $chargeVal = $masterCharge->first();
        // }
        return view('billingprocess.charges.create',compact('chargeType','id','providerCharges','providerId','states','chargeVal','providerInfo','stateCode'));
    }
    public function resaonsList(Request $request)
    { 
        $providerId = $request->providerId;
        
        $appointmentResaon = AppointmentReason::where('provider_id', $providerId)->where('is_active', 1)->get(); 
        return view('billingprocess.appointmentResaon.index', compact( 'appointmentResaon', 'providerId')); 
    }
    public function storeAppointmentResaon(Request $request)
    {
       try {
            DB::beginTransaction();
                $this->saveAppointmentReason($request);
            DB::commit();
           $msg = 'Resaon added successfully';
           if(isset($request->resaon_id)){
               $msg = 'Resaon updated successfully';
           }
        return  $this->redirectToRoute('/billing/providers/reasons/'.$request->provider_id, $msg, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function deleteAppointmentResaon(Request $request)
    {
       try {
            DB::beginTransaction();
             $this->deleteRow(new AppointmentReason(), $request->id); 
            DB::commit();
           $msg = 'Resaon deleted successfully';
            
        return  $this->redirectToRoute('/billing/providers/reasons/'.$request->provider_id, $msg, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function getResaonStatus($id){
         $reasons = AppointmentReason::where('id', $id)->get();
         return  $reasons;
    }
    public function ajaxPatientInjury(Request $request){
        $pateintInjury = Patient_injury::with('getInjuryClaim')->where('patient_id', $request->patientId);
        $pInjuries = $pateintInjury->get();
        return  $pInjuries;
   }
   
   public function recurrencesList(Request $request)
    { 
         $providerId = $request->providerId; 
        $appointmentResaon = BillingProviderRecurrence::where('provider_id', $providerId)->where('is_active', 1)->get(); 
        return view('billingprocess.recuring.index', compact( 'appointmentResaon', 'providerId')); 
    }
    public function storeAppointmentRecurrecne(Request $request)
        {
           try {
                DB::beginTransaction();
                    $this->saveAppointmentRecurrecne($request);
                DB::commit();
               $msg = 'Resaon added successfully';
               if(isset($request->resaon_id)){
                   $msg = 'Resaon updated successfully';
               }
            return  $this->redirectToRoute('/billing/providers/recurence/'.$request->provider_id, $msg, 'success', ["positionClass" => "toast-top-center"]);
            } catch (\Exception $e) {
                 DB::rollback(); 
                return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
            }
        } 
    public function deleteAppointmentReccurence(Request $request)
    {
       try {
            DB::beginTransaction();
             $this->deleteRow(new BillingProviderRecurrence(), $request->id); 
            DB::commit();
           $msg = 'Recurrence deleted successfully';
            
        return  $this->redirectToRoute('/billing/providers/recurence/'.$request->provider_id, $msg, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function billingProviderHolidayList(Request $request)
    { 
        $providerId = $request->providerId;
        $holidays = MasterHoliday::where('is_active', 1)->get(); 
        $placeOfServices = MasterPlaceOfService::where('billing_provider_id',$providerId)->orderBy('id', 'desc')->get();
        $providerHolidays = BillingProviderHoliday::where('billing_provider_id', $providerId)->where('is_active', 1)->get(); 
        return view('billingprocess.providerHolidays.index', compact(['providerHolidays', 'providerId', 'holidays', 'placeOfServices'])); 
    }
    public function storeBillingProviderHolidays(Request $request)
    {
       try {
             $isFoundHoliday = BillingProviderHoliday::where('holiday_id', $request->holiday_id)->where('location_id', $request->holiday_location_id)->first();
            if($isFoundHoliday){
                return  $this->redirectToRoute('/billing/providers/holidays/'.$request->provider_id, 'This Holiday already exist!', 'error', ["positionClass" => "toast-top-center"]);
            }
            else{
                DB::beginTransaction();
                    $this->saveBillingProviderHoliday($request);
                DB::commit();
                $msg = 'Holiday added successfully';
                if(isset($request->resaon_id)){
                    $msg = 'Holiday updated successfully';
                }
            return  $this->redirectToRoute('/billing/providers/holidays/'.$request->provider_id, $msg, 'success', ["positionClass" => "toast-top-center"]);
            } 
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function deleteBillingProviderHolidays(Request $request)
    {
       try {
            DB::beginTransaction();
             $this->deleteRow(new BillingProviderHoliday(), $request->id); 
            DB::commit();
           $msg = 'Holiday deleted successfully'; 
           return  $this->redirectToRoute('/billing/providers/holidays/'.$request->provider_id, $msg, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
             DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    
    public function getTasksByStatusId($statusId){
         $tasks = Task::where('status_id', $statusId)->get();
         return  $tasks;
    }
     
    public function viewAssignTaskForBillingProvider(Request $request){
        $providerId = $request->providerId;
        $billStatuss = Status::with('getTasks')->where('status_type', 3)->get();
        $roles = Role::whereNotIn('name', ['Admin', 'super-admin'])->get();
         $users = User::whereDoesntHave('roles', function ($q) {
            $q->whereIn('name', ['Admin','super-admin']);
        })->get();
        
        return view('billingprocess.assignTask.index', compact(['providerId', 'billStatuss', 'roles', 'users']));
    }
    public function assignTaskToUser(Request $request){
        // echo "<pre>";
        // print_r($request->all());exit;
        try {
            $task = Task::where('id', $request->task_id)->first();
            if($task){
                if($request->task_assign_type == 1){
                    $role = $request->assign_role_name;
                    $users = User::whereHas(
                        'roles', function($q) use($role){
                            $q->where('role_id', $role);
                        }
                    )->get();
                    if(count($users) > 0){
                        foreach($users as $user){
                            $this->assignNewTaskToUser($user->id, $task, $request);
                        }
                    } 
                }
                else if($request->task_assign_type == 2){
                    $user = $request->user_id;
                    $this->assignNewTaskToUser($user, $task, $request);
                } 
            }
            $redirectUrl = '/billing/provider/task/assignment/preferences/'.$request->providerId;
            return $this->redirectToRoute($redirectUrl, 'Task Assigned successfully', 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function getSecondReviewInfoById(Request $request){
        $sReviewid = $request->secondReviewId;
        return WriteOffReason::where('id', $sReviewid)->first();
    }
    public function saveBillSecondSBR(Request $request){
        // echo "<pre>";
        // print_r($request->billSbrArray); 
        try {
            DB::beginTransaction();
            $this->storeBillSecondRevies($request);
            $redirectUrl = 'view/patient/injury/bill/info/'.$request->selectedBillId;
            DB::commit();
            return $this->redirectToRoute($redirectUrl, 'Bill send sbr added successfully', 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        } 
    }
    public function createBillingRendering(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());exit;
        $providerId = $request->providerId;
        $bRenderings = [];
        $id = $request->id;
        $taxonomy_codes = Taxonomy_code::where('is_active', 1)->orderBy('name')->orderBy('code')->get();
        if($id != null){
        $render = BillReferingOrderProvider::with('state','taxonomyCode')->where('id',$id);
            $bRenderings =   $render->first();
        }
        //dd($bRenderings);
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        $pType = 4;
        return view('billingprocess.billRendering.create',compact('pType','bRenderings','providerId','id','states','taxonomy_codes'));
    }
    
    public function billProviderPracticeChargeImport(Request $request){
        try {
            DB::beginTransaction();
            $checkMasterCharge = MasterProviderCharge::where('provider_id',$request->providerId)->first();
            //dd($checkMasterCharge);
            if($checkMasterCharge){
                $checkPracticeName = BillingProviderCharge::where('id', $checkMasterCharge->id)->where('provider_id', $request->providerId)->first();
                //dd($checkPracticeName);
                if($checkPracticeName){
                    $checkPracticeName->charge_id           = $checkMasterCharge->id;
                    $checkPracticeName->practice_name       = $request->practice_charge_name_import;
                    $checkPracticeName->states_code         = 'CA';
                    $checkPracticeName->effective_dos       = $request->effective_dos_import;
                    $checkPracticeName->expiration_dos      = $request->expiration_dos_import;
                    $checkPracticeName->created_by          = Auth::user()->id;
                    $checkPracticeName->status              = 1;
                    $checkPracticeName->ctype               = $request->ctype;
                    $checkPracticeName->update();
                    if($checkPracticeName->id){
                        $this->storeProviderPracticeCharge($checkPracticeName->id, $request);
                    }
                }
                else{
                    $billingPracticeCharge =  new BillingProviderCharge();
                    $billingPracticeCharge->provider_id         = $request->providerId;
                    $billingPracticeCharge->charge_id           = $checkMasterCharge->id;
                    $billingPracticeCharge->ctype               = $request->ctype;
                    $billingPracticeCharge->practice_name       = $request->practice_charge_name_import;
                    $billingPracticeCharge->states_code         =  'CA';
                    $billingPracticeCharge->effective_dos       = $request->effective_dos_import;
                    $billingPracticeCharge->expiration_dos      = $request->expiration_dos_import;
                    $billingPracticeCharge->created_by          = Auth::user()->id;
                    $billingPracticeCharge->status          = 1;
                    $billingPracticeCharge->save();
                    if($billingPracticeCharge->id){
                        $this->storeProviderPracticeCharge($billingPracticeCharge->id, $request);
                    }
                } 
            } 
            
            DB::commit();
            $url = '/setting/billing/provider/charge/add/'.$request->providerId;
            return $this->redirectToRoute( $url, 'Charges added for this provider code import', 'success', ["positionClass" => "toast-top-center"]);
          } catch (\Exception $e) {
            DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), 'Bill created successfully', 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function importProcedureCode(Request $request){
        try {
            DB::beginTransaction(); 
            $this->storeProviderPracticeCharge($request->masterChargeId, $request); 
            DB::commit();
            $url = '/settings/charges/'.$request->masterChargeId."/".$request->providerId;
            return $this->redirectToRoute( $url, 'Charges added for this provider code import', 'success', ["positionClass" => "toast-top-center"]);
          } catch (\Exception $e) {
            DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), 'Bill created successfully', 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function billingProvidersSetting(Request $request)
    {
        $id =  $request->id;
        $bRenderings = [];
        $billingProviders = BillingProvider::where('id',$id)->orderBy('id', 'desc')->first();
        $billingP = BillingProvider::where('id' ,$id)->first();
       return view('billingprocess.setting.index', compact('id','bRenderings', 'billingP', 'billingProviders'));
    } 
    public function createPracticeCharge(Request $request)
    {
        $providerId = $request->providerId; 
        $ctype = $request->ctype;
        $id = null;
        $masterData = $this->showStateCityCountry();
        $countris = $masterData['countris'];
        $states = $masterData['states'];
        $stateCode = null;
        $modifiersArray = BillModifier::where('status', 1)->get();
        $providerInfo = BillingProvider::where('id',$providerId)->first();
        $checkMasterCharge = MasterProviderCharge::where('provider_id',$providerId)->first(); 
        return view('billingprocess.charges.create-practice',compact('ctype','id','providerId','states','providerInfo','modifiersArray','checkMasterCharge'));
    }
    public function storePracticeCharge(Request $request, $id = null){
       try {
                DB::beginTransaction();
                $id = ($request->practiceChargeId) ? $request->practiceChargeId : null;
                $billingProviderId = ($request->billingProviderId) ? $request->billingProviderId : null;
                $produdeCode = BillingProviderChargeProcedureCode::where('id', $id)->first();
                $this->addPracticeChargeProcedureCode($request); 
                DB::commit();
                $url = 'setting/billing/provider/charge/add/' . $billingProviderId;
                if($request->chargeId != " "){
                    $message= "Provider's practice charge updated successfully";
                    //$url = 'settings/charges/' . $request->chargeId;
                }
                else{
                    $message= "Provider's practice charge added successfully";
                    // $url = 'setting/billing/provider/charge/add/' . $billingProviderId;
                    // if(isset($request->ctype)) {
                    //     $url = 'setting/billing/provider/charge/add/' . $billingProviderId."/".$request->ctype; 
                    // }
                }
                 return $this->redirectToRoute($url, $message, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
                    DB::rollback();
                $message= $e->getMessage();
                $toastr_title=trans('messages.toastr_error');
                Toastr::error($message,'',["positionClass" => "toast-top-center"]);
                return redirect()->back();
        }
    }
    public function searchProcedureCodeForUnit(Request $request)
    {
        //$billingProviderId = 1; 
        //echo "<pre>";
        //print_r($request->modefiyer);exit;
        $result =  [];
        $injury = Patient_injury::where('id', $request->injuryId)->first();
        if($injury){
            $checkProviderCharge = BillingProviderCharge::where('provider_id', $injury->patient->billing_provider_id)->first();
            if($checkProviderCharge){
                $checkModify = BillingProviderChargeProcedureCode::where('billing_provider_charge_id',$checkProviderCharge->id)->where('status',1);
                if(isset($request->prCode) || isset($request->modefiyer)){
                    if(isset($request->prCode)){
                        $checkModify =   $checkModify->where('procedure_code', $request->prCode); 
                    }
                    if(isset($request->modefiyer)){
                        $checkModify =   $checkModify->whereIn('modifiers',$request->modefiyer);
                    }
                    $checkModify =  $checkModify->first();
                }   
            if($checkModify) {  $result = array($checkModify); } 
            } 
        } 
        return $result;
    }
    public function searchProcedureCodeForAutoSearch(Request $request)
    {
        //$billingProviderId = 1; 
        $result =  [];

        $injury = Patient_injury::where('id', $request->injuryId)->first();
        if($injury){ 
            $checkProviderCharge = BillingProviderCharge::where('provider_id', $injury->patient->billing_provider_id)->first();
            if($checkProviderCharge){
                $checkModify = BillingProviderChargeProcedureCode::where('billing_provider_charge_id',$checkProviderCharge->id)->where('status',1);
                if(isset($request->str) && isset($request->str)){ 
                    $checkModify =   $checkModify->where('procedure_code', 'LIKE', "%{$request->str}%");
                }
                $checkModify =  $checkModify->get();
            if($checkModify) {  $result = $checkModify; } 
            } 
        } 
        return $result;
    }
    public function storeBillingProvider(Request $request)
    {
        //dd($request->all());exit;
        //request()->validate(['injury_state_id' => 'required']);
        try {
            $resons = $this->bPModel->getProviderResaons();
            $providerFName = null; $providerLName = null;
            if($request->bill_type == 'Professional'){
                if($request->provider_type == 'Organization'){
                    $providerFName = $request->professional_provider_name;                       
                }else{
                    $providerFName = $request->billProvider_namebox_33_first_name;    
                    $providerLName = $request->billProvider_namebox_33_last_name;    
                }
            }
            if($request->bill_type == 'Pharmacy'){
                $providerFName = $request->pharmacy_billing_provider_name; 
            }
            if($request->bill_type == 'Institutional'){
                $providerFName = $request->institution_provider_name;  
            }
            //echo "##".$providerFName;exit;
             
            if($request->providerId == ''){
                $isFoundProvider = BillingProvider::where(DB::raw('lower(professional_provider_name)'), strtolower($providerFName))->first();
                //dd($isFoundProvider);
                if($isFoundProvider){
                    $toastr_title=trans('messages.toastr_error');
                    Toastr::error("This provider already exist",'',["positionClass" => "toast-top-center"]);
                     return redirect()->back();
                }
                else{
                    $response = $this->storeBillProviderProvider($request, $resons);
                    if($response == 1){
                        if(!$request->providerId){
                            $message= 'Bill provider created successfully';
                        }
                        else{
                            $message= 'Bill provider updated successfully';
                        } 
                        $toastr_title=trans('messages.toastr_success');
                        Toastr::success($message,'',["positionClass" => "toast-top-center"]);
                        return redirect('/billingproviders');
                    }
                } 

            } 
            else{
                 $response = $this->storeBillProviderProvider($request, $resons);
                if($response == 1){
                    if(!$request->providerId){
                        $message= 'Bill provider created successfully';
                    }
                    else{
                        $message= 'Bill provider updated successfully';
                    }
                   
                    $toastr_title=trans('messages.toastr_success');
                    Toastr::success($message,'',["positionClass" => "toast-top-center"]);
                    return redirect('/billingproviders');
                }
            } 
            
        } catch (\Exception $e) {
            $message= $e->getMessage();
            $toastr_title=trans('messages.toastr_error');
            Toastr::error($message,'',["positionClass" => "toast-top-center"]);
            return redirect()->back();
        }
    }
    public function storeBillRender(Request $request)
    {
        //try {
            $id = ($request->renderProviderId) ? $request->renderProviderId : null;
            if($id == null){
                $isFoundRendering = BillReferingOrderProvider::where(DB::raw('lower(referring_provider_first_name)'), strtolower($request->fName))->first();
                //dd($isFoundProvider);
                if($isFoundRendering){
                    $toastr_title=trans('messages.toastr_error');
                    Toastr::error("This provider already exist",'',["positionClass" => "toast-top-center"]);
                        return redirect()->back();
                }
                else{
                    $this->storeBillReferringProvider($request,$id);
                    if($id != null){
                        $message= 'Bill referring provider updated successfully';
                    }
                    else{
                        $message= 'Bill referring provider created successfully';
                    }
                    $toastr_title=trans('messages.toastr_success');
                    Toastr::success($message,'',["positionClass" => "toast-top-center"]);
                    return redirect('billing/rendering/' . $request->billingProviderId);
                }
            } 
            else{
                $this->storeBillReferringProvider($request,$id);
                if($id != null){
                    $message= 'Bill referring provider updated successfully';
                }
                else{
                    $message= 'Bill referring provider created successfully';
                }
                $toastr_title=trans('messages.toastr_success');
                Toastr::success($message,'',["positionClass" => "toast-top-center"]);
                return redirect('billing/rendering/' . $request->billingProviderId);
            }
        // } catch (\Exception $e) {
        //         $message= $e->getMessage();
        //         $toastr_title=trans('messages.toastr_error');
        //         Toastr::error($message,'',["positionClass" => "toast-top-center"]);
        //         return redirect()->back();
        // }
    }
}