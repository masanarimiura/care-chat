<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerCasesTable extends Migration
{
    public function up()
    {
        Schema::create('worker_cases', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('case_id')->unsigned();
            $table->foreign('worker_id')
                    ->references('id')
                    ->on('workers')
                    ->onDelete('cascade');
            $table->foreign('case_id')
                    ->references('id')
                    ->on('cases')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('worker_cases');
    }
}
