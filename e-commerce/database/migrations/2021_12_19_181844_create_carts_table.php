<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id')->cascadeOnUpdate()->v;

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->on('products')->references('id')->cascadeOnUpdate()->v;

            $table->string('product_name');
            $table->string('image')->nullable();
            $table->string('product_price');
            $table->integer('product_qty');


            $table->timestamps();
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
}
