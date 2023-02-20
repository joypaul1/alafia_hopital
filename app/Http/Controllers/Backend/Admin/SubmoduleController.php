<?php

namespace App\Http\Controllers\Backend\Admin;
use App\Http\Controllers\Controller;
use App\Models\Submodule;
use App\Models\Module;

use App\Http\Requests\StoreSubmoduleRequest;
use App\Http\Requests\UpdateSubmoduleRequest;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubmoduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth('admin')->user()->can('view-submodule')){

        $submodules = Submodule::select('id', 'name')->paginate(10);
        return view('backend.submodules.index', compact('submodules'));
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
        return view('backend.submodules.create',compact('modules'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubmoduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:submodules,name',
        ]);
        $submodule = new Submodule();
        $submodule->name = $request->name;
        $submodule->slug = Str::slug($request->name, '-');
		$submodule->module_id = $request->module_id;
        $submodule->save();
                LogActivity::addToLog('Submodule Created ');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Submodule  $submodule
     * @return \Illuminate\Http\Response
     */
    public function edit(Submodule $submodule )
    {
        return view('backend.submodules.edit',compact('submodule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submodule $submodule)
    {
        $request->validate([
            'name' => 'required|unique:submodules,name,'.$submodule->id,
        ]);
        $submodule->name = $request->name;
        $submodule->slug = Str::slug($request->name, '-');
        $submodule->save();
        LogActivity::addToLog('Submodule Updated ');

        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submodule $submodule)
    {
        try {
            $submodule->delete();
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Submodule Deleted');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']);
    }}
