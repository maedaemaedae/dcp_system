<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            // School ID from Excel — not auto-increment
            $table->unsignedBigInteger('school_id')->primary();

            // Division reference
            $table->unsignedBigInteger('division_id');

            // Excel-based columns
            $table->string('school_name');
            $table->string('school_address');
            $table->boolean('has_internet')->default(false);
            $table->string('internet_provider')->nullable();
            $table->string('electricity_provider')->nullable();

            $table->timestamps();

            // Foreign key relationship
            $table->foreign('division_id')
                  ->references('division_id')
                  ->on('division_offices')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};