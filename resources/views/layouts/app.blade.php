<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="theme-color" content="#563d7c">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
  <!-- <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link href="https://getbootstrap.com/docs/4.6/examples/blog/blog.css" rel="stylesheet">
  <link href="{{ asset('styles/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
</head>
<body>
  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4">
          <a class="blog-header-logo text-dark" href="#">GERENCIAL</a>
        </div>
        <div class="col-4 text-center">
          <a class="text-muted" href="#">
            <img style="filter: invert(1);" height="55px" src="{{ asset('images/logo.png') }}" alt="Eficiência Fiscal">
          </a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="btn btn-sm btn-outline-secondary" href="#">Sobre</a>
        </div>
      </div>
    </header>
    <div class="nav-scroller py-1 mb-4">
      <nav>
        <div class="nav d-flex">
          <a class="p-2 text-muted" href="{{ route('pessoas.index') }}">
            <i class="bi bi-person-lines-fill"></i> Pessoas
          </a>
          <a class="p-2 text-muted" href="{{ route('clientes.index') }}">
            <i class="bi bi-person-lines-fill"></i> Clientes
          </a>
          <a class="p-2 text-muted" href="{{ route('fornecedores.index') }}">
            <i class="bi bi-truck"></i> Fornecedores
          </a>
          <a class="p-2 text-muted" href="{{ route('funcionarios.index') }}">
            <i class="bi bi-people-fill"></i> Funcionarios
          </a>
          <a class="p-2 text-muted" href="{{ route('empresas.index') }}">
            <i class="bi bi-shop-window"></i> Minhas Empresas
          </a>
        </div>
        <div class="nav d-flex">
          <a class="p-2 text-muted" href="{{ route('vendas') }}">
            <i class="bi bi-handbag-fill"></i> Venda (PDV)
          </a>
          <a class="p-2 text-muted" href="{{ route('produtos.index') }}">
            <i class="bi bi-handbag-fill"></i> Lançamentos
          </a>
          <a class="p-2 text-muted" href="{{ route('produtos.index') }}">
            <i class="bi bi-handbag-fill"></i> Produtos
          </a>
          <a class="p-2 text-muted" href="{{ route('categorias.index') }}">
            <i class="bi bi-bookmark-fill"></i> Categorias
          </a>
        </div>
      </nav>
    </div>
  </div>

  <main role="main" class="container">
    <div class="row">
      <div class="col-md-12 blog-main mb-5">
        @yield('content')
      </div><!-- /.blog-main -->
    </div><!-- /.row -->
  </main><!-- /.container -->

  <footer class="blog-footer">
    <p>Desenvolvido por <a href="mailto:luizhom@outlook.com">Luiz Moura</a> 🤓.</p>
    <p>
      <a href="#"><i class="bi bi-hand-index-thumb-fill"></i></a>
    </p>
    <p>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>window.jQuery</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="{{ asset('js/jquery.mask.js') }}"></script>
  <script src="{{ asset('js/money-validate.js') }}"></script>
  <script src="{{ asset('js/form-validate.js') }}"></script>
  <script src="{{ asset('js/delete-validate.js') }}"></script>
</body>
</html>
