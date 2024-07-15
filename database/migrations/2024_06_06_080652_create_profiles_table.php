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
        // id	uuid	iin	nickname	name	surname	lastname	birthdate	deathdate
        // gender	nationality	resident	father	mother	guardian	created_at	updated_at	status
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id')->unique();
            $table->uuid('uuid')->unique();
            $table->string('iin', 12)->index()->nullable();
            $table->string('nickname', 50)->nullable();
            $table->string('name', 100)->nullable();
            $table->string('surname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->date('birthdate')->nullable();
            $table->date('deathdate')->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->integer('resident')->nullable();
            $table->string('father_iin', 12)->nullable();
            $table->string('mother_iin', 12)->nullable();
            $table->string('guardian_iin', 12)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('account_id')
                ->references('id')->on('user_accounts');//->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
