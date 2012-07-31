<?php validate_asset_creation(); ?>
<?php get_header(); ?>

   <header class="index-header">
      <ul class="tab-nav">
        <li class="title"><h1><?php wp_title(''); ?></h1></li>
        <li><a href="#all" class="tab-nav-item ">all</a></li>
        <li><a href="#tag" class="tab-nav-item arrow arrow-down">tag</a></li>
        <li><a href="#create" class="tab-nav-item">create</a></li>
      </ul>
    </header>
    <div id="tabs" class="tabs">
      <section data-tab-id="all" class="tab index-table ">
        <table>
          <?php 
            if(isset($_GET['orderby'])){
              $order = $_GET['orderby'];
            }else{
              $order = 'title';
            }
          ?>
          <thead>
            <tr>
              <th><a <?php if($order == 'title') echo('class="active"');?> href="?orderby=title#all">Name</a></th>
              <th><a href="#">Locked</a></th>
              <th><a <?php if($order == 'modified') echo('class="active"');?> href="?orderby=modified#all">Modified</a></th>
            </tr>
          </thead>

          <?php if (have_posts()){ 
            echo('<tbody>');
          	  while (have_posts()) { 
          	    the_post();
                build_archive_row($post);
              }
            echo('</tbody>');
          }else{
            echo('<tfoot><tr><td colspan="3">No results</td></tr></tfoot>');

          } ?>
        </table>
      </section>
      <section data-tab-id="tag" class="tab index-table">tag</section>
      <section data-tab-id="create" class="tab index-content">
        <?php include('page-assets_create.php'); ?>
      </section>
    </div>


<?php get_footer(); ?> 	