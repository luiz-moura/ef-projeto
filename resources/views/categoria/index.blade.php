@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

<a href="{{ route('categorias.create') }}" class="d-block mb-4">
  <i class="bi bi-bookmark-plus-fill"></i>
  Cadastrar categoria
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Categorias</h3>

<form class="mb-5" method="GET">
  <p class="mb-1">Consultar</p>
  <div class="form-row">
    <div class="col-sm-10 my-1">
      <input
        type="text"
        name="search"
        value="{{ request()->search }}"
        class="form-control"
        placeholder="Digite o nome ou descrição"
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

@if(!$categorias->isEmpty())
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Nome</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($categorias as $cat)
        <tr>
          <th scope="row">{{ $cat->id }}</th>
          <td>{{ $cat->nome }}</td>
          <td class="text-right">
            <a href="{{ route('categorias.show', $cat) }}" class="btn btn-info pb-0 pt-0">
              <i class="bi bi-eye-fill"></i>
              Visualizar
            </a>
            <a href="{{ route('categorias.edit', $cat) }}" class="btn btn-dark pb-0 pt-0">
              <i class="bi bi-brush"></i>
              Editar
            </a>
            <x-form.delete
              :action="route('categorias.destroy', $cat)"
              target="delete"
              class="pb-0 pt-0"
            />
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {!! $categorias->links() !!}

  <x-modal target="delete" title="Deseja deletar essa categoria?">
    Clique em confirmar para deletar, caso deseje cancele a operação!
  </x-modal>
@else
  <x-alert type="warning">Não foram encotrado categorias.</x-alert>
@endif

@endsection
