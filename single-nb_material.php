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

/*---- START IMAGE CODE VARS ---*/

global $post, $pinnacle, $nb_vars, $wp_query;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 5 );
$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
$image_title      	= get_post_field( 'post_excerpt', $post_thumbnail_id );

if(!empty($image_title)) {
	$light_title  = $image_title;
} else {
	$light_title  = get_the_title($post_thumbnail_id);
}


$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . $placeholder,
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
	'kad-light-gallery',
) );

$galleryslider = 'woo_product_slider_disabled';
$galslider = false;
$galleryzoom = 'woo_product_zoom_disabled';
$galzoom = false;
$presizeimage = 1;
$productimgwidth = 456;
$productimgheight = $productimgwidth;
$output_size = 'shop_thumbnail';
$attachment_ids = get_post_meta($post->ID, '_nb_cbl_gallery', true);
$cbl_placeholder_src = site_url('/wp-content/uploads/2018/04/placeholder.png', 'https');


/*---- END IMAGE CODE VARS ----*/


/*---- START  CODE VARS ----*/


/*---- END IMAGE CODE VARS ----*/


/*---- START MISC CODE VARS ----*/

$doc_id = get_post_meta( $post->ID, '_nb_cbl_doc_id', true );
$mat_tags = get_the_terms( $post, 'mat_tags' );

$downloads = get_post_meta( $post->ID, '_nb_cbl_downloads', true );
$mat_atts = get_post_meta( $post->ID, '_nb_cbl_attributes', true );

$terms = get_the_terms( $post, 'mat_cats' );
//print_pre( $terms );
$cat_slug = ( !empty( $terms  ) )? $terms[ count($terms)-1 ]->slug : 'classes'; //Forces Class category if none other is set? 



/*---- END MISC CODE VARS ----*/

/*** END SETUP ****/


get_header();

get_template_part('templates/page', 'matheader');	?>

<div id="content" class="container">
	<div class="row"  >
		<div class="main col-md-12 kt-nosidebar" role="main">
			<?php while ( have_posts() ) : the_post(); ?>

				<div id="cbl-mat-<?php the_ID(); ?>" class="product type-product status-publish has-post-thumbnail nb_material" >
					<div class="row">
					
						<?php /* Toggle different material templates  */
						
							include_once( dirname(__FILE__).'/single-nb_mat_'.$cat_slug.'.php' );
							
						?>
						
					</div>

				</div><!-- #product-<?php the_ID(); ?> -->

			<?php endwhile; // end of the loop. ?>						
				

  
		</div><!-- /.main-->
	</div><!-- /.row -->
</div><!-- /.container -->
	  
	  
<?php get_footer(); ?>