	<?php get_header(); ?>
			<div id="pageheader" class="titleclass">
				<div class="header-color-overlay"></div>
					<div class="container">
						<div class="page-header">
							<div class="row">
								<div class="col-md-12">
									<h1 class="post_page_title entry-title" itemprop="name headline">Testimonial</h1>
									  
								</div>
							</div>
						</div>
					</div><!--container-->
				</div><!--titleclass-->
        <div id="content" class="container">
          <div class="row single-article" itemscope="" itemtype="http://schema.org/BlogPosting">
            <div class="main <?php echo esc_attr( pinnacle_main_class() ); ?>" role="main">
              <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('postclass'); ?>>
                  
                  <header>
                      <h1 class="entry-title" itemprop="name headline"><?php the_title(); ?></h1>
					<div class="subhead"><span class="postdate"><span class="postday">Certified Doula, Alumnus</span> of <span class="postday">New Beginnings Doula Training</span></span></div><!-- /.subhead -->
                      <?php //get_template_part('templates/entry', 'meta-subhead'); ?>
                  </header>
                  <div class="entry-content clearfix" itemprop="description articleBody">
                    <?php if ( has_post_thumbnail() ) { the_post_thumbnail('medium', array( 'class' => 'alignleft' ) ); } ?>
					<?php 
						$cert_since = get_post_meta( get_the_ID(),'certified_since',true );
						$alumnus_profile_link = get_post_meta(  get_the_ID(),'alumnus_profile_link',true );
					?>
					<p class="cert-meta">CERTIFIED DOULA since <span class="cert-date"><?php echo $cert_since;?></span> <!-- <span class="view-profile">(<a href="<?php echo $alumnus_profile_link;?>">view profile</a>)</span> --> </p>
					
					<?php the_content(); ?>
					
					
                    <?php wp_link_pages(array(
						'before' => '<nav class="page-nav"><p>' . __('Pages:', 'pinnacle'),
						'after' => '</p></nav>')); ?>
                  </div>
                  <footer class="single-footer clearfix">
                    <?php get_template_part('templates/entry', 'meta-footer'); ?>
                  </footer>
                </article>
               <div class="kad-post-navigation clearfix">
					<div class="alignleft kad-previous-link">
						<?php previous_post_link('%link', __('Previous', 'pinnacle')); ?> 
					</div>
					<div class="alignright kad-next-link">
						<?php next_post_link('%link', __('Next', 'pinnacle')); ?> 
					</div>
			 </div> <!-- end navigation -->
            <?php endwhile; ?>
          </div>
			<?php get_sidebar(); ?>
	    	</div><!-- /.row-->
		</div><!-- /.content -->
	</div><!-- /.wrap -->
	<?php get_footer(); ?>