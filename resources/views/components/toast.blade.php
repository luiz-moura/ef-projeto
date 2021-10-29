<div id="toast">
  <div class="toast" data-delay="3000">
    <div class="toast-header">
      <i class="bi bi-info-circle-fill mr-2"></i>
      <strong class="mr-auto">{{ $title }}</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      {{ $message }}
    </div>
  </div>
</div>
