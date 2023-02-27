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
        Schema::create('service_names', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('service_price', 15, 4)->default(0.0000);
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('service_type_id')->constrained('service_types');
            $table->foreignId('created_by')->constrained('admins');
            $table->foreignId('updated_by')->nullable()->constrained('admins');
            $table->foreignId('deleted_by')->nullable()->constrained('admins');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `prescription_tests` ADD FOREIGN KEY (`service_id`) REFERENCES `service_names`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_names');
    }
};
