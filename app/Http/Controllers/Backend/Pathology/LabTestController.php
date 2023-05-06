<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Pathology\Lab\StoreRequest;
use App\Models\Doctor\Doctor;
use App\Models\lab\LabInvoice;
use App\Models\lab\LabTestReport;
use Carbon\Carbon;

class LabTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $labInvoices =   LabInvoice::query();
        if($request->invoice_no){
            $labInvoices= $labInvoices->where('invoice_no', $request->invoice_no);
        }
        if($request->status){
            $labInvoices= $labInvoices->where('status', $request->status);
        }
        if($request->start_date){
            $labInvoices= $labInvoices->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date)));
        }
        if($request->end_date){
            $labInvoices= $labInvoices->whereDate('date', '<=',  date('Y-m-d', strtotime($request->end_date)));
        }
        $labInvoices=  $labInvoices->with('labTestDetails.testName:id,name,category', 'labTestDetails.viewResult', 'patient:id,name')->latest()->get();
        $status=  (object)[['name' =>'collection', 'id' =>'collection' ],['name' =>'Inactive', 'id' => 0 ]];

        return view('backend.pathology.labTest.index', compact('labInvoices','status'));
    }

    /**
     * ALTER TABLE `lab_invoices` CHANGE `status` `status` VARCHAR(10) NOT NULL DEFAULT 'collection';
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::active()->get()->map(function ($query) {
            return [
                'id' => $query->id,
                'name' => $query->first_name . $query->last_name,
            ];
        });
        return view('backend.pathology.labTest.create', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
         $returnData = $request->storeData();
        if ($returnData->getData()->status) {
            (new LogActivity)::addToLog('Pathology Lab Test Invoice Created');
            return redirect()->route('backend.pathology.labTest.show', $returnData->getData()->data);
        }
        return back()->with('error', $returnData->getData()->msg);

        // return response()->json(['error' =>$returnData->getData()->msg,'status' =>false], 400) ;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $labInvoice = LabInvoice::whereId($id)
            ->with('labTestDetails.testName:id,name,category', 'patient')
            ->with('labTestTube.tubeName:id,name')
            ->first();
        return view('backend.pathology.labTest.moneyReceipt', compact('labInvoice'));
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
