<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dcp_recipient_schools_l4t', function (Blueprint $table) {
            $table->id();
            $table->string('region')->nullable();
            $table->string('division')->nullable(); 
            $table->unsignedBigInteger('school_id')->nullable();
            $table->foreign('school_id')->references('school_id')->on('schools')->onDelete('set null');
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
        Schema::dropIfExists('dcp_recipient_schools_l4t');
    }
};
