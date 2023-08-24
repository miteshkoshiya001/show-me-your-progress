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
        Schema::create('trending_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->string('banner', 255)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = inactive, 1 = active, 2 = deleted');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trending_offers');
    }
};
