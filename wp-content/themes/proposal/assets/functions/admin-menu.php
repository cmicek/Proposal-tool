<?php 

/* ============================================================================
Builds out the Theme Options Menu
==============================================================================*/


global $wpdb;
$themename = get_bloginfo('name'); 
$shortname = "dws";  // This is used to prefix all of our options names. Prevents options from overlapping with plugins and such.
 		
add_action('admin_menu', 'dws_theme_menu');

$dws_pages = get_pages();
$dws_cats = get_categories("hide_empty=false&child_of=0");
$dws_images = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_type= 'attachment'");   			 
 /* ============================================================================
Builds out the Menu Array.
-Each piece of the options array represents another php/html code grouping.
-The "type" gets sent to a switch statement farther below which then outputs the correct code
-The "id" is used to access the stored values when on a page template by using get_option("id");
==============================================================================*/
		
 		$options = array ( 
 				array(	"name" => "Homepage",
 						    "type" => "tab"),
				array(	"type" => "section"),
				array(	"type" => "heading",
				        "desc" => 'Select the page links to appear on the homepage. The page excerpt will be used to generate content and the page thumbnail will output an icon if its been set.',
				        "name"   => "Home page Links"),
				array(	"type" => "page-select",
				        "id"   => "home_page_one"),
				array(	"type" => "page-select",
				        "id"   => "home_page_two"),
				array(	"type" => "section-end"),
				array(	"type" => "section"),
				array(	"type" => "content_group",
				        "id"   => "home_slider"),
				array(	"type" => "section-end"),
 				array(	"name" => "Social Networks",
					      "type" => "tab"),
			
				array(  "type" => "section"),
				
        array(  "id" => $shortname."_facebook",
          		  "desc" => 'Facebook url:',
          		  "type" => "text"),
        array(  "id" => $shortname."_twitter",
          		  "desc" => 'Twitter url:',
          		  "type" => "text"),
        array(  "id" => $shortname."_linkedin",
          		  "desc" => 'LinkedIn url:',
          		  "type" => "text"),
        array(  "id" => $shortname."_youtube",
          		  "desc" => 'Youtube url:',
          		  "type" => "text"),
				array(	"type" => "section-end"),
        array(	"name" => "Admin",
        	      "type" => "tab"),
				array(  "type" => "section"),
				array(  "id" => $shortname."_simple_admin",
				  		  "name" => 'Simplify wordpress admin',
				  		  "type" => "checkbox"),
				
				array(	"type" => "section-end"),
				array(  "type" => "section"),
        array(	"type" => "heading",
                "name"   => "Select the news &amp; press release page"),
        array(	"type" => "page-select",
                "id"   => "news_page"),
				array(	"type" => "section-end")
  		);
		 
		
		  
 /* ============================================================================
 Iterates through the array and sets up the required code to save values in the database
 ==============================================================================*/
 
function dws_theme_menu() {	 
	global $themename, $shortname, $options; 
	global $current_user;
	get_currentuserinfo();
	
	if ( $_GET['page'] == basename(__FILE__) ) {  
 		 if ( 'save' == $_REQUEST['action'] ) {  
 				foreach ($options as $value) {  
						update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
 				}  
 				foreach ($options as $value) {  
						if( isset( $_REQUEST[ $value['id'] ] ) ) { 
								update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); 
						} 
						else { 
								delete_option( $value['id'] ); 
						} 
				}
 				
 				header("Location: admin.php?page=admin-menu.php&saved=true");  
		die;  
 	}	
	}
 		add_menu_page('Outsell Setup', 'Outsell Setup', '5', basename(__FILE__), 'dws_theme_display', "", 75);
  }
  

/* ============================================================================
Iterates through the array, interprets things, and builds out the menu.
==============================================================================*/

