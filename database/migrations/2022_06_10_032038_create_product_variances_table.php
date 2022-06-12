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
        Schema::create('product_variances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->string('color');
            $table->string('size');
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
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
        Schema::dropIfExists('product_variances');
    }
};
