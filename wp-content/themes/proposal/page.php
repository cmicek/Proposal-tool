<?php get_header();
  if (have_posts()){ 
	  while (have_posts()) { 
	    the_post(); ?>
      <header class="index-header">
        <h1><?php the_title(); ?></h1>
        <ul class="tab-nav">
          <li><a href="#">search</a></li>
          <li><a href="#">owned</a></li>
          <li><a href="#">active</a></li>
          <li><a href="#">all</a></li>
        </ul>
      </header>
      <table class="main-content">
        <thead>
          <tr>
            <td>Name</td>
            <td>Type</td>
            <td>Modified</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    
    <?php }
  } ?>


<?php get_footer(); ?> 	