<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment\Appointment;
use App\Models\Doctor\Doctor;
use App\Models\Employee\Department;
use Illuminate\Http\Request;



class AppointmentController extends Controller
{
    public function department()
    {
        return response()->json([
            'status' => 'success',
            'data' => Department::select('id', 'name')->get()
        ]);
    }

    public function doctor()
    {
        return response()->json([
            'status' => 'success',
            'data' => Doctor::select('id', 'first_name', 'last_name')->get()->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->first_name . ' ' . $doctor->last_name
                ];
            })
        ]);
    }

    public function departmentWiseDoctor(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'data' => Doctor::where('department_id', $request->department_id)->select('id', 'first_name', 'last_name')->get()->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->first_name . ' ' . $doctor->last_name
                ];
            })
        ]);
    }

    public function slot(Request $request)
    {

        $timeSlot = [];
        $data = Doctor::whereId($request->doctor_id)->select('id')
            ->with('doctorAppointmentSchedules')
            ->first();
        //php date wise day show
        $day = date('l', strtotime($request->date));
        $timeSlot = $data->doctorAppointmentSchedules()->where('day', $day)->get()->map(function ($query) {
            return [
                'start_time' => date("h.i A", strtotime($query->start_time)),
                'end_time' => date("h.i A", strtotime($query->end_time)),
                'id'    => $query->id,
            ];
        });
        return response()->json(['data' => $timeSlot]);
    }

    public function getSerialNumber($request)
    {
        $lastSerialNumber = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->date)
            ->where('doctor_appointment_schedule_id', $request->slot)
            ->max('serial_number');
        return $lastSerialNumber ? $lastSerialNumber + 1 : 1;
    }
}
