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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('race_type_id');
            $table->foreign('race_type_id')->references('id')->on('race_types');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('drivers');
    }
};
