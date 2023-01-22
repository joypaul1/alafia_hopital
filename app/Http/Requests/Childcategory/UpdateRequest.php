<?php

namespace App\Http\Requests\Childcategory;

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
           
            'name' => ['required','string',
                Rule::unique('childcategories')
                ->ignore($this->childcategory->id)
                ->where(function ($query)  {
                    return $query
                        ->where('name', $this->name)
                        ->where('category_id',$this->category_id)
                        ->where('subcategory_id',$this->subcategory_id);
                })
            ],

            'category_id' => 'required',
            'subcategory_id' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
        ];
    }

    public function updateData($request, $childcategory)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if($request->image){
                $data['image'] =  (new Image)->dirName('childcategory')->file($request->image)
                ->resizeImage(500, 500)
                ->deleteIfExists($childcategory->image)
                ->save();
            }
            $childcategory->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => false, 'msg' =>$ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}