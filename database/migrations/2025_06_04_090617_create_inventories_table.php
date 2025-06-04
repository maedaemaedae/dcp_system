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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('school_id')->nullable();
            $table->foreign('school_id')->references('school_id')->on('schools')->onDelete('cascade');

            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id')->references('division_id')->on('division_offices')->onDelete('cascade');

            $table->string('item_name');
            $table->integer('quantity')->default(1);
            $table->string('status')->default('in use'); // options: in use, pulled out, missing
            $table->text('remarks')->nullable(); // optional description (brand, model, etc.)
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
        Schema::dropIfExists('inventories');
    }
};
