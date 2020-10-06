<style>
.individual {display:flex; flex-wrap: wrap; border-radius:.25rem; overflow: hidden;}
.individual span {
  font-size: .8rem; text-align:center; max-width: calc(100% /3);flex: 1 0 calc(100% /3);padding: 1rem .5rem; background: #eee; transition: .5s all;
}
.individual span:hover {
  background: #ddd;
}
.individual span.active {
  background: #236f8a;
  color:#fff;
  font-weight:bold;
}
.info.active {
  transition: .5s;
  display: block;
  z-index: 10000;
  opacity:1;
}
.info:not(.active) {
  display: none;
  opacity: 0;
  z-index: 0;
}
.state.always_show_cta .cart__add {
  margin-right:0;
}
</style>

<script>
jQuery(function(){
  jQuery('.individual span').on('click', function(){
    var id = jQuery(this).attr('data-product');
    //console.log(id);
    jQuery(this).addClass('active');
    jQuery(this).siblings().removeClass('active');
    jQuery('.info[data-variant="'+id+'"]').addClass('active');
    jQuery('.info[data-variant="'+id+'"]').siblings().removeClass('active');
  })
})
</script>

<div class="container">
  <div class="row mb-5 justify-content-center">
    <?php
    $i = 1;
    if ( have_rows( 'products_listing' ) ) : ?>
      <?php while ( have_rows( 'products_listing' ) ) : the_row();
      ?>
        <?php
          $post_object = get_sub_field('product');
          $always_show_cta = get_sub_field('always_show_cta');
          $list_variants = get_sub_field('list_variants');
          $variant_to_list = get_sub_field('variant_list_list');

          $immediate = get_sub_field('immediate');
          $product_id = get_sub_field('product_id');
          $optional_text = get_sub_field('optional_text');

          if( $post_object ):
            $post = $post_object;
            setup_postdata( $post );
            $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID ), 'single-post-thumbnail' );
            $product = wc_get_product( $post->ID );
            $product_ids = $product->get_children();
            $immediate_product = wc_get_product( $product_id ); ?>

                <div class="col-md-4 px-2 state state--active state--hoverable <?php if($always_show_cta) {echo "always_show_cta";} ?>">
                  <div class="meta pl-2 pr-2 meta__long">
                    <a href="<?php the_permalink(); ?>">
                    <div class="description__image__wrap">
                      <img class="description__image" src="<?php echo $image[0]; ?>"/>
                    </div>
                    </a>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <h4 style="color:#333;font-size:.8rem;margin-bottom:1rem;"><?php echo $optional_text; ?></h4>

                    <?php if ($list_variants) {?>
                    <div class="variant-selector" data-drop="<?php echo $post->ID;?>">
                    <div class="individual">
                    <?php
                    $i = 0;
                    foreach ($product_ids as &$product_id) {
                      $id = wc_get_product( $product_id );
                      ?>
                      <span data-product="<?php echo $product_id; ?>" class="<?php if ($i == 0) { echo "active";}?>"><?php echo $id->get_attributes()['count']; ?></span>
                      <?php $i++;
                    } ?>
                    </div>

                    <?php
                    $i = 0;

                    foreach ($product_ids as &$product_id) {
                      $id = wc_get_product( $product_id );
                      ?>
                      <div class="info <?php if ($i == 0) { echo "active";}?>" data-variant="<?php echo $product_id; ?>">
                          <a href="?add-to-cart=<?php echo $product_id; ?>" class="cart__add product_type_simple add_to_cart_button ajax_add_to_cart added" data-quantity="1" data-product_id="<?php echo $product_id; ?>"> <span>Add To Cart</span></a>
                          <p class="price" style="font-size:1.5rem;"><a href="<?php the_permalink(); ?>"><strong>$<?php echo $id->get_price();?></strong></a></p>
                      </div>
                      <?php $i++;
                      } ?>
                      </div>
                    <?php } else {?>
                    <div class="info active">
                      <?php if($immediate) {?>
                        <a href="?add-to-cart=<?php echo $product_id; ?>" class="cart__add product_type_simple add_to_cart_button ajax_add_to_cart added" data-quantity="1" data-product_id="<?php echo $product_id; ?>"> <span>Add To Cart</span></a>
                        <p class="price" style="font-size:1.5rem;"><a href="<?php the_permalink(); ?>"><strong>$<?php echo $immediate_product->get_price();?></strong></a></p>
                      <?php } else { ?>
                        <a href="<?php the_permalink(); ?>" class="cart__add"> <span>Add To Cart</span></a>
                        <p class="price" style="font-size:1.5rem;"><a href="<?php the_permalink(); ?>"><strong>$<?php echo $product->get_price(); ?></strong></a></p>
                      <?php } ?>
                    </div>
                    <?php } ?>

                  </div>
                </div>
              <?php
                wp_reset_postdata();
              endif;
              $i += 1;

            endwhile; ?>
    <?php endif; ?>
  </div>
</div>
