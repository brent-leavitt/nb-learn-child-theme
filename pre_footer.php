<?php
//Childbirth Library theme
//pre-footer
 global $post;
 if( isset( $post->post_name ) ):	 
	$post_slug = $post->post_name;
	
 $no_show_array = ['access', 'library-access', 'thank-you', 'sign-in', 'register']; //Slugs of pages to not show the pre_footer CTA on. 
?>
	
<div class="pre_footer">

	<?php if ( is_user_logged_in() || ( in_array( $post_slug, $no_show_array ) ) ):?>
			
	<?php else: ?>
		<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/nb_heart.png" alt="New Beginnings heart logo"	/>
		<h2>Your Next Step</h2>
		<p>Prepare for the birthing experience <br> with New Beginnings Doula <br>Training &amp; Childbirth Library!</p>
		<div class="start_cta">
			<a class="feature_cta kad-btn-primary kad-btn lg-kad-btn" href="/register/">Get Started</a>
			<?php //if( $post_slug !== 'how-to-join' ):	<a class="secondary_cta" href="/how-to-join/">More details, please!</a>?>
		
			<?php //endif;?>
		</div><!-- end .start_cta -->
	<?php endif;  ?>
	
</div><!-- end .pre_footer -->
	

	
<?php else:
	 
	 return;
	 
 endif; ?>





