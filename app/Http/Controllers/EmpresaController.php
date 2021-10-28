<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Models\Pessoa;

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
    public function index()
    {
        $empresas = Pessoa::tipo('e')->latest()->paginate(20);

        return view('empresa.index', compact('empresas'))
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

        $contextos = array(['tipo' => 'e']);
        if (isset($request->tipo)) {
            foreach ($request->tipo as $tipo) {
                $contextos[] = ['tipo' => $tipo];
            }
        }

        $empresa->contextos()->createMany($contextos);

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa criado com sucesso.');
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

        $marcados = [...$request->tipo, 'e'];

        $empresa->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($empresa->contextos()->where('tipo', $tipo)->doesntExist()) {
                $empresa->contextos()->create(['tipo' => $tipo]);
            }
        }

        $empresa->update($request->all());

        return redirect()->route('empresas.index')
            ->with('success', 'Empresa atualizado com sucesso');
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
            ->with('success', 'Empresa deletado com sucesso');
    }
}
