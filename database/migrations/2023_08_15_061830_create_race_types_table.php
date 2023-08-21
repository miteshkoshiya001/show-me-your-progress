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
        Schema::create('race_types', function (Blueprint $table) {
            $table->id();
            $table->string('race_name')->unique(); // Set the race_name field as unique
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('race_types');
    }
};
