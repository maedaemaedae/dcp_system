<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('package_type_project', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_type_id')->constrained('package_types')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects', 'projects_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('package_type_project');
    }
};
