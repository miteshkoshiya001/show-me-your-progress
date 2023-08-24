<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN user_type ENUM('parent', 'child', 'trainer', 'trainee', 'admin','teacher','student')");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
