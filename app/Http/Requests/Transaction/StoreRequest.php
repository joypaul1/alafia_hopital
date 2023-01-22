<?php

namespace App\Http\Requests\Transaction;

use App\Models\Account\AccountLedger;
use App\Models\FinancialYearHistory;
use App\Models\LedgerTransition;
use App\Models\Transaction\Transaction;
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
            //
        ];
    }


    public function storeData()
    {
        try {
            // dd($this->all());
            DB::beginTransaction();
            $data = $this->except('_method', '_token', 'ledger', 'amount', 'ledger_id', 'ledger_type');
            $data['amount'] = $this->debit_total;
            $data['date'] = date('Y-m-d', strtotime($this->date));


            $transaction = Transaction::create($data);
            foreach ($this->amount as $i => $value) {
                $transaction->histories()->create([
                    'ledger_id' => $this->ledger_id[$i],
                    'ledger_type' => $this->ledger_type[$i],
                    'amount' => $this->amount[$i],
                ]);
            }

            // start dailyTransition
            $dailyTransition = $transaction->dailyTransactions()->create([
                'url'               => "Backend\TransactionController@show,['id' =>".$transaction->id."]",
                'description'       => $this->description,
                'transaction_type'  => 'transaction',
                'date'              => $data['date'] ,
                'reference_no'      => $transaction->invoice_number,
            ]);
            foreach ($this->ledger_type as $key => $ledger_type) {
                $dailyTransition->transactionHistories()->create([
                    'entry_name' => AccountLedger::find($this->ledger_id[$key])->name,
                    $ledger_type=> $this->amount[$key],
                ]);

                //ledger transition
                LedgerTransition::updateOrCreate([
                    'ledger_id'=> $this->ledger_id[$key],
                    'date'     => FinancialYearHistory::latest()->first()->start_date
                ],[
                    $this->ledger_type[$key] => DB::raw($this->ledger_type[$key].' +'.$this->amount[$key])
                ]);

            }

            // end dailyTransition



            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Store Successfully']);

    }
}
