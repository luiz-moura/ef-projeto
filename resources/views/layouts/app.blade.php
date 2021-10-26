<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title')</title>
  <meta name="theme-color" content="#563d7c">
  <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link href="https://getbootstrap.com/docs/4.6/examples/blog/blog.css" rel="stylesheet">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
  <title>@yield('title')</title>
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
            <img style="filter: invert(1);" height="55px" src="http://127.0.0.1:8000/logo.png" alt="Eficiência Fiscal">
          </a>
        </div>
        <div class="col-4 d-flex justify-content-end align-items-center">
          <a class="btn btn-sm btn-outline-secondary" href="#">Sobre</a>
        </div>
      </div>
    </header>
    <div class="nav-scroller py-1 mb-5">
      <nav class="nav d-flex">
        <a class="p-2 text-muted" href="#"><i class="bi bi-person-lines-fill"></i> Clientes</a>
        <a class="p-2 text-muted" href="#"><i class="bi bi-shop-window"></i> Empresas</a>
        <a class="p-2 text-muted" href="#"><i class="bi bi-people-fill"></i> Funcionarios</a>
        <a class="p-2 text-muted" href="#"><i class="bi bi-truck"></i> Fornecedores</a>
      </nav>
    </div>
  </div>

  <main role="main" class="container">
    <div class="row">
      <div class="col-md-12 blog-main mb-5">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
          @yield('title')
        </h3>
        @yield('content')
      </div><!-- /.blog-main -->
    </div><!-- /.row -->
  </main><!-- /.container -->

  <footer class="blog-footer">
    <p>Desenvolvido por <a href="mailto:luizhom@outlook.com">Luiz Moura</a> 🤓.</p>
    <p>
      <a href="#">👆</a>
    </p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.6/assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="/docs/4.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script>
    // JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
</body>

</html>
