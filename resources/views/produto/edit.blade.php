@extends('layouts.app')

@section('title', 'Editar produto')

@section('content')

<a href="{{ route('produtos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar pra lista de produtos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Editar produto</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form
  action="{{ route('produtos.update', $produto->id) }}"
  method="POST"
  id="edit"
  class="needs-validation"
  novalidate
>
  @csrf
  @method('PUT')
  <div class="form-row">
    <div class="col-md-8 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        value="{{ $produto->nome }}"
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
        value="{{ $produto->codigo_barras }}"
      />
    </div>
    <div class="col-md-12 mb-3">
      <label for="marca">Marca</label>
      <input
        type="text"
        class="form-control"
        id="marca"
        name="marca"
        value="{{ $produto->marca }}"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="categoria">Valor venda</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">R$</span>
        </div>
        <input
          type="text"
          class="form-control money"
          name="valor_venda"
          value="{{ $produto->valor_venda }}"
        >
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="categoria_id">Categoria</label>
      <select class="custom-select" id="categoria_id" name="categoria_id">
        <option value="">Escolha...</option>
        @foreach ($categorias as $cat)
          <option
            value="{{ $cat->id }}"
            selected="{{ $produto->categoria->id == $cat->id && 'selected' }}"
          >{{ $cat->nome }}</option>
        @endforeach
      </select>
    </div>
  </div>
</form>
<div class="form-row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('produtos.index') }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
		<form
      action="{{ route('produtos.destroy', $produto->id) }}"
      method="POST"
      class="d-inline"
    >
			@csrf
			@method('DELETE')
			<button
        type="submit"
        class="btn btn-danger d-inline"
        name="delete"
        data-toggle="modal"
        data-target="#delete"
      >
				<i class="bi bi-trash"></i>
				Excluir
			</button>
		</form>
		<button class="btn btn-primary" type="submit" form="edit">
			<i class="bi bi-check-circle-fill"></i> Atualizar
		</button>
	</div>
</div>

<x-modal target="delete">
  <x-slot name="title">Deseja deletar esse produto?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection
