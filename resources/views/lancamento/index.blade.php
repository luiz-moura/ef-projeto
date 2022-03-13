@extends('layouts.app')

@section('title', 'Lançamentos')

@section('content')

<a href="{{ route('lancamentos.create') }}" class="d-block mb-4">
  <i class="bi bi-bookmark-plus-fill"></i>
  Cadastrar lançamento
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Lançamentos</h3>

@if ($message = Session::get('success'))
  <x-alert type="success" :message="$message"/>
@endif

@if($lancamentos->isNotEmpty())
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Empresa</th>
        <th scope="col">Envolvido</th>
        <th scope="col">Operação</th>
        <th scope="col">Data da operação</th>
      </tr>
    </thead>
    <tbody>
      @foreach($lancamentos as $lancamento)
      <tr>
        <th scope="row">{{ $lancamento->id }}</th>
        <td>{{ $lancamento->empresa->nome }}</td>
        <td>{{ $lancamento->contexto->pessoa?->nome }}</td>
        <td>{{ $lancamento->operacao_formatada }}</td>
        <td>{{ $lancamento->data_operacao_formatada }}</td>
        <td class="text-right">
          <a
            href="{{ route('lancamentos.show', $lancamento->id) }}"
            class="btn btn-info pb-0 pt-0"
          >
            <i class="bi bi-eye-fill"></i>
            Visualizar
          </a>
          <a
            href="{{ route('lancamentos.edit', $lancamento->id) }}"
            class="btn btn-dark pb-0 pt-0"
          >
            <i class="bi bi-brush"></i>
            Editar
          </a>
          <x-form.delete
            :action="route('lancamentos.destroy', $lancamento->id)"
            target="delete"
            class="pb-0 pt-0"
          />
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {!! $lancamentos->links() !!}

  <x-modal target="delete" title="Deseja deletar esse lançamento?">
    Clique em confirmar para deletar, caso deseje cancele a operação!
  </x-modal>
@else
  <x-alert type="warning" message="Não foram encotrado lançamentos."/>
@endif

@endsection
