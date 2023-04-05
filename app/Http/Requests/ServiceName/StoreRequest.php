<?php

namespace App\Http\Requests\ServiceName;

use App\Models\Service\ServiceName;
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
            'name'              => 'required|string|unique:service_names,name',
            'service_type_id'   => 'required|exists:service_types,id',
            'unit_id'           => 'required|exists:units,id',
            'description'       => 'nullable|string',
            'service_price'     => 'required',
        ];
    }

    public function storeData($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['status'] = $this->status == 'on' ? true : false;
            ServiceName::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Created Successfully.']);
    }
}
