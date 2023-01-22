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
        DB::statement("ALTER TABLE `image_galleries` CHANGE `medium` `medium` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci  NULL");

        Schema::create('items', function (Blueprint $table) {
            $table->string('b_image')->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
