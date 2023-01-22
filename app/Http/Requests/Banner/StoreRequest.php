<?php

namespace App\Http\Requests\Banner;

use App\Helpers\Image;
use App\Models\Banner;
use Illuminate\Foundation\Http\FormRequest;

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
            'position' => 'nullable|unique:banners,position',
            'image' => 'required|image|mimes:jpg,png,jpeg',
        ];
    }

    public function storeData($request)
    {
      
        try {
            $data = $request->validated();
            if($request->image){
                $data['image'] =  (new Image)->dirName('banner')->file($request->image)
                ->resizeImage(360, 155)
                ->save();
            }          
            Banner::create($data);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
