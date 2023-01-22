<?php

namespace App\Http\Livewire\Frontend\Page;

use App\Models\Item\Brand;

use App\Models\Item\Item;
use App\Models\Item\Subcategory as ModelSubcategory;
use Livewire\Component;

class Subcategory extends Component
{
    public $slug, $childCatId, $brandId, $priceSort;
    protected $queryString = ['slug'];
    public $brands ;


    public function mount( )
    {
        $this->brands = Brand::active()->get(['id', 'name']);
    }
    public function render()
    {
        $subcategory    = ModelSubcategory::whereSlug($this->slug)
        ->select('id', 'name', 'slug')
        ->with(['childcategories'=> function($query){
            $query->select('id', 'name', 'slug', 'subcategory_id');
        }])->first();
        $items  = Item::whereSubcategoryId($subcategory->id)
        ->when($this->childCatId, function($sub){
            $sub->whereSubcategoryId($this->childCatId);
        })
        ->when($this->brandId, function($sub){
            $sub->whereBrandId($this->brandId);
        })
        ->when($this->priceSort, function($sub){
            $sub->orderBy('sell_price',$this->priceSort);
        })
        ->get();

        // return view('livewire.frontend.template_2.page.subcategory',
        // compact('items', 'subcategory'))
        // ->extends('frontend.template_2.layouts.app')->section('content');
        return view('livewire.frontend.template_1.page.subcategory',
        compact('items', 'subcategory'))
        ->extends('frontend.template_1.layouts.app')->section('content');

    }

    public function selectChildCat($id)
    {
        $this->childCatId = $id;
    }
    public function selectBrandId($id)
    {
        $this->brandId = $id;
    }
    public function priceRange($sort)
    {
        $this->priceSort = $sort;
    }

    public function resetData()
    {
        $this->slug = $this->childCatId =$this->brandId =$this->priceSort = null;
    }
}
