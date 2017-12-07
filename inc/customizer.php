<?php
/**
 * blankportfolio Theme Customizer.
 *
 * @package blankportfolio
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blankportfolio_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/* Add Section for Welcome Area */
	$wp_customize->add_section( 'blankportfolio_options', array(
		'title'             => esc_html__( 'blankportfolio Options', 'blankportfolio' ),
		'description'       => esc_html__( 'Use this section to add a welcome message to your homepage and to adjust your portfolio layout.', 'blankportfolio' ),
		'priority'          => 127,
	) );

	/* Welcome Message Content */
	$wp_customize->add_setting( 'blankportfolio_welcome_content', array(
		'sanitize_callback' => 'wp_kses_post',
		//'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'blankportfolio_welcome_content', array(
		'label'             => esc_html__( 'Add Welcome Message', 'blankportfolio' ),
		'section'           => 'blankportfolio_options',
		'description'       => esc_html__( 'Add a welcome message to your homepage.', 'blankportfolio' ),
		'type'              => 'textarea',
	) );

	$wp_customize->add_setting( 'blankportfolio_portfolio_layout', array(
		'default'           => 'landscape',
		'sanitize_callback' => 'blankportfolio_sanitize_ratio',
	) );

	$wp_customize->add_control( 'blankportfolio_portfolio_layout', array(
		'label'   => __( 'Portfolio Layout', 'blankportfolio' ),
		'section' => 'blankportfolio_options',
		'description' => esc_html__( 'Choose your layout.', 'blankportfolio' ),
		'type'    => 'select',
		'choices' => array(
			'two-column' => __( 'Two Column', 'blankportfolio' ),
			'three-column'  => __( 'Three Column', 'blankportfolio' ),
			'four-column'    => __( 'Four Column', 'blankportfolio' ),
		),
	) );
}
add_action( 'customize_register', 'blankportfolio_customize_register' );

/**
 * Sanitize the Portfolio Thumbnail layout.
 *
 * @param string $ratio Aspect ratio.
 * @return string Filtered ratio.
 */
function blankportfolio_sanitize_ratio( $ratio ) {
	if ( ! in_array( $ratio, array( 'two-column', 'three-column', 'four-column' ) ) ) {
		$ratio = 'three-column';
	}

	return $ratio;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blankportfolio_customize_preview_js() {
	wp_enqueue_script( 'blankportfolio_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'blankportfolio_customize_preview_js' );
