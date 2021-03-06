
<?php get_header();
  if (have_posts()){ 
	  while (have_posts()) { 
	    the_post();
      $author = get_user_by('login', the_author());
      $date = new Cokidoo_Datetime($post->post_modified);
       ?>
      <aside class="singular-aside">
        <div class="widget widget-active">
          <div class="widget-content">
            some content
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
      
      <header class="singular-header">
        <ul class="tab-nav">
          <li class="title"><h1><?php the_title(); ?></h1></li>
          <li><a href="#editor" class="tab-nav-item ">editor</a></li>
          <li><a href="#preview" class="tab-nav-item preview">preview</a></li>
          <li class="history"><a data-modified data-modified-time="<? echo($post->post_modified); ?>" data-modified-user="<? echo($author->display_name); ?>" href="#history" class="tab-nav-item tab-history">modified <?php echo($date); ?> by <? echo($author->display_name); ?></a></li>
        </ul>
      </header>
      <div class="tabs singular-content">
        <section data-tab-id="editor" class="tab editor">
          <textarea data-post_type="assets" data-asset-id="<? the_ID(); ?>" data-old-content="<? echo($post->post_content); ?>" class="editor"><? echo($post->post_content); ?></textarea>
        </section>
        <section data-tab-id="preview" class="tab"></section>
        <section data-tab-id="history" class="tab history">
          <table class="revisions">`
            <thead>
              <tr>
                <th>Date</th>
                <th>User</th>
              </tr>
            </thead>
          <?php 
            $revisions = get_posts( array(
              'numberposts'    =>  20,
              'post_type'      =>  'revision',
              'post_parent'    =>  $post->ID,
              'post_status'    =>  'inherit')
            );
            if(count($revisions) < 1){
              echo('<tfoot><tr><td colspan="2">No revisions</td></tr></tfoot>');
            }else{
              echo('<tbody>');
                foreach ($revisions as $rev) {
                  build_revision_row($rev);
                }
              echo('</tbody>');
            }

          ?>
        </section>
      </div>
        
    <?php }
  } ?>

<script type="text/javascript">
  jQuery(document).ready(function($) {  
    $('.preview').on('click', function(){
      $('[data-tab-id=preview]').html(markdown.toHTML($('textarea.editor').val()));
    });
  });
</script>
<?php get_footer(); ?> 	