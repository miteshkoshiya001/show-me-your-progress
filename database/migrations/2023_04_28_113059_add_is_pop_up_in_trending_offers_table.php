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
        Schema::table('trending_offers', function (Blueprint $table) {
            $table->tinyInteger('is_pop_up')->default(0)->comment('0 = no, 1 = yes');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trending_offers', function (Blueprint $table) {
            $table->dropColumn('is_pop_up');
        });
    }
};
