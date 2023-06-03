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
            'data' => Doctor::where('department_id', $request->department_id)->where('first_name', 'LIKE', "%{$request->name}%")->orWhere('last_name', 'LIKE', "%{$request->name}%")->select('id', 'first_name', 'last_name')->get()->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'name' => $doctor->first_name . ' ' . $doctor->last_name
                ];
            })
        ]);
    }

    public function slot(Request $request)
    {
        $request->validate([
            'date'         => 'required|date',
            'doctor_id'   => 'required',

        ]);

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
        $lastSerialNumber = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->date)
            ->where('doctor_appointment_schedule_id', $timeSlot)
            ->max('serial_number');
        $lastSerialNumber ? $lastSerialNumber + 1 : 1;

        return response()->json(['data' => $timeSlot ,'last_serial' => $lastSerialNumber]);
    }

    public function getSerialNumber($request)
    {
        $request->validate([
            'date'         => 'required|date',
            'doctor_id'   => 'required',
            'slot'         => 'required',


        ]);
        $lastSerialNumber = Appointment::where('doctor_id', $request->doctor_id)
            ->where('appointment_date', $request->date)
            ->where('doctor_appointment_schedule_id', $request->slot)
            ->max('serial_number');
        return $lastSerialNumber ? $lastSerialNumber + 1 : 1;
    }
}
