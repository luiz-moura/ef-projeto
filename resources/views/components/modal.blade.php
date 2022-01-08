<div class="modal fade" id="{{ $target }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="{{ $target }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $target }}Label">{{ $title }}</h5>
        @if ($exitButton == 'yes')
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        @endif
      </div>
      <div class="modal-body">
        {{ $message ?? $slot }}
      </div>
      <div class="modal-footer">
        @if ($cancelButton == 'yes')
        <button type="button" id="cancel" class="btn btn-warning" data-dismiss="modal">
          <i class="bi bi-arrow-return-left"></i> Cancelar
        </button>
        @endif
        <button type="button" class="btn btn-primary confirm_btn_modal">
          <i class="bi bi-check-circle-fill"></i> Confirmar
        </button>
      </div>
    </div>
  </div>
</div>
