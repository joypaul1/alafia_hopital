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
        // Schema::create('account_ledgers', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('note')->nullable();
        //     $table->boolean('status')->default(true);
        //     $table->boolean('rec_pay')->default(true);
        //     $table->unsignedBigInteger('account_group_id');
        //     $table->foreign('account_group_id')->references('id')->on('account_groups');
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
        Schema::dropIfExists('accout_ledgers');
    }
};
