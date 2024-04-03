<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensAcessoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_acessorios', function (Blueprint $table) {
            $table->id();
            $table->integer('id_acessorio')->unsigned();

            $table->foreign('id_acessorio')->references('id')->on('acessorios');
          
            $table->integer('id_produto')->unsigned();
            $table->foreign('id_produto')->references('id')->on('produtos');
    
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
        Schema::dropIfExists('itens_acessorios');
    }
}
