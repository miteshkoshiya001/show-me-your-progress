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
        Schema::create('sticker_collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sticker_category_id');
            $table->foreign('sticker_category_id')->references('id')->on('sticker_categories')->onDelete('cascade');
            $table->boolean('is_premium')->default(0)->comment('0 => no, 1 => yes');
            $table->boolean('is_default')->default(1)->comment('0 => no, 1 => yes');
            $table->boolean('status')->default(1)->comment('0 => Inactive, 1 => Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sticker_collections');
    }
};
