<?php

namespace App\Http\Requests\Doctor;

use App\Models\Doctor\Doctor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreRequest extends FormRequest
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
            'first_name' => 'required|string' ,
            'last_name' => 'nullable|string' ,
            'email' => 'nullable| ' ,
            'mobile' => 'required|string' ,
            'emergency_mobile' => 'nullable|numeric' ,
            'department_id' => 'required|exists:departments,id' ,
            'designation_id' => 'required|exists:designations,id' ,
            'license_number' => 'nullable|string' ,
            'nid_number' => 'nullable|string' ,
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
            'login_email' => 'required|string' ,
            'password' => 'required|string|min:6' ,
            'confirm_password' => 'required_with:password|same:password|min:6' ,
            'role_id' => 'required|exists:roles,id',
            // array validation for multiple consultation_name and consultation_fee
            'consultation_name' => 'required|array',
            'consultation_fee' => 'required|array',
            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'consultation_name.*' => 'string',
            'consultation_fee.*' => 'numeric',
            'consultation_duration' => 'nullable|string',
            'commission_type' => 'nullable|string',
            'commission_amount' => 'nullable|numeric',

        ];
    }


    public function storeRequest()
    {
        // $data = $this->validated();
        $docData['first_name'] = $this->first_name;
        $docData['last_name'] = $this->last_name;
        $docData['email'] = $this->email;
        $docData['mobile'] = $this->mobile;
        $docData['emergency_mobile'] = $this->emergency_mobile;
        $docData['department_id'] = $this->department_id;
        $docData['designation_id'] = $this->designation_id;
        $docData['license_number'] = $this->license_number;
        $docData['nid_number'] = $this->nid_number;
        $docData['marital_status'] = $this->marital_status;
        $docData['joining_date'] = $this->joining_date;
        $docData['present_address_1'] = $this->present_address_1;
        $docData['present_address_2'] = $this->present_address_2;
        $docData['present_address_city'] = $this->present_address_city;
        $docData['present_address_state'] = $this->present_address_state;
        $docData['permanent_address_1'] = $this->permanent_address_1;
        $docData['permanent_address_2'] = $this->permanent_address_2;
        $docData['permanent_address_city'] = $this->permanent_address_city;
        $docData['permanent_address_state'] = $this->permanent_address_state;
        // $data['login_email'] = $this->login_email;

        try {
            DB::beginTransaction();
            $doc = Doctor::create($docData);
            dd($doc);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }



        // $data['password'] = bcrypt($data['password']);
        // $data['status'] = 1;

        // $data['consultation_duration'] = $data['consultation_duration'] ?? 0;
        // $data['commission_type'] = $data['commission_type'] ?? 0;
        // $data['commission_amount'] = $data['commission_amount'] ?? 0;
        // $data['consultation_name'] = json_encode($data['consultation_name']);
        // $data['consultation_fee'] = json_encode($data['consultation_fee']);
        // dd($data);
        // return $data;

    }
}
