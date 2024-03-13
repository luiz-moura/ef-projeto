<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $qb = Produto::query();

        if ($request->filled('search')) {
            $qb->where('nome', 'ilike', "%{$request->query('search')}%")
                ->orWhere('codigo_barras', "{$request->query('search')}%");
        }

        $produtos = $qb->latest()->paginate(20)->withQueryString();

        return view('produto.index', compact('produtos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $categorias = Categoria::latest()->get();

        return view('produto.create', compact('categorias'));
    }

    public function store(StoreProdutoRequest $request)
    {
        $validatedRequest = $request->validated();
        Produto::create($validatedRequest);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto criado com sucesso.');
    }

    public function show(Produto $produto)
    {
        return view('produto.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::latest()->get();

        return view('produto.edit', compact('produto', 'categorias'));
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $validatedRequest = $request->validated();
        $produto->update($validatedRequest);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto atualizado com sucesso');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('produtos.index')
            ->with('success', 'Produto deletado com sucesso');
    }
}
