<?php

namespace App\Http\Controllers;
use App\Models\CustoVariavel;

use Illuminate\Http\Request;

class custoVariavelController extends Controller
{
   public function create(){

        return view('createCustoVariavel');
    }

    public function insert(Request $request){

        $dados = new CustoVariavel([
            'descricao'=>$request->descricao,
            'valor'=>$request->valor,
        ]);
            $dados->save();
          return redirect()->route('indexParam');
    }

    public function delete($id){
        $item = CustoVariavel::find($id);
        $item->delete();
       return redirect()->route('indexParam');
       
  }
    
}
