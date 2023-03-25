<?php

namespace App\Http\Controllers\Backend\Pathology;


use App\Http\Controllers\Controller;
use App\Models\lab\LabInvoiceTestDetails;
use App\Models\lab\LabTestSingleReport;
use Illuminate\Http\Request;


class LabTestResultController extends Controller
{
    public function create(Request $request)
    {
        $labInvoiceTestDetail= LabInvoiceTestDetails::where('id', $request->id)->with('testName')->first();
        return view('backend.pathology.singleTest.create', compact('labInvoiceTestDetail'));
    }


    public function store(Request $request)
    {
        $data['created_date']                   = date('Y-m-d h:i:s' );
        $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
        $data['lab_test_id']    = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('testName')->first()->testName->id;
        $data['patient_id']     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
        $labTestSingleReport    = LabTestSingleReport::create($data);

        return view('backend.pathology.singleTest.show', compact('labTestSingleReport'));

    }


    public function show($id)
    {
         $labTestSingleReport= LabTestSingleReport::whereId($id)->first();
        return view('backend.pathology.singleTest.show', compact('labTestSingleReport'));
    }
}
