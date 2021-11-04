@extends('layouts.app')

@section('title', 'Editar produto do lançamento')

@section('content')

<a href="{{ route('lancamentos.edit', $lancamentoTemProduto->lancamento_id) }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para o lançamento
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Editar produto do lançamento</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form
  action="{{ route('lancamento-produtos.update', $lancamentoTemProduto->id) }}"
  method="POST"
  class="needs-validation"
  novalidate
  id="form"
>
  @csrf
  @method('PUT')
  <div class="form-row">
    <div class="col-md-12 mb-3">
      <label for="produto_id">Produto</label>
      <input
        type="text"
        class="form-control"
        id="produto_id"
        name="produto_id"
        value="{{ $lancamentoTemProduto->produto->nome }}"
        disabled
        required
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="quantidade">Quantidade</label>
      <input
        type="text"
        class="form-control"
        id="quantidade"
        name="quantidade"
        value="{{ $lancamentoTemProduto->quantidade }}"
        required
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="preco_unitario">Preço unitario</label>
      <input
        type="text"
        class="form-control"
        id="preco_unitario"
        name="preco_unitario"
        value="{{ $lancamentoTemProduto->preco_unitario }}"
      />
    </div>
  </div>
</form>
<div class="form-row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('lancamentos.edit', $lancamentoTemProduto->lancamento_id) }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
		<form
      action="{{ route('lancamento-produtos.destroy', $lancamentoTemProduto->id) }}"
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
		<button class="btn btn-primary" type="submit" form="form">
			<i class="bi bi-check-circle-fill"></i> Atualizar
		</button>
	</div>
</div>

<x-modal target="delete">
  <x-slot name="title">Deseja deletar essa produto do lançamento?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection
