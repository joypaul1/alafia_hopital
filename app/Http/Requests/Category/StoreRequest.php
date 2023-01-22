<?php

namespace App\Http\Requests\Category;

use App\Helpers\Image;
use App\Models\Item\Category;
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
            'name' => 'required|string|unique:categories,name',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function storeData($request)
    {

        try {

            DB::beginTransaction();
            $data = $request->validated();
            if($request->hasfile('image')){
                $image =  (new Image)->dirName('category')->file($request->image)
                ->resizeImage(500, 500)
                ->save();
                $data['image'] = $image;
            }
            $data['status'] = $this->status == 'on'? true:false;
            Category::create($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' =>'Data Created Successfully.']);
    }
}
