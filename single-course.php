<?php
/**
 * The Template for displaying single materials in the Childbirth Library.
 *
 * @author 		Brent Leavitt (www.trainingdoulas.com)
 * @package 	
 * @version     
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Redirect to course registration page if no access. 
if( !cbl_user_is( 'paying' ) && !cbl_user_is( 'preview' )  ){
	$url = site_url( '/library-access/', 'https' );
	wp_redirect( $url );
	exit;	
}


/*---- START VARS SETUP ----*/

$cat_slug = 'Classes'; //Forces Class category if none other is set? 

$course_type_num = intval( get_post_meta($post->ID, 'course_type', true) );

$course_type = 'content';

switch($course_type_num){
	case 5: 
	case 4: 	
	case 2: 
		$course_type = 'section';
		break;
	case 1: 
	case 0:
	default: 
		$course_type = 'content';
		break;
}



$section_list = new Section_list();

//toggle between section pages and assignment/content pages.
$child_of = ( $course_type == 'section' )? get_the_ID() : $post->post_parent; 


$list_args = array(
	'title_li'=>"",
	'post_type'=>"course", 
	'depth'=>"1", 
	'child_of'=> $child_of,
	'sort_column'=>"menu_order",
	'walker' => $section_list
);



//echo "The course type is: ". $course_type ;

/*---- END VARS SETUP ----*/

/*** END SETUP ****/


get_header();

get_template_part('templates/page', 'matheader');	?>

<div id="content" class="container">
	<div class="row"  >
		<div class="main col-lg-9 col-md-8 kt-sidebar postlist" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

				<div id="cbl-course-<?php the_ID(); ?>" <?php post_class(); ?> >
					
					<?php /* Toggle different material templates  */
					
						//include_once( dirname(__FILE__).'/single-nb_course_'.$course_type.'.php' );
						
					?>
					<h1 itemprop="name" class="entry-title"><?php the_title(); ?></h1>
					<div class="author-meta"> by <?php the_author_link(); ?></div>
								
					
					<div class="course-nav top">
					
						<?php nb_course_nav_bar( 'top' );?>
						
					</div><!-- end .course-nav top -->
					
					<div id="post-<?php the_ID(); ?>" > 
						
						<div class="post-entry">
							
							<?php the_content(__('Read more &#8250;', 'responsive')); ?>
											   
						</div><!-- end of .post-entry -->
					</div><!-- end of #post-<?php the_ID(); ?> -->       
					
					<?php if( strcmp( $course_type, 'content' ) === 0 ): ?>
					
					<div class="course-nav btm">
					
						<?php nb_course_nav_bar( 'btm' );?>
						
					</div><!-- end .course-nav btm -->
					
					<?php else: ?>
					
					<ul class="course-sub-section">
					
						<?php wp_list_pages( $list_args ); ?>
						
					</ul>
					
					<?php endif; ?>
					
					<div class="course-disclaimer">
						
						<p><small><strong>Please note:</strong> THIS COURSE IS FOR NON-CERTIFICATE, PERSONAL ENRICHMENT ONLY. Assignments may not be submitted for grade or other credit. To register for the birth doula training program, visit our <a title="New Beginnings Doula Training" href="https://www.trainingdoulas.com/">doula training</a>  website. </small></p>
						
					</div>
				</div><!-- #product-<?php the_ID(); ?> -->

			<?php endwhile; // end of the loop. ?>						
				

  
		</div><!-- /.main-->
		
		<aside class="col-lg-3 col-md-4" role="complementary">
        	<div class="sidebar">
				<section class="widget" >
					<div class="widget-innner">
						<?php 
							if( strcmp( $course_type, 'content' ) === 0 ):
						?>
						
						<h5 class="widget-title">Unit Contents</h5>
						<ol>
							<?php wp_list_pages($list_args); ?>
						</ol>
						
						<?php else: ?>
						
						<h5 class="widget-title">Available Courses</h5>
						<ul>
							<?php echo "Coming Soon!"; ?>
						</ul>
						
						<?php endif; ?>
					</div>
				</section>
			</div><!-- /.sidebar -->
    </aside>
		
	</div><!-- /.row -->
</div><!-- /.container -->
	  
	  
<?php get_footer(); ?>