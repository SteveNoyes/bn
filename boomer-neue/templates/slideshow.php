<div class="hero">
  <div class="owl-carousel owl-theme">
    <?php
     // loop through the rows of data
     while (have_rows('item')) : the_row();
    ?>
      <a href="<?php echo get_sub_field('link')['url']; ?>" class="item" style="background-image:url(<?php the_sub_field('image'); ?>);">
        <div class="item__wrap">
          <div class="wrap">
            <?php the_sub_field('editor'); ?>
          </div>
        </div>
      </a>

    <?php
    endwhile;
    ?>


  </div>
</div>
