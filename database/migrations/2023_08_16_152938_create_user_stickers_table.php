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
        Schema::create('users_sticker', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('user_id');
            $table->string('stk_path_1')->nullable();
            $table->string('stk_path_2')->nullable();
            $table->string('stk_path_3')->nullable();
            $table->string('stk_path_4')->nullable();
            $table->string('stk_path_5')->nullable();
            $table->string('stk_path_6')->nullable();
            $table->timestamps();

            // Define foreign keys if necessary
            // $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users_sticker');
    }
};
