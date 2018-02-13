<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePivotEntradaTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entrada_id');
            $table->unsignedInteger('tag_id');

            $table->foreign('entrada_id')->references('id')->on('entradas')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('tag_id')->references('id')->on('tags')->onUpdate('cascade')->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrada_tag');
    }
}
