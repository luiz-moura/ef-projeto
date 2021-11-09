<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h3 class="pb-4 mb-4 font-italic border-bottom">Relatório de vendas simples</h3>
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
        @endforeach
      </tbody>
    </table>
  @else
    <div class="alert alert-dark" role="alert">
      Não foram encotrado vendas.
    </div>
  @endif
</body>
</html>
