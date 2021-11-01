const instance = axios.create({
  baseURL: 'http://localhost:8000/api'
});

let venda = {
  empresa_id: 18,
  cliente: {
    id: null,
  },
  forma_pagamento: 'Dinheiro',
  produtos: [],

  produtosConsulta: [],
  clientesConsulta: [],
};

$(document).ready(function() {
  let $clienteNome = $('#cliente_nome');
  let $cpfCnpj = $('#cpf_cnpj');
  let $estado = $('#estado');
  let $cidade = $('#cidade');

  let $procurarClienteNome = $('#procurar_cliente_nome');
  let $listaClientes = $('#cliente_lista');
  let $confirmarClienteBtn = $('#confirmar_cliente');

  let $produtosAdicionados = $('#adicionados');
  let $quantidadeProdutos = $('#quantidade');
  let $quantidadeProduto = $('#quantidade_produto');
  let $procurarProduto = $('#procurar');
  let $listaProdutos = $('#produtos');

  let $formMain = $('form#main');
  let $valorVenda = $('#valor_total');
  let $pagamentoDinheiro = $('#dinheiro');
  let $finalizarVenda = $('#finalizar_venda');

  let $modalVenda = $('#venda');
  let $modalAtalhos = $('#atalhos');
  let $confirmButton = $('.confirm_btn_modal');
  let $toast = $('.toast');

  let $caixaAberto = $('#caixa-aberto');

  /**
   *
   */

  const resetar = function () {
    venda = {
      empresa_id: 18,
      cliente: {
        id: null,
      },
      forma_pagamento: 'Dinheiro',
      produtos: [],

      produtosConsulta: [],
      clientesConsulta: [],
    };

    $quantidadeProdutos.html(totalProdutos());
    $valorVenda.html(totalValor());
    $listaProdutos.html('');
    $clienteNome.val('');
    $cpfCnpj.val('');
    $estado.val('');
    $cidade.val('');
    $produtosAdicionados.html('');
    $listaProdutos.html('');
    $procurarProduto.val('');
    $quantidadeProduto.val(1);
    $pagamentoDinheiro.prop("checked", true);
  }

  // Preenche a quantidade e valor na DOM
  $quantidadeProdutos.html(totalProdutos());
  $valorVenda.html(totalValor());

  // Altera a forma de pagamento do objeto
  $("input[name='payment_method']").change(function () {
    venda.forma_pagamento = $(this).val();
  });

  // Remove produto do objeto e da lista (DOM)
  $('body').on('click', '.remover_produto', function () {
    let hash = $(this).attr('data-target');

    pos = venda.produtos.map(function(e) { return e.hash; });
    let index = pos.indexOf(hash);
    venda.produtos.splice(index, 1);

    $(this).parent().remove();

    $quantidadeProdutos.html(totalProdutos());
    $valorVenda.html(totalValor());
  });

  // Adiciona produto no objeto e na lista (também atualiza a quantidade na DOM)
  $('body').on('click', '#adicionar_produto', function () {
    if ($listaProdutos.val() == null) {
      $toast.toast('show');
      return;
    }

    let quantidade = parseInt($quantidadeProduto.val());
    if (!Number.isInteger(quantidade) || quantidade < 1) {
      $toast.toast('show');
      return;
    }

    let id = parseInt($listaProdutos.val());

    pos = venda.produtosConsulta.map(function(e) { return e.id; });
    let index = pos.indexOf(id);

    let produto = venda.produtosConsulta[index];
    produto.hash = Math.random();
    produto.quantidade = quantidade;

    venda.produtos.push(produto);

    let li = `
      <li class="list-group-item d-flex justify-content-between lh-condensed">
        <span class="remover_produto" data-target="${produto.hash}">
          <i class="bi bi-x-circle"></i>
        </span>
        <div>
          <h6 class="my-0">${produto.nome}</h6>
          <small class="text-muted">Quantidade: ${produto.quantidade}</small>
        </div>
        <span class="text-muted">R$ ${parseInt(produto.valor_venda) * produto.quantidade}</span>
      </li>
    `;

    $produtosAdicionados.append(li);
    $quantidadeProdutos.html(totalProdutos());
    $valorVenda.html(totalValor());
  });

  // Retorna a quantidade geral de produtos
  function totalProdutos() {
    let total = 0;
    jQuery.each(venda.produtos, function (i, val) {
      total += parseFloat(val.quantidade);
    });
    return total;
  }

  function totalValor() {
    let total = 0;
    jQuery.each(venda.produtos, function (i, val) {
      total += parseFloat(val.valor_venda) * val.quantidade;
    });
    return total;
  }

  // Foca no campo de pesquisar produtos
  $(document).keyup(function (e) {
    if ((e.key).toLowerCase() === '+') {
      $procurarProduto.val('');
      $procurarProduto.focus();
    } else if (e.key === 'F9') {
      $finalizarVenda.click();
    } else if (e.key == 'Enter') {
      $confirmButton.click();
    }
  });

  /**
   *
   * CONSULTAS
   *
   */

  $procurarProduto.change(function () {
    if ($procurarProduto.val() == '') return;

    $listaProdutos.append('<option disabled>Procurando...</option>');
    instance.post('produtos', {
      nome: $procurarProduto.val()
    })
      .then(function (response) {
        $listaProdutos.html('');
        venda.produtosConsulta = response.data.data;
        venda.produtosConsulta.forEach(function (item) {
          let option = `<option value="${item.id}">${item.nome}</option>`;
          $listaProdutos.append(option);
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
      venda.cliente = {
        id: null,
      };
      return;
    }

    instance.get(`cliente/${$cpfCnpj.val()}`)
      .then((response) => {
        let cliente = { id, nome, estado, cidade } = response.data.data;
        venda.cliente = cliente;
        $clienteNome.val(nome);
        $estado.val(estado);
        $cidade.val(cidade);
      })
      .catch(error => {
        $clienteNome.val('');
        $cpfCnpj.val('');
      })
  });

  $procurarClienteNome.change(function () {
    if ($procurarClienteNome.val() == '') {
      $listaClientes.html('');
      $listaClientes.hide();
      $confirmarClienteBtn.hide();
      return;
    }

    instance.post(`cliente`, {
      nome: $procurarClienteNome.val()
    })
      .then((response) => {
        $listaClientes.html('');

        let clientes = response.data.data;
        if (clientes.length == 0) return;

        venda.clientesConsulta = clientes;
        venda.clientesConsulta.forEach(function (item) {
          let $option = `<option value="${item.id}">${item.nome}</option>`;
          $listaClientes.append($option);
        });

        $listaClientes.show();
        $confirmarClienteBtn.show();
        $listaClientes.focus();
      })
  });

  $confirmarClienteBtn.click(function () {
    let id = parseInt($listaClientes.val());

    pos = venda.clientesConsulta.map(function(e) { return e.id; });
    let index = pos.indexOf(id);
    let meuCliente = venda.clientesConsulta[index];

    $clienteNome.val(meuCliente.nome);
    $cpfCnpj.val(meuCliente.cpf_cnpj);
    $estado.val(meuCliente.estado);
    $cidade.val(meuCliente.cidade);

    venda.cliente = meuCliente;

    $confirmarClienteBtn.hide();
    $listaClientes.hide();
    $procurarClienteNome.val('');
  });

  $finalizarVenda.click(function () {
    if (totalProdutos() < 1) {
      $toast.toast('show');
      return;
    }

    let data = {
      empresa_id: venda.empresa_id,
      contexto_id: venda.cliente.id,
      produtos: venda.produtos
    }

    instance.post('venda/store/', data)
      .then((response) => {
        $modalVenda.modal('show');
        resetar();
      });
  });

  $modalVenda.on('hidden.bs.modal', function (event) {
    $caixaAberto.show();
  })

  $confirmButton.click(function () {
    $modalVenda.modal('hide');
    $modalAtalhos.modal('hide');
  })

  $formMain.submit(function(event) {
    event.preventDefault();
  })

  // document.querySelector('body').addEventListener('keydown', function(event) {
  //     console.log( event.keyCode );
  // });

  $('#abrir-caixa').click(function () {
    $caixaAberto.hide();
  })
});
