<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLancamentoTemProdutoRequest;
use App\Models\LancamentoTemProduto;

class LancamentoTemProdutoController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LancamentoTemProduto  $lancamentoTemProduto
     * @return \Illuminate\Http\Response
     */
    public function edit(LancamentoTemProduto $lancamentoTemProduto)
    {
        return view('lancamentotemproduto.edit', compact('lancamentoTemProduto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LancamentoTemProduto  $lancamentoTemProduto
     * @return \Illuminate\Http\Response
     */
    public function update(StoreLancamentoTemProdutoRequest $request, LancamentoTemProduto $lancamentoTemProduto)
    {
        $request->validated();

        $lancamentoTemProduto->update($request->all());

        return redirect()->route('lancamentos.edit', $lancamentoTemProduto->lancamento_id)
            ->with('success', 'Produto do lançamento atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LancamentoTemProduto  $lancamentoTemProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(LancamentoTemProduto $lancamentoTemProduto)
    {
        $lancamentoTemProduto->delete();

        return redirect()->route('lancamentos.edit', $lancamentoTemProduto->lancamento_id)
            ->with('success', 'Produto do lançamento deletado com sucesso');
    }
}
