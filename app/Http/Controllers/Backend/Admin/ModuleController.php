<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\LogActivity;


class ModuleController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('admin')->user()->can('view-module')){

        $modules = Module::select('id', 'name')->paginate(10);
        return view('backend.modules.index', compact('modules'));
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
        return view('backend.modules.create');

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
            'name' => 'required|unique:modules,name',
        ]);
        $module = new Module();
        $module->name = $request->name;
        $module->slug = Str::slug($request->name, '-');
        $module->save();
                LogActivity::addToLog('Module Created ');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module )
    {
        return view('backend.modules.edit',compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $request->validate([
            'name' => 'required|unique:modules,name,'.$module->id,
        ]);
        $module->name = $request->name;
        $module->slug = Str::slug($request->name, '-');
        $module->save();
                        LogActivity::addToLog('Module Updated ');

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        try {
            $module->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Module Deleted');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }
   }
