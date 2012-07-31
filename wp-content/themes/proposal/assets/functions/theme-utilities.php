<?php 
add_filter('excerpt_more', 'new_excerpt_more');
add_filter("mce_buttons", "base_extended_editor_mce_buttons");
//add_filter("mce_buttons_2", "base_extended_editor_mce_buttons_2");
add_filter('tiny_mce_before_init', 'base_custom_mce_format' );

//Returns true if a number is odd
function is_odd($number) { return($number & 1); }
//Returns true if a number is even
function id_even($number) { return(!($number & 1)); }

//Changes the ending of the excerpt string.
function new_excerpt_more($more) {
	return '';
}

function print_arr($aArray) {
// Print a nicely formatted array representation:
  echo '<pre>';
  print_r($aArray);
  echo '</pre>';
}


//Customize the first line of the wp editor
function base_extended_editor_mce_buttons($buttons) {
		// The settings are returned in this array. Customize to suite your needs.
		return array(
			'bold', 'italic', 'strikethrough', 'separator', 
			'bullist', 'numlist', 'blockquote', 'hr', 'separator', 
			'justifyleft', 'justifycenter', 'justifyright', 'separator', 
			'link', 'unlink', 'wp_more', 'separator', 
			'spellchecker', 'fullscreen', 'wp_adv'
		);
		/* WordPress Default
		return array(
			'bold', 'italic', 'strikethrough', 'separator', 
			'bullist', 'numlist', 'blockquote', 'separator', 
			'justifyleft', 'justifycenter', 'justifyright', 'separator', 
			'link', 'unlink', 'wp_more', 'separator', 
			'spellchecker', 'fullscreen', 'wp_adv'
		); */
	}

//Customize the second line of the wp editor	
function base_extended_editor_mce_buttons_2($buttons) {
		// The settings are returned in this array. Customize to suite your needs. An empty array is used here because I remove the second row of icons.
		return array();
		/* WordPress Default
		return array(
			'formatselect', 'underline', 'justifyfull', 'forecolor', 'separator', 
			'pastetext', 'pasteword', 'removeformat', 'separator', 
			'media', 'charmap', 'separator', 
			'outdent', 'indent', 'separator', 
			'undo', 'redo', 'wp_help'
		); */
	}	
	

// Customize the format dropdown items
function base_custom_mce_format($init) {
		//default : p,address,pre,h1,h2,h3,h4,h5,h6
		$init['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4,h5,h6';
		return $init;
}


	
	
?>