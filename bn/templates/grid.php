
<div class="<?php if(get_sub_field('width') == "full-width") { echo "container-fluid"; } else {echo "container";} ?> <?php if(get_sub_field('overlay')) { echo "overlay"; } ?>">
  <div class="row <?php if (get_sub_field('classes') !== "") {echo the_sub_field('classes'); } else { echo "py-2";} ?>"
    style="<?php if (get_sub_field('text_color') !== "") {?>color: <?php echo the_sub_field('text_color');?>; <?php } ?>
    <?php if (get_sub_field('text_shadow')) {?>text-shadow: 2px 2px 2px rgba(0,0,0,.5); <?php } ?>

    <?php if (get_sub_field('background_color') !== "") {?>background-color: <?php echo the_sub_field('background_color');?>; <?php } ?>
    <?php $image = get_sub_field('background_image'); ?>
    <?php if (get_sub_field('background_image') !== "") {?>background-image: url('<?php echo esc_url($image['url']); ?>'); background-size: cover;<?php } ?>
    <?php if (get_sub_field('css_gradient') !== "") { ?>background:<?php echo the_sub_field('css_gradient'); ?> <?php } ?>

      ">
    <?php
    // loop through the rows of data
    while (have_rows('column')) : the_row();
    ?>
    <?php $settings = get_sub_field('settings'); ?>

    <?php if(in_array('link',$settings)) {

      $link = get_sub_field('link');
      $link_url = $link['url'];
      $link_target = $link['target'] ? $link['target'] : '_self';
      ?>
      <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>" class="<?php if (get_sub_field('classes') !== "") {echo the_sub_field('classes'); } else { echo "col-sm-6";} ?><?php if(in_array('active',$settings)) { echo " state--active"; } ?> <?php if(in_array('border',$settings)) { echo " state--border"; } ?> <?php if(in_array('borderhover',$settings)) { echo " state--borderHover"; } ?>">
    <?php } else { ?>
      <div class="<?php if (get_sub_field('classes') !== "") {echo the_sub_field('classes'); } else { echo "col-sm-6";} ?><?php if(in_array('active',$settings)) { echo " state--active"; } ?> <?php if(in_array('border',$settings)) { echo " state--border"; } ?> <?php if(in_array('borderhover',$settings)) { echo " state--borderHover"; } ?>">
    <?php }?>

      <?php if(in_array('meta',$settings)) { ?>
        <div class="meta pl-2 pr-2">
      <?php } ?>
    <?php

      if (get_row_layout() == 'editor') { ?>
      <?php if(in_array('circle',$settings)) { ?>
        <div class="circle" style="background-image: url('<?php echo get_sub_field('circle_image')['sizes'][ 'thumbnail' ]; ?>'); max-width: <?php echo the_sub_field('image_width'); ?>; width: <?php echo the_sub_field('image_width'); ?>; background-position: <?php echo the_sub_field('image_position'); ?>; background-size: <?php echo the_sub_field('image_size'); ?>"></div>
      <?php } ?>

        <?php the_sub_field('editor'); ?>
        <?php if(in_array('view',$settings)) { ?>
          <div class="meta__view">
            View
          </div>
        <?php }} ?>


      <?php if (get_row_layout() == 'video') {?>
        <?php $video = get_sub_field('video');
         ?>
         <div class="videos__item" style="max-width: 40rem;margin: 0 auto;">
           <div class="youtube" data-embed="<?php echo $video; ?>">

              <!-- (2) the "play" button -->
              <div class="play-button"></div>

          </div>

         </div>
         <?php the_sub_field('editor'); ?>
        <?php } ?>




      <?php if (get_row_layout() == 'grid') {
             // loop through the rows of data
             ?>
             <div class="container">
             <div class="row">
             <?php
              while (have_rows('grid')) : the_row();
              ?>

            <?php if(in_array('link',$settings)) {
              $link = get_sub_field('link');
                  $link_url = $link['url'];
                  $link_title = $link['title'];
                  $link_target = $link['target'] ? $link['target'] : '_self';
                  ?>

              ?>
              <a href="<?php echo esc_url($link_url); ?>" target="<?php echo $link_target; ?>" class="<?php if (get_sub_field('classes') !== "") {echo the_sub_field('classes'); } else { echo "col-sm-6";} ?><?php if(in_array('active',$settings)) { echo " state--active"; } ?>">
            <?php } else { ?>
              <div class="<?php if (get_sub_field('classes') !== "") {echo the_sub_field('classes'); } else { echo "col-sm-4";} ?><?php if(in_array('active',$settings)) { echo " state--active"; } ?>">
            <?php }?>
              <?php if(in_array('meta',$settings)) { ?>
                <div class="meta pl-2 pr-2">
              <?php } ?>
              <?php
                if (get_row_layout() == 'editor'):
                     the_sub_field('editor');
                endif;
              ?>

              <?php if(in_array('meta',$settings)) { ?>
                </div>
              <?php } ?>
              <?php if(in_array('link',$settings)) { ?>
              </a>
              <?php } else { ?>
              </div>
              <?php }?>
            <?php
          endwhile;?>
        </div>
      <?php } ?>
        <?php if(in_array('meta',$settings)) { ?>
          </div>
        <?php } ?>

        <?php if(in_array('link',$settings)) { ?>
          </a>
        <?php } else { ?>
          </div>
        <?php }?>
      <?php
    endwhile;
    ?>
    </div>
</div>
