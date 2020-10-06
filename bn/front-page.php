<?php

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
  <h1 style="color:#f9f9f9; position:absolute;top:-1000px; left:-1000px;">Boomer Naturals</h1>

<?php
if (have_rows('rows')):
    while (have_rows('rows')) : the_row();
    ?>

        <?php
          if (get_row_layout() == 'grid'):
            include get_template_directory() . '/templates/grid.php';

          elseif (get_row_layout() == 'under'):
            include get_template_directory(). '/templates/under.php';

          elseif (get_row_layout() == 'products'):
            include get_template_directory() . '/templates/products.php';

          elseif (get_row_layout() == 'blogs'):
            include get_template_directory() . '/templates/blog.php';

            elseif (get_row_layout() == 'tags'):
              include get_template_directory() . '/templates/tags.php';

          endif;
        ?>

      <?php
    endwhile;
else :
endif;
?>
</div>
<?php get_footer(); ?>
