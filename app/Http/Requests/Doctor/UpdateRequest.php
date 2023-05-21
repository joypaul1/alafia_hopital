<?php

namespace App\Http\Requests\Doctor;
use App\Helpers\Image;
use App\Models\Admin;
use App\Models\Doctor\Doctor;
use App\Models\Doctor\DoctorConsultation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'nullable|string' ,
            'last_name' => 'nullable|string' ,
            'email' => 'nullable| ' ,
             'gender' => 'nullable| ' ,
            'mobile' => 'nullable|string' ,
            'emergency_number' => 'nullable|numeric' ,
            'department_id' => 'nullable|exists:departments,id' ,
            'designation_id' => 'nullable|exists:designations,id' ,
            'license_number' => 'nullable|string' ,
            'nid_number' => 'nullable' ,
            'marital_status' => 'nullable|string' ,
            'joining_date' => 'nullable|string' ,
            'present_address_1' => 'nullable|string' ,
            'present_address_2' => 'nullable|string' ,
            'present_address_city' => 'nullable|string' ,
            'present_address_state' => 'nullable|string' ,
            'permanent_address_1' => 'nullable|string' ,
            'permanent_address_2' => 'nullable|string' ,
            'permanent_address_city' => 'nullable|string' ,
            'permanent_address_state' => 'nullable|string' ,
            'login_email' => 'nullable|string' ,
            'password' => 'nullable|string|min:6' ,
            'role_id' => 'nullable|exists:roles,id',
            // array validation for multiple consultation_name and consultation_fee
            'consultation_name' => 'nullable|array',
            'consultation_fee' => 'nullable|array',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'consultation_name.*' => 'nullable|string',
            'consultation_fee.*' => 'nullable|numeric',
            'consultation_duration' => 'nullable|string',
            'commission_type' => 'nullable|string',
            'commission_amount' => 'nullable|numeric',

        ];
    }


    public function updateData($request,$id)
    {
        $doc= Doctor::where('id',$id)->first();
         //$data = $request->validated();
         try {
           // DB::beginTransaction();
            $data = $request->validated();
         
            if($request->hasFile('userProfileImage')){
                $image =  (new Image)->dirName('doctor')->file($request->userProfileImage)
                ->resizeImage(250, 250)
                ->save();
                $data['image'] = $image;
            }
            $doc->update($data);

         
            //consultation_name and consultation_fee added query
            if($request->consultation_name[1] || $request->consultation_fee[1])
            {
                $consultation= DoctorConsultation::where('doctor_id',$doc->id)->latest('id')->first();

                $consultation->consultation_fee = $request->consultation_fee[1]; 

                $consultation->consultation_day = $request->consultation_name[1];
                $consultation->save();
            }
            elseif($request->consultation_fee[0])
            {
                $consultation= DoctorConsultation::where('doctor_id',$doc->id)->where('consultation_day','1st')->first();

                    $consultation->consultation_fee = $request->consultation_fee[0]; 
                    $consultation->save();                  

            }
            elseif($request->consultation_fee[1])
            {
                $consultation= DoctorConsultation::where('doctor_id',$doc->id)->where('consultation_day',$request->consultation_name[1])->first();

                    $consultation->consultation_fee = $request->consultation_fee[1]; 
                    $consultation->save();


            }
            elseif($request->consultation_name[1])
            {
                $consultation= DoctorConsultation::where('doctor_id',$doc->id)->where('consultation_fee',$request->consultation_fee[1])->first();

                    $consultation->consultation_day = $request->consultation_name[1];
                    $consultation->save();


            }
            else{
                
            }
            if($request->consultation_fee[0])
            {
                $consultation= DoctorConsultation::where('doctor_id',$doc->id)->where('consultation_day','1st')->first();

                    $consultation->consultation_fee = $request->consultation_fee[0]; 
                    $consultation->save();                  

            }
           
            // doctor appointment schedule with start time and end time query
            if($request->appointment_days){
                $doc->doctorAppointmentSchedules()->delete();
            foreach ($request->appointment_days as $index => $value) {
                $schedules=$doc->doctorAppointmentSchedules()->create([
                    'day'           => $request->appointment_days[$index]??null,
                    'start_time'    => $request->appointment_day_start_time[$index]??null,
                    'end_time'      => $request->appointment_day_end_time[$index]??null,
                ]);

            }
        }

            // doctor visiting schedule with start time and end time query
         /*   foreach ($request->visit_schedule_days as $index => $value) {
                $visitingSchedules=$doc->doctorVisitingSchedules()->update([
                    'day'           => $request->visit_schedule_days[$index]??null,
                    'start_time'    => $request->visit_schedule_day_start_time[$index]??null,
                    'end_time'      => $request->visit_schedule_day_end_time[$index]??null,
                ]);

            }*/
           // doctor auth login query
           $admin= Admin::where('mobile',$doc->mobile)->first();
            $admin->email     =  $request->login_email;                
            $admin->password  = Hash::make($request->password);
            $admin->role_id   = $request->role_id;
            $admin->save();
            // dd($admin);

            DB::commit(); 
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);


    }
}
