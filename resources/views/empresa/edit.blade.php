@extends('layouts.app')

@section('title', 'Editar empresa')

@section('content')

<a href="{{ route('empresas.index') }}" class="d-block mb-4">
  <i class="bi bi-arrow-return-left"></i>
  Voltar para a lista de empresas
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Editar empresa</h3>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <x-alert type="danger" :message="$error"/>
  @endforeach
@endif

<form
  action="{{ route('empresas.update', $empresa) }}"
  method="POST"
  id="form"
  class="needs-validation submit-only-btn"
  novalidate
>
  @csrf
  @method('PUT')
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="nome">Nome</label>
      <input
        type="text"
        name="nome"
        value="{{ $empresa->nome }}"
        id="nome"
        class="form-control @error('nome') is-invalid @enderror"
        required
      />
    </div>
    <div class="col-md-6">
      <label for="cpf_cnpj">CPF ou CNPJ</label>
      <input
        type="text"
        name="cpf_cnpj"
        value="{{ $empresa->cpf_cnpj }}"
        id="cpf_cnpj"
        class="form-control @error('cpf_cnpj') is-invalid @enderror"
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-4">
      <label for="inscricao_estadual">IE (Inscrição Estadual)</label>
      <input
        type="text"
        name="inscricao_estadual"
        value="{{ $empresa->inscricao_estadual }}"
        id="inscricao_estadual"
        class="form-control @error('inscricao_estadual') is-invalid @enderror"
      />
    </div>
    <div class="col-md-4">
      <label for="nome_fantasia">Nome fantasia</label>
      <input
        type="text"
        name="nome_fantasia"
        value="{{ $empresa->name_fantasia }}"
        id="nome_fantasia"
        class="form-control @error('nome_fantasia') is-invalid @enderror"
      />
    </div>
    <div class="col-md-4">
      <label for="razao_social">Razão Social</label>
      <input
        type="text"
        name="razao_social"
        value="{{ $empresa->razao_social }}"
        id="razao_social"
        class="form-control @error('razao_social') is-invalid @enderror"
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="email">E-mail</label>
      <input
        type="email"
        name="email"
        value="{{ $empresa->email }}"
        id="email"
        class="form-control @error('email') is-invalid @enderror"
      />
    </div>
    <div class="col-md-6">
      <label for="telefone">Telefone</label>
      <input
        type="text"
        name="telefone"
        value="{{ $empresa->telefone }}"
        id="telefone"
        class="form-control @error('telefone') is-invalid @enderror"
      />
    </div>
  </div>
  <div class="form-row mb-3">
    <div class="col-md-2">
      <label for="cep">CEP</label>
      <input
        type="text"
        name="cep"
        value="{{ $empresa->cep }}"
        id="cep"
        class="form-control @error('cep') is-invalid @enderror"
      />
    </div>
    <div class="col-md-4">
      <label for="bairro">Bairro</label>
      <input
        type="text"
        name="bairro"
        value="{{ $empresa->bairro }}"
        id="bairro"
        class="form-control @error('bairro') is-invalid @enderror"
      />
    </div>
    <div class="col-md-4">
      <label for="rua">Rua</label>
      <input
        type="text"
        name="rua"
        value="{{ $empresa->rua }}"
        id="rua"
        class="form-control @error('rua') is-invalid @enderror"
      />
    </div>
    <div class="col-md-2">
      <label for="numero">Número</label>
      <input
        type="text"
        name="numero"
        value="{{ $empresa->numero }}"
        id="numero"
        class="form-control @error('numero') is-invalid @enderror"
      />
    </div>
  </div>
  <div class="form-group mb-3">
    <label for="complemento">Complemento</label>
    <input
      type="text"
      name="complemento"
      value="{{ $empresa->complemento }}"
      id="complemento"
      class="form-control @error('complemento') is-invalid @enderror"
    />
  </div>
  <div class="form-row mb-3">
    <div class="col-md-6">
      <label for="cidade">Cidade</label>
      <input
        type="text"
        name="cidade"
        value="{{ $empresa->cidade }}"
        id="cidade"
        class="form-control @error('cidade') is-invalid @enderror"
      />
    </div>
    <div class="col-md-6">
      <label for="estado">Estado</label>
      <x-select-estados select="{{ $empresa->estado }}" />
    </div>
  </div>
  <div class="form-row mb-5">
    <div class="col-md-12">
      <label class="mr-3">Constar em:</label>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          name="tipo[]"
          value="e"
          id="empresa"
          class="custom-control-input"
          @if ($empresa->contextos()->where('tipo', 'e')->exists()) checked @endif
        >
        <label class="custom-control-label" for="empresa">Empresa</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          name="tipo[]"
          value="c"
          id="cliente"
          class="custom-control-input"
          @if ($empresa->contextos()->where('tipo', 'c')->exists()) checked @endif
        >
        <label class="custom-control-label" for="cliente">Cliente</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          name="tipo[]"
          value="u"
          id="fornecedor"
          class="custom-control-input"
          @if ($empresa->contextos()->where('tipo', 'u')->exists()) checked @endif
        >
        <label class="custom-control-label" for="fornecedor">Fornecedor</label>
      </div>
      <div class="custom-control-inline custom-switch mr-3">
        <input
          type="checkbox"
          name="tipo[]"
          value="f"
          id="funcionario"
          class="custom-control-input"
          @if ($empresa->contextos()->where('tipo', 'f')->exists()) checked @endif
        >
        <label class="custom-control-label" for="funcionario">Funcionário</label>
      </div>
    </div>
  </div>
</form>

<div class="row">
  <div class="col-md-12 text-right">
		<a class="btn btn-warning" href="{{ route('empresas.index') }}">
			<i class="bi bi-arrow-return-left"></i> Cancelar
		</a>
    <x-form.delete :action="route('empresas.destroy', $empresa)" target="delete"/>
		<button class="btn btn-primary" type="submit" form="form">
			<i class="bi bi-check-circle-fill"></i> Atualizar
		</button>
	</div>
</div>

<x-modal target="delete" title="Deseja deletar essa empresa?">
  Clique em confirmar para deletar, caso deseje cancele a operação!
</x-modal>

@endsection
