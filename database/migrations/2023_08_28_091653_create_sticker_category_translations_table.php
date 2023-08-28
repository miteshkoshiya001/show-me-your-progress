<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sticker_category_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sticker_category_id');
            $table->foreign('sticker_category_id')->references('id')->on('sticker_categories')->onDelete('cascade');
            $table->string('name', 255)->unique();
            $table->string('locale')->index();
            $table->unique(['sticker_category_id', 'locale']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('sticker_category_translations', function (Blueprint $table) {
            $table->dropForeign(['sticker_category_id']);
        });
        Schema::dropIfExists('sticker_category_translations');
    }
};
