<?php

namespace App\Http\Requests\ServiceName;

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
            'name'          => ['required', 'string', Rule::unique('service_names')->ignore($this->serviceName->id)],
            'service_type_id'   => 'required|exists:service_types,id',
            'description'   => 'nullable|string',
            'service_price'       => 'required',

        ];
    }

    public function updateData($request, $serviceName)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            // dd($data);
            $data['service_price'] = str_replace(',','',$request->service_price);
            $serviceName->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
