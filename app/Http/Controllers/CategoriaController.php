<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $qb = Categoria::query();

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('descricao', 'ilike', "%{$request->query('search')}%");
        }

        $categorias = $qb->latest()->paginate(20)->withQueryString();

        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.create');
    }

    public function store(StoreCategoriaRequest $request)
    {
        $validated = $request->validated();

        Categoria::create($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria criada com sucesso.');
    }

    public function show(Categoria $categoria)
    {
        return view('categoria.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('categoria.edit', compact('categoria'));
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria)
    {
        $validated = $request->validated();

        $categoria->update($validated);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria deletada com sucesso.');
    }
}
