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
        Schema::create('internet', function (Blueprint $table) {
            $table->id('internet_id');
            $table->unsignedBigInteger('school_id')->nullable();
            $table->boolean('connected_to_internet')->nullable();
            $table->string('isp')->nullable();
            $table->string('type_of_isp')->nullable();
            $table->string('fund_source')->nullable();
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
        Schema::dropIfExists('internet');
    }
};
