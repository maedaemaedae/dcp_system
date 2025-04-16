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
        Schema::create('division_offices', function (Blueprint $table) {
            $table->id('division_id');
            $table->string('division_name');
            $table->string('person_in_charge');
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->unsignedBigInteger('regional_office_id'); // Foreign key to regional_offices
            $table->string('created_by')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->string('modified_by')->nullable();
            $table->timestamp('modified_date')->nullable();
            $table->timestamps();
    
            $table->foreign('regional_office_id')->references('ro_id')->on('regional_offices')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('division_offices');
    }
};
