<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('municipalities', function (Blueprint $table) {
            $table->unsignedBigInteger('division_id')->nullable(); // removed ->after('id')
            $table->foreign('division_id')->references('division_id')->on('division_offices')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('municipalities', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropColumn('division_id');
        });
    }
};

