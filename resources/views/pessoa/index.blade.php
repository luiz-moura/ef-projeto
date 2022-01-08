@extends('layouts.app')

@section('title', 'Pessoas')

@section('content')

<a href="{{ route('pessoas.create') }}" class="d-block mb-4">
  <i class="bi bi-person-plus-fill"></i>
  Cadastrar pessoa
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Pessoas</h3>

<form class="mb-5" method="GET">
  <p class="mb-1">Consultar</p>
  <div class="form-row align-items-center">
    <div class="col-sm-10 my-1">
      <input
        type="text"
        name="search"
        value="{{ request()->search }}"
        class="form-control"
        placeholder="Digite o nome ou CPF/CNPJ"
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

@if($pessoas->isNotEmpty())
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Nome</th>
        <th scope="col">CPF/CNPJ</th>
        <th scope="col">Consta em</th>
        <th scope="col">Desde</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($pessoas as $pessoa)
        <tr>
          <th scope="row">{{ $pessoa->id }}</th>
          <td>{{ $pessoa->nome }}</td>
          <td>{{ $pessoa->cpf_cnpj_formatado }}</td>
          <td>
            @foreach($pessoa->contextos as $contexto)
              {{ $contexto->tipo_formatado }} @if(!$loop->last), @endif
            @endforeach
          </td>
          <td>{{ $pessoa->created_at_formatada }}</td>
          <td class="text-right">
            <a href="{{ route('pessoas.show', $pessoa) }}" class="btn btn-info pb-0 pt-0">
              <i class="bi bi-eye-fill"></i>
              Visualizar
            </a>
            <a href="{{ route('pessoas.edit', $pessoa) }}" class="btn btn-dark pb-0 pt-0">
              <i class="bi bi-brush"></i>
              Editar
            </a>
            <x-form.delete
              :action="route('pessoas.destroy', $pessoa)"
              target="delete"
              class="pb-0 pt-0"
            />
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {!! $pessoas->links() !!}

  <x-modal target="delete" title="Deseja deletar essa pessoa?">
    Clique em confirmar para deletar, caso deseje cancele a operação!
  </x-modal>
@else
  <x-alert type="warning" message="Não foram encotrado pessoas."/>
@endif

@endsection
