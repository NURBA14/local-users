<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('nationalities', function (Blueprint $table) {
            $table->renameColumn("name", "name_rus");
            $table->renameColumn("title", "name_kaz");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nationalities', function (Blueprint $table) {
            $table->renameColumn("name_rus", "name");
            $table->renameColumn("name_kaz", "title");
        });
    }
};
