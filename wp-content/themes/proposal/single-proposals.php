
<?php get_header();
  if (have_posts()){ 
	  while (have_posts()) { 
	    the_post();
      $user_args = array();
      $users = get_users();
      print_r($users);
      $date = new Cokidoo_Datetime($post->post_modified);
       ?>
      <aside class="singular-aside">
        <div class="widget widget-title widget-active">
          <div class="widget-content">
            <?php the_title(); ?>
          </div>
        </div>
        <div class="widget widget-author widget-active">
          <div class="widget-content">
            owned by <a href="#" class="dropdown"><span><?php the_author(); ?></span></a>
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
        <div class="widget">
          <div class="widget-toggle" data-toggle="" data-toggle-target=".widget" data-toggle-target-on="widget-active">
            Toggle title
          </div>
          <div class="widget-content">
            toggle content
          </div>
        </div>

      </aside>
      <div class="tabs singular-content">

              <pre><?php print_r($post)?></pre>

      </div>
      
      <?php ?>
      
    <?php }
  } ?>

<script type="text/javascript">
  

</script>

<?php get_footer(); ?> 	