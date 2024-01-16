<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Status, TaskStep, Patient, User, Role, BillingProvider, Patient_injury, InjuryBill, AppointmentReason, PatientAppointment, UserOtherDetail, UserBillingProvider};
use Carbon\Carbon;
use Illuminate\Support\Facades\Session; 
use Toastr;
use DB;
use DateTime;
use Illuminate\Support\Facades\Auth; 
use \stdClass;
use Hash;
use Illuminate\Support\Facades\Validator;

class SoftUsersController extends Controller
{
    //
    public function __construct(Patient $patientMod)
    {
        $this->middleware('auth');
        $this->patientModel = $patientMod;
    }
    public function index()
    {
         return view('globalAdmin.softUser.index');
    }
    public function create(Request $request)
    {
        $userId = ($request->id) ? $request->id : null; $user = null; $userRole  = null;
        $roles = Role::where('id', '!=', Auth::user()->roles[0]['id'])->orderBy('id','DESC')->get();
        $masterData = $this->showStateCityCountry();
        $states = $masterData['states'];

        if($userId != null){
            $user = User::where('id', $userId)->first();
            $userRole = DB::table('model_has_roles')->where('model_id',$user->id)->first();
        }  
         return view('globalAdmin.softUser.create',compact('userId', 'user', 'roles','userRole', 'states'));
    }
    public function saveUserInDb(Request $request){
         
        try {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $lastUser =  User::orderBy('id','DESC')->first();
            $emp = '100'.($lastUser->id + 1);
            $empId = $emp.$this->getRandomStringRand(4);
            $enPass = Hash::make($request->password);
            $redirectUrl = '/global/soft/users';
            $filename2 = null; $msg = 'Software user created successfully';
            $loginUserId = Auth::user()->id;
            if($request->file('profile_image')){
                
                // $document_path = $request->file('profile_image')->store('public/document');
                $file                = $request->file('profile_image');
                $filename2           = Str::random(12);
                $fileExt             = $file->getClientOriginalExtension();
                $destinationPath     = public_path('user_image');
                if($user->profile_image!=NULL){
                    $filePathName = $destinationPath."/".$user->profile_image;
                    if (File::exists($filePathName)) {
                        File::delete($filePathName);
                    }
                }
                $filename2           = $filename2 . '.' . $fileExt;
                $document_path       = $filename2;
                $file->move($destinationPath, $filename2);
               // $user->profile_image = $filename2;
             }
            if(isset($request->userId)){
                $validator = Validator::make($request->all(), [
                    'fName' => 'required',
                    //'email' => 'required|email|unique:users,email',
                    'password' => 'required|same:confirm-password',
                    'roles' => 'required', 
                ]);  
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $user = User::where('id' , $request->userId)->first();
                if( $user){
                    $msg = 'Software user updated successfully';
                    $user->update(['gender'=>$request->gender,'profile_image'=>$filename2,'created_by'=>$loginUserId,'emp_id'=>$empId,'name'=>$request->fName,'last_name'=>$request->lName,'phone_no'=>$request->phone_no, 'password'=>$enPass,'original_pass'=>$request->password]);
                    $this->createBillingProviderForSuperAdmin($request, $user->id);
                    $userDetail = UserOtherDetail::where('user_id', $user->id)->first();
                    if($userDetail){
                        $userDetail->state_id = $request->state_id;
                        $userDetail->city_id = $request->city_id;
                        $userDetail->zipe_code = $request->zipe_code_id; 
                        $userDetail->address_1 = $request->address1;
                        $userDetail->address_2 = $request->address2;
                        $userDetail->update(); 
                    }
                }   

            }
            else{
                $validator = Validator::make($request->all(), [
                    'fName' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|same:confirm-password',
                    'roles' => 'required', 
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $user = User::create(['gender'=>$request->gender,'profile_image'=>$filename2,'created_by'=>$loginUserId,'emp_id'=>$empId,
                'name'=>$request->fName,'last_name'=>$request->lName,'email'=>$request->email,'phone_no'=>$request->phone_no, 'password'=>$enPass,
                'original_pass'=>$request->password]);
                $this->createBillingProviderForSuperAdmin($request, $user->id);
                $userDetail = new UserOtherDetail();
                $userDetail->user_id = $user->id;
                $userDetail->state_id = $request->state_id;
                $userDetail->city_id = $request->city_id;
                $userDetail->zipe_code = $request->zipe_code_id; 
                $userDetail->address_1 = $request->address1;
                $userDetail->address_2 = $request->address2;
                $userDetail->save(); 
            }
             $user->assignRole($request->input('roles'));
            DB::commit(); 
            return $this->redirectToRoute($redirectUrl, $msg , 'success', ["positionClass" => "toast-top-center"]); 
        } catch (\Exception $e) {
            DB::rollback();   
            return $this->redirectToRoute(redirect()->back(), trans('bill.something_went_wrong'), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function getRandomStringRand($length)
    {
        $stringSpace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $str = substr(str_shuffle($stringSpace),0, $length);
        return strtoupper($str);
    }
    public function createBillingProviderForSuperAdmin($request, $userId)
    {
            ///created_by
            $isCheckProvider = BillingProvider::where('name' , $request->fName)->where('nick_name' , $request->lName)->where('created_by' , $userId)->where('created_by' , $userId)->first();
            if($isCheckProvider){
                $isCheckProvider->delete();
            }
            $billing_providers = new BillingProvider();
            $billing_providers->injury_state_id                 = $request->state_id;
            $billing_providers->bill_type                       = 'Professional';
            $billing_providers->provider_type                   = 'Organization';
            $billing_providers->tax_id                          = '000000';
            $billing_providers->npi                             = '000000'; 
            $billing_providers->name                            = $request->fName;
            $billing_providers->nick_name                       = $request->lName;
            $billing_providers->professional_provider_name      = $request->fName;
            $billing_providers->nick_name                       = $request->lName;
            $billing_providers->professional_tax_id              = '000000'; 
            $billing_providers->address_line1                   = $request->address1;
            $billing_providers->address_line2                   = $request->address2;
            $billing_providers->state_id                        = $request->state_id;
            $billing_providers->city_id                         = $request->city_id;
            $billing_providers->zipcode                         = $request->zipe_code_id;
            $billing_providers->created_by                      = $userId;
            $billing_providers->supar_admin_id                  = Auth::user()->id;
            $billing_providers->save();
            $isFoundBilling = UserBillingProvider::where('provider_id', $billing_providers->id)->where('user_id', $userId)->first();
            if($isFoundBilling){
                $isFoundBilling->delete();
            }
            $userBP = new UserBillingProvider();
            $userBP->user_id = $userId;
            $userBP->provider_id = $billing_providers->id;
            $userBP->created_by = Auth::user()->id;
            $userBP->save();
    } 
    public function viewSoftUser(Request $request){
        $userId = ($request->id) ? $request->id : null; 
        $billingProviders = $userId;
        return view('globalAdmin.softUser.billingProvider.index');
    }
    
}
