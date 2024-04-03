<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acessorio;
use App\Models\ItemAcessorio;
use App\Models\Produto;
use DB;

class itemAcessorioController extends Controller
{
    public function index(Request $request){

        $psq=$request->selectLanche;
       
        
      $lanches = Produto::all();

   
  
      $dados = DB::select('select ace.*,ace.descricao as ace_descricao,pr.*, pr.descricao as desc_prod,it.*
      FROM itens_acessorios it, acessorios ace, produtos pr 
      WHERE ace.id=it.id_acessorio and pr.id=it.id_produto');
  
  return view('viewLanches',compact('dados','lanches','psq'));
  
     }
  
     public function create($id){
  
     /* $importar = DB::select('SELECT DISTINCT(pr.descricao), pr.id
      FROM itens_acessorios ia, produtos pr WHERE pr.id=ia.id_produto');*/

$importar = DB::table('itens_acessorios as ia')
->join('produtos as pr', 'pr.id', '=', 'ia.id_produto')
->select('pr.descricao', 'pr.id')
->distinct()
->get();

  
        /*$itens = DB::select('SELECT it.*, it.id as id_item, ace.*, ace.valor as vl_unit
         FROM itens_acessorios it, acessorios ace WHERE it.id_acessorio = ace.id and it.id_produto = ?',[$id]);*/
         
         $itens = DB::table('itens_acessorios as it')
         ->join('acessorios as ace', 'it.id_acessorio', '=', 'ace.id')
         ->select('it.*', 'it.id as id_item', 'ace.*', 'ace.valor as vl_unit')
         ->where('it.id_produto', $id)
         ->get();
     
         
         $produto = Produto::find($id);
           $acessorios = Acessorio::orderBy('descricao')->get(); 
        return view('cadItemAcessorio',compact('produto','acessorios','itens','importar'));
     }
  
        public function insert(Request $request){
   
           $dados = new ItemAcessorio([
                'id_acessorio'=>$request->acessorios,
              'id_produto'=>$request->produto,
              'qtd'=>$request->qtd
          ]);
              $dados->save();
             return $this->create($request->produto);
        }

        public function insertImportacao(Request $request){

   


         $id=$request->selectLanche;//id do lanche do campo select, que é referencia da importacao
         $id_produto=$request->produto;//id do produto que ira receber a importacao



         $dadosImportacao = DB::select('SELECT i.* 
         FROM itens_acessorios i WHERE i.id_produto = ?',[$id]);

       
       
         //$dadosImportacao = ItemAcessorio::where('id_produto','$id')->get();
           
         foreach($dadosImportacao as $dadosImportacoes)
         {
         $dados = new ItemAcessorio([
              'id_acessorio'=>$dadosImportacoes->id_acessorio,
            'id_produto'=>$id_produto,
            'qtd'=>$dadosImportacoes->qtd
        ]);
            $dados->save();
      }



           return $this->create($id_produto);
      }
  
        public function delete(Request $request, $id,$id_produto){
  
          
              $item = ItemAcessorio::find($id);
              $item->delete();
              return $this->create($id_produto);
  
        }
     
}
