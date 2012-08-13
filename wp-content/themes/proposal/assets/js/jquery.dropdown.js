var dropdown = (function() {
  strip = [".", "#"];

  //
  // Changes the class of the element, if specified
  //

  function changeClass($this){
   
    var classOn = 'dropdown-active';
    var classOff;

    if(!$this.hasClass(classOn) && !$this.hasClass(classOff)){
      if(classOn){
        $this.addClass(classOn);
        return true;
      }
      if(classOff){
        $this.addClass(classOff);
        return true;
      }
      
    }
    if($this.hasClass(classOn)){
      $this.removeClass(classOn).addClass(classOff);
      return true;
    }
    if($this.hasClass(classOff)){
      $this.removeClass(classOff).addClass(classOn);
      return true;
    }

  }

  function selectText ($this){
    var $dropdown = $this.parents('.dropdown')
    $dropdown.attr('data-author-id', $this.attr('data-user-id')).find('span').text($this.text())
    $dropdown.find('li').removeClass('selected');
    $this.addClass('selected');



  }

  //
  // Sets up the event handlers
  //

  function initUIBindings() {
    console.log('dropdown inits');
    $('[data-dropdown]').on('click', function(e){
      e.preventDefault();
      e.stopPropagation();
      var $this = $(this);
      changeClass($this);
    });
    $('[data-dropdown]').on('click', 'li', function(e){
      e.preventDefault();
      selectText($(this));
      $(window).trigger('proposalChanged');

    });
    $('body,html').on('click', function(e){
      $('[data-dropdown]').removeClass('dropdown-active');
    });
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
  dropdown.init();
});