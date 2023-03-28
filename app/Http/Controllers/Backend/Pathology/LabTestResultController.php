<?php

namespace App\Http\Controllers\Backend\Pathology;


use App\Http\Controllers\Controller;
use App\Models\lab\LabInvoiceTestDetails;
use App\Models\lab\LabTestReport;
use Illuminate\Http\Request;


class LabTestResultController extends Controller
{
    public function create(Request $request)
    {
        dd($request->all());
        $labInvoiceTestDetail= LabInvoiceTestDetails::where('id', $request->id)->with('testName')->first();
        // dd($labInvoiceTestDetail->testName);
        // return view('backend.pathology.singleTest.create', compact('labInvoiceTestDetail'));
        return view('backend.pathology.singleTest.cbc', compact('labInvoiceTestDetail'));
    }


    public function store(Request $request)
    {
        dd($request->all());
        $data['created_date']                   = date('Y-m-d h:i:s' );
        // $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
        // $data['lab_test_id']                    = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('testName')->first()->testName->id;
        $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
        $LabTestReport                          = LabTestReport::create($data);

        return view('backend.pathology.singleTest.show', compact('LabTestReport'));

    }


    public function show($id)
    {
        $LabTestReport= LabTestReport::whereId($id)->first();
        return view('backend.pathology.singleTest.show', compact('LabTestReport'));
    }
}
