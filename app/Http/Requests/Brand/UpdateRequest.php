<?php

namespace App\Http\Requests\Brand;

use App\Helpers\Image;
use Illuminate\Foundation\Http\FormRequest;
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
           
            // 'name' => ['required', Rule::unique('brands')->ignore($this->brand->id)],
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function updateData($request ,$brand)
    {
        try {
           
            $data = $request->validated();
          
            if($request->image){
                $data['image'] =  (new Image)->dirName('brand')->file($request->image)
                ->resizeImage(500, 500)
                ->deleteIfExists($brand->image)
                ->save();
            }
            $brand->update($data);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
