<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ifood;

class ifoodController extends Controller
{
     public function create(){
        return view('createIfood');
    }

    public function insert(Request $request){
        $dados = new Ifood([
            'descricao'=>$request->descricao,
            'valor'=>$request->valor,
        ]);
            $dados->save();
           return redirect()->route('indexParam');
    }

    public function delete($id){
        $item = Ifood::find($id);
        $item->delete();
       return redirect()->route('indexParam');
       
  }

  public function alterar($id){
    $item = Ifood::find($id);
    return view('editIfood',compact('item'));
 }

  public function update($id, Request $request){
    $ifood=Ifood::find($id);
    $ifood->descricao = $request->descricao;
    $ifood->valor = $request->valor;
    $ifood->save();
   return redirect()->route('indexParam');
  }


}
