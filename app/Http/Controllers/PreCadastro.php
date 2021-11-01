<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePreCadastroRequest;
use App\Http\Requests\UpdatePreCadastroRequest;
use App\Models\Pessoa;

class PreCadastroController extends Controller
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
        $preCadastros = Pessoa::tipo('c')->latest()->paginate(20);

        return view('preCadastro.index', compact('preCadastros'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('preCadastro.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreCadastroRequest $request)
    {
        $request->validated();

        $pessoa = Pessoa::create($request->all());

        $contextos = array(['tipo' => 'c']);
        if (isset($request->tipo)) {
            foreach ($request->tipo as $tipo) {
                $contextos[] = ['tipo' => $tipo];
            }
        }

        $pessoa->contextos()->createMany($contextos);

        return redirect()->route('preCadastros.index')
            ->with('success', 'PreCadastro criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pessoa  $preCadastro
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $preCadastro)
    {
        return view('preCadastro.show', compact('preCadastro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pessoa  $preCadastro
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $preCadastro)
    {
        return view('preCadastro.edit', compact('preCadastro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pessoa  $preCadastro
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreCadastroRequest $request, Pessoa $preCadastro)
    {
        $request->validated();

        $marcados = $request->tipo;

        $preCadastro->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($preCadastro->contextos()->where('tipo', $tipo)->doesntExist()) {
                $preCadastro->contextos()->create(['tipo' => $tipo]);
            }
        }

        $preCadastro->update($request->all());

        return redirect()->route('preCadastros.index')
            ->with('success', 'PreCadastro atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pessoa  $preCadastro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pessoa $preCadastro)
    {
        $preCadastro->delete();

        return redirect()->route('preCadastros.index')
            ->with('success', 'PreCadastro deletado com sucesso');
    }
}
