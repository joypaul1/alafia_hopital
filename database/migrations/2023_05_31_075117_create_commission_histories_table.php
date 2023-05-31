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
        Schema::create('commission_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
            $table->unsignedBigInteger('lab_invoice_id')->nullable();
            $table->foreign('lab_invoice_id')->references('id')->on('lab_invoices')->onDelete('cascade');
            $table->unsignedBigInteger('radiology_service_invoice_id')->nullable();
            $table->foreign('radiology_service_invoice_id')->references('id')->on('radiology_service_invoices')->onDelete('cascade');
            $table->decimal('commission', 15,4)->nullable()->default(0);
            $table->dateTime('date')->nullable();
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
        Schema::dropIfExists('commission_histories');
    }
};
