@extends('layouts.app')

@section('title', 'Clientes')

@section('content')

<a href="{{ route('clientes.create') }}" class="d-block mb-4">
  <i class="bi bi-person-plus-fill"></i>
  Cadastrar novos clientes
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Clientes</h3>

@if ($message = Session::get('success'))
  <x-alert type="success">
    <x-slot name="message">{{ $message }}</x-slot>
  </x-alert>
@endif

@if(!$clientes->isEmpty())
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
      @foreach($clientes as $cliente)
      <tr>
        <th scope="row">{{ $cliente->id }}</th>
        <td>{{ $cliente->nome }}</td>
        <td>{{ $cliente->cpf_cnpj }}</td>
        <td>{{ $cliente->telefone }}</td>
        <td class="text-right">
          <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST">
            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-info pb-0 pt-0">
              <i class="bi bi-eye-fill"></i>
              Visualizar
            </a>
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-dark pb-0 pt-0">
              <i class="bi bi-brush"></i>
              Editar
            </a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger pb-0 pt-0" name="delete" data-toggle="modal" data-target="#delete">
              <i class="bi bi-trash"></i>
              Excluir
            </button>
          </form>
          <x-modal target="delete">
            <x-slot name="title">Deseja deletar esse usuário?</x-slot>
            <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
          </x-modal>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {!! $clientes->links() !!}
@else
  <div class="alert alert-dark" role="alert">
    Não foram encotrado clientes.
  </div>
@endif

@endsection
