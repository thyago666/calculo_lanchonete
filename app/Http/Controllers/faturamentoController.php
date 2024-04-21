<?php

namespace App\Http\Controllers;
use App\Models\Faturamento;
use Illuminate\Http\Request;
use App\Repositories\ParametrosRepository;

class faturamentoController extends Controller
{
    protected $parametrosRepository;

    public function __construct(ParametrosRepository $parametrosRepository)
    {
        $this->parametrosRepository = $parametrosRepository;
    }

   /* public function index(){

       $dados[]= $this->parametrosRepository->parametros();
       $custoFixo = $dados[0][0];
       $custoVariavel = $dados[0][1];
       $faturamento = $dados[0][2];
       $markup = $dados[0][3];
       $ifood = $dados[0][4];
       $iqfome = $dados[0][5];
       $parametros = $dados[0][8];
    
        return view('cadParametros',compact('custoFixo','custoVariavel','faturamento','markup','ifood','iqfome','parametros'));
    }*/

    public function create(){

        return view('createFaturamento');
    }

    public function insert(Request $request){

        $dados = new Faturamento([
            'lucro'=>$request->lucro,
            'valor'=>$request->valor,
            'markup'=>0,
        ]);
            $dados->save();
            return redirect()->route('indexParam');
    }

    public function alterar($id){
        $item = Faturamento::find($id);
        return view('editFaturamento',compact('item'));
       
  }

  public function update($id, Request $request){

    $faturamento=Faturamento::find($id);
    $faturamento->valor = $request->valor;
    $faturamento->lucro = $request->lucro;
    $faturamento->save();
    return redirect()->route('indexParam');
  }

          
}
