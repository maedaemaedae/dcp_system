<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('division_offices', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->primary();
            $table->string('division_name');

            $table->unsignedBigInteger('regional_office_id');

            $table->timestamps();

            $table->foreign('regional_office_id')
                  ->references('ro_id')
                  ->on('regional_offices')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('division_offices');
    }
};