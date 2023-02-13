<?php

namespace App\Http\Requests\Symptom;

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
            'name'          => ['required','string', Rule::unique('symptoms')->ignore($this->symptom->id)],
            'symptom_type_id'   =>'required|exists:symptom_types,id',
            'description'   => 'nullable|string',

        ];
    }

    public function updateData($request,$symptom)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $symptom->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
