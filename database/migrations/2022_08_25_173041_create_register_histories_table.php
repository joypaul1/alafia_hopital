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
        Schema::create('register_histories', function (Blueprint $table) {
            $table->id();
            $table->dateTime('opening_at');
            $table->dateTime('closing_at')->nullable();
            $table->unsignedBigInteger('register_id');
            $table->foreign('register_id')->references('id')->on('registers');
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
        Schema::dropIfExists('register_histories');
    }
};
