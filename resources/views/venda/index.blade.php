@extends('layouts.pdv')

@section('title', 'Vendas')

@section('content')

<div class="row">
  <div class="col-md-5 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Produtos</span>
      <span class="badge badge-secondary badge-pill">
        <i class="bi bi-cart-fill"></i> <span id="quantidade"></span>
      </span>
    </h4>
    <form class="card p-2 mb-2">
      @csrf
      <div class="input-group mb-2">
        <input type="text" id="procurar" class="form-control" placeholder="Pesquisar por nome ou código de barras" name="procurar" autocomplete="off">
      </div>
      <div class="input-group">
        <select class="form-control" name="produtos" id="produtos">
          <option value="" disabled selected>...</option>
        </select>
        <input type="number" class="col-2 form-control" id="quantidade_produto" value="1" min="1">
        <button type="button" class="btn btn-primary" id="adicionar_produto">Adicionar</button>
      </div>
    </form>
    <ul class="list-group mb-3">
      <ul id="adicionados" class="list-group">
        <!-- Produtos -->
      </ul>
      <li class="list-group-item d-flex justify-content-between">
        <span>Total (R$)</span>
        <strong>R$ <span id="valor_total"></span></strong>
      </li>
    </ul>
  </div>
  <div class="col-md-7 order-md-1">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-muted">Informe o cliente</span>
      <span class="badge badge-warning badge-pill">
        <i class="bi bi-info-circle-fill"></i>
        Opcional
      </span>
    </h4>
    <form id="main">
      <div class="row">
        <div class="col-md-12">
          <label for="procurar_cliente_nome">Pesquisar cliente pelo nome ou CPF/CNPJ</label>
        </div>
        <div class="col-md-4 mb-3">
          <input
            id="procurar_cliente_nome"
            type="text"
            class="form-control"
            id="nome"
            autocomplete="off"
          >
        </div>
        <div class="col-md-6">
          <select class="form-control" id="cliente_lista" style="display: none">
            <!-- Clientes -->
          </select>
        </div>
        <div class="col-md-2">
          <button type="button" id="confirmar_cliente" class="btn btn-primary btn-block" style="display: none">
            <i class="bi bi-check-circle-fill"></i>
          </button>
        </div>
      </div>
      <hr class="mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Dados do cliente</span>
      </h4>
      <div class="row">
        <div class="col-md-5 mb-3">
          <label for="cpf_cnpj">CPF/CNPJ</label>
          <input type="text" class="form-control" id="cpf_cnpj" autocomplete="off">
        </div>
        <div class="col-md-7 mb-3">
          <label for="cliente_nome">Nome</label>
          <input type="text" class="form-control" id="cliente_nome" disabled>
        </div>
        <div class="col-md-6 mb-3">
          <label for="cidade">Cidade</label>
          <input type="text" class="form-control" id="cidade" disabled>
        </div>
        <div class="col-md-6 mb-3">
          <label for="estado">Estado</label>
          <input type="text" class="form-control" id="estado" disabled>
        </div>
      </div>
      <hr class="mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Forma de pagamento</span>
        <span class="badge badge-danger badge-pill">
          <i class="bi bi-exclamation-circle-fill"></i>
          Obrigatório
        </span>
      </h4>
      <div class="d-block my-3" id="pagamento">
        <div class="custom-control custom-radio">
          <input id="dinheiro" name="payment_method" type="radio" class="custom-control-input" value="Dinheiro" checked required>
          <label class="custom-control-label" for="dinheiro">Dinheiro</label>
        </div>
        <div class="custom-control custom-radio">
          <input id="credito" name="payment_method" type="radio" class="custom-control-input" value="Cartão de credito" required>
          <label class="custom-control-label" for="credito">Cartão de credito</label>
        </div>
        <div class="custom-control custom-radio">
          <input id="debito" name="payment_method" type="radio" class="custom-control-input" value="Cartão de debito" required>
          <label class="custom-control-label" for="debito">Cartão de debito</label>
        </div>
      </div>
      <hr class="mb-4">
      <button type="sibmit" hidden></button>
      <button id="finalizar_venda" class="btn btn-primary btn-lg btn-block" type="button">Finalizar venda</button>
    </form>
  </div>
</div>

<x-toast>
  <x-slot name="title">Tentativa falhou</x-slot>
  <x-slot name="message">Você deve <b>informar o produto</b> antes de tentar adicionar a venda</x-slot>
</x-toast>

<x-modal target="venda" cancel_button="no" exit_button="no">
  <x-slot name="title">
    <i class="bi bi-check2-circle"></i>
    Venda finalizada com sucesso
  </x-slot>
  <x-slot name="message">Venda finalizada com sucesso</x-slot>
</x-modal>

@endsection
