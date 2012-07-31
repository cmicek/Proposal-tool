<?php get_header();
  echo('index<br/>');
  if (have_posts()){ 
	  while (have_posts()) {
	    the_post();
      the_title();
    }
  }

get_footer(); ?> 	