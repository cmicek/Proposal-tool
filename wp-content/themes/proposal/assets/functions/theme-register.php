<?php

 
/* ============================================================================
Registers Sidebars
==============================================================================*/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	  'id'            =>  'sidebar',
	  'name'          =>  'sidebar Sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	
 }

/* ============================================================================
Builds Custom Taxonomies
==============================================================================*/
 
$tag_labels = array(
    'name' => __( 'Tags' ),
   	'singular_name' => __( 'Tag' ),
   	'search_items' => __( 'Search Tags' ),
   	'popular_items' => __( 'Popular Tags' ),
   	'all_items' => __( 'All Tags' ),
   	'parent_item' => __( 'Parent Tag' ),
   	'parent_item_colon' => __( 'Parent Tag:' ),
   	'edit_item' => __( 'Edit Tag' ),
   	'update_item' => __( 'Update Tag' ),
   	'add_new_item' => __( 'Add New Tag' ),
   	'new_item_name' => __( 'New Tag Name' )
 );

 $tag_args = array(
 		'public' => true,
 		'labels' => $tag_labels,
   	'hierarchical' => false,
   	'rewrite' => true
 );
 
//This is how you register a taxonomy across multiple custom post types
register_taxonomy('tag',array('assets', 'proposals'),$tag_args);

/* ============================================================================
Builds Custom Post Types
==============================================================================*/

$proposals_label = array(
   'name' => _x('Proposals', 'post type general name'),
   'singular_name' => _x('Proposal', 'post type singular name'),
   'add_new' => _x('Add New', 'Proposal'),
   'add_new_item' => __('Add New Proposal'),
   'edit_item' => __('Edit Proposal'),
   'new_item' => __('New Proposal'),
   'view_item' => __('View Proposal'),
   'search_items' => __('Search Proposals'),
   'not_found' =>  __('No Proposals found'),
   'not_found_in_trash' => __('No Proposals found in Trash'), 
   'parent_item_colon' => ''
 );

$proposals   = array(
  'description' => 'Proposals',
  'labels' => $proposals_label,
  'public' => true,
  'show_ui' => true,
  '_builtin' => false,
  '_edit_link' => 'post.php?post=%d',
  'capability_type' => 'page',
  'hierarchical' => true,
  'rewrite' => true,
  'query_var' => false,
  'supports' => array('title', 'editor', 'author', 'revisions', 'comments'),
  'menu_position' => 5,
  'show_in_menu' => true,
  'show_in_nav_menus' => true,
  'has_archive' => true
); 

$assets_label = array(
   'name' => _x('Assets', 'post type general name'),
   'singular_name' => _x('Asset', 'post type singular name'),
   'add_new' => _x('Add New', 'Asset'),
   'add_new_item' => __('Add New Asset'),
   'edit_item' => __('Edit Asset'),
   'new_item' => __('New Asset'),
   'view_item' => __('View Asset'),
   'search_items' => __('Search Assets'),
   'not_found' =>  __('No Assets found'),
   'not_found_in_trash' => __('No Assets found in Trash'), 
   'parent_item_colon' => ''
 );

$assets   = array(
  'description' => 'Assets',
  'labels' => $assets_label,
  'public' => true,
  'show_ui' => true,
  '_builtin' => false,
  '_edit_link' => 'post.php?post=%d',
  'capability_type' => 'page',
  'hierarchical' => false,
  'rewrite' => true,
  'query_var' => false,
  'supports' => array('title', 'editor', 'author', 'revisions', 'comments'),
  'menu_position' => 5,
  'show_in_menu' => true,
  'show_in_nav_menus' => true,
  'has_archive' => true
); 
 

register_post_type('proposals', $proposals);
register_post_type('assets', $assets);
  
 
/* ============================================================================
Registers Custom Navigation Menus
==============================================================================*/
  if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(array('header', 'footer'));
  }
?>