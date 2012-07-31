<?php 
 	add_action('admin_init', 'ad_admin_init');
 	// add_editor_style("/assets/css/editor-styles.css");
 	
function ad_admin_init( ) {
    wp_enqueue_script('jquery-ui-core');
 		wp_enqueue_script('jquery-ui-tabs');
		// wp_enqueue_script("admin-js", get_bloginfo('template_directory')."/assets/js/admin.js", true);
		// wp_enqueue_style("admin-css", get_bloginfo('template_directory')."/assets/css/admin.css", false, "1.0", "all");
}
	

?>