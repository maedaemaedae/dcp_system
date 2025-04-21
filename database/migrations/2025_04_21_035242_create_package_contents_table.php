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
        
            $table->unsignedBigInteger('package_type_id');
            $table->unsignedBigInteger('item_id'); // FK to inventory.item_id
            $table->integer('quantity')->default(1);
        
            $table->timestamps();
        
            $table->foreign('package_type_id')
                  ->references('id')->on('package_types')
                  ->onDelete('cascade');
        
            $table->foreign('item_id')
                  ->references('item_id')->on('inventory') // 💡 must match the actual PK name
                  ->onDelete('cascade');
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
