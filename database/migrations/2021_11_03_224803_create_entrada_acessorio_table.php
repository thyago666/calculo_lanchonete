<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradaAcessorioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrada_acessorio', function (Blueprint $table) {
            $table->id();
            $table->integer('id_acessorio')->unsigned();
            $table->foreign('id_acessorio')->references('id')->on('acessorios');
            $table->float('valor_total');
            $table->integer('qtd');
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
        Schema::dropIfExists('entrada_acessorio');
    }
}
