<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acessorio;
use App\Models\EntradaAcessorio;
use DB;

class entradaAcessorioController extends Controller
{
    public function index(){
        $acessorios = Acessorio::all();
         return view('cadEntradaAcessorioView',compact('acessorios'));
     }
  
      public function pesquisa(Request $request){
          $acessorios = Acessorio::all();
           $data_inicial = $request->dt_inicial;
           $data_final = $request->dt_final;
          
         /* $psq = DB::select("SELECT ent.valor_total as valor,
          ent.created_at as data_compra, ace.descricao as descricao, ace.id as id
           FROM acessorios ace, entrada_acessorio ent 
          WHERE ent.id_acessorio = ace.id AND DATE(ent.created_at) BETWEEN '$data_inicial' 
          AND '$data_final'");*/

          $psq = DB::table('entrada_acessorio as ent')
    ->join('acessorios as ace', 'ent.id_acessorio', '=', 'ace.id')
    ->select('ent.valor_total as valor', 'ent.created_at as data_compra', 'ace.descricao', 'ace.id')
    ->whereBetween(DB::raw('DATE(ent.created_at)'), [$data_inicial, $data_final])
    ->get();
  
          return view('cadEntradaAcessorioView',compact('psq','acessorios'));
          
  
          
      }
  
      public function insert(Request $request){
  
          $dados = new EntradaAcessorio([
  
              'id_acessorio'=>$request->acessorios,
              'qtd'=>$request->qtd,
              'valor_total'=>$request->valor_total,
          ]);
              $dados->save();

              $vl_unitario = ($request->valor_total/$request->qtd);
  
              $acessorios=Acessorio::find($request->acessorios);
          $acessorios->valor = $vl_unitario;
            $acessorios->save();
            return view("welcome");
     
  
  
      }
}
