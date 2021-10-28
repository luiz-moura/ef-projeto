<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/checkout/">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <meta name="theme-color" content="#563d7c">
  <link href="{{ asset('styles/app.css') }}" rel="stylesheet">
  <link href="form-validation.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
</head>

<body class="bg-light">

  <div class="container">
    <div class="py-5 text-center">
      <img style="filter: invert(100%)" class="d-block mx-auto mb-4" src="{{ asset('images/logo.png') }}" alt="" width="150">
    </div>

    <div class="row">
      <div class="col-md-5 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Produtos</span>
          <span class="badge badge-secondary badge-pill">
            <i class="bi bi-cart-fill"></i> 3
          </span>
        </h4>
        <form class="card p-2 mb-2" action="{{ asset('api/cliente') }}" method="POST">
          @csrf
          <div class="input-group">
            <input type="text" class="form-control autocomplete" placeholder="Pesquisar" name="procurar">
          </div>
          <select name="produto" id="produto">

          </select>
          <div class="input-group-append">
            <button type="button" class="btn btn-secondary" id="adicionarProduto">Adicionar</button>
          </div>
        </form>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">Third item</h6>
              <small class="text-muted">Brief description</small>
            </div>
            <span class="text-muted">R$ 5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (R$)</span>
            <strong>R$ 20</strong>
          </li>
        </ul>

      </div>
      <div class="col-md-7 order-md-1">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Cliente</span>
          <span class="badge badge-warning badge-pill">
            <i class="bi bi-info-circle-fill"></i>
            Opcional
          </span>
        </h4>
        <form class="needs-validation" novalidate>
          <div class="row">
            <div class="col-md-7 mb-3">
              <label for="firstName">Nome</label>
              <input type="text" class="form-control" id="firstName">
            </div>
            <div class="col-md-5 mb-3">
              <label for="lastName">CPF/CNPJ</label>
              <input type="text" class="form-control" id="lastName">
            </div>
          </div>

          <hr class="mb-4">

          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Forma de pagamento</span>
            <span class="badge badge-danger badge-pill">
              <i class="bi bi-exclamation-circle-fill"></i>
              Obrigatório
            </span>
          </h4>

          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input
                id="paypal"
                name="paymentMethod"
                type="radio"
                class="custom-control-input"
                value="Dinheiro"
                checked
                required
              >
              <label class="custom-control-label" for="paypal">Dinheiro</label>
            </div>
            <div class="custom-control custom-radio">
              <input
                id="credit"
                name="paymentMethod"
                type="radio"
                class="custom-control-input"
                value="Cartão de credito"
                required
              >
              <label class="custom-control-label" for="credit">Cartão de credito</label>
            </div>
            <div class="custom-control custom-radio">
              <input
                id="debit"
                name="paymentMethod"
                type="radio"
                class="custom-control-input"
                value="Cartão de debito"
                required
              >
              <label class="custom-control-label" for="debit">Cartão de debito</label>
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Finalizar venda</button>
        </form>
      </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2017-2021 Company Name</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/form-validation.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="{{ asset('js/pdv.js') }}"></script>
</body>

</html>
