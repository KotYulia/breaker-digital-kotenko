<?php
/**
 * breaker Theme Customizer
 *
 * @package breaker
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function breaker_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'theme_header_bg' );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,'theme_header_bg',array(
                'label' => 'Header Background Image',
                'section' => 'title_tagline',
                'settings' => 'theme_header_bg',
                'priority' => 2
            )
        )
    );

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'breaker_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function breaker_customize_preview_js() {
	wp_enqueue_script( 'breaker_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'breaker_customize_preview_js' );
