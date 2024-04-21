<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Models\Faturamento;
use App\Models\Item;
use DB;
use Illuminate\Http\Request;

class LanchesRepository
{
    public function obterDados(Request $request)
    {
        $psq=$request->selectLanche;
        $lanches = Produto::orderBy('descricao')->get();
        $acessorios = DB::table('itens_acessorios as ita')
        ->join('acessorios as ace', 'ace.id', '=', 'ita.id_acessorio')
        ->join('produtos as pr', 'pr.id', '=', 'ita.id_produto')
        ->select('ita.qtd as qtd_itens', 'ace.*', 'pr.*', 'pr.descricao as desc_prod', 'pr.id as idProd', 'ace.descricao as ace_descricao')
        ->get();
        
        $ingredientes = DB::table('itens as it')
        ->join('ingredientes as ig', 'ig.id', '=', 'it.id_ingrediente')
        ->join('produtos as pr', 'pr.id', '=', 'it.id_produto')
        ->select('ig.*', 'ig.descricao as ing_descricao', 'ig.unidMedida', 'pr.*','pr.id as id_produto', 'pr.descricao as desc_prod', 'it.*')
        ->get();

           
       return ([$psq,$lanches,$acessorios,$ingredientes]);
    }
}
