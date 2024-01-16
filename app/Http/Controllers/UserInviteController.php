<?php

namespace App\Http\Controllers;
use App\Models\{Role, UserBillingProvider, User, UserInvite, Patient, BillingProvider  };
use Illuminate\Http\Request;
use Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;  
use DB;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\InviteUserCreated;
use Str;
use Illuminate\Support\Facades\Mail;
use Validator;

class UserInviteController extends Controller
{
    // 
    protected $inviteModel;
    public function __construct(UserInvite $inviteMod )
    {
        $this->middleware('permission:patient-list|patient-create|patient-edit|patient-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:patient-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:patient-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:patient-delete', ['only' => ['destroy']]);
        $this->inviteModel = $inviteMod;
    }
    public function index(Request $request)
    {
        // if(Auth::user()->roles[0]['name'] =='SubAdmin'){
        //       $accountUser = User::orderBy('created_at', 'desc')->get();
        //       $inviteUser = UserInvite::orderBy('created_at', 'desc')->get();
        // } 
        // else
        // {
        //     $accountUser = User::where('created_by', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        //     $inviteUser = UserInvite::where('created_by', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        // }
         
        $accountUser = User::where('created_by', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $inviteUser = UserInvite::where('created_by', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        
        return view('usersInvite.index', compact('inviteUser','accountUser'));
    }
    public function checkBillingProviderAccess($userId){
        $isFound = 0 ;
        $userBillingProvider = UserBillingProvider::where('user_id', $userId)->count();
        $billingProvidersArray = BillingProvider::where('is_active', 1)->count();  
        if($userBillingProvider == $billingProvidersArray){
            $isFound = 1;
        }
        return $isFound;
    }
    
    
    public function acceptInvite($token){
        $providers = array();
        $inviteUser = UserInvite::with('getRoleInfo')->where('token', $token)->first();
        if($inviteUser){
            if( strpos($inviteUser->billing_provider_ids, ',') !== false ) {
               $exp = explode(',', $inviteUser->billing_provider_ids);
                if(count($exp) > 0){
                    foreach($exp as $id){
                        $providers[] = BillingProvider::where('id', $id)->first();
                    }
               }
           } 
        }
        return view('usersInvite.inviteAccept', compact([ 'inviteUser','providers']));
    }
    public function inviteProcess(Request $request){
        // echo "<pre>";
        // print_r($request->all());exit;
          $validator = Validator::make($request->all(),[
            'email' => 'required', 
            'roles' => 'required', 
            'billingProviders' => 'required', 
        ]);
        if ($validator->fails()) {
             return $this->redirectToRoute('invite/user', $validator->errors()->first(), 'error', ["positionClass" => "toast-top-center"]);
            
        }
        
       try {
           DB::beginTransaction();
           if(isset($request->id)){
            $checkInvite  = UserInvite::where('id', $request->id)->first();
            $checkInvite->is_resend = $request->is_resend;
            $checkInvite->resend_counter = $checkInvite->resend_counter + 1;
            $checkInvite->update();
            // send the email
                //Mail::to($request->email)->send(new InviteUserCreated($checkInvite));
            //manage/users
           }else{
                $token = $this->inviteModel->generateInvitationToken();
                while (UserInvite::where('token', $token)->first());
                $checkInvite  = UserInvite::where('email', $request->email)->first();
                 if($checkInvite){
                    return $this->redirectToRoute('manage/users', 'This email already created', 'error', ["positionClass" => "toast-top-center"]);
                }else{
                    //create a new invite record
                    $providers = null;
                    if(isset($request->billingProviders)){
                       $providers =  implode(',', $request->billingProviders);
                    }
                
                    $inviteUsers = UserInvite::create([
                        'email' => $request->email,
                        'role_id' => $request->roles,
                        'billing_provider_ids' => $providers,
                        'token_url' => $this->inviteModel->getLink($token),
                        'token' => $token,
                        'created_by' => Auth::user()->id
                    ]);
                    // send the email
                        //Mail::to($request->email)->send(new InviteUserCreated($inviteUsers));
                    //manage/users
                }
           }
            
            DB::commit();
            return $this->redirectToRoute('manage/users', 'invitation sent successfully', 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
            DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
        
    }
    public function inviteUser(){
        $roles = Role::select('id','name')->get();
        $billingProvidersArray = BillingProvider::where('is_active', 1)->get(); 
        $inviteUser = UserInvite::get();
        return view('usersInvite.inviteUser', compact([ 'roles', 'billingProvidersArray','inviteUser']));
    } 
    public function acceptInviteProcess(Request $request){
        try {
            DB::beginTransaction();
             $inviteDetail = UserInvite::where('token', $request->inviteToken)->first();
             if($inviteDetail){
                //create a new invite record 
                $checkUser = User::where('email', $inviteDetail->email)->first();
                if($checkUser){
                    return $this->redirectToRoute('manage/users', 'This user already created', 'error', ["positionClass" => "toast-top-center"]);
                }
                else{
                     $newUser = User::create([
                        'name' => $request->name,
                        'last_name' => $request->last_name,
                        'email' => $inviteDetail->email,
                        'phone_no' => $request->phone_no,
                        'password' => (isset($request->password))  ? Hash::make($request->password) :  null,
                        'original_pass' => $request->password,
                        'role_id' => $inviteDetail->role_id, 
                        'created_by' => Auth::user()->id
                    ]);
                    if($newUser){
                        $newUser->assignRole($inviteDetail->role_id); 
                        DB::table('user_billing_providers')->where('user_id', $newUser->id)->delete(); 
                        DB::table('user_invites')->where('token', $request->inviteToken)->delete(); 
                        if( strpos($inviteDetail->billing_provider_ids, ',') !== false ) {
                            $exp = explode(',', $inviteDetail->billing_provider_ids); 
                            if(count($exp) > 0){ 
                                foreach($exp as $id){
                                     UserBillingProvider::create([
                                        'provider_id' => $id,
                                        'user_id' => $newUser->id,
                                    ]); 
                                }
                            }
                        } 
                        else{
                            UserBillingProvider::create([
                                'provider_id' =>$inviteDetail->billing_provider_ids,
                                'user_id' => $newUser->id,
                            ]); 
                        }
                    }
                }
                
                // send the email
                //Mail::to($request->email)->send(new InviteUserCreated($inviteUser));
               DB::commit();
                return $this->redirectToRoute('manage/users', 'User created successfully', 'success', ["positionClass" => "toast-top-center"]);
             }
        } catch (\Exception $e) {
            DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function deletUserInvite(Request $request){
        try {
            DB::beginTransaction();
             $inviteDetail = UserInvite::where('id', $request->id)->first();
             if($inviteDetail){
                $inviteDetail->delete();
             } 
             DB::commit();
        } catch (\Exception $e) {
            DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function deleteUser(Request $request){
        // echo "<pre>";
        // print_r($request->all());
        try {
            DB::beginTransaction();
            $checkUser = User::where('id', $request->id)->first();
               if($checkUser){
                    $checkUser->is_active =  ($checkUser->is_active == 0) ? 1 : 0; 
                   $checkUser->update(); 
               }  
             DB::commit(); 
        } catch (\Exception $e) {
            DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        }
    }
    public function updateProfile(Request $request, $id)
    {
        //   echo "<pre>";
        // print_r($request->all());exit;
        // $this->validate($request, [
        //     'name' => 'required',
        //     'last_name' => 'required',
        //     'phone_no' => 'required|numeric',
        //     //'email' => 'required|email|unique:users,email,'.$id,
        //     'confirm_password' => 'same:password',
        //     'roles' => 'required'
        // ]);
      //try {
           DB::beginTransaction();
            $user = User::find($id);
            //If any uploaded photo found then update it.
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
                $user->profile_image = $filename2;
             }
             
            //If any signature found update them

            $inputArray = array(
                'name'          => ($request->name != "")  ? $request->name : $user->name,
                'last_name'     => ($request->last_name != "")  ? $request->last_name : $user->last_name,
                'phone_no'      => ($request->phone_no != "")  ? $request->phone_no   : $user->phone_no, 
                'password'      => (isset($request->password))  ? Hash::make($request->password) : $user->password,
                'original_pass' =>  (isset($request->original_pass))  ? $request->password : $user->original_pass 
            );
            if(isset($request->roles)){
                    $user->assignRole($request->roles); 
               }
                 
                if(isset($request->billingProviders)){
                     DB::table('user_billing_providers')->where('user_id', $user->id)->delete(); 
                        foreach($request->billingProviders as $providerId){ 
                             UserBillingProvider::create([
                            'provider_id' =>$providerId,
                            'user_id' => $user->id,
                        ]);
                    } 
                }
            $user->update($inputArray);
            
            

            //delete previous user billing providers

            // //Delete previous user's task, if available
            // $this->deleteRow(UserTask::class, 0, 'user_id', $id);
            // //Insert new user's task here
            // if(count($request->task_id)){
            //     foreach ($request->task_id as $task_id) {
            //         $usertask = new UserTask();
            //         $usertask->user_id = $id;
            //         $usertask->task_id = $task_id;
            //         $usertask->save();
            //     }
            // } 
            DB::commit();  
            if(isset($request->password)){
                Auth::logout();
            }
            return  $this->redirectToRoute('edit/profile', 'User updated successfully', 'success', ["positionClass" => "toast-top-center"]);

        // } catch (\Exception $e) {
        //     DB::rollback(); 
        //     return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
        //  }
    }
}
