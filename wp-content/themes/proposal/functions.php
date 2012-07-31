<?php

/* ============================================================================
Theme Functions
==============================================================================*/

$assets_path = TEMPLATEPATH . '/assets/';
$functions_path = TEMPLATEPATH . '/assets/functions/';

 


//Admin Framework
require_once ($functions_path."admin-init.php"); 				//Admin specific settings and loads
require_once ($functions_path."admin-menu.php"); 				//Sets Up Options Menu
require_once ($functions_path."admin-interface.php");			//Customizes the Menus & Dashboard
require_once ($functions_path."admin-interface.php");	//Stores the Custom dashboard widgets
require_once ($functions_path."admin-custom.php");				//Adds custom meta boxes to the post/page areas

//Theme Requirements
require_once ($functions_path."theme-init.php"); 				//Theme Specific Settings and loads
require_once ($functions_path."theme-register.php"); 			//Sets up sides bars, nav menus, and custom post types
require_once ($functions_path."theme-utilities.php"); 			//Basic, common, and useful functions
require_once ($functions_path."theme-utilities-datetime.php"); 

/* ============================================================================
Add Custom, Theme Specific Functions Below Here
==============================================================================*/


add_action('wp_ajax_update_asset', 'update_asset');
add_action('wp_ajax_nopriv_update_asset', 'update_asset');

/* ============================================================================
Builds table rows
==============================================================================*/


function build_archive_row($post){
	$terms = wp_get_object_terms($post->ID, 'tag');
  $date = new Cokidoo_Datetime($post->post_modified);
	$row =	'<tr>';
	$row .=		'<td>';
	$row .=			'<h3><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></h3>';
	$row .=			'<ul class="tags">';
	foreach($terms as $term){
  	$row .=	    '<li><a class="tag" href="'.get_term_link($term->slug, 'tag').'">'.$term->name.'</a></li>'; 
  }
  $row .=			'</ul>';
	$row .=		'</td>';
	$row .=		'<td>';
	$row .=			'status';
	$row .=		'</td>';
	$row .=		'<td>';
	$row .=			$date;
	$row .=		'</td>';
	$row .= '</tr>';

	echo $row;

}
function build_revision_row($post){
  $date = new Cokidoo_Datetime($post->post_modified);
  $row =  '<tr>';
  $row .=   '<td>';
  $row .=     '<a href="">'.$date.'</a>';
  $row .=   '</td>';
  $row .=   '<td>';
  $row .=     'user';
  $row .=   '</td>';
  $row .= '</tr>';

  echo $row;

}



/* ============================================================================
Asset Creation
==============================================================================*/

function validate_asset_creation () {
 if(!$_POST){
   return false;
 }
 //Build an array for errors and setup the defaults for create new posts.
 $errors = array();
 $post = array(
   'comment_status' => 'open',
   'ping_status' => 'closed',
   'post_status' => 'publish',
   'post_type' => 'assets'
 );
 
 //Post title is required
 if(isset($_POST['title'])){
   if($_POST['title'] == ''){
     array_push($errors, 'Please enter a title');
   }else{
     $post['post_title'] = $_POST['title'];
   }
 }
  
 //Attempts to insert the post into the databas
 $response = wp_insert_post($post);
 
 if (is_wp_error($response)){
    foreach($response->errors as $error){
      array_push($errors, $error[0]);
    };
    return array("errors" => $errors, "values" => $_POST); 
 }else{
     //The post has been created so now we can store the image URL in the post meta
     // update_post_meta($response, 'ad_image_url', $_POST['url']); 
     $newPost = get_post($response);
     wp_redirect($newPost->guid);
   exit;
 }
 
}


/* ============================================================================
Asset Data Updates
==============================================================================*/

function update_asset(){
  if(!$_POST){
     return false;
  }
  $errors = array();
  $postInfo = array();
  $user = wp_get_current_user();
  
  //Only runs for logged in users
  if ($user->ID == 0) {
    return false;
  }

  //Post ID is required
  if(isset($_POST['ID'])){
    if($_POST['ID'] == ''){
      array_push($errors, 'Couldn\'t figure out the asset ID');
    }else{
      $postInfo['ID'] = $_POST['ID'];
    }
  }

  //Post Content is required
  if(isset($_POST['post_content'])){
    if($_POST['post_content'] == ''){
      array_push($errors, 'Couldn\'t figure out the content of the post');
    }else{
      $postInfo['post_content'] = $_POST['post_content'];
    }
  }
  $post = get_post($_POST['ID']);

  $postInfo['post_author'] = $user->ID;
  $postInfo['post_title'] = $post->post_title;
  $postInfo['post_type'] = 'assets';
  $postInfo['post_status'] = 'publish';

   //Attempts to update the asset in the database
  $response = wp_insert_post($postInfo);
   
  if (is_wp_error($response)){
    foreach($response->errors as $error){
      array_push($errors, $error[0]);
    };
    echo json_encode(array("errors" => $errors, "values" => $_POST));
  }else{
    //The post has been created so now we can store the image URL in the post meta
    // update_post_meta($response, 'ad_image_url', $_POST['url']); 
    $newPost = get_post($response);
    // wp_redirect($newPost->guid . '?r=newPost');
    echo json_encode(array("post" => $newPost, "user" => $user));
  }


}


?>