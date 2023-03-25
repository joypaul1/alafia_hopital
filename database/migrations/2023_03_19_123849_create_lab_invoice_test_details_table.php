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
        Schema::create('lab_invoice_test_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_invoice_id');
            $table->foreign('lab_invoice_id')->references('id')->on('lab_invoices')->onDelete('cascade');
            $table->unsignedBigInteger('lab_test_id');
            $table->foreign('lab_test_id')->references('id')->on('lab_tests');
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
        Schema::dropIfExists('lab_invoice_details');
    }
};
