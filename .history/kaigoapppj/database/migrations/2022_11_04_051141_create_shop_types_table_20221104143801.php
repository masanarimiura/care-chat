<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopTypesTable extends Migration
{
    public function up()
    {
        Schema::create('shop_types', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('shop_type', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('shop_types');
    }
}
