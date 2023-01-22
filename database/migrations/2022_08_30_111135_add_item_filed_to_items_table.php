<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('origin_id')->nullable();
            $table->foreign('origin_id')->references('id')->on('countries');
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->foreign('tax_id')->references('id')->on('tax_settings');
            $table->string('image')->nullable()->after('sku');
            $table->enum('tax_type',['included_tax', 'excluded_tax'])->nullable();
            $table->enum('product_type',['single', 'variant', 'combo'])->nullable();
            $table->decimal('tax_rate', 15,4)->default(0.00)->after('sell_price');
            $table->decimal('profit_percent', 15,4)->default(0.00)->after('tax_rate');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            //
        });
    }
};
