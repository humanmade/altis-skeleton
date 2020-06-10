<?php
/**
 * Entrypoint for theme functionality.
 *
 * @package altis/skeleton
 */

namespace YourProject;

const SLUG = 'yourproject';

/**
 * Enqueue static assets.
 *
 * Adds the default stylesheet to the repo.
 */
function enqueue_assets() {
	wp_enqueue_style( SLUG, get_stylesheet_uri() );
}
