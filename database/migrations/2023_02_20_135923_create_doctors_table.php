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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->decimal('per_day_consultation_limitation', 15,4)->default(0);
            $table->string('consultation_duration')->default(0);
            $table->string('image')->nullable();
            $table->string('emergency_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('license_number')->nullable();
            $table->string('nid')->nullable();
            $table->date('dob')->nullable();
            $table->string('commission_type')->nullable();
            $table->decimal('commission_amount', 15, 4)->nullable();
            $table->string('present_address_1')->nullable();
            $table->string('present_address_2')->nullable();
            $table->string('present_address_city')->nullable();
            $table->string('present_address_state')->nullable();
            $table->string('permanent_address_1')->nullable();
            $table->string('permanent_address_2')->nullable();
            $table->string('permanent_address_city')->nullable();
            $table->string('permanent_address_state')->nullable();
            $table->date('joining_date')->nullable();
            $table->text('note')->nullable();
            $table->boolean('status')->default(true);
            $table->string('doc_id')->unique()->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->foreign('reference_id')->references('id')->on('doctors');
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id')->references('id')->on('departments');
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->foreign('designation_id')->references('id')->on('designations');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('admins');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('admins');
             $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('admins');
            $table->softDeletes();
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
        Schema::dropIfExists('doctors');
    }
};
