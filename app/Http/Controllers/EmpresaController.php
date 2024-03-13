<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Models\Pessoa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifica.contexto')->except(['index', 'create', 'store']);
    }

    public function index(Request $request)
    {
        $qb = Pessoa::tipo('e');

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('cpf_cnpj', "{$request->query('search')}%");
        }

        $empresas = $qb->latest()->paginate(20)->withQueryString();

        return view('empresa.index', compact('empresas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('empresa.create');
    }

    public function store(StoreEmpresaRequest $request)
    {
        $validatedRequest = $request->validated();
        $empresa = Pessoa::create($validatedRequest);

        $marcados = $request->input('tipo', []);
        $contextos = [['tipo' => 'e']];

        foreach ($marcados as $tipo) {
            $contextos[] = ['tipo' => $tipo];
        }

        $empresa->contextos()->createMany($contextos);

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa criada com sucesso.');
    }

    public function show(Pessoa $empresa)
    {
        return view('empresa.show', compact('empresa'));
    }

    public function edit(Pessoa $empresa)
    {
        return view('empresa.edit', compact('empresa'));
    }

    public function update(UpdateEmpresaRequest $request, Pessoa $empresa)
    {
        $marcados = $request->input('tipo', []);
        $empresa->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($empresa->contextos()->where('tipo', $tipo)->doesntExist()) {
                $empresa->contextos()->create(['tipo' => $tipo]);
            }
        }

        $validatedRequest = $request->validated();
        $empresa->update($validatedRequest);

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa atualizada com sucesso');
    }

    public function destroy(Pessoa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa deletada com sucesso');
    }
}
