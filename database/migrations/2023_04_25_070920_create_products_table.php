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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('uom_id');
            $table->string('sku', 255);
            $table->integer('stock')->default(0);
            $table->float('price')->default(0);
            $table->float('fake_price')->default(0);
            $table->float('user_discount')->default(0);
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
        Schema::dropIfExists('products');
    }
};
