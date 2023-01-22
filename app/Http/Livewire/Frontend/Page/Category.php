<?php

namespace App\Http\Livewire\Frontend\Page;

use App\Models\Item\Brand;
use App\Models\Item\Category as ModelCategory;
use App\Models\Item\Item;
use Livewire\Component;

class Category extends Component
{
    public $slug, $subCatId, $brandId, $priceSort;
    protected $queryString = ['slug'];
    public $brands ;


    public function mount( )
    {
        $this->brands = Brand::active()->get(['id', 'name']);
    }
    public function render()
    {
        $category    = ModelCategory::whereSlug($this->slug)
        ->select('id', 'name', 'slug')
        ->with(['subcategories'=> function($query){
            $query->select('id', 'name', 'slug', 'category_id');
        }])->first();
        $items  = Item::whereCategoryId($category->id)
        ->when($this->subCatId, function($sub){
            $sub->whereSubcategoryId($this->subCatId);
        })
        ->when($this->brandId, function($sub){
            $sub->whereBrandId($this->brandId);
        })
        ->when($this->priceSort, function($sub){
            $sub->orderBy('sell_price',$this->priceSort);
        })
        ->get();
        return view('livewire.frontend.template_2.page.category',
        compact('items', 'category'))
        ->extends('frontend.template_2.layouts.app')->section('content');
        return view('livewire.frontend.template_1.page.category',
        compact('items', 'category'))
        ->extends('frontend.template_1.layouts.app');

    }

    public function selectSubCat($id)
    {
        $this->subCatId = $id;
    }
    public function selectBrandId($id)
    {
        $this->brandId = $id;
    }
    public function priceRange($sort)
    {
        $this->priceSort = $sort;
    }
}
