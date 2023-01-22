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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->nullable();
            $table->foreignId('outlet_id')->constrained('outlets')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->date('date');
            $table->string('cart_type');
            $table->string('cart_status');
            $table->boolean('status')->default(true);
            $table->decimal('coupon_amount', 15, 4)->default(0.00);
            $table->decimal('sub_total', 15, 4)->default(0.00);
            $table->decimal('total', 15, 4)->default(0.00);
            $table->unsignedBigInteger('created_by')->nullable();
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
        Schema::dropIfExists('carts');
    }
};
