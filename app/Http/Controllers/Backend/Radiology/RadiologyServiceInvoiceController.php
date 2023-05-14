<?php

namespace App\Http\Controllers\Backend\Radiology;

use App\Helpers\LogActivity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Radiology\StoreRequest;
use App\Models\Account\AccountLedger;
use App\Models\Doctor\Doctor;
use App\Models\PaymentSystem;
use App\Models\Radiology\RadiologyServiceInvoice;
use App\Models\Radiology\RadiologyServiceInvoiceItem;

class RadiologyServiceInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $labInvoices =   RadiologyServiceInvoice::query();
        if ($request->patient_id) {
            $labInvoices = $labInvoices->whereHas('patient', function($query) use($request){
                return $query->Where('patientId','like', "%{$request->patient_id}%");
            });
        }
        if ($request->mobile_number) {
            $labInvoices = $labInvoices->whereHas('patient', function($query) use($request){
                return $query->Where('mobile','like', "%{$request->mobile_number}%");
            });
        }
        if ($request->invoice_no) {
            $labInvoices = $labInvoices->where('invoice_no', $request->invoice_no);
        }
        if ($request->payment_status) {
            $labInvoices = $labInvoices->where('payment_status', $request->payment_status);
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
        $payment_status=(object)[['name'=>'Paid', 'id'=> 'paid'],['name'=>'Due', 'id' => 'due']];

        $labInvoices =  $labInvoices->with('itemDetails.serviceName:id,name', 'patient:id,name,patientId')->latest()->get();

        return view('backend.radiology.index', compact('labInvoices', 'payment_status'));
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
        $dis_status =  (object)[['name' => 'Percentage', 'id' => 'percentage'], ['name' => 'Flat', 'id' => 'flat']];
        $payment_methods = PaymentSystem::get(['id', 'name']);
        $payment_accounts = AccountLedger::where('rec_pay', true)->get(['id', 'name']);
        return view('backend.radiology.create', compact('doctors', 'payment_methods', 'payment_accounts', 'dis_status'));
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
            return redirect()->route('backend.radiologyServiceInvoice.show', $returnData->getData()->data);
        }
        return back()->with('error', $returnData->getData()->msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $radiologyServiceInvoice = RadiologyServiceInvoice::whereId($id)->with('itemDetails.serviceName:id,name', 'patient')->first();
        return view('backend.radiology.moneyReceipt', compact('radiologyServiceInvoice'));
    }

    public function makeResult($id)
    {
        $radiologyServiceInvoiceItem = RadiologyServiceInvoiceItem::whereId($id)->with('serviceName', 'serviceInvoice')->first();
        return view('backend.radiology.makeResult.create', compact('radiologyServiceInvoiceItem'));
    }

    public function storeResult(Request $request, $id)
    {
        $radiologyServiceInvoiceItem = RadiologyServiceInvoiceItem::whereId($id)->first();
        try {
            $radiologyServiceInvoiceItem->update([
                'result' => $request->result,
                'status' => 'completed',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('backend.radiologyServiceInvoice.make-test-result-show', $radiologyServiceInvoiceItem->id);
    }
    public function showResult($id)
    {
        $radiologyServiceInvoiceItem = RadiologyServiceInvoiceItem::whereId($id)->with('serviceName')->first();
        return view('backend.radiology.makeResult.show', compact('radiologyServiceInvoiceItem'));
    }


    public function payment($id)
    {
         $labInvoice = RadiologyServiceInvoice::whereId($id)->first();
        return view('backend.radiology.payment', compact('labInvoice'));
    }
    public function paymentStore(Request $request, $id)
    {
        $labInvoice = RadiologyServiceInvoice::whereId($id)->first();
        if ($labInvoice) {
            $testObject = new StoreRequest();
            $returnData  = $testObject->paymentStore($labInvoice, $request);
            if ($returnData->getData()->status) {
                (new LogActivity)::addToLog('Pathology Lab Test Payment Create');
                return redirect()->route('backend.radiology.payment.multiInvoice', $returnData->getData()->data);
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
         $labInvoice = RadiologyServiceInvoice::whereId($id)->with('patient', 'paymentHistories.paymentMethodName')->first();
        return view('backend.radiology.historymoneyReceipt', compact('labInvoice'));
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
