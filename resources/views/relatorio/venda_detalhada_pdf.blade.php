<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h3 class="pb-4 mb-4 font-italic border-bottom">Relatório de vendas</h3>
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
</body>
</html>
