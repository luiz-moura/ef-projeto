<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\Produto as ProdutoResource;
use App\Http\Resources\Venda as VendaResource;

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

    public function findClienteByCpfOrCnpj(string $cpfCnpj)
    {
        $cliente = Pessoa::tipo('c')
            ->where('cpf_cnpj', $cpfCnpj)
            ->firstOrFail();

        return new ClienteResource($cliente);
    }

    public function findProdutoByNome(Request $request)
    {
        $nome = $request->input('nome');
        $produtos = Produto::where('nome', 'ilike', "%$nome%")
            ->orWhere('codigo_barras', $nome)
            ->paginate(10);

        return ProdutoResource::collection($produtos);
    }

    public function findClienteByNome(Request $request)
    {
        $nome = $request->input('nome');
        $clientes = Pessoa::tipo('c')
            ->where('nome', 'ilike', "%$nome%")
            ->orWhere('cpf_cnpj', 'ilike', "%$nome%")
            ->paginate();

        return ClienteResource::collection($clientes);
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
        $lancamento->operacao = 'v';
        $lancamento->empresa_id = $request->input('empresa_id');
        $lancamento->contexto_id = $request->input('contexto_id');
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

        return new VendaResource($lancamento);
    }
}
