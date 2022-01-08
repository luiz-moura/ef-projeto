@extends('layouts.app')

@section('title', 'Editar lançamento')

@section('content')

<a href="{{ route('lancamentos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de lançamentos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Editar lançamento</h3>

@if ($message = Session::get('success'))
  <x-alert type="success" :message="$message"/>
@endif

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger" :message="$error"/>
  @endforeach
@endif

<form
  action="{{ route('lancamentos.update', $lancamento) }}"
  method="POST"
  id="form"
  class="needs-validation submit-only-btn"
  novalidate
>
  @csrf
  @method('PUT')
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="empresa">Empresa</label>
      <input
        type="text"
        name="empresa"
        value="{{ $lancamento->empresa->nome }}"
        id="empresa"
        class="form-control"
        disabled
        required
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="contexto_id">{{ $lancamento->contexto_pessoa }}</label>
      <input
        type="text"
        name="contexto_id"
        value="{{ $lancamento->contexto->nome }}"
        id="contexto_id"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="operacao">Operação</label>
      <input
        type="text"
        name="operacao"
        value="{{ $lancamento->operacao_formatada }}"
        id="operacao"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="data_operacao">Data da operação</label>
      <input
        type="text"
        name="data_operacao"
        value="{{ $lancamento->data_operacao_formatada }}"
        id="data_operacao"
        class="form-control"
        disabled
      />
    </div>
  </div>
</form>
@if ($lancamento->produtos->isNotEmpty())
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
        <a
          href="{{ route('lancamento-produtos.edit', $produto->pivot->id) }}"
          class="btn btn-dark pb-0 pt-0"
        >
          <i class="bi bi-brush"></i>
          Editar
        </a>
        <x-form.delete
          :action="route('lancamento-produtos.destroy', $produto->pivot->id)"
          target="delete-produto"
        />
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif

<div class="row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('lancamentos.index') }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
    <x-form.delete :action="route('lancamentos.destroy', $lancamento)" target="delete"/>
	</div>
</div>

<x-modal target="delete" title="Deseja deletar essa lançamento?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

<x-modal target="delete-produto" title="Deseja deletar esse produto do lançamento?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
