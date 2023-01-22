<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Image;
use App\Models\Slider;

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
            'text' => 'nullable|string',
            'position' => 'nullable|unique:sliders,position',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function storeData($request)
    {
      
        try {
            $data = $request->validated();
            if($request->image){
                 $data['image'] =  (new Image)->dirName('slider')->file($request->image)
                ->resizeImage(845, 500)
                ->save();
            }
            Slider::create($data);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
