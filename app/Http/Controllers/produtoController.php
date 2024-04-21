<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Item;
use DB;
use App\Repositories\ParametrosRepository;

class produtoController extends Controller
{
    protected $parametrosRepository;

    public function __construct(ParametrosRepository $parametrosRepository)
    {
        $this->parametrosRepository = $parametrosRepository;
    }

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
            return redirect("/produtos");
    }

    public function alterar($id){
       $produto = Produto::find($id);
          return view('produtosAlterar',compact('produto'));
        }

    public function update(Request $request){
        $produto=Produto::find($request->id);
        $produto->descricao = $request->descricao;
        $produto->save();
        return redirect("/produtos");
    }

    public function delete($id){
        $produto = Produto::find($id);
        $item = Item::where('id_produto',$produto->id)->get();

        foreach($item as $itens){
        Item::where('id_produto',$itens->id_produto)->delete();
        }
        $produto->delete();
        return redirect("/produtos");
    }

    public function cardapio(){
        $dados[]= $this->parametrosRepository->parametros();
        $markup = $dados[0][3];
        $markupIfood = $dados[0][6];
        $markupIqfome = $dados[0][7];
  
     $countProdutos = Produto::all()->count();
     $resultado = DB::table('itens as it')
    ->join('ingredientes as ig', 'ig.id', '=', 'it.id_ingrediente')
    ->join('produtos as pr', 'pr.id', '=', 'it.id_produto')
    ->select('ig.descricao as ing_descricao', 'ig.valor', 'ig.unidMedida', 'ig.qtd_porcao','ig.descricaoSimples', 'it.qtd', 'pr.descricao as desc_prod', 'pr.id as idProd')
   ->orderBy('pr.descricao')->get();

    $acessorios = DB::table('itens_acessorios as ita')
    ->join('acessorios as ace', 'ace.id', '=', 'ita.id_acessorio')
    ->join('produtos as pr', 'pr.id', '=', 'ita.id_produto')
    ->select('ita.qtd as qtd_itens', 'ace.*', 'pr.*', 'pr.descricao as desc_prod', 'pr.id as idProd', 'ace.descricao as ace_descricao')
    ->get();
 
    return view('viewCardapio',compact('resultado','countProdutos','acessorios','markup','markupIfood','markupIqfome'));


    }
}

