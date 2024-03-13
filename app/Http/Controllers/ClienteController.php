<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifica.contexto')->except(['index', 'create', 'store']);
    }

    public function index(Request $request)
    {
        $qb = Pessoa::tipo('c');

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('cpf_cnpj', "{$request->query('search')}%");
        }

        $clientes = $qb->latest()->paginate(20)->withQueryString();

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('cliente.create');
    }

    public function store(StoreClienteRequest $request)
    {
        $validatedRequest = $request->validated();
        $pessoa = Pessoa::create($validatedRequest);

        $contextos = [['tipo' => 'c']];
        $marcados = $request->input('tipo', []);

        foreach ($marcados as $tipo) {
            $contextos[] = ['tipo' => $tipo];
        }

        $pessoa->contextos()->createMany($contextos);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente criado com sucesso.');
    }

    public function show(Pessoa $cliente)
    {
        return view('cliente.show', compact('cliente'));
    }

    public function edit(Pessoa $cliente)
    {
        return view('cliente.edit', compact('cliente'));
    }

    public function update(UpdateClienteRequest $request, Pessoa $cliente)
    {
        $marcados = $request->input('tipo', []);
        $cliente->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($cliente->contextos()->where('tipo', $tipo)->doesntExist()) {
                $cliente->contextos()->create(['tipo' => $tipo]);
            }
        }

        $validatedRequest = $request->validated();
        $cliente->update($validatedRequest);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso');
    }

    public function destroy(Pessoa $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deletado com sucesso');
    }
}
