<?php

namespace App\Providers;

use App\Models\SiteInfo;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class ApplicationServiceProvider extends ServiceProvider
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
        Schema::defaultStringLength(191);
        // config(['database.connections.mysql.driver' => 'mysql']);
        // config(['database.connections.mysql.host' => '127.0.0.1']);
        // config(['database.connections.mysql.port' => '3306']);
        // config(['database.connections.mysql.database' => 'mideast']);
        // config(['database.connections.mysql.username' => 'root']);
        // config(['database.connections.mysql.password' => '']);
        // config(['app.timezone'=> SiteInfo::first()->datetimezone]);
        // config(['app.name'=> SiteInfo::first()->name]);
        // config(['app.url'=> Request::getHost()]);
        // config(['app.key'=> 'base64:mON1qgF5MEY9vvzWavairi/CF5y4Vd16SiaME6EPBnE=']);
       
           
    }
}
