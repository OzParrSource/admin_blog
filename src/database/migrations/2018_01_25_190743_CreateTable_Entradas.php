<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEntradas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('descripcion')->nullable();
            $table->string('img')->nullable();
            $table->text('contenido')->nullable();
            $table->enum('status',['published','!published']);
            $table->string('slug')->unique();
            $table->unsignedInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas');
    }
}
