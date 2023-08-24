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
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('address1', 255)->nullable();
            $table->string('address2', 255)->nullable();
            $table->string('building_no', 255)->nullable();
            $table->string('landmark', 255)->nullable();
            $table->string('zipcode', 6)->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->enum('type', ['home', 'office', 'shop'])->default('home');
            $table->tinyInteger('is_primary')->default(0)->comment('0 = no, 1 = yes');
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
        Schema::dropIfExists('delivery_addresses');
    }
};
