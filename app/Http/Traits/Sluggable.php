<?php
namespace App\Traits;

use App\Models\Item\Item;
use App\Models\Item\Subcategory;
use App\Models\Item\Childcategory;
use Illuminate\Support\Str;

trait Sluggable
{ 
   
    public static function bootSluggable()
    {
        
        static::saving(function ($model)   {
            $separator = '-';
            if (get_class($model) == Subcategory::class) {
                $model->slug = static::slug(
                    self::get_avatar($model->category->name) . $separator . 
                    self::get_avatar($model->name).time()
                );
            } 
            else if (get_class($model) == Childcategory::class) {
                $model->slug = static::slug(
                    self::get_avatar($model->category->name).$separator .
                    self::get_avatar($model->subcategory->name).$separator .
                    self::get_avatar($model->name).time()
                );
            }
            else if (get_class($model) == Item::class) {
               
                $model->slug = static::slug(
                    self::get_avatar($model->name) . $separator.
                    $model->unit_id.$separator. 
                    $model->origin_id.$separator. 
                    $model->brand_id.$separator. 
                    $model->category_id.$separator. 
                    $model->subcategory_id.$separator. 
                    $model->childcategory_id.$separator.time()
                );
                if(!request()->sku){
                    $model->sku = $model->slug;
                }
              
            } else if ($model->name) {
                $model->slug = static::slug(self::get_avatar($model->name).time());
            } else if ($model->title) {
                $model->slug = static::slug(self::get_avatar($model->title).time());
            }
            
           
        });
        // return  $this->generate;
    }

    private static function slug($string, $separator = '-')
    {
        $slug = mb_strtolower(
            preg_replace('/([?]|\p{P}|\s)+/u', $separator, $string)
        );
        return Str::upper(trim($slug, $separator));
    }
    private static function get_avatar($str){
        $acronym =null;
        $word = null;
        $words = preg_split("/(\s|\-|\.)/", $str);
        foreach($words as $w) {
            $acronym .= substr($w,0,1);
        }
        $word = $word . $acronym ;
        return $word;
    }

}