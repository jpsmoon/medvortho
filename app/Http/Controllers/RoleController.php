<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Toastr;
    
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $roles = Role::orderBy('id','DESC')->paginate(5);
        // return view('roles.index',compact('roles'))
        //     ->with('i', ($request->input('page', 1) - 1) * 5);
        $roles = Role::orderBy('id','DESC')->get();
        $i = 1;
        return view('roles.index',compact(['roles', 'i']));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::orderBy('name', 'asc')->get();
        return view('roles.create',compact('permission'));
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
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
        return  $this->redirectToRoute(route('roles.index'), 'Role created successfully', 'success', ["positionClass" => "toast-top-center"]);
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::orderBy('name', 'asc')->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'));
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
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
        return  $this->redirectToRoute(route('roles.index'), 'Role updated successfully', 'success', ["positionClass" => "toast-top-center"]);
     }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return  $this->redirectToRoute(route('roles.index'), 'Role updated successfully', 'success', ["positionClass" => "toast-top-center"]);
    }
    public function permissionList(Request $request){
         $permissions = Permission::orderBy('id','DESC')->get();
        return view('roles.permission.index',compact('permissions'))
            ->with('i', ($request->input('page', 1) - 1) * 15);
    }
    public function savePermission(Request $request){
        try {
            DB::beginTransaction();
            $message = 'Permission added successfully';
            if(isset($request->permissionId)){
                $message = 'Permission updated successfully';
                $permission = Permission::where('id', $request->permissionId)->first();
                $permission->name = $request->name;
                $permission->update();
            }
            else{
                $newPermission = Permission::create(['name' => $request->name,'guard_name' => $request->guard_name]);
            }
            DB::commit();
            return $this->redirectToRoute('/permissions', $message, 'success', ["positionClass" => "toast-top-center"]);
        } catch (\Exception $e) {
            DB::rollback(); 
            return $this->redirectToRoute(redirect()->back(), $e->getMessage(), 'error', ["positionClass" => "toast-top-center"]);
         }
    }
  public function checkPermissionBeforeDelete($pId){
    return $checkPermission = DB::table('role_has_permissions')->where('permission_id',$pId)->get(); 
  }
  public function deletePermission(Request $request){
    $pId = $request->id;
    DB::table("role_has_permissions")->where("role_has_permissions.role_id",$pId)->delete(); 
    $checkPermission = Permission::where('id',$pId)->delete(); 
  }
  public function checkRoleBeforeDelete($rId){
    return   DB::table('model_has_roles')->where('role_id',$rId)->get(); 
  }
  public function deleteRole(Request $request){
    $rId = $request->id;
    $checkRole = Role::where('id', $rId)->delete();
  }
}