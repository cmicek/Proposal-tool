
<?php get_header();


  


  if (have_posts()){ 
	  while (have_posts()) { 
	    the_post();
      global $current_user;
      get_currentuserinfo();
      $users = get_users();
      $date = new Cokidoo_Datetime($post->post_modified);
      $author = get_userdata($post->post_author);
      $children_args = array(
        'numberposts'    =>  -1,
        'orderby'      =>  'menu_order',
        'post_type'      =>  'sections',
        'post_parent'    =>  $post->ID,
        'post_status'    =>  'publish'
      );
      $children = get_posts($children_args);
      ?>
      <aside class="singular-aside" data-proposal-id="<?php echo($post->ID); ?>">
        <div class="widget widget-title widget-active">
          <div class="widget-content" data-proposal-title="<?php echo($post->post_title);?>">
            <?php the_title(); ?>
          </div>
        </div>
        <div class="widget widget-author widget-active">
          <div class="widget-content">
            owned by<a href="#" class="dropdown" data-dropdown="" data-author-id="<?php echo($author->ID);?>">
              <span><?php the_author(); ?></span>
              <ul class="dropdown-content">
              <?php
                foreach ($users as $user) {
                  $class = '';
                  if($user->ID == $post->post_author){
                    $class='selected';
                  }
                  echo('<li class="'.$class.'" data-user-id="'.$user->ID.'">'.$user->display_name.'</li>');
                }
              ?>  
              </ul>
            </a>
          </div>
        </div>
        <div class="widget widget-active widget-sections">
          <div class="widget-toggle" data-toggle="" data-toggle-target=".widget" data-toggle-target-on="widget-active">
            Sections
          </div>
          <div class="widget-content">
            <ul class="tab-nav section-tab-nav">
              <?php 
                foreach ($children as $child) {
                  echo('<li><a class="tab-nav-item" href="#asset-'.$child->ID.'">'.$child->post_title.'</a></li>');
                }
              ?>
            </ul>
            <a href="#" class="btn btn-green">Add section</a>
          </div>
        </div>
        <div class="widget">
          <div class="widget-toggle" data-toggle="" data-toggle-target=".widget" data-toggle-target-on="widget-active">
            Toggle title
          </div>
          <div class="widget-content">
            toggle content
          </div>
        </div>
        <div class="widget">
          <div class="widget-toggle" data-toggle="" data-toggle-target=".widget" data-toggle-target-on="widget-active">
            Toggle title
          </div>
          <div class="widget-content">
            toggle content
          </div>
        </div>

      </aside>
      <div class="tabs">
        <?php  foreach ($children as $child) {
          $child_author = get_userdata($child->post_author);
          $child_date = new Cokidoo_Datetime($child->post_modified);
          ?>
          <div class="tab" data-tab-id="asset-<?php echo($child->ID) ?>">
            <header class="singular-header">
              <ul class="tab-nav" data-prevent-hash="true">
                <li class="title"><h1><?php echo($child->post_title); ?></h1></li>
                <li><a href="#editor-<?php echo($child->ID) ?>" class="tab-nav-item ">editor</a></li>
                <li><a href="#preview-<?php echo($child->ID) ?>" class="tab-nav-item preview">preview</a></li>
                <li class="history"><a data-modified data-modified-time="<? echo($child->post_modified); ?>" data-modified-user="<? echo($child_author->display_name); ?>" href="#history-<?php echo($child->ID) ?>" class="tab-nav-item tab-history">modified <?php echo($child_date); ?> by <? echo($child_author->display_name); ?></a></li>
              </ul>
            </header>
            <div id="tabs" class="tabs singular-content">
              <section data-tab-id="editor-<?php echo($child->ID) ?>" class="tab editor">
                <textarea data-post_type="sections" data-asset-id="<? echo($child->ID); ?>" class="editor" data-old-content="<? echo($child->post_content); ?>"><? echo($child->post_content); ?></textarea>
              </section>
              <section data-tab-id="preview-<?php echo($child->ID) ?>" class="tab"></section>
              <section data-tab-id="history-<?php echo($child->ID) ?>" class="tab history"></section>
            </div>
          </div>
        <?php } ?>


      </div>
      
      
      
    <?php }
  } ?>

<script type="text/javascript">
  jQuery(document).ready(function($) {  
    $('.preview').on('click', function(){
      var id = $(this).attr('href').replace('#', '');
      var $previewTab = $('.tab[data-tab-id='+id + ']');
      $previewTab.html(markdown.toHTML($previewTab.parent('.tabs').find('textarea.editor').val()));
    });
  });
</script>
<?php include('_asset_modal.php'); ?>
<?php get_footer(); ?> 	

