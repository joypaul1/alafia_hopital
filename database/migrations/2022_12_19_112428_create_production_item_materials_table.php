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
        Schema::create('production_item_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id')->constrained('productions');
            $table->foreignId('item_id')->constrained('items');
            $table->decimal('price', 15,4)->default(0.00);
            $table->decimal('total', 15,4)->default(0.00);
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
        Schema::dropIfExists('production_item_materials');
    }
};
