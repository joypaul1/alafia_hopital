<?php

namespace App\Http\Requests\Account\AccountGroup;

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
                    Rule::unique('account_groups')
                    ->ignore($this->accountgroup->id)
                    ->where(function ($query)  {
                        return $query
                            ->where('name', $this->name)
                            ->where('account_head_id',$this->account_head_id);
                    })
                ],
                'account_head_id' => 'required|exists:account_heads,id',
                'note' => 'nullable|string',
        ];
    }

    public function updateData($account_groups)
    {
        try {
            DB::beginTransaction();
            $data = $this->validated();
            $account_groups->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}