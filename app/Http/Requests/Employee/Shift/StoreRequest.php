<?php

namespace App\Http\Requests\Employee\Shift;

use App\Models\Employee\Designation;
use App\Models\Employee\Shift;
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
            'name'          => 'required|string|unique:designations,name',
            'start_time'    => 'nullable|string',
            'end_time'      => 'nullable|string',
        ];
    }

    public function storeData($request)
    {
      
        try {
            DB::beginTransaction();
            $data = $request->validated();
            Shift::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
