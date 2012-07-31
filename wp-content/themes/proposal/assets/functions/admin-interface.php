<?php 
 	/* ============================================================================
 	All the hooks for customizing the interface
 	==============================================================================*/
 	
  
  add_action('wp_dashboard_setup', 'ad_custom_dashboard');
 	
 	add_action('admin_menu', 'ad_remove_menus');
	add_action('admin_menu', 'ad_remove_post_boxes' );
	add_action('admin_menu', 'ad_remove_submenus');
	
  	add_filter('manage_post_posts_columns', 'ad_remove_post_columns' );
  	add_filter('manage_page_posts_columns', 'ad_remove_page_columns' );
  	add_filter('manage_media_columns', 'ad_remove_media_columns' );
	
	 /* ============================================================================
	 Dashboard Functions
	 ==============================================================================*/
 
function ad_custom_dashboard() {
  global $current_user;
  get_currentuserinfo();
  global $wp_meta_boxes;
 	
  if(get_option('dws_simple_admin')){
    //unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);	
    //unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);	
  }
}
  	
  	
	/* ============================================================================
	Menu Functions
	==============================================================================*/
	
	function ad_remove_menus () {
		global $menu;
		global $current_user;
		get_currentuserinfo();
		$restricted = array ();
 		//array_push ($restricted,__('Dashboard'));
 		array_push ($restricted,__('Posts'));
 		//array_push ($restricted,__('Pages'));
 		//array_push ($restricted,__('Media'));
 		//array_push ($restricted,__('Profile'));
 		array_push ($restricted,__('Appearance'));
 		//array_push ($restricted,__('Users'));
 		//array_push ($restricted,__('Settings'));
 		//array_push ($restricted,__('Comments'));
 		//array_push ($restricted,__('Plugins'));
 		end ($menu);
 	
 	
	 if(get_option('dws_simple_admin')){
     array_push ($restricted,__('Links'));
	 }
	 
	 if ($current_user->user_level < 10) {
     array_push ($restricted,__('Links'));
 		 array_push ($restricted,__('Tools'));
	 }
	  
		 while (prev($menu)){
		   $value = explode(' ',$menu[key($menu)][0]);
	   if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
		 }
	}
 	
 	function ad_remove_submenus () {
	 	global $submenu;
		global $current_user;
		get_currentuserinfo();
	 	 
	 	 	 	
	 	$post_restricted = array ();
//		 	array_push ($post_restricted,__('Categories'));
// 		 	array_push ($post_restricted,__('Tags'));
	 	
	 	$link_restricted = array ();
		 	//array_push ($link_restricted,__('Link Categories'));
		 
		$appearance_restricted = array ();
		 	//array_push ($appearance_restricted,__('Themes'));
		 	//array_push ($appearance_restricted,__('Widgets'));
		 	//array_push ($appearance_restricted,__('Menus'));
 		
 		$setting_restricted = array ();
 		  //array_push ($setting_restricted,__('General'));
 		  //array_push ($setting_restricted,__('Writing'));
			//array_push ($setting_restricted,__('Reading'));
			//array_push ($setting_restricted,__('Discussion'));
			//array_push ($setting_restricted,__('Media'));
			//array_push ($setting_restricted,__('Privacy'));
			//array_push ($setting_restricted,__('Permalinks'));
  	
  	
  	if(get_option('dws_simple_admin')){
 		 	array_push ($post_restricted,__('Tags'));
		 	array_push ($appearance_restricted,__('Widgets'));
		 	array_push ($appearance_restricted,__('Editor'));
		 	array_push ($link_restricted,__('Link Categories'));
		 	
  	}
  	   
	 	 	foreach($submenu['edit.php'] as $key => $sm) {
	 		 	if(in_array($sm[0], $post_restricted)){
				 	unset($submenu['edit.php'][$key]);
	 		 	}
	 	 	}
	 	 	foreach($submenu['link-manager.php'] as $key => $sm) {
	 	 		if(in_array($sm[0], $link_restricted)){
	 	 		 	unset($submenu['link-manager.php'][$key]);
	 	 		}
	 	 	}
	 	 	foreach($submenu['themes.php'] as $key => $sm) {
	  	 		if(in_array($sm[0], $appearance_restricted)){
	 	 		 	unset($submenu['themes.php'][$key]);
	 	 		}
	 	 	}
	 	 	foreach($submenu['options-general.php'] as $key => $sm) {
 	 	 		if(in_array($sm[0], $setting_restricted)){
	 	 		 	unset($submenu['options-general.php'][$key]);
	 	 		}
	 	 	}
 	 	
 	 	
 	 }
	
	
	/* ============================================================================
	Post/Page Write Panel Functions
	==============================================================================*/
	
 	function ad_remove_post_boxes() {
	 	     global $current_user;
	 	     global $wp_meta_boxes;
	 	     
	 	     get_currentuserinfo();
	 	     
	 	     if(get_option('dws_simple_admin')){
	 	       remove_meta_box( 'trackbacksdiv' , 'post' , 'normal' ); 
	 	       remove_meta_box( 'tagsdiv-post_tag' , 'post' , 'normal' );
	 	       remove_meta_box( 'postcustom' , 'post' , 'normal' );
	 	       remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' );
	 	        remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' );
	 	       remove_meta_box( 'commentsdiv' , 'post' , 'normal' );
	 	       remove_meta_box( 'commentsdiv' , 'page' , 'normal' );
	 	       remove_meta_box( 'slugdiv' , 'post' , 'normal' );
	 	       remove_meta_box( 'slugdiv' , 'page' , 'normal' );
	 	       remove_meta_box( 'authordiv' , 'page' , 'normal' );
	 	       remove_meta_box( 'postcustom' , 'page' , 'normal' );
	 	       
	 	       
	 	       remove_meta_box( 'linkxfndiv' , 'link' , 'normal' );
	 	       remove_meta_box( 'linkadvanceddiv' , 'link' , 'normal' );
	 	       remove_meta_box( 'linktargetdiv' , 'link' , 'normal' );
	 	       remove_meta_box( 'linkcategorydiv' , 'link' , 'normal' );
	 	     }
	 		  	
	 		  	//Removes from post screen
	 		  	
//	 		  	remove_meta_box( 'postcustom' , 'post' , 'normal' ); 
//	 		  	remove_meta_box( 'postexcerpt' , 'post' , 'normal' ); 
//	 		  	remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' );
//	 		  	remove_meta_box( 'submitdiv' , 'post' , 'normal' );
//	 		  	remove_meta_box( 'formatdiv' , 'post' , 'normal' );
//	 		  	remove_meta_box( 'categorydiv' , 'post' , 'normal' );
 	 		  	
	 		  	//Removes from Page  screen
//	 		  	
//	 		  	remove_meta_box( 'postcustom' , 'page' , 'normal' ); 
//	 		  	remove_meta_box( 'commentsdiv' , 'page' , 'normal' );
//	 		  	remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' );
//	 		  	remove_meta_box( 'authordiv' , 'page' , 'normal' ); 
//	 		  	remove_meta_box( 'submitdiv' , 'page' , 'normal' ); 
//	 		  	remove_meta_box( 'pageparentdiv' , 'page' , 'normal' ); 


	 		  	//Removes from Link screen
	 		  	
//          remove_meta_box( 'linkxfndiv' , 'link' , 'normal' );
//          remove_meta_box( 'linkadvanceddiv' , 'link' , 'normal' );
//          remove_meta_box( 'linktargetdiv' , 'link' , 'normal' );
//          remove_meta_box( 'linkcategorydiv' , 'link' , 'normal' );
//          remove_meta_box( 'linksubmitdiv' , 'link' , 'normal' );
  	 		  	
 	}
