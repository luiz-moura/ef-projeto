<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="theme-color" content="#563d7c">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link rel="stylesheet" href="https://getbootstrap.com/docs/4.6/examples/blog/blog.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="{{ asset('styles/app.css') }}">
</head>
<body>
  <div class="container">
    <header class="blog-header py-3">
      <div class="row flex-nowrap justify-content-between align-items-center">
        <div class="col-4">
          <a class="blog-header-logo text-dark" href="{{ route('home') }}">GERENCIAL</a>
        </div>
        <div class="col-4 text-center">
          <a class="text-muted" href="{{ route('home') }}">
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
          <a class="p-2 text-muted" href="{{ route('lancamentos.index') }}">
            <i class="bi bi-clipboard-data"></i> Lançamentos
          </a>
          <a class="p-2 text-muted" href="{{ route('produtos.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434L7.752.066ZM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567L4.25 7.504ZM7.5 9.933l-2.75 1.571v3.134l2.75-1.571V9.933Zm1 3.134 2.75 1.571v-3.134L8.5 9.933v3.134Zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567-2.742 1.567Zm2.242-2.433V3.504L8.5 5.076V8.21l2.75-1.572ZM7.5 8.21V5.076L4.75 3.504v3.134L7.5 8.21ZM5.258 2.643 8 4.21l2.742-1.567L8 1.076 5.258 2.643ZM15 9.933l-2.75 1.571v3.134L15 13.067V9.933ZM3.75 14.638v-3.134L1 9.933v3.134l2.75 1.571Z"/>
            </svg> Produtos
          </a>
          <a class="p-2 text-muted" href="{{ route('categorias.index') }}">
            <i class="bi bi-bookmark-fill"></i> Categorias
          </a>
        </div>
        <div class="nav d-flex">
          <a class="p-2 text-muted" href="{{ route('vendas-simples') }}">
            <i class="bi bi-bar-chart-line-fill"></i> Relatório de vendas simples
          </a>
          <a class="p-2 text-muted" href="{{ route('vendas-detalhada') }}">
            <i class="bi bi-bar-chart-line-fill"></i> Relatório de vendas detalhada
          </a>
          <a class="p-2 text-muted" href="{{ route('relatorio-posicoes') }}">
            <i class="bi bi-bar-chart-line-fill"></i> Relatório de posição de estoque
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

  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
  <script src="{{ asset('js/dashboard.js') }}"></script>
  <script src="{{ asset('js/lancamento.js') }}"></script>

  @if (Route::is('home'))
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
