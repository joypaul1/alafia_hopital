<?php

namespace App\Http\Requests\QuickPage;

use App\Models\QuickPage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

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
            'name' => 'required|string|unique:quick_pages,name',
            'description' => 'required|string',
            'position' => 'nullable|unique:quick_pages,position',
        ];
    }

    public function storeData($request)
    {
      
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($request->name);
            QuickPage::create($data);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Created Successfully']);
    }
}
