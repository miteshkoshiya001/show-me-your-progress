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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->default(0);
            $table->string('color', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->tinyInteger('status')->default(0)->comment('0 = inactive, 1 = active, 2 = deleted');
            $table->tinyInteger('is_important')->default(0)->comment('0 = no, 1 = yes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
