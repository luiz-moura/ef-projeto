@extends('layouts.app')

@section('title', 'Visualizar categoria')

@section('content')

<a href="{{ route('categorias.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar pra lista de categorias
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Visualizar categoria</h3>

<form>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        value="{{ $categoria->nome }}"
        disabled
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
        disabled
      />
    </div>
  </div>
</form>
<div class="form-row">
  <div class="col-md-12 text-right">
    <a class="btn btn-warning" href="{{ route('categorias.index') }}">
	    <i class="bi bi-arrow-return-left"></i> Voltar
    </a>
    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
			@csrf
			@method('DELETE')
			<button type="submit" class="btn btn-danger d-inline" name="delete" data-toggle="modal" data-target="#delete">
				<i class="bi bi-trash"></i>
				Excluir
			</button>
		</form>
    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-dark" type="submit">
      <i class="bi bi-brush"></i> Editar
    </a>
  </div>
</div>

<x-modal target="delete">
  <x-slot name="title">Deseja deletar essa categoria?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection
