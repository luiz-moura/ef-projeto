@extends('layouts.app')

@section('title', 'Editar lançamento')

@section('content')

<a href="{{ route('lancamentos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de lançamentos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Editar lançamento</h3>

@if ($message = Session::get('success'))
  <x-alert type="success">
    <x-slot name="message">{{ $message }}</x-slot>
  </x-alert>
@endif

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form
  action="{{ route('lancamentos.update', $lancamento->id) }}"
  method="POST"
  class="needs-validation"
  novalidate
  id="form"
>
  @csrf
  @method('PUT')
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="empresa">Empresa</label>
      <input
        type="text"
        class="form-control"
        id="empresa"
        name="empresa"
        value="{{ $lancamento->empresa->nome }}"
        disabled
        required
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="contexto_id">{{ $lancamento->contexto_pessoa }}</label>
      <input
        type="text"
        class="form-control"
        id="contexto_id"
        name="contexto_id"
        disabled
        value="{{ $lancamento->contexto->nome }}"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="operacao">Operação</label>
      <input
        type="text"
        class="form-control"
        id="operacao"
        name="operacao"
        disabled
        value="{{ $lancamento->operacao }}"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="data_operacao">Data da operação</label>
      <input
        type="text"
        class="form-control"
        id="data_operacao"
        name="data_operacao"
        disabled
        value="{{ $lancamento->data_operacao }}"
      />
    </div>
  </div>
</form>
@if (!$lancamento->produtos->isEmpty())
<table class="table table-striped table-borderless table-responsive-lg">
  <thead>
    <tr>
      <th scope="col"><i class="bi bi-key-fill"></i></th>
      <th scope="col">Produto</th>
      <th scope="col">Quantidade</th>
      <th scope="col">Valor</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($lancamento->produtos as $produto)
    <tr>
      <th scope="row">{{ $produto->pivot->id }}</th>
      <td>{{ $produto->nome }}</td>
      <td>{{ $produto->pivot->quantidade }}</td>
      <td>{{ $produto->pivot->preco_unitario }}</td>
      <td class="text-right">
        <form action="{{ route('lancamento-produtos.destroy', $produto->pivot->id) }}" method="POST">
          <a
            href="{{ route('lancamento-produtos.edit', $produto->pivot->id) }}"
            class="btn btn-dark pb-0 pt-0"
          >
            <i class="bi bi-brush"></i>
            Editar
          </a>
          @csrf
          @method('DELETE')
          <button
            type="submit"
            class="btn btn-danger pb-0 pt-0"
            name="delete-produto"
            data-toggle="modal"
            data-target="#delete-produto"
          >
            <i class="bi bi-trash"></i>
            Excluir
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
<div class="form-row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('lancamentos.index') }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
		<form
      action="{{ route('lancamentos.destroy', $lancamento->id) }}"
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
	</div>
</div>

<x-modal target="delete">
  <x-slot name="title">Deseja deletar essa lançamento?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

<x-modal target="delete-produto">
  <x-slot name="title">Deseja esse produto do lançamento?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection
