@extends('layouts.app')

@section('title', 'Cadastrar categoria')

@section('content')

<a href="{{ route('categorias.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar pra lista de categorias
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Cadastrar categoria</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form action="{{ route('categorias.store') }}" method="POST" class="needs-validation" novalidate>
  @csrf
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        required
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="descricao">Descrição</label>
      <input
        type="text"
        class="form-control"
        id="descricao"
        name="descricao"
      />
    </div>
  </div>
  <div class="text-right">
    <a class="btn btn-warning" href="{{ route('categorias.index') }}">
      <i class="bi bi-arrow-return-left"></i> Cancelar
    </a>
    <button class="btn btn-primary" type="submit">
      <i class="bi bi-check-circle-fill"></i> Cadastrar
    </button>
  </div>
</form>

@endsection
