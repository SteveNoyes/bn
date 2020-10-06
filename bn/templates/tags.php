<div class="designer">
  <div class="designer__row">
    <div class="tags">
      <div class="tags__listing">
        <?php
        $rows = get_sub_field('tags_listing');
        if($rows) {
        	foreach($rows as $row) {
            $name = $row['tags']->name;
            $id = $row['tags']->term_id;
            $link = $row['tags']->permalink;
            $attachment_id = get_field('image', $row['tags']);
            $thumbnail = wp_get_attachment_image_src( $attachment_id, 'large' );
            ?>
            <a href="<?php echo get_term_link($id); ?>" class="tag" style="background-image:url('<?php echo $thumbnail[0]; ?>')">
            <h2><?php echo $name; ?></h2>
            </a>
            <?php
          }
        } ?>
    </div>
  </div>
</div>
