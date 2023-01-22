<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use App\Models\LockerDocumnet;
use App\Models\PersonalLocker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class PersonalLockerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin.locker')->with(['lockers' => PersonalLocker::where('created_by', auth('admin')->id())->get(['id', 'name'])]);
    }
    public function documentIndex($id)
    {
        $document = PersonalLocker::with('documents')->where('created_by', auth('admin')->id())->find($id);
        $columns = (new LockerDocumnet)->getTableColumns();
        unset($columns[0]);
        unset($columns[7]);
        unset($columns[6]);
        unset($columns[5]);
        return view('backend.admin.documentIndex', compact('columns'))->with(['document' => $document]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            PersonalLocker::create(['name' => $request->name]);
        } catch (\Exception $ex) {
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Locker File Created');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']); 
    }
    public function documentStore(Request $request,PersonalLocker  $personalLocker)
    {
        try {
            
            DB::beginTransaction();
            if($request->new_field_1){
                for ($i=0; $i < count($request->new_field_1); $i++) { 
                    $personalLocker->documents()->create([
                        'field_1' =>  Crypt::encryptString($request->new_field_1[$i]),
                        'field_2' =>  Crypt::encryptString($request->new_field_2[$i]),
                        'field_3' =>  Crypt::encryptString($request->new_field_3[$i]),
                        'field_4' =>  Crypt::encryptString($request->new_field_4[$i]),
                    ]);
                }
            }
            if($request->field_1){
                for ($i=0; $i < count($request->field_1); $i++) { 
                    $array_keys = array_keys($request->field_1)[$i];
                    $personalLocker->documents()->where('id', $array_keys)->update([
                        'field_1' =>  Crypt::encryptString($request->field_1[$array_keys]),
                        'field_2' =>  Crypt::encryptString($request->field_2[$array_keys]),
                        'field_3' =>  Crypt::encryptString($request->field_3[$array_keys]),
                        'field_4' =>  Crypt::encryptString($request->field_4[$array_keys]),
                    ]);
                }
            }
            
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with(['status' => false, 'error' =>$ex->getMessage()]);
        }
		(new LogActivity)::addToLog('Locker File Created');
        return back()->with(['status' => true, 'success' => 'Data Deleted Successfully']); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
