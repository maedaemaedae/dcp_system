<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ict_equipment', function (Blueprint $table) {
            $table->id();

            $table->string('equipment_id'); // Manual input
            $table->string('item_description');
            $table->string('category');
            $table->string('brand');
            $table->string('model');
            $table->string('asset_number');
            $table->string('serial_number')->unique(); // Unique constraint
            $table->string('network_ip')->nullable();
            $table->string('pc_make')->nullable();
            $table->string('pc_build')->nullable();
            $table->string('pc_sn')->nullable();
            $table->string('monitor_sn')->nullable();
            $table->string('avr_sn')->nullable();
            $table->string('wifi_adapter_sn')->nullable();
            $table->string('keyboard_sn')->nullable();
            $table->string('mouse_sn')->nullable();
            $table->string('location');
            $table->string('assigned_to');
            $table->date('purchase_date');
            $table->date('warranty_expiry');
            $table->enum('condition', ['IN USE', 'FOR REPAIR']);
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ict_equipment');
    }
};