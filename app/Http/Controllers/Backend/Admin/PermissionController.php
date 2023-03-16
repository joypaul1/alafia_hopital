<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use App\Models\Admin;
use App\Helpers\LogActivity;
use App\Models\Module;
use App\Models\Submodule;



use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('admin')->user()->can('view-permission')){

        $permissions = Permission::select('id', 'name','module_id','submodule_id')->paginate(10);
        return view('backend.permissions.index', compact('permissions'));
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
        $modules = Module::get();
        $submodules = Submodule::get();

        return view('backend.permissions.create',compact('modules','submodules'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->slug = Str::slug($request->name, '-');
        $permission->module_id = $request->module_id;
		$permission->submodule_id = $request->submodule_id;
        $permission->save();
                LogActivity::addToLog('Permission Created ');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission )
    {
        return view('backend.permissions.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id,
        ]);
        $permission->name = $request->name;
        $permission->slug = Str::slug($request->name, '-');
        $permission->save();
        LogActivity::addToLog('Permission Updated ');

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Permission Deleted');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
    
}
