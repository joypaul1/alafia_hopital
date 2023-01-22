<?php

namespace App\Http\Requests\Category;

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
            'name' => ['required','string', Rule::unique('categories')->ignore($this->category->id)],
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function updateData($request ,$category)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if($request->image){
                $data['image'] =  (new Image)->dirName('category')->file($request->image)
                ->resizeImage(500, 500)
                ->deleteIfExists($category->image)
                ->save();
            }
            $category->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
