<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('notes');
        });
    }

    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};