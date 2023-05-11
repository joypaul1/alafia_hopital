<?php

namespace App\Http\Requests\RadiologyServiceName;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
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
        // dd(Route::current()->parameters()['radiology_serviceName']);
        return [
            'name'          => ['required', 'string', Rule::unique('radiology_service_names')->ignore(Route::current()->parameters()['radiology_serviceName'])],
            'note'          => 'nullable|string',
            'price'         => 'required',
        ];
    }

    public function updateData($request, $serviceName)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['price'] = str_replace(',', '', $request->price);
            $serviceName->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
