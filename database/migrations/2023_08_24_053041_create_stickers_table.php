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
        Schema::create('stickers', function (Blueprint $table) {
            $table->id();
            $table->string('user_type');
            $table->string('sticker_template');
            $table->integer('template_x');
            $table->integer('template_y');
            $table->integer('template_width');
            $table->integer('template_height');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('stickers');
    }
};
