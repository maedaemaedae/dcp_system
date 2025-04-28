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
        Schema::create('schools', function (Blueprint $table) {
            $table->id('school_id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('municipality_id');
            $table->string('school_name');
            $table->string('school_address');
            $table->string('school_head');
            $table->string('level');
            $table->string('created_by');
            $table->date('created_date');
            $table->string('modified_by')->nullable();
            $table->date('modified_date')->nullable();
            $table->timestamps();
    
            $table->foreign('division_id')->references('division_id')->on('divisions');
            $table->foreign('municipality_id')->references('municipality_id')->on('municipalities');
        });
    }    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
};
