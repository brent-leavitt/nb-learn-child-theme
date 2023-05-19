<?php
//New Beginnings Childbirth Library
//updated: 12 Dec 2017


//Widgets
include_once('func/widgets.php');

//Section List
include_once('func/nb_section_list.class.php');

//Pre Footer CTA area. 
function nb_add_pre_footer(){
	include_once('pre_footer.php');
}

add_action('get_footer','nb_add_pre_footer');


//ENQUE SCRIPTS  
function nb_js() {
	if (!is_admin()) {		
		wp_enqueue_script( 'jquery' );
		//adding scripts file in the footer
		wp_register_script( 'nb-js', get_stylesheet_directory_uri() . '/func/nbcbl.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'nb-js' );
	} 
}

// enqueue base scripts and styles
add_action('wp_enqueue_scripts', 'nb_js', 1);




// Functions and blocks of code that are specific to course templates. 



//NB COURSE NAV BAR
//used on the course assignment and content templates. 
// param: $pos = 'top', 'btm'
//	'top' = arrows only on top nav, plus bread crumb menu. 
//  'btm' = next/prev nav arrows with text, no breadcrumb. 


function nb_course_nav_bar( $pos ){
	
	global $post; 
	
	$ancs =  array_reverse( get_post_ancestors( $post->ID ) ); //returns an array. Closest at top, farthest is at the bottom. 
	/* echo "Post Ancestors:";
	print_pre( $ancs );
	$ancs_num = sizeof($ancs);
	$course_pos = intval($ancs_num - 1);

	$cert_title = 
	$course_title = nb_breadcrumb_link( $ancs[$course_pos] );
	$unit_title = nb_breadcrumb_link( $ancs[0] ); */

	$course_type = intval( get_post_meta($post->ID, 'course_type', true) );

	echo '<div class="course-nav-title">Course Navigation:</div>';
	
	if( strcmp( $pos, 'top' ) === 0 ){
		
		echo nb_course_nav_next_prev( $course_type, false );
		
		echo "<div class='course-nav-unit'><strong>You Are Here:</strong> <a href='".home_url()."'>Home</a> / <a href='".home_url('/section/classes/')."' >courses</a>";
	
		foreach( $ancs as $anc_id){
			$bread_title = nb_breadcrumb_link( $anc_id );
			echo " / $bread_title";
		}
		/* echo ( !empty( $course_title ) )? "/ $course_title" : '' ; 
		echo ( strcmp($course_title, $unit_title) !== 0 )? " / $unit_title" : ''; 	//don't show if same as first link.  */
		echo "</div>";
		
	}elseif(  strcmp( $pos, 'btm' ) === 0  ){
		
		echo nb_course_nav_next_prev( $course_type );
	}
	
	
	


}


function nb_course_nav_next_prev( $course_type, $text = true ){
	
	$output = '';
	
	if( strcmp( $course_type, 0 ) === 0){ //0 = content, show only next and previous tabs if in content. 
		$prev_course = nb_content_siblings("prev");
		$next_course = nb_content_siblings("next");

		$output .= '<ul class="course-nav-pag">';
						
		if( !empty( $prev_course ) ){
			$output .=  "<li class='prev'><a href='$prev_course' >&lsaquo; "; 
			$output .=  ( $text )? "Prev": '';
			$output .=  " </a></li>";
		}
		
		if( !empty( $next_course ) ){
			$output .=  "<li class='next'><a href='$next_course'>"; 
			$output .=  ( $text )? "Next": '';
			$output .=  " &rsaquo;</a></li>";
		}
			
		$output .=  "</ul>";
	}	
	
	return $output; 
}

//NB BREADCRUMB LINK

function nb_breadcrumb_link( $postID ){
	
	return ( !empty( $postID ) )? '<a href="'.get_permalink( $postID ).'" >'.get_the_title( $postID ).'</a>' : NULL ;
	
}

//NB CONTENT SIBLINGS
//used for finding next-door neighbors in content.

function nb_content_siblings( $link ) {
    global $post;
	
	//$parent = intval( $post->post_parent );
	
	$page_args = array(
		'child_of' => intval( $post->post_parent ),
		'sort_column' => 'menu_order',
		'post_type' => 'course'
	);
	
	$pages = get_pages( $page_args );
	if ($pages) {
		$pageids = array();
		foreach ($pages as $page) {
			$pageids[]= $page->ID;
		}
	}
	
    foreach ($pageids as $key => $sibling){
        if ($post->ID == $sibling){
            $curID = $key;
        }
    } 
	
	$closest = array();
	
	if( $curID > 0 )
		$closest['prev'] = get_permalink($pageids[$curID-1]);
		
	if( $curID < ( sizeof($pageids) - 1 ) )
		$closest['next'] = get_permalink($pageids[$curID+1]);
	
	return ( !empty( $closest[$link] ) )? $closest[$link] : NULL; 
	
}
?>