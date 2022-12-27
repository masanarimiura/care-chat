<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPatientsTable extends Migration
{
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('relation-type_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
            $table->foreign('client_id')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');
            $table->foreign('patient_id')
                    ->references('id')
                    ->on('patients')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('relations');
    }
}
