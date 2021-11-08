<?php

namespace App\Http\Controllers;

use App\Http\Filters\LancamentoFilter;
use App\Models\Lancamento;
use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class RelatorioController extends Controller
{
    public function vendasDetalhada(LancamentoFilter $filter, Request $request) {
        $empresas = Pessoa::tipo('e')->latest()->get();

        $vendas = Lancamento::filter($filter)
            ->where('operacao', 'v')
            ->get();

        return view('relatorio.venda_detalhada', compact('vendas', 'empresas'), ['query' => $request->query()]);
    }

    public function vendasSimples(LancamentoFilter $filter, Request $request) {
        $empresas = Pessoa::tipo('e')->latest()->get();

        $vendas = Lancamento::filter($filter)
            ->where('operacao', 'v')
            ->get();

        return view('relatorio.venda_simples', compact('vendas', 'empresas'), ['query' => $request->query()]);
    }

    public function posicoes() {
        $empresas = Pessoa::tipo('e')->get();

        $produtosPorEmpresa = [];

        $i = 0;
        foreach ($empresas as $empresa) {
            $produtos = Produto::withSum(
                ['lancamentoTemProdutos as saidas' => function($query) {
                    $query->whereRelation('lancamento', 'operacao', 'v')
                        ->whereRelation('lancamento', 'empresa_id', 26);
                }],
                'quantidade'
            )
            ->withSum(
                ['lancamentoTemProdutos as entradas' => function($query) {
                    $query->whereRelation('lancamento', 'operacao', 'e')
                        ->whereRelation('lancamento', 'empresa_id', 26);
                }],
                'quantidade'
            )
            ->get();

            $produtosPorEmpresa[] = ['empresa' => $empresas[$i], 'produtos' => $produtos];

            $i++;
        }

        $produtosPorEmpresa = collect($produtosPorEmpresa);

        return view('relatorio.posicao_estoque', compact('produtosPorEmpresa'));
    }
}
