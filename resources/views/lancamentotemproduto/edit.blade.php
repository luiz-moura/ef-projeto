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
    <x-alert type="danger" :message="$error"/>
  @endforeach
@endif

<form
  action="{{ route('lancamento-produtos.update', $lancamentoTemProduto->id) }}"
  method="POST"
  id="form"
  class="needs-validation submit-only-btn"
  novalidate
>
  @csrf
  @method('PUT')
  <div class="form-row mb-3">
    <div class="col-md-12">
      <label for="produto_id">Produto</label>
      <input
        type="text"
        name="produto_id"
        value="{{ $lancamentoTemProduto->produto->nome }}"
        id="produto_id"
        class="form-control"
        disabled
        required
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="quantidade">Quantidade</label>
      <input
        type="text"
        name="quantidade"
        value="{{ $lancamentoTemProduto->quantidade }}"
        id="quantidade"
        class="form-control"
        required
      />
    </div>
    <div class="col-md-6">
      <label for="preco_unitario">Preço unitario</label>
      <input
        type="text"
        name="preco_unitario"
        value="{{ $lancamentoTemProduto->preco_unitario }}"
        id="preco_unitario"
        class="form-control"
      />
    </div>
  </div>
</form>

<div class="row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('lancamentos.edit', $lancamentoTemProduto->lancamento_id) }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
    <x-form.delete
      :action="route('lancamento-produtos.destroy', $lancamentoTemProduto)"
      target="delete"
    />
		<button class="btn btn-primary" type="submit" form="form">
			<i class="bi bi-check-circle-fill"></i> Atualizar
		</button>
	</div>
</div>

<x-modal target="delete" title="Deseja deletar essa produto do lançamento?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
