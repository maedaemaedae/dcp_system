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
        Schema::create('package_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_type_id')->constrained()->onDelete('cascade');
            $table->string('item_name');
            $table->integer('quantity');
            $table->string('description')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->string('modified_by')->nullable();
            $table->timestamp('modified_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_contents');
    }
};
