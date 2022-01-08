<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class LancamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lancamentos = Lancamento::latest()->paginate(20);

        return view('lancamento.index', compact('lancamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lancamento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lancamento = new Lancamento();
        $lancamento->operacao = $request->input('operacao');
        $lancamento->empresa_id = Pessoa::find($request->input('empresa_id'))->contextos()->where('tipo', 'e')->first()->id;

        $tipo = match($request->input('operacao')) {
            'e' => 'u',
            's' => 'c',
            'v' => 'c',
        };

        $lancamento->contexto_id = Pessoa::find($request->input('contexto_id'))->contextos()->where('tipo', $tipo)->first()->id;
        $lancamento->data_operacao = date('Y-m-d H:i:s');

        $lancamento->save();

        $produtos = [];
        foreach ($request->input('produtos') as $p) {
            $produtos[] = [
                "produto_id"        => $p['id'],
                "preco_unitario"    => $p['valor_venda'],
                "quantidade"        => $p['quantidade'],
            ];
        }

        $lancamento->lancamentoTemProdutos()->createMany($produtos);

        return [
          'ok' => 'sucesso'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function show(Lancamento $lancamento)
    {
        return view('lancamento.show', compact('lancamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Lancamento $lancamento)
    {
        return view('lancamento.edit', compact('lancamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lancamento $lancamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lancamento $lancamento)
    {
        $lancamento->delete();

        return redirect()->route('lancamentos.index')
            ->with('success', 'Lançamento excluído com sucesso');
    }
}
