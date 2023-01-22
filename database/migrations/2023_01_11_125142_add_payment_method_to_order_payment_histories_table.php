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
        Schema::table('order_payment_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_system_id')->nullable();
            $table->foreign('payment_system_id')->references('id')->on('payment_systems');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_payment_histories', function (Blueprint $table) {
            //
        });
    }
};
