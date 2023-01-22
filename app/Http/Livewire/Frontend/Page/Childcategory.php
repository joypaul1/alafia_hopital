<?php

namespace App\Http\Livewire\Frontend\Page;

use App\Models\Item\Brand;
// use App\Models\Item\Category as ModelCategory;
use App\Models\Item\Childcategory as ModelChildcategory;
use App\Models\Item\Item;
use Livewire\Component;

class Childcategory extends Component
{
    public $slug, $brandId, $priceSort;
    protected $queryString = ['slug'];
    public $brands ;


    public function mount( )
    {
        $this->brands = Brand::active()->get(['id', 'name']);
    }
    public function render()
    {

        $childcategory = ModelChildcategory::whereSlug($this->slug)->select('id', 'name', 'slug')->first();

        $items  = Item::whereChildcategoryId($childcategory->id)
        ->when($this->brandId, function($sub){
            $sub->whereBrandId($this->brandId);
        })
        ->when($this->priceSort, function($sub){
            $sub->orderBy('sell_price',$this->priceSort);
        })
         ->get();
        // return view('livewire.frontend.template_2.page.childcategory',
        // compact('items', 'childcategory'))
        // ->extends('frontend.template_2.layouts.app')->section('content');
        return view('livewire.frontend.template_1.page.childcategory',
        compact('items', 'childcategory'))
        ->extends('frontend.template_1.layouts.app')->section('content');

    }

    // public function selectSubCat($id)
    // {
    //     $this->subCatId = $id;
    // }
    public function selectBrandId($id)
    {
        $this->brandId = $id;
    }
    public function priceRange($sort)
    {
        $this->priceSort = $sort;
    }
}
