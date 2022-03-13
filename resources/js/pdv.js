const instance = axios.create({
  baseURL: `${window.location.origin}/api`
});

$(document).ready(function() {
  /**
   * ELEMENTOS DA DOM
   */
  let $clienteNome = $('#cliente_nome');
  let $cpfCnpj = $('#cpf_cnpj');
  let $estado = $('#estado');
  let $cidade = $('#cidade');

  let $inputClienteNome = $('#cliente_nome_pesquisa');
  let $listaClientes = $('#cliente_lista');
  let $confirmarClienteBtn = $('#confirmar_cliente');

  let $inputProduto = $('#pesquisar_produto');
  let $listaProdutos = $('#produtos');
  let $produtosAdicionados = $('#adicionados');
  let $quantidadeTotalProdutos = $('#quantidade');
  let $quantidadeProduto = $('#quantidade_produto');
  let $adicionarProduto = $('#adicionar_produto');

  let $formMain = $('form#main');
  let $valorVenda = $('#valor_venda');
  let $pagamentoDinheiro = $('#dinheiro');
  let $finalizarVenda = $('#finalizar_venda');

  let $modalVenda = $('#venda');
  let $modalAtalhos = $('#atalhos');
  let $confirmButton = $('.confirm_btn_modal');
  let $toast = $('.toast');

  let $caixaAberto = $('#caixa-aberto');
  let $abrirCaixa = $('#abrir-caixa');
  let $empresa = $('#empresas');

  const resetar = function () {
    $listaProdutos.html('');
    $clienteNome.val('');
    $cpfCnpj.val('');
    $cpfCnpj.data('fields', { id: null});
    $estado.val('');
    $cidade.val('');
    $produtosAdicionados.html('');
    $listaProdutos.html('');
    $inputProduto.val('');
    $pagamentoDinheiro.prop("checked", true);
    $quantidadeProduto.val(1);
    $valorVenda.html(0);
    $quantidadeTotalProdutos.html(0);
  }

  // INIT
  resetar();

  // Retorna a quantidade geral de produtos
  function totalProdutos() {
    let total = 0;

    $produtosAdicionados.children('li').each(function () {
      total += parseFloat($(this).data('fields').quantidade);
    })

    return total;
  }

  function totalValor() {
    let total = 0;

    $produtosAdicionados.children('li').each(function () {
      let { valor_venda, quantidade } = $(this).data('fields')
      total += parseFloat(valor_venda) * quantidade;
    })

    return total;
  }

  $(document).keyup(function (e) {
    switch (e.key) {
      case '+':
        $inputProduto.val('');
        $inputProduto.focus();
        break;
      case 'F9':
        $finalizarVenda.click();
        break;
      case 'Enter':
        $confirmButton.click();
        break;
    }
  });

  /**
   * Remove produto da lista
   * Atualiza quantidade total da venda
   * Atualiza valor total da venda
   */
  $('body').on('click', '.remover_produto', function () {
    $(this).parent('li').remove();

    $quantidadeTotalProdutos.html(totalProdutos());
    $valorVenda.html(totalValor());
  });

  /**
   * Adiciona produto na lista
   * Atualiza a quantidade total da venda
   * Atualiza valor total da venda
   */
   $adicionarProduto.on('click', function () {
    if ($listaProdutos.val() == null) {
      $toast.toast('show');
      return;
    }

    let quantidade = parseFloat($quantidadeProduto.val());
    console.log(quantidade);

    if (!Number.isInteger(quantidade) || quantidade < 1) {
      $toast.toast('show');
      return;
    }

    let produto = $listaProdutos.find(':selected').data('fields');

    $li = $('<li>', {
      class: "list-group-item d-flex justify-content-between lh-condensed",
    });

    $('<span>', {
      class: 'remover_produto'
    })
      .append('<i class="bi bi-x-circle"></i>')
      .appendTo($li);

    let $general = $('<div>', {
      class: 'custom'
    }).appendTo($li);

    $('<h6>', {
      class: 'my-0',
      text: produto.nome
    }).appendTo($general);

    $('<small>', {
      class: 'text-muted',
      text: `Quantidade: ${$quantidadeProduto.val()}`
    }).appendTo($general);

    $('<span>', {
      class: 'text-muted',
      text: `R$ ${parseFloat(produto.valor_venda) * quantidade}`
    }).appendTo($li);

    $li.data('fields', {
      ...produto,
      quantidade,
    });

    $produtosAdicionados.append($li);
    $quantidadeTotalProdutos.html(totalProdutos());
    $valorVenda.html(totalValor());
  });

  /**
   *
   * CONSULTAS
   *
   */
  $inputProduto.change(function () {
    if ($(this).val() == '') return;

    $listaProdutos.append('<option disabled>Procurando...</option>');

    instance.get('produtos', {
      params: { search: $(this).val() }
    })
      .then(function ({ data }) {
        $listaProdutos.html('');

        data.data.forEach(function (item) {
          $('<option>', {
            value: item.id,
            text: item.nome,
          }).data('fields', item).appendTo($listaProdutos);
        });

        $listaProdutos.focus();
      });
  });

  // Consulta cliente por cfp_cnpj
  $cpfCnpj.change(function () {
    if ($cpfCnpj.val() == '') {
      $clienteNome.val('');
      $estado.val('');
      $cidade.val('');
      return;
    }

    instance.get(`cliente/${$cpfCnpj.val()}`)
      .then(({ data }) => {
        let { nome, estado, cidade } = data.data;

        $cpfCnpj.data('fields', data.data);
        $clienteNome.val(nome);
        $estado.val(estado);
        $cidade.val(cidade);
      })
      .catch(error => {
        $cpfCnpj.val('');
        $clienteNome.val('');
        $estado.val('');
        $cidade.val('');
      })
  });

  $inputClienteNome.change(function () {
    if ($(this).val() == '') {
      $listaClientes.html('');
      $listaClientes.hide();
      $confirmarClienteBtn.hide();
      return;
    }

    instance.get('cliente', {
      params: { nome: $(this).val() }
    })
      .then(({ data }) => {
        $listaClientes.html('');
        if (data.data.length == 0) return;

        data.data.forEach(function (item) {
          $('<option>', {
            value: item.id,
            text: item.nome
          }).data('fields', item).appendTo($listaClientes);
        });

        $listaClientes.show();
        $confirmarClienteBtn.show();
        $listaClientes.focus();
      })
  });

  $confirmarClienteBtn.click(function () {
    let cliente = $listaClientes.find(':selected').data('fields');

    $cpfCnpj.val(cliente.cpf_cnpj).data('fields', cliente);
    $clienteNome.val(cliente.nome);
    $estado.val(cliente.estado);
    $cidade.val(cliente.cidade);

    $confirmarClienteBtn.hide();
    $listaClientes.hide();
    $inputClienteNome.val('');
  });

  $finalizarVenda.click(function () {
    if (totalProdutos() < 1) {
      $toast.toast('show');
      return;
    }

    let forma_pagamento = $("input[name='payment_method']:checked").val();

    let produtos = $produtosAdicionados.children('li').map(function () {
      return $(this).data('fields');
    }).toArray();

    let data = {
      empresa_id: $empresa.val(),
      contexto_id: $cpfCnpj.data('fields').contexto_id,
      forma_pagamento,
      produtos,
    }

    instance.post('venda/store/', data)
      .then(() => {
        $modalVenda.modal('show');
        resetar();
      });
  });

  $modalVenda.on('hidden.bs.modal', function () {
    $caixaAberto.show();
  });

  $confirmButton.click(function () {
    $modalVenda.modal('hide');
    $modalAtalhos.modal('hide');
  });

  $abrirCaixa.click(function () {
    $caixaAberto.hide();
  });

  $formMain.submit(function(event) {
    event.preventDefault();
  });
});
