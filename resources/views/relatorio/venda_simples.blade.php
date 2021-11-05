@extends('layouts.app')

@section('title', 'Relatório de vendas simples')

@section('content')

<h3 class="pb-4 mb-4 font-italic border-bottom">Relatório de vendas simples</h3>

<form class="mb-5">
  <div class="form-row align-items-center">
    <div class="col-sm-4 my-1">
      <label class="sr-only" for="inlineFormInputName">Período início</label>
      <input type="date" class="form-control" id="inlineFormInputName">
    </div>
    <div class="col-sm-4 my-1">
      <label class="sr-only" for="inlineFormInputName">Período final</label>
      <input type="date" class="form-control" id="inlineFormInputName">
    </div>
    <div class="col-sm-2 my-1">
      <label class="sr-only" for="inlineFormInputName">Limite</label>
      <input type="text" class="form-control" id="inlineFormInputName" placeholder="Limite" value="100">
    </div>

    <div class="col-sm-2 my-1">
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
        <th scope="col">Cliente</th>
        <th scope="col">Produto</th>
        <th scope="col">Quantidade</th>
        <th scope="col">Preço</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($vendas as $venda)
      <tr class="border-top my-color">
        @foreach($venda->produtos as $produto)
        <tr>
          <td scope="row"><b>{{ $venda->id }}</b></td>
          <td>{{ $venda->data_operacao_formatada }}</td>
          <td>{{ substr($venda->empresa->nome, 0, 10) }}</td>
          <td>{{ substr($venda->contexto->nome, 0, 10) }}</td>
          <td>{{ substr($produto->nome, 0, 20) }}</td>
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
