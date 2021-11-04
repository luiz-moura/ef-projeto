<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\Produto as ProdutoResource;
use App\Http\Resources\Venda as VendaResource;

class RelatorioController extends Controller
{
    public function vendas() {
        $vendas = Lancamento::where('operacao', 'v')->latest()->paginate(20);

        return view('relatorio.venda', compact('vendas'));
    }

    public function posicoes() {
        $produtos = Lancamento::where('operacao', 'v')->latest()->paginate(20);

        return view('relatorio.posicao_estoque', compact('produtos'));
    }
}
