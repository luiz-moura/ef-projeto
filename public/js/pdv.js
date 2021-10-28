const venda = {
  empresa: 1,
  forma_pagamento: 'dinheiro',
  produtos: []
};

const instance = axios.create({
  baseURL: 'http://localhost:8000/api'
});

instance.get('cliente')
  .then(function (response) {
    venda.cliente_id = response.data.data.id
  });

$("input[name='paymentMethod']").change(function() {
    venda.forma_pagamento = $(this).val();
});

$("input[name='procurar']").change(function() {
  instance.get('produtos')
    .then(function (response) {
      let produtos = response.data.data;
      produtos.forEach(function(item) {
        $("#produto").append(`<option value="${item.id}">${item.nome}</option>`);
      });
    });
});

$("body").on("click", "#adicionarProduto", function () {
  venda.produtos = [$('#produto').val()];
});
