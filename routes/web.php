<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/lanches', [lancheController::class, 'calculo']);

//Route::get('/lanches', 'lancheController@calculo');

Route::get('/ingrediente', [App\Http\Controllers\ingredienteController::class, 'index']);
Route::get('/cadastro/ingrediente', [App\Http\Controllers\ingredienteController::class, 'create']);
Route::post('/insert/ingrediente', [App\Http\Controllers\ingredienteController::class, 'insert']);
Route::get('/edit/ingrediente/{id}', [App\Http\Controllers\ingredienteController::class, 'edit']);
Route::get('/delete/ingrediente/{id}', [App\Http\Controllers\ingredienteController::class, 'delete']);
Route::post('/update/ingrediente/{id}', [App\Http\Controllers\ingredienteController::class, 'update']);

Route::get('/lanches', [App\Http\Controllers\itemController::class, 'index']);
Route::any('/pesquisa', [App\Http\Controllers\itemController::class, 'index']);
Route::get('/historico', [App\Http\Controllers\itemController::class, 'historicoProduto']);
Route::any('/historico/pesquisa', [App\Http\Controllers\itemController::class, 'historicoProduto']);
Route::get('/cadastro/item/{id}', [App\Http\Controllers\itemController::class, 'create']);
Route::post('/insert/item/', [App\Http\Controllers\itemController::class, 'insert']);
Route::get('/delete/item/{id}/{id_produto}', [App\Http\Controllers\itemController::class, 'delete']);

Route::get('/acessorios', [App\Http\Controllers\acessorioController::class, 'index']);
Route::get('/cadastro/acessorios/', [App\Http\Controllers\acessorioController::class, 'create']);
Route::post('/insert/acessorios', [App\Http\Controllers\acessorioController::class, 'insert']);
Route::get('/edit/acessorios/{id}', [App\Http\Controllers\acessorioController::class, 'edit']);
Route::get('/delete/acessorios/{id}', [App\Http\Controllers\acessorioController::class, 'delete']);
Route::post('/update/acessorios/{id}', [App\Http\Controllers\acessorioController::class, 'update']);

Route::get('/entrada', [App\Http\Controllers\entradaController::class, 'index']);
Route::post('/cadastro/entrada', [App\Http\Controllers\entradaController::class, 'insert']);
Route::post('/pesquisa/entrada', [App\Http\Controllers\entradaController::class, 'pesquisa']);

Route::get('/produtos', [App\Http\Controllers\produtoController::class, 'index']);
Route::get('/cadastro/produtos', [App\Http\Controllers\produtoController::class, 'create']);
Route::post('/insert/produtos', [App\Http\Controllers\produtoController::class, 'insert']);
Route::get('/alterar/produto/{id_produto}', [App\Http\Controllers\produtoController::class, 'alterar']);
Route::post('/update/produto/', [App\Http\Controllers\produtoController::class, 'update']);
Route::get('/excluir/produto/{id_produto}', [App\Http\Controllers\produtoController::class, 'delete']);
Route::get('/cardapio', [App\Http\Controllers\produtoController::class, 'cardapio'])->name('cardapio');

Route::get('/cadastro/item-acessorio/{id}', [App\Http\Controllers\itemAcessorioController::class, 'create']);
Route::post('/insert/item-acessorio/', [App\Http\Controllers\itemAcessorioController::class, 'insert']);
Route::get('/delete/item-acessorio/{id}/{id_produto}', [App\Http\Controllers\itemAcessorioController::class, 'delete']);
Route::post('/insert/importacao/', [App\Http\Controllers\itemAcessorioController::class, 'insertImportacao']);


Route::get('/entrada-acessorio', [App\Http\Controllers\entradaAcessorioController::class, 'index']);
Route::post('/cadastro/entrada-acessorio', [App\Http\Controllers\entradaAcessorioController::class, 'insert']);
Route::post('/pesquisa/entrada-acessorio', [App\Http\Controllers\entradaAcessorioController::class, 'pesquisa']);

Route::get('/lancamento', [App\Http\Controllers\lancamentoController::class,'index']);
Route::post('/pesquisa/lancamento', [App\Http\Controllers\lancamentoController::class,'show']);
Route::post('/cadastro/lancamento', [App\Http\Controllers\lancamentoController::class,'store']);

//Route::get('/config', [App\Http\Controllers\custoFixoController::class,'index'])->name('indexCusto');
Route::get('/create/config', [App\Http\Controllers\custoFixoController::class,'create']);
Route::post('/insert/config', [App\Http\Controllers\custoFixoController::class,'insert']);
Route::get('/delete/config/{id}', [App\Http\Controllers\custoFixoController::class,'delete']);

Route::get('/create/var/config', [App\Http\Controllers\custoVariavelController::class,'create']);
Route::post('/insert/var/config', [App\Http\Controllers\custoVariavelController::class,'insert']);
Route::get('/delete/var/config/{id}', [App\Http\Controllers\custoVariavelController::class,'delete']);

Route::get('/create/fat/config', [App\Http\Controllers\faturamentoController::class,'create']);
Route::post('/insert/fat/config', [App\Http\Controllers\faturamentoController::class,'insert']);
Route::get('/alterar/fat/config/{id}', [App\Http\Controllers\faturamentoController::class,'alterar']);
Route::post('/update/fat/config/{id}', [App\Http\Controllers\faturamentoController::class,'update']);
Route::get('fat/config/', [App\Http\Controllers\faturamentoController::class,'index'])->name('indexFaturamento');

Route::get('/create/ifood/config', [App\Http\Controllers\ifoodController::class,'create']);
Route::post('/insert/ifood/config', [App\Http\Controllers\ifoodController::class,'insert']);
Route::get('/delete/ifood/config/{id}', [App\Http\Controllers\ifoodController::class,'delete']);
Route::get('/alterar/ifood/config/{id}', [App\Http\Controllers\ifoodController::class,'alterar']);
Route::post('/update/ifood/config/{id}', [App\Http\Controllers\ifoodController::class,'update']);

Route::get('/create/iqfome/config', [App\Http\Controllers\iqfomeController::class,'create']);
Route::post('/insert/iqfome/config', [App\Http\Controllers\iqfomeController::class,'insert']);
Route::get('/delete/iqfome/config/{id}', [App\Http\Controllers\iqfomeController::class,'delete']);
Route::get('/alterar/iqfome/config/{id}', [App\Http\Controllers\iqfomeController::class,'alterar']);
Route::post('/update/iqfome/config/{id}', [App\Http\Controllers\iqfomeController::class,'update']);

Route::get('/alterar/param/config/{id}', [App\Http\Controllers\parametrosController::class,'alterar']);
Route::get('/param/config/', [App\Http\Controllers\parametrosController::class,'index'])->name('indexParam');
Route::post('/update/param/config/{id}', [App\Http\Controllers\parametrosController::class,'update']);