<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#563d7c">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/pdv.css') }}">
</head>

<body class="bg-light">
  <div id="caixa-aberto" class="text-center text-white">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <main role="main" class="inner cover">
        <h1 class="cover-heading mb-3">CAIXA LIVRE</h1>
        <label for="empresas">Selecione a empresa</label>
        <select class="form-control mb-5" id="empresas">
          @foreach ($empresas as $empresa)
            <option value="{{ $empresa->contextos()->where('tipo', 'e')->first()->id }}">
              {{ $empresa->nome }}
            </option>
          @endforeach
        </select>
        <p class="lead">
          <a href="{{ route('home') }}" class="btn btn-lg btn-success text-uppercase">
            <i class="bi bi-arrow-return-left"></i>
          </a>
          <a href="#" id="abrir-caixa" class="btn btn-lg btn-success text-uppercase">
            Abrir caixa
          </a>
        </p>
      </main>
    </div>
  </div>

  <div class="container-xl">
    <div class="py-5 text-center">
      <h1><a href="{{ route('home') }}" class="text-muted">PDV</a></h1>
    </div>

    @yield('content')

    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2021 PDV Online</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a data-toggle="modal" data-target="#atalhos" href="#">Atalhos</a></li>
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

  <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
