<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->id(); // internal recipient ID

            $table->enum('type', ['school', 'division', 'regional']);
            $table->unsignedBigInteger('reference_id'); // ID from schools/divisions/regionals
            $table->string('name'); // cached name for easier lookup (optional)

            $table->timestamps();

            // Optional: Enforce uniqueness across type + reference
            $table->unique(['type', 'reference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipients');
    }
};
