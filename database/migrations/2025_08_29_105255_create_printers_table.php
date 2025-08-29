<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('printers', function (Blueprint $table) {
        $table->id();
        $table->string('equipment_id')->nullable();
        $table->string('item_description')->nullable();
        $table->string('category')->default('Printer');

        $table->string('brand')->nullable();
        $table->string('model')->nullable();
        $table->string('network_ip')->nullable();
        $table->string('asset_number')->nullable();
        $table->string('serial_number')->unique();

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
