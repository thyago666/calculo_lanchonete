<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Item;
use DB;

class produtoController extends Controller
{
    public function index(){

        $produtos = Produto::orderBy('descricao')->get();

        return view('produtosView',compact('produtos'));

    }

    public function create(){

        return view('cadProdutos');

    }

    public function insert(Request $request){

        $dados = new Produto([

            'descricao'=>$request->descricao,
            'tipo'=>$request->tipo,
        ]);
            $dados->save();

            $produtos = Produto::orderBy('descricao')->get();
            return view('produtosView',compact('produtos'));
    }

    public function alterar($id){

       $produto = Produto::find($id);
  
        return view('produtosAlterar',compact('produto'));


    }

    public function update(Request $request){
     
        $produto=Produto::find($request->id);
        $produto->descricao = $request->descricao;
        $produto->save();
        return $this->index();

    }

    public function delete($id){


        $produto = Produto::find($id);
        $item = Item::where('id_produto',$produto->id)->get();
 
        foreach($item as $itens){
        Item::where('id_produto',$itens->id_produto)->delete();
     }
        $produto->delete();
        return $this->index();
    }

    public function cardapio(){


       /* select ig.descricao as ing_descricao, ig.valor, ig.unidMedida, ig.qtd_porcao, 
        it.qtd, pr.descricao as desc_prod FROM itens it, ingredientes ig, produtos pr
         WHERE ig.id=it.id_ingrediente and pr.id=it.id_produto and pr.id = 1
         */

      /* $resultado = DB::table('itens as it')
    ->join('ingredientes as ig', 'ig.id', '=', 'it.id_ingrediente')
    ->join('produtos as pr', 'pr.id', '=', 'it.id_produto')
    ->select('ig.descricao as ing_descricao', 'ig.valor', 'ig.unidMedida', 'ig.qtd_porcao', 'it.qtd', 'pr.descricao as desc_prod')
     ->get();*/

     $countProdutos = Produto::all()->count();
  
     $resultado = DB::table('itens as it')
    ->join('ingredientes as ig', 'ig.id', '=', 'it.id_ingrediente')
    ->join('produtos as pr', 'pr.id', '=', 'it.id_produto')
    ->select('ig.descricao as ing_descricao', 'ig.valor', 'ig.unidMedida', 'ig.qtd_porcao','ig.descricaoSimples', 'it.qtd', 'pr.descricao as desc_prod', 'pr.id as idProd')
   ->orderBy('pr.descricao')
 
    ->get();

    $acessorios = DB::table('itens_acessorios as ita')
    ->join('acessorios as ace', 'ace.id', '=', 'ita.id_acessorio')
    ->join('produtos as pr', 'pr.id', '=', 'ita.id_produto')
    ->select('ita.qtd as qtd_itens', 'ace.*', 'pr.*', 'pr.descricao as desc_prod', 'pr.id as idProd', 'ace.descricao as ace_descricao')
    ->get();

      //  dd($resultado);
 
    return view('viewCardapio',compact('resultado','countProdutos','acessorios'));

    }
}

