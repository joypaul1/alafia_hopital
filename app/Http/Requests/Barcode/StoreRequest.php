<?php

namespace App\Http\Requests\Barcode;

use App\Models\SiteInfo;
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
            'type' => 'required|string',
        ];
    }
    public function storeData($request)
    {
      
        try {
            DB::beginTransaction();
            $siteInfo = SiteInfo::updateOrCreate(['id'=> 1], ['barcode_type' =>$request->type]);
            session(['site_info' => $siteInfo]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
