<?php

namespace App\Http\Requests\LabTest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'name'              => ['required', 'string', Rule::unique('lab_tests')->ignore($this->labTest->id)],
            'lab_test_tube_id'  => 'nullable|exists:lab_test_tubes,id',
            'price'             => 'required',
            'time'              => 'nullable',
            'time_type'         => 'nullable',
            'department'        => 'required',
            'reference'         => 'nullable',
            'specimen'          => 'required',
            'unit'              => 'nullable',
            'type'              => 'required',


        ];
    }

    public function updateData($request, $labTest)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['price'] = str_replace(',', '', $request->price);
            $data['status'] = $this->status == 'on' ? true : false;
            $data['reference_value'] = $this->reference;
            $data['category'] = $this->department;
            $labTest->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
