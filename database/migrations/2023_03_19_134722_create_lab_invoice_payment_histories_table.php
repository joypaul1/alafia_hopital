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
        Schema::create('lab_invoice_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_invoice_id')->constrained('lab_invoices');
            $table->unsignedBigInteger('ledger_id');
            $table->foreign('ledger_id')->references('id')->on('account_ledgers');
            $table->decimal('paid_amount', 15,4)->default(0.00);
            $table->date('date');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('lab_invoice_payment_histories');
    }
};
