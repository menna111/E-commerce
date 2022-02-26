<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->unsignedBigInteger('cate_id');
            $table->foreign('cate_id')->on('categories')->references('id')->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedBigInteger('sub_category_id')->default('1');
            $table->foreign('sub_category_id')->on('sub_categories')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('name');
            $table->Text('description');
            $table->string('original_price');
            $table->string('after_sale');
            $table->string('image')->nullable();
            $table->string('qty');
            $table->string('tax');
            $table->tinyInteger('trending');

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
        Schema::dropIfExists('products');
    }
}
