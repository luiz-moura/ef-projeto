@extends('layouts.app')

@section('title', 'Empresas')

@section('content')

<a href="{{ route('empresas.create') }}" class="d-block mb-4">
  <i class="bi bi-person-plus-fill"></i>
  Cadastrar empresa
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Empresas</h3>

<form class="mb-5" method="GET">
  <p class="mb-1">Consultar</p>
  <div class="form-row">
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

@if($empresas->isNotEmpty())
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Nome</th>
        <th scope="col">CPF/CNPJ</th>
        <th scope="col">Telefone</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($empresas as $empresa)
        <tr>
          <th scope="row">{{ $empresa->id }}</th>
          <td>{{ $empresa->nome }}</td>
          <td>{{ $empresa->cpf_cnpj_formatado }}</td>
          <td>{{ $empresa->telefone }}</td>
          <td class="text-right">
            <a href="{{ route('empresas.show', $empresa) }}" class="btn btn-info pb-0 pt-0">
              <i class="bi bi-eye-fill"></i>
              Visualizar
            </a>
            <a href="{{ route('empresas.edit', $empresa) }}" class="btn btn-dark pb-0 pt-0">
              <i class="bi bi-brush"></i>
              Editar
            </a>
            <x-form.delete
              :action="route('empresas.destroy', $empresa)"
              target="delete"
              class="pb-0 pt-0"
            />
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  {!! $empresas->links() !!}

  <x-modal target="delete" title="Deseja deletar essa empresa?">
    Clique em confirmar para deletar, caso deseje cancele a operação!
  </x-modal>
@else
  <x-alert type="warning" message="Não foram encotrado empresas."/>
@endif

@endsection
