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
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form
  action="{{ route('categorias.update', $categoria->id) }}"
  method="POST"
  class="needs-validation submit-only-btn"
  novalidate
  id="form"
>
  @csrf
  @method('PUT')
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        value="{{ $categoria->nome }}"
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
        value="{{ $categoria->descricao }}"
      />
    </div>
  </div>
</form>
<div class="form-row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('categorias.index') }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
		<form
      action="{{ route('categorias.destroy', $categoria->id) }}"
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
  <x-slot name="title">Deseja deletar essa categoria?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection
