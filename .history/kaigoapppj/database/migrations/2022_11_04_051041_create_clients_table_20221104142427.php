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
            $table->string('email', 100);


            $table->string('name', 100);
            $table->integer('age');
            $table->string('nationality', 100);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamps();
            
            
            
            $table->bigInteger('genre_id')->unsigned();
            $table->string('comment',256);
            $table->string('image_url',3000);
            $table->foreign('area_id')
                    ->references('id')
                    ->on('areas')
                    ->onDelete('cascade');
            $table->foreign('genre_id')
                    ->references('id')
                    ->on('genres')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
