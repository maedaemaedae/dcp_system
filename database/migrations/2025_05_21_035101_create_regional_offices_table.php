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
            $table->string('ro_office'); // Region name
            $table->string('ro_address')->nullable(); // ✅ New
            $table->string('person_in_charge')->nullable(); // ✅ New
            $table->string('email')->nullable(); // ✅ New
            $table->string('contact_no')->nullable(); // ✅ New
            $table->string('created_by')->nullable(); // ✅ New
            $table->timestamp('created_date')->nullable(); // ✅ New
            $table->string('modified_by')->nullable(); // ✅ New
            $table->timestamp('modified_date')->nullable(); // ✅ New
            $table->timestamps(); // includes created_at, updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regional_offices');
    }
};