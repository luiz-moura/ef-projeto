@extends('layouts.pdf')

@section('title', 'Relatório de venda simples')

@section('content')

  <h3>Relatório de vendas simples</h3>

  @if(!$vendas->isEmpty())
    <table width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>Data</th>
          <th>Empresa</th>
          <th>Cliente</th>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Preço</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vendas as $venda)
          @foreach($venda->produtos as $produto)
            <tr>
              <td><b>{{ $venda->id }}</b></td>
              <td>{{ $venda->data_operacao_formatada }}</td>
              <td>{{ substr($venda->empresa->nome, 0, 10) }}</td>
              <td>{{ substr($venda->contexto->nome, 0, 10) }}</td>
              <td>{{ substr($produto->nome, 0, 20) }}</td>
              <td>{{ $produto->pivot->quantidade }}</td>
              <td>R$ {{ $produto->pivot->preco_unitario }}</td>
              <td>R$ {{ $produto->pivot->preco_unitario * $produto->pivot->quantidade }}</td>
            </tr>
          @endforeach
        @endforeach
      </tbody>
    </table>
  @else
    Não foram encotrado vendas.
  @endif

@endsection
