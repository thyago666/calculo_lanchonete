<?php

namespace App\Http\Controllers;
use App\Models\CustoFixo;

use Illuminate\Http\Request;

class custoFixoController extends Controller
{
    public function create(){
      return view('createCustoFixo');
    }

    public function insert(Request $request){

        $dados = new CustoFixo([
            'descricao'=>$request->descricao,
            'valor'=>$request->valor,
        ]);
            $dados->save();
            return redirect()->route('indexParam');
    }

    public function delete($id){
        $item = CustoFixo::find($id);
        $item->delete();
      return redirect()->route('indexParam');
       
  }
    
}
