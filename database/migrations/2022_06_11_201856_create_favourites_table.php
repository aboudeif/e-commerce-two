<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 //   protected $primaryKey = ['user_id', 'product_id'];
    protected $fillable = ['user_id', 'product_id'];
    public $incrementing = false;
    public $timestamps = false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
       
        Schema::create('favourites', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('product_id')
                  ->references('id')
                  ->on('products')
                  ->onDelete('cascade');
            $table->primary(['user_id', 'product_id']);
        });
        
        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favourites');
    }
};