function dws_theme_display() {
  		global $themename, $shortname, $options,$wpdb; 
  		
 		if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Settings saved.</strong></p></div>';  
 		?>
	
		<!--Begin Theme Wrapper-->
		<div class="wrap">
		
			  <h2>Theme Settings: <?php echo($themename);?></h2>
			  
			  <?php $tester = wp_load_alloptions();
			    //print_arr($tester);
			    ?>
			  
			  
			<!--Begin Tab Wrapper-->
              <div id="tabs">
              <?php  
			  
			  /* ============================================================================
			  Builds Tabbed Navigation.
			  ==============================================================================*/
			  
			  $tabCount = 0;
			 		foreach ($options as $value){
						if($value['type'] == "tab"){
							$tabCount++;
							if($tabCount==1){
								echo("<ul class=\"dws_tabs\">");
							}
							echo('<li><a href="#tabs-'.$tabCount.'">'.$value['name'].'</a></li>');
						}
 					}//End Foreach 
					if($tabCount > 0){
						echo("</ul>");
					}?>
              <div id="dws_settings" class="dws_settings">
              <form method="post">  
 				  
				  <?php 
				  $tabCount = 0;
				  $sectionCount = 0;
				  foreach ($options as $value){
						
						  switch ($value['type']){
								
 								/* ============================================================================
								Builds the Tabs.
								==============================================================================*/
								
								case "tab":
									$tabCount++;
									if($tabCount > 1){
										echo("</div>");
									}
									echo("<div id=\"tabs-$tabCount\">");
									
								break;
								
								/* ============================================================================
								Starts a Section.
								==============================================================================*/
								
								case "section":
									$sectionCount++;
									echo("<div id=\"section-$sectionCount\" class=\"section\"><div class=\"padding\">");
								break;
								
								/* ============================================================================
								Ends a Section.
								==============================================================================*/
								
								
								case "section-end":
									echo("</div></div>");
								break;
								
								/* ============================================================================
								Writes a heading and description to the page.
								==============================================================================*/
								
								
								case "heading":
									echo("<h3>".$value['name']."</h3>");
									echo("<p>".$value['desc']."</p>");
								break;
								
								
								
								case "image-selection":
	 								
									foreach($value['images'] as $image) {
										$id = $image->ID;
										echo('<img title="'.$value['id'].'" alt="'.wp_get_attachment_url($id).'" src="'.wp_get_attachment_thumb_url($id).'"/>');
											 
									}
									 
	 								$img_url = "";
									if(get_option($value['id'])){$img_url=get_option($value['id']);}
								 	echo('<p><input class="text" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.($img_url).'" /><a class="clear " rev="'.$value['id'].'" href="">Clear</a></p>');
								
								break;
								
								case "custom_tags":
									
									$text_input = "";
									echo("<div class='custom_tags'>");
									
									if(get_option($value['id'])){$text_input=get_option($value['id']);}
									
									$pieces = explode(",", $text_input);
									
									echo('<div id="'.$value['id'].'" class="list">');
									foreach ($pieces as $piece){
										if($piece != ""){
										echo("<p class=\"col col_3\"><span>$piece </span> <a rev='".$value['id']."'  class=\"remove\" href=\"\">x</a></li>");
										}
									}
									echo("</div>");
									
								 	echo('<p><input id="display_tags" class="text" type="text" /><a rev="'.$value['id'].'" class="add" href="">Add to the List</a></p>');
									echo('<input name="'.$value['id'].'" id="'.$value['id'].'" type="hidden" value="'.$text_input.'" />');
									
									 echo("</div>");
								break;
								case "display_post_types": ?>
									<table cellpadding="0" cellspacing="0" class="wp-list-table fixed widefat" id="custom_types_table">
									 	<thead>
									 		<tr>
									 			<th>Plural Name</th>
									 			<th>Singular Name</th>
									 			<th>Posts</th>
									 			<th></th>
									 		 </tr>
									 	</thead>
									 	<tbody> 
								 
								 
											<?php 
											$args=array(
											  'public'   => true,
											  '_builtin' => false
											); 
 											$post_types=get_post_types($args,'objects');   
 				 								foreach ($post_types as $post_type)
												{
												
 													
													$count = $wpdb->get_results("SELECT COUNT(ID) FROM wp_posts WHERE post_type= '".$post_type->name."'");
														
  														echo("<td class='plural'>".$post_type->labels->name."</td>");
  														echo("<td class='singular'>".$post_type->labels->singular_name."</td>");
														echo("<td>".$count[0]->{"COUNT(ID)"}."</td>");
 														
 														 
 														echo('<td><span class="edit"><a href="" title="Edit this item">Edit</a> | </span><span class="view"><a href="" title="View “Sample Page”" rel="permalink">View</a> | </span><span class="trash">
															<a class="delete" title="Move this item to the Trash" href="">Trash</a>
														</span></td>');
 													echo("</tr>");
 													 
												}	
			 								?>
		 								</tbody>
		 							</table>
 									 			 									 	    
								<?php break;
								case "content_group": 
 								  $input = "";
 								  $arr;
 								  if(get_option($value['id'])){
 								    $input=stripslashes(get_option($value['id']));
 								    $content_arr = json_decode($input); 
 								  }
								?>
								<table class="wp-list-table fixed widefat content-group" data-prefix="<?php echo($value['id']); ?>">
								  <thead>
								    <tr>
								      <th>Content Objects</th>
 								    </tr>
								  </thead>
								  <tbody>
								  <?php 
  								  if(count($content_arr) > 0){
   								    foreach ($content_arr as $val_arr) {
  								      echo('<tr><td>');
  								        foreach ($val_arr as $val) {
  								          echo('<p class="'.$val->{'tag'}.'">');
  								            echo('<label>'.$val->{'label'}.'</label>');
  								            if($val->{'tag'} == 'input'){
  								              echo('<input type="text" value="'.$val->{'val'}.'"/>');
  								            }
  								            if($val->{'tag'} == 'textarea'){
  								              echo('<textarea>'.$val->{'val'}.'</textarea>');
  								            }
  								          echo('</p>');
  								        }
  								        echo('<p class="content-delete"><a class="delete_content_group" href="#">delete</a></p>');
  								      echo('</td></tr>');
  								    }
  								  }
 								  ?> 
 								  </tbody> 
 								  <tfoot>
								    <tr class="empty">
								      <td><a class="add-content-group" href="#">Add a content object</a> (remember to hide save changes when finished)</td>
								    </tr>
								  </tfoot>
								</table>
 
								<?php 
									
								 	echo('<p><textarea class="hidden" name="'.$value['id'].'" id="'.$value['id'].'" />'.$input.'</textarea></p>');
								 	
 								break;
								
								case "text":
	  						  $text_input = "";
									if(get_option($value['id'])){$text_input=get_option($value['id']);}
									
									if($value['desc']){
									  echo('<p>'.$value['desc'].'</p>');
									}
								 	echo('<p><input class="text" name="'.$value['id'].'" id="'.$value['id'].'" type="text" value="'.($text_input).'" />&nbsp;&nbsp;<a class="clear" rev="'.$value['id'].'" href="">Clear</a></p>');
								
								break;	
								case "checkbox":
								
								 	if(get_option($value['id'])){ $checked='checked="checked"'; }else{ $checked='';}  
	 								
									echo('<p class="col col_3"><input type="checkbox" '.$checked.' id="'.$value['id'].'" value="'.$value['id'].'" name="'.$value['id'].'"/>'); 
									echo("<label for=".$value['id'].">".$value['name']." </label></p>");
								break;
								
								case "textarea":
								
								 	$existing = "";
								if(get_option($value['id'])){$existing=stripslashes(get_option($value['id']));}
									echo('<p><textarea id="'.$value['id'].'"  name="'.$value['id'].'"/>'.$existing.'</textarea></p>'); 
	 							break;
									
								case "page-select":
								  $dws_pages = get_pages();
	 								echo('<p>'.$value['desc'].'</p>');
	 								echo('<p><select id="'.$value['id'].'" name="'.$value['id'].'">');
									echo("<option> </option>");	
									foreach($dws_pages as $page) {
										if(get_option($value['id']) == $page->ID){ 
											echo("<option value=".$page->ID." selected=\"selected\">$page->post_title</option>");
										}else{
											echo("<option value=".$page->ID.">$page->post_title</option>");
										}
										 
									}
									echo("</p></select>");
								break;
								 
						  } //Ends Switch
				  } //Ends Foreach
				  echo("</div>");
				  ?>
				  
						<p class="submit">
	            <input id="save"	 name="save" class="button-primary" type="submit" value="Save changes" />
	            <input type="hidden" name="action" value="save" /> 
						</p>
			  </form>
			 </div>
			 <!--End Tab Wrapper-->
			 
		</div> 
		<!--End Theme Wrapper-->
		
<?php } ?>