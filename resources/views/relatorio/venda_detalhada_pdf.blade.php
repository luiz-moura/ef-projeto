@extends('layouts.pdf')

@section('title', 'Relatório de venda detalhada')

@section('content')

  <h3>Relatório de vendas</h3>

  @if(!$vendas->isEmpty())
    <table width="100%">
      <thead>
        <tr>
          <th>#</th>
          <th>Data</th>
          <th>Empresa</th>
          <th colspan="2">Cliente</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vendas as $venda)
          <tr>
            <td><b>{{ $venda->id }}</b></td>
            <td>{{ $venda->data_operacao_formatada }}</td>
            <td>{{ $venda->empresa->nome }}</td>
            <td colspan="2">{{ $venda->contexto->nome }}</td>
            <tr>
              <th></th>
              <th>Produto</th>
              <th>Quantidade</th>
              <th>Preço praticado</th>
              <th>Total</th>
            </tr>
            @foreach($venda->produtos as $produto)
              <tr>
                <td>-></td>
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
    Não foram encotrado vendas.
  @endif

@endsection
