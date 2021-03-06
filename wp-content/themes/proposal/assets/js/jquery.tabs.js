var tabs = (function() {

 
  function toggleTab($this){
    var id = $this.attr('href').replace('#', '');
    $('.tab[data-tab-id='+id + ']').parent('.tabs').find(' > .tab').removeClass('tab-active');
    $('.tab[data-tab-id='+id + ']').addClass('tab-active');
  }


  function toggleNav($this){
    $this.parents('.tab-nav').find('.tab-nav-item').removeClass('tab-nav-active');
    $this.addClass('tab-nav-active');

  }

  //
  // Sets up the event handlers
  //

  function initUIBindings() {
    $('.tab-nav').on('click', '.tab-nav-item', function(e){
      var $this = $(this);
      if($this.parents('.tab-nav').attr('data-prevent-hash') === 'true'){
        e.preventDefault();
      }
      toggleNav($this);
      toggleTab($this);
    });
  }

  //
  // Runs on init
  //

  return {
    init : function(el) {
      if($('.tabs').length < 1){
        return false;
      }
      console.log('tabs init');
      var hash = window.location.hash.replace('#', '');

      $('.tab-nav-item[href=#'+hash+']').addClass('tab-nav-active');
      $('.tab[data-tab-id='+hash + ']').addClass('tab-active');

      
      initUIBindings();

      // Cycles through all of the tabs on the page and if they don't match the window hash
      // then trigger the first tab click
      $('.tab-nav').each(function(){
        var $this = $(this);
        if(!hash || $this.find($('.tab-nav-item[href=#'+hash+']')).length < 1){
          $this.find('.tab-nav-item:first').trigger('click');
        }
      });
      


    }
  }
})();

jQuery(document).ready(function($) {
  
  tabs.init();
});


