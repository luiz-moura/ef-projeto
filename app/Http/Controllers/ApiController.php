<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\Cliente as ClienteResource;
use App\Http\Resources\Empresa as EmpresaResource;
use App\Http\Resources\Pessoa as PessoaResource;
use App\Http\Resources\Produto as ProdutoResource;

class ApiController extends Controller
{
    public function findClienteByCpfOrCnpj(string $cpfCnpj)
    {
        $cliente = Pessoa::tipo('c')
            ->where('cpf_cnpj', $cpfCnpj)
            ->firstOrFail();

        return ClienteResource::make($cliente);
    }

    public function findProdutoByNome(Request $request)
    {
        $nome = $request->query('search');

        $produtos = Produto::where('nome', 'ilike', "%$nome%")
            ->orWhere('codigo_barras', $nome)
            ->paginate(10);

        return ProdutoResource::collection($produtos);
    }

    public function findClienteByNome(Request $request)
    {
        $nome = $request->query('nome');

        $clientes = Pessoa::tipo('c')
            ->where('nome', 'ilike', "%$nome%")
            ->orWhere('cpf_cnpj', 'ilike', "%$nome%")
            ->paginate(10);

        return ClienteResource::collection($clientes);
    }

    public function findEmpresaByNome(Request $request)
    {
        $nome = $request->query('search');

        $clientes = Pessoa::tipo('e')
            ->where('nome', 'ilike', "%$nome%")
            ->orWhere('cpf_cnpj', 'ilike', "%$nome%")
            ->paginate(10);

        return EmpresaResource::collection($clientes);
    }

    public function findPessoaByNome(Request $request)
    {
        $nome = $request->query('search');

        $qb = Pessoa::query();

        if ($request->filled('operacao')) {
            $tipo = match($request->query('operacao')) {
                'e' => 'u',
                's' => 'c',
                'v' => 'c',
            };

            $qb->tipo($tipo);
        }

        $clientes = $qb->where('nome', 'ilike', "%$nome%")
            ->orWhere('cpf_cnpj', 'ilike', "%$nome%")
            ->paginate(10);

        return PessoaResource::collection($clientes);
    }
}
