<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#563d7c">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('styles/app.css') }}">
</head>

<body class="bg-light">

  <div id="caixa-aberto" class="text-center text-white">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <main role="main" class="inner cover">
        <h1 class="cover-heading mb-5">CAIXA ABERTO</h1>
        <p class="lead">
          <a href="#" id="abrir-caixa" class="btn btn-lg btn-secondary">Iniciar venda</a>
        </p>
      </main>
    </div>
  </div>

  <div class="container-xl">
    <div class="py-5 text-center">
      <a href="{{ route('home') }}">
        <img style="filter: invert(100%)" class="d-block mx-auto mb-4" src="{{ asset('images/logo.png') }}" alt="Eficiência Fiscal" width="150">
      </a>
    </div>

    @yield('content')

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2021 PDV Online</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a data-toggle="modal"  data-target="#atalhos" href="#">Atalhos</a></li>
        <li class="list-inline-item"><a href="#">Suporte</a></li>
      </ul>
    </footer>
  </div>

  <x-modal target="atalhos" cancel_button="no">
    <x-slot name="title">Teclas de atalho</x-slot>
    <x-slot name="message">
      <kbd>+</kbd> Foca no campo de pesquisar produto<br/>
      <kbd>F9</kbd> Finaliza a venda<br/>
      <kbd>Enter</kbd> Confirma operação<br/>
    </x-slot>
  </x-modal>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://getbootstrap.com/docs/4.6/examples/checkout/form-validation.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="{{ asset('js/pdv.js') }}"></script>
</body>

</html>
