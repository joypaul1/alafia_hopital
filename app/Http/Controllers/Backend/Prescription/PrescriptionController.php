<?php

namespace App\Http\Controllers\Backend\Prescription;

use App\Helpers\InvoiceNumber;
use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\Patient\Patient;
use App\Models\Prescription\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        if(auth('admin')->user()->can('view-prescription')){

        if ($request->optionData) {
            return response()->json(['data' => Prescription::
                // whereLike($request->optionData, 'mobile')->whereLike($request->optionData, 'name')->whereLike($request->optionData, 'patientId')->whereLike($request->optionData, 'email')->take(15)
                all()]);
        }
        // $appointments =Prescription::latest()->get();

        return view('backend.prescription.index');
        // return view('backend.prescription.index', compact('appointments'));
    }
    abort(403, 'Unauthorized action.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(auth('admin')->user()->can('create-prescription')){

        return view('backend.prescription.create');
        }
        abort(403, 'Unauthorized action.');

    }

    public function getInvoiceNumber()
    {
        if (!Prescription::latest()->first()) {
            return 1;
        } else {
            return Prescription::latest()->first()->patientId + 1;
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

        // dd($request->all(), json_encode($request->p_info), json_encode($request->p_info_value));
        try {
            DB::beginTransaction();
            $data['invoice_number']          = (new InvoiceNumber)->invoice_num($this->getInvoiceNumber());
            $data['patient_id']              = Patient::where('patientId', $request->p_id)->first()->id;
            $data['date']                    =  date('Y-m-d h:i:s');
            // $data['doctor_id']               = auth('admin')->user()->id;
            $data['doctor_id']               = 26;
            // $data['appointment_id']          = Appointment::where('doctor_id', auth('admin')->user()->id)->where('patient_id', $data['patient_id'])->first()->id;
            $data['appointment_id']          = Appointment::where('patient_id', $data['patient_id'])->first()->id;
            $data['advice']                  = $request->advice;
            $data['next_visit']              = $request->next_visit;
            $prescription                    = Prescription::create($data);
            if ($request->symptoms_id) {
                foreach ($request->symptoms_id as $key => $symptom) {
                    $prescription->diseasesSymptoms()->create(['symptom_id' => $symptom]);
                }
            }

            if ($request->item_id) {
                foreach ($request->item_id as $key => $medicine) {
                    $v = $prescription->medicine()->create(
                        [
                            'item_id' => $medicine,
                            'how_many_times' => implode($request->how_many_times[$medicine]),
                            'how_many_days' => implode($request->how_many_days[$medicine]),
                            'how_many_quantity' => implode($request->how_many_quantity[$medicine]),
                            'before_after_meal' => implode($request->before_after_meal[$medicine]),
                            'medicine_note' => implode($request->note[$medicine])
                        ]
                    );
                }
            }
            if($request->p_info){
                foreach ($request->p_info as $key => $info) {
                   $others= $prescription->otherSpecifications()
                    ->create(['name' => $info,
                    'value' => $request->p_info_value[$key]]);
                    // dd($others);
                }
            }

            // dd($prescription);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return back()->with(['error' => $ex->getMessage(), $ex->getLine(), 'status' => false]);
        }

        return back()->with(['success' => 'Prescription Created Successfully', 'status' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
