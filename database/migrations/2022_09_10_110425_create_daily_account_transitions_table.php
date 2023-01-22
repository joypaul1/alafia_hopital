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
        Schema::create('daily_account_transitions', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('transitionable_id');
            $table->string('transitionable_type');
            $table->date('date');
            $table->decimal('debit', 15, 4)->default(0.00);
            $table->decimal('credit', 15, 4)->default(0.00);
            $table->longText('description')->nullable();
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
     * url - string imageable_id - integer imageable_type - string
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_account_transitions');
    }
};
