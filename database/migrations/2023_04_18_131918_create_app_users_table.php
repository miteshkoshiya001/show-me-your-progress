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
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 255)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = inactive, 1 = active, 2 = deleted');
            $table->string('api_token', 255)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('language', 2)->default('en')->nullable()->comment('en = english, gu = gujrati');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_users');
    }
};
