@extends('layouts.app')

@section('title', 'Cadastrar categoria')

@section('content')

<a href="{{ route('categorias.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de categorias
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Cadastrar categoria</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger" :message="$error"/>
  @endforeach
@endif

<form
  action="{{ route('categorias.store') }}"
  method="POST"
  class="needs-validation submit-only-btn"
  novalidate
>
  @csrf
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="nome">Nome</label>
      <input
        type="text"
        name="nome"
        value="{{ old('nome') }}"
        id="nome"
        class="form-control @error('nome') is-invalid @enderror"
        required
      />
    </div>
    <div class="col-md-6">
      <label for="descricao">Descrição</label>
      <input
        type="text"
        name="descricao"
        value="{{ old('descricao') }}"
        id="descricao"
        class="form-control @error('nome') is-invalid @enderror"
      />
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="{{ route('categorias.index') }}">
        <i class="bi bi-arrow-return-left"></i> Cancelar
      </a>
      <button class="btn btn-primary" type="submit">
        <i class="bi bi-check-circle-fill"></i> Cadastrar
      </button>
    </div>
  </div>
</form>

@endsection
