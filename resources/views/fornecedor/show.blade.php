@extends('layouts.app')

@section('title', 'Visualizar fornecedor')

@section('content')

<a href="{{ route('fornecedores.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar pra lista de fornecedores
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Visualizar fornecedor</h3>

<div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="nome">Nome</label>
      <input
        type="text"
        class="form-control"
        id="nome"
        name="nome"
        value="{{ $fornecedor->nome }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="cpf_cnpj">CPF ou CNPJ</label>
      <input
        type="text"
        class="form-control"
        id="cpf_cnpj"
        name="cpf_cnpj"
        value="{{ $fornecedor->cpf_cnpj }}"
        disabled
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="inscricao_estadual">IE (Inscrição Estadual)</label>
      <input
        type="text"
        class="form-control"
        id="inscricao_estadual"
        name="inscricao_estadual"
        value="{{ $fornecedor->inscricao_estadual }}"
        disabled
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="nome_fantasia">Nome fantasia</label>
      <input
        type="text"
        class="form-control"
        id="nome_fantasia"
        name="nome_fantasia"
        value="{{ $fornecedor->name_fantasia }}"
        disabled
      />
    </div>
    <div class="col-md-4 mb-3">
      <label for="razao_social">Razão Social</label>
      <input
        type="text"
        class="form-control"
        id="razao_social"
        name="razao_social"
        value="{{ $fornecedor->razao_social }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="email">E-mail</label>
      <input
        type="email"
        class="form-control"
        id="email"
        name="email"
        value="{{ $fornecedor->email }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="telefone">Telefone</label>
      <input
        type="text"
        class="form-control"
        id="telefone"
        name="telefone"
        value="{{ $fornecedor->telefone }}"
        disabled
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
        value="{{ $fornecedor->bairro }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="rua">Rua</label>
      <input
        type="text"
        class="form-control"
        id="rua"
        name="rua"
        value="{{ $fornecedor->rua }}"
        disabled
      />
    </div>
    <div class="col-md-2 mb-3">
      <label for="numero">Número</label>
      <input
        type="text"
        class="form-control"
        id="numero"
        name="numero"
        value="{{ $fornecedor->numero }}"
        disabled
      />
    </div>
    <div class="col-md-8 mb-3">
      <label for="complemento">Complemento</label>
      <input
        type="text"
        class="form-control"
        id="complemento"
        name="complemento"
        value="{{ $fornecedor->complemento }}"
        disabled
      />
    </div>
    <div class="col-md-2 mb-3">
      <label for="cep">CEP</label>
      <input
        type="text"
        class="form-control"
        id="cep"
        name="cep"
        value="{{ $fornecedor->cep }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="cidade">Cidade</label>
      <input
        type="text"
        class="form-control"
        id="cidade"
        name="cidade"
        value="{{ $fornecedor->cidade }}"
        disabled
      />
    </div>
    <div class="col-md-6 mb-3">
      <label for="estado">Estado</label>
      <x-select-estados select="{{ $fornecedor->estado }}" disabled />
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
          <?php echo ($fornecedor->contextos()->where('tipo', 'u')->exists()) ? 'checked' : '' ?>
          disabled
        >
        <label class="custom-control-label" for="fornecedor">Fornecedor</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          class="custom-control-input"
          id="funcionario"
          <?php echo ($fornecedor->contextos()->where('tipo', 'f')->exists()) ? 'checked' : '' ?>
          disabled
        >
        <label class="custom-control-label" for="funcionario">Funcionario</label>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-12 text-right">
      <a class="btn btn-warning" href="{{ route('fornecedores.index') }}">
      <i class="bi bi-arrow-return-left"></i> Voltar
      </a>
      <form
        action="{{ route('fornecedores.destroy', $fornecedor->id) }}"
        method="POST"
        class="d-inline"
      >
        @csrf
        @method('DELETE')
        <button
          type="submit"
          class="btn btn-danger"
          name="delete"
          data-toggle="modal"
          data-target="#delete"
        >
          <i class="bi bi-trash"></i>
          Excluir
        </button>
      </form>
      <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-dark">
        <i class="bi bi-brush"></i> Editar
      </a>
    </div>
  </div>
</div>

<x-modal target="delete">
  <x-slot name="title">Deseja deletar esse fornecedor?</x-slot>
  <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
</x-modal>

@endsection
