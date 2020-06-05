<?php
/**
 * Entrypoint for theme functionality.
 *
 * This file is yours to edit and replace.
 *
 * @package altis/skeleton
 */

namespace YourProject;

require __DIR__ . '/inc/namespace.php';

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_assets' );
