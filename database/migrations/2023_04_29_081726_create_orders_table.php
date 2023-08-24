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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigInteger('id', 40);
            $table->string('order_id', 50);
            $table->integer('user_id');
            $table->integer('address_id');
            $table->float('order_total');
            $table->float('order_discount')->default(0);
            $table->dateTime('order_date');
            $table->text('order_note');
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
        Schema::dropIfExists('orders');
    }
};
