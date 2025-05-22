<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dcp_recipient_division_offices', function (Blueprint $table) {
            $table->id();
            $table->string('region')->nullable();
            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id')
                ->references('division_id')
                ->on('division_offices')
                ->onDelete('set null');
            $table->string('office')->nullable();
            $table->string('sdo_address')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('position')->nullable();
            $table->string('contact_number')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dcp_recipient_division_offices');
    }
};
