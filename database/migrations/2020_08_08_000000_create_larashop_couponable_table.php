<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLarashopCouponableTable extends Migration
{
    public function up()
    {
        Schema::create('larashop_couponable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('larashop_coupon_id')->constrained()->onDelete('cascade');
            $table->morphs('couponable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('larashop_couponable');
    }
}
