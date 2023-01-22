<?php

namespace App\Http\Requests\Pos;

use App\Helpers\Image;
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
                ->where('mobile', $this->mobile)
                ->orwhere('email', $this->email);
            })],
            'company_name'      => 'nullable|string',
            'mobile'            => 'required|string',
            'email'             => 'nullable|email:rfc,dns',
            'country'           => 'nullable|exists:countries,id',
            'province'          => 'nullable|string',
            'city'              => 'nullable|string',
            'postal_code'       => 'nullable|string',
            'address_line_1'    => 'nullable|string',
            'address_line_2'    => 'nullable|string',
        ];
    }

    public function storeData()
    {
      dd($this->all());
        try {
            DB::beginTransaction();
            $data = $this->validated();
            $supplier= Register::create($data);
            // if(($this->document)){
            //     for ($i=0; $i < count($this->document); $i++) { 
            //         $document =  (new Image)->dirName('supplier_document')->file($request->document[$i])->resizeImage(200,200)->save();
            //         $supplier->documents()->create(['url' => $document]);
            //     }
            // }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Created Successfully']);
    }
}
