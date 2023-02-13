<?php

namespace App\Http\Requests\BloodBank;

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
            'name'          => ['required','string', Rule::unique('blood_banks')->ignore($this->bloodBank->id)],
            'type_id'       => 'required|exists:blood_bank_types,id',
            'description'   => 'nullable|string',

        ];
    }

    public function updateData($request,$bloodBank)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $bloodBank->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
