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
        Schema::create('service_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->string('discount_type')->nullable();
            $table->decimal('discount_amount',15,4)->default(0.00);
            $table->foreignId('tax_id')->constrained('tax_settings')->nullable();
            $table->decimal('tax_amount',15,4)->default(0.00);
            $table->decimal('paid_amount',15,4)->default(0.00);
            $table->decimal('subtotal_amount',15,4)->default(0.00);
            $table->decimal('total_amount',15,4)->default(0.00);
            $table->decimal('due_amount',15,4)->storedAs('total_amount-paid_amount');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('admins');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('admins');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('admins');
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
        Schema::dropIfExists('service_invoices');
    }
};
