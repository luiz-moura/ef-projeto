@extends('layouts.app')

@section('title', 'Editar categoria')

@section('content')

<a href="{{ route('categorias.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de categorias
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Editar categoria</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger" :message="$error"/>
  @endforeach
@endif

<form
  action="{{ route('categorias.update', $categoria) }}"
  method="POST"
  id="form"
  class="needs-validation submit-only-btn"
  novalidate
>
  @csrf
  @method('PUT')
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="nome">Nome</label>
      <input
        type="text"
        name="nome"
        value="{{ $categoria->nome }}"
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
        value="{{ $categoria->descricao }}"
        id="descricao"
        class="form-control @error('descricao') is-invalid @enderror"
      />
    </div>
  </div>
</form>

<div class="row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('categorias.index') }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
    <x-form.delete :action="route('categorias.destroy', $categoria)" target="delete"/>
		<button class="btn btn-primary" type="submit" form="form">
			<i class="bi bi-check-circle-fill"></i> Atualizar
		</button>
	</div>
</div>

<x-modal target="delete" title="Deseja deletar essa categoria?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
