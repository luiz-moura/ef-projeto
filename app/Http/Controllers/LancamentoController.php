<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    public function index()
    {
        $lancamentos = Lancamento::latest()->paginate(20);

        return view('lancamento.index', compact('lancamentos'));
    }

    public function create()
    {
        return view('lancamento.create');
    }

    public function store(Request $request)
    {
        /**
         * Busca o contexto da pessoa de acordo com a operacao
         * Ex: Operacao entrada ira buscar o contexto fornecedor da pessoa informada
         */
        $tipo = match($request->input('operacao')) {
            'e' => 'u',
            's' => 'c',
            'v' => 'c',
        };

        /**
         * Pessoa sem contexto para o tipo de lancamento
         * Ex: tipo de lancamento venda, pessoa apenas com contexto de funcionario (sem contexto de cliente)
         */
        $contexto_id = Pessoa::find($request->input('contexto_id'))->contextos()->where('tipo', $tipo)->first()?->id;
        if (is_null($contexto_id)) {
            return response(['error' => 'A pessoa não possui o contexto para este tipo de lançamento'], 400);
        }

        $lancamento = new Lancamento();
        $lancamento->operacao = $request->input('operacao');
        $lancamento->data_operacao = date('Y-m-d H:i:s');
        $lancamento->empresa_id = Pessoa::find($request->input('empresa_id'))->contextos()->where('tipo', 'e')->first()->id;
        $lancamento->contexto_id = Pessoa::find($request->input('contexto_id'))->contextos()->where('tipo', $tipo)->first()->id;
        $lancamento->save();

        /**
         * Registras os produtos do lancamento
         */
        $produtos = [];
        foreach ($request->input('produtos') as $p) {
            $produtos[] = [
                "produto_id"        => $p['id'],
                "preco_unitario"    => $p['valor_venda'],
                "quantidade"        => $p['quantidade'],
            ];
        }

        $lancamento->lancamentoTemProdutos()->createMany($produtos);

        /**
         * Atualiza ultimo preco de custo dos produtos
         */
        foreach ($produtos as $produto) {
            Produto::find($produto['produto_id'])->update(['ultimo_preco_custo' => $produto['preco_unitario']]);
        }

        return response(['ok' => 'sucesso'], 201);
    }

    public function show(Lancamento $lancamento)
    {
        return view('lancamento.show', compact('lancamento'));
    }

    public function edit(Lancamento $lancamento)
    {
        return view('lancamento.edit', compact('lancamento'));
    }

    public function destroy(Lancamento $lancamento)
    {
        $lancamento->delete();

        return redirect()->route('lancamentos.index')
            ->with('success', 'Lançamento excluído com sucesso');
    }
}
