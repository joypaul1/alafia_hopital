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
        DB::statement("ALTER TABLE `items` CHANGE `unit_price` `up_before_tax` DECIMAL(15,4) NOT NULL DEFAULT '0.00' COMMENT 'unit_price_before_tax';");
        DB::statement("ALTER TABLE `items` CHANGE `unit_price` `up_before_tax` DECIMAL(15,4) NOT NULL DEFAULT '0.00' COMMENT 'unit_price_before_tax';");
        DB::statement("ALTER TABLE `items` CHANGE `sell_price` `sell_price` DECIMAL(15,4) NOT NULL DEFAULT '0.00' AFTER `up_after_tax`;");
        DB::statement("ALTER TABLE `items` ADD `alert_quantity` INT NULL DEFAULT '0' AFTER `product_type`;");
        Schema::create('item_meta_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->text('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description"')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_meta_tags');
    }
};
