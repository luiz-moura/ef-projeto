<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\Produto as ProdutoResource;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('venda.index');
    }

    public function findClienteByCpfOrCnpj(Request $request)
    {
        $cliente = Pessoa::tipo('c')
            ->where('cpf_cnpj', $request->input('cpf_cnpj'))
            ->firstOrFail();

        return new ClienteResource($cliente);
    }

    public function findProdutoByNome(Request $request)
    {
        $nome = $request->input('nome');
        $produtos = Produto::where('nome', 'ilike', "%$nome%")->paginate(10);

        return ProdutoResource::collection($produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function show(Lancamento $lancamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Lancamento $lancamento)
    {
        //
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
        //
    }
}
