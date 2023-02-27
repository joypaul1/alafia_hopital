<?php

namespace App\Http\Requests\ServiceType;

use App\Models\Service\ServiceType;
use App\Models\Symptom\SymptomType;
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
            'name' => 'required|string|unique:service_types,name',
        ];
    }

    public function storeData($request)
    {

        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['status'] = $this->status == 'on' ? true : false;
            ServiceType::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' => $ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Created Successfully.']);
    }
}
