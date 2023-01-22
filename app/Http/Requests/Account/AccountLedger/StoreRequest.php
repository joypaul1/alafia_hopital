<?php

namespace App\Http\Requests\Account\AccountLedger;


use App\Models\Account\AccountLedger;
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
            'name' => 'required|string|unique:account_groups,name',
            'account_group_id' => 'required|exists:account_groups,id',
            'note' => 'nullable|string',
        ];
    }

    public function storeData()
    {
      
        try {
            DB::beginTransaction();
            $data = $this->validated();
            $data['status'] = $this->status== 'on'? true : false;
            $data['rec_pay'] = $this->rec_pay== 'on'? true : false;
            $ledger = AccountLedger::create($data);
            if($this->balance){
                $ledger->openingBalance()->create([
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