/* ============================================================================
Removes Columns from the Post/Page/Media Menus
==============================================================================*/
	
function ad_remove_post_columns( $posts_columns ) {
		global $current_user;
 		get_currentuserinfo();
	 	
	 	
	 	if ($current_user->user_level < 20) {
	 	  	//unset( $posts_columns['cb'] );
		    // unset( $posts_columns['title'] );
		    unset( $posts_columns['comments'] );
		    //unset( $posts_columns['author'] );
		    unset( $posts_columns['categories'] );
		    unset( $posts_columns['tags'] );
		   // unset( $posts_columns['date'] );
	    }
	    
 	    return $posts_columns;
	}
function ad_remove_page_columns( $posts_columns ) {
		global $current_user;
			get_currentuserinfo();
 	 	if ($current_user->user_level < 20) {
	 	  	//unset( $posts_columns['cb'] );
		    //unset( $posts_columns['title'] );
		    unset( $posts_columns['comments'] );
		    //unset( $posts_columns['author'] );
 		    //unset( $posts_columns['date'] );
	    }
	    
		    return $posts_columns;
	}
function ad_remove_media_columns( $posts_columns ) {
 		global $current_user;
		get_currentuserinfo();
		 	if ($current_user->user_level < 20) {
	 	  	//unset( $posts_columns['cb'] );
	 	  	//unset( $posts_columns['icon'] );
		    //unset( $posts_columns['title'] );
		    unset( $posts_columns['comments'] );
		    //unset( $posts_columns['author'] );
 		    //unset( $posts_columns['date'] );
 		    //unset( $posts_columns['parent'] );
 	    }
		return $posts_columns;
	}


/* ============================================================================
Removes Items from the Favorites Menu in the Upper right of the admin screen
==============================================================================*/

	
function ad_remove_favorites($actions) {
  	global $current_user;
  	get_currentuserinfo();
  	if ($current_user->user_level < 20) {
	  	//unset($actions['post-new.php']);
		//unset($actions['edit.php?post_status=draft']);
		//unset($actions['post-new.php?post_type=page']);
		unset($actions['edit-comments.php']);
	 }
	return $actions;
	 
}	
		 
?>