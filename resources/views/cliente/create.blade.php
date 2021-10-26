@extends('layouts.app')

@section('title', 'Cadastrar cliente')

@section('content')

<form action="{{ route('create-cliente') }}" method="POST" class="needs-validation" novalidate>
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
      <div class="invalid-tooltip">
        Por favor forneça um nome válido.
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="cpf_cnpj">CPF ou CNPJ</label>
        <input
          type="text"
          class="form-control"
          id="cpf_cnpj"
          name="cpf_cnpj"
          required
        />
      <div class="invalid-tooltip">
        Por favor forneça um CPF ou CNPJ válido.
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="inscricao_estadual">IE (Inscrição Estadual)</label>
        <input
          type="text"
          class="form-control"
          id="inscricao_estadual"
          name="inscricao_estadual"
        />
      <div class="invalid-tooltip">
        Por favor forneça uma Inscrição estadual válida.
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="nome_fantasia">Nome fantasia</label>
        <input
          type="text"
          class="form-control"
          id="nome_fantasia"
          name="nome_fantasia"
        />
      <div class="invalid-tooltip">
        Por favor forneça um Nome fantasia válido.
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="razao_social">Razão Social</label>
        <input
          type="text"
          class="form-control"
          id="razao_social"
          name="razao_social"
        />
      <div class="invalid-tooltip">
        Por favor forneça uma Razão social válida.
      </div>
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
        type="email"
        class="form-control"
        id="telefone"
        name="telefone"
      />
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="bairro">Bairro</label>
      <input
        type="text"
        class="form-control"
        id="bairro"
        name="bairro"
      />
    </div>
    <div class="col-md-6 mb-3">
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
    <div class="col-md-8 mb-3">
      <label for="complemento">Complemento</label>
      <input
        type="text"
        class="form-control"
        id="complemento"
        name="complemento"
      />
    </div>
    <div class="col-md-2 mb-3">
      <label for="cep">CEP</label>
      <input
        type="text"
        class="form-control"
        id="cep"
        name="cep"
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
      <select class="custom-select" id="estado" name="estado">
        <option selected disabled value="">Choose...</option>
        <option>...</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 mb-5">
      <label class="mr-3">Constar em:</label>
      <div class="custom-control-inline custom-switch mr-3">
        <input type="checkbox" class="custom-control-input" id="fornecedor">
        <label class="custom-control-label" for="fornecedor">Fornecedor</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input type="checkbox" class="custom-control-input" id="funcionario">
        <label class="custom-control-label" for="funcionario">Funcionario</label>
      </div>
    </div>
  </div>
  <button class="btn btn-primary" type="submit">Cadastrar</button>
  <a class="btn btn-warning" href="{{ route('index-cliente') }}">Cancelar</a>
</form>

@endsection
