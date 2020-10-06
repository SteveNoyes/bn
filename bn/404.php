<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WP_Bootstrap_4
 */

get_header(); ?>

<?php
	$default_sidebar_position = get_theme_mod( 'default_sidebar_position', 'right' );
?>

	<div class="container">
		<div class="row my-5">
			<div class="col-md-12 wp-bp-content-width">
				<div id="primary" class="content-area wp-bp-404">
					<main id="main" class="site-main">

						<div class=" mt-3r">
								<section class="error-404 not-found">
									<header class="page-header">
										<h1 class="page-title" style="text-align:center;"><?php esc_html_e( 'That page can&rsquo;t be found.', 'wp-bootstrap-4' ); ?></h1>
									</header><!-- .page-header -->
								</section><!-- .error-404 -->
							</div>
							<!-- /.card-body -->
						</div>
						<!-- /.card -->

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
