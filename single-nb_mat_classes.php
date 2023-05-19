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

?>

<div class="col-md-5 product-img-case">
						
						
						<!-- START IMAGE CODE -->
					
							<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
								<figure class="woocommerce-product-gallery__wrapper <?php echo esc_attr($galleryslider.' '.$galleryzoom);?>">
								<?php
									if(! $galslider) {
										echo '<div class="product_image postclass">';
									}

									$attributes = array(
										'title'                   => $image_title,
										'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
										'data-src'                => $full_size_image[0],
										'data-large_image'        => $full_size_image[0],
										'data-large_image_width'  => $full_size_image[1],
										'data-large_image_height' => $full_size_image[2],
									);
									
									if ( has_post_thumbnail() ) {
										if($presizeimage == 1){
											$alt = esc_attr( get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true) );
											if( !empty($alt) ) {
												$alttag	= $alt;
											} else {
												$alttag	= $light_title;
											}
											$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" title="'.esc_attr($light_title).'">';
											$html .= pinnacle_get_full_image_output($productimgwidth, $productimgheight, true, 'attachment-shop_single shop_single wp-post-image', $alttag, $post_thumbnail_id, false, false, false, $attributes);
											$html .= '</a></div>';
										} else {
											$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
											$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
											$html .= '</a></div>';
										}
									} else {
										$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
										$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( $cbl_placeholder_src ), esc_html__( 'Awaiting product image', 'pinnacle' ) );
										$html .= '</div>';
									}

									echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
									
									if(! $galslider) {
										echo '</div>';
									}
									if(! $galslider) {
										echo '<div class="product_thumbnails thumbnails">';
									}

									if ( $attachment_ids ) {
										if(isset($pinnacle['product_simg_resize']) && 0 == $pinnacle['product_simg_resize'] || false == $galslider) {
											$presizeimage = 0;
										} else {
											$presizeimage = 1;
											$productimgwidth = 458;
											$productimgheight = 458;
										}

											foreach ( $attachment_ids as $attachment_id ) {
												$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
												$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
												$image_title      	= get_post_field( 'post_excerpt', $attachment_id);
												if(!empty($image_title)) {
													$light_title  = $image_title;
												} else {
													$light_title  = get_the_title($attachment_id );
												}
												$attributes = array(
													'title'                   => $image_title,
													'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
													'data-src'                => $full_size_image[0],
													'data-large_image'        => $full_size_image[0],
													'data-large_image_width'  => $full_size_image[1],
													'data-large_image_height' => $full_size_image[2],
												);
												if($presizeimage == 1){
													$html  = '<div data-thumb="' .  esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" data-rel="lightbox[product-gallery]" class="postclass" title="'.esc_attr($light_title).'">';
													$html .= pinnacle_get_full_image_output($productimgwidth, $productimgheight, true, 'attachment-shop_single shop_single wp-post-image', $light_title, $attachment_id, false, false, false, $attributes);
													$html .= '</a></div>';
												} else {
													$html  = '<div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" data-rel="lightbox[product-gallery]" class="postclass" title="'.esc_attr($light_title).'">';
													$html .= wp_get_attachment_image( $attachment_id, $output_size, false, $attributes );
													$html .= '</a></div>';
												}

												echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
											}

									}

									if(! $galslider) {
										echo '</div>';
									}?>		
								</figure>
							</div>
						
						<!-- END IMAGE CODE -->		
							
							
							
							
							
						</div>
						<div class="col-md-7 product-summary-case">
							<div class="summary entry-summary postclass">
								
								<!-- START SUMMARY CODE -->
								
								<h1 itemprop="name" class="entry-title"><?php the_title();?></h1>
								
								<div class="material-meta">
									<?php if( $mat_tags ): ?>
									
									<span class="mat-meta-tags">
										
									<?php 
									
									//var_dump( $mat_tags );
									
									$mt_count = count( $mat_tags );
									$mt = 1;
									foreach($mat_tags as $m_tag){
										$link = get_term_link( $m_tag->term_id, 'mat_tags' );
										echo "<a href='{$link}'>{$m_tag->name}</a>";
										if( $mt < $mt_count ){
											echo ", ";
											$mt++;
										}
										
									}
									
									?>
										
									</span>
									
									<?php endif; ?>
								</div>
								
								<?php if( cbl_user_is( 'paying' ) && $downloads ): ?>	
									<div class="mat-download">
									<h5>Download Options:</h5>
										<ul>
								<?php
									
									foreach($downloads as $d_name => $d_url)
										echo "<li><a href='".site_url( '', 'https' )."{$d_url}'>{$d_name}</a></li>";
										
								?>		
										<!-- <li><a href="#">Form.PDF (487Kb)</a></li>
										<li><a href="#">Form.ODS (20.7Kb)</a></li> -->
										</ul>
									</div>
								<?php endif; ?>
								
								<div class="mat-short-description" >	
									<?php the_content(); ?>
								</div>
								
								<?php if( cbl_user_is( 'paying' ) || cbl_user_is( 'preview' ) ):?>
								
									<div class="mat-register-prompt">
										<h5>Class Access:</h5>
										<div class="mat-register-btn">
											<a class="kad-btn-primary kad-btn" href="<?php echo site_url( '/program/'.$post->post_name, 'https' );?>">Start Now!</a>
										</div>
										<p>To enter this course of study, <br />
										follow the prompt.</p>
									</div>
									
								<?php else : ?>
								
									<div class="mat-register-prompt">
										<h5>Access Options:</h5>
										<div class="mat-register-btn">
											<a class="kad-btn-primary kad-btn" href="<?php echo site_url( '/register/', 'https' );?>">Register</a>
										</div>
										<p>To begin this course of study, <br />
										register for an account.</p>
									</div>
									
								<?php endif;
								
								if( !empty( $mat_atts ) ):
								
									//Need to prepare for three columns.
									$num_ma = count( $mat_atts );
									$col_num = ( ceil( $num_ma / 3 ) * 3);  
									
								?>
									<div class="mat-attributes">

										<ul>
										
										<?php
											$a = 1; 
											foreach( $mat_atts as $a_title => $a_value ){
												echo "<li><strong>{$a_title}</strong> {$a_value}</li>";
												$a++;
											}
											//finish the set of columns to be an even three.
											while( $a <= $col_num ){
												echo "<li>&nbsp;</li>"; 
												$a++;
											}
											
										?>
											
										</ul>
										
									</div>
								
								<?php endif; ?>
								<!-- END SUMMARY CODE -->
								
							</div><!-- .summary -->
						</div>
