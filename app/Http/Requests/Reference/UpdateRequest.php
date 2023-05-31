<?php

namespace App\Http\Requests\Reference;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
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
            'name' => 'required|string',
            'email' => ['nullable', Rule::unique('email')->ignore($this->reference->id)],
            'mobile' => ['nullable', Rule::unique('mobile')->ignore($this->reference->id)],
            'commission' => 'nullable',
        ];
    }

    public function updateData($request ,$reference)
    {
        try {
            $data = $request->validated();
            $data['commission'] = Str::replace(',', '', ($this->commission));
            $reference->update($data);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
