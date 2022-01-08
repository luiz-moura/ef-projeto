@extends('layouts/app')

@section('title', 'Início')

@section('content')

<h3 class="border-bottom border-gray pb-2 mb-3">Ranking de vendas</h3>

<canvas class="mb-5" id="myChart" style="height: 400px;"></canvas>

<div class="my-3 p-3 bg-white rounded shadow-sm">
  <h6 class="border-bottom border-gray pb-2 mb-0">Últimos lançamentos</h6>
  @foreach ($lancamentos as $lancamento)
  <div class="media text-muted pt-3">
    <a href="{{ route('lancamentos.show', $lancamento->id) }}" class="icon-lanc">
      <i class="bi bi-eye-fill"></i>
    </a>
    <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
      <strong class="d-block text-gray-dark">
        <a href="{{ route('empresas.show', $lancamento->empresa_id) }}">@ {{ $lancamento->empresa->nome }}</a>
      </strong>
      Foi realizado uma <b>{{ $lancamento->operacao_formatada }}</b> as {{ $lancamento->data_operacao_formatada }}
      @if (!is_null($lancamento->contexto_id))
        o(a) <b>{{ $lancamento->contexto_pessoa }}</b> foi o(a)
        <a href="{{ route ('pessoas.show', $lancamento->contexto_id) }}">{{ $lancamento->contexto->nome }}</a>
      @else
        e não foi informado o {{ $lancamento->contexto_pessoa }}
      @endif
    </p>
  </div>
  @endforeach
  <small class="d-block text-right mt-3">
    <a href="{{ route('lancamentos.index') }}">Todos os lançamentos</a>
  </small>
</div>

@endsection
