<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\Image;
use App\Models\Item\Brand;

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
            'name' => 'required|unique:brands,name',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function storeData($request)
    {
        try {
            $data = $request->validated();
            if($request->image){
                $data['image'] =  (new Image)->dirName('brand')->file($request->image)
                ->resizeImage(500, 500)
                ->save();
            }
            Brand::create($data);
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
