<?php

namespace App\Http\Requests\Account\AccountLedger;

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
                    Rule::unique('account_ledgers')
                    ->ignore($this->accountledger->id)
                    ->where(function ($query)  {
                        return $query
                            ->where('name', $this->name)
                            ->where('account_group_id',$this->account_group_id);
                    })
                ],
                'account_group_id' => 'required|exists:account_groups,id',
                'note' => 'nullable|string',
        ];
    }

    public function updateData($account_ledger)
    {
        try {
            DB::beginTransaction();
            $data = $this->validated();
            $data['status'] = $this->status== 'on'? true : false;
            $data['rec_pay'] = $this->rec_pay== 'on'? true : false;
            $account_ledger->update($data);
            if($this->balance){
                $account_ledger->openingBalance()->create([
                    'date' => now(),
                    'debit' => $this->debit == 'on' ?$this->balance: 0,
                    'credit' => $this->credit == 'on' ? $this->balance: 0,
                ]);
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}