<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('iin', 12)->index()->nullable();
            $table->integer('iin_status')->default(0);
            $table->string('phone', 16)->index()->nullable();
            $table->integer('phone_status')->default(0);
            $table->string('email', 60)->index()->nullable();
            $table->integer('email_status')->default(0);
            $table->string('login', 20)->index()->nullable();
            $table->string('password')->nullable();
            $table->string('pincode', '10')->nullable();
            $table->string('smscode', '20')->index()->nullable();
            $table->integer('status')->index()->default(0);
            $table->datetime('last_visit')->nullable();
            $table->string('last_device')->nullable();
            $table->ipAddress('last_ip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
