<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLarashopCategoryLarashopProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('larashop_category_larashop_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('larashop_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('larashop_product_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('larashop_products');
    }
}
