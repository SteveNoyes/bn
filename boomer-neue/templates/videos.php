<div class="<?php if(get_sub_field('width') == "full-width") { echo "container-fluid"; } else {echo "container";} ?>">
  <div class="row <?php if (get_sub_field('classes') !== "") {echo the_sub_field('classes'); } else { echo "py-2";} ?>" style="<?php if (get_sub_field('text_color') !== "") {?>color: <?php echo the_sub_field('text_color');?>; <?php } ?> <?php if (get_sub_field('background_color') !== "") {?>background-color: <?php echo the_sub_field('background_color');?>; <?php } ?>">
    <div class="<?php if (get_sub_field('classes') !== "") {echo the_sub_field('classes'); } else { echo "col-sm-12";} ?>">
      <div class="videos">
        <div class="videos__wrap owl-carousel">
          <?php
          if( have_rows('videos') ):
              while ( have_rows('videos') ) : the_row();
                $video = get_sub_field('video');
                 ?>
                 <div class="videos__item" style="max-width: 40rem;margin: 0 auto;">
                   <div class="youtube" data-embed="<?php echo $video; ?>">

                      <!-- (2) the "play" button -->
                      <div class="play-button"></div>

                  </div>

                 </div>
            <?php
              endwhile;
            endif;
            ?>
          </div>
      </div>
    </div>
  </div>
</div>
