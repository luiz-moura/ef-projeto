@extends('layouts.app')

@section('title', 'Cadastrar produto')

@section('content')

<a href="{{ route('produtos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de produtos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Cadastrar produto</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form
  action="{{ route('produtos.store') }}"
  method="POST"
  class="needs-validation"
  novalidate
>
  @csrf
  <div class="form-row">
    <div class="col-md-8 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        required
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="codigo_barras">Código de barras</label>
      <input
        type="text"
        class="form-control"
        id="codigo_barras"
        name="codigo_barras"
      />
    </div>
    <div class="col-md-12 mb-3">
      <label for="marca">Marca</label>
      <input
        type="text"
        class="form-control"
        id="marca"
        name="marca"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="valor_venda">Valor venda</label>
      <input
        type="text"
        class="form-control"
        id="valor_venda"
        name="valor_venda"
        required
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="categoria_id">Categoria</label>
      <select class="custom-select" id="categoria_id" name="categoria_id">
        <option value="">Escolha...</option>
        @foreach ($categorias as $cat)
          <option value="{{ $cat->id }}">{{ $cat->nome }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="text-right">
    <a class="btn btn-warning" href="{{ route('produtos.index') }}">
      <i class="bi bi-arrow-return-left"></i> Cancelar
    </a>
    <button class="btn btn-primary" type="submit">
      <i class="bi bi-check-circle-fill"></i> Cadastrar
    </button>
  </div>
</form>

@endsection
