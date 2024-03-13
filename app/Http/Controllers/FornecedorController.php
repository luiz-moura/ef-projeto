<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Requests\UpdateFornecedorRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifica.contexto')->except(['index', 'create', 'store']);
    }

    public function index(Request $request)
    {
        $qb = Pessoa::tipo('u');

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('cpf_cnpj', "{$request->query('search')}%");
        }

        $fornecedores = $qb->latest()->paginate(20)->withQueryString();

        return view('fornecedor.index', compact('fornecedores'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('fornecedor.create');
    }

    public function store(StoreFornecedorRequest $request)
    {
        $validatedRequest = $request->validated();
        $fornecedor = Pessoa::create($validatedRequest);

        $marcados = $request->input('tipo', []);
        $contextos = [['tipo' => 'u']];

        foreach ($marcados as $tipo) {
            $contextos[] = ['tipo' => $tipo];
        }

        $fornecedor->contextos()->createMany($contextos);

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor criado com sucesso.');
    }

    public function show(Pessoa $fornecedor)
    {
        return view('fornecedor.show', compact('fornecedor'));
    }

    public function edit(Pessoa $fornecedor)
    {
        return view('fornecedor.edit', compact('fornecedor'));
    }

    public function update(UpdateFornecedorRequest $request, Pessoa $fornecedor)
    {
        $marcados = $request->input('tipo', []);
        $fornecedor->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($fornecedor->contextos()->where('tipo', $tipo)->doesntExist()) {
                $fornecedor->contextos()->create(['tipo' => $tipo]);
            }
        }

        $validatedRequest = $request->validated();
        $fornecedor->update($validatedRequest);

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor atualizado com sucesso');
    }

    public function destroy(Pessoa $fornecedor)
    {
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')
            ->with('success', 'Fornecedor deletado com sucesso');
    }
}
