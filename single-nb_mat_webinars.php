<?php
/**
 * The Template for displaying single materials in the Childbirth Library.
 *
 * @author 		Brent Leavitt (www.trainingdoulas.com)
 * @package 	
 * @version     
 *
 */

 
 //Needs extra provisions added for webinar videos and transcript fuctionality. 
 //Maybe just add short codes that toggle when users have access to certain materials. 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* WEBINAR specific parameters */

$webinars = get_post_meta( $post->ID, '_nb_cbl_webinar', true );

if( !empty( $webinars ) ){
	$wfa = each( $webinars ); //Assign first set from array to the full webinar variable.
	$wpa = each( $webinars ); //Assign the second set from the array to the preview webinar variable. 	
}

$webinar_full = webinar_setup( ( !empty( $wfa ) )? [ $wfa[0] => $wfa[1] ] : NULL );
$webinar_preview = webinar_setup( ( !empty( $wpa ) )? [ $wpa[0] => $wpa[1] ] : NULL );

function webinar_setup( $arr ){
	
	if( empty( $arr ) )
		return NULL; 
	
	//$arr should hold two variables as a key-value pair: 
	// 	- key: (service name: youtube, vimeo, etc.)
	//	- val: ID for the video on the selected service. 
	
	$service = key( $arr ); //There should only be one key/value pair.
	$video_id = $arr[ $service ]; 
	
	$output = '';
	
	//Add Uniform Size Parameters. 
	
	switch( $service ){
		
		case 'youtube':
			
			$output = ' <iframe id="ytplayer" type="text/html" width="720" height="405" src="https://www.youtube.com/embed/'.$video_id.'?rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>';
			
			break;
		
		case 'vimeo':
			
			$output = '<iframe src="https://player.vimeo.com/video/'.$video_id.'" width="640" height="360" frameborder="0" allowfullscreen></iframe>';
			
			break;
		
		default:
			break;
		
	}
	
	return $output; 
	
}
?>

						<div class="col-md-12 product-summary-case">
							<div class="summary entry-summary postclass">
								
								<!-- START SUMMARY CODE -->
								
								<h1 itemprop="name" class="entry-title"><?php the_title();?></h1>
								
								<div class="author-meta"> by <?php the_author_link(); ?> </div>
									
									<?php if( !cbl_user_is( 'paying' ) && !cbl_user_is( 'preview' )  ): 
									
										if( !empty( $webinar_preview ) ):  //show preview video for webinar ?>
										
											<div class="webinar-wrap" >
											
												<?php echo $webinar_preview;?>

											</div>
											
										<?php else: //start placeholder image code: ?>
										
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
									<?php  endif;  ?>
								
								
								<?php else: 
								
									// ADD CODE TO CALL WEBINAR: 
									if( !empty( $webinar_full ) ):?>
										
										<div class="webinar-wrap" >
										
											 <?php echo $webinar_full; ?>
										
										</div>
										
									<?php endif;
								endif; ?>
								
									
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
							
								<h5>Access Options:</h5>
								<div class="mat-register-btn">
									<a class="kad-btn-primary kad-btn" href="<?php echo site_url( '/library-access/', 'https' );?>">Register</a>
								</div>
								
								<p>Start your free 10-day trial to gain full access to this webinar.</p>
							
							
							<?php elseif( cbl_user_is( 'preview' ) && $downloads ): ?>
							
								<h5>Access Options:</h5>
								<div class="mat-register-btn">
									<a class="kad-btn-primary kad-btn" href="<?php echo site_url( '/library-access/', 'https' );?>">Register</a>
								</div>
								<p>Start a paid subscription to get download access.</p>
													
							
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
								<p><em>There are no downloads available for this webinar.</em></p>
							
							
							<?php endif; ?>
							
							</div>
							<!-- END SUMMARY CODE -->
							
						</div>
						<?php if( cbl_user_is( 'paying' ) ): 
						//Need to add transcripts functionality. 
						?>
						
					</div><!-- end ROW -->
					<div class="row">
						<div class="col-md-12 transcript" >
							<h2>Transcripts</h2>
							
							<?php the_content(); ?>
						
						</div>
					
						<?php endif; ?>
					
						
						