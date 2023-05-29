<?php

namespace App\Http\Controllers\Backend\Prescription;

use App\Helpers\InvoiceNumber;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\Item\Item;
use App\Models\lab\LabTest;
use App\Models\Patient\Patient;
use App\Models\Prescription\Prescription;
use App\Models\Radiology\RadiologyServiceName;
use App\Models\Symptom\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Collection;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $prescription = Prescription::with(
            'doctor:id,first_name,last_name',
            'diseasesSymptoms:prescription_id,symptom_id',
            'diseasesSymptoms.symptom:id,name',
            'patient:id,name'
        )->latest();
        if ($request->invoice_no) {
            $prescription->where('invoice_number', $request->invoice_no);
        }
        if ($request->patient_name) {
            $prescription->whereHas('patient', function ($query) use ($request) {
                $query->where('name', $request->patient_name);
            });
        }
        if ($request->mobile_number) {
            $prescription->whereHas('patient', function ($query) use ($request) {
                $query->where('mobile', $request->mobile_number);
            });
        }
        if ($request->start_date) {
            $prescription = $prescription->whereHas('appointment', function ($query) use ($request) {
                $query->whereDate('appointment_date', '>=', date('Y-m-d', strtotime($request->start_date)));
            });
        }
        if ($request->end_date) {
            $prescription = $prescription->whereHas('appointment', function ($query) use ($request) {
                $query->whereDate('appointment_date', '<=', date('Y-m-d', strtotime($request->end_date)));
            });
        }
        if ($request->doctor_id) {
            $prescription = $prescription->where('doctor_id', $request->doctor_id);
        }
        $prescription = $prescription->get();

        if (request()->ajax()) {
            return DataTables::of($prescription)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $action = '<div class="dropdown">
                    <button class="btn btn-md dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <div class="dropdown-menu" >
                        <a href="' . route('backend.prescription.show', $row) . '" class="dropdown-item edit_check"
                            data-toggle="tooltip" data-original-title="Show"><i class="fa fa-eye mr-2" aria-hidden="true"></i> Show
                        </a>
                        <div class="dropdown-divider"></div>
                        <a data-href="' . route('backend.prescription.destroy', $row) . '"class="dropdown-item delete_check"  data-toggle="tooltip"
                            data-original-title="Delete" aria-describedby="tooltip64483"><i class="fa fa-trash mr-2" aria-hidden="true"></i> Delete
                        </a>
                    </div></div>';
                    return $action;
                })
                ->addColumn('symptoms', function ($row) {
                    $symptoms = '';
                    foreach ($row->diseasesSymptoms as $key => $value) {
                        $symptoms .= $value->symptom->name . ', ';
                    }
                    return $symptoms;
                })
                ->editColumn('patient_id', function ($row) {
                    return $row->patient->name;
                })
                ->editColumn('doctor_id', function ($row) {
                    return optional($row->doctor)->first_name . optional($row->doctor)->last_name;
                })
                ->editColumn('appointment_id', function ($row) {
                    // return optional($row->appointment)->id??' ';
                    return "<a href='" . route('backend.appointment.show', $row->appointment_id) . "'>" . '<button class="btn btn-sm btn-info"> Appointment </button>' . "</a>";
                })
                ->editColumn('date', function ($row) {
                    return date('d-m-Y', strtotime(optional($row->appointment)->appointment_date) ?? ' ');
                    // return $row->appointment->appointment_date;
                })

                ->removeColumn(['id'])
                ->rawColumns(['action', 'symptoms'])
                ->make(true);
        }

        return view('backend.prescription.index');
        // return view('backend.prescription.index', compact('appointments'));
    }

    public function searchTest(Request $request)
    {

        if ($request->optionData) {

            $testData = LabTest::select('id', 'name')->get()->map(function ($query) {
                $data['name'] = $query->name;
                return $data;
            });

            $radiologyData = RadiologyServiceName::select('id', 'name')->get()->map(function ($query) {
                $data['name'] = $query->name;
                return $data;
            });
            $collection1 = new Collection($testData);
            $collection2 = new Collection($radiologyData);
            $allTest = $collection1->merge($collection2);

            // The letter to search for
            $search_letter = $request->optionData;
            $result = [];

            // Check if the key contains the search letter
            foreach ($allTest as $key => $value) {
                if (strpos(strtolower($value['name']), strtolower($search_letter)) !== false) {
                    array_push($result, $value);
                }
            }
            return response()->json(['data' => $result]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $appointment = Appointment::where('id', $request->appointment)->with('patient')->first();
        return view('backend.prescription.create', compact('appointment'));
    }

    public function getInvoiceNumber()
    {
        if (!Prescription::latest()->first()) {
            return 1;
        } else {
            return Prescription::latest()->first()->invoice_number + 1;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // dd($request->all());
            DB::beginTransaction();
            $data['invoice_number']          = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
            $data['patient_id']              = Patient::where('patientId', $request->p_id)->first()->id;
            $data['date']                    = date('Y-m-d h:i:s');
            $data['doctor_id']               = Appointment::where('id', $request->appointment_id)->first()->doctor_id;
            $data['appointment_id']          = $request->appointment_id;
            $data['advice']                  = $request->advice;
            $data['next_visit']              = $request->next_visit;
            $prescription                    = Prescription::create($data);
            if ($request->symptoms_name) {
                foreach ($request->symptoms_name as $symptomKey => $symptomData) {
                    $symptom = Symptom::firstOrCreate(['name' => $symptomData]);
                    $prescription->diseasesSymptoms()->create(['symptom_id' => $symptom->id, 'note' => $request->symptoms_value[$symptomKey]??'']);

                }
            }

            if ($request->medicine_name) {
                foreach ($request->medicine_name as $key => $medicine) {
                    $prescription->medicines()->create(
                        [
                            'name' => $medicine,
                            // 'how_many_times' => implode($request->how_many_times[$medicine]),
                            'how_many_days' => implode($request->how_many_days[$medicine]),
                            'how_many_quantity' => implode($request->how_many_quantity[$medicine]),
                            'before_after_meal' => implode($request->before_after_meal[$medicine]),
                            'medicine_note' => implode($request->note[$medicine])
                        ]
                    );
                }
            }
            if ($request->p_info) {
                foreach ($request->p_info as $key => $info) {
                    $others = $prescription->otherSpecifications()
                        ->create([
                            'name' => $info,
                            'value' => $request->p_info_value[$key]
                        ]);
                    // dd($others);
                }
            }
            if ($request->test_name) {
                foreach ($request->test_name as $key => $test) {
                    $labTests = $prescription->labTest()->create([
                        'test_name' => $test,
                        'note' => $request->specifications[$key] ?? null
                    ]);
                    // dd($labTests);
                }
            }
            // dd($request->all());
            // dd($prescription);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with(['error' => $ex->getMessage(), $ex->getLine(), 'status' => false]);
        }
        return redirect()->route('backend.prescription.show', $prescription);
        // return back()->with(['success' => 'Prescription Created Successfully', 'status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Prescription $prescription)
    {
        // dd($prescription);
         $prescription = Prescription::whereId($prescription->id)->with('patient', 'labTest', 'doctor', 'appointment', 'diseasesSymptoms.symptom', 'medicines.item.strength', 'otherSpecifications')->first();
        return view('backend.prescription.show', compact('prescription'));
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
