<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dcp_recipient_schools_stv', function (Blueprint $table) {
            $table->id();

            // Correct foreign keys
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')
                  ->references('ro_id')
                  ->on('regional_offices')
                  ->nullOnDelete();

            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id')
                  ->references('division_id')
                  ->on('division_offices')
                  ->nullOnDelete();

            $table->unsignedBigInteger('school_id')->nullable();
            $table->foreign('school_id')
                  ->references('school_id')
                  ->on('schools')
                  ->nullOnDelete();

            $table->string('school_name')->nullable();
            $table->string('school_address')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('position')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dcp_recipient_schools_stv');
    }
};
