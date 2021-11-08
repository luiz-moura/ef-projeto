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

Route::get('produtos', 'ApiController@findProdutoByNome');
Route::get('cliente/{cpf_cnpj}', 'ApiController@findClienteByCpfOrCnpj');
Route::get('cliente', 'ApiController@findClienteByNome');
Route::get('empresas', 'ApiController@findEmpresaByNome');
Route::get('pessoas', 'ApiController@findPessoaByNome');

Route::post('venda/store/', 'VendaController@store');
Route::post('lancamentos/store/', 'LancamentoController@store');
