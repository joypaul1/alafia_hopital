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


        Schema::create('radiology_service_invoice_payment_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_invoice_id');
            $table->unsignedBigInteger('ledger_id');
            $table->foreign('ledger_id')->references('id')->on('account_ledgers');
            $table->decimal('paid_amount', 15,4)->default(0.00);
            $table->date('date');
            $table->string('note')->nullable();
            $table->timestamps();
        });
        DB::Statement('ALTER TABLE `radiology_service_invoice_payment_histories` ADD FOREIGN KEY (`service_invoice_id`) REFERENCES `radiology_service_invoices`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('radio_logy_service_invoic_payment_histories');
    }
};
