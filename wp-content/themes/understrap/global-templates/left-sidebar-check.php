<?php
/**
 * Left sidebar check
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ) {
	get_template_part( 'sidebar-templates/sidebar', 'left' );
}

$className = (isset($args['className'])) ? $args['className'] : '';
?>

<div class="col-md <?= $className; ?> content-area" id="primary">
