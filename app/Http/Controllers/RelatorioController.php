<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\Produto as ProdutoResource;
use App\Http\Resources\Venda as VendaResource;
use App\Models\LancamentoTemProduto;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class RelatorioController extends Controller
{
    public function vendasDetalhado() {
        $vendas = Lancamento::where('operacao', 'v')->latest()->paginate(20);

        return view('relatorio.venda_detalhada', compact('vendas'));
    }

    public function vendasSimples() {
        $vendas = Lancamento::where('operacao', 'v')->latest()->paginate(20);

        return view('relatorio.venda_simples', compact('vendas'));
    }

    public function posicoes() {
        // $produtos = Produto::whereHas('lancamentos')
        // ->withCount([
        //     'lancamentoTemProdutos as vendas' => function (Builder $query) {
        //         $query->whereRelation('lancamento', 'operacao', 'v');
        //     },
        //     'lancamentoTemProdutos as entradas' => function (Builder $query) {
        //         $query->whereRelation('lancamento', 'operacao', 'e');
        //     },
        //     'lancamentoTemProdutos as saidas' => function (Builder $query) {
        //         $query->whereRelation('lancamento', 'operacao', 's');
        //     },
        // ]);

        // Lancamento::withCount([
        //     'quantidade AS vendas' => function ($query) {
        //         $query->select(DB::raw("SUM(quantidade) as vendas"))->where('operacao', 'v');
        //     }
        // ]);

        // $produtos = Produto::select(
        //     "id",
        //     "nome",
        //     DB::raw("SUM(lancamento_tem_produtos) as vendas"),
        // )
        //     ->groupBy("categoria_id")
        //     ->get();

        $produtos = Produto::withSum(
            'lancamentoTemProdutos as vendas',
            'quantidade'
        )->get();

        dd($produtos);

        return view('relatorio.posicao_estoque', compact('produtos'));
    }
}
