<?php

namespace App\Http\Requests\Item\Row;

use App\Helpers\Image;
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
                    Rule::unique('rows')
                    ->ignore($this->row->id)
                    ->where(function ($query)  {
                        return $query
                            ->where('name', $this->name)
                            ->where('rack_id',$this->rack_id);
                    })
                ],
            'rack_id' => 'required|exists:racks,id',
            'note' => 'nullable|string',
        ];
    }

    public function updateData($request,$row)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $row->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}