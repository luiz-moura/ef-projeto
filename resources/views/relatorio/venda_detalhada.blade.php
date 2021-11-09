@extends('layouts.app')

@section('title', 'Relatório de vendas')

@section('content')

<h3 class="pb-4 mb-4 font-italic border-bottom">Relatório de vendas</h3>

<form class="mb-5 submit-only-btn" method="GET">
  <div class="form-row align-items-center">
    <div class="col-sm-3 my-1">
      <label for="empresa">Empresa</label>
      <select name="empresa" id="empresa" class="form-control">
        <option value="">Todas</option>
        @foreach($empresas as $empresa)
          @if (isset($query['empresa']) && $query['empresa'] == $empresa->id)
          <option value="{{ $empresa->id }}" selected>{{ $empresa->nome }}</option>
          @else
          <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="col-sm-3 my-1">
      <label for="start">Período início</label>
      <input type="date" class="form-control" id="start" name="period[]" value="{{ $query['period'][0] ?? '' }}">
    </div>
    <div class="col-sm-3 my-1">
      <label for="end">Período final</label>
      <input type="date" class="form-control" id="end" name="period[]" value="{{ $query['period'][1] ?? '' }}">
    </div>
    <div class="col-sm-1 my-1">
      <label for="limit">Limite</label>
      <input
        type="text"
        id="limit"
        class="form-control"
        placeholder="Limite"
        name="limit"
        value="{{ $query['limit'] ?? 100 }}"
      >
    </div>
    <div class="col-sm-2 my-1">
      <label>_</label>
      <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
    </div>
  </div>
</form>

@if(!$vendas->isEmpty())
  <table class="table table-borderless table-responsive-lg">
    <thead>
      <tr class="table-active">
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Data</th>
        <th scope="col">Empresa</th>
        <th scope="col"colspan="2">Cliente</th>
      </tr>
    </thead>
    <tbody>
      @foreach($vendas as $venda)
      <tr class="border-top my-color">
        <td scope="row"><b>{{ $venda->id }}</b></td>
        <td>{{ $venda->data_operacao_formatada }}</td>
        <td>{{ $venda->empresa->nome }}</td>
        <td colspan="2">{{ $venda->contexto->nome }}</td>
        <tr class="info">
          <th scope="col" class="border-right"></th>
          <th scope="col" class="border-bottom">Produto</th>
          <th scope="col" class="border-bottom">Quantidade</th>
          <th scope="col" class="border-bottom">Preço praticado</th>
          <th scope="col" class="border-bottom">Total</th>
        </tr>
        @foreach($venda->produtos as $produto)
        <tr>
          <td class="border-right"></td>
          <td>{{ $produto->nome }}</td>
          <td>{{ $produto->pivot->quantidade }}</td>
          <td>R$ {{ $produto->pivot->preco_unitario }}</td>
          <td>R$ {{ $produto->pivot->preco_unitario * $produto->pivot->quantidade }}</td>
        </tr>
        @endforeach
      </tr>
      @endforeach
    </tbody>
  </table>
@else
  <div class="alert alert-dark" role="alert">
    Não foram encotrado vendas.
  </div>
@endif

@endsection
