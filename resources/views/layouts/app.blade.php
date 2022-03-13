<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="theme-color" content="#563d7c">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
</head>
<body>
  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4">
          <a class="blog-header-logo text-dark" href="{{ route('home') }}">GERENCIAL</a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="btn btn-sm btn-outline-secondary" href="#">Sobre</a>
        </div>
      </div>
    </header>
    <nav class="mb-4">
      <div class="nav d-flex pb-0">
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
      <div class="nav d-flex pb-0">
        <a class="p-2 text-muted" href="{{ route('vendas') }}">
          <i class="bi bi-handbag-fill"></i> Venda (PDV)
        </a>
        <a class="p-2 text-muted" href="{{ route('lancamentos.index') }}">
          <i class="bi bi-signpost-split-fill"></i> Lançamentos de produtos
        </a>
        <a class="p-2 text-muted" href="{{ route('produtos.index') }}">
          <i class="bi bi-box"></i> Produtos
        </a>
        <a class="p-2 text-muted" href="{{ route('categorias.index') }}">
          <i class="bi bi-bookmark-fill"></i> Categorias
        </a>
        <div class="dropdown p-2">
          <a class="dropdown-toggle text-muted" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-pie-chart-fill"></i>
            Relatórios
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="{{ route('vendas-simples') }}">Relatório de vendas simples</a>
            <a class="dropdown-item" href="{{ route('vendas-detalhada') }}">Relatório de vendas detalhada</a>
            <a class="dropdown-item" href="{{ route('relatorio-posicoes') }}">Relatório de posição de estoque</a>
          </div>
        </div>
      </div>
    </nav>
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

  <script src="{{ asset('js/app.js') }}"></script>

  @if (Route::is('home'))
  <script>
    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?php echo $relVendas->pluck('nome') ?>,
        datasets: [{
          label: 'Vendas',
          data: <?php echo $relVendas->pluck('total') ?>,
          backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(75, 101, 132, 0.2)',
            'rgba(209, 216, 224, 0.2)',
            'rgba(235, 59, 90, 0.2)',
            'rgba(30, 39, 46, 0.2)',
          ],
          borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(75, 101, 132, 1)',
            'rgba(209, 216, 224, 1)',
            'rgba(235, 59, 90, 1)',
            'rgba(30, 39, 46, 1)',
          ],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
  @endif
</body>
</html>
