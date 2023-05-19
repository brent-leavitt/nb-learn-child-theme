<?php //Move to Classes folder. class Section_list extends Walker_Page{	/**	 * @see Walker::start_el()	 * @since 2.1.0	 *	 * @param string $output Passed by reference. Used to append additional content.	 * @param object $page Page data object.	 * @param int $depth Depth of page. Used for padding.	 * @param int $current_page Page ID.	 * @param array $args	 */	function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {		global $current_user;		if ( $depth )			$indent = str_repeat("\t", $depth);		else			$indent = '';		extract($args, EXTR_SKIP);		$css_class = array('page_item', 'page-item-'.$page->ID);		if ( !empty($current_page) ) {			$_current_page = get_post( $current_page );			if ( in_array( $page->ID, $_current_page->ancestors ) )				$css_class[] = 'current_page_ancestor';			if ( $page->ID == $current_page )				$css_class[] = 'current_page_item';			elseif ( $_current_page && $page->ID == $_current_page->post_parent )				$css_class[] = 'current_page_parent';		} elseif ( $page->ID == get_option('page_for_posts') ) {			$css_class[] = 'current_page_parent';		}		//Get student info about page: 		$student_complete_meta = get_user_meta( $current_user->ID, 'course_complete' );				if( !empty( $student_complete_meta ) ){			if( array_key_exists( $page->ID, $student_complete_meta[0] ) )							$completed = $student_complete_meta[0][ $page->ID ];			if( !empty( $completed ) )				$css_class[] ='done';				//What does this meta data look like? 		}												$css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );		//get course_type meta data		$ct_class = "ct_content";		$ct_name = "Instruction";		$course_type = intval( get_post_meta( $page->ID, 'course_type', true ) );								switch( $course_type ){			case 5:				$ct_class = "ct_cert";				$ct_name = "Certification";				break;			case 4:				$ct_class = "ct_manual";				$ct_name = "Manual";				break;			case 3:				$ct_class = "ct_other";				$ct_name = "Other";				break;			case 2:				$ct_class = "ct_section";				$ct_name = "Section";				break;			case 1:				$ct_class = "ct_assignment";				$ct_name = "Assignment";				break;			case 0:			default:				$ct_class = "ct_content";				$ct_name = "Instruction";				break;		}				$course_access = intval( get_post_meta($page->ID, 'course_access', true) );		$student_access = intval( get_user_meta( $current_user->ID, 'course_access', true ) );		$ct_class .= ( $student_access >= $course_access )? '': ' no-access' ;				$output .= $indent . '<li class="' . $css_class . ' '.$ct_class.'"><a href="' . get_permalink($page->ID) . '"><span class="ct_name">'.lcfirst( $ct_name ).' </span><span class="course_title">' . $link_before . apply_filters( 'the_title', $page->post_title, $page->ID ) . $link_after . '</span></a>';		if ( !empty($show_date) ) {			if ( 'modified' == $show_date )				$time = $page->post_modified;			else				$time = $page->post_date;			$output .= " " . mysql2date($date_format, $time);		}	} }?>