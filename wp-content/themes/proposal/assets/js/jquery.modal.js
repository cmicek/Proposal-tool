var modal = (function() {
  

  //
  // Sets up the event handlers
  //

  function initUIBindings() {
    console.log('modal inits');

    $('[data-modal-close]').on('click', function(e){
      e.preventDefault();
      var $this = $(this);
      $this.parents('.modal-container').removeClass('modal-active');
      $('body,html').removeClass('fixed');
    });


    if (true) { };
    
  }

  //
  // Runs on init
  //

  return {
    init : function(el) {
      initUIBindings();

    }
  } 
})();

jQuery(document).ready(function($) {
  modal.init();
});