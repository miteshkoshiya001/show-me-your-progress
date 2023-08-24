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
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigInteger('id', 40);
            $table->integer('order_id');
            $table->string('order_numer', 50);
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('unit_id');
            $table->float('price')->default(0);
            $table->float('item_total')->default(0);
            $table->tinyInteger('status')->default(0)->comment('0 => Pending, 1=> In progress, 2 => Confirmed, 3 => Shipped, 4 => Delivered, 5 => Cancelled');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
