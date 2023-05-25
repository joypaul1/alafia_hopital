<?php

namespace App\Http\Controllers\Backend\Pathology;


use App\Http\Controllers\Controller;
use App\Models\lab\LabInvoice;
use App\Models\lab\LabInvoiceTestDetails;
use App\Models\lab\LabTest;
use App\Models\lab\LabTestReport;
use App\Models\SiteConfig\BloodBank;
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

        // start Biochemistry
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Electrolytes') {
            return view('backend.pathology.makeResult.electrolytes', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Fasting Lipid Profile' || $labTest->name == 'Random Lipid Profile') {
            return view('backend.pathology.makeResult.flp', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Fasting Blood Sugar (FBS)') {
            return view('backend.pathology.makeResult.fbs', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Blood Glucose 2 Hrs. AFB') {
            return view('backend.pathology.makeResult.fbs', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'Blood Glucose 2 Hrs. After 75gm Glucose') {
            return view('backend.pathology.makeResult.fbs', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Biochemistry' && $labTest->name == 'e-GFR (Using 4 variable MDRD equation)') {
            return view('backend.pathology.makeResult.e_GFR', compact('data', 'labTest'));
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

        // Micro Biology
        if ($labTest->category == 'Micro Biology' &&  $labTest->name == 'Blood CS Growth') {
            return view('backend.pathology.makeResult.blood.blood_cs_growth', compact('data', 'labTest'));
        }

        if ($labTest->category == 'Micro Biology' &&  $labTest->name == 'Blood CS No Growth') {
            return view('backend.pathology.makeResult.blood.blood_cs_no_growth', compact('data', 'labTest'));
        }
        // Micro Biolo
        // Hematology
        if ($labTest->category == 'Hematology' && $labTest->name == 'CBC') {
            return view('backend.pathology.makeResult.hematology.cbc', compact('data', 'labTest', 'units'));
        }
        if ($labTest->category == 'Hematology' && $labTest->name == 'Blood Group Rh (D) Factor') {
            return view('backend.pathology.makeResult.hematology.rhFactor', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Hematology' && $labTest->name == 'Prothrombin Time (PT)') {
            return view('backend.pathology.makeResult.hematology.prothrombin', compact('data', 'labTest'));
        }
        if ($labTest->category == 'Hematology' && $labTest->name == 'BT,CT') {
            return view('backend.pathology.makeResult.hematology.BT_CT', compact('data', 'labTest'));
        }

        if ($labTest->category == 'Hematology') {
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        // end Hematology

        // Start Immunology
        if ($labTest->category == 'Immunology') {
            return view('backend.pathology.makeResult.create', compact('data', 'labTest'));
        }
        // end Immunology

        //Start Urine
        if ($labTest->category == 'Urine' && $labTest->name == 'Pregnancy Test (PT)') {
            return view('backend.pathology.makeResult.urine.urine_pt', compact('data', 'labTest'));
        }

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
        if ($labTest->category == 'Blood' &&  $labTest->name == 'Blood CS No Growth') {
            return view('backend.pathology.makeResult.blood.blood_cs_no_growth', compact('data', 'labTest'));
        }
        //End Urine
        // dd($labTest);
        // start stool
        if ($labTest->category == 'Stool' && $labTest->name == 'Stool-RE') {
            return view('backend.pathology.makeResult.stool.stool_re', compact('data', 'labTest'));
        }
        // end urine

    }


    public function store(Request $request)
    {
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
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }
            if (($testName->category == 'Blood' && $testName->name == 'Blood CS Growth')) {
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

            if ($testName->category == 'Urine' && $testName->name == 'Urine CS NO Growth') {
                $data['lab_test_id']                    = $request->test_id;
                $data['lab_invoice_test_detail_id']     = $request->lab_invoice_test_detail_id;
                $data['created_by']                     = auth('admin')->user()->id;
                $data['created_date']                   = date('Y-m-d h:i:s');
                $data['patient_id']                     = LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->with('labInvoice.patient')->first()->labInvoice->patient->id;
                $data['result']                         = json_encode($request->reference_value);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }

            if ($testName->category == 'Urine' && $testName->name == 'Urine RE') {
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
                    );
                }
                $data['result']                         = json_encode($multidimensionalArray);
                $labTestReport                          = LabTestReport::create($data);
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }
            if ($testName->category == 'Stool' && $testName->name == 'Stool-RE') {
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
                    );
                }
                $data['result']                         = json_encode($multidimensionalArray);
                // dd($data);
                $labTestReport                          = LabTestReport::create($data);
                // dd( $labTestReport  );
                LabInvoiceTestDetails::where('id', $request->lab_invoice_test_detail_id)->update(['status' => 'completed']);
            }
            if ($testName->category == 'Urine' && $testName->name == "Pregnancy Test (PT)") {
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
                        'reference_value' => $request->except('_token', '_method', 'lab_invoice_test_detail_id', 'test_id')['reference_value'][$i] ?? '',

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
        if ($labTestReport->testName->category  == 'Biochemistry' && $labTestReport->testName->name == 'Fasting Lipid Profile' || $labTestReport->testName->name == 'Random Lipid Profile') {
            return view('backend.pathology.viewResult.lipid_profile', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Fasting Blood Sugar (FBS)') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Electrolytes') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Blood Glucose 2 Hrs. AFB') {
            return view('backend.pathology.viewResult.fbs', compact('labTestReport'));
        }
        if ($labTestReport->testName->category == 'Biochemistry' && $labTestReport->testName->name == 'Blood Group Rh (D) Factor') {
            return view('backend.pathology.viewResult.rhFactor', compact('labTestReport'));
        }
        // dd($labTestReport->testName->category );
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
        if ($labTestReport->testName->category == 'Urine' && $labTestReport->testName->name == 'Pregnancy Test (PT)') {
            return view('backend.pathology.viewResult.urine.urine_cs_no_growth', compact('labTestReport'));
        }
        // end urine
        // start Blood
        // dd($labTestReport->testName,$labTestReport->testName->category == 'Blood' , $labTestReport->testName->name == 'Blood CS Growth');
        if ($labTestReport->testName->category == 'Blood' && $labTestReport->testName->name == 'Blood CS Growth') {
            return view('backend.pathology.viewResult.blood.blood_cs_growth', compact('labTestReport'));
        }
        // dd($labTestReport->testName->name,$labTestReport->testName->category == 'Blood' , $labTestReport->testName->name == 'Blood CS NO Growth');
        if ($labTestReport->testName->category == 'Blood' && $labTestReport->testName->name == 'Blood CS No Growth') {
            return view('backend.pathology.viewResult.blood.blood_cs_no_growth', compact('labTestReport'));
        }
        // end urine
        // dd($labTestReport);
        // start stool
        if ($labTestReport->testName->category == 'Stool' && $labTestReport->testName->name == 'Stool-RE') {
            return view('backend.pathology.viewResult.stool.stool_re', compact('labTestReport'));
        }
        // end urine

    }


    public function printCat(Request $request)
    {

        if ($request->category == 'Biochemistry' || $request->category == 'Serology' || $request->category == 'Hematology' || $request->category == 'Immunology') {
            $labInvoice = LabInvoice::whereId($request->invoice_id)
                ->with('patient', 'doctor')
                ->with(['labTestDetails'
                => function ($query) use ($request) {
                    $query->whereStatus('completed')->whereHas('testName', function ($query) use ($request) {
                        $query->where([
                            ['category', $request->category],
                            ['name', '!=', 'CBC'],
                            // ['name', '!=', 'Fasting Blood Sugar (FBS)'],
                            ['name', '!=', 'Electrolytes'],
                            // ['name', '!=', 'Blood Glucose 2 Hrs. AFB'],
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


    public function printTest(LabInvoice $labInvoice)
    {
        $labInvoice = LabInvoice::whereId($labInvoice->id)->with('labTestDetails.testName')->first();


        return view('backend.pathology.labTest.viewTest', compact('labInvoice'));
    }
    public function printBarCode(LabInvoice $labInvoice)
    {
        //    return $labTest = LabTest::whereName('CUS')->first();
        $printData = [];
        $labInvoice         = LabInvoice::whereId($labInvoice->id)->with('patient')->with('labTestDetails.testName')->first();
        $categoryWiseData   = $labInvoice->labTestDetails->groupBy('testName.category');
        foreach ($labInvoice->labTestDetails as $key => $details) {
            // dd($details->testName->name);
            if ($details->testName->name == 'CUS (2Hours)' || $details->testName->name == 'CUS (F)' || $details->testName->name == 'Fasting Blood Sugar (FBS)' || $details->testName->name == 'Blood Glucose 2 Hrs. AFB' || $details->testName->name == 'Blood Glucose 2 Hrs. After 75gm Glucose') {
                $printData[$details->testName->name] = [$details->testName->tube->name => [
                    $details->testName->short_name => $details->testName->short_name,
                ]];
            } else {

                if ($key == 0) {
                    $printData[$details->testName->category] = [$details->testName->tube->name => [
                        $details->testName->short_name => $details->testName->short_name,
                    ]];
                } else {
                    //check if category exist
                    if (array_key_exists($details->testName->category, $printData)) {
                        //check if tube exist
                        if (array_key_exists($details->testName->tube->name, $printData[$details->testName->category])) {
                            //check if test exist
                            // dd($details->testName->name);
                            // if ($details->testName->name != 'CUS (F)' || $details->testName->name != 'CUS (2Hours)') {
                            if (array_key_exists($details->testName->short_name, $printData[$details->testName->category][$details->testName->tube->name])) {
                                //if exist then do nothing
                            } else {
                                //if not exist then add
                                $printData[$details->testName->category][$details->testName->tube->name][$details->testName->short_name] = $details->testName->short_name;
                            }
                            // }
                        } else {
                            //if tube not exist then add
                            $printData[$details->testName->category][$details->testName->tube->name] = [
                                $details->testName->short_name => $details->testName->short_name,
                            ];
                        }
                    } else {
                        $printData[$details->testName->category] = [$details->testName->tube->name => [
                            $details->testName->short_name => $details->testName->short_name,
                        ]];
                    }
                }
            }
        }
        // dd($printData);
        return view('backend.pathology.labTest.printBarCode', compact('labInvoice', 'printData'));
    }
}
