<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
defined( 'ABSPATH' ) || exit;

get_header();
  /**
   * @package WooCommerce/Templates
   * @version 3.9.0
   */
  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

  // vars
  $image = get_field('image', $term);
  $page_title = get_field('page_title', $term);
  $description = get_field('description', $term);
  $sub_title = get_field('sub_title', $term);
  $sub_description = get_field('sub_description', $term);

  $rows = get_field('rows', $term);

?>

	<!-- <div class="container-fluid add-header">
		<div class="row row px-0 py-4" style="background-color:#547A98;	background-image: linear-gradient(244deg, #38627b 0%, #547A98 94%);">
		  <div class="col-md py-4" style="color:#fff">
		    <h1 class="bold center" style="text-transform: capitalize;"><?php echo $page_title; ?></h1>
				<div class="term-description"><?php echo $description; ?>
        </div>
				<a class="button__heading" href="#slide">Learn More</a>
		  </div>
		</div>
	</div> -->

	<!-- <div class="container">
		<div class="row pt-2">
			<div class="col-md pt-5 text-center subby">
				<h2 class=" center" style="font-weight:bold;">
          <?php echo $sub_title; ?>
        </h2>
				<?php echo $sub_description; ?>
			</div>
		</div>
	</div> -->
  <?php
do_action( 'woocommerce_before_main_content' );
?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php
if ( woocommerce_product_loop() ) {
	/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
	do_action( 'woocommerce_before_shop_loop' );
	woocommerce_product_loop_start();
	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();
			/**
			 * Hook: woocommerce_shop_loop.
			 */
			do_action( 'woocommerce_shop_loop' );
			wc_get_template_part( 'content', 'product' );
		}
	}
	woocommerce_product_loop_end();
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
	/**
	 * Hook: woocommerce_no_products_found.
	 *
	 * @hooked wc_no_products_found - 10
	 */
	do_action( 'woocommerce_no_products_found' );
}
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );0
?>

<div class="article" id="slide">
  <?php
  $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
  if (have_rows('rows', $term)):
    while (have_rows('rows', $term)) : the_row();
      include get_template_directory().'/templates/switch.php';
    endwhile;
else :
endif;
?>
</div>
<?php
get_footer( 'shop' );
