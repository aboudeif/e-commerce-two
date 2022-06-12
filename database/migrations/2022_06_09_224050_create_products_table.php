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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
            $table->foreign('subcategory_id')
                  ->references('id')
                  ->on('subcategories')
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
        Schema::dropIfExists('product_media');
        Schema::dropIfExists('products');
    }
};
