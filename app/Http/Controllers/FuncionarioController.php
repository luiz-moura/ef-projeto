<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Requests\UpdateFuncionarioRequest;
use App\Models\Pessoa;

class FuncionarioController extends Controller
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
        $funcionarios = Pessoa::tipo('f')->latest()->paginate(20);

        return view('funcionario.index', compact('funcionarios'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funcionario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFuncionarioRequest $request)
    {
        $request->validated();

        $funcionario = Pessoa::create($request->all());

        $contextos = array(['tipo' => 'f']);
        if (isset($request->tipo)) {
            foreach ($request->tipo as $tipo) {
                $contextos[] = ['tipo' => $tipo];
            }
        }

        $funcionario->contextos()->createMany($contextos);

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pessoa  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $funcionario)
    {
        return view('funcionario.show', compact('funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pessoa  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $funcionario)
    {
        return view('funcionario.edit', compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pessoa  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuncionarioRequest $request, Pessoa $funcionario)
    {
        $request->validated();

        $marcados = [...$request->tipo, 'e'];

        $funcionario->contextos()->whereNotIn('tipo', $marcados)->delete();

        foreach ($marcados as $tipo) {
            if ($funcionario->contextos()->where('tipo', $tipo)->doesntExist()) {
                $funcionario->contextos()->create(['tipo' => $tipo]);
            }
        }

        $funcionario->update($request->all());

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pessoa  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pessoa $funcionario)
    {
        $funcionario->delete();

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionario deletado com sucesso');
    }
}
