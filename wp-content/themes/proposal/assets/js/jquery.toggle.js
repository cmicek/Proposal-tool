var toggle = (function() {
  strip = [".", "#"];

  //
  // Changes the class of the element, if specified
  //

  function changeClass($this){
    if(!$this.attr('data-toggle-class-on') && !$this.attr('data-toggle-class-off')){
      return false;
    }
    var classOn = $this.attr('data-toggle-class-on');
    var classOff = $this.attr('data-toggle-class-off');

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

  //
  // Changes the text of the current element, if specified
  //

  function changeText($this){
    if(!$this.attr('data-toggle-text-on') && !$this.attr('data-toggle-text-off')){
      return false;
    }
    var currentText = $this.text();
    var textOn = $this.attr('data-toggle-text-on');
    var textOff = $this.attr('data-toggle-text-off');
    if(currentText == textOn){
      $this.text(textOff);
      return true;
    }
    if(currentText == textOff){
      $this.text(textOn);
      return true;
    }
    
  }

 
  //
  // Changes the class of the target element, if specified
  //

  function changeTarget($this){
    if(!$this.attr('data-toggle-target')){
      return false;
    }

    var $target = $this.closest($($this.attr('data-toggle-target')));
    var targetOn = $this.attr('data-toggle-target-on');
    var targetOff = $this.attr('data-toggle-target-off');

    if($target.length < 1){
      $target = $this.nextAll($this.attr('data-toggle-target'));
    }
    if($target.length < 1){
      $target = $this.parent().nextAll($this.attr('data-toggle-target'));
    }

    if(!$target.hasClass(targetOn) && !$target.hasClass(targetOff)){
      if(targetOn){
        $target.addClass(targetOn);
        return true;
      }
      if(targetOff){
        $target.addClass(targetOff);
        return true;
      }
    }
    if($target.hasClass(targetOn)){
      $target.removeClass(targetOn).addClass(targetOff);
      return true;
    }
    if($target.hasClass(targetOff)){
      $target.removeClass(targetOff).addClass(targetOn);
      return true;
    }

    return false;
  }

  //
  // If the element has siblings (based on the parent element of [data-toggle]s, changes their state to an alternate one.
  //

  function changeSiblings($this){
    if(!$this.parent().hasClass('js-toggles')){
      return false;
    }
    $this.parent().find('[data-toggle]').removeClass('active');
    $this.addClass('active');

  }

  //
  // Sets up the event handlers
  //

  function initUIBindings() {
    console.log('toggle inits');
    $('[data-toggle]').on('click', function(e){
      e.preventDefault();
      var $this = $(this);

      changeClass($this);
      changeText($this);
      changeTarget($this);
      changeSiblings($this);

    })
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
  toggle.init();
});