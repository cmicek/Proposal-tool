<!DOCTYPE html>
<html>
<html <?php language_attributes(); ?> class="no-js fixed">

 	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<title>Proposal tool</title>

		<meta name="description" content="">
		<meta name="author" content="">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   		
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link href="//get.pictos.cc/fonts/2387/1" rel="stylesheet" type="text/css"> 				
		
		
 		<?php wp_head(); ?>
    <?php global $post ?>
	</head>
	<body <?php body_class(); ?> class="fixed">
    <nav class="pictos">
      <a href="<?php bloginfo('url') ?>/proposals" class="proposals <?php if (is_post_type_archive('proposals') || is_singular('proposals')){ echo('active');}?>" data-icon="f">Proposals</a>
      <a href="<?php bloginfo('url') ?>/assets" class="assets <?php if (is_post_type_archive('assets') || is_singular('assets')){ echo('active');}?>" data-icon="s">Assets</a>
      <a href="<?php bloginfo('url') ?>/users" class="users <?php if (is_page('users') || is_singular('users')){ echo('active');}?>" data-icon="p">Users</a>
      <a href="<?php bloginfo('url') ?>/account" class="account <?php if (is_page('account')){ echo('active');}?>" data-icon="g" >Account</a>
    </nav>
    <div id="container" class="site-container">
    
 		
 	 