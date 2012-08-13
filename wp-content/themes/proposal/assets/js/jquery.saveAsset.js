
var saveAsset = (function() {
  var xhr = $.ajax();
  var saveInterval;

  function hasContentChanged(newContent, oldContent) {
    if(newContent == oldContent){
      console.log('content has not changesd');
      return false;
    }
      console.log('content has changesd');
    return true;
  }

  function saveContent($editor){
    var post_content = $editor.val();
    var assetID = $editor.attr('data-asset-id');

   
    if(!hasContentChanged(post_content, $editor.attr('data-old-content'))){
      return false;
    }


    var params = {
      action : 'update_asset',
      ID : assetID,
      post_content: post_content,
      post_type: $editor.attr('data-post_type'),
      post_parent: $('[data-proposal-id]').attr('data-proposal-id') 
    };

    $('[data-modified-status]').text('saving...')
    console.log(params);
    $editor.attr('data-old-content', post_content);
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
    $('textarea.editor').on('keyup', function(e){
      var $this = $(this);
      clearTimeout(inputTimer);
      clearInterval(saveInterval);
      inputTimer = setTimeout(function(){
        saveContent($this);
      },250);

      //Do an auto-save every minute, but only after a user starts typing
      saveInterval = setInterval(function(){
        console.log('saved asset: ' + $this.attr('data-asset-id'));
        updateTimeDisplay();
        saveContent($this);
      }, 60000);
    });
    
  }

  //
  // Runs on init
  //

  return {
    init : function(el) {
      if($('textarea.editor').length < 1){
        return false;
      }
      console.log('saveAsset inits');

      updateTimeDisplay();
      initUIBindings();

      
    }
  }
})();

jQuery(document).ready(function($) {
  saveAsset.init();
});