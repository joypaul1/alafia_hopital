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
        if($labTest->category == 'Biochemistry' && $labTest->name != 'CBC'){
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'CBC') {
            return view('backend.pathology.makeResult.cbc', compact('data', 'labTest'));
        }

    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $testName = LabTest::whereId($request->test_id)->first();
            if($testName->category == 'Biochemistry'){
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
                $data ['result']                        = json_encode($request->except('_token', '_method','lab_invoice_test_detail_id','test_id'));
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);

            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage());
        }

        return redirect()->route('backend.pathology.make-test-result-show', ['id'=>$labTestReport->id]);


    }

    public function show(Request $request)
    {

         $labTestReport = LabTestReport::whereId($request->id)->with('labInvoiceTestDetails.labInvoice', 'patient', 'testName')->first();
        // dd($labTestReport);
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'CBC') {
            return view('backend.pathology.viewResult.cbc', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name != 'CBC') {
            return view('backend.pathology.viewResult.show', compact('labTestReport'));
        }

    }
}
