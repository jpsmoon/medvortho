<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{User, Task, UserTask, UserBillingProvider, BillingProvider};
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use File;
use Carbon\Carbon;



    
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $tasks = $this->getActiveData(Task::class, 'task_name');
        return view('users.create',compact('roles', 'tasks'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            'task_id' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        if(count($request->task_id)){
            foreach ($request->task_id as $task_id) {
                $usertask = new UserTask();
                $usertask->user_id = $user->id;
                $usertask->task_id = $task_id;
                $usertask->save();
            }
        }
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $usertasks = $this->getUserTaskList($id); 
        return view('users.show',compact('user', 'usertasks'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $tasks = $this->getActiveData(Task::class, 'task_name');
        $usertasks = $this->getActiveData(UserTask::class, 'id', 'user_id', $id);
        $billingProvidersArray = BillingProvider::where('is_active', 1)->get();    
       
        // if($usertasks){
        //     $tmp = array();
        //     foreach($usertasks as $task){                     
        //         array_push($tmp, $task->task_id);
        //     }
        //     $user->tasks = $tmp;
        // }    
        return view('users.edit',compact('user','roles','userRole', 'tasks','billingProvidersArray'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'phone_no' => 'required|numeric',
            //'email' => 'required|email|unique:users,email,'.$id,
            'confirm_password' => 'same:password',
            'roles' => 'required'
        ]);
       try {
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
                'name'          => ($request->name != "")  ? $user->name  : $request->name,
                'last_name'     => ($request->last_name != "")  ? $user->last_name  : $request->last_name,
                'phone_no'      => ($request->phone_no != "")  ? $user->phone_no  : $request->phone_no, 
                'password'      => (isset($request->password))  ? Hash::make($request->password) : $user->password,
                'original_pass' =>  (isset($request->original_pass))  ? $request->password : $user->original_pass 
            );
            $user->update($inputArray);
            DB::table('model_has_roles')->where('model_id',$id)->delete();
        
            $user->assignRole($request->input('roles'));
            //delete previous user billing providers
            
            $userBillingProvider = UserBillingProvider::where('user_id', $user->id)->delete();
            if(count($request->billingProviders)){
                    foreach ($request->billingProviders as $bp) {
                        $userBP = new UserBillingProvider();
                        $userBP->user_id = $user->id;
                        $userBP->provider_id = $bp;
                        $userBP->created_by = Auth::user()->id;
                        $userBP->save();
                    }
                }

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

        } catch (\Exception $e) {
            DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
         }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
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
    
}