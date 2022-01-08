@extends('layouts.app')

@section('title', 'Visualizar lançamento')

@section('content')

<a href="{{ route('lancamentos.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de lançamentos
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Visualizar lançamento</h3>

<div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="nome">Empresa</label>
      <input
        type="text"
        name="empresa"
        value="{{ $lancamento->empresa->nome }}"
        id="empresa"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6">
      <label for="descricao">{{ $lancamento->contexto_pessoa }}</label>
      <input
        type="text"
        name="contexto_id"
        value="{{ $lancamento->contexto->nome }}"
        id="contexto_id"
        class="form-control"
        disabled
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="descricao">Operação</label>
      <input
        type="text"
        name="operacao"
        value="{{ $lancamento->operacao_formatada }}"
        id="operacao"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6">
      <label for="descricao">Data da operação</label>
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
  @if ($lancamento->produtos->isNotEmpty())
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Produto</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Valor</th>
      </tr>
    </thead>
    <tbody>
      @foreach($lancamento->produtos as $produto)
      <tr>
        <th scope="row">{{ $produto->pivot->id }}</th>
        <td>{{ $produto->nome }}</td>
        <td>{{ $produto->pivot->quantidade }}</td>
        <td>{{ $produto->pivot->preco_unitario }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
  <div class="form-row">
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="{{ route('lancamentos.index') }}">
        <i class="bi bi-arrow-return-left"></i> Voltar
      </a>
      <x-form.delete
        :action="route('lancamentos.destroy', $lancamento->id)"
        target="delete"
      />
      <a href="{{ route('lancamentos.edit', $lancamento->id) }}" class="btn btn-dark">
        <i class="bi bi-brush"></i> Editar
      </a>
    </div>
  </div>
</div>

<x-modal target="delete" title="Deseja deletar essa lançamento?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
