<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $fillable = [
        'user_id', 
        'product_id', 
        'product_variance_id', 
        'price', 
        'quantity', 
        'reward',
        'discount',
        'shipping_fees'

    ];

    public $incrementing = false;
    public $timestamps = false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->foreignId('product_variance_id');
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(1);
            $table->integer('reward')->default(5);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('shipping_fees', 10, 2)->default(0);
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
            $table->foreign('product_variance_id')
                  ->references('id')
                  ->on('product_variances')
                  ->onDelete('cascade');
            $table->primary(['user_id', 'product_id','product_variance_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
