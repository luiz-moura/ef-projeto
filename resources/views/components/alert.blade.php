<div class="alert alert-{{ $type }}">
  <span>
    @if ($type == 'success')
      <i class="bi bi-check-circle-fill"></i>
    @elseif ($type == 'warning')
      <i class="bi bi-exclamation-circle-fill"></i>
    @else
      <i class="bi bi-slash-circle-fill"></i>
    @endif
    {{ $message ?? $slot }}
  </span>
</div>
