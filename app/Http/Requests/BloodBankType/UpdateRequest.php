<?php

namespace App\Http\Requests\BloodBankType;

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
            // 'name' => ['required','string', Rule::unique('blood_bank_types')->ignore($this->symptomType->id)],
        ];
    }

    public function updateData($request,$bloodBankType)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['status'] = $this->status == 'on'? true:false;
            $bloodBankType->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
