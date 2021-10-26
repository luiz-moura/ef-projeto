@extends('layouts.app')

@section('title', 'Clientes')

@section('content')

@if(!$pessoas->isEmpty())
  <table class="table table-striped border-none">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">CPF/CNPJ</th>
        <th scope="col">Telefone</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($pessoas as $pessoa)
      <tr>
        <th scope="row">{{ $pessoa->id }}</th>
        <td>{{ $pessoa->nome }}</td>
        <td>{{ $pessoa->cpf_cnpj }}</td>
        <td>{{ $pessoa->telefone }}</td>
        <td>
          <a href="{{ route('destroy-cliente', $pessoa->id) }}" class="btn btn-outline-danger">
            <i class="bi bi-trash"></i>
          </a>
          <a href="{{ route('edit-cliente', $pessoa->id) }}" class="btn btn-outline-success">
            <i class="bi bi-brush"></i>
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</ul>
@else
  <span>Não foram encotrado pessoas</span>
@endif

@endsection
