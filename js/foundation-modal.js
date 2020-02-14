(function ($) {

  Drupal.behaviors.initModal = {
    attach: function (context, settings) {
      $('.modal-window-handler').once().bind('click', function(e) {
        $(this).parents('.modal-window').modal('hide');
        e.preventDefault();
      })
    }
  };

})(jQuery);
