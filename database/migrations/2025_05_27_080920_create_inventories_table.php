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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->enum('recipient_type', ['school', 'division']);
            $table->unsignedBigInteger('recipient_id');
            $table->foreignId('package_content_id')->constrained('package_contents')->onDelete('cascade');
            $table->integer('quantity_received');
            $table->date('date_received')->nullable();
            $table->string('received_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
};
