<div class="container">
  <div class="row mt-4 mb-4">
    <div class="col-sm mt-4 mb-4">
      <h3 class="center">Our Blog</h3>
      <h2 class="center">Latest News</h2>
    </div>
  </div>
</div>
<div class="container padded mb-5">
  <div class="row mb-5 justify-content-center">
  <?php
     $the_query = new WP_Query( array(
       'post_type' => 'post',
        'posts_per_page' => 3,
     ));
  ?>
  <?php if ( $the_query->have_posts() ) : ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
    <a href="<?php the_permalink(); ?>" class="col-sm state--activatable">
      <div class="meta">
        <div class="circle cover" style="background-image:url('<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>')"></div>
        <h4 class="center"><?php
                        $categories = get_the_category(get_the_ID());
                        foreach( $categories as $category) {
                            $name = $category->name;
                            $category_link = get_category_link( $category->term_id );
                            echo "<span class='" . esc_attr( $name) . "'></span>";
                        }
                        ?></h4>
        <h3><?php the_title(); ?></h3>
        <div class="identity"><span class="person"><?php the_author(); ?></span><span class="calendar">Sep 6, 2019</span></div>
        <p><?php echo strip_tags(get_the_excerpt()); ?></p>
      </div>
    </a>

  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>

<?php else : ?>
  <p><?php __('No News'); ?></p>
<?php endif; ?>
</div>

</div>
