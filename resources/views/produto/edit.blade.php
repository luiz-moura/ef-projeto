@extends('layouts.app')

@section('title', 'Editar produto')

@section('content')

<a href="{{ route('produtos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de produtos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Editar produto</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger" :message="$error"/>
  @endforeach
@endif

<form
  action="{{ route('produtos.update', $produto) }}"
  method="POST"
  id="edit"
  class="needs-validation submit-only-btn"
  novalidate
>
  @csrf
  @method('PUT')
  <div class="form-row mb-3">
    <div class="col-md-8">
      <label for="nome">Nome</label>
      <input
        type="text"
        name="nome"
        value="{{ $produto->nome }}"
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
        value="{{ $produto->codigo_barras }}"
        id="codigo_barras"
        class="form-control @error('codigo_barras') is-invalid @enderror"
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-12">
      <label for="marca">Marca</label>
      <input
        type="text"
        name="marca"
        value="{{ $produto->marca }}"
        id="marca"
        class="form-control @error('Marca') is-invalid @enderror"
      />
    </div>
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
          value="{{ $produto->valor_venda }}"
          id="valor_venda"
          class="form-control money @error('valor_venda') is-invalid @enderror"
          required
        >
      </div>
    </div>
    <div class="col-md-6">
      <label for="categoria_id">Categoria</label>
      <select
        name="categoria_id"
        id="categoria_id"
        class="custom-select @error('categoria_id') is-invalid @enderror"
      >
        <option value="">Escolha...</option>
        @foreach ($categorias as $cat)
          <option
            value="{{ $cat->id }}"
            @if ($produto->categoria->id == $cat->id) selected @endif
          >
            {{ $cat->nome }}
          </option>
        @endforeach
      </select>
    </div>
  </div>
</form>

<div class="row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('produtos.index') }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
    <x-form.delete :action="route('produtos.destroy', $produto)" target="delete"/>
		<button class="btn btn-primary" type="submit" form="edit">
			<i class="bi bi-check-circle-fill"></i> Atualizar
		</button>
	</div>
</div>

<x-modal target="delete" title="Deseja deletar esse produto?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
