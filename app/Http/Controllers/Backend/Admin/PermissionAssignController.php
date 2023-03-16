<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use App\Models\PermissionAssign;
use App\Models\User;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;

use App\Helpers\LogActivity;

use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PermissionAssignController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('admin')->user()->can('view-access-control')){

        $roles = Role::select('id', 'name')->paginate(10);
        return view('backend.permission-assign.index', compact('roles'));
        }
        abort(403, 'Unauthorized action.');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $modules = Module::get();

        return view('backend.permission-assign.create',compact('roles','modules'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check=PermissionAssign::where('role_id',$request->id)->first();
        if($check)
        {
            PermissionAssign::where('role_id',$request->id)->delete();
            foreach($request->permissions as $permission){
                $permissionAssign = new PermissionAssign();
                $permissionAssign->role_id = $request->role_id;
                $permissionAssign->permission_id =$permission;
                $permissionAssign->save();
            }
            LogActivity::addToLog('PermissionAssign Updated ');

        }
        else{
            foreach($request->permissions as $permission){
                $permissionAssign = new PermissionAssign();
                $permissionAssign->role_id = $request->role_id;
                $permissionAssign->permission_id =$permission;
                $permissionAssign->save();
            }
            LogActivity::addToLog('PermissionAssigned');

        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PermissionAssign  $permissionAssign
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles=Role::get();
        $modules=Module::get();
        $permarray=array();
        $permissionAssign=PermissionAssign::where('role_id',$id)->get();
        foreach($permissionAssign as $perms){
            $permarray[]=$perms->permission_id;

        }
        return view('backend.permission-assign.edit',compact('id','modules','roles','permissionAssign','permarray'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PermissionAssign $permissionAssign)
    { 
        $check=PermissionAssign::where('role_id',$request->id)->first();
        if($check)
        {
            PermissionAssign::where('role_id',$request->role_id)->delete();
            foreach($request->permissions as $permission){
                $permissionAssign = new PermissionAssign();
                $permissionAssign->role_id = $request->role_id;
                $permissionAssign->permission_id =$permission;
                $permissionAssign->save();
            }
            LogActivity::addToLog('PermissionAssign Updated ');

        }
        else{
            foreach($request->permissions as $permission){
                $permissionAssign = new PermissionAssign();
                $permissionAssign->role_id = $request->role_id;
                $permissionAssign->permission_id =$permission;
                $permissionAssign->save();
            }
            LogActivity::addToLog('PermissionAssign Updated ');

        }
       

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermissionAssign $permissionAssign)
    {
        try {
            $permissionAssign->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('PermissionAssign Deleted');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
    
}
