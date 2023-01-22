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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouses_id')->constrained('ware_houses')->nullable();
            $table->foreignId('item_id')->constrained('items')->nullable();
            $table->date('date');
            $table->decimal('pur_qty', 15, 4)->default(0.00);
            $table->decimal('pur_return_qty',15, 4)->default(0.00);
            $table->decimal('sell_qty',15, 4)->default(0.00);
            $table->decimal('sell_return_qty',15, 4)->default(0.00);
            $table->decimal('sell_replacement_qty',15, 4)->default(0.00);
            $table->decimal('damage_qty',15, 4)->default(0.00);
            $table->decimal('available_qty',15, 4)->storedAs('pur_qty-pur_return_qty-sell_qty-sell_return_qty+sell_replacement_qty-damage_qty');
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
        Schema::dropIfExists('inventory_items');
    }
};
