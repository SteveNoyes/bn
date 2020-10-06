<?php get_header();
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

	<style>
	<?php the_field('custom_css', $term); ?>
	</style>

	<div class="container-fluid add-header">
		<div class="row row px-0 py-4" style="background-color:#547A98;	background-image: linear-gradient(244deg, #38627b 0%, #547A98 94%);">
		  <div class="col-md py-4" style="color:#fff">
		    <h1 class="bold center" style="text-transform: capitalize;"><?php echo $page_title; ?></h1>
				<div class="term-description"><?php echo $description; ?></div>
				<a class="button__heading" href="#slide">Learn More</a>
		  </div>
		</div>
	</div>

	<div class="container">
		<div class="row pt-2">
			<div class="col-md pt-5 text-center subby">
				<p class="bold colored" style="font-weight:bold;color:#547A98;">Shop</p>
				<h2 class=" center" style="font-weight:bold;"><?php echo $sub_title; ?></h2>
				<?php echo $sub_description; ?>
			</div>
		</div>
	</div>

	<div class="breadcrumb wrap">
		<?php woocommerce_breadcrumb();?>
	</div>


	    <?php
	        // Only run on shop archive pages, not single products or other pages
	        if ( is_shop() || is_product_category() || is_product_tag() ) {
	            // Products per page
							?>
							<div class="container">
							  <div class="row ml-2 mr-2 mb-5 d-flex flex-wrap">
							<?php
	            $per_page = 15;
	            if ( get_query_var( 'taxonomy' ) ) { // If on a product taxonomy archive (category or tag)
	                $args = array(
	                    'post_type' => 'product',
	                    'posts_per_page' => $per_page,
	                    'paged' => get_query_var( 'paged' ),
	                    'tax_query' => array(
	                        array(
	                            'taxonomy' => get_query_var( 'taxonomy' ),
	                            'field'    => 'slug',
	                            'terms'    => get_query_var( 'term' ),
	                        ),
	                    ),
	                );
	            } else { // On main shop page
	                $args = array(
	                    'post_type' => 'product',
	                    'orderby' => 'popularity',
	                    'order' => 'DESC',
	                    'posts_per_page' => $per_page,
	                    'paged' => get_query_var( 'paged' ),
	                );
	            }
	            // Set the query
	            $products = new WP_Query( $args );
	            // Standard loop
	            if ( $products->have_posts() ) :
	                while ( $products->have_posts() ) : $products->the_post();
	                    // Your new HTML markup goes here
	                    ?>
											<?php
												$id = get_the_ID();
												$price = get_post_meta( $id, '_price', true );
												$terms = get_the_terms( $id, 'product_cat' );
												$image = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'single-post-thumbnail' );
												?>

			              <a href="<?php the_permalink(); ?>" class="col-lg-4  state state--active state--hoverable">
			                <div class="meta">
												<div class="description__image__wrap">
													<img class="description__image" src="<?php echo $image[0]; ?>" />
												</div>

												<h4><?php foreach ($terms as $term) {
												    echo $term->name;
												    break;
												} ?></h4>
												<h3 class="no"><?php the_title(); ?></h3>
												<h3 class="price">$<?php echo  $price ; ?>
					                <button class="cart__add"> <span>Information</span></button>
					              </h3>
			                </div>
		              </a>


	                <?php
	                endwhile;
	                wp_reset_postdata();
									?>
							<?php endif; ?>
						</div>
					</div>
							<?php
							the_posts_pagination( array(
								'mid_size'  => 2,
								'prev_text' => __( 'Prev', 'textdomain' ),
								'next_text' => __( 'Next', 'textdomain' ),
							) );
	        } else { // If not on archive page (cart, checkout, etc), do normal operations
	            woocommerce_content();
	        }
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



	<?php get_footer(); ?>
