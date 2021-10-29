const instance = axios.create({
  baseURL: 'http://localhost:8000/api'
});

const venda = {
  empresa: 1,
  cliente: null,
  forma_pagamento: 'Dinheiro',
  produtos: [],

  produtosConsulta: [],
  clientesConsulta: [],
};

$(document).ready(function() {
  let $produtosCliente = $('#adicionados');
  let $procurarCliente = $("#procurar_cliente");
  let $cliente_nome = $('#cliente_nome');
  let $cpf_cnpj = $('#cpf_cnpj');
  let $estado = $('#estado');
  let $cidade = $('#cidade');

  let $quantidadeProdutos = $('#quantidade');
  let $procurarProduto = $('#procurar');
  let $listaProdutos = $('#produtos');

  let $valorVenda = $("#valor_total");

  // Preenche a quantidade e valor na DOM
  $quantidadeProdutos.html(totalProdutos());
  $valorVenda.html(totalValor());

  // Altera a forma de pagamento do objeto
  $("input[name='payment_method']").change(function () {
    venda.forma_pagamento = $(this).val();
  });

  // Remove produto do objeto e lista (DOM)
  $("body").on("click", ".remover_produto", function () {
    let hash = $(this).attr('data-target');

    pos = venda.produtos.map(function(e) { return e.hash; });
    let index = pos.indexOf(hash);
    venda.produtos.splice(index, 1);
    // delete venda.produtos[index];
    // delete venda.produtos[hash]

    $(this).parent().remove();
    $quantidadeProdutos.html(totalProdutos());
    $valorVenda.html(totalValor());
  });

  // Adiciona produto no objeto e na lista (também atualiza a quantidade na DOM)
  $("body").on("click", "#adicionar_produto", function () {
    if ($listaProdutos.val() == null) {
      $('.toast').toast('show');
      return;
    }

    let id = parseInt($listaProdutos.val());
    let quantidade = parseInt($('#quantidade_produto').val());
    let hash = Math.random();

    pos = venda.produtosConsulta.map(function(e) { return e.id; });

    let index = pos.indexOf(id);

    let produto = venda.produtosConsulta[index];
    produto.hash = hash;
    produto.quantidade = quantidade;

    // venda.produtos[hash] = (produto)
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

    $produtosCliente.append(li);
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
    if ((e.key).toLowerCase() === "p") {
      $procurarProduto.focus();
    }
  });

  /**
   *
   * CONSULTAS
   *
   */

  // Consultas produtos
  $procurarProduto.change(function () {
    if ($procurarProduto.val() == "") return;

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
  $procurarCliente.submit(function (event) {
    event.preventDefault();

    if ($cpf_cnpj.val() == "") {
      $cliente_nome.val('');
      $estado.val('');
      $cidade.val('');
      venda.cliente = null;
      return;
    }

    instance.get(`cliente/${$cpf_cnpj.val()}`)
      .then((response) => {
        let { id, nome, cpf_cnpj, estado, cidade } = response.data.data;
        // venda.cliente = cpf_cnpj
        venda.cliente = id;
        $cliente_nome.val(nome);
        $estado.val(estado);
        $cidade.val(cidade);
      })
      .catch(error => {
        $cliente_nome.val('');
        $cpf_cnpj.val('');
      })
  });

  // Consulta pessoa por nome
  let $procurar_cliente_nome = $('#procurar_cliente_nome');
  let $cliente_lista = $('#cliente_lista');
  let $confirmar_cliente = $('#confirmar_cliente');

  $procurar_cliente_nome.change(function () {
    if ($procurar_cliente_nome.val() == "") {
      $cliente_lista.html('');
      $cliente_lista.hide();
      $confirmar_cliente.hide();
      return;
    }

    instance.post(`cliente`, {
      nome: $procurar_cliente_nome.val()
    })
      .then((response) => {
        $cliente_lista.html('');

        let clientes = response.data.data;
        if (clientes.length == 0) return;

        venda.clientesConsulta = clientes;
        venda.clientesConsulta.forEach(function (item) {
          let $option = `<option value="${item.id}">${item.nome}</option>`;
          $cliente_lista.append($option);
        });

        $cliente_lista.show();
        $confirmar_cliente.show();
        $cliente_lista.focus();
      })
  });

  // Cofirmar cliente
  $confirmar_cliente.click(function () {
    let id = parseInt($cliente_lista.val());

    pos = venda.clientesConsulta.map(function(e) { return e.id; });
    let index = pos.indexOf(id);
    let meuCliente = venda.clientesConsulta[index];

    $cliente_nome.val(meuCliente.nome);
    $cpf_cnpj.val(meuCliente.cpf_cnpj);
    $estado.val(meuCliente.estado);
    $cidade.val(meuCliente.cidade);

    venda.cliente = meuCliente;

    $confirmar_cliente.hide();
    $cliente_lista.hide();
    $procurar_cliente_nome.val("");
  })
});
