$('button[name="delete"], button[name="delete-produto"]').on('click', function(e) {
  var $form = $(this).closest('form');

  e.preventDefault();

  $modal = $(this).attr('name');

  $(`#${$modal}`).modal({
      backdrop: 'static',
      keyboard: false
    })
    .on('click', '.confirm_btn_modal', function(e) {
      $form.trigger('submit');
    });

  $("#cancel").on('click', function(e) {
    e.preventDefault();
    $('.confirm_btn_modal').modal.model('hide');
  });
});
