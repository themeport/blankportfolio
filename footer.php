<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blankportfolio
 */
?>

	</div><!-- #content -->

	</div><!-- #page -->

	<footer id="colophon" class="site-footer">

		<div class="content-wrap">
			<div class="wrap site-info">
				<div class="credits">
					<?php printf( esc_html__( '%1$s by %2$s', 'blankportfolio' ), 'Blank Portfolio', '<a href="https://themeport.net" rel="designer">ThemePort</a>' ); ?>
				</div>

				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav id="social-navigation" class="social-links">
						<?php
							// Social links navigation menu.
							wp_nav_menu( array(
								'theme_location' => 'social',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif; ?>
			</div><!-- .site-info -->
		</div><!-- .content-wrap -->
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
