<form action="{{ $action }}" method="POST" class="d-inline">
  @csrf
  @method('DELETE')
  <button
    type="submit"
    name="delete"
    {{ $attributes->merge(['class' => 'btn btn-danger d-inline']) }}
    @if (!is_null($target))
    data-toggle="modal"
    data-target="#{{ $target }}"
    @endif
  >
    <i class="bi bi-trash"></i>
    {{ $text }}
  </button>
</form>
