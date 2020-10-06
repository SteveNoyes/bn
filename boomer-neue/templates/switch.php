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

  elseif (get_row_layout() == 'accordion'):
    include get_template_directory() . '/templates/accordion.php';

  elseif (get_row_layout() == 'videos'):
    include get_template_directory() . '/templates/videos.php';

    endif;
