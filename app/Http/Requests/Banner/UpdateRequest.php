<?php

namespace App\Http\Requests\Banner;

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
            'position' => ['nullable', Rule::unique('banners')->ignore($this->banner->id)],
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
        ];
    }

    public function updateData($request ,$banner)
    {
        try {
           
            $data = $request->validated();
          
            if($request->image){
                $data['image'] =  (new Image)->dirName('banner')->file($request->image)
                ->resizeImage(360, 155)
                ->deleteIfExists($banner->image)
                ->save();
            }
            $banner->update($data);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
