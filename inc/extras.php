<?php
/**
 * Custom functions that act independently of the portfolio templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blankportfolio
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blankportfolio_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_front_page() && is_home() ) {
		$classes[] = 'homepage-layout';
	}

	$ratio = get_theme_mod( 'blankportfolio_portfolio_layout', 'three-column' );
	$classes[] = 'layout-' . $ratio;

	return $classes;
}
add_filter( 'body_class', 'blankportfolio_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @param array $classes Classes for the post element.
 * @return array
 */
function blankportfolio_post_classes( $classes ) {

	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'blankportfolio_post_classes' );

if ( ! function_exists( 'blankportfolio_welcome_message' ) ) :
/**
 *  Prints HTML with contact information.
 */
function blankportfolio_welcome_message() {
	$content = get_theme_mod( 'blankportfolio_welcome_content' );

	// If we are not on the front page, return.
	if ( ! is_front_page() ) {
		return;
	}

	// If all the options are empty, return.
	if ( ( ! $content ) ) {
		return;
	}
	?>
		<?php if ( $content ) : ?>
			<div class="header-intro">
				<div class="welcome-message"><p><?php echo wp_kses_post( $content ); ?></p></div>
			</div><!-- .header-intro -->
		<?php endif; ?>
	<?php
}
endif;

if ( ! function_exists( 'blankportfolio_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own blankportfolio_excerpt() function to override in a child theme.
	 *
	 * @since blankportfolio 1.0
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function blankportfolio_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo $class; ?> -->
		<?php endif;
	}
endif;

if ( ! function_exists( 'blankportfolio_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * Create your own blankportfolio_excerpt_more() function to override in a child theme.
 *
 * @since blankportfolio 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function blankportfolio_excerpt_more() {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blankportfolio' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'blankportfolio_excerpt_more' );
endif;