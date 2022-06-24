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
            $table->integer('points')->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->string('color');
            $table->string('color_code');
            $table->enum('size',['XS','S', 'M', 'L', 'XL', 'XXL', 'XXXL']);
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
