<?php

namespace App\Providers;

use App\Models\EmailConfiguration;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailConfigProvider extends ServiceProvider
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

        // view()->composer('email', function ($view) {

        // });
        // active()->
        // $emailConfiguration = EmailConfiguration::latest()->first();

        // if ($emailConfiguration) {
        //     $config = array(
        //         'driver'     => $emailConfiguration->driver,
        //         'host'       => $emailConfiguration->host,
        //         'port'       => $emailConfiguration->port,
        //         'username'   => $emailConfiguration->username,
        //         'password'   => $emailConfiguration->password,
        //         'encryption' => $emailConfiguration->encryption,
        //         'from'       => array('address' => $emailConfiguration->sender_email, 'name' => $emailConfiguration->sender_name),
        //         'sendmail'   => '/usr/sbin/sendmail -bs',
        //         'pretend'    => false,
        //     );
        //     Config::set('mail', $config);
        // }
    }
}
