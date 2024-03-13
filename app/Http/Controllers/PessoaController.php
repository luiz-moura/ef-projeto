<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePessoaRequest;
use App\Http\Requests\UpdatePessoaRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index(Request $request)
    {
        $qb = Pessoa::query();

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('cpf_cnpj', "{$request->query('search')}%");
        }

        $pessoas = $qb->latest()->paginate(20)->withQueryString();

        return view('pessoa.index', compact('pessoas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('pessoa.create');
    }

    public function store(StorePessoaRequest $request)
    {
        $validatedRequest = $request->validated();
        $pessoa = Pessoa::create($validatedRequest);

        $marcados = $request->input('tipo', []);
        $contextos = [];

        foreach ($marcados as $tipo) {
            $contextos[] = ['tipo' => $tipo];
        }

        $pessoa->contextos()->createMany($contextos);

        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa criada com sucesso.');
    }

    public function show(Pessoa $pessoa)
    {
        return view('pessoa.show', compact('pessoa'));
    }

    public function edit(Pessoa $pessoa)
    {
        return view('pessoa.edit', compact('pessoa'));
    }

    public function update(UpdatePessoaRequest $request, Pessoa $pessoa)
    {
        $marcados = $request->input('tipo', []);
        $pessoa->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($pessoa->contextos()->where('tipo', $tipo)->doesntExist()) {
                $pessoa->contextos()->create(['tipo' => $tipo]);
            }
        }

        $validatedRequest = $request->validated();
        $pessoa->update($validatedRequest);

        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa atualizada com sucesso');
    }

    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();

        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa deletada com sucesso');
    }
}
