<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cliente/{cpf_cnpj}', 'VendaController@findClienteByCpfOrCnpj');
Route::get('produtos', 'VendaController@findProdutoByNome');
Route::get('cliente', 'VendaController@findClienteByNome');
Route::get('empresas', 'VendaController@findEmpresaByNome');
Route::get('pessoas', 'VendaController@findPessoaByNome');

Route::post('venda/store/', 'VendaController@store');
Route::post('lancamentos/store/', 'LancamentoController@store');

