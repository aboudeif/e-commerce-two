<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Auth;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->default(Auth::id());
            $table->unsignedBigInteger('quantity')->default(0);
            $table->decimal('price',10,2)->default(0);
            $table->decimal('discount',10,2)->default(0);
            $table->decimal('tax',10,2)->default(0.14);
            $table->decimal('points',10,2)->default(0);
            $table->decimal('shipping',10,2)->default(0);
            $table->enum('payment_method', ['cash', 'credit_card'])->default('cash');
            $table->foreignId('shipping_address_id')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'cancelled'])->default('pending');
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('shipping_address_id')
                    ->references('id')
                    ->on('shipping_addresses')
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('shipping_addresses');
        Schema::dropIfExists('orders');
    }
};
