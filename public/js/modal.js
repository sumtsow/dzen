$('#comment').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget);
  var id_comment = button.data('whatever');
  var modal = $(this);
  if(id_comment !== 0) {
      modal.find('.modal-title').text('New answer to comment #' + id_comment);
  }
  else {
      modal.find('.modal-title').text('New comment');
  }
  modal.find('#parent').val(id_comment);
})
