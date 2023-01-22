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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('cart_id')->constrained('carts');
            $table->foreignId('item_variant_id')->constrained('item_variants')->nullable();
            $table->decimal('qty', 15,4)->default(0.00);
            $table->decimal('unit_price', 15,4)->default(0.00);
            $table->decimal('subtotal', 15,4)->default(0.00);
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
        Schema::dropIfExists('cart_items');
    }
};
