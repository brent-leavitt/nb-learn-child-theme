<?php
/**
 * The Template for displaying products in a product tag. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/woocommerce/taxonomy-product_tag.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



$cbl_placeholder_id = 4557;


/*--- START TEMPLATE ---*/

get_header();

get_template_part('templates/page', 'header');
	
	?>

		<div id="content" class="container">
			<div class="row">
				<div class="main col-md-12" role="main">
     			<?php
				if( !cbl_user_is( 'paying' ) && !cbl_user_is( 'preview' )  ):
					
				?>
					
					<div class="row preview-cta">
						<div class="col-md-10"><h3>Preview the Childbirth Libary with 10 days of free acccess!</h3></div>
						<div class="col-md-2"><a href="/library-access/#subscribe-preview" class="kad-btn-primary kad-btn lg-kad-btn">Preview Now</a> </div>
					</div>
				
				
				<?php
				
				endif;
				?>
				
					<div class="row cat-list">
				<?php
				
				$post_num = 1;
				
				while( have_posts() ): the_post(); 
				
				$col_num = ( $post_num < 4 )? 4 : 3 ; //toggles the col-md-? class. 
				
					echo "<div class='col-md-{$col_num} kad_product'>";	?>
							<div <?php post_class(); ?>>

								<a href="<?php the_permalink(); ?>" >
									
									<span class="cbl-cat-item-img">
									<?php 
									if ( has_post_thumbnail() ) {
									
										the_post_thumbnail('medium'); 
									
									}else{
										
										echo wp_get_attachment_image( $cbl_placeholder_id , 'medium' );
									}
									
									?> </span>
									<span class="cbl-cat-item-title"><?php the_title(); ?></span>
								</a>
							</div>
						</div>
			<?php if( $post_num === 3 && cbl_user_is( 'non_paying' ) ): ?>
					</div>
					<div class="row register-cta">
						<div class="col-md-10"><h3>Sign up for the full access to the Childbirth Library!</h3></div>
						<div class="col-md-2 kad-call-button-case"><a href="/library-access/" class="kad-btn-primary kad-btn lg-kad-btn">Register Now</a></div>
					</div>
					<div class="row cat-list" >
			<?php endif;
				
			$post_num++;
			endwhile; 
			?>
			
				
					</div>
				</div><!-- /.main-->
			</div><!-- /.row -->
		</div><!-- /.content -->
  <?php get_footer(); ?>