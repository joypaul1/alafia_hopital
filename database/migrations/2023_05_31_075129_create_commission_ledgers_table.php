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
        Schema::create('commission_ledgers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->foreign('reference_id')->references('id')->on('references')->onDelete('cascade');
            $table->decimal('debit', 15, 4)->nullable()->default(0);
            $table->decimal('credit', 15, 4)->nullable()->default(0);
            $table->decimal('balance', 15, 4)->storedAs('debit - credit');
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
        Schema::dropIfExists('commission_ledgers');
    }
};
