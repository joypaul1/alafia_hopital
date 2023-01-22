<?php

namespace App\Http\Requests\Subcategory;

use App\Helpers\Image;
use App\Models\Item\Subcategory;
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
            'name' => 'required|string|unique:subcategories,name',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function storeData($request)
    {
      
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if($request->image){
                $data['image'] =  (new Image)->dirName('subcategory')->file($request->image)
                ->resizeImage(500, 500)
                ->save();
            }
          
            Subcategory::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
