<?php

namespace App\Providers;

use App\Models\InvoicePrefix;
use App\Models\Item\Category;
use App\Models\QuickPage;
use App\Models\SiteInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SessionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if(!session('site_info')){
                $siteInfo = SiteInfo::first()->toArray();
                session(['site_info' => $siteInfo]);
            }
        });

        View::composer('backend/*', function ($view) {
            if(!session('invoice_prefix')){
                $prefixArray= InvoicePrefix::select('name','value')->get()->toArray();
                $arrayTemp = array();
                foreach ($prefixArray as $key => $val) {
                    $arrayTemp[$val['name']] = $val['value'];
                }
                session(['invoice_prefix' => $arrayTemp]);
            }
        });
        // View::composer('frontend/*', function ($view) {
        //     if(!session('categories')){
        //         $categories= Category::active()->with(['subcategories' => function($sub){
        //             $sub->active()->select('id','name', 'slug', 'status','category_id')
        //             ->with(['childcategories' => function($child){
        //                 $child->active()->select('id', 'name', 'slug', 'status','subcategory_id', 'category_id');
        //             }]);
        //         }])->select('id', 'name', 'slug', 'status')->get();
        //         session(['categories' => $categories]);
        //     }
        //     if(!session('quick_page')){
        //         $quick_page =QuickPage::select('id', 'name', 'slug', 'position')->orderBy('position')->get();
        //         session(['quick_page' => $quick_page]);
        //     }
        // });
    }
}
