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
            $table->string('avatar')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->nullable()->unique();
            $table->unsignedBigInteger('user_category_id')->nullable();
            $table->tinyInteger('member_type')->default(3)->comment('1 = admin/owner, 2 = member, 3 = individual user');
            $table->string('referral_code')->unique();
            $table->string('password');
            $table->tinyInteger('is_google_login')->default(0)->comment('0 = no, 1 = yes');
            $table->tinyInteger('status')->default(1)->comment('0 = Inactive, 1 = Active, 2=Deleted');
            $table->tinyInteger('notification_status')->default(1)->comment('0 = off, 1 = on');
            $table->string('api_token', 80)->unique()->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->string('language')->default('en');
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
