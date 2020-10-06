<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */

get_header(); ?>

				<div id="primary" class="content-area">
					<main id="main" class="site-main simple-page">
						<?php while (have_posts()) : the_post(); ?>

						  <?php the_content(); ?>

						<?php endwhile; ?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<!-- /.col-md-12 -->

<?php
get_footer();
