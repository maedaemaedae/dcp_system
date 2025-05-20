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
        Schema::create('electricity', function (Blueprint $table) {
            $table->id('electricity_id');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->string('electricity_source')->nullable();
            $table->timestamps();

            $table->foreign('school_id')->references('school_id')->on('schools')->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electricity');
    }
};
