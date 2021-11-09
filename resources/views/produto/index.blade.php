@extends('layouts.app')

@section('title', 'Produtos')

@section('content')

<a href="{{ route('produtos.create') }}" class="d-block mb-4">
  <i class="bi bi-cart-plus-fill"></i>
  Cadastrar produto
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Produtos</h3>

@if ($message = Session::get('success'))
  <x-alert type="success">
    <x-slot name="message">{{ $message }}</x-slot>
  </x-alert>
@endif

@if(!$produtos->isEmpty())
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Nome</th>
        <th scope="col">Categoria</th>
        <th scope="col">Último custo</th>
        <th scope="col">Valor</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($produtos as $produto)
      <tr>
        <th scope="row">{{ $produto->id }}</th>
        <td>{{ $produto->nome }}</td>
        <td>{{ $produto->categoria->nome }}</td>
        <td>{{ $produto->ultimo_valor_custo }}</td>
        <td>{{ $produto->valor_venda }}</td>
        <td class="text-right">
          <form
            action="{{ route('produtos.destroy', $produto->id) }}"
            method="POST"
          >
            @csrf
            @method('DELETE')
            <a
              href="{{ route('produtos.show', $produto->id) }}"
              class="btn btn-info pb-0 pt-0"
            >
              <i class="bi bi-eye-fill"></i>
              Visualizar
            </a>
            <a
              href="{{ route('produtos.edit', $produto->id) }}"
              class="btn btn-dark pb-0 pt-0"
            >
              <i class="bi bi-brush"></i>
              Editar
            </a>
            <button
              type="submit"
              class="btn btn-danger pb-0 pt-0"
              name="delete"
              data-toggle="modal"
              data-target="#delete"
            >
              <i class="bi bi-trash"></i>
              Excluir
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {!! $produtos->links() !!}

  <x-modal target="delete">
    <x-slot name="title">Deseja deletar esse produto?</x-slot>
    <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
  </x-modal>
@else
  <div class="alert alert-dark" role="alert">
    Não foram encotrado produtos.
  </div>
@endif

@endsection
