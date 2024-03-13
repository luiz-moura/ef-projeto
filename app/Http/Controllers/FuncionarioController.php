<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Requests\UpdateFuncionarioRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifica.contexto')->except(['index', 'create', 'store']);
    }

    public function index(Request $request)
    {
        $qb = Pessoa::tipo('f');

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('cpf_cnpj', "{$request->query('search')}%");
        }

        $funcionarios = $qb->latest()->paginate(20)->withQueryString();

        return view('funcionario.index', compact('funcionarios'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('funcionario.create');
    }

    public function store(StoreFuncionarioRequest $request)
    {
        $validatedRequest = $request->validated();
        $funcionario = Pessoa::create($validatedRequest);

        $marcados = $request->input('tipo', []);
        $contextos = [['tipo' => 'f']];

        foreach ($marcados as $tipo) {
            $contextos[] = ['tipo' => $tipo];
        }

        $funcionario->contextos()->createMany($contextos);

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario criado com sucesso.');
    }

    public function show(Pessoa $funcionario)
    {
        return view('funcionario.show', compact('funcionario'));
    }

    public function edit(Pessoa $funcionario)
    {
        return view('funcionario.edit', compact('funcionario'));
    }

    public function update(UpdateFuncionarioRequest $request, Pessoa $funcionario)
    {
        $marcados = $request->input('tipo', []);
        $funcionario->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($funcionario->contextos()->where('tipo', $tipo)->doesntExist()) {
                $funcionario->contextos()->create(['tipo' => $tipo]);
            }
        }

        $validatedRequest = $request->validated();
        $funcionario->update($validatedRequest);

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario atualizado com sucesso');
    }

    public function destroy(Pessoa $funcionario)
    {
        $funcionario->delete();

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario deletado com sucesso');
    }
}
