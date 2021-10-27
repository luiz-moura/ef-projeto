$('button[name="delete"]').on('click', function(e) {
  var $form = $(this).closest('form');

  e.preventDefault();

  $('#delete').modal({
      backdrop: 'static',
      keyboard: false
    })
    .on('click', '#confirm', function(e) {
      $form.trigger('submit');
    });

  $("#cancel").on('click', function(e) {
    e.preventDefault();
    $('#confirm').modal.model('hide');
  });
});
