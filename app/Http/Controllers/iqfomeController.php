<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Iqfome;

class iqfomeController extends Controller
{
   

     public function create(){

        return view('createIqfome');
    }

    public function insert(Request $request){

        $dados = new Iqfome([
            'descricao'=>$request->descricao,
            'valor'=>$request->valor,
        ]);
            $dados->save();
           return redirect()->route('indexParam');
    }

    public function delete($id){
        $item = Iqfome::find($id);
        $item->delete();
       return redirect()->route('indexParam');
       
  }

  public function alterar($id){
    $item = Iqfome::find($id);
    return view('editIqfome',compact('item'));
   
}

  public function update($id, Request $request){

    $ifood=Iqfome::find($id);
    $ifood->descricao = $request->descricao;
    $ifood->valor = $request->valor;
    $ifood->save();
   return redirect()->route('indexParam');
  }
}
