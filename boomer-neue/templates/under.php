<div class="article__under">
  <div class="article__banner wrap noPad">
  <?php

// check if the repeater field has rows of data
if( have_rows('columns') ):

 	// loop through the rows of data
    while ( have_rows('columns') ) : the_row();
      ?>
      <div class="article__banner__item">
      <div class="article__banner__item__icon" style="background-image:url('<?php the_sub_field('image'); ?>');"></div>
     <?php the_sub_field('text'); ?>
    </div>
      <?php
        // display a sub field value
      

    endwhile;

else :

    // no rows found

endif;

?>
    

  </div>
</div>
