<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bsfriel
 */

get_header();

/**
 * TODO: build this
 * 
 * loop through customized theme option
 *  - should allow user to select multiple pages
 *  - limit number of sections?
 *  - maybe loop through posts instead?
 * grab page 
 * render either dark or light section
 *  - do_action( 'light_section' );
 *  - do_action( 'dark_section' );
 *  - do_action( 'feature_section' );
 * 
 */

$pages_loop = new WP_Query(array('post_type' => 'page'));

if ( $pages_loop->have_posts() ) {
  while ( $pages_loop->have_posts() ) {
    $pages_loop->the_post();
    do_action( 'home_page_section' );
  }
}
 
// Restore original post data.
wp_reset_postdata();
 
get_footer();
?>
