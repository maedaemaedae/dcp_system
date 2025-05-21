<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regional_offices', function (Blueprint $table) {
            $table->unsignedBigInteger('ro_id')->primary();
            $table->string('ro_office'); // Region name or code
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regional_offices');
    }
};