@extends('layouts.app')

@section('title', 'Lancamentos')

@section('content')

<a href="{{ route('lancamentos.create') }}" class="d-block mb-4">
  <i class="bi bi-bookmark-plus-fill"></i>
  Cadastrar lançamento
</a>

<h3 class="pb-4 mb-4 font-italic border-bottom">Lancamentos</h3>

@if ($message = Session::get('success'))
  <x-alert type="success">
    <x-slot name="message">{{ $message }}</x-slot>
  </x-alert>
@endif

@if(!empty($lancamentos))
  <table class="table table-striped table-borderless table-responsive-lg">
    <thead>
      <tr>
        <th scope="col"><i class="bi bi-key-fill"></i></th>
        <th scope="col">Empresa</th>
        <th scope="col">Operação</th>
        <th scope="col">Data da operação</th>
      </tr>
    </thead>
    <tbody>
      @foreach($lancamentos as $lancamento)
      <tr>
        <th scope="row">{{ $lancamento->id }}</th>
        <td>{{ $lancamento->empresa->nome }}</td>
        <td>{{ $lancamento->operacao }}</td>
        <td>{{ $lancamento->data_operacao }}</td>
        <td class="text-right">
          <form action="{{ route('lancamentos.destroy', $lancamento->id) }}" method="POST">
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
            @csrf
            @method('DELETE')
            <button
              type="submit"
              class="btn btn-danger pb-0 pt-0"
              name="delete"
              data-toggle="modal"
              data-target="#delete"
            >
              <i class="bi bi-trash"></i>
              Excluir
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {!! $lancamentos->links() !!}

  <x-modal target="delete">
    <x-slot name="title">Deseja deletar esse lançamento?</x-slot>
    <x-slot name="message">Clique em confirmar para deletar, caso deseje cancele a operação!</x-slot>
  </x-modal>
@else
  <div class="alert alert-dark" role="alert">
    Não foram encotrado lançamentos.
  </div>
@endif

@endsection
