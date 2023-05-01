<?php

namespace App\Http\Controllers\Backend\Pathology;


use App\Http\Controllers\Controller;
use App\Models\lab\LabInvoice;
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
            ['id' => 'µg/dl', 'name' => 'µg/dl'],
            ['id' => 'U/L', 'name' => 'U/L'],
            ['id' => 'g/dl', 'name' => 'g/dl'],
            ['id' => 'mmol/l', 'name' => 'mmol/l'],
            ['id' => '%', 'name' => '%'],
        ];
        $data = $request->all();
        $labTest = LabTest::whereId($request->labTest_id)->first();
        // dd($labTest );
        // start Biochemistry
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Electrolytes') {
            return view('backend.pathology.makeResult.electrolytes', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Fasting Lipid Profile') {
            return view('backend.pathology.makeResult.flp', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Fasting Blood Sugar (FBS)') {
            return view('backend.pathology.makeResult.fbs', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Blood Glucose 2 Hrs. AFB') {
            return view('backend.pathology.makeResult.fbs', compact('data', 'labTest'));
        }


        if ($labTest->category == 'Biochemistry') {
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }

        // End Biochemistry

        // Serology
        if ($labTest->category == 'Serology' &&  $labTest->name == 'Dengue Ns1') {
            return view('backend.pathology.makeResult.serology.dengue', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Serology' &&  $labTest->name == 'Widal Test') {
            return view('backend.pathology.makeResult.serology.widal_test', compact('data', 'labTest'));
        }


        if ($labTest->category == 'Serology') {
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        // end Serology

        // Micro Biolo
        if ($labTest->category == 'Micro Biology' &&  $labTest->name == 'Blood CS Growth') {
            return view('backend.pathology.makeResult.blood.blood_cs_growth', compact('data', 'labTest'));
        }

        if ($labTest->category == 'Micro Biology' &&  $labTest->name == 'Blood CS No Growth') {
            return view('backend.pathology.makeResult.blood.blood_cs_no_growth', compact('data', 'labTest'));
        }
        // Micro Biolo
        // Hematology
        if ($labTest->category == 'Hematology' && $labTest->name == 'CBC') {
            return view('backend.pathology.makeResult.cbc', compact('data', 'labTest', 'units'));
        }
        if ($labTest->category == 'Hematology') {
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        // end Hematology
        // Immunology
        if ($labTest->category == 'Immunology') {
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        // end Immunology

        //Start Urine
        if ($labTest->category == 'Urine' && $labTest->name == 'Urine RE') {
            return view('backend.pathology.makeResult.urine.urine_re', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Urine' &&  $labTest->name == 'Urine CS Growth') {
            return view('backend.pathology.makeResult.urine.urine_cs_growth', compact('data', 'labTest'));
        }

        if ($labTest->category == 'Urine' &&  $labTest->name == 'Urine CS NO Growth') {
            return view('backend.pathology.makeResult.urine.urine_cs_no_growth', compact('data', 'labTest'));
        }
        //End Urine
        //Start blood
        if ($labTest->category == 'Blood' &&  $labTest->name == 'Blood CS Growth') {
            return view('backend.pathology.makeResult.blood.blood_cs_growth', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Blood' &&  $labTest->name == 'Blood CS No Growth'){
            return view('backend.pathology.makeResult.blood.blood_cs_no_growth', compact('data', 'labTest'));
        }
        //End Urine

    }


    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $labTestReport = null;
            $testName = LabTest::whereId($request->test_id)->first();
            if ($testName->category == 'Biochemistry' || $testName->category == 'Hematology' || $testName->category == 'Serology' || $testName->category == 'Immunology') {
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;

                $multidimensionalArray = array();
                for ($i = 0; $i < count($request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['name']); $i++) {
                    $multidimensionalArray[$i] = array(
                        'name' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['name'][$i] ?? '',
                        'result' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['result'][$i] ?? '',
                        'unit' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['unit'][$i] ?? '',
                        'reference_value' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['reference_value'][$i] ?? '',
                    );
                }
                $data['result'] = json_encode($multidimensionalArray);
                // dd($data);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }
            if (($testName->category == 'Micro Biology' && $testName->name == 'Blood CS Growth')) {
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;

                $multidimensionalArray = array();
                for ($i = 0; $i < count($request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['name']); $i++) {
                    $multidimensionalArray[$i] = array(
                        'name' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['name'][$i] ?? '',
                        'a' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['a'][$i] ?? '',
                        'b' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['b'][$i] ?? '',
                        'c' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['c'][$i] ?? '',
                    );
                }
                $data['result'] = json_encode($multidimensionalArray);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }
            // dd($testName);
            if ($testName->category == 'Urine' && $testName->name == 'Urine CS Growth') {
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;

                $multidimensionalArray = array();
                for ($i = 0; $i < count($request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['name']); $i++) {
                    $multidimensionalArray[$i] = array(
                        'name' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['name'][$i] ?? '',
                        'a' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['a'][$i] ?? '',
                        'b' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['b'][$i] ?? '',
                        'c' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['c'][$i] ?? '',
                    );
                }
                $data['result'] = json_encode($multidimensionalArray);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }
            if (($testName->category == 'Blood' && $testName->name == 'Blood CS No Growth')) {
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
                $data['result'] = json_encode($request->reference_value);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }

            if ($testName->category == 'Urine' && $testName->name == 'Urine CS NO Growth') {
                // dd(213123);
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
                $data['result'] = json_encode($request->reference_value);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }

            // DD($testName);
            if ($testName->category == 'Urine' && $testName->name == 'Urine RE') {
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
                // $data['result']                         = json_encode($request->reference_value);
                $multidimensionalArray = array();
                for ($i = 0; $i < count($request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['name']); $i++) {
                    $multidimensionalArray[$i] = array(
                        'name' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['name'][$i] ?? '',
                        'result' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['result'][$i] ?? '',
                    );
                }
                $data['result']                         = json_encode($multidimensionalArray);
                // dd($data);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            dd($ex->getMessage(), $ex->getLine(), $ex->getFile());
        }

        return redirect()->route('backend.pathology.make-test-result-show', ['id' => $labTestReport->id]);
    }

    public function show(Request $request)
    {
        $labTestReport = LabTestReport::whereId($request->id)->with('labInvoiceTestDetails.labInvoice', 'patient', 'testName')->first();
        if ($request->labDetails_id) {
            $labTestReport = LabTestReport::where([
                ['lab_invoice_test_detail_id', $request->labDetails_id],
                ['lab_test_id', $request->labTest_id]
            ])
                ->with('labInvoiceTestDetails.labInvoice', 'patient', 'testName')->first();
        }
        // start Biochemistry

        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Fasting Blood Sugar (FBS)') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Electrolytes') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Blood Glucose 2 Hrs. AFB') {
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
        if ($labTestReport->testName->category == 'Hematology' && $labTestReport->testName->name == 'CBC') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Hematology') {
            return view('backend.pathology.viewResult.show', compact('labTestReport'));
        }
        // end Hematology
        // start Hematology
        if ($labTestReport->testName->category == 'Immunology') {
            return view('backend.pathology.viewResult.show', compact('labTestReport'));
        }
        // end Hematology
        // start Blood
        if ($labTestReport->testName->category == 'Micro Biology' && $labTestReport->testName->name == 'Blood CS No Growth') {
            return view('backend.pathology.viewResult.blood.blood_cs_no_growth', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Micro Biology' && $labTestReport->testName->name == 'Blood CS Growth') {
            // return view('backend.pathology.viewResult.blood.blood_cs_growth', compact('labTestReport'));
        }

        // end Blood
        // start urine
        if ($labTestReport->testName->category == 'Urine' && $labTestReport->testName->name == 'Urine RE') {
            return view('backend.pathology.viewResult.urine.urine_re', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Urine' && $labTestReport->testName->name == 'Urine CS Growth') {
            return view('backend.pathology.viewResult.urine.urine_cs_growth', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Urine' && $labTestReport->testName->name == 'Urine CS NO Growth') {
            return view('backend.pathology.viewResult.urine.urine_cs_no_growth', compact('labTestReport'));
        }
        // end urine
        // start Blood
        // dd($labTestReport);
        // dd($labTestReport->testName,$labTestReport->testName->category == 'Blood' , $labTestReport->testName->name == 'Blood CS Growth');
        if ($labTestReport->testName->category == 'Blood' && $labTestReport->testName->name == 'Blood CS Growth') {
            return view('backend.pathology.viewResult.blood.blood_cs_growth', compact('labTestReport'));
        }
        // dd($labTestReport->testName->name,$labTestReport->testName->category == 'Blood' , $labTestReport->testName->name == 'Blood CS NO Growth');
        if ($labTestReport->testName->category == 'Blood' && $labTestReport->testName->name == 'Blood CS No Growth') {
            return view('backend.pathology.viewResult.blood.blood_cs_no_growth', compact('labTestReport'));
        }
        // end urine


    }


    public function printCat(Request $request)
    {
        // category, invoice_id
        // dd(LabInvoice::whereId($request->invoice_id)->first());
        if ($request->category == 'Biochemistry' || $request->category == 'Serology' || $request->category == 'Hematology' || $request->category == 'Immunology') {
            $labInvoice = LabInvoice::whereId($request->invoice_id)
                ->with('patient', 'doctor')
                ->with(['labTestDetails'
                => function ($query) use ($request) {
                    $query->whereStatus('completed')->whereHas('testName', function ($query) use ($request) {
                        $query->where([
                            ['category', $request->category],
                            ['name', '!=', 'CBC'],
                            ['name', '!=', 'Fasting Blood Sugar (FBS)'],
                            ['name', '!=', 'Electrolytes'],
                            ['name', '!=', 'Blood Glucose 2 Hrs. AFB'],
                            ['name', '!=', 'Urine RE'],
                            ['name', '!=', 'Urine CS Growth'],
                            ['name', '!=', 'Urine CS NO Growth'],
                        ]);
                    })
                        ->with('testName:id,name,category')
                        ->with('viewResult');
                }])->first();
            $doctor             = $labInvoice->doctor ?? [];
            $date               = $labInvoice->date;
            $invoice_no         = $labInvoice->invoice_no;
            $patient            = $labInvoice->patient;
            $labTestReport      = [];
            $labTestReport      = $labInvoice->labTestDetails;
            $category = $request->category;

            return view('backend.pathology.viewResult.catWise.show', compact('labTestReport', 'category', 'patient', 'invoice_no', 'date', 'doctor'));
        }
    }
}
