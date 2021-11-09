@extends('layouts.app')

@section('title', 'Cadastrar cliente')

@section('content')

<a href="{{ route('clientes.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
 Voltar para a lista de clientes
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Cadastrar cliente</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger">
      <x-slot name="message">{{ $error }}</x-slot>
    </x-alert>
  @endforeach
@endif

<form
  action="{{ route('clientes.store') }}"
  method="POST"
  class="needs-validation"
  novalidate
>
  @csrf
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        required
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="cpf_cnpj">CPF ou CNPJ</label>
      <input
        type="text"
        class="form-control"
        id="cpf_cnpj"
        name="cpf_cnpj"
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="inscricao_estadual">IE (Inscrição Estadual)</label>
      <input
        type="text"
        class="form-control"
        id="inscricao_estadual"
        name="inscricao_estadual"
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="nome_fantasia">Nome fantasia</label>
      <input
        type="text"
        class="form-control"
        id="nome_fantasia"
        name="nome_fantasia"
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="razao_social">Razão Social</label>
      <input
        type="text"
        class="form-control"
        id="razao_social"
        name="razao_social"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="email">E-mail</label>
      <input
        type="email"
        class="form-control"
        id="email"
        name="email"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="telefone">Telefone</label>
      <input
        type="text"
        class="form-control"
        id="telefone"
        name="telefone"
      />
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-2 mb-3">
      <label for="cep">CEP</label>
      <input
        type="text"
        class="form-control"
        id="cep"
        name="cep"
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="bairro">Bairro</label>
      <input
        type="text"
        class="form-control"
        id="bairro"
        name="bairro"
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="rua">Rua</label>
      <input
        type="text"
        class="form-control"
        id="rua"
        name="rua"
      />
    </div>
    <div class="col-md-2 mb-3">
      <label for="numero">Número</label>
      <input
        type="text"
        class="form-control"
        id="numero"
        name="numero"
      />
    </div>
    <div class="col-md-12 mb-3">
      <label for="complemento">Complemento</label>
      <input
        type="text"
        class="form-control"
        id="complemento"
        name="complemento"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="cidade">Cidade</label>
      <input
        type="text"
        class="form-control"
        id="cidade"
        name="cidade"
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="estado">Estado</label>
      <x-select-estados />
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-5">
      <label class="mr-3">Constar em:</label>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          class="custom-control-input"
          id="fornecedor"
          name="tipo[]"
          value="u"
        >
        <label class="custom-control-label" for="fornecedor">Fornecedor</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          class="custom-control-input"
          id="funcionario"
          name="tipo[]"
          value="f"
        >
        <label class="custom-control-label" for="funcionario">Funcionário</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          class="custom-control-input"
          id="empresa"
          name="tipo[]"
          value="e"
        >
        <label class="custom-control-label" for="empresa">Empresa</label>
      </div>
    </div>
  </div>
  <div class="text-right">
    <a class="btn btn-warning" href="{{ route('clientes.index') }}">
      <i class="bi bi-arrow-return-left"></i> Cancelar
    </a>
    <button class="btn btn-primary" type="submit">
      <i class="bi bi-check-circle-fill"></i> Cadastrar
    </button>
  </div>
</form>

@endsection
