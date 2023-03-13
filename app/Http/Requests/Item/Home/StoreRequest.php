<?php

namespace App\Http\Requests\Item\Home;

use App\Helpers\Image;
use App\Models\Item\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
            'name' => ['required','string',
                Rule::unique('items')
                ->where(function ($query)  {
                    return $query
                        ->where('name', $this->name)
                        ->where('brand_id',$this->brand_id)
                        ->where('unit_id',$this->unit_id)
                        ->where('origin_id',$this->origin_id)
                        ->where('category_id',$this->category_id)
                        ->where('subcategory_id',$this->subcategory_id)
                        ->where('manufacture_id',$this->manufacture_id);

                })
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
    // "names"    => "required|array|min:3",
    // "names.*"  => "required|string|distinct|min:3",

    public function storeData()
    {

        try {
            DB::beginTransaction();
            $data = $this->validated();

            if ($this->image) {
                $data['image']      = (new Image)->dirName('item/image')->file($this->image)->resizeImage(235, 235)->save();
                $data['b_image']    = (new Image)->dirName('item/b_image')->file($this->image)->resizeImage(550, 500)->save();
            }

            $data['description'] = $this->description;
            $data['up_before_tax'] = $this->exc_tax;
            $data['tax_rate'] = $this->tax_rate;
            $data['up_after_tax'] = $this->inc_tax;
            $data['profit_percent'] = $this->profit_percent;
            $data['tax_type'] = $this->tax_type;
            $item = Item::create($data);

            if ($this->provide_product_specific_delivery_information) {
                $item->deliveryInfo()->create(['description' => $this->provide_product_specific_delivery_information]);
            }
            // dd($this->is_thumbnail);
            if ($this->galleryName[0]) {
                for ($i = 0; $i < count($this->galleryName); $i++) {
                    $galleries = $item->galleries()->create([
                        'name'          => $this->galleryName[$i],
                        'is_thumbnail' =>  $this->is_thumbnail[$i]?$this->is_thumbnail[$i] == 'on'?? true : false,
                    ]);
                    if (!empty($this->galleryImage[$i])) {
                        for ($j = 0; $j < count($this->galleryImage[$i]); $j++) {
                            $galleries->images()->create([
                                'small' => (new Image)->dirName('item/galleries/small')->file($this->galleryImage[$i][$j])->resizeImage(150, 150)->save(),
                                // 'medium' => (new Image)->dirName('item/galleries/medium')->file($this->galleryImage[$i][$j])->resizeImage(250, 250)->save(),
                                'large' => (new Image)->dirName('item/galleries/large')->file($this->galleryImage[$i][$j])->resizeImage(550, 500)->save(),
                            ]);
                        }
                    }
                }
            }
            // dd($this->attribute_status);
            // dd($this->attribute_name[0], count($this->attribute_name));
            if ($this->attribute_name[0]) {
                for ($attr = 0; $attr < count($this->attribute_name); $attr++) {
                    $item->attributeInfos()->create([
                        'name' => $this->attribute_name[$attr],
                        'value' => $this->attribute_value[$attr],
                        // 'serial_number' =>$this->attribute_serial_number[$attr]??$this->attribute_serial_number[$attr],
                        // 'status' => $this->attribute_status[$attr]? $this->attribute_status[$attr] == 'on'?? true : false,
                    ]);
                }
            }
            if ($this->meta_title) {
                $item->metaTag()->create([
                    'meta_title' => $this->meta_title,
                    'meta_keywords' => $this->meta_keywords,
                    'meta_description' => $this->meta_description,
                ]);
            }


            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex->getMessage());
            return response()->json(['status' => false, 'msg' => $ex->getLine(),$ex->getMessage() ]);
        }
        return response()->json(['status' => true, 'msg' => 'Data Stored Successfully']);
    }
}
