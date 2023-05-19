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

						<div class="col-md-12 product-summary-case">
							<div class="summary entry-summary postclass">
								
								<!-- START SUMMARY CODE -->
								
								<h1 itemprop="name" class="entry-title"><?php the_title();?></h1>
								
								<div class="author-meta"> by <?php the_author_link(); ?> </div>
								
								
								<!-- START IMAGE CODE -->
					
								<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" >
									<figure class="woocommerce-product-gallery__wrapper <?php echo esc_attr($galleryslider.' '.$galleryzoom);?>">
										<div class="product_image postclass">
										<?php
										
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
											
										?>
										</div>
									</figure>
								</div>
							
								<!-- END IMAGE CODE -->		
							</div>
						</div>
					</div> <!-- end row -->
					<div class="row">
						<div class="col-md-7 text-summary">	
							
							<?php the_excerpt(); ?>
						</div> <!-- end .text-summary -->
					
						<div class="col-md-5 mat-wrapper">
							<div class="material-meta">
								<?php if( $doc_id ): ?>
																	
								<span class="mat-meta-id">Doc #<?php echo $doc_id; ?></span>
								
								<?php endif; 
								
								if( $mat_tags ): ?>
								
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
							
							
							<div class="mat-register-prompt">
							
							<?php if( !cbl_user_is( 'paying' ) ) : ?>
							
								<h5>Library Access:</h5>
								<div class="mat-register-btn">
									<a class="kad-btn-primary kad-btn" href="<?php echo site_url( '/library-access/', 'https' );?>">Register</a>
								</div>
								
								<p>Start your free 10-day trial to gain full access to this article.</p>
								
							<?php elseif( cbl_user_is( 'preview' ) && $downloads   ): ?>
							
								<h5>Download Access:</h5>
								<div class="mat-register-btn">
									<a class="kad-btn-primary kad-btn" href="<?php echo site_url( '/library-access/', 'https' );?>">Register</a>
								</div>
								<p>Start a paid subscription to download this eBook.</p>
							
							
							<?php elseif( cbl_user_is( 'paying' ) && $downloads ): ?>	
								
									<h5>Download Options:</h5>
									<ul>
							<?php
								foreach($downloads as $d_name => $d_url)
									echo "<li><a href='".site_url( '', 'https' )."{$d_url}'>{$d_name}</a></li>";
							?>		
									
									</ul>
								
							<?php else: ?>
								<h5>No Downloads Available:</h5>
								<p><em>There are no downloads available for this eBook.</em></p>
							
							<?php endif; ?>
							
							</div>
							<!-- END SUMMARY CODE -->
							
						</div>
					</div><!-- end row -->
					<div class="row">
						
						<?php //does not have full access. 
						if(  !cbl_user_is( 'paying' ) && !cbl_user_is( 'preview' )   ) : ?>
						
							<div class="col-md-12 content-preview">
								<div class="cbl-ebook-preview">
								
									<?php 
									
									$content_arr = get_extended ( $post->post_content ); 
										
									echo $content_arr['main']; //Display the part before the more tag  
									
									?>
									
								</div>
								
								<div class="cbl-ebook-cta">
									<a href="<?php echo site_url( '/library-access/', 'https' );?>">( Register for full access. )</a>
								</div>
							</div>
							
						<?php //does have full access. 
						else: ?>
						
							<div class="col-md-12 content-full">
						
								<?php the_content(); ?>
								
							</div>
								
							
						<?php endif; ?>
						
						
						