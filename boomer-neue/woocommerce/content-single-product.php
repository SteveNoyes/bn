<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

function nl2p($text)
{
    return '<p>'.str_replace(array("\r\n", "\r", "\n"), '</p><p>', $text).'</p>';
}

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<?php	do_action( 'woocommerce_before_single_product' ); ?>

<div class="article product">
	<div class="productPage wrap">
    <h1><?php echo get_the_title( get_the_id() ); ?></h1>

    <div class="productPage__meta">
      <div class="productPage__image">
        <div class="productPage__image__wrap">
					<?php echo $product->get_image(); ?>
          <h3 class="price">
            $<span class="price_changer"><?php echo $product->get_price(); ?></span>
            <div class="immediate immediate__sub">Save 5%<span>subscribe to your order</span></div>
            <div class="immediate__flex">
              <div class="immediate">Buy Now</div>
              <div class="immediate__configure"><i class="fas fa-cog"></i><span>Select Options</span></div>

            </div>
          </h3>
          <!-- <div class="images">
            <div class="images__item"><img src="assets/images/demo.png"/></div>
            <div class="images__item play"><img src="assets/images/jeff.jpeg"/></div>
          </div> -->
        </div>
      </div>
      <div class="productPage__desc">
        <?php echo nl2p($product->get_description()); ?>
        <p><strong>Categories</strong>: <?php echo wc_get_product_category_list( get_the_id() ); ?></p>
        <?php	do_action( 'woocommerce_single_product_summary' ); ?>

      </div>
    </div>
  </div>
</div>
