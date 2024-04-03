<?php
namespace App\Http\Controllers;

use DB;
use App\Models\Produto;
use App\Models\Ingrediente;
use App\Models\Item;


use Illuminate\Http\Request;

class itemController extends Controller
{
    
   public function index(Request $request){

      $psq=$request->selectLanche;
     
      
    $lanches = Produto::orderBy('descricao')->get();

   /* $acessorios = DB::select('SELECT ita.qtd as qtd_itens,ace.*,pr.*,pr.descricao as desc_prod, ace.descricao as ace_descricao
     FROM itens_acessorios ita, acessorios ace, produtos pr 
    WHERE ace.id=ita.id_acessorio and ita.id_produto=pr.id');*/

    $acessorios = DB::table('itens_acessorios as ita')
    ->join('acessorios as ace', 'ace.id', '=', 'ita.id_acessorio')
    ->join('produtos as pr', 'pr.id', '=', 'ita.id_produto')
    ->select('ita.qtd as qtd_itens', 'ace.*', 'pr.*', 'pr.descricao as desc_prod', 'pr.id as idProd', 'ace.descricao as ace_descricao')
    ->get();


   /* $ingredientes = DB::select('select ig.*,ig.descricao as ing_descricao, ig.unidMedida,pr.*,
     pr.descricao as desc_prod,it.*
    FROM itens it, ingredientes ig, produtos pr
    WHERE ig.id=it.id_ingrediente and pr.id=it.id_produto ');*/

    $ingredientes = DB::table('itens as it')
    ->join('ingredientes as ig', 'ig.id', '=', 'it.id_ingrediente')
    ->join('produtos as pr', 'pr.id', '=', 'it.id_produto')
    ->select('ig.*', 'ig.descricao as ing_descricao', 'ig.unidMedida', 'pr.*', 'pr.descricao as desc_prod', 'it.*')
    ->get();


return view('viewLanches',compact('ingredientes','lanches','psq','acessorios'));

   }

   public function create($id){
     $itens = DB::select('SELECT it.*, it.id as id_item, ing.*
       FROM itens it, ingredientes ing WHERE it.id_ingrediente = ing.id and it.id_produto = ?',[$id]);
         $produto = Produto::find($id);
         $ingredientes = Ingrediente::orderBy('descricao')->get();
       //  dd($itens);
      return view('cadItem',compact('produto','ingredientes','itens'));
   }

      public function insert(Request $request){

         $dados = new Item([
            'id_ingrediente'=>$request->ingredientes,
            'id_produto'=>$request->produto,
            'qtd'=>$request->qtd,
            'qtdOleoFritadeira'=>$request->qtdOleoFritadeira,
            'qtdPorcaoFritadeira'=>$request->qtdPorcaoFritadeira
        ]);

            $dados->save();
            return $this->create($request->produto);
      }

      public function delete(Request $request, $id,$id_produto){

        
            $item = Item::find($id);
            $item->delete();
            return $this->create($id_produto);

      }
   
 
}
