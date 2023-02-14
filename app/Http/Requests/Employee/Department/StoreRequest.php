<?php

namespace App\Http\Requests\Employee\Department;

use App\Models\Employee\Department;
use App\Models\Employee\DepartmentDesignation;
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
            'name'              => 'required|string|unique:departments,name',
            'designation_id'    => 'nullable|array|exists:designations,id',
        ];
    }

    public function storeData($request)
    {

        try {
            DB::beginTransaction();
            $data = $request->validated();
            unset($data['designation_id']);
            $department= Department::create($data);
            if(!empty($this->designation_id)){
                $department->designations()->attach($this->designation_id);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}

