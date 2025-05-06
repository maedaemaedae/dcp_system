<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id('packages_id');

            $table->unsignedBigInteger('package_type_id');
            $table->foreign('package_type_id')
                  ->references('id')
                  ->on('package_types')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id')
                  ->references('projects_id')
                  ->on('projects')
                  ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};

