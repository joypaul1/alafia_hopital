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
        $units = (object)[
            ['id' => 'mg/dl', 'name' => 'mg/dl'],
            ['id' => 'mmol/l', 'name' => 'mmol/l'],
            ['id' => 'Nil', 'name' => 'Nil'],
            ['id' => 'µg/dl' , 'name' => 'µg/dl' ],
            ['id' => 'U/L' , 'name' => 'U/L' ],
            ['id' => 'g/dl' , 'name' => 'g/dl' ],
            ['id' => 'mmol/l' , 'name' => 'mmol/l' ],
            ['id' => '%' , 'name' => '%' ],
        ];
        $data = $request->all();
        $labTest = LabTest::whereId($request->labTest_id)->first();

        // start Biochemistry
        if($labTest->category == 'Biochemistry' && $labTest->name == 'Electrolytes'){
            return view('backend.pathology.makeResult.electrolytes', compact('data', 'labTest'));
        }
        if($labTest->category == 'Biochemistry' && $labTest->name == 'Fasting Lipid Profile'){
            return view('backend.pathology.makeResult.flp', compact('data', 'labTest'));
        }
        if($labTest->category == 'Biochemistry' && $labTest->name == 'Fasting Blood Sugar (FBS)'){
            return view('backend.pathology.makeResult.fbs', compact('data', 'labTest'));
        }
        if($labTest->category == 'Biochemistry' && $labTest->name == 'Blood Glucose 2 Hrs. After 75gm Glucose'){
            return view('backend.pathology.makeResult.fbs', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'CBC') {
            return view('backend.pathology.makeResult.cbc', compact('data', 'labTest', 'units'));
        }

        if($labTest->category == 'Biochemistry'){
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }

        // End Biochemistry

        // Serology
        if($labTest->category == 'Serology' ){
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        // end Serology

        // Hematology
        if($labTest->category == 'Hematology' ){
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        // end Hematology
        // Immunology
        if($labTest->category == 'Immunology' ){
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        // end Immunology

    }


    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $labTestReport = null;
            $testName = LabTest::whereId($request->test_id)->first();
            if($testName->category == 'Biochemistry' || $testName->category == 'Hematology'|| $testName->category == 'Serology' || $testName->category == 'Immunology' ){
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
                // make multidimensional associative array for input name
                // dd($request->except('_token', '_method','lab_invoice_test_detail_id','test_id'));
                $value = [];
                $value['name'] = [];
                $value['result'] = [];
                $value['unit'] = [];
                $value['reference_value'] = [];

                $multidimensionalArray = array();
                for ($i=0; $i < count($request->except('_token', '_method','lab_invoice_test_detail_id','test_id')['name']); $i++) {
                    $multidimensionalArray[$i] = array(
                        'name' =>$request->except('_token', '_method','lab_invoice_test_detail_id','test_id')['name'][$i]??'',
                        'result' =>$request->except('_token', '_method','lab_invoice_test_detail_id','test_id')['result'][$i]??'',
                        'unit' =>$request->except('_token', '_method','lab_invoice_test_detail_id','test_id')['unit'][$i]??'',
                        'reference_value' =>$request->except('_token', '_method','lab_invoice_test_detail_id','test_id')['reference_value'][$i]??'',
                    );
                }
                $data['result'] = json_encode($multidimensionalArray);
                // dd($data);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage(), $ex->getLine(), $ex->getFile());
        }

        return redirect()->route('backend.pathology.make-test-result-show', ['id'=> $labTestReport->id]);


    }

    public function show(Request $request)
    {
        $labTestReport = LabTestReport::whereId($request->id)->with('labInvoiceTestDetails.labInvoice', 'patient', 'testName')->first();

        // start Biochemistry
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'CBC') {
            return view('backend.pathology.viewResult.cbc', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Fasting Blood Sugar (FBS)') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Electrolytes') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Blood Glucose 2 Hrs. After 75gm Glucose') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }

        if ($labTestReport->testName->category == 'Biochemistry') {
            return view('backend.pathology.viewResult.show', compact('labTestReport'));
        }

        // end Biochemistry

        // start Serology
        if ($labTestReport->testName->category == 'Serology') {
            return view('backend.pathology.viewResult.show', compact('labTestReport'));
        }
        // end Serology

        // start Hematology
        if ($labTestReport->testName->category == 'Hematology') {
            return view('backend.pathology.viewResult.show', compact('labTestReport'));
        }
        // end Hematology
        // start Hematology
        if ($labTestReport->testName->category == 'Immunology') {
            return view('backend.pathology.viewResult.show', compact('labTestReport'));
        }
        // end Hematology
    }
}
