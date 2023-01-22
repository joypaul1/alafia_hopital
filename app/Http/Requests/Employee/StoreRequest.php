<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

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
}
