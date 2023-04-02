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
        Schema::create('service_invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_invoice_id');
            $table->foreign('service_invoice_id')->references('id')->on('service_invoices')->onDelete('cascade');
            $table->foreignId('service_name_id')->constrained('service_names');
            $table->decimal('qty', 15,4)->default(0.00);
            $table->decimal('service_price', 15,4)->default(0.00);
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
        Schema::dropIfExists('service_invoice_items');
    }
};
