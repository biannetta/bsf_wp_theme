<?php
/**
 * BSFriel_Main_Layout
 * Main layout hook for the Brendan Scott Friel website
 */
function bsfriel_main_layout_hook() {
  
  get_template_part( 'section-parts/section', 'feature' );

}
add_action( 'home_page_section', 'bsfriel_main_layout_hook' );

?>