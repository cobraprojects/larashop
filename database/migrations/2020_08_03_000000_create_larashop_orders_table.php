<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLarashopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('larashop_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->foreignId('larashop_address_id')->nullable()->constrained()->onDelete('SET NULL');
            $table->boolean('paid')->default(0);
            $table->string('payment_type')->default('credit');
            $table->string('status')->default('جاري التحضير');
            $table->integer('price')->default(0);
            $table->integer('shipping_cost')->default(0);
            $table->integer('coupon_discount')->default(0);
            $table->string('coupon_code')->nullable();
            $table->integer('payment_fee')->default('0');
            $table->string('address', 1000)->nullable();
            $table->string('email')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('postcode')->nullable();
            $table->mediumText('notes')->nullable();
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
        Schema::dropIfExists('larashop_orders');
    }
}
