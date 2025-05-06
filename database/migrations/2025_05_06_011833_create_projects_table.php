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
        Schema::create('projects', function (Blueprint $table) {
            $table->id('projects_id');
            $table->unsignedBigInteger('school_id');
            $table->string('project_name');
            $table->integer('year');
            $table->text('description')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps(); // adds created_at and updated_at
        });
             
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
