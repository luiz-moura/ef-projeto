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
    <div class="nav-scroller py-1 mb-4">
      <nav class="nav d-flex">
        <a class="p-2 text-muted" href="{{ route('clientes.index') }}">
          <i class="bi bi-person-lines-fill"></i> Clientes
        </a>
        <a class="p-2 text-muted" href="#">
          <i class="bi bi-truck"></i> Fornecedores
        </a>
        <a class="p-2 text-muted" href="#">
          <i class="bi bi-people-fill"></i> Funcionarios
        </a>
        <a class="p-2 text-muted" href="#">
          <i class="bi bi-shop-window"></i> Empresas
        </a>
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
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>
    window.jQuery || document.write('<script src="/docs/4.6/assets/js/vendor/jquery.slim.min.js"><\/script>')
  </script>
  <script src="https://getbootstrap.com/docs/4.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <script src="{{ asset('jquery.cpfcnpj.min.js') }}"></script>

  <script>
    function validaCpfCnpj(val) {
    if (val.length == 14) {
        var cpf = val.trim();

        cpf = cpf.replace(/\./g, '');
        cpf = cpf.replace('-', '');
        cpf = cpf.split('');

        var v1 = 0;
        var v2 = 0;
        var aux = false;

        for (var i = 1; cpf.length > i; i++) {
            if (cpf[i - 1] != cpf[i]) {
                aux = true;
            }
        }

        if (aux == false) {
            return false;
        }

        for (var i = 0, p = 10; (cpf.length - 2) > i; i++, p--) {
            v1 += cpf[i] * p;
        }

        v1 = ((v1 * 10) % 11);

        if (v1 == 10) {
            v1 = 0;
        }

        if (v1 != cpf[9]) {
            return false;
        }

        for (var i = 0, p = 11; (cpf.length - 1) > i; i++, p--) {
            v2 += cpf[i] * p;
        }

        v2 = ((v2 * 10) % 11);

        if (v2 == 10) {
            v2 = 0;
        }

        if (v2 != cpf[10]) {
            return false;
        } else {
            return true;
        }
    } else if (val.length == 18) {
        var cnpj = val.trim();

        cnpj = cnpj.replace(/\./g, '');
        cnpj = cnpj.replace('-', '');
        cnpj = cnpj.replace('/', '');
        cnpj = cnpj.split('');

        var v1 = 0;
        var v2 = 0;
        var aux = false;

        for (var i = 1; cnpj.length > i; i++) {
            if (cnpj[i - 1] != cnpj[i]) {
                aux = true;
            }
        }

        if (aux == false) {
            return false;
        }

        for (var i = 0, p1 = 5, p2 = 13; (cnpj.length - 2) > i; i++, p1--, p2--) {
            if (p1 >= 2) {
                v1 += cnpj[i] * p1;
            } else {
                v1 += cnpj[i] * p2;
            }
        }

        v1 = (v1 % 11);

        if (v1 < 2) {
            v1 = 0;
        } else {
            v1 = (11 - v1);
        }

        if (v1 != cnpj[12]) {
            return false;
        }

        for (var i = 0, p1 = 6, p2 = 14; (cnpj.length - 1) > i; i++, p1--, p2--) {
            if (p1 >= 2) {
                v2 += cnpj[i] * p1;
            } else {
                v2 += cnpj[i] * p2;
            }
        }

        v2 = (v2 % 11);

        if (v2 < 2) {
            v2 = 0;
        } else {
            v2 = (11 - v2);
        }

        if (v2 != cnpj[13]) {
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
 }
  </script>

  <script>
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // fetch all the forms we want to apply custom style
        var inputs = document.getElementsByClassName('form-control')

        // loop over each input and watch blur event
        var validation = Array.prototype.filter.call(inputs, function(input) {

          input.addEventListener('blur', function(event) {
            // reset
            input.classList.remove('is-invalid')
            input.classList.remove('is-valid')

            if (
              input.checkValidity() === false
              || (input.id == 'cpf_cnpj' && validaCpfCnpj($("#cpf_cnpj").val()) == false)
            ) {
              input.classList.add('is-invalid')
              event.preventDefault();
              event.stopPropagation();
            } else {
              input.classList.add('is-valid')
            }
          }, false);
        });
      }, false);
    })();
  </script>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (
          form.checkValidity() === false
          || (form.id == 'cpf_cnpj' && validaCpfCnpj($("#cpf_cnpj").val()) == false)
        ) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

  <script>
    $('button[name="delete"]').on('click', function(e) {
      var $form = $(this).closest('form');

      e.preventDefault();

      $('#delete').modal({
          backdrop: 'static',
          keyboard: false
        })
        .on('click', '#confirm', function(e) {
          $form.trigger('submit');
        });

      $("#cancel").on('click', function(e) {
        e.preventDefault();
        $('#confirm').modal.model('hide');
      });
    });
  </script>
</body>

</html>
