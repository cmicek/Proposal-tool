
var saveProposal = (function() {
  var xhr = $.ajax();
  var saveInterval;
  var proposalID;

  function save(){

    var params = {
      action      : 'update_proposal',
      ID          : proposalID,
      post_author : $('[data-author-id]').attr('data-author-id'),
      post_title  : $('[data-proposal-title]').attr('data-proposal-title')
    };


    xhr.abort();
    xhr = $.post(ad.ajaxurl, params, function(response) {
      var data = jQuery.parseJSON(response.substr(0, response.length-1));
      console.log(data);
    });
  }
 
  //
  // Sets up the event handlers
  //

  function initUIBindings() {
    $(window).on('proposalChanged', function() {
      save();
    });
    
  }

  //
  // Runs on init
  //

  return {
    init : function() {
      proposalID = $('[data-proposal-id]').attr('data-proposal-id');
      initUIBindings();
      console.log('saveProposal inits');
    }
  }
})();

jQuery(document).ready(function($) {
  saveProposal.init();
});