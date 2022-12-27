<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPatientsTable extends Migration
{
    public function up()
    {
        Schema::create('client_cases', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('case_id')->unsigned();
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
            $table->foreign('case_id')
                    ->references('id')
                    ->on('cases')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_cases');
    }
}
