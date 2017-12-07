<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blankportfolio
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="footer-widgets" class="widget-area">
	<div class="content-wrap"><?php dynamic_sidebar( 'sidebar-2' ); ?></div>
</aside><!-- #footer-widgets -->