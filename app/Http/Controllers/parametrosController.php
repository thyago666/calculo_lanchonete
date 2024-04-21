<?php

namespace App\Http\Controllers;
use App\Models\Parametros;
use App\Repositories\ParametrosRepository;
use Illuminate\Http\Request;

class parametrosController extends Controller
{
    
    
    protected $parametrosRepository;

    public function __construct(ParametrosRepository $parametrosRepository)
    {
        $this->parametrosRepository = $parametrosRepository;
    }

    public function index(){

       $dados[]= $this->parametrosRepository->parametros();
       $custoFixo = $dados[0][0];
       $custoVariavel = $dados[0][1];
       $faturamento = $dados[0][2];
       $markup = $dados[0][3];
       $ifood = $dados[0][4];
       $iqfome = $dados[0][5];
       $markupIfood = $dados[0][6];
       $markupIqfome = $dados[0][7];
       $parametros = $dados[0][8];
    
        return view('cadParametros',compact('custoFixo','custoVariavel','faturamento','markup','ifood','iqfome','parametros','markupIfood','markupIqfome'));
    }
    
    
    public function alterar($id){
        return view('editParametro',compact('id'));
    }

    public function update($id,Request $request){
        $parametros=Parametros::find($id);
        $parametros->opcao = $request->status;
        $parametros->save();
       // return redirect()->route('indexFaturamento');
       return $this->index();
       }
}
