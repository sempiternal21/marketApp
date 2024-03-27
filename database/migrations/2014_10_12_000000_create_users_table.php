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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('ad_models', function (Blueprint $table) {
            $table->id();
            $table->string('author');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('price');
            $table->string('imageUrl')->nullable();
            $table->timestamps();
        });
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('ads');
    }
};
