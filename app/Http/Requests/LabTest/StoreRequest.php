<?php

namespace App\Http\Requests\LabTest;

use App\Models\lab\LabTest;
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
            'name'              => 'required|string|unique:lab_tests,name',
            'lab_test_tube_id'  => 'required|exists:lab_test_tubes,id',
            'price'             => 'required',
            'time'              => 'nullable',
            'time_type'         => 'nullable',
            'department'        => 'required',
            'reference'         => 'nullable',
            'unit'              => 'nullable',
        ];
    }

    public function storeData($request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['status'] = $this->status == 'on' ? true : false;
            $data['reference_value'] = $this->reference;
            $data['category'] = $this->department;
            LabTest::create($data);

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Created Successfully.']);
    }
}
