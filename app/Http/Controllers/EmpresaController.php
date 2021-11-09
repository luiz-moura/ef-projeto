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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qb = Pessoa::tipo('e');

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('cpf_cnpj', "{$request->query('search')}%");
        }

        $empresas = $qb->latest()->paginate(20)->withQueryString();

        $query = $request->query();

        return view('empresa.index', compact('empresas', 'query'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpresaRequest $request)
    {
        $request->validated();

        $empresa = Pessoa::create($request->all());

        $marcados = $request->tipo ?: [];

        $contextos = [['tipo' => 'e']];
        foreach ($marcados as $tipo) {
            $contextos[] = ['tipo' => $tipo];
        }

        $empresa->contextos()->createMany($contextos);

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pessoa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $empresa)
    {
        return view('empresa.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pessoa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $empresa)
    {
        return view('empresa.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pessoa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmpresaRequest $request, Pessoa $empresa)
    {
        $request->validated();

        $marcados = $request->tipo ?: [];

        $empresa->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($empresa->contextos()->where('tipo', $tipo)->doesntExist()) {
                $empresa->contextos()->create(['tipo' => $tipo]);
            }
        }

        $empresa->update($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pessoa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pessoa $empresa)
    {
        $empresa->delete();

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa deletada com sucesso');
    }
}
