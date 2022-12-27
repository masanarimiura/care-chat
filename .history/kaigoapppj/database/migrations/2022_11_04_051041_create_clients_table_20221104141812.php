<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->id();
$table->string('name', 100);
$table->integer('age');
$table->string('nationality', 100);
$table->timestamp('created_at')->useCurrent()->nullable();
$table->timestamp('updated_at')->useCurrent()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
