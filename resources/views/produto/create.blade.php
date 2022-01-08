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
    <x-alert type="danger" :message="$error"/>
  @endforeach
@endif

<form
  action="{{ route('produtos.store') }}"
  method="POST"
  class="needs-validation submit-only-btn"
  novalidate
>
  @csrf
  <div class="form-row mb-3">
    <div class="col-md-8">
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
    <div class="col-md-4">
      <label for="codigo_barras">Código de barras</label>
      <input
        type="text"
        name="codigo_barras"
        value="{{ old('codigo_barras') }}"
        id="codigo_barras"
        class="form-control @error('nome') is-invalid @enderror"
      />
    </div>
  </div>
  <div class="form-group mb-3">
    <label for="marca">Marca</label>
    <input
      type="text"
      name="marca"
      value="{{ old('marca') }}"
      id="marca"
      class="form-control @error('nome') is-invalid @enderror"
    />
  </div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="valor_venda">Valor venda</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input
          type="text"
          name="valor_venda"
          value="{{ old('valor_venda') }}"
          id="valor_venda"
          class="form-control @error('nome') is-invalid @enderror"
          required
        />
      </div>
    </div>
    <div class="col-md-6">
      <label for="categoria_id">Categoria</label>
      <select
        name="categoria_id"
        id="categoria_id"
        class="custom-select @error('nome') is-invalid @enderror"
      >
        <option value="">Escolha...</option>
        @foreach ($categorias as $cat)
          <option
            value="{{ $cat->id }}"
            @if (@old('categoria_id') == $cat->id) seleted @endif
          >
            {{ $cat->nome }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="{{ route('produtos.index') }}">
        <i class="bi bi-arrow-return-left"></i> Cancelar
      </a>
      <button class="btn btn-primary" type="submit">
        <i class="bi bi-check-circle-fill"></i> Cadastrar
      </button>
    </div>
  </div>
</form>

@endsection
