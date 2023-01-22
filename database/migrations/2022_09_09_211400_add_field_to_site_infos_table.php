<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::statement("ALTER TABLE `site_infos` ADD `currency_symbol_placement` VARCHAR(255) NOT NULL AFTER `updated_at`, ADD `date_format` VARCHAR(255) NOT NULL AFTER `currency_symbol_placement`, ADD `accounting_method` VARCHAR(255) NOT NULL AFTER `date_format`, ADD `currency_precision` VARCHAR(255) NOT NULL AFTER `accounting_method`, ADD `quantity_precision` VARCHAR(255) NOT NULL AFTER `currency_precision`, ADD `default_datatable_page_entries` VARCHAR(255) NOT NULL AFTER `quantity_precision`;");
        // DB::statement("ALTER TABLE `site_infos` ADD `start_date` DATE NULL DEFAULT NULL AFTER `default_datatable_page_entries`;");
        // Schema::table('site_infos', function (Blueprint $table) {
        //     //
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_infos', function (Blueprint $table) {
            //
        });
    }
};
