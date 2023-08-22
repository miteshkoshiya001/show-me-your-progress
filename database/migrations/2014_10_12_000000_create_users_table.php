<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('user_type', ['parent', 'child', 'trainer', 'trainee']);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('username')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('referral_code', 6)->unique();
            $table->timestamps();

            // Define foreign key relationship
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
