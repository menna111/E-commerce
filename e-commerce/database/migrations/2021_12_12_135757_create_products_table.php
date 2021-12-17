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
            $table->bigInteger('cate_id');
            $table->foreign('cate_id')->on('categories')->references('id')->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('sub_category_id')->default('1');
            $table->foreign('sub_category_id')->on('sub_category')->references('id')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('name');
            $table->mediumText('small_description');
            $table->Text('description');
            $table->string('original_price');
            $table->string('selling_price');
            $table->string('image')->nullable();
            $table->string('qty');
            $table->string('tax');
            $table->tinyInteger('status');
            $table->tinyInteger('trending');
            $table->text('meta_title');
            $table->text('meta_keywords');
            $table->text('meta_description');
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
