<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        DB::statement('ALTER TABLE `ledger_transitions` ADD `balance` DECIMAL(15,4) AS (`debit`-`credit`) VIRTUAL AFTER `credit`');
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            // $table->decimal('amount', 15,4);
            $table->string('status')->default(true);
            $table->string('ledger_type');
            $table->unsignedBigInteger('transaction_id')->nullable();
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->unsignedBigInteger('ledger_id');
            $table->foreign('ledger_id')->references('id')->on('account_ledgers');
            $table->decimal('amount', 15,4)->default(0.00);

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
        Schema::dropIfExists('transaction_histories');
    }
};
