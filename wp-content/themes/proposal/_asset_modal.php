<div class="modal-container">
  <div class="modal">
    <div class="modal-header">
      <h4 class="modal-title">Add section</h4>
      <a href="" class="btn btn-grey close" data-modal-close="">&times;</a>
    </div>
    <div class="modal-content asset-browser">
      <ul class="tab-nav modal-tab-nav" data-prevent-hash="true">
        <li><a href="#asset-library" class="tab-nav-item ">Asset Library</a></li>
        <li><a href="#add-empty-section" class="tab-nav-item">Add empty section</a></li>
        <li class="search">
          <input type="text" placeholder="Search assets"/>
          <input type="button" class="btn btn-green btn-icon pictos" value="q">
        </li>
      </ul>
      <div id="tabs" class="tabs">
        <section data-tab-id="asset-library" class="tab">
          <?php 
            $args =  array(
              'post_type'     => 'assets',
              'numberposts'   =>  50
            );
            $posts = get_posts($args);
            build_asset_browser($posts);
          ?>
        </section>
        <section data-tab-id="add-empty-section" class="tab">Add empty section</section>
    </div>
  </div>
</div>