// VALIDACAO FORM
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

// DELETE MODAL
$('button[name="delete"], button[name="delete-produto"]').on('click', function(e) {
  var $form = $(this).closest('form');

  e.preventDefault();

  $modal = $(this).attr('name');

  $(`#${$modal}`).modal({
      backdrop: 'static',
      keyboard: false
    })
    .on('click', '.confirm_btn_modal', function(e) {
      $form.trigger('submit');
    });

  $("#cancel").on('click', function(e) {
    e.preventDefault();
    $('.confirm_btn_modal').modal.model('hide');
  });
});

// MASK
$(document).ready(function() {
  $cep = $('#cep');
  $cpf_cnpj = $('#cpf_cnpj');
  $money = $('.money');

  if ($money != undefined) {
    $money.mask('000.000.000.000.000,00', {reverse: true});
  }

  let options = {
    onKeyPress: function (cpf, ev, el, op) {
      let masks = ['000.000.000-000', '00.000.000/0000-00'];
      $cpf_cnpj.mask((cpf.length > 14) ? masks[1] : masks[0], op);
    }
  }

  if ($cpf_cnpj.val() != undefined) {
    $cpf_cnpj.val().length > 11
      ? $cpf_cnpj.mask('00.000.000/0000-00', options)
      : $cpf_cnpj.mask('000.000.000-00#', options);
  }

  if ($cep != undefined) {
    $cep.mask('00000-000');
  }

  $cep.change(function () {
    if ($(this).val() == '') return;

    axios.get(`http://viacep.com.br/ws/${$cep.val()}/json/`)
      .then(({ data }) => {
        $('#complemento').val(data.complemento);
        $('#rua').val(data.logradouro);
        $('#bairro').val(data.bairro);
        $('#cidade').val(data.localidade);
        $('#estado').val(data.uf);
      });
  });

  $('.submit-only-btn').each(function() {
    $(this).find('input').keypress(function(e) {
      // Enter pressed?
      if(e.which == 10 || e.which == 13) {
        e.preventDefault();
      }
    });
  });
});
