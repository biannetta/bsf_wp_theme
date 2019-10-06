<?php
/**
 * @package bsfriel_shows
 * @version 0.0.1
 */
/*
Plugin Name: Show List
Plugin URI: https://biannetta.com
Description: Plugin to build out show list
Author: Benjamin Iannetta
Version: 0.0.1
Author URI: https://biannetta.com
*/

/**
 * Register Custom Show Post
 */
function bsfriel_shows_post_type () {
  $labels = array(
    'name'               => _x( 'Shows', 'post type general name' ),
    'singular_name'      => _x( 'Show', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Show' ),
    'edit_item'          => __( 'Edit Show Details' ),
    'new_item'           => __( 'New Show' ),
    'all_items'          => __( 'All Shows' ),
    'view_item'          => __( 'View Show Details' ),
    'search_items'       => __( 'Search Shows' ),
    'not_found'          => __( 'No Upcoming Shows found' ),
    'not_found_in_trash' => __( 'No Shows found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Shows'
  );

  $args = array(
    'labels'        => $labels,
    'description'   => 'Enter Upcoming Shows and Details',
    'public'        => true,
    'menu_position' => 4,
    'supports'      => array( 'title','excerpt'),
    'menu_icon'		  => 'dashicons-microphone',
		'has_archive'   => true,
  );

  register_post_type('bsfriel_shows', $args);
}
add_action( 'init', 'bsfriel_shows_post_type' );

function bsfriel_shows_meta_box () {
  add_meta_box(
    'bsfriel_shows_meta_box',
    'Show Details',
    'bsfriel_show_details',
    null,
    'normal'
  );
}
add_action( 'add_meta_boxes', 'bsfriel_shows_meta_box' );

function bsfriel_show_details ( $object, $box ) {
  include plugin_dir_path( __FILE__ ).'partials/bsfriel-show-details.php';
}

function bsfriel_shows_styles () {
  wp_enqueue_style( 'bsfriel-shows', plugin_dir_url(__FILE__) . 'assets/bsfriel-shows.css' );
}
add_action( 'admin_enqueue_scripts', 'bsfriel_shows_styles' );

function bsfriel_show_details_save( $post_id ) {

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
  return;
  
  // if ( !wp_verify_nonce( $_POST['bsfriel_show_details_nonce'], plugin_basename( __FILE__ ) ) )
  // return;
  
  if ( 'page' == $_POST['post_type'] ) {
    if ( !current_user_can( 'edit_page', $post_id ) )
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) )
    return;
  }

  $show_date     = $_POST['show_date'];
  $show_location = $_POST['show_location'];
  $show_url      = $_POST['show_url'];

  update_post_meta( $post_id, 'show_date', $show_date );
  update_post_meta( $post_id, 'show_location', $show_location );
  update_post_meta( $post_id, 'show_url', $show_url );
}
add_action( 'save_post', 'bsfriel_show_details_save' );
