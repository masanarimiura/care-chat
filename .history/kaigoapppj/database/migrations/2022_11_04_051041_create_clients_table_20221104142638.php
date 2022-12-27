<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('relation_id')->unsigned();
            $table->string('name', 100);
            $table->string('email', 256);
            $table->tinyInteger('number')->unsigned();
            $table->string('password', 256);
            $table->foreign('relation_id')
                    ->references('id')
                    ->on('areas')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
