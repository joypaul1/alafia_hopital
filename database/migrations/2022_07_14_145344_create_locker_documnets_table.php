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
        Schema::create('locker_documnets', function (Blueprint $table) {
            $table->id();
            $table->text('field_1')->nullable();
            $table->text('field_2')->nullable();
            $table->text('field_3')->nullable();
            $table->string('field_4')->nullable();
            $table->unsignedBigInteger('locker_id');
            $table->foreign('locker_id')->references('id')->on('personal_lockers');
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
        Schema::dropIfExists('locker_documnets');
    }
};
