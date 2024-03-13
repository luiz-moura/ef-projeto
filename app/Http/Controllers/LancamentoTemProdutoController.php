<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLancamentoTemProdutoRequest;
use App\Models\LancamentoTemProduto;

class LancamentoTemProdutoController extends Controller
{
    public function edit(LancamentoTemProduto $lancamentoTemProduto)
    {
        return view('lancamentotemproduto.edit', compact('lancamentoTemProduto'));
    }

    public function update(
        StoreLancamentoTemProdutoRequest $request,
        LancamentoTemProduto $lancamentoTemProduto
    )
    {
        $validatedRequest = $request->validated();
        $lancamentoTemProduto->update($validatedRequest);

        return redirect()->route('lancamentos.edit', $lancamentoTemProduto->lancamento_id)
            ->with('success', 'Produto do lançamento atualizado com sucesso.');
    }

    public function destroy(LancamentoTemProduto $lancamentoTemProduto)
    {
        $lancamentoTemProduto->delete();

        return redirect()->route('lancamentos.edit', $lancamentoTemProduto->lancamento_id)
            ->with('success', 'Produto do lançamento deletado com sucesso');
    }
}
