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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->foreign('gender_id', "gender_id_foreign_key")
                ->references('id')->on('genders');
            $table->foreign('nationality_id', "nationality_id_foreign_key")
                ->references('id')->on('nationalities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropForeign("gender_id_foreign_key");
            $table->dropForeign("nationality_id_foreign_key");
        });
    }
};
