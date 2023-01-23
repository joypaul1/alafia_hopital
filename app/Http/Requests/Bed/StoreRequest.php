<?php

namespace App\Http\Requests\Bed;

use App\Models\Bed\Bed;
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
            'name' => 'required|string|unique:beds,name',
            'description' => 'nullable|string|',
            'price' => 'required|numeric',
            'bed_group_id' => 'nullable|exists:bed_groups,id',
            'bed_type_id' => 'nullable|exists:bed_types,id',
            'bed_cabin_id' => 'nullable|exists:bed_cabins,id',
            'bed_floor_id' => 'nullable|exists:bed_floors,id',
            'bed_ward_id' => 'nullable|exists:bed_wards,id',

        ];
    }

    public function storeData($request)
    {

        try {
            DB::beginTransaction();
            $data = $request->validated();
            $data['status'] = $this->status == 'on'? true:false;
            Bed::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' =>'Data Created Successfully.']);
    }
}

