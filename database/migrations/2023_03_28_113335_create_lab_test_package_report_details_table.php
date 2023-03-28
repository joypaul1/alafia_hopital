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
        Schema::create('lab_test_report_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lab_test_report_id');
            $table->foreign('lab_test_report_id')->references('id')->on('lab_test_reports');
            $table->string('name');
            $table->string('result')->nullable();
            $table->text('reference')->nullable();
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
        Schema::dropIfExists('lab_test_package_report_details');
    }
};
