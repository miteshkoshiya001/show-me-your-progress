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
        Schema::create('sticker_collection_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sticker_collection_id');
            $table->foreign('sticker_collection_id')->references('id')->on('sticker_collections')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('locale')->index();
            $table->unique(['sticker_collection_id', 'locale'], 'sticker_collection_locale_unique'); // Updated line
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sticker_collection_translations');
    }
};
