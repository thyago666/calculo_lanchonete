<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;

use Illuminate\Http\Request;

class ingredienteController extends Controller
{
    public function index(){

       $ingredientes = Ingrediente::orderBy('descricao')->get();
      return view('viewIngrediente',compact('ingredientes'));

      

    }


    public function create(){
     return view('cadIngredienteView');

    }

    public function update($id, Request $request){

        $ingredientes=Ingrediente::find($id);
        $ingredientes->descricao = $request->descricao;
        $ingredientes->descricaoSimples = $request->descricaoSimples;
        $ingredientes->unidMedida = $request->unidade_medida;
        $ingredientes->save();

       return redirect('/ingrediente');

        //

    }

    public function edit($id){

        $ingredientes=Ingrediente::where('id',$id)->first();

        return view('editIngredienteView',compact('ingredientes'));

    }

    public function insert(Request $request){

        $verifica = Ingrediente::where('descricao',$request->descricao)->get();
      
        if($verifica->count()){
         return 'Ingrediente já cadastrado';
        }

        else
        {
     $dados = new Ingrediente([

            'descricao'=>$request->descricao,
            'descricaoSimples'=>$request->descricaoSimples,
            'unidMedida'=>$request->unidade_medida,
            'valor'=>'0.00',
            'qtd_porcao'=>$request->qtdField,
            'tipo'=>$request->tp
        ]);
            $dados->save();
     $ingredientes = Ingrediente::orderBy('descricao');
     return view('viewIngrediente',compact('ingredientes'));
   }
}
}
