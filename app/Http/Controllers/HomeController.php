<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\LancamentoTemProduto;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $rel = DB::table('lancamento_tem_produtos')
        //     ->selectRaw('sum(abs(quantidade)) as total, produto_id as id, nome')
        //     ->leftJoin('produtos', 'produtos.id', '=', 'lancamento_tem_produtos.produto_id')
        //     ->where('quantidade', '<', '0')
        //     ->groupBy(['produto_id', 'produtos.nome'])
        //     ->orderByDesc('total')
        //     ->limit(6)
        //     ->get();

        $relVendas = Produto::whereHas('lancamentos', function ($qb) {
            return $qb->where('operacao', 'v');
        })->withSum('lancamentoTemProdutos as total', 'quantidade')
            ->limit(10)
            ->orderBy('total', 'desc')
            ->get();

        return view('home', compact('relVendas'));
    }
}
