<?php

namespace App\Http\Requests\QuickPage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public $quickage = 'quick-page';

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
            'name' => ['required','unique:quick_pages,name', Rule::unique('quick_pages')->ignore(Route::current()->parameters()['quick_page']['id'])],
            'description' => 'required|string',
            'position' => ['nullable', 'unique:quick_pages,position',Rule::unique('quick_pages')->ignore(Route::current()->parameters()['quick_page']['id'])],
           
        ];
    }

    public function updateData($request ,$slider)
    {
        try {
           
            $data = $request->validated();
            $data['slug'] = Str::slug($request->name);

            $slider->update($data);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
