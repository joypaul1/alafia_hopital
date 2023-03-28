<?php

namespace App\Http\Controllers\Backend\Pathology;


use App\Http\Controllers\Controller;
use App\Models\lab\LabInvoiceTestDetails;
use App\Models\lab\LabTest;
use App\Models\lab\LabTestReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabTestResultController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->all();

        $labTest = LabTest::whereId($request->labTest_id)->first();
        if ($labTest->name == 'CBC') {
            return view('backend.pathology.singleTest.cbc', compact('data'));
        }
        return view('backend.pathology.singleTest.create', compact('labInvoiceTestDetail'));
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data['lab_test_id']                    = $request->test_id;
            $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
            $data['created_by']                     = auth('admin')->user()->id;
            $data['created_date']                   = date('Y-m-d h:i:s');
            $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
            $labTestReport  = LabTestReport::create($data);

            foreach ($request->name as $key => $NameValue) {
                $labTestReport->details()->create([
                    'name'          => $NameValue,
                    'result'        => $request->result[$key],
                    'reference'     => $request->reference[$key]
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage());
        }
        $testName = LabTest::whereId($request->test_id)->first()->name;
        if ($testName == 'CBC') {
            return redirect()->route('admin.pathology.singleTest.show', $labTestReport->id)->with('success', 'Test Result Added Successfully');
        }

        return view('backend.pathology.singleTest.show', compact('LabTestReport'));
    }


    public function show($id)
    {
        $LabTestReport = LabTestReport::whereId($id)->first();
        return view('backend.pathology.singleTest.show', compact('LabTestReport'));
    }
}
