const instance = axios.create({
  baseURL: `${window.location.origin}/api`
});

$(document).ready(function() {
  let $nomeEmpresa = $('#nome_empresa');
  let $nomePessoa = $('#nome_pessoa');
  let $nomeProduto = $('#nome_produto');

  let $listaEmpresas = $('#lista-empresas');
  let $listaPessoas = $('#lista-pessoas');
  let $listaProdutos = $('#lista-produtos');

  let $empresa = $('#empresa');
  let $pessoa = $('#pessoa');
  let $produto = $('#produto');
  let $operacao = $('#operacao');

  let $quantidadeProd = $('#quantidade');
  let $produtosAdicionados = $('#produtos-adicionados');

  let $lancamentoModel = $('#lancamento');
  let $toast = $('.toast');

  /**
   * STEP 1
   *
   * Consulta e preenche select do modal (empresa, produto, pessoa)
   */
  $nomeEmpresa.on('change', function () {
    $listaEmpresas.html('');

    if ($(this).val() == '') return;

    instance.get('empresas', {
      params: { search: $(this).val() }
    })
      .then(({ data }) => {
        data.data.forEach((item) => {
          $('<option>', {
            value: item.id,
            text: item.nome,
          })
            .data('fields', item)
            .appendTo($listaEmpresas);
        });
      });
  });

  $nomePessoa.on('change', function () {
    $listaPessoas.html('');

    if ($(this).val() == '') return;

    instance.get('pessoas', {
      params: {
        search: $(this).val() ,
        operacao: $operacao.val(),
      }
    })
      .then(({ data }) => {
        data.data.forEach((item) => {
          $('<option>', {
            value: item.id,
            text: item.nome,
          })
            .data('fields', item)
            .appendTo($listaPessoas);
        });
      });
  });

  $nomeProduto.on('change', function () {
    $listaProdutos.html('');

    if ($(this).val() == '') return;

    instance.get('produtos', {
      params: { search: $(this).val() }
    })
      .then(({ data }) => {
        data.data.forEach((item) => {
          $('<option>', {
            value: item.id,
            text: item.nome,
          })
            .data('fields', item)
            .appendTo($listaProdutos);
        });
      });
  });

  /**
   * STEP 2
   *
   * Preenche a opção informada e fecha o modal de pesquisa
   */
   function confirmaOpcao({ $content, $lista }) {
    $content.html('');

    let $meuConteudo = $lista.find(':selected');

    if ($meuConteudo.val() == '' || $meuConteudo.val() == undefined) {
      return;
    }

    let content = $meuConteudo.data('fields');

    $('<option>', {
      value: content.id,
      text: content.nome,
    })
      .data('fields', content)
      .appendTo($content);
  }

  $('body').on('click', '.confirm_btn_modal:visible', function () {
    $modal = $(this).parent().parent().parent().parent();

    $id = $modal.attr('id').split('-')[0];
    $inputId = `#${$id.split('-')[0].slice(0, -1)}`;

    confirmaOpcao({
      $content: $($inputId),
      $lista: $(`#lista-${$id}`),
    });

    $modal.modal('hide');
  });

  /**
   * STEP 3
   *
   * Adiciona/remove produto da lista de produtos
   */
  $('body').on('click', '#add-produto-btn' , function () {
    $meuProduto = $listaProdutos.find(':selected');

    if ($meuProduto.val() == '' || $meuProduto.val() == undefined) {
      return;
    }

    let produto = $meuProduto.data('fields');
    let quantidade = $quantidadeProd.val();

    let item = `
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">${produto.nome}</h5>
        <div class="text-muted remove-prod-btn">
          <i class="bi bi-x-circle-fill"></i>
        </div>
      </div>
      <p class="mb-1">Quantidade: ${quantidade}</p>
      <p class="mb-1">Preço unitário: ${produto.valor_venda}</p>
    `;

    $item = $('<div>', {
      class: 'list-group-item list-group-item-action'
    })
      .data('fields', { ...produto, quantidade })
      .append(item)
      .appendTo($produtosAdicionados);
  });

  $('body').on('click', '.remove-prod-btn' , function () {
    $(this).parent().parent().remove();
  });

  /**
   * STEP 4
   *
   * Submit form
   */
  $('#form-lancamento').on('submit', function (event) {
    event.preventDefault();

    if ($empresa.val() == null || $empresa.val() == '') {
      $toast.toast('show');
      return;
    }

    let produtos = $produtosAdicionados.children('.list-group-item').map(function () {
      return $(this).data('fields');
    }).toArray();

    if (produtos.length < 1) {
      $toast.toast('show');
      return;
    }

    let data = {
      empresa_id: $empresa.val(),
      contexto_id: $pessoa.val(),
      operacao: $operacao.val(),
      produtos,
    }

    instance.post('lancamentos/store/', data)
      .then(() => {
        $lancamentoModel.modal('show');
      })
      .catch(function (data) {
        $('#lancamento-falha').modal('show');
        $('#lancamento-falha .modal-body').text(data.response.data.error);
      });
  });

  $lancamentoModel.on('hidden.bs.modal', function () {
    let loc = window.location;
    let baseUrl = loc.protocol + "//" + loc.hostname + (loc.port? ":"+loc.port : "");
    window.location.assign(`${baseUrl}/lancamentos`);
  });
});
