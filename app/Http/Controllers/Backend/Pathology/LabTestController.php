<?php

namespace App\Http\Controllers\Backend\Pathology;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Pathology\Lab\StoreRequest;
use App\Models\Doctor\Doctor;
use App\Models\lab\LabInvoice;
use App\Models\lab\LabTest;
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
        // dd(312312);
        $labInvoices =   LabInvoice::query();
        if ($request->invoice_no) {
            $labInvoices = $labInvoices->where('invoice_no', $request->invoice_no);
        }
        if ($request->status) {
            $labInvoices = $labInvoices->where('status', $request->status);
        }
        if ($request->start_date) {
            $labInvoices = $labInvoices->whereDate('date', '>=', date('Y-m-d', strtotime($request->start_date)));
        } else {
            $labInvoices = $labInvoices->whereDate('date', '>=', date('Y-m-d'));
        }
        if ($request->end_date) {
            $labInvoices = $labInvoices->whereDate('date', '<=',  date('Y-m-d', strtotime($request->end_date)));
        } else {
            $labInvoices = $labInvoices->whereDate('date', '>=', date('Y-m-d'));
        }
        $labInvoices =  $labInvoices->with('labTestDetails.testName:id,name,category', 'labTestDetails.viewResult', 'patient:id,name')->latest()->get();
        // dd($request->status);
        // $status =  (object)[['name' => 'collection', 'id' => 'collection'], ['name' => 'Inactive', 'id' => 0]];
        if ($request->status) {
            return view('backend.pathology.labTest.' . $request->status, compact('labInvoices'));
        }
        return view('backend.pathology.labTest.index', compact('labInvoices'));
    }



    /**
     *
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

    }

    public function getSlotNumber()
    {
        if (!LabInvoice::latest()->whereDate('slot_date', date('Y-m-d'))->first()) {
            return 1;
        } else {
            return LabInvoice::latest()->whereDate('slot_date', date('Y-m-d'))->first()->slot_number + 1;
        }
    }

    public function changeStatus(Request $request)
    {
        $getSlotNumber = null;
        $getSlotNumber = $this->getSlotNumber();
        if (request()->ajax()) {
            $labInvoices = LabInvoice::whereIn('id', $request->ids)->get();
            for ($i = 0; $i < count($labInvoices); $i++) {
                LabInvoice::whereId($labInvoices[$i]->id)->update(
                    ['status' => $request->status, 'slot_number' => $getSlotNumber, 'slot_date' => date('Y-m-d')
                ]);
            }
            return response()->json(['status' => true, 'msg' => 'Status Changed Successfully', 'slot_number' => $getSlotNumber, 'slot_date' => date('Y-m-d')]);
        } else {
            LabInvoice::whereId($request->id)->update(['status' => $request->status ]);
            return back()->with('success', 'Status Changed Successfully');
        }
    }
    public function viewSlot(Request $request)
    {
        $labInvoices = LabInvoice::whereDate('slot_date', $request->slot_date)->where('slot_number', $request->slot_number)
        ->with('labTestDetails.testName:id,name,category','patient:id,name,patientId')
        ->get();
        return view('backend.pathology.labTest.slot', compact('labInvoices'));
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

    public function payment($id)
    {
        $labInvoice = LabInvoice::whereId($id)
        ->first();
        return view('backend.pathology.labTest.payment', compact('labInvoice'));

    }
    public function paymentStore(Request $request, $id)
    {
        $labInvoice = LabInvoice::whereId($id)->first();
        if( $labInvoice){
            $testObject = new StoreRequest();
            $returnData  = $testObject->paymentStore($labInvoice, $request);
            if ($returnData->getData()->status) {
                (new LogActivity)::addToLog('Pathology Lab Test Payment Create');
                return redirect()->route('backend.pathology.payment.multiInvoice', $returnData->getData()->data);
            }
            return back()->with('error', $returnData->getData()->msg);
        }

        return back();

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
    }
    public function multiInvoice($id)
    {

        $labInvoice = LabInvoice::whereId($id)->with('patient', 'paymentHistories.paymentMethodName')->first();
        return view('backend.pathology.labTest.historymoneyReceipt', compact('labInvoice'));
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
