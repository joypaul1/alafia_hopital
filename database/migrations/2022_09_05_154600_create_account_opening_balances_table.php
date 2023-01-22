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
        // Schema::create('account_opening_balances', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('account_ledger_id');
        //     $table->foreign('account_ledger_id')->references('id')->on('account_ledgers');
        //     $table->decimal('debit', 15, 4)->default(0.00);
        //     $table->decimal('credit', 15, 4)->default(0.00);
        //     $table->decimal('total', 15, 4)->storedAs('debit-credit');
        //     $table->date('date');
        //     $table->unsignedBigInteger('created_by');
        //     $table->foreign('created_by')->references('id')->on('admins');
        //     $table->unsignedBigInteger('updated_by')->nullable();
        //     $table->foreign('updated_by')->references('id')->on('admins');
        //     $table->softDeletes();
        //     $table->unsignedBigInteger('deleted_by')->nullable();
        //     $table->foreign('deleted_by')->references('id')->on('admins');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accpount_opening_balances');
    }
};
