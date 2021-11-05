<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', 'HomeController@index')->name('home');

Route::resource('pessoas', 'PessoaController');
Route::resource('clientes', 'ClienteController');
Route::resource('funcionarios', 'FuncionarioController');
Route::resource('empresas', 'EmpresaController');
Route::resource('fornecedores', 'FornecedorController')
    ->parameters(['fornecedores' => 'fornecedor']);
Route::resource('categorias', 'CategoriaController');
Route::resource('produtos', 'ProdutoController');
Route::resource('lancamentos', 'LancamentoController');
Route::resource('lancamento-produtos', 'LancamentoTemProdutoController')
    ->parameters(['lancamento-produtos' => 'lancamentoTemProduto'])
    ->only(['index', 'show', 'edit', 'update', 'destroy']);

Route::get('vendas', 'VendaController@index')->name('vendas');

Route::get('relatorio-vendas-simples', 'RelatorioController@vendasSimples')->name('vendas-simples');
Route::get('relatorio-vendas-detalhado', 'RelatorioController@vendasDetalhado')->name('vendas-detalhado');

Route::get('relatorio-posicoes', 'RelatorioController@posicoes')->name('relatorio-posicoes');
