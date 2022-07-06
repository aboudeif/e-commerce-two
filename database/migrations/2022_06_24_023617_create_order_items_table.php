<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->foreignId('product_variance_id');
            $table->unsignedBigInteger('quantity')->default(0);
            $table->decimal('price',10,2);
            $table->decimal('discount',10,2)->default(0);
            $table->decimal('points',10,2)->default(0);
            $table->decimal('total_price',10,2);
            $table->timestamps();
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
            $table->foreign('product_variance_id')
                    ->references('id')
                    ->on('product_variances')
                    ->onDelete('cascade');
            $table->foreign('order_id')
                    ->references('id')
                    ->on('orders')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
