<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLarashopCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('larashop_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('descripiton')->nullable();
            $table->string('coupon_type'); // class name for calculate coupon
            $table->unsignedInteger('amount');
            $table->string('discount_type')->default('percent'); // percent or amount
            $table->mediumText('data')->nullable();  // store custom ids for (products - categories - users) 
            $table->boolean('only_once')->default(true); // is coupon valid for only one time per user
            $table->boolean('is_valid')->default(true);
            $table->timestamp('expire_at')->nullable();
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
        Schema::dropIfExists('larashop_coupons');
    }
}
