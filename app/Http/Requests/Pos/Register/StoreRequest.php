<?php

namespace App\Http\Requests\Pos\Register;

use App\Models\Pos\Register;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'name' => ['required', Rule::unique('registers')
                ->where(function($query){
                return $query
                ->where('name', $this->name)
                ->orwhere('outlet_id', $this->outlet_id);
            })],
            'outlet_id'        => 'required|exists:outlets,id',
            // 'status'        => 'nullable',
            
        ];
    }

    public function storeData()
    {
     
        try {
            DB::beginTransaction();
            $data = $this->validated();
            $data['status'] = $this->status? 1:0;
            Register::create($data);
           
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Added Successfully']);
    }
}
