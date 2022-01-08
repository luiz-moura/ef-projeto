@extends('layouts.app')

@section('title', 'Produtos')

@section('content')

<a href="{{ route('produtos.create') }}" class="d-block mb-4">
  <i class="bi bi-cart-plus-fill"></i>
  Cadastrar produto
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Produtos</h3>

<form class="mb-5" method="GET">
  <p class="mb-1">Consultar</p>
  <div class="form-row align-items-center">
    <div class="col-sm-10 my-1">
      <input
        type="text"
        name="search"
        value="{{ request()->search }}"
        class="form-control"
        placeholder="Digite o nome ou Código de barras"
      >
    </div>
    <div class="col-sm-2 my-1">
      <button type="submit" class="btn btn-primary btn-block">Procurar</button>
    </div>
  </div>
</form>

@if ($message = Session::get('success'))
  <x-alert type="success" :message="$message"/>
@endif

@if($produtos->isNotEmpty())
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
          <a href="{{ route('produtos.show', $produto) }}" class="btn btn-info pb-0 pt-0">
            <i class="bi bi-eye-fill"></i>
            Visualizar
          </a>
          <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-dark pb-0 pt-0">
            <i class="bi bi-brush"></i>
            Editar
          </a>
          <x-form.delete
            :action="route('produtos.destroy', $produto)"
            target="delete"
            class="pb-0 pt-0"
          />
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {!! $produtos->links() !!}

  <x-modal target="delete" title="Deseja deletar esse produto?">
    Clique em confirmar para deletar, caso deseje cancele a operação!
  </x-modal>
@else
  <x-alert type="warning" message="Não foram encotrado produtos."/>
@endif

@endsection
