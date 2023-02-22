<?php

namespace App\Http\Requests\Employee\Department;

use App\Models\Employee\DepartmentDesignation;
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
            'name' => ['required','string',
                    Rule::unique('departments')
                    ->ignore($this->department->id)
                    ->where(function ($query)  {
                        return $query
                            ->where('name', $this->name)
                            ->where('designation_id', $this->designation_id);
                    })
                ],
            // 'designation_id' => 'nullable|array|exists:designations,id',
        ];
    }

    public function updateData($request,$department)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            unset($data['designation_id']);
            // if(!empty($this->designation_id)){
            //     $department->designations()->sync($this->designation_id);
            // }
            $department->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
