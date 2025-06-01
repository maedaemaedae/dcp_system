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
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();

            // Existing
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->enum('recipient_type', ['school', 'division']);
            $table->unsignedBigInteger('recipient_id'); // Foreign key (manual polymorphic)
            $table->text('notes')->nullable();

            // New columns based on requested headers
            $table->string('contact_person')->nullable();
            $table->string('position')->nullable();
            $table->string('contact_number')->nullable();

            // Created by / Modified by tracking
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('modified_by')->nullable()->constrained('users');

            $table->timestamps(); // includes created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipients');
    }
};
