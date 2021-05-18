<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLarashopSocialsTable extends Migration
{
    public function up()
    {
        Schema::create('larashop_socials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url');
            $table->string('icon_name'); // ion-icons name
            $table->string('icon_color')->default('text-gray-500'); // Tailwindcss color class name
        });
    }

    public function down()
    {
        Schema::dropIfExists('larashop_socials');
    }
}
