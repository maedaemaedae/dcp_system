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
        Schema::create('regional_offices', function (Blueprint $table) {
            $table->id('ro_id');
            $table->string('ro_office');
            $table->string('person_in_charge');
            $table->string('email')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_date')->nullable();
            $table->string('modified_by')->nullable();
            $table->timestamp('modified_date')->nullable();
            $table->timestamps(); // Laravel-managed created_at and updated_at
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regional_offices');
    }
};
