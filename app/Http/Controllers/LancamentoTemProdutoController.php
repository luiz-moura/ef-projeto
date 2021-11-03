<?php

namespace App\Http\Controllers;

use App\Models\LancamentoTemProduto;
use Illuminate\Http\Request;

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
    public function update(Request $request, LancamentoTemProduto $lancamentoTemProduto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LancamentoTemProduto  $lancamentoTemProduto
     * @return \Illuminate\Http\Response
     */
    public function destroy(LancamentoTemProduto $lancamentoTemProduto)
    {
        //
    }
}
