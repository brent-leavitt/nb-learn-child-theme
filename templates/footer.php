<?php 
//Modified for NB Childbirth Library theme
global $pinnacle; ?>
<footer class="footerclass">

	<div class="container" id="ftr_social">
		<h3><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo/NBCS_white.png" alt="New Beginnings Childbirth Services" width="400px" height="76px" /></h3>
		<p>Follow New Beginnings on social media for<br/>great birth tips and inspiration.</p>
		<?php if (is_active_sidebar('ftr_social') ) { ?> 
			<div class="ftr_social">
				<?php dynamic_sidebar('ftr_social'); ?>
			</div> 
		<?php }; ?>
	</div>
  	<div class="container">
  		<div class="row footer_menus">
  			
			<?php if (is_active_sidebar('nb_footer_1') ) { ?> 
				<div class="col-md-4 footercol1">
				<?php dynamic_sidebar('nb_footer_1'); ?>
				</div> 
			<?php }; ?>
			<?php if (is_active_sidebar('nb_footer_2') ) { ?> 
				<div class="col-md-4 footercol2">
				<?php dynamic_sidebar('nb_footer_2'); ?>
				</div> 
			<?php }; ?>
			<?php if (is_active_sidebar('nb_footer_3') ) { ?> 
				<div class="col-md-4 footercol3">
				<?php dynamic_sidebar('nb_footer_3'); ?>
				</div> 
			<?php }; ?>
        </div> <!-- Row -->
    	<div class="footercredits clearfix">
    		<?php if (has_nav_menu('footer_navigation')) :?>
    			<div class="footernav clearfix">
    			<?php wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footermenu'));?>
    			</div>
    		<?php endif;?>
        	<?php if(!empty($pinnacle['footer_text'])) { 
        		$footerstring = $pinnacle['footer_text'];
        		$footerstring = str_replace('[copyright]','&copy;',$footerstring);
        		$footerstring = str_replace('[the-year]',date('Y'),$footerstring);
        		$footerstring = str_replace('[site-name]',get_bloginfo('name'),$footerstring);
        		echo '<p>'. do_shortcode($footerstring).'</p>';} ?>
    	</div><!-- credits -->
    </div><!-- container -->
</footer>
<?php wp_footer(); ?>