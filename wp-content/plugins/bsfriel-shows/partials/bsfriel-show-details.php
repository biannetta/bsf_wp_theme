<?php
/* Partial HTML file for Show Details Meta
*/
?>
  <div class="bsfriel_shows_entry">
    <div>
      <?php wp_nonce_field( plugin_basename(__FILE__), 'bsfriel_show_details_nonce' ); ?>
    </div>
    <div class="bsfriel_shows_entry--detail">
      <label for="show_date">Show Date: </label>
      <input type="date" id="show_date" name="show_date" value="<?php echo get_post_meta( $object->ID, 'show_date', true ); ?>" />
    </div>
    <div class="bsfriel_shows_entry--detail">
      <label for="show_location">Show Location: </label>
      <input type="text" id="show_location" name="show_location" value="<?php echo get_post_meta( $object->ID, 'show_location', true ); ?>" />
    </div>
    <div class="bsfriel_shows_entry--detail">
      <label for="show_url">Show Website: </label>
      <input type="url" id="show_url" name="show_url" value="<?php echo get_post_meta( $object->ID, 'show_url', true ); ?>"/>
    </div>
  </div>