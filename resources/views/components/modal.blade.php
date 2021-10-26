<div class="modal fade" id="{{ $target }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="{{ $target }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $target }}Label">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $message }}
      </div>
      <div class="modal-footer">
        <button type="button" id="cancel" class="btn btn-warning" data-dismiss="modal">
          <i class="bi bi-arrow-return-left"></i> Cancelar
        </button>
        <button type="button" id="confirm" class="btn btn-primary">
          <i class="bi bi-check-circle-fill"></i> Confirmar
        </button>
      </div>
    </div>
  </div>
</div>
