<?php
/**
 * The template for displaying full width pages.
 *
 * Template Name: Designer
 *
 * @package storefront
 */

get_header();
if (have_rows('rows')):
    while (have_rows('rows')) : the_row();

    if (get_row_layout() == 'slideshow') {
      include get_template_directory() . '/templates/slideshow.php';
    }
    endwhile;

else :
endif;
?>
<div class="article">
<?php
if (have_rows('rows')):
    while (have_rows('rows')) : the_row();
      include get_template_directory().'/templates/switch.php';
    endwhile;
else :
endif;
?>
</div>
<?php get_footer();
