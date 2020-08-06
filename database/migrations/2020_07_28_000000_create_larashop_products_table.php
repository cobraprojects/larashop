<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLarashopProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('larashop_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('description')->nullable();
            $table->boolean('type')->default(0);
            $table->boolean('hidden')->default(0);
            $table->boolean('new')->default(0);
            $table->boolean('featured')->default(0);
            $table->boolean('has_discount')->default(0);
            $table->integer('price')->unsigned();
            $table->integer('old_price')->unsigned()->nullable();
            $table->integer('qty')->unsigned()->nullable();
            $table->integer('max_qty')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('larashop_products');
    }
}
