<dl class="accordion">
<?php $counter = 0; ?>
<?php
 while (have_rows('accordion')) : the_row();
?>
<dt class="<?php if( $counter == 0 ) { ?>active<?php } ?>"><?php the_sub_field('title'); ?></dt>
<dd><?php the_sub_field('editor'); ?></dd>
<?php
$counter++;
endwhile;
?>
</dl>
