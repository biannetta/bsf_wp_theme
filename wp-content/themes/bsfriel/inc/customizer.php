<?php
/**
 * bsfriel Theme Customizer
 *
 * @package bsfriel
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bsfriel_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	$wp_customize->remove_control('blogdescription');

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.hero__headline',
			'render_callback' => 'bsfriel_customize_partial_blogname',
		) );
	}
	
	$wp_customize->add_section( 'bsf_theme_section', array(
		'title' 	    => __('Theme Settings', 'bsfriel'),
		'description' => __('Theme options', 'bsfriel'),
		'priority'    => 130,
	) );

	$wp_customize->add_setting( 'bsf_socialicons_setting[facebook-f]', array(
		'default'    => _x('', 'bsfriel'),
		'type'			 => 'theme_mod',
	) );
	
	$wp_customize->add_setting( 'bsf_socialicons_setting[instagram]', array(
		'default'    => _x('', 'bsfriel'),
		'type'			 => 'theme_mod',
	) );
	
	$wp_customize->add_setting( 'bsf_socialicons_setting[apple]', array(
		'default'    => _x('', 'bsfriel'),
		'type'			 => 'theme_mod',
	) );
	
	$wp_customize->add_setting( 'bsf_socialicons_setting[spotify]', array(
		'default'    => _x('', 'bsfriel'),
		'type'			 => 'theme_mod',
	) );

	$wp_customize->add_control( 'bsf_socialicons_setting[facebook-f]', array(
		'label'    => __('Facebook', 'bsfriel'),
		'section'  => 'bsf_theme_section',
		'priority' => 10,
	 ) );
	
	 $wp_customize->add_control( 'bsf_socialicons_setting[instagram]', array(
		'label'    => __('Instagram', 'bsfriel'),
		'section'  => 'bsf_theme_section',
		'priority' => 20,
	 ) );
	 
	 $wp_customize->add_control( 'bsf_socialicons_setting[apple]', array(
		'label'    => __('iTunes', 'bsfriel'),
		'section'  => 'bsf_theme_section',
		'priority' => 30,
	 ) );
	 
	 $wp_customize->add_control( 'bsf_socialicons_setting[spotify]', array(
		'label'    => __('Spotify', 'bsfriel'),
		'section'  => 'bsf_theme_section',
		'priority' => 40,
	 ) );

}
add_action( 'customize_register', 'bsfriel_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bsfriel_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bsfriel_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bsfriel_customize_preview_js() {
	wp_enqueue_script( 'bsfriel-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bsfriel_customize_preview_js' );
