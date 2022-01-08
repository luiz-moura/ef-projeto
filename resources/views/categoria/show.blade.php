@extends('layouts.app')

@section('title', 'Visualizar categoria')

@section('content')

<a href="{{ route('categorias.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de categorias
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Visualizar categoria</h3>

<div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="nome">Nome</label>
      <input
        type="text"
        name="nome"
        value="{{ $categoria->nome }}"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6">
      <label for="descricao">Descrição</label>
      <input
        type="text"
        name="descricao"
        value="{{ $categoria->descricao }}"
        class="form-control"
        disabled
      />
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="{{ route('categorias.index') }}">
        <i class="bi bi-arrow-return-left"></i> Voltar
      </a>
      <x-form.delete :action="route('categorias.destroy', $categoria)" target="delete"/>
      <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-dark">
        <i class="bi bi-brush"></i> Editar
      </a>
    </div>
  </div>
</div>

<x-modal target="delete" title="Deseja deletar essa categoria?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
