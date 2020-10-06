<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_4
 */

?>

	</div><!-- #content -->
	<div class="footer">
	  <img class="footer__logo" src="<?php the_field('footer_logo', 'option'); ?>" alt=""/>
	  <div class="footer__list wrap">
	  <?php wp_nav_menu( array( 'menu' => 'secondary' ) ); ?>
	  </div>
	</div>
	<div class="footer__bottom">
	  <div class="col-full wrap">
<?php

// check if the repeater field has rows of data
if( have_rows('footer_columns', 'option') ):
 	// loop through the rows of data
    while ( have_rows('footer_columns', 'option') ) : the_row(); ?>

		<div class="footer__bottom__col">

		<?php

		// Check value exists.
		if( have_rows('content') ):

		    // Loop through rows.
		    while ( have_rows('content') ) : the_row(); ?>

				<?php

		        if( get_row_layout() == 'html_block' ):
		            echo get_sub_field('html_block');

		        elseif( get_row_layout() == 'social_block' ):

							// check if the repeater field has rows of data
							if( have_rows('socials') ): ?>
							<div class="social">
							<?php

							 	// loop through the rows of data
							    while ( have_rows('socials') ) : the_row(); ?>
									<a class="social__item <?php the_sub_field('service'); ?>" target="_blank" href="<?php the_sub_field('link'); ?>"></a>
									<?php endwhile; ?>
								</div>
							<?php else :

							    // no rows found

							endif;
		        endif;

		    // End loop.
		    endwhile;

		// No value.
		else :
		    // Do something...
		endif; ?>
			</div>
				<?php
    endwhile;

else :
    // no rows found
endif;

?>


	  </div>
	</div>
	<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
	<script type="text/javascript">window.Beacon('init', '0997680d-5409-4e07-9bb5-53dd3286539b')</script>
		<?php wp_footer(); ?>

	</body>
	</html>
