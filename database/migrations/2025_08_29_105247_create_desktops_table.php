<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('desktops', function (Blueprint $table) {
        $table->id();
        $table->string('equipment_id')->nullable();
        $table->string('item_description')->nullable();
        $table->string('category')->default('Desktop');

        $table->string('pc_make')->nullable();
        $table->string('pc_model')->nullable();
        $table->string('asset_number')->nullable();
        $table->string('pc_sn')->nullable();
        $table->string('monitor_sn')->nullable();
        $table->string('avr_sn')->nullable();
        $table->string('wifi_adapter_sn')->nullable();
        $table->string('keyboard_sn')->nullable();
        $table->string('mouse_sn')->nullable();

        $table->string('location')->nullable();
        $table->string('assigned_to')->nullable();
        $table->date('purchase_date')->nullable();
        $table->date('warranty_expiry')->nullable();
        $table->string('condition')->nullable();
        $table->text('note')->nullable();

        $table->timestamps();
    });
}

};
