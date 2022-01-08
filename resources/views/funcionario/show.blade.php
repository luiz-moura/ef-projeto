@extends('layouts.app')

@section('title', 'Visualizar funcionário')

@section('content')

<a href="{{ route('funcionarios.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de funcionários
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Visualizar funcionário</h3>

<div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="nome">Nome</label>
      <input
        type="text"
        name="nome"
        value="{{ $funcionario->nome }}"
        id="nome"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6">
      <label for="cpf_cnpj">CPF ou CNPJ</label>
      <input
        type="text"
        name="cpf_cnpj"
        value="{{ $funcionario->cpf_cnpj }}"
        id="cpf_cnpj"
        class="form-control"
        disabled
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-4">
      <label for="inscricao_estadual">IE (Inscrição Estadual)</label>
      <input
        type="text"
        name="inscricao_estadual"
        value="{{ $funcionario->inscricao_estadual }}"
        id="inscricao_estadual"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-4">
      <label for="nome_fantasia">Nome fantasia</label>
      <input
        type="text"
        name="nome_fantasia"
        value="{{ $funcionario->name_fantasia }}"
        id="nome_fantasia"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-4">
      <label for="razao_social">Razão Social</label>
      <input
        type="text"
        name="razao_social"
        value="{{ $funcionario->razao_social }}"
        id="razao_social"
        class="form-control"
        disabled
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="email">E-mail</label>
      <input
        type="email"
        name="email"
        value="{{ $funcionario->email }}"
        id="email"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6">
      <label for="telefone">Telefone</label>
      <input
        type="text"
        name="telefone"
        value="{{ $funcionario->telefone }}"
        id="telefone"
        class="form-control"
        disabled
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-2">
      <label for="cep">CEP</label>
      <input
        type="text"
        name="cep"
        value="{{ $funcionario->cep }}"
        id="cep"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-4">
      <label for="bairro">Bairro</label>
      <input
        type="text"
        name="bairro"
        value="{{ $funcionario->bairro }}"
        id="bairro"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-4">
      <label for="rua">Rua</label>
      <input
        type="text"
        name="rua"
        value="{{ $funcionario->rua }}"
        id="rua"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-2">
      <label for="numero">Número</label>
      <input
        type="text"
        name="numero"
        value="{{ $funcionario->numero }}"
        id="numero"
        class="form-control"
        disabled
      />
    </div>
  </div>
  <div class="form-group mb-3">
    <label for="complemento">Complemento</label>
    <input
      type="text"
      name="complemento"
      value="{{ $funcionario->complemento }}"
      id="complemento"
      class="form-control"
      disabled
    />
  </div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="cidade">Cidade</label>
      <input
        type="text"
        name="cidade"
        value="{{ $funcionario->cidade }}"
        id="cidade"
        class="form-control"
        disabled
      />
    </div>
    <div class="col-md-6">
      <label for="estado">Estado</label>
      <x-select-estados select="{{ $funcionario->estado }}" disabled />
    </div>
  </div>
  <div class="form-row mb-5">
    <div class="col-md-12">
      <label class="mr-3">Constar em:</label>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          id="funcionario"
          class="custom-control-input"
          @if ($funcionario->contextos()->where('tipo', 'f')->exists()) checked @endif
          disabled
        >
        <label class="custom-control-label" for="funcionario">Funcionario</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          id="cliente"
          class="custom-control-input"
          @if ($funcionario->contextos()->where('tipo', 'c')->exists()) checked @endif
          disabled
        >
        <label class="custom-control-label" for="cliente">Cliente</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          id="fornecedor"
          class="custom-control-input"
          @if ($funcionario->contextos()->where('tipo', 'u')->exists()) checked @endif
          disabled
        >
        <label class="custom-control-label" for="fornecedor">Fornecedor</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          id="empresa"
          class="custom-control-input"
          @if ($funcionario->contextos()->where('tipo', 'e')->exists()) checked @endif
          disabled
        >
        <label class="custom-control-label" for="empresa">Empresa</label>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="{{ route('funcionarios.index') }}">
        <i class="bi bi-arrow-return-left"></i> Voltar
      </a>
      <x-form.delete :action="route('funcionarios.destroy', $funcionario)" target="delete"/>
      <a href="{{ route('funcionarios.edit', $funcionario) }}" class="btn btn-dark">
        <i class="bi bi-brush"></i> Editar
      </a>
    </div>
  </div>
</div>

<x-modal target="delete" title="Deseja deletar esse funcionário?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
