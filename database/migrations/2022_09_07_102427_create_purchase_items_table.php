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
        Schema::create('purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases')->nullable();
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('item_variant_id')->constrained('item_variants')->nullable();
            $table->decimal('up_before_tax', 15,4)->default(0.00);
            $table->decimal('subtotal_up_before_tax', 15,4)->default(0.00);
            $table->foreignId('tax_id')->constrained('tax_settings')->nullable();
            $table->enum('tax_type',['included_tax', 'excluded_tax'])->nullable();
            $table->decimal('tax_rate', 15,4)->default(0.00);
            $table->decimal('up_after_tax', 15,4)->default(0.00);
            $table->decimal('subtotal_up_after_tax', 15,4)->default(0.00);
            $table->decimal('profit_percent', 15,4)->default(0.00);
            $table->decimal('un_sell_price', 15,4)->default(0.00);
            $table->decimal('total_sell_price', 15,4)->default(0.00);
            $table->decimal('purchase_qty', 15,4)->default(0.00);
            $table->decimal('purchase_return_qty', 15,4)->default(0.00);
            $table->decimal('purchase_damage_qty', 15,4)->default(0.00);
            $table->decimal('sell_qty', 15,4)->default(0.00);
            $table->decimal('sell_replacement_qty', 15,4)->default(0.00);
            $table->decimal('sell_return_qty', 15,4)->default(0.00);
            $table->decimal('available_qty', 15,4)->storedAs('purchase_qty-purchase_return_qty-purchase_damage_qty-sell_qty-sell_replacement_qty');
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
        Schema::dropIfExists('purchase_items');
    }
};
