<?php

namespace App\Http\Controllers\Backend\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Doctor\Doctor;
use App\Models\Employee\Department;
use App\Models\Employee\Designation;
use App\Models\Employee\Shift;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Doctor\StoreRequest;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::get();
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];

        return view('backend.doctor.home.index', compact('doctors', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::select('id', 'first_name')->get();
        $status=  (object)[['name' =>'Active', 'id' =>1 ],['name' =>'Inactive', 'id' => 0 ]];
        $departments = Department::select('id', 'name')->get();
        $designations = Designation::select('id', 'name')->get();
        $roles = Role::select('id', 'name')->get();
        $shifts = Shift::select('id', 'name')->get();
        return view('backend.doctor.home.create', compact('doctors', 'status',
         'departments', 'designations', 'roles', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        dd($request->storeRequest());
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
