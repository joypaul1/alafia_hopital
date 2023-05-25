<?php

namespace App\Http\Requests\Employee;
use App\Helpers\Image;
use App\Models\Admin;
use App\Models\Employee\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'              => 'required|string',
            'email'             => 'required|email:rfc,dns|unique:employees,email',
            'mobile'            => 'required|string|unique:employees,mobile',
            'emp_id'            => 'nullable|string|unique:employees,emp_id',
            'reference_id'      => 'nullable|integer|exists:employees,id',
            'nid'               => 'nullable|string',
            'dob'               => 'nullable|date',
            'note'              => 'nullable|string',
            'present_address'   => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'joining_date'      => 'nullable|date',
            'password'          => 'required|string',
            'department_id'     => 'required|integer|exists:departments,id',
            'designation_id'    => 'nullable|integer|exists:designations,id',
            'shift_id'          => 'nullable|integer|exists:shifts,id',
            'image'             => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    } 

    public function storeData()
    {
        // $data = $this->validated();
        $docData['name'] = $this->name;
        $docData['email'] = $this->email;
        $docData['mobile'] = $this->mobile;
        $docData['salary'] = $this->salary;
        $docData['department_id'] = $this->department_id;
        $docData['designation_id'] = $this->designation_id;
        $docData['nid_number'] = $this->nid_number;
        $docData['marital_status'] = $this->marital_status;
        $docData['joining_date'] = $this->joining_date;
        $docData['present_address'] = $this->present_address_1;
        
        $docData['permanent_address'] = $this->permanent_address_1;
        


        try {
            DB::beginTransaction();
            if($this->hasFile('userProfileImage')){
                $image =  (new Image)->dirName('doctor')->file($this->userProfileImage)
                ->resizeImage(250, 250)
                ->save();
                $docData['image'] = $image;
            }
            $doctor = Employee::create($docData);


            //consultation_name and consultation_fee added query
            foreach ($this->consultation_name as $key => $value) {
                $consultations=$doctor->consultations()->create([
                    'consultation_day' => $this->consultation_name[$key],
                    'consultation_fee' => $this->consultation_fee[$key],
                ]);
            }

            // doctor appointment schedule with start time and end time query
            foreach ($this->appointment_days as $index => $value) {
                $schedules=$doctor->doctorAppointmentSchedules()->create([
                    'day'           => $this->appointment_days[$index]??null,
                    'start_time'    => $this->appointment_day_start_time[$index]??null,
                    'end_time'      => $this->appointment_day_end_time[$index]??null,
                ]);

            }

            // doctor visiting schedule with start time and end time query
          /*  foreach ($this->visit_schedule_days as $index => $value) {
                $visitingSchedules=$doctor->doctorVisitingSchedules()->create([
                    'day'           => $this->visit_schedule_days[$index]??null,
                    'start_time'    => $this->visit_schedule_day_start_time[$index]??null,
                    'end_time'      => $this->visit_schedule_day_end_time[$index]??null,
                ]);

            }*/
           // doctor auth login query
            $admin  =Admin::updateOrCreate([
                'email'     =>  $this->login_email,
                'mobile'    => $this->mobile,
            ],[
                'name'      => $this->first_name,
                'password'  => Hash::make($this->password),
                'role_id'   => $this->role_id,
            ]);
            // dd($admin);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Created Successfully']);

    }
}
