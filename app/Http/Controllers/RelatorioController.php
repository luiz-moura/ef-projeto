<?php

namespace App\Http\Controllers;

use App\Http\Filters\LancamentoFilter;
use App\Models\Lancamento;
use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;
use PDF;

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

        $query = $filter->request->query();

        return view('relatorio.venda_simples', compact('vendas', 'empresas', 'query'));
    }

    public function vendasSimplesPDF(LancamentoFilter $filter) {
        $vendas = Lancamento::filter($filter)
            ->where('operacao', 'v')
            ->get();

        $pdf = PDF::loadView('relatorio.venda_simples_pdf', compact('vendas'));

        return $pdf->stream();
    }

    public function vendasDetalhadaPDF(LancamentoFilter $filter) {
        $vendas = Lancamento::filter($filter)
            ->where('operacao', 'v')
            ->get();

        $pdf = PDF::loadView('relatorio.venda_detalhada_pdf', compact('vendas'));

        return $pdf->stream();
    }

    public function posicoes() {
        $empresas = Pessoa::tipo('e')->get();

        $res = [];
        foreach ($empresas as $empresa) {
            $produtos = Produto::withSum(
                ['lancamentoTemProdutos as saidas' => function($query) use ($empresa) {
                    $query->whereRelation('lancamento', 'operacao', 'v')
                        ->whereRelation('lancamento', 'empresa_id', $empresa->contextos()->where('tipo', 'e')->first()->id);
                }],
                'quantidade'
            )
            ->withSum(
                ['lancamentoTemProdutos as entradas' => function($query) use ($empresa) {
                    $query->whereRelation('lancamento', 'operacao', 'e')
                        ->whereRelation('lancamento', 'empresa_id', $empresa->contextos()->where('tipo', 'e')->first()->id);
                }],
                'quantidade'
            )
            ->get();

            $res[] = [
                'nome' => $empresa->nome,
                'produtos' => $produtos
            ] ;
        }

        return view('relatorio.posicao_estoque')->with('empresas', $res);
    }
}
