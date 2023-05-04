<?php

namespace App\Http\Requests\Item\Home;

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
        // dd($this->item);
        return [
            'name' => [
                'required', 'string',
                Rule::unique('items')->ignore($this->item->id, 'id')
                // ->where(function ($query)  {
                //     return $query
                //         ->where('name', $this->name)
                //         ->where('brand_id',$this->brand_id)
                //         ->where('unit_id',$this->unit_id)
                //         ->where('origin_id',$this->origin_id)
                //         ->where('category_id',$this->category_id)
                //         ->where('subcategory_id',$this->subcategory_id)
                //         ->where('childcategory_id',$this->childcategory_id);

                // })
            ],
            'sku' => 'nullable|string',
            'product_type' => 'required|string',
            'weight' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'exc_tax' => 'required|string',
            'inc_tax' => 'required|string',
            'tax_rate' => 'required|string',
            'profit_percent' => 'required|string',
            'sell_price' => 'required|string',
            'alert_quantity' => 'nullable|string',
            'unit_id' => 'nullable|string|exists:units,id',
            'brand_id' => 'nullable|string|exists:brands,id',
            'category_id' => 'required|string|exists:categories,id',
            'subcategory_id' => 'required|string|exists:subcategories,id',
            'childcategory_id' => 'nullable|string|exists:childcategories,id',
            'origin_id' => 'nullable|string|exists:countries,id',
            'rack_id' => 'nullable|string|exists:racks,id',
            'row_id' => 'nullable|string|exists:rows,id',
            'tax_id' => 'nullable|string|exists:tax_settings,id',
            'tax_type' => 'required|string',
            'product_specific_delivery_information' => 'nullable|string',
            'attribute_name.*' => 'nullable|string',
            'attribute_value.*' => 'nullable|string',
            // 'galleryImage.*' => 'nullable|image',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'provide_product_specific_delivery_information' => 'nullable|string',

        ];
    }

    public function updateData()
    {
        try {
            DB::beginTransaction();
            $data   = $this->validated();
            $data['description'] = $this->description;
            $data['up_before_tax'] = $this->exc_tax;
            $data['tax_rate'] = $this->tax_rate;
            $data['up_after_tax'] = $this->inc_tax;
            $data['profit_percent'] = $this->profit_percent;
            $data['tax_type'] = $this->tax_type;
            $data['up_before_tax'] = $this->exc_tax;
            if ($this->image) {
                $data['image']      = (new Image)->dirName('item/image')->file($this->image)->resizeImage(235, 235)->deleteIfExists($this->item->image)->save();
                $data['b_image']    = (new Image)->dirName('item/b_image')->file($this->image)->resizeImage(550, 500)->deleteIfExists($this->item->b_image)->save();
            }
            $this->item->update($data);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
            return response()->json(['status' => false, 'msg' => $ex->getLine(), $ex->getMessage()]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Updated Successfully']);
    }
}
