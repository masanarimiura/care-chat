<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name', 100);
            $table->bigInteger('shop_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->string('email', 256);
            $table->tinyInteger('number')->unsigned();
            $table->string('password', 256);
            $table->foreign('relation_id')
                    ->references('id')
                    ->on('relations')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
