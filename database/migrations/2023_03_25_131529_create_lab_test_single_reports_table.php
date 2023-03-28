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
        Schema::create('lab_test_reports', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->datetime('created_date');
            $table->unsignedBigInteger('lab_test_id');
            $table->foreign('lab_test_id')->references('id')->on('lab_tests');
            $table->unsignedBigInteger('lab_invoice_test_detail_id');
            $table->foreign('lab_invoice_test_detail_id')->references('id')->on('lab_invoice_test_details')->onDelete('cascade');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('admins');
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->foreign('verified_by')->references('id')->on('admins');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('approved_by')->references('id')->on('admins');
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
        Schema::dropIfExists('lab_test_single_reports');
    }
};
