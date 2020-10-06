<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WP_Bootstrap_4
 */

get_header(); ?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
?>
<div class="container-fluid">
	<div class="row row px-0 py-5" style="background-color:#fff;">
		<div class="col-sm py-5" style="color:#111">
			<div class="meta">
			<h1 class="bold center">Blog</h1>
		</div>
		</div>
	</div>
</div>

	<div class="container">
		<div class="row">

				<div class="col-md-12 wp-bp-content-width mb-5">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;

						?>
						<div class="row my-3">
							<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();
						?>
							<div class="col-md-6">
						<?php
							// Include the Post-Format-specific template for the content.
							get_template_part( 'templates/parts/content', get_post_format() );
							?>
						</div>
							<?php
						endwhile;
						?>
					</div>
						<?php
						the_posts_navigation( array(
							'next_text' => esc_html__( 'Newer Posts', 'wp-bootstrap-4' ),
							'prev_text' => esc_html__( 'Older Posts', 'wp-bootstrap-4' ),
						) );

					else :

						get_template_part( 'templates/parts/content', 'none' );

					endif; ?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<!-- /.col-md-12 -->

			<?php if ( $default_sidebar_position != 'no' ) : ?>
				<?php if ( $default_sidebar_position === 'right' ) : ?>
					<div class="col-md-4 wp-bp-sidebar-width">
				<?php elseif ( $default_sidebar_position === 'left' ) : ?>
					<div class="col-md-4 order-md-first wp-bp-sidebar-width">
				<?php endif; ?>
						<?php get_sidebar(); ?>
					</div>
					<!-- /.col-md-4 -->
			<?php endif; ?>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->

<?php
get_footer();
