@extends('layouts.app')

@section('title', 'Visualizar produto')

@section('content')

<a href="{{ route('produtos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de produtos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Visualizar produto</h3>

<div>
  <div class="form-row">
    <div class="col-md-8 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        name="nome"
        value="{{ $produto->nome }}"
        id="nome"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="codigo_barras">Código de barras</label>
      <input
        type="text"
        name="codigo_barras"
        value="{{ $produto->codigo_barras }}"
        id="codigo_barras"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-12 mb-3">
      <label for="marca">Marca</label>
      <input
        type="text"
        name="marca"
        value="{{ $produto->marca }}"
        id="marca"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="valor_venda">Valor venda</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input
          type="text"
          name="valor_venda"
          id="valor_venda"
          class="form-control"
          disabled
        />
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="categoria_id">Categoria</label>
      <select
        name="categoria_id"
        id="categoria_id"
        class="custom-select"
        disabled
      >
        <option value="{{ $produto->categoria->id }}">
          {{ $produto->categoria->nome }}
        </option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="{{ route('produtos.index') }}">
        <i class="bi bi-arrow-return-left"></i> Voltar
      </a>
      <x-form.delete :action="route('produtos.destroy', $produto)" target="delete"/>
      <a href="{{ route('produtos.edit', $produto) }}" class="btn btn-dark">
        <i class="bi bi-brush"></i> Editar
      </a>
    </div>
  </div>
</div>

<x-modal target="delete" title="Deseja deletar essa produto?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
