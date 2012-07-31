
var save = (function() {
  var xhr = $.ajax();
  var saveInterval;
  var $editor;
  var assetID;
  var oldContent;

  function hasContentChanged(newContent) {
    if(newContent == oldContent){
      return false;
    }
    return true;
  }

  function saveContent(){
    var post_content = $editor.text();
    if(!hasContentChanged(post_content)){
      return false;
    }

    var params = {
      action : 'update_asset',
      ID : assetID,
      post_content: post_content
    };
    $('[data-modified-status]').text('saving...')

    oldContent = post_content;
    xhr.abort();
    xhr = $.post(ad.ajaxurl, params, function(response) {
      var data = jQuery.parseJSON(response.substr(0, response.length-1));
      updateTime(data.post.post_modified, data.user.data.display_name);
      updateTimeDisplay();
    });
  }

  function updateTime(time, userName){
    $('[data-modified]').attr('data-modified-time', time).attr('data-modified-user', userName);
  }

  function updateTimeDisplay(){
    $('[data-modified]').text('saved '+jQuery.timeago($('[data-modified]').attr('data-modified-time')) +' by ' + $('[data-modified]').attr('data-modified-user'));
  }
  //
  // Sets up the event handlers
  //

  function initUIBindings() {
    var inputTimer;
    $('[contenteditable=true]').on('keyup', function(e){
      var $this = $(this);
      clearTimeout(inputTimer);
      inputTimer = setTimeout(function(){
        saveContent();
      },250);
    });
    
  }

  //
  // Runs on init
  //

  return {
    init : function(el) {
      if($('[contenteditable]').length < 1){
        return false;
      }
     

      $editor = $('[contenteditable=true]');
      assetID = $editor.attr('data-asset-id');
      oldContent = $editor.text();

      updateTimeDisplay();
      initUIBindings();

      saveInterval = setInterval(function(){
        updateTimeDisplay();
        saveContent();
      }, 10000);
    }
  }
})();

jQuery(document).ready(function($) {
  save.init();
});